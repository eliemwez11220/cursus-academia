<?php
/**
 * Created by PhpStorm.
 * User: ElieMwezRubuz
 * Date: 01-Mar-21
 * Time: 11:05 AM
 */

namespace App\Controllers;

use App\Models\AppModel;

class Agent extends BaseController
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
        $this->view('personnels');
    }

    public function view($type = null)
    {
        $this->session->remove('enseignantdecotation'); 
        $data = [];
          # GET SCHOOL ID
        $ecole = $this->session->schooluid;   # GET SCHOOL ID

        switch ($type) {
            case 'fonctions':
                $data['fonctions'] = $this->modeldb->fetch_all_data('ts_fonctions_agents', array('fonction_deleted_at' => null, 'fonction_ecole_uid' => $ecole), 'fonction_created_at');
                break;
            case 'grades':
                $data['grades'] = $this->modeldb->fetch_all_data('ts_grades_agents', array('grade_deleted_at' => null, 'grade_ecole_uid' => $ecole), 'grade_created_at');
                break;
            case 'criterescotation':
                $data['criteres'] = $this->modeldb->fetch_all_data('ts_criteres_agents', array('critere_deleted_at' => null, 'critere_ecole_uid' => $ecole), 'critere_created_at');
                break;
            case 'typestaches':
                $data['typestaches'] = $this->modeldb->fetch_all_data('ts_typestaches', array('typestache_deleted_at' => null, 'typestache_ecole_uid' => $ecole), 'typestache_created_at');
                break;
            case 'secteurs':
                $data['secteurs'] = $this->modeldb->fetch_all_data('ts_secteurs', array('secteur_deleted_at' => null, 'secteur_ecole_uid' => $ecole), 'secteur_created_at');
                break;
            case 'personnels':
                $data['agents'] = $this->modeldb->fetch_join_agents(array('agent_deleted_at' => null, 'agent_ecole_uid' => $ecole), 'agent_created_at');
                break;
            case 'taches':
                $data['taches'] = $this->modeldb->fetch_join_taches( array('tache_statut' => 'actif', 'tache_ecole_uid' => $ecole), 'tache_created_at');
                break;    
            case 'cotationenseignants':
                $data['cotations'] = $this->modeldb->fetch_join_evaluations( array('cotation_statut' => 'actif', 'cotation_ecole_uid' => $ecole), 'cotation_created_at'); 
                break;
            default:
                null;
        }//
        //$this->displayResults($data['taches']);

        $data['title'] = ucfirst("personnel - $type | School Web Application"); // Capitalize the first letter
        $data['_view'] = ('app/personnel/listing/' . $type);
        echo view('layouts/app', $data);
    }

    public function addForm($type = null)
    {
        //si annee est inactif, aucune creation n'est autorisee
        if($this->session->yearstatus == 'inactif'){
            return redirect()->back()->with('info', "Année Fermée: La création n'est pas autorisée sur une année fermée");
        }else{
        $data = [];
        $ecole = $this->session->schooluid;   # GET SCHOOL ID

        switch ($type) {
            case 'personnel':
                $data['fonctions'] = $this->modeldb->fetch_all_data('ts_fonctions_agents', array('fonction_deleted_at' => null, 'fonction_ecole_uid' => $ecole), 'fonction_created_at');
                $data['grades'] = $this->modeldb->fetch_all_data('ts_grades_agents', array('grade_deleted_at' => null, 'grade_ecole_uid' => $ecole), 'grade_created_at');
                $data['secteurs'] = $this->modeldb->fetch_all_data('ts_secteurs', array('secteur_deleted_at' => null, 'secteur_ecole_uid' => $ecole), 'secteur_created_at');
                break;
            case 'tache':
                $data['typestaches'] = $this->modeldb->fetch_all_data('ts_typestaches', array('typestache_statut' => 'actif', 'typestache_ecole_uid' => $ecole), 'typestache_created_at');
                $data['agents'] = $this->modeldb->fetch_all_data('ts_agents', array('agent_statut' => 'actif', 'agent_ecole_uid' => $ecole), 'agent_created_at');
                break;
            case 'cotationenseignant':
                $data['agents'] = $this->modeldb->fetch_all_data('ts_agents', array('agent_statut' => 'actif', 'agent_ecole_uid' => $ecole), 'agent_created_at');
                $data['periodes'] = $this->modeldb->fetch_all_data('ts_periodes', array('periode_statut' => 'actif','periode_type' => 'cotation', 'periode_ecole_uid' => $ecole), 'periode_libelle', null, null, 'ASC');
                $data['criteres'] = $this->modeldb->fetch_all_data('ts_criteres_agents', array('critere_statut' => 'actif', 'critere_ecole_uid' => $ecole), 'critere_created_at');

                $data['cotations'] = $this->modeldb->fetch_join_evaluations( array('cotation_statut' => 'actif', 'cotation_ecole_uid' => $ecole), 'cotation_created_at');
                break;
            default:
                null;
        }

        //$this->displayResults($data['fonctions']);

        $data['title'] = ucfirst("Add - $type | School Web Application"); // Capitalize the first letter
        $data['_view'] = ('app/personnel/create/' . $type);
        echo view('layouts/app', $data);
    }
    }

    public function details($type = null, $type_id = null)
    {
        switch ($type) {
            case 'fonction':
                $data['fonction'] = $this->modeldb->fetch_row_data('ts_fonctions_agents', array('fonction_uid' => $type_id));
                break;
            case 'grade':
                $data['grade'] = $this->modeldb->fetch_row_data('ts_grades_agents', array('grade_uid' => $type_id));
                break;
            case 'typestache':
                $data['typestache'] = $this->modeldb->fetch_row_data('ts_typestaches', array('typestache_uid' => $type_id));
                break;
            case 'criterecotation':
                $data['critere'] = $this->modeldb->fetch_row_data('ts_criteres_agents', array('critere_uid' => $type_id));
                break;
            case 'secteur':
                $data['secteur'] = $this->modeldb->fetch_row_data('ts_secteurs', array('secteur_uid' => $type_id));
                break;
            case 'personnel':
                $data['agent'] = $this->modeldb->fetch_join_agents(array('agent_uid' => $type_id), 'agent_created_at', 'row');
                break;
            case 'tache':
                $data['tache'] = $this->modeldb->fetch_join_taches( array('tache_uid' => $type_id), 'tache_created_at', 'row');
                break;
            case 'cotationenseignant':
                $data['cotation'] = $this->modeldb->fetch_join_evaluations( array('cotation_uid' =>$type_id), 'cotation_created_at', 'row');
                break;
            default:
                null;
        }
        //$this->displayResults($data);

        $data['title'] = ucfirst("Details - $type | School Web Application"); // Capitalize the first letter
        $data['_view'] = ('app/personnel/details/' . $type);
        echo view('layouts/app', $data);
    }

    public function editForm($type = null, $type_id = null)
    {
        //si annee est inactif, aucune creation n'est autorisee
        if($this->session->yearstatus == 'inactif'){
            return redirect()->back()->with('info', "Année Fermée: La modification n'est pas autorisée sur une année fermée");
        }else{
        $data = [];
        $ecole = $this->session->schooluid;   # GET SCHOOL ID

        switch ($type) {
            case 'fonction':
                $data['fonction'] = $this->modeldb->fetch_row_data('ts_fonctions_agents', array('fonction_uid' => $type_id));
                break;
            case 'grade':
                $data['grade'] = $this->modeldb->fetch_row_data('ts_grades_agents', array('grade_uid' => $type_id));
                break;

            case 'typestache':
                $data['typestache'] = $this->modeldb->fetch_row_data('ts_typestaches', array('typestache_uid' => $type_id));
                break;
            case 'criterecotation':
                $data['critere'] = $this->modeldb->fetch_row_data('ts_criteres_agents', array('critere_uid' => $type_id));
                break;
            case 'secteur':
                $data['secteur'] = $this->modeldb->fetch_row_data('ts_secteurs', array('secteur_uid' => $type_id));
                break;
            case 'personnel':
                $data['agent'] = $this->modeldb->fetch_join_agents(array('agent_uid' => $type_id), 'agent_created_at', 'row');
                $data['fonctions'] = $this->modeldb->fetch_all_data('ts_fonctions_agents', array('fonction_deleted_at' => null, 'fonction_ecole_uid' => $ecole), 'fonction_created_at');
                $data['grades'] = $this->modeldb->fetch_all_data('ts_grades_agents', array('grade_deleted_at' => null, 'grade_ecole_uid' => $ecole), 'grade_created_at');
                $data['secteurs'] = $this->modeldb->fetch_all_data('ts_secteurs', array('secteur_deleted_at' => null, 'secteur_ecole_uid' => $ecole), 'secteur_created_at');
                break;
            case 'tache':
                $data['tache'] = $this->modeldb->fetch_join_taches( array('tache_uid' => $type_id, 'tache_ecole_uid' => $ecole), 'tache_created_at', 'row');
                $data['typestaches'] = $this->modeldb->fetch_all_data('ts_typestaches', array('typestache_statut' => 'actif', 'typestache_ecole_uid' => $ecole), 'typestache_created_at');
                $data['agents'] = $this->modeldb->fetch_all_data('ts_agents', array('agent_statut' => 'actif', 'agent_ecole_uid' => $ecole), 'agent_created_at');
                break;
            case 'cotationenseignant':
                $data['cotation'] = $this->modeldb->fetch_join_evaluations( array('cotation_uid' =>$type_id), 'cotation_created_at', 'row');
                $data['agents'] = $this->modeldb->fetch_all_data('ts_agents', array('agent_statut' => 'actif', 'agent_ecole_uid' => $ecole), 'agent_created_at');
                $data['periodes'] = $this->modeldb->fetch_all_data('ts_periodes', array('periode_statut' => 'actif', 'periode_ecole_uid' => $ecole), 'periode_created_at');
                $data['criteres'] = $this->modeldb->fetch_all_data('ts_criteres_agents', array('critere_statut' => 'actif', 'critere_ecole_uid' => $ecole), 'critere_created_at');

                $data['cotations_agents'] = $this->modeldb->fetch_join_evaluations( array('cotation_statut' => 'actif', 'cotation_ecole_uid' => $ecole), 'cotation_created_at');
                break;
            default:
                null;
        }
        //$this->displayResults($data['cotations_agents']);

        $data['title'] = ucfirst("Edit - $type | School Web Application"); // Capitalize the first letter
        $data['_view'] = ('app/personnel/update/' . $type);
        echo view('layouts/app', $data);
    }
    }

    public function changeStatus($table = null, $status_value = null, $uid = null)
    {
        switch ($table) {
            case 'fonction':
                $realnametable = 'ts_fonctions_agents';
                $real_uid = $table . '_uid';
                $status = $table . '_statut';
                $updated_time = $table . '_updated_at';
                $updated_by = $table . '_updated_by';
                break; 
            case 'grade':
                $realnametable = 'ts_grades_agents';
                $real_uid = $table . '_uid';
                $status = $table . '_statut';
                $updated_time = $table . '_updated_at';
                $updated_by = $table . '_updated_by';
                break;
            case 'criterecotation':
                $realnametable = 'ts_criteres_agents';
                $real_uid = $table . '_uid';
                $status = $table . '_statut';
                $updated_time = $table . '_updated_at';
                $updated_by = $table . '_updated_by';
                break;
            
            default:
                $realnametable = 'ts_' . $table . 's';
                $real_uid = $table . '_uid';
                $status = $table . '_statut';
                $updated_time = $table . '_updated_at';
                $updated_by = $table . '_updated_by';
                break;
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
    function saveFonctionAgents()
    {
        if ($this->request->getPost('libelle_fonction') != '') {

            $fonction_random_uid = $this->generateIdentifiant();
            if ($this->segment->getSegment(3) == "create") {

                $nouvelleFonctionData = [
                    'fonction_uid' => $fonction_random_uid,
                    'fonction_code' => $this->request->getPost('code_fonction'),
                    'fonction_libelle' => $this->request->getPost('libelle_fonction'),
                    'fonction_statut' => 'actif',
                    'fonction_created_at' => date('Y-m-d h:i:s'),
                    'fonction_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                    'fonction_ecole_uid' => $this->session->schooluid,
                ];
                $this->modeldb->insert_data('ts_fonctions_agents', $nouvelleFonctionData);
                return redirect()->back()->with('success', "Fonction enregistrée avec succès");
            } elseif ($this->segment->getSegment(3) == "update") {

                $fonction_uid = $this->segment->getSegment(4);

                $updateFonctionData = [

                    'fonction_code' => $this->request->getPost('code_fonction'),
                    'fonction_libelle' => $this->request->getPost('libelle_fonction'),
                    'fonction_updated_at' => date('Y-m-d h:i:s'),
                    'fonction_updated_by' => $this->session->fullname . ' - ' . $this->session->role,
                ];
                $this->modeldb->update_data('ts_fonctions_agents', $updateFonctionData, array('fonction_uid' => $fonction_uid));
                return redirect()->back()->with('success', "Fonction modifiée avec succès");
            } else {
                return redirect()->back();
            }

        } else {

            return redirect()->back()->withInput();
        }
    }

    function saveGradeAgents()
    {
        if ($this->request->getPost('libelle_grade') != '') {

            $fonction_random_uid = $this->generateIdentifiant();
            if ($this->segment->getSegment(3) == "create") {

                $nouvelleFonctionData = [
                    'grade_uid' => $fonction_random_uid,
                    'grade_code' => $this->request->getPost('code_grade'),
                    'grade_libelle' => $this->request->getPost('libelle_grade'),
                    'grade_statut' => 'actif',
                    'grade_created_at' => date('Y-m-d h:i:s'),
                    'grade_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                    'grade_ecole_uid' => $this->session->schooluid,
                ];
                $this->modeldb->insert_data('ts_grades_agents', $nouvelleFonctionData);
                return redirect()->back()->with('success', "Grade enregistré avec succès");
            } elseif ($this->segment->getSegment(3) == "update") {

                $fonction_uid = $this->segment->getSegment(4);

                $updateFonctionData = [

                    'grade_code' => $this->request->getPost('code_grade'),
                    'grade_libelle' => $this->request->getPost('libelle_grade'),
                    'grade_updated_at' => date('Y-m-d h:i:s'),
                    'grade_updated_by' => $this->session->fullname . ' - ' . $this->session->role,
                ];
                $this->modeldb->update_data('ts_grades_agents', $updateFonctionData, array('grade_uid' => $fonction_uid));
                return redirect()->back()->with('success', "Grade modifié avec succès");
            } else {
                return redirect()->back();
            }

        } else {

            return redirect()->back()->withInput();
        }
    }

    function saveCritereCotation()
    {
        if ($this->request->getPost('libelle_critere') != '') {

            $unique_random_uid = $this->generateIdentifiant();
            if ($this->segment->getSegment(3) == "create") {

                $nouvelleData = [
                    'critere_uid' => $unique_random_uid,
                    'critere_code' => $this->request->getPost('code_critere'),
                    'critere_libelle' => $this->request->getPost('libelle_critere'),
                    'critere_cotes_max' => $this->request->getPost('max_cotes_critere'),
                    'critere_statut' => 'actif',
                    'critere_created_at' => date('Y-m-d h:i:s'),
                    'critere_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                    'critere_ecole_uid' => $this->session->schooluid,
                ];
                $this->modeldb->insert_data('ts_criteres_agents', $nouvelleData);
                return redirect()->back()->with('success', "Critere enregistré avec succès");
            } elseif ($this->segment->getSegment(3) == "update") {

                $critere_uid = $this->segment->getSegment(4);

                $updateData = [

                    'critere_code' => $this->request->getPost('code_critere'),
                    'critere_libelle' => $this->request->getPost('libelle_critere'),
                    'critere_cotes_max' => $this->request->getPost('max_cotes_critere'),
                    'critere_updated_at' => date('Y-m-d h:i:s'),
                    'critere_updated_by' => $this->session->fullname . ' - ' . $this->session->role,
                ];

                $this->modeldb->update_data('ts_criteres_agents', $updateData, array('critere_uid' => $critere_uid));
                return redirect()->back()->with('success', "Critere modifié avec succès");
            } else {
                return redirect()->back();
            }

        } else {

            return redirect()->back()->withInput();
        }
    }

    function saveTypeTaches()
    {
        if ($this->request->getPost('libelle_typetache') != '') {

            $unique_random_uid = $this->generateIdentifiant();
            if ($this->segment->getSegment(3) == "create") {

                $nouvelleData = [
                    'typestache_uid' => $unique_random_uid,
                    'typestache_code' => $this->request->getPost('code_typetache'),
                    'typestache_libelle' => $this->request->getPost('libelle_typetache'),
                    'typestache_statut' => 'actif',
                    'typestache_created_at' => date('Y-m-d h:i:s'),
                    'typestache_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                    'typestache_ecole_uid' => $this->session->schooluid,
                ];
                $this->modeldb->insert_data('ts_typestaches', $nouvelleData);
                return redirect()->back()->with('success', "Type Tache enregistré avec succès");
            } elseif ($this->segment->getSegment(3) == "update") {

                $critere_uid = $this->segment->getSegment(4);

                $updateData = [

                    'typestache_code' => $this->request->getPost('code_typetache'),
                    'typestache_libelle' => $this->request->getPost('libelle_typetache'),
                    'typestache_updated_at' => date('Y-m-d h:i:s'),
                    'typestache_updated_by' => $this->session->fullname . ' - ' . $this->session->role,
                ];

                $this->modeldb->update_data('ts_typestaches', $updateData, array('typestache_uid' => $critere_uid));
                return redirect()->back()->with('success', "Type Tache modifié avec succès");
            } else {
                return redirect()->back();
            }

        } else {

            return redirect()->back()->withInput();
        }
    }

    function saveSecteurActivity()
    {
        if ($this->request->getPost('libelle_secteur') != '') {

            $unique_random_uid = $this->generateIdentifiant();
            if ($this->segment->getSegment(3) == "create") {

                $nouvelleData = [
                    'secteur_uid' => $unique_random_uid,
                    'secteur_code' => $this->request->getPost('code_secteur'),
                    'secteur_libelle' => $this->request->getPost('libelle_secteur'),
                    'secteur_statut' => 'actif',
                    'secteur_created_at' => date('Y-m-d h:i:s'),
                    'secteur_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                    'secteur_annee_uid' => $this->session->yearuid,
                    'secteur_ecole_uid' => $this->session->schooluid,
                ];
                $this->modeldb->insert_data('ts_secteurs', $nouvelleData);
                return redirect()->back()->with('success', "Secteur enregistré avec succès");
            } elseif ($this->segment->getSegment(3) == "update") {

                $secteur_uid = $this->segment->getSegment(4);

                $updateData = [

                    'secteur_code' => $this->request->getPost('code_secteur'),
                    'secteur_libelle' => $this->request->getPost('libelle_secteur'),
                    'secteur_updated_at' => date('Y-m-d h:i:s'),
                    'secteur_updated_by' => $this->session->fullname . ' - ' . $this->session->role,
                ];

                $this->modeldb->update_data('ts_secteurs', $updateData, array('secteur_uid' => $secteur_uid));
                return redirect()->back()->with('success', "Secteur modifié avec succès");
            } else {
                return redirect()->back();
            }

        } else {

            return redirect()->back()->withInput();
        }
    }

    function saveTache()
    {
        $data = [];
        $rulers = [
            'code_tache' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "code_tache obligatoire",
                ],
            ],
            'libelle_tache' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'libelle_tache obligatoire',
                ]
            ], 'type_tache' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'type_tache obligatoire',
                ]
            ], 'agent_tache' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'agent_tache obligatoire',
                ]
            ],
        ];

        if ($this->validate($rulers)) {

            $this->session->set('agent_tache_attribution', $this->request->getPost('agent_tache'));
            $unique_random_uid = $this->generateIdentifiant();
            if ($this->segment->getSegment(3) == "create") {

                $nouvelleData = [
                    'tache_uid' => $unique_random_uid,
                    'tache_code' => $this->request->getPost('code_tache'),
                    'tache_libelle' => $this->request->getPost('libelle_tache'),
                    'tache_date_debut' => $this->request->getPost('date_debut_tache'),
                    'tache_date_fin' => $this->request->getPost('date_fin_tache'),
                    'tache_description' => $this->request->getPost('description_tache'),
                    'tache_type_uid' => $this->request->getPost('type_tache'),
                    'tache_agent_uid' => $this->request->getPost('agent_tache'),
                    'tache_statut' => 'actif',
                    'tache_created_at' => date('Y-m-d h:i:s'),
                    'tache_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                    'tache_annee_uid' => $this->session->yearuid,
                    'tache_ecole_uid' => $this->session->schooluid,
                ];
                if($this->modeldb->insert_data('ts_taches', $nouvelleData)){
                    return redirect()->back()->with('success', "Attribution Tache enregistrée avec succès");
                }
                return false;

            } elseif ($this->segment->getSegment(3) == "update") {

                $tache_uid = $this->segment->getSegment(4);

                $updateData = [
                    'tache_code' => $this->request->getPost('code_tache'),
                    'tache_libelle' => $this->request->getPost('libelle_tache'),
                    'tache_date_debut' => $this->request->getPost('date_debut_tache'),
                    'tache_date_fin' => $this->request->getPost('date_fin_tache'),
                    'tache_description' => $this->request->getPost('description_tache'),
                    'tache_type_uid' => $this->request->getPost('type_tache'),
                    'tache_agent_uid' => $this->request->getPost('agent_tache'),
                    'tache_updated_at' => date('Y-m-d h:i:s'),
                    'tache_updated_by' => $this->session->fullname . ' - ' . $this->session->role,
                ];

                if ($this->modeldb->update_data('ts_taches', $updateData, array('tache_uid' => $tache_uid))){
                    return redirect()->back()->with('success', "Attribution tache modifiée avec succès");
                }
                return false;
            } else {
                return redirect()->back();
            }

        } else {

            if ($this->segment->getSegment(3) == "update") {
                $type_id = $this->segment->getSegment(4);
                $data['tache'] = $this->modeldb->fetch_join_taches( array('tache_uid' =>$type_id), 'tache_created_at', 'row');
                $data['_view'] = ('app/personnel/update/tache');
            }else{
                $data['_view'] = ('app/personnel/create/tache');
            }
            $ecole = $this->session->schooluid;
            $data['agents'] = $this->modeldb->fetch_all_data('ts_agents', array('agent_statut' => 'actif', 'agent_ecole_uid' => $ecole), 'agent_created_at');
            $data['typestaches'] = $this->modeldb->fetch_all_data('ts_typestaches', array('typestache_statut' => 'actif', 'typestache_ecole_uid' => $ecole), 'typestache_created_at');

            $this->session->setFlashdata('failed', 'ERROR: Opération non effectuée. Veuillez  vérifier ci-dessous les erreurs rencontrées puis réessayer !');
            $data['validation'] = $this->validator;
            return view('layouts/app', $data);
        }
    }


    function saveAgent()
    {
        $data = [];
        $rulers = [
            'matricule' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Matricule obligatoire",
                ],
            ],
            'nom' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nom etudiant obligatoire',
                ]
            ], 'prenom' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Prenom obligatoire',
                ]
            ], 'postnom' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Postnom obligatoire',
                ]
            ],
            'sexe' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Sexe obligatoire',
                ]
            ],
            'fonction' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Fonction obligatoire',
                ]
            ],
            'grade' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Grade obligatoire',
                ]
            ], 'secteur' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Secteur obligatoire',
                ]
            ],
        ];

        if ($this->validate($rulers)) {
            $matricule = trim(htmlspecialchars($this->request->getPost('matricule')));
            $nom = trim(htmlspecialchars($this->request->getPost('nom')));
            $prenom = trim(htmlspecialchars($this->request->getPost('prenom')));
            $postnom = trim(htmlspecialchars($this->request->getPost('postnom')));
            $date_naissance = trim(htmlspecialchars($this->request->getPost('dateNaissance')));
            $lieu_naissance = trim(htmlspecialchars($this->request->getPost('lieuNaissance')));
            $fonction_fk = trim(htmlspecialchars($this->request->getPost('fonction')));
            $grade_fk = trim(htmlspecialchars($this->request->getPost('grade')));
            $secteur_fk = trim(htmlspecialchars($this->request->getPost('secteur')));
            $adresse = trim(htmlspecialchars($this->request->getPost('adresse')));
            $email = trim(htmlspecialchars($this->request->getPost('email')));
            $telephone = trim(htmlspecialchars($this->request->getPost('telephone')));
            $sexe = trim(htmlspecialchars($this->request->getPost('sexe')));
            $date_engagement = trim(htmlspecialchars($this->request->getPost('date_engagement')));
            $lieu_engagement = trim(htmlspecialchars($this->request->getPost('lieu_engagement')));

            $current_datetime = date('Y-m-d H:i:s');

            if ($this->segment->getSegment(3) == "create") {
                //generate uid random
                $random_table_uid = $this->generateIdentifiant();

                //table data
                $agentDataPrepared = [
                    'agent_uid' => $random_table_uid,
                    'agent_matricule' => $matricule,
                    'agent_nom' => $nom,
                    'agent_postnom' => $postnom,
                    'agent_prenom' => $prenom,
                    'agent_sexe' => $sexe,
                    'agent_date_naissance' => $date_naissance,
                    'agent_lieu_naissance' => $lieu_naissance,
                    'agent_email' => $email,
                    'agent_telephone' => $telephone,
                    'agent_statut' => 'actif',
                    'agent_adresse' => $adresse,

                    'agent_date_embauche' => $date_engagement,
                    'agent_lieu_embauche' => $lieu_engagement,

                    'agent_fonction_uid' => $fonction_fk,
                    'agent_grade_uid' => $grade_fk,
                    'agent_secteur_uid' => $secteur_fk,

                    'agent_created_at' => $current_datetime,
                    'agent_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                    'agent_ecole_uid' => $this->session->schooluid,
                ];

                if ($this->modeldb->insert_data('ts_agents', $agentDataPrepared)) {
                    return redirect()->back()->with('success', "Création Agent: Opération effectuée avec succés");
                } else {
                    return redirect()->back()->with('failed', "Erreur Serveur: Agent non enregistré. Veuillez réessayer plus tard !");
                }

            } //end save 

            if ($this->segment->getSegment(3) == "update") {
                //get uid random
                $random_table_uid = $this->segment->getSegment(4);

                // informations updated
                $statut = trim(htmlspecialchars($this->request->getPost('statut')));
                $conjoint = trim(htmlspecialchars($this->request->getPost('nom_conjoint')));
                $nombre_enfants = trim(htmlspecialchars($this->request->getPost('nombre_enfants')));
                $numero_securite = trim(htmlspecialchars($this->request->getPost('numero_securite')));

                $ville = trim(htmlspecialchars($this->request->getPost('ville')));
                $province = trim(htmlspecialchars($this->request->getPost('province')));
                $groupe_sanguin = trim(htmlspecialchars($this->request->getPost('groupeSanguin')));
                $caracteristiques = trim(htmlspecialchars($this->request->getPost('caracteristiques')));
                $observation_generale = trim(htmlspecialchars($this->request->getPost('observation')));
                $applicationetudiant = trim(htmlspecialchars($this->request->getPost('application')));
                $attitudeetudiant = trim(htmlspecialchars($this->request->getPost('attitude')));
                $taille = trim(htmlspecialchars($this->request->getPost('taille')));
                $poids = trim(htmlspecialchars($this->request->getPost('poids')));

                //table data
                $agentDataPrepared = [
                    'agent_matricule' => $matricule,
                    'agent_nom' => $nom,
                    'agent_postnom' => $postnom,
                    'agent_prenom' => $prenom,
                    'agent_sexe' => $sexe,
                    'agent_date_naissance' => $date_naissance,
                    'agent_lieu_naissance' => $lieu_naissance,
                    'agent_email' => $email,
                    'agent_telephone' => $telephone,
                    'agent_fonction_uid' => $fonction_fk,
                    'agent_grade_uid' => $grade_fk,
                    'agent_secteur_uid' => $secteur_fk,

                    'agent_date_embauche' => $date_engagement,
                    'agent_lieu_embauche' => $lieu_engagement,

                    'agent_statut' => $statut,
                    'agent_nom_conjoint' => $conjoint,
                    'agent_nombre_enfants' => $nombre_enfants,
                    'agent_numero_securite' => $numero_securite,

                    'agent_ville' => $ville,
                    'agent_province' => $province,
                    'agent_adresse' => $adresse,
                    'agent_groupe_sanguin' => $groupe_sanguin,
                    'agent_application' => $applicationetudiant,
                    'agent_observation' => $observation_generale,
                    'agent_caracteristiques' => $caracteristiques,
                    'agent_attitude' => $attitudeetudiant,
                    'agent_poids' => $poids,
                    'agent_taille' => $taille,

                    'agent_updated_at' => $current_datetime,
                    'agent_updated_by' => $this->session->fullname . ' - ' . $this->session->role,
                    'agent_ecole_uid' => $this->session->schooluid,
                ];

                //$this->displayResults($agentDataPrepared);

                if ($this->modeldb->update_data('ts_agents', $agentDataPrepared, array('agent_uid' => $random_table_uid))) {
                    return redirect()->back()->with('success', "Mise a jour Agent: Opération effectuée avec succés");
                } else {
                    return redirect()->back()->with('failed', "Erreur Serveur: Agent non modifié. Veuillez réessayer plus tard !");
                }

            }//end update

            else {
                return redirect()->to(current_url(true));
            }
        } else {

            $ecole = $this->session->schooluid;

            if ($this->segment->getSegment(3) == "update") {
                //get uid random
                $random_table_uid = $this->segment->getSegment(4);

                $data['agent'] = $this->modeldb->fetch_join_agents(array('agent_uid' => $random_table_uid), 'agent_created_at', 'row');
                $data['_view'] = ('app/personnel/update/personnel');
            }else{
                $data['_view'] = ('app/personnel/create/personnel');
            }
   
            $data['fonctions'] = $this->modeldb->fetch_all_data('ts_fonctions_agents', array('fonction_deleted_at' => null, 'fonction_ecole_uid' => $ecole), 'fonction_created_at');
            $data['grades'] = $this->modeldb->fetch_all_data('ts_grades_agents', array('grade_deleted_at' => null, 'grade_ecole_uid' => $ecole), 'grade_created_at');
            $data['secteurs'] = $this->modeldb->fetch_all_data('ts_secteurs', array('secteur_deleted_at' => null, 'secteur_ecole_uid' => $ecole), 'secteur_created_at');
            
            $this->session->setFlashdata('failed', 'ERROR: Opération non effectuée. Veuillez  vérifier ci-dessous les erreurs rencontrées puis réessayer !');
           
            $data['validation'] = $this->validator;
            return view('layouts/app', $data);
        }
    }
    function saveEvaluationEnseignant()
{
    $data = [];
    $rulers = [
        'critere_cotation' => [
            'rulers' => 'required',
            'errors' => [
                'required' => "Critere obligatoire",
            ],
        ],
        'periode_cotation' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'libelle_tache obligatoire',
            ]
        ],  
        'agent_cotation' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Agent obligatoire',
            ]
        ],
    ];

    if ($this->validate($rulers)) {

        $data['cotations'] = $this->modeldb->fetch_join_evaluations( array('cotation_statut' => 'actif', 'cotation_ecole_uid' => $this->session->schooluid), 'cotation_created_at');
$enseignant_uid = $this->request->getPost('agent_cotation');
            $cotation_critere_uid = $this->request->getPost('critere_cotation');
            $cotation_periode_uid = $this->request->getPost('periode_cotation');
        $unique_random_uid = $this->generateIdentifiant();
        if ($this->segment->getSegment(3) == "create") {

            foreach ($data['cotations'] as $key => $value) {

                if (($enseignant_uid == $value['cotation_agent_uid']) && ($cotation_periode_uid == $value['cotation_periode_uid']) && ($cotation_critere_uid == $value['cotation_critere_uid'])) {
                    # update existing value
                    $updateDataCotes = [
                        'cotation_cote_directeur' => $this->request->getPost('cotes_directeur'),
                        'cotation_cote_insp_coordination' => $this->request->getPost('cotes_coordination'),
                        'cotation_description' => $this->request->getPost('description_cotation'),
                        'cotation_updated_at' => date('Y-m-d h:i:s'),
                        'cotation_updated_by' => $this->session->fullname . ' - ' . $this->session->role,
                    ];

                    if ($this->modeldb->update_data('ts_cotations_agents', $updateDataCotes, 
                        array('cotation_critere_uid' => $cotation_critere_uid, 'cotation_periode_uid' => $cotation_periode_uid , 'cotation_agent_uid' => $enseignant_uid))){
                        return redirect()->back()->with('success', "Cotation Agent modifiée avec succès");
                    }

                }else{
                    $nouvelleData = [
                    'cotation_uid' => $unique_random_uid,
                    'cotation_cote_moyenne' => 0,
                    'cotation_cote_directeur' => $this->request->getPost('cotes_directeur'),
                    'cotation_cote_insp_coordination' => $this->request->getPost('cotes_coordination'),
                    'cotation_critere_uid' => $cotation_critere_uid,
                    'cotation_periode_uid' => $cotation_periode_uid,
                    'cotation_agent_uid' => $enseignant_uid,
                    'cotation_statut' => 'actif',
                    'cotation_created_at' => date('Y-m-d h:i:s'),
                    'cotation_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                    'cotation_annee_uid' => $this->session->yearuid,
                    'cotation_ecole_uid' => $this->session->schooluid,
                ];
                    if($this->modeldb->insert_data('ts_cotations_agents', $nouvelleData)){

                        $this->session->set('enseignantdecotation', $enseignant_uid);

                        return redirect()->back()->with('success', "Evaluation Agent enregistrée avec succès");
                    }
                }
                
            }//endforeach
            return false;

        } elseif ($this->segment->getSegment(3) == "update") {

            $tache_uid = $this->segment->getSegment(4);

            $updateData = [
                'cotation_cote_directeur' => $this->request->getPost('cotes_directeur'),
                'cotation_cote_insp_coordination' => $this->request->getPost('cotes_coordination'),
                'cotation_description' => $this->request->getPost('description_cotation'),
                'cotation_critere_uid' => $cotation_critere_uid,
                'cotation_periode_uid' => $cotation_periode_uid,
                'cotation_agent_uid' => $enseignant_uid,
                'cotation_updated_at' => date('Y-m-d h:i:s'),
                'cotation_updated_by' => $this->session->fullname . ' - ' . $this->session->role,
            ];

            if ($this->modeldb->update_data('ts_cotations_agents', $updateData, array('cotation_uid' => $tache_uid))){
                return redirect()->back()->with('success', "Cotation Agent modifiée avec succès");
            }
            return false;
        } else {
            return redirect()->back();
        }

    } else {
        $ecole = $this->session->schooluid;
        if ($this->segment->getSegment(3) == "update") {
            $type_id = $this->segment->getSegment(4);
            $data['cotation'] = $this->modeldb->fetch_join_evaluations( array('cotation_uid' =>$type_id), 'cotation_created_at', 'row');
            $data['_view'] = ('app/personnel/update/cotationenseignant');
        }else{
            $data['_view'] = ('app/personnel/create/cotationenseignant');
        }

        $data['agents'] = $this->modeldb->fetch_all_data('ts_agents', array('agent_statut' => 'actif', 'agent_ecole_uid' => $ecole), 'agent_created_at');
        $data['periodes'] = $this->modeldb->fetch_all_data('ts_periodes', array('periode_statut' => 'actif', 'periode_ecole_uid' => $ecole), 'periode_created_at');
        $data['criteres'] = $this->modeldb->fetch_all_data('ts_criteres_agents', array('critere_statut' => 'actif', 'critere_ecole_uid' => $ecole), 'critere_created_at');

        $this->session->setFlashdata('failed', 'ERROR: Opération non effectuée. Veuillez  vérifier ci-dessous les erreurs rencontrées puis réessayer !');
        $data['validation'] = $this->validator;
        return view('layouts/app', $data);
    }
}
}