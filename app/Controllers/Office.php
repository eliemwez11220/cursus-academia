<?php
namespace App\Controllers;

use CodeIgniter\Controller;
//import Models
use App\Models\AppModel;

class Office extends BaseController
{
	protected $session;
    protected $segment;
    protected $modeldb;

    function __construct()
    {
        //Load Services
        $this->session = session();
        $this->segment = \CodeIgniter\Config\Services::uri();
        //load helpers
        helper(['url', 'html', 'form', 'text', 'email', 'date', 'download', 'file', 'security', 'string']);
        //load generic model
        $this->modeldb = new AppModel();
    }
	public function index()
	{
	    $this->grille();
	}
	public function grille()
	{
         $annee = $this->session->yearuid;     #GET YEAR ID
        $ecole = $this->session->schooluid;   # GET SCHOOL ID
      
                if ($this->request->getGet('cls') && ($this->request->getGet('cls') !="all")) {
                    $promotion_filtre_etudiants = $this->request->getGet('cls');
                    $data['etudiants'] = $this->modeldb->fetch_join_inscription(array('ts_etudiants.etudiant_statut' => 'actif', 'etudiant_ecole_uid' => $ecole, 'inscription_promotion_uid' => $promotion_filtre_etudiants), 'inscription_created_at');

                    $data['promotion'] = $this->modeldb->fetch_join_promotions(
                        array('ts_promotions.promotion_uid' => $promotion_filtre_etudiants, 'promotion_ecole_uid' => $ecole), 'promotion_created_at', 'row');
                if($this->session->role == "enseignant" OR $this->session->groupe == "enseignants"){

                        $data['matieres'] = $this->modeldb->fetch_join_matieres(
                array('matiere_agent_uid' => $this->session->agenttoken, 'matiere_annee_uid' => $annee, 'promotion_uid' => $promotion_filtre_etudiants), 
                'branche_libelle');

 $data['cotes'] = $this->modeldb->fetch_join_cotes( 
         array('cote_deleted_at' => null, 'matiere_agent_uid' => $this->session->agenttoken, 'cote_annee_uid' => $annee, 
         'matiere_promotion_uid' => $promotion_filtre_etudiants), 'branche_libelle');
                    }else{
                         $data['cotes'] = $this->modeldb->fetch_join_cotes( 
         array('cote_deleted_at' => null, 'cote_ecole_uid' => $ecole, 'cote_annee_uid' => $annee, 
         'matiere_promotion_uid' => $promotion_filtre_etudiants), 'branche_libelle');
                    }
                    }
                
 $data['promotions'] = $this->modeldb->fetch_join_promotions(
                        array('ts_promotions.promotion_statut' =>'actif', 'promotion_ecole_uid' => $ecole), 'promotion_created_at');
               
$data['title'] = ucfirst("Grille de déliberation"); // Capitalize the first letter
        $data['_view'] = ('app/rapports/cursus/grille');
        echo view('layouts/app', $data);
	}
public function deliberation()
	{
         $annee = $this->session->yearuid;     #GET YEAR ID
        $ecole = $this->session->schooluid;   # GET SCHOOL ID
      
                if ($this->request->getGet('cls') && ($this->request->getGet('cls') !="all")) {
                    $promotion_filtre_etudiants = $this->request->getGet('cls');
                    
             
        
                    $data['etudiants'] = $this->modeldb->fetch_join_inscription(array('ts_etudiants.etudiant_statut' => 'actif', 'etudiant_ecole_uid' => $ecole, 'inscription_promotion_uid' => $promotion_filtre_etudiants), 'inscription_created_at');


                    if($this->session->role == "enseignant" OR $this->session->groupe == "enseignants"){

                        $data['matieres'] = $this->modeldb->fetch_join_matieres(
                array('matiere_agent_uid' => $this->session->agenttoken, 'matiere_annee_uid' => $annee, 'promotion_uid' => $promotion_filtre_etudiants), 
                'branche_libelle');
                
                $data['cotes'] = $this->modeldb->fetch_join_cotes( 
         array('cote_deleted_at' => null, 'matiere_agent_uid' => $this->session->agenttoken, 'cote_annee_uid' => $annee, 
         'matiere_promotion_uid' => $promotion_filtre_etudiants), 'branche_libelle');
                    }else{
                         $data['cotes'] = $this->modeldb->fetch_join_cotes( 
         array('cote_deleted_at' => null, 'cote_ecole_uid' => $ecole, 'cote_annee_uid' => $annee, 
         'matiere_promotion_uid' => $promotion_filtre_etudiants), 'branche_libelle');
                    }

                    $data['promotion'] = $this->modeldb->fetch_join_promotions(
                        array('ts_promotions.promotion_uid' => $promotion_filtre_etudiants, 'promotion_ecole_uid' => $ecole), 'promotion_created_at', 'row');
                   
                        $data['promotions_intables'] = $this->modeldb->fetch_join_promotions(
                        array('ts_promotions.promotion_uid' => $promotion_filtre_etudiants, 'promotion_ecole_uid' => $ecole), 
                        'promotion_created_at');
                
                    } else {
 $data['promotions_intables'] = $this->modeldb->fetch_join_promotions(
                        array('ts_promotions.promotion_statut' => 'actif', 'promotion_ecole_uid' => $ecole), 
                        'promotion_created_at');
                    }
 $data['promotions'] = $this->modeldb->fetch_join_promotions(
                        array('ts_promotions.promotion_statut' =>'actif', 'promotion_ecole_uid' => $ecole), 'promotion_created_at');
          

//$this->displayResults($data['cotes']);

$data['title'] = ucfirst("Grille de déliberation"); // Capitalize the first letter
        $data['_view'] = ('app/rapports/cursus/deliberation');
        echo view('layouts/app', $data);
	}
    
    public function students($typePage = null)
    {
        $ecole = $this->session->schooluid;   # GET SCHOOL ID
        $annee = ($this->request->getGet('yr')) ? $this->request->getGet('yr') : $this->session->yearuid;  #GET YEAR ID
        $promotion = ($this->request->getGet('cls')) ? $this->request->getGet('cls') : '';   # GET promotion ID

        $data = [];

        $data['dateChoosed'] = ($this->request->getGet('dayof')) ? $this->request->getGet('dayof') : date('Y-m-d');

        if (!empty($promotion) && $promotion != 'all') {

                $data['etudiants'] = $this->modeldb->fetch_join_inscription(array('inscription_ecole_uid' => $ecole, 'inscription_annee_uid' => $annee,
                    'etudiant_statut' => 'actif', 'inscription_promotion_uid' => $promotion), 'etudiant_matricule', null, null, null, null, "ASC");
            
            $data['promotionChoosed'] = $this->modeldb->fetch_join_promotions(array('ts_promotions.promotion_uid' => $promotion, 'promotion_ecole_uid' => $ecole), 'promotion_created_at', 'row');
        } else {

                $data ['etudiants'] = $this->modeldb->fetch_join_inscription(array('inscription_ecole_uid' => $ecole, 'inscription_annee_uid' => $annee,
                    'etudiant_statut' => 'actif'), 'etudiant_matricule', null, null, null, null, "ASC");
            
        }
       
        $data['annees'] = $this->modeldb->fetch_all_data('ts_annees', array('annee_deleted_at' => null), 'annee_libelle');

        $data['anneeChoosed'] = $this->modeldb->fetch_field_value('ts_annees', array('annee_uid' => $annee))->annee_libelle; # GET YEAR LIBELLE

        //toutes les promotions 
        $data['promotions'] = $this->modeldb->fetch_join_promotions(array('ts_promotions.promotion_statut' => 'actif', 'promotion_ecole_uid' => $ecole), 'cycle_libelle', null, "ASC");

        $data ['ecole'] = $this->modeldb->fetch_row_data('ts_ecoles', array('ecole_uid' => $ecole));
        $data ['cycles'] = $this->modeldb->fetch_all_data('ts_cycles', array('cycle_ecole_uid' => $ecole, 'cycle_statut' => 'actif'), 'cycle_libelle');

        $data ['title'] = ucfirst($typePage);
        $data ['_view'] = ('app/rapports/etudiants/listing');
        echo view('layouts/app', $data);
    }
}
