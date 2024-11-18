<?php
/**
 * Created by PhpStorm.
 * User: ElieMwezRubuz
 * Date: 20-Apr-21
 * Time: 7:14 AM
 */

namespace App\Controllers;

//import Models
use App\Models\AppModel;

class Rapport extends BaseController
{
    protected $session;
    protected $segment;
    protected $modeldb;

    function __construct()
    {
        $this->session = session();
        $this->segment = \CodeIgniter\Config\Services::uri();
        $this->validation = \CodeIgniter\Config\Services::validation();

        helper(['url', 'html', 'form', 'text', 'email', 'date', 'download', 'file', 'security', 'string']);

        $this->modeldb = new AppModel();
    }

    public function _remap($method, $param1 = null, $param2 = null, $param3 = null, $param4 = null)
    {
        if (!session()->has('loggedIn')) {
            //echo 'Disconnect';
            return redirect()->to(base_url() . '/secure/disconnect');  // redirect to login page if not connected
        } else {
            if ($this->session->role != 'etudiant') {
                //$method = 'process_'.$method;
                if (method_exists($this, $method)) {
                    return $this->$method($param1, $param2, $param3, $param4);
                } else {
                    return $this->index();
                }
            } else {
                return redirect()->back()->with('info', "Désolé, vous n'avez pas l'autorisation d'acceder a cette page.");
            }
        }
    }

    public function index()
    {
        $this->etudiants('listing');
    }

    public function finances($pageType = null)
    {
        $ecole = $this->session->schooluid;
        $annee = ($this->request->getGet('yr')) ? $this->request->getGet('yr') : $this->session->yearuid;  #GET YEAR
        $data = [];

        $data['annees'] = $this->modeldb->fetch_all_data('ts_annees', array('annee_deleted_at' => null), 'annee_created_at');
        $data ['ecole'] = $this->modeldb->fetch_row_data('ts_ecoles', array('ecole_uid' => $ecole));
        //get data by date

        $startdate = ($this->request->getGet('start_date'))?$this->request->getGet('start_date'):date('Y-m-d');
        $enddate = ($this->request->getGet('end_date'))?$this->request->getGet('end_date'):date('Y-m-d');
            

        switch ($pageType) {
            case 'invoices':
                     $data['recus'] = $this->modeldb->fetch_report_payments(
                        array('inscription_annee_uid' => $annee, 'payment_annee_uid' => $annee,  'payment_ecole_uid' => $ecole, 'promotion_statut'=>'actif'), null,
                    'payment_created_at', 'DESC', 'recu_numero_uid', FALSE);
                break;
            case 'litiges':
                    $data['litiges'] = $this->modeldb->fetch_report_payments(
                        array('inscription_annee_uid' => $annee, 'payment_annee_uid' => $annee,  'payment_ecole_uid' => $ecole), null,
                    'payment_created_at', 'DESC', 'payment_uid', FALSE);
                break;
            case 'journal':
            case 'versements':
                $data['mouvements'] = $this->modeldb->fetch_status_data('ts_mouvements_caisses',
                    array('mouvement_annee_uid' => $annee), 'mouvement_uid',
                    null, null, null, 'mouvement_created_at', 'DESC', 'mouvement_date', $startdate,$enddate);
                break;
            case 'caisses':
                $data ['caisses'] = $this->modeldb->fetch_all_data('ts_caisses', array('caisse_statut' => 'actif', 'caisse_ecole_uid' => $ecole), 'caisse_created_at');
                break;

            default:
                null;
                break;
        }

        if ($this->request->getGet('cls') && $this->request->getGet('cls') != 'all') {
            $promotion = $this->request->getGet('cls');
            $data['etudiants'] = $this->modeldb->fetch_join_inscription(
                array('inscription_annee_uid' => $annee, 
                'inscription_ecole_uid' => $ecole, 'etudiant_statut' => 'actif', 
                'inscription_promotion_uid' => $promotion), 'etudiant_nom', null, null, null, null, 'ASC');
            if ($pageType == 'versements' && !empty($promotion)) {

               $data['versements'] = $this->modeldb->fetch_report_versments(
                        array('inscription_annee_uid' => $annee,'payment_annee_uid' => $annee, 'recu_promotion_uid' => $promotion, 'promotion_statut'=>'actif'), null,
                    'typesfrai_libelle', 'ASC', 'payment_uid', FALSE, 'payment_date', $startdate,$enddate);

            } elseif ($pageType == 'litiges' && !empty($promotion)) {
                $data['litigespromotions'] =   $this->modeldb->fetch_report_versments(
                    array('inscription_annee_uid' => $annee,'payment_annee_uid' => $annee, 'recu_promotion_uid' => $promotion, 'promotion_statut'=>'actif'), null,
                'typesfrai_libelle', 'ASC', 'payment_uid', FALSE, 'payment_date', $startdate,$enddate);
                
            } elseif ($pageType == 'invoices' && !empty($promotion)) {
                $data['recuspromotions'] =   $this->modeldb->fetch_report_versments(
                    array('inscription_annee_uid' => $annee,'payment_annee_uid' => $annee, 'recu_promotion_uid' => $promotion, 'promotion_statut'=>'actif'), null,
                'payment_numero_recu', 'ASC', 'payment_uid', FALSE, 'payment_date', $startdate,$enddate);

            } elseif ($pageType == 'minerval' && !empty($promotion)) {
                $data['minerval'] = $this->modeldb->fetch_minerval_payments(
                    array('inscription_annee_uid' => $annee, 'payment_annee_uid' => $annee,  
                    'payment_ecole_uid' => $ecole, 'inscription_promotion_uid' => $promotion, 
                    'typesfrai_nature'=>'minerval', 'promotion_statut'=>'actif'), 
                    'etudiant_nom', 'ASC', 'etudiant_uid', FALSE);
            }

            $data['promotionChoosed'] = $this->modeldb->fetch_join_promotions(array('ts_promotions.promotion_uid' => $promotion, 'promotion_ecole_uid' => $ecole), 'promotion_created_at', 'row');
            
            $cycle_promotion = $data['promotionChoosed']['promotion_cycle_uid'];
            $data ['cycles'] = $this->modeldb->fetch_all_data('ts_cycles', array('cycle_uid' => $cycle_promotion), 'cycle_libelle');
            
            
            $data['typesfrais'] = $this->modeldb->fetch_join_typesfrais(
                array('typesfrai_annee_uid' => $annee, 'typesfrai_ecole_uid' => $ecole, 'typesfrai_statut' => 'actif', 'cycle_statut' => 'actif'), 'typesfrai_libelle');

            //all class for min
            $data['promotions'] = $this->modeldb->fetch_join_promotions(
                array('ts_promotions.promotion_uid' => $promotion, 'promotion_ecole_uid' => $ecole), 
                'cycle_libelle, promotion_libelle', null, 'ASC');
            
        }else{
            //$fields = ""
            $data['versements'] = $this->modeldb->fetch_report_versments(array(
                'inscription_annee_uid' => $annee,'payment_annee_uid' => $annee, 'promotion_statut'=>'actif'), null,
            'typesfrai_libelle', 'ASC', 'payment_uid', FALSE, 'payment_date', $startdate,$enddate);
            
            //minerval payments
            $data['minerval'] = $this->modeldb->fetch_minerval_payments(
                    array('inscription_annee_uid' => $annee, 'payment_annee_uid' => $annee,  
                    'payment_ecole_uid' => $ecole, 'typesfrai_nature'=>'minerval', 'promotion_statut'=>'actif'), 
                    'etudiant_nom', 'ASC', 'etudiant_uid', FALSE);
        //get all students    
            $data['etudiants'] = $this->modeldb->fetch_join_inscription(
                        array('inscription_annee_uid' => $annee, 'inscription_ecole_uid' => $ecole,
                         'etudiant_statut' => 'actif'), 'etudiant_nom', null, null, null, null, 'ASC');

            $data ['cycles'] = $this->modeldb->fetch_all_data('ts_cycles', array('cycle_ecole_uid' => $ecole, 'cycle_statut' => 'actif'), 'cycle_libelle');
        //toutes les promotions 
        $data['promotions'] = $this->modeldb->fetch_join_promotions(array('ts_promotions.promotion_statut' => 'actif', 
        'promotion_ecole_uid' => $ecole), 'cycle_libelle, promotion_libelle', null, 'ASC');
        }

        if ($this->request->getGet('typefrais') && $this->request->getGet('typefrais') != 'all') {
            $fraisuid= $this->request->getGet('typefrais');
            //$data['typesfrais'] = $this->modeldb->fetch_join_typesfrais(
               // array('typesfrai_uid' => ), 'typesfrai_libelle');

            $data['typesfrais'] = $this->modeldb->fetch_report_versments(array('typesfrai_uid' => $fraisuid), 
                null,'typesfrai_libelle', 'DESC', 'typesfrai_libelle', FALSE);
        }else{
            $data['typesfrais'] = $this->modeldb->fetch_report_versments(array('typesfrai_statut' => 'actif'), 
            null,'typesfrai_libelle', 'DESC', 'typesfrai_libelle', FALSE);
        }

        
            //for user format in page
            $startdate_convert =  $this->convertDateFormat($startdate, null, "%d/%m/%Y");
            $enddate_convert = $this->convertDateFormat($enddate, null, "%d/%m/%Y");

        $data['startdate'] = $startdate_convert;
        $data['enddate'] = $enddate_convert;
        $data['taux'] = $this->modeldb->fetch_row_data('ts_taux', array('taux_statut' => 'actif', 'taux_ecole_uid' => $ecole));
        
       //$this->displayResults($data['cycles']);

        $data ['title'] = ucfirst($pageType);
        $data ['_view'] = ('app/rapports/finances/' . $pageType);
        echo view('layouts/app', $data);
    }

    public function etudiants($typePage = null)
    {
        $ecole = $this->session->schooluid;   # GET SCHOOL ID
        $annee = ($this->request->getGet('yr')) ? $this->request->getGet('yr') : $this->session->yearuid;  #GET YEAR ID
        $promotion = ($this->request->getGet('cls')) ? $this->request->getGet('cls') : '';   # GET promotion ID

        $data = [];

        $data['dateChoosed'] = ($this->request->getGet('dayof')) ? $this->request->getGet('dayof') : date('Y-m-d');

        if (!empty($promotion) && $promotion != 'all') {

            if ($typePage == 'presences') {
                $data['presences'] = $this->modeldb->fetch_join_presences(array('presence_promotion_uid' => $promotion, 'presence_date' => $data['dateChoosed'], 'presence_ecole_uid' => $ecole), 'etudiant_nom');
            } else {
                $data['etudiants'] = $this->modeldb->fetch_join_inscription(array('inscription_ecole_uid' => $ecole, 'inscription_annee_uid' => $annee,
                    'etudiant_statut' => 'actif', 'inscription_promotion_uid' => $promotion), 'etudiant_matricule', null, null, null, null, "ASC");
            }

            $data['promotionChoosed'] = $this->modeldb->fetch_join_promotions(array('ts_promotions.promotion_uid' => $promotion, 'promotion_ecole_uid' => $ecole), 'promotion_created_at', 'row');
        } else {

            if ($typePage == 'presences') {
                $data['presences'] = $this->modeldb->fetch_join_presences(array('presence_deleted_at' => null, 'presence_date' => $data['dateChoosed'], 'presence_ecole_uid' => $ecole), 'etudiant_nom');
            } else {
                $data ['etudiants'] = $this->modeldb->fetch_join_inscription(array('inscription_ecole_uid' => $ecole, 'inscription_annee_uid' => $annee,
                    'etudiant_statut' => 'actif'), 'etudiant_matricule', null, null, null, null, "ASC");
            }
        }
        $data['pointages'] = $this->modeldb->fetch_status_data('ts_presences',
            array('ts_presences.presence_deleted_at' => null, 'presence_ecole_uid' => $ecole), 'presence_date');

        //$this->displayResults($data['pointages']);
        // toutes les annees scolaires
        $data['annees'] = $this->modeldb->fetch_all_data('ts_annees', array('annee_deleted_at' => null), 'annee_libelle');

        $data['anneeChoosed'] = $this->modeldb->fetch_field_value('ts_annees', array('annee_uid' => $annee))->annee_libelle; # GET YEAR LIBELLE

        //toutes les promotions 
        $data['promotions'] = $this->modeldb->fetch_join_promotions(array('ts_promotions.promotion_statut' => 'actif', 'promotion_ecole_uid' => $ecole), 'cycle_libelle', null, "ASC");

        $data ['ecole'] = $this->modeldb->fetch_row_data('ts_ecoles', array('ecole_uid' => $ecole));
        $data ['cycles'] = $this->modeldb->fetch_all_data('ts_cycles', array('cycle_ecole_uid' => $ecole, 'cycle_statut' => 'actif'), 'cycle_libelle');

        $data['parents'] = $this->modeldb->fetch_all_data('ts_parents',
            array('parent_statut' => 'actif', 'parent_ecole_uid' => $ecole), 'parent_nom_tuteur', null, null, 'ASC');

        $data ['title'] = ucfirst($typePage . ' etudiants - Rapport | School Web Application');
        $data ['_view'] = ('app/rapports/etudiants/' . $typePage);
        echo view('layouts/app', $data);
    }

    public function parents()
    {
        $ecole = $this->session->schooluid;   # GET SCHOOL ID
        $annee = ($this->request->getGet('yr')) ? $this->request->getGet('yr') : $this->session->yearuid;  #GET YEAR ID
        $promotion = ($this->request->getGet('cls')) ? $this->request->getGet('cls') : '';   # GET promotion ID

        $data = [];

        $data['dateChoosed'] = ($this->request->getGet('dayof')) ? $this->request->getGet('dayof') : date('Y-m-d');

        if (!empty($promotion) && $promotion != 'all') {
            $data['parents'] = $this->modeldb->fetch_join_inscription(array('inscription_ecole_uid' => $ecole, 'inscription_annee_uid' => $annee, 'etudiant_statut' => 'actif', 'inscription_promotion_uid' => $promotion), 'etudiant_matricule');
            $data['etudiants'] = $this->modeldb->fetch_join_inscription(array('inscription_ecole_uid' => $ecole, 'inscription_annee_uid' => $annee, 'etudiant_statut' => 'actif', 'inscription_promotion_uid' => $promotion), 'etudiant_matricule');
            $data['promotionChoosed'] = $this->modeldb->fetch_join_promotions(array('ts_promotions.promotion_uid' => $promotion, 'promotion_ecole_uid' => $ecole), 'promotion_libelle', 'row');
        } else {

            $data['parents'] = $this->modeldb->fetch_all_data('ts_parents',
                array('parent_statut' => 'actif', 'parent_ecole_uid' => $ecole), 'parent_nom_tuteur', null, null, 'ASC');

            $data ['etudiants'] = $this->modeldb->fetch_join_inscription(array('inscription_ecole_uid' => $ecole, 'inscription_annee_uid' => $annee, 'etudiant_statut' => 'actif'), 'etudiant_matricule');
        }

        $data['annees'] = $this->modeldb->fetch_all_data('ts_annees', array('annee_deleted_at' => null), 'annee_created_at');
        $data['anneeChoosed'] = $this->modeldb->fetch_field_value('ts_annees', array('annee_uid' => $annee))->annee_libelle; # GET YEAR LIBELLE
        //toutes les promotions
        $data['promotions'] = $this->modeldb->fetch_join_promotions(array('ts_promotions.promotion_statut' => 'actif', 'promotion_ecole_uid' => $ecole), 'promotion_libelle');

        $data ['ecole'] = $this->modeldb->fetch_row_data('ts_ecoles', array('ecole_uid' => $ecole));
        $data ['cycles'] = $this->modeldb->fetch_all_data('ts_cycles', array('cycle_ecole_uid' => $ecole, 'cycle_statut' => 'actif'), 'cycle_libelle');

        $data ['title'] = ucfirst(' Elèves & Parents - Rapport | Eduschool Web Application');
        $data ['_view'] = ('app/rapports/etudiants/parents');
        echo view('layouts/app', $data);
    }

    public function cursus($type)
    {
        $ecole = $this->session->schooluid;   # GET SCHOOL ID
        $annee = ($this->request->getGet('yr')) ? $this->request->getGet('yr') : $this->session->yearuid;  #GET 

        $data['palmares'] = $this->modeldb->fetch_join_resultats(array('resultat_ecole_uid' => $ecole, 'resultat_annee_uid' => $annee), 'resultat_annee_uid');

        $data ['ecole'] = $this->modeldb->fetch_row_data('ts_ecoles', array('ecole_uid' => $ecole));
        $data ['cycles'] = $this->modeldb->fetch_all_data('ts_cycles', array('cycle_ecole_uid' => $ecole, 'cycle_statut' => 'actif'), 'cycle_libelle');

// toutes les annees scolaires
        $data['annees'] = $this->modeldb->fetch_all_data('ts_annees', array('annee_deleted_at' => null), 'annee_created_at');

        $data['anneeChoosed'] = $this->modeldb->fetch_field_value('ts_annees', array('annee_uid' => $annee))->annee_libelle; # GET YEAR LIBELLE
        $data ['title'] = ucfirst('Rapport - Palmares | School Web Application');
        $data ['_view'] = ('app/rapports/cursus/' . $type);
        echo view('layouts/app', $data);
    }

    public function agents()
    {
        $ecole = $this->session->schooluid;   # GET SCHOOL ID
        $annee = ($this->request->getGet('yr')) ? $this->request->getGet('yr') : $this->session->yearuid;  #GET 

        $data['agents'] = $this->modeldb->fetch_join_agents(array('agent_deleted_at' => null, 'agent_ecole_uid' => $ecole), 'agent_created_at');

        $data ['ecole'] = $this->modeldb->fetch_row_data('ts_ecoles', array('ecole_uid' => $ecole));
        $data ['cycles'] = $this->modeldb->fetch_all_data('ts_cycles', array('cycle_ecole_uid' => $ecole, 'cycle_statut' => 'actif'), 'cycle_libelle');

        // toutes les annees scolaires
        $data['annees'] = $this->modeldb->fetch_all_data('ts_annees', array('annee_deleted_at' => null), 'annee_created_at');

        $data['anneeChoosed'] = $this->modeldb->fetch_field_value('ts_annees', array('annee_uid' => $annee))->annee_libelle; # GET YEAR LIBELLE
        $data ['title'] = ucfirst('Rapport - Liste Agents | School Web Application');
        $data ['_view'] = ('app/rapports/agents/listing');
        echo view('layouts/app', $data);
    }

}