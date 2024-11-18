<?php

namespace App\Controllers;

use App\Models\AppModel;

class Finance extends BaseController
{
    protected $session;
    protected $segment;
    protected $modeldb;
    protected $validation;

    function __construct()
    {
        $this->session = \CodeIgniter\Config\Services::session();
        $this->segment = \CodeIgniter\Config\Services::uri();
        $this->validation = \CodeIgniter\Config\Services::validation();
        helper(['url', 'html', 'form', 'text', 'email', 'date', 'download', 'file', 'security', 'string']);
        $this->modeldb = new AppModel();
    }

    public function _remap($method, $param1 = null, $param2 = null, $param3 = null)
    {
        if (!session()->has('loggedIn')) {
            //echo 'Disconnect';
            return redirect()->to(base_url() . '/secure/disconnect');               // redirect to login page if not connected
        } else {
            //$method = 'process_'.$method;
            if (method_exists($this, $method)) {
                return $this->$method($param1, $param2, $param3);
            } else {
                return $this->index();
            }
        }
    }

    public function index()
    {
        $this->view('paiements');
    }

    public function view($pageType = null)
    {
        $ecole = $this->session->schooluid;
        $annee = ($this->request->getGet('yr')) ? $this->request->getGet('yr') : $this->session->yearuid;  #GET 

        $data = [];
        switch ($pageType) {
            case 'typesfrais':
                $data ['typesfrais'] = $this->modeldb->fetch_join_typesfrais(array('typesfrai_ecole_uid' => $ecole), 'typesfrai_created_at');
                break;
            case 'frais':
                $data ['frais'] = $this->modeldb->fetch_all_data('ts_frais', array('frais_statut' => 'actif', 'frais_ecole_uid' => $ecole), 'frais_created_at');
                break;
            case 'caisses':
                $data ['caisses'] = $this->modeldb->fetch_all_data('ts_caisses', array('caisse_statut' => 'actif', 'caisse_ecole_uid' => $ecole), 'caisse_created_at', null, null, "DESC");
                break;
            case 'depenses':
                $data ['depenses'] = $this->modeldb->fetch_join_mouvements(array('mouvement_type' => 'depense', 'mouvement_deleted_at' => null, 'mouvement_ecole_uid' => $ecole), 'mouvement_created_at');
                break;
            case 'expenses':
                $data ['expenses'] = $this->modeldb->fetch_join_mouvements(array('mouvement_type !=' => 'depense', 'mouvement_deleted_at' => null, 'mouvement_ecole_uid' => $ecole), 'mouvement_created_at');
                break;
            case 'banques':
                $data ['comptes'] = $this->modeldb->fetch_all_data('ts_banques', array('compte_statut' => 'actif', 'compte_ecole_uid' => $ecole), 'compte_created_at');
                break;
            case 'paiements':
                $data['payments'] = $this->modeldb->fetch_report_payments(
                    array('inscription_annee_uid' => $annee,'payment_annee_uid' => $annee, 'payment_ecole_uid' => $ecole), null,
                'payment_created_at', 'DESC', 'payment_uid', FALSE);
                
                break;
            default:
                $data ['taux'] = $this->modeldb->fetch_all_data('ts_taux', array('taux_ecole_uid' => $ecole), 'taux_created_at');
        }
        $data['annees'] = $this->modeldb->fetch_all_data('ts_annees', array('annee_deleted_at' => null), 'annee_libelle');
        $data['anneeChoosed'] = $this->modeldb->fetch_field_value('ts_annees', array('annee_uid' => $annee))->annee_libelle; # GET YEAR LIBELLE
        $data ['title'] = ucfirst($pageType . ' | School Web Application');
        $data ['_view'] = ('app/finance/list/' . $pageType);
        echo view('layouts/app', $data);
    }
function newInvoicing(){
    
        //Remove session data 
$this->session->remove('etudiant');
$this->session->remove('frais');
$this->session->remove('recu');
$this->session->remove('etudiantmatricule');
$this->session->remove('etudiantpromotion');
$this->session->remove('etudiantpromotioncycle');
    return redirect()->to(base_url('finance/addForm/paiement'));
}
    public function addForm($type = null, $soustype = null)
    {
        
        
        //si annee est inactif, aucune creation n'est autorisee
        if ($this->session->yearstatus == 'inactif') {
            return redirect()->back()->with('info', "Année Fermée: La création n'est pas autorisée sur une année fermée");
        } else {
            $ecole = $this->session->schooluid;   # GET SCHOOL ID
            $annee_encours = $this->session->yearuid;

            $etudiant = ($this->request->getGet('recusetudiant')) ? $this->request->getGet('recusetudiant') : $this->session->etudiant;
            //set etudiant uid session
            $this->session->set('etudiant', $etudiant);

            $data = [];
            $data['promotions'] = $this->modeldb->fetch_join_promotions(array('ts_promotions.promotion_statut' => 'actif', 'promotion_ecole_uid' => $ecole), 'promotion_created_at');
            $recu_date =  date('Y-m-d');
            if (!empty($etudiant) && !empty(session()->recu)) {

                $data['paiements_etudiants'] = $this->modeldb->fetch_report_payments(
                    array('recu_etudiant_uid' => $etudiant, 'payment_statut !=' => 'inactif', 'recu_numero_uid' => session()->recu), null,
                'typesfrai_libelle', 'ASC', 'payment_uid', FALSE, 'payment_date', $recu_date, $recu_date);

                //GET ALL DETAILS PAYMENT BY date and etudiant UID
                //$data['paiements_etudiants'] = $this->modeldb->fetch_all_data('vs_detailspayments', 
                //array('recu_etudiant_uid' => $etudiant, 'payment_statut !=' => 'inactif', 
                //'recu_date' => date('Y-m-d'), 'recu_numero_uid' => session()->recu), 'payment_created_at');
            }

            switch ($type) {
                case 'paiement':
                    $data['etudiants'] = $this->modeldb->fetch_join_inscription(
                        array('ts_etudiants.etudiant_statut' => 'actif', 'promotion_statut' => 'actif', 'etudiant_ecole_uid' => $ecole, 
                        'inscription_annee_uid' => $annee_encours), 'inscription_date');
                    
                    $data ['typesfrais'] = $this->modeldb->fetch_join_typesfrais(array('ts_typesfrais.typesfrai_statut' => 'actif', 'typesfrai_ecole_uid' => $ecole), 'typesfrai_created_at');
                    $data ['mois'] = $this->modeldb->fetch_all_data('ts_mois', array('mois_statut' => 'actif'), 'ordre_mois', null, null, 'ASC');
                    $data ['caisses'] = $this->modeldb->fetch_all_data('ts_caisses', array('caisse_statut' => 'actif', 'caisse_ecole_uid' => $ecole), 'caisse_created_at');
                    //$data['payments'] = $this->modeldb->fetch_all_data('vs_detailspayments', 
                    //array('payment_annee_uid' => $annee_encours, 
                    //'payment_statut !=' => 'inactif', 'recu_etudiant_uid' => session()->etudiant), 'payment_created_at');
                    $data['payments'] = $this->modeldb->fetch_report_payments(
                        array('inscription_annee_uid' => $annee_encours,'payment_annee_uid' => $annee_encours, 
                        'payment_statut !=' => 'inactif', 'recu_etudiant_uid' => session()->etudiant), null,
                    'typesfrai_libelle', 'ASC', 'payment_uid', FALSE);
    
                    
                    break;
                case 'typesfrais':
                    $data ['cycles'] = $this->modeldb->fetch_all_data('ts_cycles', array('cycle_statut' => 'actif', 'cycle_ecole_uid' => $ecole), 'cycle_created_at');
                    $data ['frais'] = $this->modeldb->fetch_all_data('ts_frais', array('frais_statut' => 'actif', 'frais_ecole_uid' => $ecole), 'frais_created_at');
                    break;
                case 'depense':
                case 'recette':
                case 'expense':
                    $data ['caisses'] = $this->modeldb->fetch_all_data('ts_caisses', array('caisse_statut' => 'actif', 'caisse_ecole_uid' => $ecole), 'caisse_created_at');
                    break;
                default:
                    null;
            }
            $data['taux'] = $this->modeldb->fetch_row_data('ts_taux', array('taux_statut' => 'actif', 'taux_ecole_uid' => $ecole), 'taux_created_at');
            
            //$this->displayResults($data['paiements_etudiants_completed']);
            $data ['title'] = ucfirst($type . ' Adding | School Web Application');
            $data ['_view'] = ('app/finance/create/' . $type);
            echo view('layouts/app', $data);
        }
    }

    public function editForm($typePage = null, $typeId = null)
    {
        //si annee est inactif, aucune creation n'est autorisee
        if ($this->session->yearstatus == 'inactif') {
            return redirect()->back()->with('info', "Année Fermée: La modification n'est pas autorisée sur une année fermée");
        } else {
            $ecole = $this->session->schooluid;   # GET SCHOOL ID

            $data = [];
            switch ($typePage) {
                case 'typesfrais':
                    $data ['typesfrais'] = $this->modeldb->fetch_join_typesfrais(array('typesfrai_uid' => $typeId), 'typesfrai_created_at', 'row');
                    $data ['cycles'] = $this->modeldb->fetch_all_data('ts_cycles', array('cycle_statut' => 'actif', 'cycle_ecole_uid' => $ecole), 'cycle_created_at');
                    $data ['frais'] = $this->modeldb->fetch_all_data('ts_frais', array('frais_statut' => 'actif', 'frais_ecole_uid' => $ecole), 'frais_created_at');
                    break;
                case 'caisse':
                    $data ['caisse'] = $this->modeldb->fetch_row_data('ts_caisses', array('caisse_uid' => $typeId));
                    break;
                case 'banque':
                    $data ['compte'] = $this->modeldb->fetch_row_data('ts_banques', array('banque_uid' => $typeId));
                    break;
                default:
                    null;
            }
            //$this->displayResults($data);

            $data ['title'] = ucfirst($typePage . ' Updating | School Web Application');
            $data ['_view'] = ('app/finance/update/' . $typePage);
            echo view('layouts/app', $data);
        }
    }

    public function details($typePage = null, $typeid = null)
    {
        $ecole = $this->session->schooluid;   # GET SCHOOL ID
        $data['taux'] = $this->modeldb->fetch_row_data('ts_taux', array('taux_statut' => 'actif', 'taux_ecole_uid' => $ecole), 'taux_created_at');

        $data = [];
        switch ($typePage) {
            case 'typesfrais':
                $data ['typesfrais'] = $this->modeldb->fetch_join_typesfrais(array('typesfrai_uid' => $typeid), 'typesfrai_created_at', 'row');
                break;
            case 'caisse':
                $data ['caisse'] = $this->modeldb->fetch_row_data('ts_caisses', array('caisse_uid' => $typeid));
                break;
            case 'frais':
                $data ['frais'] = $this->modeldb->fetch_row_data('ts_frais', array('frais_uid' => $typeid));
                break;
            case 'banque':
                $data ['compte'] = $this->modeldb->fetch_row_data('ts_banques', array('banque_uid' => $typeid));
                break;
            case 'paiement':
                $data['payment'] = $this->modeldb->fetch_report_payments(
                    array('payment_uid' => $typeid), null,'typesfrai_libelle', 'ASC', 'payment_uid', TRUE);

                 //$this->modeldb->fetch_row_data('vs_detailspayments', array('payment_uid' => $typeid));
                break;
            case 'mouvement':
                $data ['mouvement'] = $this->modeldb->fetch_join_mouvements(array('mouvement_uid' => $typeid), 'mouvement_created_at', 'row');
                break;
            default:
                null;
        }

        $data ['title'] = ucfirst($typePage . ' Details | School Web Application');
        $data ['_view'] = ('app/finance/details/' . $typePage);
        echo view('layouts/app', $data);
    }

    public function invoice($typePage = null, $reference = null)
    {
        $ecole = $this->session->schooluid;   # GET SCHOOL ID

        $data = [];

        //GET TAUX USED ACTUALLY
        $data['taux'] = $this->modeldb->fetch_row_data('ts_taux', array('taux_statut' => 'actif', 'taux_ecole_uid' => $ecole), 'taux_created_at');

        //GET ALL DETAILS PAYMENT BY REFERENCE UID
        //$data['paiements_etudiants'] = $this->modeldb->fetch_all_data('vs_detailspayments', 
        //array('payment_uid' => $reference, 'payment_statut !=' => 'inactif'), 'payment_created_at');
        
        $data['paiements_etudiants'] = $this->modeldb->fetch_report_payments(
            array('payment_uid' => $reference, 'payment_statut !=' => 'inactif'), null,
        'typesfrai_libelle', 'ASC', 'payment_uid', FALSE);

        //GET etudiant DETAILS PAYMENT BY REFERENCE PAYMENT
        $etudiantPaymentReference = $this->modeldb->fetch_report_payments(
            array('payment_uid' => $reference, 'payment_statut !=' => 'inactif'), null,
        'typesfrai_libelle', 'ASC', 'payment_uid', TRUE);
        
        //$this->modeldb->fetch_row_data('vs_detailspayments', 
        //array('payment_uid' => $reference, 'payment_statut !=' => 'inactif',));

        $etudiant = $etudiantPaymentReference['recu_etudiant_uid'];

        //GET INFOS etudiant BY etudiant UID
        $data['etudiant'] = $this->modeldb->fetch_join_inscription(array('etudiant_uid' => $etudiant), 'inscription_created_at', 'row');

        //get entete payment by RECU NUMERO
        $data['recu'] = $this->modeldb->fetch_report_payments(
            array('recu_numero_uid' => $etudiantPaymentReference['recu_numero_uid']), null,
        'typesfrai_libelle', 'ASC', 'payment_uid', TRUE);

       // $this->modeldb->fetch_row_data('vs_detailspayments', 
        //array('recu_numero_uid' => $etudiantPaymentReference['recu_numero_uid']));
        
        $data['caisse'] = $this->modeldb->fetch_row_data('ts_caisses', array('caisse_uid' => $etudiantPaymentReference['recu_caisse_uid']));

        //GET ECOLE INFOS
        $data['ecole'] = $this->modeldb->fetch_row_data('ts_ecoles', array('ecole_uid' => $ecole));

        $data['title'] = ucfirst($typePage . ' Invoice | School Web Application');
        $data['_view'] = ('app/finance/print/invoice');
        echo view('layouts/app', $data);
    }

    public function printInvoice($etudiant = null, $date = null, $recu = null)
    {
        $data = [];
        $ecole = session()->schooluid;   # GET SCHOOL ID
        $data['taux'] = $this->modeldb->fetch_row_data('ts_taux', 
        array('taux_statut' => 'actif'), 'taux_created_at');

        //GET ALL DETAILS PAYMENT BY REFERENCE UID
        $data['paiements_etudiants'] = $this->modeldb->fetch_report_payments(
            array('recu_etudiant_uid' => $etudiant, 'payment_date'=>$date , 'payment_statut !='=>'inactif'), null, 
            'typesfrai_libelle', 'ASC', 'payment_uid', FALSE, 'payment_date', $date, $date);
        
        //$this->modeldb->fetch_all_data('vs_detailspayments',
           // array('recu_etudiant_uid' => $etudiant, 'payment_date' => $date, 'payment_statut !=' => 'inactif','recu_numero_uid' => $recu), 'payment_created_at');

        //GET etudiant DETAILS PAYMENT BY REFERENCE PAYMENT
        //$etudiantPaymentReference = $this->modeldb->fetch_row_data('vs_detailspayments', array('recu_etudiant_uid' => $etudiant, 'payment_date' => $date, 'recu_numero' => $recu));

        //$etudiant = $etudiantPaymentReference['recu_etudiant_uid'];

        //GET INFOS etudiant BY etudiant UID
        $data['etudiant'] = (!empty($etudiant)) ? $this->modeldb->fetch_join_inscription(
            array('etudiant_uid' => $etudiant), 'inscription_created_at', 'row') : '';

        //get entete payment by RECU NUMERO
        $data['recu'] = $this->modeldb->fetch_report_payments(
            array('recu_numero_uid' => $recu), null,
        'typesfrai_libelle', 'ASC', 'payment_uid', TRUE, 'payment_date', $date, $date);
        
        //$this->modeldb->fetch_row_data('vs_detailspayments', array('recu_numero_uid' => $recu));

        $caisseuid = (!empty($data['recu'])) ? $data['recu']['recu_caisse_uid'] : '';

        $data['caisse'] = (!empty($caisseuid)) ? $this->modeldb->fetch_row_data('ts_caisses', 
        array('caisse_uid' => $caisseuid)) : '';

        //GET ECOLE INFOS
        $ecuid = (!empty($data['recu'])) ? $data['recu']['recu_ecole_uid'] : '';
        $data['ecole'] = $this->modeldb->fetch_row_data('ts_ecoles', array('ecole_uid' => $ecuid));

        //Remove session data 
        $this->session->remove('etudiant');
        $this->session->remove('frais');
        $this->session->remove('recu');
        $this->session->remove('etudiantmatricule');
        $this->session->remove('etudiantpromotion');
        $this->session->remove('etudiantpromotioncycle');

        $data['title'] = ucfirst('Reçu Paiements Journaliers');
        //$data ['_view'] = ('app/finance/print/payment');
        echo view(('app/finance/print/payment'), $data);
    }

    public function changeStatus($table = null, $status_value = null, $uid = null)
    {
        switch ($table) {
            case 'taux':
                $realnametable = 'ts_taux';
                $real_uid = 'taux_uid';
                $status = 'taux_statut';
                $updated_time = 'taux_updated_at';
                $updated_by = 'taux_updated_by';
                break;
            default:
                $realnametable = 'ts_' . $table . 's';
                $real_uid = $table . '_uid';
                $status = $table . '_statut';
                $updated_time = $table . '_updated_at';
                $updated_by = $table . '_updated_by';
        }

        $statusData = array(
            $status => ($status_value == 'actif') ? 'inactif' : 'actif',
            $updated_time => date('Y-m-d H:i:s'),
            $updated_by => $this->session->fullname . ' - ' . $this->session->role,
        );

        if ($this->modeldb->update_data($realnametable, $statusData, array($real_uid => $uid))) {
            return redirect()->back()->with('success', "Modification Statut: Opération effectuée avec succés");
        } else {
            return redirect()->back()->with('failed', "ERROR: Opération non effectuée. Réessayer plus tard");
        }
    }

    function saveFrais()
    {
        if ($this->request->getPost('frais_libelle') != '') {
            if ($this->segment->getSegment(3) == "create") {
                $nouvellePresenceData = [
                    'frais_uid' => $this->generateIdentifiant(),
                    'frais_libelle' => $this->request->getPost('frais_libelle'),
                    'frais_statut' => 'actif',
                    'frais_created_at' => date('Y-m-d h:i:s'),
                    'frais_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                    'frais_ecole_uid' => $this->session->schooluid,
                ];
                if ($this->modeldb->insert_data('ts_frais', $nouvellePresenceData)) {
                    return redirect()->back()->with('success', "Création frais: Opération effectuée  avec succès");
                } else {
                    return redirect()->back()->with('failed', "Erreur Création frais");
                }
            } elseif ($this->segment->getSegment(3) == "update") {

                $random_uid = $this->segment->getSegment(4);
                $updateData = [
                    'frais_libelle' => $this->request->getPost('frais_libelle'),
                    'frais_updated_at' => date('Y-m-d h:i:s'),
                    'frais_updated_by' => $this->session->fullname . ' - ' . $this->session->role,
                ];
                if ($this->modeldb->update_data('ts_frais', $updateData, array('frais_uid' => $random_uid))) {
                    return redirect()->back()->with('success', "Modification frais: Opération effectuée  avec succès");
                } else {
                    return redirect()->back()->with('failed', "Erreur Modification frais");
                }
            } else {
                return redirect()->back()->withInput();
            }

        } else {
            $this->session->setFlashdata('failed', 'ERROR: Opération non effectuée. Veuillez  vérifier ci-dessous les erreurs rencontrées puis réessayer !');
            return redirect()->back()->withInput();
        }
    }

    function saveTypesfrais()
    {
        $data = [];
        $rulers = [
            'code_type_frais' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Code obligatoire",
                ],
            ],
            'libelle_type_frais' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Libelle obligatoire',
                ]
            ], 'montant_type_frais' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Montant obligatoire',
                ]
            ], 'devise_type_frais' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Devise obligatoire',
                ]
            ], 'cycle_type_frais' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'cycle obligatoire',
                ]
            ],
        ];

        if ($this->validate($rulers)) {
            $code = trim(htmlspecialchars($this->request->getPost('code_type_frais')));
            $libelle = trim(htmlspecialchars($this->request->getPost('libelle_type_frais')));
            $montant = trim(htmlspecialchars($this->request->getPost('montant_type_frais')));
            $devise = trim(htmlspecialchars($this->request->getPost('devise_type_frais')));
            $taux = trim(htmlspecialchars($this->request->getPost('taux_type_frais')));
            $cycle = trim(htmlspecialchars($this->request->getPost('cycle_type_frais')));
            $nature = trim(htmlspecialchars($this->request->getPost('nature_type_frais')));

            $nature_libelle = ($nature != 'new') ? $nature : trim(htmlspecialchars($this->request->getPost('nouvelle_nature_type_frais')));

            $current_datetime = date('Y-m-d H:i:s');

            if ($this->segment->getSegment(3) == "create") {
                //generate uid random
                $random_uid_typefrais = $this->generateIdentifiant();

                //table data
                $saveTypeFraisData = [
                    'typesfrai_uid' => $random_uid_typefrais,
                    'typesfrai_code' => $code,
                    'typesfrai_libelle' => $libelle,
                    'typesfrai_montant' => $montant,
                    'typesfrai_devise' => $devise,
                    'typesfrai_statut' => 'actif',
                    'typesfrai_nature' => $nature_libelle,
                    'typesfrai_taux' => $taux,
                    'typesfrai_cycle_uid' => $cycle,
                    'typesfrai_created_at' => $current_datetime,
                    'typesfrai_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                    'typesfrai_annee_uid' => $this->session->yearuid,
                    'typesfrai_ecole_uid' => $this->session->schooluid,
                ];
                //$this->displayResults($saveTypeFraisData);
                if ($this->modeldb->insert_data('ts_typesfrais', $saveTypeFraisData)) {
                    return redirect()->back()->with('success', "Creation: Opération effectuée avec succés");
                }

            } elseif ($this->segment->getSegment(3) == "update") {
                //update data
                $key_typefrais_uid = $this->segment->getSegment(4);

                $updateTypeData = [
                    'typesfrai_code' => $code,
                    'typesfrai_libelle' => $libelle,
                    'typesfrai_montant' => $montant,
                    'typesfrai_devise' => $devise,
                    'typesfrai_statut' => 'actif',
                    'typesfrai_nature' => $nature_libelle,
                    'typesfrai_taux' => $taux,
                    'typesfrai_cycle_uid' => $cycle,
                    'typesfrai_date_debut' => htmlspecialchars($this->request->getPost('datedebut_typesfrais')),
                    'typesfrai_date_fin' => htmlspecialchars($this->request->getPost('datefin_typesfrais')),
                    'typesfrai_comments' => htmlspecialchars($this->request->getPost('commentaire_frais')),
                    'typesfrai_updated_at' => $current_datetime,
                    'typesfrai_updated_by' => $this->session->fullname . ' - ' . $this->session->role,
                ];

                //update data in table
                if ($this->modeldb->update_data('ts_typesfrais', $updateTypeData, array('typesfrai_uid' => $key_typefrais_uid))) {
                    return redirect()->back()->with('success', "Modification: Opération effectuée avec succés");
                }
            } else {
                return redirect()->to(current_url(true));
            }
        } else {
            $this->session->setFlashdata('failed', 'ERROR: Opération non effectuée. Veuillez  vérifier ci-dessous les erreurs rencontrées puis réessayer !');
            $data['validation'] = $this->validator;
            $data['_view'] = ($this->segment->getSegment(3) == "update") ? ('app/finance/update/typesfrais') : ('app/finance/create/typesfrais');
            return view('layouts/app', $data);
        }
        return false;
    }

    function saveCaisse()
    {
        $data = [];
        $rulers = [
            'code_caisse' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Code obligatoire",
                ],
            ],
            'libelle_caisse' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Libelle obligatoire',
                ]
            ], 'type_caisse' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Type obligatoire',
                ]
            ],
        ];

        if ($this->validate($rulers)) {
            $code = trim(htmlspecialchars($this->request->getPost('code_caisse')));
            $libelle = trim(htmlspecialchars($this->request->getPost('libelle_caisse')));
            $type_caisse = trim(htmlspecialchars($this->request->getPost('type_caisse')));
            $localisation = trim(htmlspecialchars($this->request->getPost('localisation_caisse')));

            $current_datetime = date('Y-m-d H:i:s');

            if ($this->segment->getSegment(3) == "create") {
                //generate uid random
                $random_uid_typefrais = $this->generateIdentifiant();

                //table data
                $prepareSaveData = [
                    'caisse_uid' => $random_uid_typefrais,
                    'caisse_code' => $code,
                    'caisse_libelle' => $libelle,
                    'caisse_type' => $type_caisse,
                    'caisse_localisation' => $localisation,
                    'caisse_statut' => 'actif',
                    'caisse_created_at' => $current_datetime,
                    'caisse_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                    'caisse_annee_uid' => $this->session->yearuid,
                    'caisse_ecole_uid' => $this->session->schooluid,
                ];
                //$this->displayResults($saveTypeFraisData);
                if ($this->modeldb->insert_data('ts_caisses', $prepareSaveData)) {
                    return redirect()->back()->with('success', "Creation: Opération effectuée avec succés");
                }

            } elseif ($this->segment->getSegment(3) == "update") {
                //update data
                $key_caisse_uid = $this->segment->getSegment(4);

                $updateTypeData = [
                    'caisse_code' => $code,
                    'caisse_libelle' => $libelle,
                    'caisse_type' => $type_caisse,
                    'caisse_localisation' => $localisation,
                    'caisse_observation' => htmlspecialchars($this->request->getPost('observation_caisse')),
                    'caisse_comment' => htmlspecialchars($this->request->getPost('commentaire_caisse')),
                    'caisse_updated_at' => $current_datetime,
                    'caisse_updated_by' => $this->session->fullname . ' - ' . $this->session->role,
                ];

                //update data in table
                if ($this->modeldb->update_data('ts_caisses', $updateTypeData, array('caisse_uid' => $key_caisse_uid))) {
                    return redirect()->back()->with('success', "Modification: Opération effectuée avec succés");
                }
                return false;
            } else {
                return redirect()->to(current_url(true));
            }
        } else {
            $data ['caisse'] = ($this->segment->getSegment(4)) ? $this->modeldb->fetch_row_data('ts_caisses', array('caisse_uid' => $this->segment->getSegment(4))) : '';

            //$this->session->setFlashdata('failed', 'ERROR: Opération non effectuée. Veuillez  vérifier ci-dessous les erreurs rencontrées puis réessayer !');
            $data['validation'] = $this->validator;
            $data['_view'] = ($this->segment->getSegment(3) == "update") ? ('app/finance/update/caisse') : ('app/finance/create/caisse');
            return view('layouts/app', $data);
        }
        return false;
    }

    function saveCompteBancaire()
    {
        $data = [];
        $rulers = [
            'numero_compte' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Numero obligatoire",
                ],
            ],
            'nom_banque' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nom obligatoire',
                ]
            ], 'type_compte' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Type obligatoire',
                ]
            ],
        ];

        if ($this->validate($rulers)) {
            $numero_compte = trim(htmlspecialchars($this->request->getPost('numero_compte')));
            $banque = trim(htmlspecialchars($this->request->getPost('nom_banque')));
            $type_compte = trim(htmlspecialchars($this->request->getPost('type_compte')));
            $comment = trim(htmlspecialchars($this->request->getPost('commentaire_compte')));

            $current_datetime = date('Y-m-d H:i:s');

            if ($this->segment->getSegment(3) == "create") {
                //generate uid random
                $random_uid_compte = $this->generateIdentifiant();

                //table data
                $prepareSaveData = [
                    'banque_uid' => $random_uid_compte,
                    'banque_nom' => $banque,
                    'compte_numero' => $numero_compte,
                    'compte_devise' => $type_compte,
                    'compte_comments' => $comment,
                    'compte_solde' => trim(htmlspecialchars($this->request->getPost('montant_compte'))),
                    'compte_total_entree' => trim(htmlspecialchars($this->request->getPost('montant_compte'))),
                    'compte_statut' => 'actif',
                    'compte_created_at' => $current_datetime,
                    'compte_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                    'compte_annee_uid' => $this->session->yearuid,
                    'compte_ecole_uid' => $this->session->schooluid,
                ];
                //$this->displayResults($saveTypeFraisData);
                if ($this->modeldb->insert_data('ts_banques', $prepareSaveData)) {
                    return redirect()->back()->with('success', "Creation compte: Opération effectuée avec succés");
                }

            } elseif ($this->segment->getSegment(3) == "update") {
                //update data
                $key_compte_bancaire_uid = $this->segment->getSegment(4);

                $updateTypeData = [
                    'banque_nom' => $banque,
                    'compte_numero' => $numero_compte,
                    'compte_devise' => $type_compte,
                    'compte_comments' => $comment,
                    'compte_statut' => 'actif',
                    'compte_updated_at' => $current_datetime,
                    'compte_updated_by' => $this->session->fullname . ' - ' . $this->session->role,
                ];

                //update data in table
                if ($this->modeldb->update_data('ts_banques', $updateTypeData, array('banque_uid' => $key_compte_bancaire_uid))) {
                    return redirect()->back()->with('success', "Modification Compte: Opération effectuée avec succés");
                }
                return false;
            } else {
                return redirect()->to(current_url(true));
            }
        } else {
            $data ['compte'] = ($this->segment->getSegment(4)) ? $this->modeldb->fetch_row_data('ts_banques', array('banque_uid' => $this->segment->getSegment(4))) : '';

            $this->session->setFlashdata('failed', 'ERROR: Opération non effectuée. Veuillez  vérifier ci-dessous les erreurs rencontrées puis réessayer !');
            $data['validation'] = $this->validator;
            $data['_view'] = ($this->segment->getSegment(3) == "update") ? ('app/finance/update/banque') : ('app/finance/create/banque');
            return view('layouts/app', $data);
        }
        return false;
    }

    function savePaymentFrais()
    {
        //$qty = ($this->request->getPost('qtyfrais'))?$this->request->getPost('qtyfrais'):1;

        $caisse_ecole = $this->request->getPost('caisse_uid_payment');
        if (empty($caisse_ecole)) {
            $this->session->setFlashdata('failed', "Vous devez d'abord créer au moins une caisse dans la rubrique Finance / Caisse");
            return redirect()->back()->withInput();
        } else {
            $code_reference = $this->request->getPost('code_payment');
            $etudiant = $this->request->getPost('etudiant_uid_payment');
            $typefrais_uid = $this->request->getPost('typefrais_uid_payment');

            $mois_choisi = strtolower($this->request->getPost('mois_uid_payment'));

            $taux_jour = $this->request->getPost('taux_journalier');
            $numero_recu = $this->request->getPost('numero_recu');
            $date_recu = $this->request->getPost('date_paiement');
            $montant_dollars = ($this->request->getPost('montant_versement_usd'));
            $montant_francs = $this->request->getPost('montant_versement_cdf');
            $montant_solde_dollars = $this->request->getPost('solde_dollars');
            $montant_total_francs = 0;

            if ((!empty($montant_francs)) && (!empty($montant_solde_dollars))) {
                $montant_total_francs = $montant_francs + $montant_solde_dollars;
            } else {
                $montant_total_francs = (!empty($montant_francs)) ? $montant_francs : $montant_solde_dollars;
            }

            //$this->displayResults($montant_total_francs);

            $annee = $this->session->yearuid;   #GET YEAR UID
            $ecole = $this->session->schooluid;     #GET SCHOOL UID

            //set uid session
            $this->session->set('etudiant', $etudiant);
            $this->session->set('frais', $typefrais_uid);
            $this->session->set('caisse', $caisse_ecole);

            $mois = '';
            if ($mois_choisi == 'none') {
                switch (date('m')) {
                    case '01':
                        $mois = 'janvier';
                        break;
                    case '02':
                        $mois = 'fevrier';
                        break;
                    case '03':
                        $mois = 'mars';
                        break;
                    case '04':
                        $mois = 'avril';
                        break;
                    case '05':
                        $mois = 'mai';
                        break;
                    case '06':
                        $mois = 'juin';
                        break;
                    case '07':
                        $mois = 'juillet';
                        break;
                    case '08':
                        $mois = 'aout';
                        break;
                    case '09':
                        $mois = 'septembre';
                        break;
                    case '10':
                        $mois = 'octobre';
                        break;
                    case '11':
                        $mois = 'novembre';
                        break;
                    case '12':
                        $mois = 'decembre';
                        break;

                    default:
                        // code...
                        break;
                }
            } else {
                $mois = $mois_choisi;
            }
            $mode_paiement = "cash";

            $data['taux'] = $this->modeldb->fetch_row_data('ts_taux', array('taux_statut' => 'actif', 'taux_ecole_uid' => $ecole));

            if (!empty($etudiant) && !empty(session()->recu)) {

                $student = $this->modeldb->fetch_join_inscription(array('etudiant_uid' => $etudiant), 'inscription_created_at', 'row');

                $this->session->set('etudiantmatricule', $student['etudiant_matricule']);
                $this->session->set('etudiantpromotion', $student['promotion_libelle']);

                //GET ALL DETAILS PAYMENT BY date and etudiant UID
                $data['paiements_etudiants'] = $this->modeldb->fetch_report_versments(array('recu_etudiant_uid' => $etudiant, 'payment_statut !=' => 'inactif', 
                'payment_date' => date('Y-m-d'), 'recu_numero_uid' => session()->recu), null,
                'typesfrai_libelle', 'ASC', 'payment_uid', FALSE);
            }

            $data['etudiants'] = $this->modeldb->fetch_join_inscription(array('ts_etudiants.etudiant_statut' => 'actif', 'etudiant_ecole_uid' => $ecole, 'inscription_annee_uid' => $annee), 'inscription_created_at');
            $data ['typesfrais'] = $this->modeldb->fetch_join_typesfrais(array('ts_typesfrais.typesfrai_statut' => 'actif', 'typesfrai_ecole_uid' => $ecole), 'typesfrai_created_at');
            $data ['mois'] = $this->modeldb->fetch_all_data('ts_mois', array('mois_statut' => 'actif'), 'ordre_mois', null, null, 'ASC');
            $data ['caisses'] = $this->modeldb->fetch_all_data('ts_caisses', array('caisse_statut' => 'actif', 'caisse_ecole_uid' => $ecole), 'caisse_created_at');

            /**
             * ================================= Infos Types frais ==================================
             * ============================================================================================
             */
            $frais_exige = $this->modeldb->fetch_row_data('ts_typesfrais', array('typesfrai_uid' => $typefrais_uid));

            $montant_frais_db = $frais_exige['typesfrai_montant'];
            $devise_frais_db = $frais_exige['typesfrai_devise'];
            $montant_complet_db = ($devise_frais_db == 'USD') ? ($montant_frais_db * $taux_jour) : $montant_frais_db;
            $libelle_frais = strtolower($frais_exige['typesfrai_nature']);

            //get all payments 
            $paiements = $this->modeldb->fetch_report_versments(array('recu_etudiant_uid' => $etudiant, 'payment_statut !=' =>'inactif', 
                'payment_annee_uid' => $annee), null,'typesfrai_libelle', 'ASC', 'payment_uid', FALSE);
            
            
            $paiement_frais = FALSE;
            $paiement_mois = FALSE;
            if (!empty($paiements)) {
                foreach ($paiements as $paiement_etudiant) {
                    if (($libelle_frais == "minerval") AND ($paiement_etudiant['payment_mois_uid'] == $mois)) {
                        $paiement_mois = TRUE;
                    }
                    if (($paiement_etudiant['payment_frais_uid'] == $typefrais_uid) AND ($paiement_etudiant['payment_annee_uid'] == $annee)) {
                        $paiement_frais = TRUE;
                    }
                }
            }

            //VERIFICATION DU RESTE
            $montant_paye = $montant_total_francs;
            $montant_restant = ($montant_complet_db - $montant_paye);
            $statut_paiement = ($montant_restant == 0) ? "validé" : "amorcé";

            //$this->displayResults($statut_paiement);

            //si le montant verse par l'etudiant est superieur ou egal au montant exige ou encore correspond a la moitie
            // du montant demande ou de frais choisi alors enregistre
            //AND ($montant_paye <= $montant_complet_db * 1)
            //if (($montant_paye <= $montant_complet_db)) {

                //details paiement
                $data_details_payments = [
                    'payment_uid' => $this->generateIdentifiant(),
                    'payment_code' => $code_reference,
                    'payment_date' => date('Y-m-d'),
                    'payment_frais_uid' => $typefrais_uid,
                    'payment_mois_uid' => $mois,
                    'payment_annee_uid' => $annee,
                    'payment_ecole_uid' => $ecole,
                    'payment_numero_recu' => $numero_recu,
                    'payment_montant_paye' => $montant_paye,
                    'payment_montant_restant' => $montant_restant,
                    'payment_montant_complet' => $montant_complet_db,
                    'payment_dollars' => $montant_dollars,
                    'payment_francs' => $montant_francs,
                    'payment_mode' => $mode_paiement,
                    'payment_statut' => $statut_paiement,
                    'payment_devise' => 'CDF',
                    'payment_taux' => $taux_jour,
                    'payment_created_at' => date('Y-m-d H:i:s'),
                    'payment_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                ];

                //verifier si c'est le minerval
                //if ((($libelle_frais != "minerval") AND (!$paiement_frais)) OR (($libelle_frais == "minerval") AND (!$paiement_mois))) {
                
                //if (((!$paiement_frais)) OR ((!$paiement_mois))) {
                    $inscetudiantpromotion = $this->modeldb->fetch_row_data('ts_inscriptions', array('inscription_etudiant_uid' => $etudiant, 'inscription_annee_uid' => $annee));
                    $promotion_etudiant_db = $inscetudiantpromotion['inscription_promotion_uid'];
                    //entete paiement
                    $moisMinervaletudiant = $this->modeldb->fetch_all_data('ts_minerval', array('minerval_etudiant_uid' => $etudiant, 'minerval_annee_uid' => $annee));

                    if (!empty($moisMinervaletudiant)) {
                        $this->savePaymentMinerval($etudiant, $mois, $libelle_frais, $montant_paye);
                    } else {
                        $data_new_payments_minerval = [
                            'minerval_uid' => $this->generateIdentifiant(),
                            'minerval_etudiant_uid' => $etudiant,
                            'minerval_promotion_uid' => $promotion_etudiant_db,
                            'minerval_septembre' => ($mois == 'septembre' && $libelle_frais == "minerval") ? $montant_paye : 0,
                            'minerval_octobre' => ($mois == 'octobre' && $libelle_frais == "minerval") ? $montant_paye : 0,
                            'minerval_novembre' => ($mois == 'novembre' && $libelle_frais == "minerval") ? $montant_paye : 0,
                            'minerval_decembre' => ($mois == 'decembre' && $libelle_frais == "minerval") ? $montant_paye : 0,
                            'minerval_janvier' => ($mois == 'janvier' && $libelle_frais == "minerval") ? $montant_paye : 0,
                            'minerval_fevrier' => ($mois == 'fevrier' && $libelle_frais == "minerval") ? $montant_paye : 0,
                            'minerval_mars' => ($mois == 'mars' && $libelle_frais == "minerval") ? $montant_paye : 0,
                            'minerval_avril' => ($mois == 'avril' && $libelle_frais == "minerval") ? $montant_paye : 0,
                            'minerval_mai' => ($mois == 'mais' && $libelle_frais == "minerval") ? $montant_paye : 0,
                            'minerval_juin' => ($mois == 'juin' && $libelle_frais == "minerval") ? $montant_paye : 0,
                            'minerval_juillet' => ($mois == 'juillet' && $libelle_frais == "minerval") ? $montant_paye : 0,
                            'minerval_aout' => ($mois == 'aout' && $libelle_frais == "minerval") ? $montant_paye : 0,
                            'minerval_created_at' => date('Y-m-d H:i:s'),
                            'minerval_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                            'minerval_annee_uid' => $annee,
                            'minerval_ecole_uid' => $ecole,
                        ];
                        $this->modeldb->insert_data('ts_minerval', $data_new_payments_minerval);
                    }

                    //check if purchase number exist
                    if (!empty(session()->recu)) {

                        $entete = $this->modeldb->fetch_row_data('ts_entetespayments', array('recu_numero_uid' => session()->recu));
                        // update recu paiement
                        $data_entetes_payments_updated = [
                            'recu_montant' => (!empty($entete['recu_montant'])) ? $entete['recu_montant'] + $montant_paye : $montant_paye,
                            'recu_updated_at' => date('Y-m-d H:i:s'),
                            'recu_updated_by' => $this->session->fullname . ' - ' . $this->session->role,
                        ];

                        //update montant
                        $this->modeldb->update_data('ts_entetespayments', $data_entetes_payments_updated, array('recu_numero_uid' => session()->recu));
                    } else {
                        //create new recu
                        $data_entetes_payments = [
                            'recu_numero_uid' => $numero_recu,
                            'recu_etudiant_uid' => $etudiant,
                            'recu_promotion_uid' => $promotion_etudiant_db,
                            'recu_date' => date('Y-m-d'),
                            'recu_annee_uid' => $annee,
                            'recu_caisse_uid' => $caisse_ecole,
                            'recu_ecole_uid' => $ecole,
                            'recu_montant' => $montant_paye,
                            'recu_created_at' => date('Y-m-d H:i:s'),
                            'recu_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                        ];
                        //insert new recu
                        if ($this->modeldb->insert_data('ts_entetespayments', $data_entetes_payments)) {
                            //put number to session
                            $this->session->set('recu', $numero_recu);
                        }
                    }
                    if ($this->modeldb->insert_data('ts_detailspayments', $data_details_payments)) {

                        $this->updateCaisse($caisse_ecole, $montant_paye);

                        return redirect()->back()->with('success', "Opération effectuée. Le paiement a été $statut_paiement avec succès!");
                    } else {
                        $this->session->setFlashdata('failed', "Une erreur systeme a été rencontrée lors de l'enregistrement de ce paiement. Réessayer !");
                        return redirect()->back()->withInput();
                    }
                /*} else {
                    $this->session->setFlashdata('failed', "L'étudiant a déjà payé le frais $libelle_frais correspondant!");
                    return redirect()->back()->withInput();
                }*/
            /*} else {
                $this->session->setFlashdata('failed', "ERROR:Incohérence entre le  montant fixé et le montant payé de frais $libelle_frais. Le montant versé doit etre la moitié ou complet de frais exigé");
                return redirect()->back()->withInput();
            }*/
        }//end check if caisse existe
    }
    
    function cancelItemPayment($reference)
    {
        if (!empty($reference)) {

            $infosPayments = $data['payments'] = $this->modeldb->fetch_report_payments(
                array('payment_uid' => $reference), null, 'typesfrai_libelle', 'ASC', 'payment_uid', TRUE); 
            
            //$this->modeldb->fetch_row_data('vs_detailspayments', array('payment_uid' => $reference));

            $uidcaisse = $infosPayments['recu_caisse_uid'];

            $infosCaisse = $this->modeldb->fetch_row_data('ts_caisses', array('caisse_uid' => $uidcaisse));

            $montant_paye_db = $infosPayments['payment_montant_paye'];
            $recu_montant = $infosPayments['recu_montant'];
            $caisse_total_entree = $infosCaisse['caisse_total_entree'];

            $recu_solde = $recu_montant - $montant_paye_db; //calculer le solde courant
            $caisse_solde = $caisse_total_entree - $montant_paye_db; //calculer le solde courant

            $data_recu_updated = compact('recu_montant');
            $data_caisse_updated = compact('caisse_total_entree');
            $data_payment_updated = ['payment_statut' => 'inactif'];

            if ($this->modeldb->update_data('ts_detailspayments', $data_payment_updated, ['payment_uid' => $reference])) {
                //update cost recu
                $this->modeldb->update_data('ts_entetespayments', $data_recu_updated, ['recu_numero_uid' => $infosPayments['recu_numero_uid']]);
                //update cost caisse
                $this->modeldb->update_data('ts_caisses', $data_caisse_updated, ['caisse_uid' => $uidcaisse]);

                $this->session->setFlashdata('success', "Paiement annulé avec succès !");
            }
        }
        return redirect()->back()->withInput();
    }

    function updateCaisse($caisse_ecole, $montant_paye)
    {
        if (!empty($caisse_ecole)) {
            $caisse = $this->modeldb->fetch_row_data('ts_caisses', array('caisse_uid' => $caisse_ecole));
            $caisse_total_entree = $caisse['caisse_total_entree'] + $montant_paye; //incrementer le total des entrees
            $caisse_solde = $caisse_total_entree - $caisse['caisse_total_sortie']; //calculer le solde courant
            $data_caisse_ecole = compact('caisse_total_entree', 'caisse_solde');
            if (!empty($caisse_ecole)) {
                $this->modeldb->update_data('ts_caisses', $data_caisse_ecole, ['caisse_uid' => $caisse_ecole]);
            }
        } else {
            return redirect()->back()->withInput();
        }
    }

    function savePaymentMinerval($etudiant, $mois, $libelle_frais, $montant_paye)
    {

        $annee = $this->session->yearuid;   #GET YEAR UID
        $ecole = $this->session->schooluid;     #GET SCHOOL UID


        $infosetudiant = $this->modeldb->fetch_row_data('ts_inscriptions',
            array('inscription_etudiant_uid' => $etudiant, 'inscription_annee_uid' => $annee));

        $moisMinervaletudiant = $this->modeldb->fetch_all_data('ts_minerval',
            array('minerval_etudiant_uid' => $etudiant, 'minerval_annee_uid' => $annee, 'minerval_ecole_uid' => $ecole));
        $newPayment = false;
        if (!empty($moisMinervaletudiant)) {

            foreach ($moisMinervaletudiant as $key => $value) {
                if ($value['minerval_etudiant_uid'] == $etudiant && $value['minerval_annee_uid'] == $annee) {
                    // update data

                    $janvier = ($mois == 'janvier' && $libelle_frais == "minerval") ? $montant_paye + $value['minerval_janvier'] : $value['minerval_janvier'];

                    $fevrier = ($mois == 'fevrier' && $libelle_frais == "minerval") ? $montant_paye + $value['minerval_fevrier'] : $value['minerval_fevrier'];

                    $mars = ($mois == 'mars' && $libelle_frais == "minerval") ? $montant_paye + $value['minerval_mars'] : $value['minerval_mars'];

                    $decembre = ($mois == 'decembre' && $libelle_frais == "minerval") ? $montant_paye + $value['minerval_decembre'] : $value['minerval_decembre'];

                    $novembre = ($mois == 'novembre' && $libelle_frais == "minerval") ? $montant_paye + $value['minerval_novembre'] : $value['minerval_novembre'];

                    $octobre = ($mois == 'octobre' && $libelle_frais == "minerval") ? $montant_paye + $value['minerval_octobre'] : $value['minerval_octobre'];

                    $septembre = ($mois == 'septembre' && $libelle_frais == "minerval") ? $montant_paye + $value['minerval_septembre'] : $value['minerval_septembre'];

                    $avril = ($mois == 'avril' && $libelle_frais == "minerval") ? $montant_paye + $value['minerval_avril'] : $value['minerval_avril'];

                    $mai = ($mois == 'mai' && $libelle_frais == "minerval") ? $montant_paye + $value['minerval_mai'] : $value['minerval_mai'];

                    $juin = ($mois == 'juin' && $libelle_frais == "minerval") ? $montant_paye + $value['minerval_juin'] : $value['minerval_juin'];

                    $juillet = ($mois == 'juillet' && $libelle_frais == "minerval") ? $montant_paye + $value['minerval_juillet'] : $value['minerval_juillet'];
                    $aout = ($mois == 'aout' && $libelle_frais == "minerval") ? $montant_paye + $value['minerval_aout'] : $value['minerval_aout'];


                    $data_update_payments_minerval = [
                        'minerval_septembre' => $septembre,
                        'minerval_octobre' => $octobre,
                        'minerval_novembre' => $novembre,
                        'minerval_decembre' => $decembre,
                        'minerval_janvier' => $janvier,
                        'minerval_fevrier' => $fevrier,
                        'minerval_mars' => $mars,
                        'minerval_avril' => $avril,
                        'minerval_mai' => $mai,
                        'minerval_juin' => $juin,
                        'minerval_juillet' => $juillet,
                        'minerval_aout' => $aout,
                        'minerval_updated_at' => date('Y-m-d H:i:s'),
                        'minerval_updated_by' => $this->session->fullname . ' - ' . $this->session->role,
                    ];

                    if ($this->modeldb->update_data('ts_minerval', $data_update_payments_minerval, array('minerval_uid' => $value['minerval_uid']))) {
                        return true;
                    }
                } else {

                    $data_new_payments_minerval = [
                        'minerval_uid' => $this->generateIdentifiant(),
                        'minerval_etudiant_uid' => $etudiant,
                        'minerval_promotion_uid' => $infosetudiant['inscription_promotion_uid'],
                        'minerval_septembre' => ($mois == 'septembre' && $libelle_frais == "minerval") ? $montant_paye : 0,
                        'minerval_octobre' => ($mois == 'octobre' && $libelle_frais == "minerval") ? $montant_paye : 0,
                        'minerval_novembre' => ($mois == 'novembre' && $libelle_frais == "minerval") ? $montant_paye : 0,
                        'minerval_decembre' => ($mois == 'decembre' && $libelle_frais == "minerval") ? $montant_paye : 0,
                        'minerval_janvier' => ($mois == 'janvier' && $libelle_frais == "minerval") ? $montant_paye : 0,
                        'minerval_fevrier' => ($mois == 'fevrier' && $libelle_frais == "minerval") ? $montant_paye : 0,
                        'minerval_mars' => ($mois == 'mars' && $libelle_frais == "minerval") ? $montant_paye : 0,
                        'minerval_avril' => ($mois == 'avril' && $libelle_frais == "minerval") ? $montant_paye : 0,
                        'minerval_mai' => ($mois == 'mais' && $libelle_frais == "minerval") ? $montant_paye : 0,
                        'minerval_juin' => ($mois == 'juin' && $libelle_frais == "minerval") ? $montant_paye : 0,
                        'minerval_juillet' => ($mois == 'juillet' && $libelle_frais == "minerval") ? $montant_paye : 0,
                        'minerval_aout' => ($mois == 'aout' && $libelle_frais == "minerval") ? $montant_paye : 0,
                        'minerval_created_at' => date('Y-m-d H:i:s'),
                        'minerval_created_by' => $this->session->fullname . ' - ' . $this->session->role,

                        'minerval_annee_uid' => $annee,
                        'minerval_ecole_uid' => $ecole,
                    ];
                    if ($this->modeldb->insert_data('ts_minerval', $data_new_payments_minerval)) {
                        return true;
                    }

                }
            }//endforeach
        }
    }

    function savePaymentsCompleted()
    {
        $pay_uid = ($this->segment->getSegment(4)) ? $this->segment->getSegment(4) : '';
        $montant_percu_restant = $this->request->getPost('montant_restant');
        $numero_recu_paiement = $this->request->getPost('numero_recu_paiement');

        $agent = $this->session->fullname . ' - ' . $this->session->role;
        $annee = $this->session->yearuid;
        $ecole = $this->session->schooluid;

        if (!empty(session()->etudiant) && !empty(session()->recu)) {

            //GET ALL DETAILS PAYMENT BY date and etudiant UID
            $data['paiements_etudiants'] = $this->modeldb->fetch_report_versments(
                array('recu_etudiant_uid' => session()->etudiant, 'payment_statut !=' => 'inactif', 
                'payment_date' => date('Y-m-d') , 'recu_numero_uid' => session()->recu), null,
            'typesfrai_libelle', 'ASC', 'payment_uid');
            
        }

        if (!empty($pay_uid)) {
            /**
             * ================================= Infos Anciens Paiements etudiants ==================================
             * ============================================================================================
             */
            $paiements = $this->modeldb->fetch_row_data('ts_detailspayments', array('payment_uid' => $pay_uid));
            $entetes = $this->modeldb->fetch_row_data('ts_entetespayments', array('recu_numero_uid' => $paiements['payment_numero_recu']));

            $caisse_ecole = $entetes['recu_caisse_uid'];
            $montant_restant_db = $paiements['payment_montant_restant'];
            $montant_paye_db = $paiements['payment_montant_paye'];

            $caisse = $this->modeldb->fetch_row_data('ts_caisses', array('caisse_uid' => $caisse_ecole));


            if ($montant_percu_restant == $montant_restant_db) {

                $etudiant_db = $entetes['recu_etudiant_uid'];
                $promotion_etudiant_db = $entetes['recu_promotion_uid'];
                $mois_db = $paiements['payment_mois_uid'];
                $frais_db = $this->modeldb->fetch_field_value('ts_typesfrais', array('typesfrai_uid' => $paiements['payment_frais_uid']))->typesfrai_libelle; # GET FRAIS LIBELLE ;
                //save in minerval 
                $this->savePaymentMinerval($etudiant_db, $mois_db, $frais_db, $montant_percu_restant);

                //create new recu
                $data_entetes_payments = [
                    'recu_numero_uid' => $numero_recu_paiement,
                    'recu_etudiant_uid' => $etudiant_db,
                    'recu_promotion_uid' => $promotion_etudiant_db,
                    'recu_date' => date('Y-m-d'),
                    'recu_annee_uid' => $annee,
                    'recu_caisse_uid' => $caisse_ecole,
                    'recu_ecole_uid' => $ecole,
                    'recu_montant' => $montant_percu_restant,
                    'recu_created_at' => date('Y-m-d H:i:s'),
                    'recu_created_by' => $agent,
                ];

                //insert new recu
                if ($this->modeldb->insert_data('ts_entetespayments', $data_entetes_payments)) {
                    $this->session->set('recu', $numero_recu_paiement);

                    //details paiement
                    $data_details_payments = [
                        'payment_uid' => $this->generateIdentifiant(),
                        'payment_code' => date('YmdHis'),
                        'payment_date' => date('Y-m-d'),
                        'payment_frais_uid' => $paiements['payment_frais_uid'],
                        'payment_mois_uid' => $paiements['payment_mois_uid'],
                        'payment_annee_uid' => $annee,
                        'payment_ecole_uid' => $ecole,
                        'payment_numero_recu' => $numero_recu_paiement,
                        'payment_montant_paye' => $montant_percu_restant,
                        'payment_montant_restant' => 0,
                        'payment_montant_complet' => $paiements['payment_montant_complet'],
                        'payment_dollars' => 0,
                        'payment_francs' => $montant_percu_restant,
                        'payment_mode' => 'cash',
                        'payment_statut' => 'validé',
                        'payment_devise' => 'CDF',
                        'payment_taux' => $paiements['payment_taux'],
                        'payment_validation' => date('Y-m-d'),
                        'payment_created_at' => date('Y-m-d H:i:s'),
                        'payment_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                    ];
                    $this->modeldb->insert_data('ts_detailspayments', $data_details_payments);
                }
//$this->displayResults($data_entetes_payments);
                $data_new_payments = [
                    'payment_validation' => date('Y-m-d'),
                    //'payment_montant_paye' => $montant_percu_restant,
                    'payment_montant_restant' => 0,
                    //'payment_montant_complet' => $montant_paye_db + $montant_percu_restant,
                    'payment_statut' => 'validé',
                    'payment_date' => date('Y-m-d'),
                    'payment_updated_at' => date('Y-m-d H:i:s'),
                    'payment_updated_by' => $this->session->fullname . ' - ' . $this->session->role,
                ];
                if ($this->modeldb->update_data('ts_detailspayments', $data_new_payments, array('payment_uid' => $pay_uid))) {

                    /**
                     * =========================== Infos Caisses Ecoles =========================================
                     */
                    $this->updateCaisse($caisse_ecole, $montant_percu_restant);

                    #=========================end infos caisses========================================================
                    $this->session->setFlashdata('success', "Opération effectuée. Le paiement a été enregistré avec succès!");
                    return redirect()->back();
                } else {
                    $this->session->setFlashdata('failed', "Une erreur systeme a été rencontrée lors de l'enregistrement de ce paiement. Réessayer !");
                    return redirect()->back()->withInput();
                }
            } else {
                $this->session->setFlashdata('failed', "ERROR:Incohérence entre le  montant completé et le montant restant de frais correspondant.");
                return redirect()->back()->withInput();
            }
        }
        return redirect()->back();
    }

    function saveMouvement()
    {
        $ecole = isset($this->session->schooluid) ? $this->session->schooluid : '';

        $type_actions = ($this->segment->getSegment(3)) ? $this->segment->getSegment(3) : '';
        $montant_mvt_cdf = $this->request->getPost('montant_mvt_cdf');
        $montant_mvt_usd = $this->request->getPost('montant_mvt_usd');

        //$devise_mvt = $this->request->getPost('devise_mvt');
        $caisse_mvt = $this->request->getPost('caisse_uid_mvt');
        $type_mvt = $this->request->getPost('type_mvt');
        $libelle_mvt = $this->request->getPost('libelle_mvt');
        $code_mvt = $this->request->getPost('code_mvt');
        $nature_mvt = $this->request->getPost('nature_mvt');
        $motif_mvt = $this->request->getPost('motif_mvt');
        $current_datetime = date('Y-m-d h:i:s');

        $infosCaisse = $this->modeldb->fetch_row_data('ts_caisses', array('caisse_uid' => $caisse_mvt));

    
                $fraisDepensesData = array(
                    'mouvement_uid' => $this->generateIdentifiant(),
                    'mouvement_code' => $code_mvt,
                    'mouvement_libelle' => $libelle_mvt,
                    'montant_sorti_usd' => $montant_mvt_usd,
                    'montant_sorti_cdf' => $montant_mvt_cdf,
                    'mouvement_caisse_uid' => $caisse_mvt,
                    'mouvement_nature' => $nature_mvt,
                    'mouvement_type' => $type_mvt,
                    'mouvement_motif' => $motif_mvt,
                    'mouvement_statut' => 'actif',
                    'mouvement_date' => date('Y-m-d'),
                    'mouvement_created_at' => $current_datetime,
                    'mouvement_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                    'mouvement_annee_uid' => $this->session->yearuid,
                    'mouvement_ecole_uid' => $this->session->schooluid,
                );

                //check insert data
                if ($this->modeldb->insert_data('ts_mouvements_caisses', $fraisDepensesData)) {

                    /**
                     * =========================== Infos Caisses Ecoles =========================================
                     */
                    //$this->updateCaisse($caisse_mvt, $montant_mvt);

                    #=========================end infos caisses========================================================
                    $this->session->setFlashdata('success', "Opération effectuée. Le mouvement a été enregistré avec succès!");
                    return redirect()->back();
                } else {
                    $this->session->setFlashdata('failed', "Une erreur systeme a été rencontrée lors de l'enregistrement du mouvement. Réessayer !");
                    return redirect()->back()->withInput();
                }
                return redirect()->back()->withInput();
    }

    function changeMouvementStatus($status, $reference)
    {
        $status_update = ($status == "actif")?'inactif':'actif';
        //$this->displayResults()
        if (!empty($reference)) {
            $data_mvt_updated = ['mouvement_statut' => $status_update];
            
            if ($this->modeldb->update_data('ts_mouvements_caisses', $data_mvt_updated, ['mouvement_uid' => $reference])) {
                $this->session->setFlashdata('success', "Statut mouvement caisse changé avec succès !");
            }
        }
        return redirect()->back()->withInput();
    }
    function saveTaux()
    {
        if ($this->request->getMethod() == 'post') {
            $monnaie = trim(htmlspecialchars($this->request->getPost('monnaie_taux')));
            $valeur = trim(htmlspecialchars($this->request->getPost('valeur_taux')));
            $current_datetime = date('Y-m-d H:i:s');
            $random_uid_taux = $this->generateIdentifiant();
            //table data
            $saveTypeData = [
                'taux_uid' => $random_uid_taux,
                'taux_monnaie' => $monnaie,
                'taux_value' => $valeur,
                'taux_statut' => 'actif',
                'taux_date_ouverture' => date('Y-m-d'),
                'taux_created_at' => $current_datetime,
                'taux_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                'taux_annee_uid' => $this->session->yearuid,
                'taux_ecole_uid' => $this->session->schooluid,
            ];
            //save new data in table  '', ''
            $upStatus = ['taux_statut' => 'inactif', 'taux_date_cloture' => date('Y-m-d')];
            if ($this->modeldb->update_data('ts_taux', $upStatus, array('taux_statut' => 'actif'))) {
                $this->modeldb->insert_data('ts_taux', $saveTypeData);

                return redirect()->back()->with('success', "Taux enregistré avec succès !");
            } else
                return redirect()->back()->with('failed', "ERREUR: Désolé, une erreur systeme s'est produite. Veuillez réessayer plus tard.");
        }
    }


    
    function saveFonctionnement()
    {
        $ecole = isset($this->session->schooluid) ? $this->session->schooluid : '';

        $type_actions = ($this->segment->getSegment(3)) ? $this->segment->getSegment(3) : '';
        $montant_mvt = $this->request->getPost('montant_mvt');
        $devise_mvt = $this->request->getPost('devise_mvt');
        $caisse_mvt = $this->request->getPost('caisse_uid_mvt');
        $type_mvt = "expense";
        $libelle_mvt = $this->request->getPost('libelle_mvt');
        $code_mvt = $this->request->getPost('code_mvt');
        $montant_sorti = $this->request->getPost('montant_sorti');
        $devise_sorti = $this->request->getPost('montant_sorti_devise');
        $motif_mvt = $this->request->getPost('motif_mvt');
        $current_datetime = date('Y-m-d h:i:s');


        if (($type_actions == 'create')) {
            //autres recettes
            $autresRecettesData = array(
                'mouvement_uid' => $this->generateIdentifiant(),
                'mouvement_code' => $code_mvt,
                'mouvement_libelle' => $libelle_mvt,
                'mouvement_montant' => $montant_mvt,
                'mouvement_devise' => $devise_mvt,
                'mouvement_caisse_uid' => $caisse_mvt,
                'montant_sorti_cdf' => strtolower($devise_sorti == "CDF")?$montant_sorti:0,
                'montant_sorti_usd' => strtolower($devise_sorti == "USD")?$montant_sorti:0,
                'mouvement_type' => $type_mvt,
                'mouvement_comment' => $motif_mvt,
                'mouvement_statut' => 'actif',
                'mouvement_date' => date('Y-m-d'),
                'mouvement_created_at' => $current_datetime,
                'mouvement_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                'mouvement_annee_uid' => $this->session->yearuid,
                'mouvement_ecole_uid' => $this->session->schooluid,
            );
            if ($this->modeldb->insert_data('ts_mouvements_caisses', $autresRecettesData)) {
                #=========================end infos caisses========================================================
                $this->session->setFlashdata('success', "Opération effectuée. Le mouvement a été enregistré 
avec succès!");
                return redirect()->back();

            } else {
                $this->session->setFlashdata('failed', "Une erreur systeme a été rencontrée lors de 
l'enregistrement du mouvement. Réessayer !");
                return redirect()->back()->withInput();
            }

        } else {
            return redirect()->back()->withInput();
        }
    }
}
