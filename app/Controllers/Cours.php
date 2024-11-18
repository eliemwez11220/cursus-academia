<?php
/**
 * Created by PhpStorm.
 * User: ElieMwezRubuz
 * Date: 10-May-21
 * Time: 11:54 AM
 */

namespace App\Controllers;

//import Models
use App\Models\AppModel;
//mail sending namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//mail files sending
require_once APPPATH . 'ThirdParty/PHPMailer/src/Exception.php';
require_once APPPATH . 'ThirdParty/PHPMailer/src/PHPMailer.php';
require_once APPPATH . 'ThirdParty/PHPMailer/src/SMTP.php';

class Cours extends BaseController
{
    protected $session;
    protected $segment;
    protected $modeldb;
    protected $validation;

    function __construct()
    {
        //Load Services
        $this->session = session();
        $this->segment = \CodeIgniter\Config\Services::uri();
        $this->validation = \CodeIgniter\Config\Services::validation();
        //load helpers
        helper(['url', 'html', 'form', 'text', 'email', 'date', 'download', 'file', 'security', 'string']);
        //load generic model
        $this->modeldb = new AppModel();
    }

    public function _remap($method, $param1 = null, $param2 = null, $param3 = null)
    {
        if (!session()->has('loggedIn')) {
            //echo 'Disconnect';
            return redirect()->to(base_url() . '/secure/disconnect');               // redirect to login page if not connected
        } else {

            if (method_exists($this, $method)) {
                return $this->$method($param1, $param2, $param3);
            } else {
                return $this->index();
            }
        }
    }

    public function index()
    {
        $this->view('matieres');
    }

    public function view($type = null)
    {
        $data = [];
        $ecole = $this->session->schooluid;   # GET SCHOOL ID
        $annee = $this->session->yearuid; # GET YEAR LIBELLE

        switch ($type) {
            case 'matieres':
                $data['matieres'] = $this->modeldb->fetch_join_matieres(array('ts_matieres.matiere_deleted_at' => null, 'matiere_ecole_uid' => $ecole, 'matiere_annee_uid' => $annee), 'matiere_created_at');
                break;
            case 'epreuves':
                $data['epreuves'] = $this->modeldb->fetch_join_epreuves(array('ts_epreuves.epreuve_deleted_at' => null, 'epreuve_ecole_uid' => $ecole, 'epreuve_annee_uid' => $annee), 'epreuve_created_at');
                break;
            case 'cotes':
               if($this->session->role == "enseignant" OR $this->session->groupe == "enseignants"){


 $data['cotes'] = $this->modeldb->fetch_join_cotes( 
         array('cote_deleted_at' => null, 'matiere_agent_uid' => $this->session->agenttoken, 'cote_annee_uid' => $annee), 'branche_libelle');
                    }else{
                         $data['cotes'] = $this->modeldb->fetch_join_cotes( 
         array('cote_deleted_at' => null, 'cote_ecole_uid' => $ecole, 'cote_annee_uid' => $annee
         ), 'branche_libelle');
                    }
                break; 
            case 'maximas':
                $data['maximas'] = $this->modeldb->fetch_join_maximas(array('maxima_ecole_uid' => $ecole), 'maxima_created_at');      
                $data['cycles'] = $this->modeldb->fetch_all_data('ts_cycles', array('cycle_ecole_uid' => $ecole), 'cycle_created_at');
                break;
            default:
                null;
        }
         //$this->displayResults($data['epreuves']);
        $data['title'] = ucfirst("List - $type | School Web Application"); // Capitalize the first letter
        $data['_view'] = ('app/cours/listing/' . $type);
        echo view('layouts/app', $data);
    }

    public function details($type = null, $key_uid = null)
    {
        switch ($type) {
            case 'matiere':
                $data['matiere'] = $this->modeldb->fetch_join_matieres(array('ts_matieres.matiere_uid' => $key_uid), 'matiere_created_at', 'row');
                break;
            case 'epreuve':
                $data['epreuve'] = $this->modeldb->fetch_join_epreuves(array('ts_epreuves.epreuve_uid' => $key_uid), 'epreuve_created_at', 'row');
                break;
            case 'cote':
                $data['cote'] = $this->modeldb->fetch_row_data('vs_cotes_etudiants', array('cote_uid' => $key_uid));
                break;
            case 'maxima':
                $data['maxima'] = $this->modeldb->fetch_row_data('ts_maximas', array('maxima_uid' => $key_uid));
                break;
            default:
                null;
        }
        //$this->displayResults($data['filiere']);
        $data['title'] = ucfirst("$type  Details | School Web Application"); // Capitalize the first letter
        $data['_view'] = ('app/cours/details/' . $type);
        echo view('layouts/app', $data);
    }

    public function addForm($type = null, $mode = null)
    {
        //si annee est inactif, aucune creation n'est autorisee
        if($this->session->yearstatus == 'inactif'){
            return redirect()->back()->with('info', "Année Fermée: La création n'est pas autorisée sur une année fermée");
        }else{
        $data = [];
        $ecole = $this->session->schooluid;   # GET SCHOOL ID
        $annee_scolaire = $this->session->yearuid; # GET YEAR LIBELLE

       $data['promotions'] = $this->modeldb->fetch_join_promotions(array('ts_promotions.promotion_statut' => 'actif', 'promotion_ecole_uid' => $ecole), 'promotion_created_at');

        switch ($type) {
            case 'matiere':
                 $data['agents'] = $this->modeldb->fetch_join_agents(array('agent_statut' => 'actif', 'fonction_code' => 'enseignant','agent_ecole_uid' => $ecole), 'agent_created_at');
                
                //$data['agents'] = $this->modeldb->fetch_all_data('ts_agents', array('agent_statut' => 'actif', 'agent_ecole_uid' => $ecole), 'agent_created_at');
                $data['promotions'] = $this->modeldb->fetch_join_promotions(array('promotion_statut' => 'actif', 'promotion_ecole_uid' => $ecole), 'promotion_created_at');
                $data['branches'] = $this->modeldb->fetch_all_data('ts_branches', array('branche_statut' => 'actif', 'branche_ecole_uid' => $ecole), 'branche_created_at');
                //$data['maximas'] = $this->modeldb->fetch_all_data('ts_maximas', array('maxima_ecole_uid' => $ecole), 'maxima_created_at');
                break;
            case 'epreuve':
                $data['typesepreuves'] = $this->modeldb->fetch_all_data('ts_typesepreuves', array('typesepreuve_statut' => 'actif', 'typesepreuve_ecole_uid' => $ecole), 'typesepreuve_created_at');
                $data['periodes'] = $this->modeldb->fetch_all_data('ts_periodes', array('periode_statut' => 'actif'), 'periode_created_at');
                $data['branches'] = $this->modeldb->fetch_all_data('ts_branches', array('branche_statut' => 'actif', 'branche_ecole_uid' => $ecole), 'branche_created_at');
                break;

            case 'note':
                $data['agents'] = $this->modeldb->fetch_all_data('ts_agents', array('agent_statut' => 'actif', 'agent_ecole_uid' => $ecole), 'agent_created_at');
                $data['promotions'] = $this->modeldb->fetch_join_promotions(array('promotion_statut' => 'actif', 'promotion_ecole_uid' => $ecole), 'promotion_created_at');
                $data['branches'] = $this->modeldb->fetch_all_data('ts_branches', array('branche_statut' => 'actif', 'branche_ecole_uid' => $ecole), 'branche_created_at');
                break;
            case 'exercice':
                $data['notes'] = $this->modeldb->fetch_join_notes(array('ts_notes.note_statut' => 'actif', 'note_ecole_uid' => $ecole, 'note_annee_uid' => $annee_scolaire), 'note_created_at');
                break; case 'travaux':
            $data['exercices'] = $this->modeldb->fetch_join_exercices(array('ts_exercices.exercice_deleted_at' => null, 'exercice_ecole_uid' => $ecole, 'exercice_annee_uid' => $annee_scolaire), 'exercice_created_at');
            $data['etudiants'] = $this->modeldb->fetch_join_inscription(array('etudiant_statut' => 'actif', 'etudiant_ecole_uid' => $ecole, 'inscription_annee_uid' => $annee_scolaire), 'inscription_created_at');
            break;
            default:
                
            $data['etudiants'] = $this->modeldb->fetch_join_inscription(array('ts_etudiants.etudiant_statut' => 'actif', 'etudiant_ecole_uid' => $ecole, 'inscription_annee_uid' => $annee_scolaire), 'inscription_date');

           
            
            $data['periodes'] = $this->modeldb->fetch_all_data('ts_periodes', array('periode_statut' => 'actif', 'periode_type' =>'cotation'), 'periode_created_at', null, null, 'ASC');
            
            if($this->session->role == "enseignant" OR $this->session->groupe == "enseignants"){
 $data['matieres'] = $this->modeldb->fetch_join_matieres(array('matiere_agent_uid' => $this->session->agenttoken, 'matiere_ecole_uid' => $ecole, 
            'matiere_annee_uid' => $annee_scolaire), 'matiere_created_at');

 $data['cotes'] = $this->modeldb->fetch_join_cotes( 
         array('cote_deleted_at' => null, 'matiere_agent_uid' => $this->session->agenttoken, 
         'cote_annee_uid' => $annee_scolaire), 'branche_libelle');
                    }else{
                         $data['cotes'] = $this->modeldb->fetch_join_cotes( 
         array('cote_deleted_at' => null, 'cote_ecole_uid' => $ecole, 'cote_annee_uid' => $annee_scolaire
         ), 'branche_libelle');
          $data['matieres'] = $this->modeldb->fetch_join_matieres(array('matiere_ecole_uid' => $ecole, 
            'matiere_annee_uid' => $annee_scolaire), 'matiere_created_at');
                    }

            //$data['cotes'] = $this->modeldb->fetch_all_data('vs_cotes_etudiants', array('cote_deleted_at' => null, 'cote_ecole_uid' => $ecole, 'cote_annee_uid' => $annee_scolaire), 'cote_created_at');
                
        }

        $data['title'] = ucfirst("$type  Adding"); // Capitalize the first letter
        $data['_view'] = ($mode == 'online') ? ('app/online/create/' . $type) : ('app/cours/create/' . $type);
        echo view('layouts/app', $data);
    }}

    public function editForm($type = null, $key_uid = null, $mode = null)
    {
        //si annee est inactif, aucune creation n'est autorisee
        if($this->session->yearstatus == 'inactif'){
            return redirect()->back()->with('info', "Année Fermée: La Modification n'est pas autorisée sur une année fermée");
        }else{
        $data = [];
        $ecole = $this->session->schooluid;   # GET SCHOOL ID
        $annee_scolaire = $this->session->yearuid; # GET YEAR LIBELLE

        switch ($type) {
            case 'matiere':
                $data['agents'] = $this->modeldb->fetch_all_data('ts_agents', array('agent_statut' => 'actif', 'agent_ecole_uid' => $ecole), 'agent_created_at');
                $data['promotions'] = $this->modeldb->fetch_join_promotions(array('promotion_statut' => 'actif', 'promotion_ecole_uid' => $ecole), 'promotion_created_at');
                $data['branches'] = $this->modeldb->fetch_all_data('ts_branches', array('branche_statut' => 'actif', 'branche_ecole_uid' => $ecole), 'branche_created_at');
                $data['matiere'] = $this->modeldb->fetch_join_matieres(array('ts_matieres.matiere_uid' => $key_uid), 'matiere_created_at', 'row');
                $data['maximas'] = $this->modeldb->fetch_all_data('ts_maximas', array('maxima_ecole_uid' => $ecole), 'maxima_created_at');
                break;
            case 'epreuve':
                $data['typesepreuves'] = $this->modeldb->fetch_all_data('ts_typesepreuves', array('typesepreuve_statut' => 'actif', 'typesepreuve_ecole_uid' => $ecole), 'typesepreuve_created_at');
                $data['periodes'] = $this->modeldb->fetch_all_data('ts_periodes', array('periode_statut' => 'actif'), 'periode_created_at');
                $data['branches'] = $this->modeldb->fetch_all_data('ts_branches', array('branche_statut' => 'actif', 'branche_ecole_uid' => $ecole), 'branche_created_at');
                $data['epreuve'] = $this->modeldb->fetch_join_epreuves(array('ts_epreuves.epreuve_uid' => $key_uid), 'epreuve_created_at', 'row');
                break;
            case 'cote':

            $data['matieres'] = $this->modeldb->fetch_join_matieres(array('matiere_ecole_uid' => $ecole, 'matiere_annee_uid' => $annee_scolaire), 'matiere_created_at');

            $data['periodes'] = $this->modeldb->fetch_all_data('ts_periodes', array('periode_statut' => 'actif', 'periode_type' =>'cotation'), 'periode_created_at');

            $data['etudiants'] = $this->modeldb->fetch_join_inscription(array('etudiant_statut' => 'actif', 'etudiant_ecole_uid' => $ecole, 'inscription_annee_uid' => $annee_scolaire), 'inscription_created_at');

                $data['cote'] = $this->modeldb->fetch_row_data('ts_cotes', array('ts_cotes.cote_uid' => $key_uid), 'epreuve_created_at');
                break;
            case 'note':
                $data['agents'] = $this->modeldb->fetch_all_data('ts_agents', array('agent_statut' => 'actif', 'agent_ecole_uid' => $ecole), 'agent_created_at');
                $data['promotions'] = $this->modeldb->fetch_join_promotions(array('promotion_statut' => 'actif', 'promotion_ecole_uid' => $ecole), 'promotion_created_at');
                $data['branches'] = $this->modeldb->fetch_all_data('ts_branches', array('branche_statut' => 'actif', 'branche_ecole_uid' => $ecole), 'branche_created_at');
                $data['note'] = $this->modeldb->fetch_join_notes(array('ts_notes.note_uid' => $key_uid), 'note_created_at', 'row');
                break;
            case 'exercice':
                $data['exercice'] = $this->modeldb->fetch_join_exercices(array('ts_exercices.exercice_uid' => $key_uid), 'exercice_created_at', 'row');
                $data['notes'] = $this->modeldb->fetch_join_notes(array('ts_notes.note_deleted_at' => null, 'note_ecole_uid' => $ecole, 'note_annee_uid' => $annee_scolaire), 'note_created_at');
                break;
            case 'travaux':
                $data['travaux'] = $this->modeldb->fetch_join_travaux(array('ts_travaux.travaux_uid' => $key_uid), 'travaux_created_at', 'row');
                $data['exercices'] = $this->modeldb->fetch_join_exercices(array('ts_exercices.exercice_deleted_at' => null, 'exercice_ecole_uid' => $ecole, 'exercice_annee_uid' => $annee_scolaire), 'exercice_created_at');
                $data['etudiants'] = $this->modeldb->fetch_join_inscription(array('etudiant_statut' => 'actif', 'etudiant_ecole_uid' => $ecole, 'inscription_annee_uid' => $annee_scolaire), 'inscription_created_at');
                break;
            default:
                null;
        }
        //$this->displayResults($data['travaux']);
        $data['title'] = ucfirst("$type - Updating | School Web Application"); // Capitalize the first letter
        $data['_view'] = ($mode == 'online') ? ('app/online/update/' . $type) : ('app/cours/update/' . $type);
        echo view('layouts/app', $data);
    }}

    public function changeStatus($table = null, $status_value = null, $uid = null)
    {
        if(! empty($table)) {
           
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
public function remove($table = null, $uid = null)
    {
        if(! empty($table)) {
                $realnametable = 'ts_' . $table . 's';
                $real_uid = $table . '_uid';
                $status = $table . '_statut';
                $updated_time = $table . '_updated_at';
                $updated_by = $table . '_updated_by';
        }

        if ($this->modeldb->delete_data($realnametable, array($real_uid => $uid))) {
            return redirect()->back()->with('success', "Suppression effectuée avec succés");
        } else {
            return redirect()->back()->with('failed', "ERROR: Suppression non effectuée. Réessayer plus tard !");
        }
    }
    /**
     * @param null $type
     * @param null $mode_action
     */
    public function online($type = null, $mode_action = null)
    {
        $data = [];
        $ecole = $this->session->schooluid;   # GET SCHOOL ID
        $annee_scolaire = $this->session->yearuid; # GET YEAR LIBELLE
        if ($mode_action == 'detail') {
            $type_uid = $this->segment->getSegment(5);
            switch ($type) {
                case 'note':
                    $data['note'] = $this->modeldb->fetch_join_notes(array('ts_notes.note_uid' => $type_uid), 'note_created_at', 'row');
                    break;
                case 'exercice':
                    $data['exercice'] = $this->modeldb->fetch_join_exercices(array('ts_exercices.exercice_uid' => $type_uid), 'exercice_created_at', 'row');
                    break;
                case 'travaux':
                    $data['travaux'] = $this->modeldb->fetch_join_travaux(array('ts_travaux.travaux_uid' => $type_uid), 'travaux_created_at', 'row');
                    break;
                default:
                    null;
            }
        }else{
            //$teacher_uid = $this->session->usertoken;
            switch ($type) {
                case 'notes':
                    $data['notes'] = $this->modeldb->fetch_join_notes(array('ts_notes.note_deleted_at' => null, 'note_ecole_uid' => $ecole, 'note_annee_uid' => $annee_scolaire), 'note_created_at');
                    break;
                case 'exercices':
                    $data['exercices'] = $this->modeldb->fetch_join_exercices(array('ts_exercices.exercice_deleted_at' => null, 'exercice_ecole_uid' => $ecole, 'exercice_annee_uid' => $annee_scolaire), 'exercice_created_at');
                    break;
                case 'travaux':
                    $data['travaux'] = $this->modeldb->fetch_join_travaux(array('ts_travaux.travaux_deleted_at' => null, 'travaux_ecole_uid' => $ecole, 'travaux_annee_uid' => $annee_scolaire), 'travaux_created_at');
                    break;
                default:
                    null;
            }
        }

        //$this->displayResults($data['exercice']);
        $data['title'] = ucfirst("Online - $type | School Web Application"); // Capitalize the first letter
        $data['_view'] = ($mode_action == 'detail') ? ('app/online/detail/' . $type) :('app/online/' . $type);
        echo view('layouts/app', $data);
    }

    function saveAffectatonMatiere()
    {
        $rulers = [
            'titulaire_matiere' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "titulaire obligatoire",
                ],
            ],
            'branche' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'branche obligatoire',
                ]
            ], 'promotion' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'promotion obligatoire',
                ]
            ], 'credit_horaire' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Entrer le crédit horaire',
                ]
            ],'volume_horaire' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Entrer le volume horaire',
                ]
            ],
        ];

        $ecole = $this->session->schooluid;   # GET SCHOOL ID
        $annee = $this->session->yearuid; # GET YEAR LIBELLE
        if ($this->validate($rulers)) {
            if ($this->segment->getSegment(3) == "create") {

                 $matiere_branche_uid = $this->request->getPost('branche');
                 $titulaire_matiere = $this->request->getPost('titulaire_matiere');
                 $promotion_affec = $this->request->getPost('promotion');

                $affectation = $this->modeldb->fetch_all_data('ts_matieres', array('matiere_ecole_uid' => $ecole, 'matiere_annee_uid' => $annee), 'matiere_created_at');
                $branche_affectation = FALSE;
                $promotion_affectation = FALSE;
                    if (!empty($affectation)) {
                        foreach ($affectation as $valueMatiere) {
                            if (($valueMatiere['matiere_branche_uid'] == $matiere_branche_uid) AND ($valueMatiere['matiere_promotion_uid'] == $promotion_affec)) {
                                $branche_affectation = TRUE;
                                $promotion_affectation = TRUE;
                            }
                        }
                    }

                $nouvellePresenceData = [
                    'matiere_uid' => $this->generateIdentifiant(),
                    'matiere_agent_uid' => $titulaire_matiere,
                    'matiere_branche_uid' => $matiere_branche_uid,
                    'matiere_promotion_uid' => $promotion_affec,
                     'matiere_subtitle' => $this->request->getPost('subtitle'),
                    'matiere_credit_horaire' => $this->request->getPost('credit_horaire'),
                    'matiere_volume_horaire' => $this->request->getPost('volume_horaire'),
                    'matiere_ponderation' => $this->request->getPost('ponderation'),
                    //'matiere_ordre_bulletin' => $this->request->getPost('ordre_bulletin'),
                    'matiere_statut' => 'actif',
                    'matiere_created_at' => date('Y-m-d h:i:s'),
                    'matiere_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                    'matiere_annee_uid' => $this->session->yearuid,
                    'matiere_ecole_uid' => $this->session->schooluid,
                ];


                if ((!$promotion_affectation) AND (!$branche_affectation)) {

                    $this->modeldb->insert_data('ts_matieres', $nouvellePresenceData);
                    return redirect()->back()->with('success', "Création Matière: Opération effectuée  avec succès");
                } else {
                        return redirect()->back()->with('failed', "Cette matière est déjà affectée dans cette promotion. Changer de promotions");
                }

            } elseif ($this->segment->getSegment(3) == "update") {

                $random_uid = $this->segment->getSegment(4);
                $updateData = [
                    'matiere_subtitle' => $this->request->getPost('subtitle'),
                    'matiere_agent_uid' => $this->request->getPost('titulaire_matiere'),
                    'matiere_branche_uid' => $this->request->getPost('branche'),
                    'matiere_promotion_uid' => $this->request->getPost('promotion'),
                    'matiere_credit_horaire' => $this->request->getPost('credit_horaire'),
                    'matiere_volume_horaire' => $this->request->getPost('volume_horaire'),
                    'matiere_ponderation' => $this->request->getPost('ponderation'),
                    'matiere_comment' => $this->request->getPost('description_affectation'),
                    
                    'matiere_type' => $this->request->getPost('typemat'),
                    'matiere_updated_at' => date('Y-m-d h:i:s'),
                    'matiere_updated_by' => $this->session->fullname . ' - ' . $this->session->role,
                ];
                if ($this->modeldb->update_data('ts_matieres', $updateData, array('matiere_uid' => $random_uid))) {
                    return redirect()->back()->with('success', "Modification Matière: Opération effectuée  avec succès");
                } else {
                    return redirect()->back()->with('failed', "Erreur Modification Matière");
                }
            } else {
                return redirect()->back()->with('failed', "Aucune donnee n'a été selectionnée");
            }

        } else {
            $this->session->setFlashdata('failed', 'ERROR: Opération non effectuée. Veuillez  vérifier ci-dessous les erreurs rencontrées puis réessayer !');
            $data['validation'] = $this->validator;
            $data['_view'] = ($this->segment->getSegment(3) == "update") ? ('app/cours/update/matiere') : ('app/cours/create/matiere');
        }
        return view('layouts/app', $data);
    }  

    function saveMaxima()
    {
                if ($this->request->getPost('maxima_libelle') !='') {
            if ($this->segment->getSegment(3) == "create") {
                $nouvellePresenceData = [
                    'maxima_uid' => $this->generateIdentifiant(),
                    'maxima_libelle' => $this->request->getPost('maxima_libelle'),
                    'maxima_max_periode' => $this->request->getPost('max_periode'),
                    'maxima_max_examen' => $this->request->getPost('max_examen'),
                    'maxima_cycle_uid' => $this->request->getPost('cycle_sid_promotion'),
                    'maxima_statut' => 'actif',
                    'maxima_created_at' => date('Y-m-d h:i:s'),
                    'maxima_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                    'maxima_annee_uid' => $this->session->yearuid,
                    'maxima_ecole_uid' => $this->session->schooluid,
                ];
                if ($this->modeldb->insert_data('ts_maximas', $nouvellePresenceData)) {
                    return redirect()->back()->with('success', "Création maxima: Opération effectuée  avec succès");
                } else {
                    return redirect()->back()->with('failed', "Erreur Création maxima");
                }
            } elseif ($this->segment->getSegment(3) == "update") {

                $random_uid = $this->segment->getSegment(4);
                $updateData = [
                   'maxima_libelle' => $this->request->getPost('maxima_libelle'),
                    'maxima_max_periode' => $this->request->getPost('max_periode'),
                    'maxima_max_examen' => $this->request->getPost('max_examen'),
                    'maxima_cycle_uid' => $this->request->getPost('cycle_sid_promotion'),
                    'maxima_updated_at' => date('Y-m-d h:i:s'),
                    'maxima_updated_by' => $this->session->fullname . ' - ' . $this->session->role,
                ];
                if ($this->modeldb->update_data('ts_maximas', $updateData, array('maxima_uid' => $random_uid))) {
                    return redirect()->back()->with('success', "Modification maxima: Opération effectuée  avec succès");
                } else {
                    return redirect()->back()->with('failed', "Erreur Modification maxima");
                }
            } else {
                return redirect()->back()->withInput();
            }

        } else {
            $this->session->setFlashdata('failed', 'ERROR: Opération non effectuée. Veuillez  vérifier ci-dessous les erreurs rencontrées puis réessayer !');
            return redirect()->back()->withInput();
        }
    }

    function saveEpreuve()
    {
        $rulers = [
            'libelle_epreuve' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "libelle_epreuve obligatoire",
                ],
            ],
            'branche' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'branche obligatoire',
                ]
            ], 'type_epreuve' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'type_epreuve obligatoire',
                ]
            ], 'periode_epreuve' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'periode_epreuve obligatoire',
                ]
            ], 'numero_epreuve' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'numero_epreuve obligatoire',
                ]
            ],
        ];

        if ($this->validate($rulers)) {
            if ($this->segment->getSegment(3) == "create") {
                $nouvelleData = [
                    'epreuve_uid' => $this->generateIdentifiant(),
                    'epreuve_libelle' => $this->request->getPost('libelle_epreuve'),
                    'epreuve_branche_uid' => $this->request->getPost('branche'),
                    'epreuve_periode_uid' => $this->request->getPost('periode_epreuve'),
                    'epreuve_type_uid' => $this->request->getPost('type_epreuve'),
                    'epreuve_cote_max' => $this->request->getPost('cotes_max'),
                    'epreuve_numero' => $this->request->getPost('numero_epreuve'),
                    'epreuve_statut' => 'actif',
                    'epreuve_created_at' => date('Y-m-d h:i:s'),
                    'epreuve_date' => date('Y-m-d'),
                    'epreuve_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                    'epreuve_annee_uid' => $this->session->yearuid,
                    'epreuve_ecole_uid' => $this->session->schooluid,
                ];
                if ($this->modeldb->insert_data('ts_epreuves', $nouvelleData)) {
                    return redirect()->back()->with('success', "Création Epreuve: Opération effectuée  avec succès");
                } else {
                    return redirect()->back()->with('failed', "Erreur Création Epreuve");
                }
            } elseif ($this->segment->getSegment(3) == "update") {

                $random_uid = $this->segment->getSegment(4);
                $updateData = [
                    'epreuve_libelle' => $this->request->getPost('libelle_epreuve'),
                    'epreuve_branche_uid' => $this->request->getPost('branche'),
                    'epreuve_periode_uid' => $this->request->getPost('periode_epreuve'),
                    'epreuve_type_uid' => $this->request->getPost('type_epreuve'),
                    'epreuve_cote_max' => $this->request->getPost('cotes_max'),
                    'epreuve_numero' => $this->request->getPost('numero_epreuve'),

                    'epreuve_ponderation' => $this->request->getPost('ponderation_epreuve'),
                    'epreuve_lecon' => $this->request->getPost('lecon_epreuve'),
                    'epreuve_methode' => $this->request->getPost('methode_epreuve'),
                    'epreuve_duree_minute' => $this->request->getPost('duree_minute_epreuve'),
                    'epreuve_nombre_etudiants' => $this->request->getPost('nombre_etudiants_epreuve'),
                    'epreuve_nombre_questions' => $this->request->getPost('nombre_questions_epreuve'),
                    'epreuve_observation' => $this->request->getPost('observation_epreuve'),
                    'epreuve_description' => $this->request->getPost('description_epreuve'),

                    'epreuve_updated_at' => date('Y-m-d h:i:s'),
                    'epreuve_updated_by' => $this->session->fullname . ' - ' . $this->session->role,

                ];

                //$this->displayResults($updateData);
                if ($this->modeldb->update_data('ts_epreuves', $updateData, array('epreuve_uid' => $random_uid))) {
                    return redirect()->back()->with('success', "Modification Epreuve: Opération effectuée  avec succès");
                } else {
                    return redirect()->back()->with('failed', "Erreur Modification Epreuve");
                }
            } else {
                return redirect()->back()->with('failed', "Aucune donnee n'a été selectionnée");
            }

        } else {
            $this->session->setFlashdata('failed', 'ERROR: Opération non effectuée. Veuillez  vérifier ci-dessous les erreurs rencontrées puis réessayer !');
            $data['validation'] = $this->validator;
            $data['_view'] = ($this->segment->getSegment(3) == "update") ? ('app/cours/update/epreuve') : ('app/cours/create/epreuve');
        }
        return view('layouts/app', $data);
    }

    function saveCoteetudiant()
    {

        $data = [];
        $rulers = [
            'periode' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "periode obligatoire",
                ],
            ],
            'etudiant' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'etudiant obligatoire',
                ]
            ], 'cote_obtenue' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'cote_obtenue obligatoire',
                ]
            ],

             'matiere' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'matiere obligatoire',
                ]
            ],'type_cote' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'type_cote obligatoire',
                ]
            ],
        ];

        $ecole = $this->session->schooluid;   # GET SCHOOL ID
        $annee_scolaire = $this->session->yearuid; # GET YEAR LIBELLE
        
         $data['etudiants'] = $this->modeldb->fetch_join_inscription(array('ts_etudiants.etudiant_statut' => 'actif', 'etudiant_ecole_uid' => $ecole, 'inscription_annee_uid' => $annee_scolaire), 'inscription_date');

            $data['matieres'] = $this->modeldb->fetch_join_matieres(array('matiere_ecole_uid' => $ecole, 'matiere_annee_uid' => $annee_scolaire), 'matiere_created_at');

            $data['periodes'] = $this->modeldb->fetch_all_data('ts_periodes', array('periode_statut' => 'actif', 'periode_type' =>'cotation'), 'periode_created_at', null, null, 'ASC');

        $data['cotes'] = $this->modeldb->fetch_all_data('vs_cotes_etudiants', array('cote_deleted_at' => null, 'cote_ecole_uid' => $ecole, 'cote_annee_uid' => $annee_scolaire), 'cote_created_at');


        if ($this->validate($rulers)) {

            $this->session->set('etudiant', $this->request->getPost('etudiant'));

            if ($this->segment->getSegment(3) == "create") {

                 $cotesChecking = $this->modeldb->fetch_all_data('ts_cotes', array('cote_annee_uid' => $annee_scolaire, 'cote_ecole_uid' => $ecole), 'cote_created_at');

                $cote_matiere_uid = $this->request->getPost('matiere');
                $cote_periode_uid = $this->request->getPost('periode');
                $cote_etudiant_uid = $this->request->getPost('etudiant');
                $cote_obtenu = $this->request->getPost('cote_obtenue');

                $branche_cote = FALSE;
                $etudiant_cote = FALSE;
                $periode_cote = FALSE;
                    if (!empty($cotesChecking)) {
                        foreach ($cotesChecking as $cote) {
                            if (($cote['cote_matiere_uid'] == $cote_matiere_uid) AND ($cote['cote_periode_uid'] == $cote_periode_uid) AND ($cote['cote_etudiant_uid'] == $cote_etudiant_uid)) {
                                $branche_cote = TRUE;
                                $etudiant_cote = TRUE;
                                $periode_cote = TRUE;
                            }
                        }
                    }
               
                    $nouvelleData = [
                        'cote_uid' => $this->generateIdentifiant(),
                        'cote_type' => $this->request->getPost('type_cote'),
                        'cote_matiere_uid' => $cote_matiere_uid,
                        'cote_periode_uid' => $cote_periode_uid,
                        'cote_etudiant_uid' => $cote_etudiant_uid,
                        'cote_point_obtenu' => $cote_obtenu,
                        'cote_statut' => 'actif',
                        'cote_created_at' => date('Y-m-d h:i:s'),
                        'cote_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                        'cote_annee_uid' => $this->session->yearuid,
                        'cote_ecole_uid' => $this->session->schooluid,
                    ]; 
                if ((!$periode_cote) AND (!$etudiant_cote) AND (!$branche_cote)) {

                    if ($this->modeldb->insert_data('ts_cotes', $nouvelleData)) {

                        //add cotes bulletins
                        $this->saveCotesBulletins($cote_matiere_uid, $cote_etudiant_uid, $cote_periode_uid, $cote_obtenu);

                        return redirect()->back()->with('success', "Création cotation effectuée  avec succès");
                    } else {
                        return redirect()->back()->with('failed', "Erreur Création Cotation");
                    }
                } else {
                        return redirect()->back()->with('failed', "Cet étudiant est déjà coté dans cette matière");
                    }
            } elseif ($this->segment->getSegment(3) == "update") {

                $random_uid = $this->segment->getSegment(4);
                $updateData = [
                    'cote_matiere_uid' => $cote_matiere_uid,
                        'cote_periode_uid' => $cote_periode_uid,
                        'cote_etudiant_uid' => $cote_etudiant_uid,
                        'cote_point_obtenu' => $cote_obtenu,

                    'cote_point_bonus' => $this->request->getPost('cote_bonus'),

                    'cote_raison_bonus' => $this->request->getPost('cote_bonus_raison'),

                    'cote_point_obtenu' => $this->request->getPost('cote_obtenue'),

                    'cote_application' => $this->request->getPost('application_cote'),

                    'cote_observation' => $this->request->getPost('observation_cote'),

                    'cote_updated_at' => date('Y-m-d h:i:s'),
                    'cote_updated_by' => $this->session->fullname . ' - ' . $this->session->role,
                ];

                //$this->displayResults($updateData);
                if ($this->modeldb->update_data('ts_cotes', $updateData, array('cote_uid' => $random_uid))) {
                    return redirect()->back()->with('success', "Modification  effectuée  avec succès");
                } else {
                    return redirect()->back()->with('failed', "Erreur Modification ");
                }
            } else {
                return redirect()->back()->with('failed', "Aucune donnee n'a été selectionnée");
            }

        } else {
            $this->session->setFlashdata('failed', 'ERROR: Opération non effectuée. Veuillez  vérifier ci-dessous les erreurs rencontrées puis réessayer !');
            $data['validation'] = $this->validator;
            $data['_view'] = ($this->segment->getSegment(3) == "update") ? ('app/cours/update/cote') : ('app/cours/create/cote');
        }
        return view('layouts/app', $data);
    }
    function saveCotesBulletins($branche, $etudiant, $periode, $coteobtenu){
        
        $periodeinfos = $this->modeldb->fetch_row_data('ts_periodes', array('periode_uid' => $periode));
       //get session data
        $agent = $this->session->fullname . ' - ' . $this->session->role;
        $ecole = $this->session->schooluid;   # GET SCHOOL ID
        $annee = $this->session->yearuid; # GET YEAR LIBELLE
         //save cotes bulletins

        $codePer = $periodeinfos['periode_code'];
        $bulletinData = [ 
            'bulletin_uid' => $this->generateIdentifiant(),
            'bulletin_matiere_uid' => $branche,
            'bulletin_etudiant_uid' => $etudiant,
            'bulletin_promotion_uid' => session()->etudiantpromotionuid,

            'bulletin_cote_per1' => ($codePer == 'P1')?$coteobtenu:0,
            'bulletin_cote_per2' => ($codePer == 'P2')?$coteobtenu:0, 

            'bulletin_cote_per3' => ($codePer == 'P3')?$coteobtenu:0,
            'bulletin_cote_per4' => ($codePer == 'P4')?$coteobtenu:0,

            'bulletin_cote_exam1' => ($codePer == 'E1')?$coteobtenu:0, 
            'bulletin_cote_exam2' => ($codePer == 'E2')?$coteobtenu:0,

            'bulletin_created_by' => $agent, 
            'bulletin_updated_at' => date('Y-m-d h:i:s'),
            'bulletin_updated_by' => $agent,
            'bulletin_annee_uid' => $annee,
            'bulletin_ecole_uid' => $ecole
        ];

        $checkBulletinsCotes = $this->modeldb->fetch_all_data('ts_bulletins', array('bulletin_ecole_uid' => $ecole, 'bulletin_annee_uid' => $annee, 'bulletin_matiere_uid' => $branche, 'bulletin_etudiant_uid'=>$etudiant), 'bulletin_created_at');

            $branche_cote = FALSE;
            $etudiant_cote = FALSE;

         
            if (!empty($checkBulletinsCotes)) {
                foreach ($checkBulletinsCotes as $cote) {
                $bulletinUpdateData = [ 
            'bulletin_cote_per1' => ($codePer == 'P1')?$coteobtenu+$cote['bulletin_cote_per1']:$cote['bulletin_cote_per1'],
            'bulletin_cote_per2' => ($codePer == 'P2')?$coteobtenu+$cote['bulletin_cote_per2']:$cote['bulletin_cote_per2'],
            'bulletin_cote_per3' => ($codePer == 'P3')?$coteobtenu+$cote['bulletin_cote_per3']:$cote['bulletin_cote_per3'],
            'bulletin_cote_per4' => ($codePer == 'P4')?$coteobtenu+$cote['bulletin_cote_per4']:$cote['bulletin_cote_per4'],
            'bulletin_cote_exam1' => ($codePer == 'E1')?$coteobtenu+$cote['bulletin_cote_exam1']:$cote['bulletin_cote_exam1'],
            'bulletin_cote_exam2' => ($codePer == 'E2')?$coteobtenu+$cote['bulletin_cote_exam2']:$cote['bulletin_cote_exam2'],
                    'bulletin_updated_at' => date('Y-m-d h:i:s'),
                    'bulletin_updated_by' => $agent
                ];
                    $bull_update_criteres_db = array('bulletin_matiere_uid' => $branche, 'bulletin_etudiant_uid'=>$etudiant, 'bulletin_annee_uid' => $annee);
                    //update bulletin cotes 
                    $this->modeldb->update_data('ts_bulletins', $bulletinUpdateData, $bull_update_criteres_db);
                }
            }else{
                //insert cotes if empty in ts_bulletins
                $this->modeldb->insert_data('ts_bulletins', $bulletinData);
            } //endif empty cotes
        
    }
    function saveNoteCours()
    {
        $data = [];

        $ecole = $this->session->schooluid;   # GET SCHOOL ID
        $annee = $this->session->yearuid;   # GET YEAR ID
        $data['agents'] = $this->modeldb->fetch_all_data('ts_agents', array('agent_statut' => 'actif', 'agent_ecole_uid' => $ecole), 'agent_created_at');
        $data['promotions'] = $this->modeldb->fetch_join_promotions(array('promotion_statut' => 'actif', 'promotion_ecole_uid' => $ecole), 'promotion_created_at');
        $data['branches'] = $this->modeldb->fetch_all_data('ts_branches', array('branche_statut' => 'actif', 'branche_ecole_uid' => $ecole), 'branche_created_at');

        $rulers = [
            'enseignant' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "enseignant obligatoire",
                ],
            ],
            'branche' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'branche obligatoire',
                ]
            ], 'promotion' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'promotion obligatoire',
                ]
            ], 'titre_note' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'titre_note obligatoire',
                ]
            ],'contenu_note' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'contenu_note obligatoire',
                ]
            ],
        ];

        if ($this->validate($rulers)) {

            $fullpathdocument = '';
            $typeFileUpload='';
            $sizeFileUpload='';
            if ($this->request->getFile('document_note') != '') {
                $docFile = $this->request->getFile('document_note');
                //foreach($imagefile['images'] as $img){
                if ($docFile->isValid() && !$docFile->hasMoved()) {
                    //rename image
                    $newNameFileUpload = $docFile->getRandomName();
                    $typeFileUpload = $docFile->getClientExtension();
                    $sizeFileUpload = $docFile->getSize();
                    $fullPathFile = 'global/uploads/files';
                    //move to upload directory
                    $docFile->move(ROOTPATH . $fullPathFile, $newNameFileUpload);
                    $fullpathdocument = base_url() . '/' . $fullPathFile . '/' . $newNameFileUpload;
                }
            }

            $promotion_uid = $this->request->getPost('promotion');
            $contenu_note = $this->request->getPost('contenu_note');
            $titre_note = $this->request->getPost('titre_note');

            if ($this->segment->getSegment(3) == "create") {

              $nouvellePresenceData = [
                    'note_uid' => $this->generateIdentifiant(),
                    'note_enseignant_uid' => $this->request->getPost('enseignant'),
                    'note_branche_uid' => $this->request->getPost('branche'),
                    'note_promotion_uid' => $promotion_uid,
                    'note_contenu' => $contenu_note,
                    'note_titre' => $titre_note,
                    'note_document' => $fullpathdocument,
                    'note_filetype' => $typeFileUpload,
                    'note_filesize' => $sizeFileUpload,
                    'note_statut' => 'actif',
                    'note_created_at' => date('Y-m-d h:i:s'),
                    'note_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                    'note_annee_uid' => $annee,
                    'note_ecole_uid' => $ecole,
                ];
                if ($this->modeldb->insert_data('ts_notes', $nouvellePresenceData)) {
                  return redirect()->back()->with('success', "Création Note: Opération effectuée  avec succès");
                } else {
                    return redirect()->back()->with('failed', "Erreur Création Note");
                }
            } elseif ($this->segment->getSegment(3) == "update") {

                $random_uid = $this->segment->getSegment(4);
                $updateData = [
                    'note_enseignant_uid' => $this->request->getPost('enseignant'),
                    'note_branche_uid' => $this->request->getPost('branche'),
                    'note_promotion_uid' => $promotion_uid,
                    'note_contenu' => $contenu_note,
                    'note_titre' => $titre_note,
                    'note_document' => $fullpathdocument,
                    'note_filetype' => $typeFileUpload,
                    'note_filesize' => $sizeFileUpload,
                    'note_updated_at' => date('Y-m-d h:i:s'),
                    'note_updated_by' => $this->session->fullname . ' - ' . $this->session->role,
                ];
                if ($this->modeldb->update_data('ts_notes', $updateData, array('note_uid' => $random_uid))) {
                    return redirect()->back()->with('success', "Modification Note: Opération effectuée  avec succès");
                } else {
                    return redirect()->back()->with('failed', "Erreur Modification note");
                }
            } else {
                return redirect()->back()->with('failed', "Aucune donnee n'a été selectionnée");
            }
            //$allParents = $this->modeldb->fetch_all_data('ts_parents', array('parent_statut' =>'actif'), 'parent_created_at');
            //send email
             $allParents = $this->modeldb->fetch_all_data('ts_parents',
                            array('parent_statut' =>'actif', 'parent_tuteur_email !=' =>null), 'parent_created_at');
            
            if (! empty($allParents)) {
                 $etudiantsCyclesSelected = $this->modeldb->fetch_join_inscription(
                        array('promotion_uid' => $promotion_uid, 'etudiant_statut' => 'actif', 
                            'inscription_ecole_uid'=>$ecole, 'inscription_annee_uid'=>$annee), 'inscription_created_at');

                         // send by cycle selected 
                        foreach ($allParents as $parentCycle){
                            foreach ($etudiantsCyclesSelected as $etudiantCycle){
                                if ($etudiantCycle['etudiant_tuteur_uid'] == $parentCycle['parent_uid']) {
                                    //list of parents by cycle
                                    $this->sendMail($this->session->schoolname, $parentCycle['parent_tuteur_email'], $contenu_note, $titre_note, $fullpathdocument);
                                }
                            }
                        }  
                    }

        } else {
            $this->session->setFlashdata('failed', 'ERROR: Opération non effectuée. Veuillez  vérifier ci-dessous les erreurs rencontrées puis réessayer !');
            $data['validation'] = $this->validator;
            $data['_view'] = ($this->segment->getSegment(3) == "update") ? ('app/online/update/note') : ('app/online/create/note');
        }
        return view('layouts/app', $data);
    }
    function saveExercice()
    {
        $data = [];

        $ecole = $this->session->schooluid;   # GET SCHOOL ID
        $annee_scolaire = $this->session->yearuid;   # GET SCHOOL ID
        $data['notes'] = $this->modeldb->fetch_join_notes(array('ts_notes.note_statut' => 'actif', 'note_ecole_uid' => $ecole, 'note_annee_uid' => $annee_scolaire), 'note_created_at');

        $rulers = [
            'note_cours' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "note_cours obligatoire",
                ],
            ],
            'titre' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'titre obligatoire',
                ]
            ],'contenu' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'contenu obligatoire',
                ]
            ],
        ];

        if ($this->validate($rulers)) {

            $fullpathdocument = '';
            $typeFileUpload='';
            $sizeFileUpload='';
            if ($this->request->getFile('document') != '') {
                $docFile = $this->request->getFile('document');
                //foreach($imagefile['images'] as $img){
                if ($docFile->isValid() && !$docFile->hasMoved()) {
                    //rename image
                    $newNameFileUpload = $docFile->getRandomName();
                    $typeFileUpload = $docFile->getClientExtension();
                    $sizeFileUpload = $docFile->getSize();
                    $fullPathFile = 'global/uploads/files';
                    //move to upload directory
                    $docFile->move(ROOTPATH . $fullPathFile, $newNameFileUpload);
                    $fullpathdocument = base_url() . '/' . $fullPathFile . '/' . $newNameFileUpload;
                }
            }

            if ($this->segment->getSegment(3) == "create") {
                $nouvellePresenceData = [
                    'exercice_uid' => $this->generateIdentifiant(),
                    'exercice_note_uid' => $this->request->getPost('note_cours'),
                    'exercice_contenu' => $this->request->getPost('contenu'),
                    'exercice_titre' => $this->request->getPost('titre'),
                    'exercice_fichier' => $fullpathdocument,
                    'exercice_filetype' => $typeFileUpload,
                    'exercice_filesize' => $sizeFileUpload,
                    'exercice_statut' => 'actif',
                    'exercice_created_at' => date('Y-m-d h:i:s'),
                    'exercice_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                    'exercice_annee_uid' => $this->session->yearuid,
                    'exercice_ecole_uid' => $this->session->schooluid,
                ];
                if ($this->modeldb->insert_data('ts_exercices', $nouvellePresenceData)) {
                    return redirect()->back()->with('success', "Création exercice: Opération effectuée  avec succès");
                } else {
                    return redirect()->back()->with('failed', "Erreur Création exercice");
                }
            } elseif ($this->segment->getSegment(3) == "update") {

                $random_uid = $this->segment->getSegment(4);
                $updateData = [
                    'exercice_note_uid' => $this->request->getPost('note_cours'),
                    'exercice_contenu' => $this->request->getPost('contenu'),
                    'exercice_titre' => $this->request->getPost('titre'),
                    'exercice_fichier' => $fullpathdocument,
                    'exercice_filetype' => $typeFileUpload,
                    'exercice_filesize' => $sizeFileUpload,
                    'exercice_updated_at' => date('Y-m-d h:i:s'),
                    'exercice_updated_by' => $this->session->fullname . ' - ' . $this->session->role,
                ];
                if ($this->modeldb->update_data('ts_exercices', $updateData, array('exercice_uid' => $random_uid))) {
                    return redirect()->back()->with('success', "Modification exercice: Opération effectuée  avec succès");
                } else {
                    return redirect()->back()->with('failed', "Erreur Modification exercice");
                }
            } else {
                return redirect()->back()->with('failed', "Aucune donnee n'a été selectionnée");
            }

        } else {
            $data['exercice'] = $this->modeldb->fetch_join_exercices(array('ts_exercices.exercice_uid' => $this->segment->getSegment(4)), 'exercice_created_at', 'row');
            $this->session->setFlashdata('failed', 'ERROR: Opération non effectuée. Veuillez  vérifier ci-dessous les erreurs rencontrées puis réessayer !');
            $data['validation'] = $this->validator;
            $data['_view'] = ($this->segment->getSegment(3) == "update") ? ('app/online/update/exercice') : ('app/online/create/exercice');
        }
        return view('layouts/app', $data);
    }
    function saveTravaux()
    {
        $data = [];

        $ecole = $this->session->schooluid;   # GET SCHOOL ID
        $annee_scolaire = $this->session->yearuid;   # GET SCHOOL ID

        $data['exercices'] = $this->modeldb->fetch_join_exercices(array('ts_exercices.exercice_deleted_at' => null, 'exercice_ecole_uid' => $ecole, 'exercice_annee_uid' => $annee_scolaire), 'exercice_created_at');
        $data['etudiants'] = $this->modeldb->fetch_join_inscription(array('etudiant_statut' => 'actif', 'etudiant_ecole_uid' => $ecole, 'inscription_annee_uid' => $annee_scolaire), 'inscription_created_at');

        $rulers = [
            'etudiant' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "etudiant obligatoire",
                ],
            ],
            'exercice' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'titre obligatoire',
                ]
            ],'contenu' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'contenu obligatoire',
                ]
            ],
        ];

        if ($this->validate($rulers)) {

            $fullpathdocument = '';
            $typeFileUpload='';
            $sizeFileUpload='';
            if ($this->request->getFile('document') != '') {
                $docFile = $this->request->getFile('document');
                //foreach($imagefile['images'] as $img){
                if ($docFile->isValid() && !$docFile->hasMoved()) {
                    //rename image
                    $newNameFileUpload = $docFile->getRandomName();
                    $typeFileUpload = $docFile->getClientExtension();
                    $sizeFileUpload = $docFile->getSize();
                    $fullPathFile = 'global/uploads/files';
                    //move to upload directory
                    $docFile->move(ROOTPATH . $fullPathFile, $newNameFileUpload);
                    $fullpathdocument = base_url() . '/' . $fullPathFile . '/' . $newNameFileUpload;
                }
            }

            if ($this->segment->getSegment(3) == "create") {
                $nouvellePresenceData = [
                    'travaux_uid' => $this->generateIdentifiant(),
                    'travaux_etudiant_uid' => $this->request->getPost('etudiant'),
                    'travaux_reponse' => $this->request->getPost('contenu'),
                    'travaux_exercice_uid' => $this->request->getPost('exercice'),
                    'travaux_fichier' => $fullpathdocument,
                    'travaux_filetype' => $typeFileUpload,
                    'travaux_filesize' => $sizeFileUpload,
                    'travaux_statut' => 'actif',
                    'travaux_created_at' => date('Y-m-d h:i:s'),
                    'travaux_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                    'travaux_annee_uid' => $this->session->yearuid,
                    'travaux_ecole_uid' => $this->session->schooluid,
                ];
                if ($this->modeldb->insert_data('ts_travaux', $nouvellePresenceData)) {
                    return redirect()->back()->with('success', "Création travail: Opération effectuée  avec succès");
                } else {
                    return redirect()->back()->with('failed', "Erreur Création travail");
                }
            } elseif ($this->segment->getSegment(3) == "update") {

                $random_uid = $this->segment->getSegment(4);
                $updateData = [
                    'travaux_etudiant_uid' => $this->request->getPost('etudiant'),
                    'travaux_reponse' => $this->request->getPost('contenu'),
                    'travaux_exercice_uid' => $this->request->getPost('exercice'),
                    'travaux_fichier' => $fullpathdocument,
                    'travaux_filetype' => $typeFileUpload,
                    'travaux_filesize' => $sizeFileUpload,
                    'travaux_updated_at' => date('Y-m-d h:i:s'),
                    'travaux_updated_by' => $this->session->fullname . ' - ' . $this->session->role,
                ];
                if ($this->modeldb->update_data('ts_travaux', $updateData, array('travaux_uid' => $random_uid))) {
                    return redirect()->back()->with('success', "Modification travail: Opération effectuée  avec succès");
                } else {
                    return redirect()->back()->with('failed', "Erreur Modification travail");
                }
            } else {
                return redirect()->back()->with('failed', "Aucune donnee n'a été selectionnée");
            }

        } else {

            $data['travaux'] = $this->modeldb->fetch_join_travaux(array('ts_travaux.travaux_uid' =>  $this->segment->getSegment(4)), 'travaux_created_at', 'row');

            $this->session->setFlashdata('failed', 'ERROR: Opération non effectuée. Veuillez  vérifier ci-dessous les erreurs rencontrées puis réessayer !');
            $data['validation'] = $this->validator;
            $data['_view'] = ($this->segment->getSegment(3) == "update") ? ('app/online/update/exercice') : ('app/online/create/exercice');
        }
        return view('layouts/app', $data);
    }

    public function sendMail($ecole, $email, $content, $subject, $attachment)
    {
        $lienurl = base_url('secure/guest');
        $from = "";
        $cc1 = "";
        $emailEcole = $this->session->schoolemail;
        $addresses = mb_split(";", $email);
        if (count($addresses) > 1) {
            $from = $addresses[0];
            $cc1 = $addresses[1];
        } else {
            $from = $email;
        }
        $mail = new PHPMailer(TRUE);

        try {
			
            //$mail->addReplyTo($emailEcole, 'Information Ecole');

            $mail->setFrom('noreply@domain.com', ' Application');
            $mail->addAddress($from, '');
			
            if (count($addresses) > 1) {
                $mail->addCC($cc1);
            }
			$mail->isSMTP();
            $mail->Host = 'mail.domain.com';
            $mail->SMTPAuth = TRUE;
            $mail->SMTPSecure = 'tls';
            $mail->Username = '';
            $mail->Password = '';
            //$mail->Port = 465;
			$mail->Port = 587;
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
			
			
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = $subject;
            //Recipients
            //$mail->addAttachment($attachment, 'Piece Jointe');    // Optional name
            $mail->Body =
                '<html>
                    <body style="font-family:Georgia, Cambria, "Times New Roman", Times, serif; font-size:14px; color:#666666;">

                            <p> Bonjour cher parent  </p>
                            <p> Voici le message de l\Ecole <strong>' . $ecole . '</strong>  le ' . date("d-m-Y H:i:s") . ' </p>
                            <p> Sujet : ' . $subject . ' </p>
                            <hr>
                            <strong> Message : </strong> ' . $content . '
                            <p> Vous pouvez egalement suivre le lien ci-après pour voir le message en entierte <br/>
                            <a href="' . $lienurl . '"
                                style=" padding: 1rem 2.4rem; font-size: 0.94rem;margin: 0.375rem;
                                  color: white!important;
                                  text-align:center!important;
                                  background-color: blue!important;
                                  text-transform: uppercase;
                                  word-wrap: break-word;
                                  white-space: normal;
                                  cursor: pointer;
                                  border: 0;
                                  box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
                                  transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,
                                  border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
                                   border-radius: 100px!important">
                                 Accèder au contenu du cours </a>
                            </p>
                      </body>
                      </html>';
            
            if($mail->send()){
                return true;
            }

        } catch (Exception $e) {
            return false;
        }
        return true;
    }
}
