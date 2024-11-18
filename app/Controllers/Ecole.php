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

class Ecole extends BaseController
{
    protected $session;
    protected $segment;
    protected $modeldb;
    protected $validation;

    function __construct()
    {
        $this->session = session();
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
        $this->view('fiche');
    }

    public function view($page = null)
    {
        $data=[];
        $ecole = $this->session->schooluid;

        switch ($page) {
              case 'mois':
                $data ['mois'] = $this->modeldb->fetch_all_data('ts_mois', array('mois_statut' => 'actif'), 'ordre_mois', null, null, 'ASC');
                break;
            case 'typesecoles':
                $data['typesecoles'] = $this->modeldb->fetch_all_data('ts_typesecoles', array('typesecole_deleted_at' => null), 'typesecole_created_at');
                break;
            case 'typesenseignements':
                $data['typesens'] = $this->modeldb->fetch_all_data('ts_typesenseignements', array('typesens_deleted_at' => null), 'typesens_created_at');
                break;
            case 'typesstudents':
                $data['typesetudiants'] = $this->modeldb->fetch_all_data('ts_typesetudiants', array('typesetudiant_deleted_at' => null, 'typesetudiant_ecole_uid'=>$ecole), 'typesetudiant_created_at');
                break;
            case 'degres':
                $data['degres'] = $this->modeldb->fetch_all_data('ts_degrespromotions', array('degres_deleted_at' => null, 'degres_ecole_uid'=>$ecole), 'degres_created_at');
                break;
            case 'periodes':
                $data['periodes'] = $this->modeldb->fetch_all_data('ts_periodes', array('periode_deleted_at' => null), 'periode_created_at');
                break;
            case 'cycles':
                $data['cycles'] = $this->modeldb->fetch_all_data('ts_cycles', array('cycle_deleted_at' => null, 'cycle_ecole_uid'=>$ecole), 'cycle_created_at');
                break;
            case 'filieres':
                $data['filieres'] = $this->modeldb->fetch_all_data('ts_filieres', array('filiere_deleted_at' => null, 'filiere_ecole_uid'=>$ecole), 'filiere_created_at');
                break;
            case 'ecoles':
                $data['ecoles'] = $this->modeldb->fetch_join_ecoles(array('ts_ecoles.ecole_deleted_at' => null, 'ts_typesecoles.typesecole_deleted_at' => null,
                    'ts_typesenseignements.typesens_deleted_at' => null), 'ecole_created_at');
                break;
            case 'promotions':
                $data['promotions'] = $this->modeldb->fetch_join_promotions(array('ts_promotions.promotion_deleted_at' => null, 'promotion_ecole_uid'=>$ecole), 'promotion_created_at');
                break;
            case 'annees':
                $data['annees'] = $this->modeldb->fetch_all_data('ts_annees', array('annee_deleted_at' => null), 'annee_created_at');
                break;
            case 'branches':
                $data['branches'] = $this->modeldb->fetch_all_data('ts_branches', array('branche_deleted_at' => null, 'branche_ecole_uid'=>$ecole), 'branche_created_at');
                break;
            case 'typesepreuves':
                $data['typesepreuves'] = $this->modeldb->fetch_all_data('ts_typesepreuves', array('typesepreuve_deleted_at' => null, 'typesepreuve_ecole_uid'=>$ecole), 'typesepreuve_created_at');
                break;   case 'reseaux':
                $data['coordinations'] = $this->modeldb->fetch_all_data('ts_coordinations', array('coordination_deleted_at' => null), 'coordination_created_at');
                break;
            default:
               $data['ecole'] = $this->modeldb->fetch_join_ecoles(array('ts_ecoles.ecole_uid' => $this->session->schooluid), 'ecole_created_at', 'row');
        }


        $data['title'] = ucfirst("Configuration - $page"); // Capitalize the first letter
        $data['_view'] = ('app/params/listing/' . $page);

        echo view('layouts/app', $data);
    }

    public function details($type = null, $key_uid = null)
    {
        switch ($type) {
            case 'typesecoles':
                $data['typesecole'] = $this->modeldb->fetch_row_data('ts_typesecoles', array('typesecole_uid' => $key_uid));
                break;
            case 'typesenseignements':
                $data['typesens'] = $this->modeldb->fetch_row_data('ts_typesenseignements', array('typesens_uid' => $key_uid));
                break;
            case 'typesetudiants':
                $data['typesetudiant'] = $this->modeldb->fetch_row_data('ts_typesetudiants', array('typesetudiant_uid' => $key_uid));
                break;
            case 'degres':
                $data['degres'] = $this->modeldb->fetch_row_data('ts_degrespromotions', array('degres_uid' => $key_uid));
                break;
            case 'periodes':
                $data['periode'] = $this->modeldb->fetch_row_data('ts_periodes', array('periode_uid' => $key_uid));
                break;
            case 'cycles':
                $data['cycle'] = $this->modeldb->fetch_row_data('ts_cycles', array('cycle_uid' => $key_uid));
                break;
            case 'ecoles':
                $data['ecole'] = $this->modeldb->fetch_join_ecoles(array('ts_ecoles.ecole_uid' => $key_uid), 'ecole_created_at', 'row');
                break;
            case 'filieres':
                $data['filiere'] = $this->modeldb->fetch_row_data('ts_filieres', array('filiere_uid' => $key_uid));
                break;
            case 'promotions':
                $data['promotion'] = $this->modeldb->fetch_join_promotions(array('ts_promotions.promotion_uid' => $key_uid), 'promotion_created_at', 'row');
                break;
            case 'annees':
                $data['annee'] = $this->modeldb->fetch_row_data('ts_annees', array('annee_uid' => $key_uid));
                break;
            case 'branche':
                $data['branche'] = $this->modeldb->fetch_row_data('ts_branches', array('branche_uid' => $key_uid));
                break;
            case 'reseau':
                $data['coordination'] = $this->modeldb->fetch_row_data('ts_coordinations', array('coordination_uid' => $key_uid));
                break;
                case 'typesepreuve':
                $data['typesepreuve'] = $this->modeldb->fetch_row_data('ts_typesepreuves', array('typesepreuve_uid' => $key_uid));
                break;
            default:
                null;
        }
        //$this->displayResults($data['filiere']);
        $data['title'] = ucfirst("$type  Details| School Web Application"); // Capitalize the first letter
        $data['_view'] = ('app/params/details/' . $type);
        echo view('layouts/app', $data);
    }

    public function addForm($type = null)
    {
        //si annee est inactif, aucune creation n'est autorisee
        if($this->session->yearstatus == 'inactif'){
            return redirect()->back()->with('info', "Année Fermée: La création n'est pas autorisée sur une année fermée");
        }else{
        $ecole = $this->session->schooluid;

        $data=[];
        switch ($type) {
            case 'ecole':
                $data['typesecoles'] = $this->modeldb->fetch_all_data('ts_typesecoles', array('typesecole_statut' => 'actif'), 'typesecole_created_at');
                $data['typesens'] = $this->modeldb->fetch_all_data('ts_typesenseignements', array('typesens_statut' => 'actif'), 'typesens_created_at');
                $data['coordinations'] = $this->modeldb->fetch_all_data('ts_coordinations', array('coordination_deleted_at' => null), 'coordination_created_at');
                $data['clients'] = $this->modeldb->fetch_all_data('ts_clients', array('client_statut'=>'actif'), 'client_created_at');
                break;
            case 'promotion':
                $data['degres'] = $this->modeldb->fetch_all_data('ts_degrespromotions', array('degres_statut' => 'actif', 'degres_ecole_uid'=>$ecole), 'degres_created_at');
                $data['cycles'] = $this->modeldb->fetch_all_data('ts_cycles', array('cycle_statut' => 'actif', 'cycle_ecole_uid'=>$ecole), 'cycle_created_at');
                $data['filieres'] = $this->modeldb->fetch_all_data('ts_filieres', 
                    array('filiere_deleted_at'=> null , 'filiere_ecole_uid'=>$ecole), 'filiere_created_at');
                break;
            default:
                null;
        }

        $data['title'] = ucfirst("$type  Adding| School Web Application"); // Capitalize the first letter
        $data['_view'] = ('app/params/create/' . $type);
        echo view('layouts/app', $data);
    }
    }

    public function editForm($type = null, $key_uid = null)
    {
        //si annee est inactif, aucune creation n'est autorisee
        if($this->session->yearstatus == 'inactif'){
            return redirect()->back()->with('info', "Année Fermée: La Modification n'est pas autorisée sur une année fermée");
        }else{
        $ecole = $this->session->schooluid;

        $data=[];
        switch ($type) {
            case 'periode':
                $data['periode'] = $this->modeldb->fetch_row_data('ts_periodes', array('periode_uid' => $key_uid));
                break;
            case 'ecole':
                $data['typesecoles'] = $this->modeldb->fetch_all_data('ts_typesecoles', array('typesecole_statut' => 'actif'), 'typesecole_created_at');
                $data['typesens'] = $this->modeldb->fetch_all_data('ts_typesenseignements', array('typesens_statut' => 'actif'), 'typesens_created_at');
                $data['ecole'] = $this->modeldb->fetch_row_data('ts_ecoles', array('ecole_uid' => $key_uid));
                $data['coordinations'] = $this->modeldb->fetch_all_data('ts_coordinations', array('coordination_deleted_at' => null), 'coordination_created_at');
                 $data['clients'] = $this->modeldb->fetch_all_data('ts_clients', array('client_statut'=>'actif'), 'client_created_at');
                break;
            case 'promotion':
                $data['degres'] = $this->modeldb->fetch_all_data('ts_degrespromotions', array('degres_statut' => 'actif', 'degres_ecole_uid'=>$ecole), 'degres_created_at');
                $data['cycles'] = $this->modeldb->fetch_all_data('ts_cycles', array('cycle_statut' => 'actif', 'cycle_ecole_uid'=>$ecole), 'cycle_created_at');
                $data['filieres'] = $this->modeldb->fetch_all_data('ts_filieres', array('filiere_deleted_at' => null, 'filiere_ecole_uid'=>$ecole), 'filiere_created_at');
                $data['promotion'] = $this->modeldb->fetch_row_data('ts_promotions', array('promotion_uid' => $key_uid));
                break;
            case 'annee':
                $data['annee'] = $this->modeldb->fetch_row_data('ts_annees', array('annee_uid' => $key_uid));
                break;
            default:
                null;
        }
        //$this->displayResults($data['ecole']);
        $data['title'] = ucfirst("$type - Updating| School Web Application"); // Capitalize the first letter
        $data['_view'] = ('app/params/update/' . $type);
        echo view('layouts/app', $data);
    }}

    public function changeStatus($table = null, $status_value = null, $uid = null)
    {
        switch ($table) {
            case 'typesens':
                $realnametable = 'ts_typesenseignements';
                $real_uid = 'typesens_uid';
                $status = 'typesens_statut';
                $updated_time = 'typesens_updated_at';
                $updated_by = 'typesens_updated_by';
                break;
            case 'degrespromotion':
                $realnametable = 'ts_degrespromotions';
                $real_uid = 'degres_uid';
                $status = 'degres_statut';
                $updated_time = 'degres_updated_at';
                $updated_by = 'degres_updated_by';
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

    function saveBranche()
    {
            $rulers = [
            'code_branche' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "enseignant obligatoire",
                ],
            ],
            'libelle_branche' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'branche obligatoire',
                ]
            ], 
        ];

        if ($this->validate($rulers)) {

            $code = trim(($this->request->getPost('code_branche')));
            $libelle = trim(($this->request->getPost('libelle_branche')));
            $current_datetime = date('Y-m-d H:i:s');

            if ($this->segment->getSegment(3) == "create") {
                $uid_random = $this->generateIdentifiant();
                //create new type
                $createNewTypeData = [
                    'branche_uid' => $uid_random,
                    'branche_code' => $code,
                    'branche_libelle' => $libelle,
                    'branche_statut' => 'actif',
                    'branche_created_at' => $current_datetime,
                    'branche_created_by' => $this->session->fullname . '-' . $this->session->role,
                    'branche_ecole_uid' => $this->session->schooluid,
                ];
                //save new data in table
                if ($this->modeldb->insert_data('ts_branches', $createNewTypeData)) {
                    return redirect()->back()->with('success', "Création branche. Opération effectuée avec succés");
                }
            } elseif ($this->segment->getSegment(3) == "update") {
                //update data
                $branche_uid = $this->segment->getSegment(4);
                $updateTypeData = [
                    'branche_code' => $code,
                    'branche_libelle' => $libelle,
                    'branche_updated_at' => $current_datetime,
                    'branche_updated_by' => $this->session->fullname . '-' . $this->session->role,
                ];
                //update data in table
                if ($this->modeldb->update_data('ts_branches', $updateTypeData, array('branche_uid' => $branche_uid))) {
                    return redirect()->back()->with('success', "Modification Branche. Opération effectuée avec succés");
                }
            } else {
                return redirect()->to(current_url(true));
            }

            return true;

        } else {
            return redirect()->back()->with('failed', "ERROR: Opération non effectuée. Veuillez réessayer plus tard !");
        }
    }

    function saveTypesepreuve()
    {
        if ($this->request->getMethod() == 'post') {

            $code = trim(htmlspecialchars($this->request->getPost('code_typesepreuve')));
            $libelle = trim(htmlspecialchars($this->request->getPost('libelle_typesepreuve')));
            $current_datetime = date('Y-m-d H:i:s');

            if ($this->segment->getSegment(3) == "create") {
                $uid_random = $this->generateIdentifiant();
                //create new type
                $createNewTypeData = [
                    'typesepreuve_uid' => $uid_random,
                    'typesepreuve_code' => $code,
                    'typesepreuve_libelle' => $libelle,
                    'typesepreuve_statut' => 'actif',
                    'typesepreuve_created_at' => $current_datetime,
                    'typesepreuve_created_by' => $this->session->fullname . '-' . $this->session->role,
                    'typesepreuve_ecole_uid' => $this->session->schooluid,
                ];
                //save new data in table
                if ($this->modeldb->insert_data('ts_typesepreuves', $createNewTypeData)) {
                    return redirect()->back()->with('success', "Création Type Epreuve. Opération effectuée avec succés");
                }
            } elseif ($this->segment->getSegment(3) == "update") {
                //update data
                $typesepreuve_uid = $this->segment->getSegment(4);
                $updateTypeData = [
                    'typesepreuve_code' => $code,
                    'typesepreuve_libelle' => $libelle,
                    'typesepreuve_updated_at' => $current_datetime,
                    'typesepreuve_updated_by' => $this->session->fullname . '-' . $this->session->role,
                ];
                //update data in table
                if ($this->modeldb->update_data('ts_typesepreuves', $updateTypeData, array('typesepreuve_uid' => $typesepreuve_uid))) {
                    return redirect()->back()->with('success', "Modification Type Epreuve. Opération effectuée avec succés");
                }
            } else {
                return redirect()->to(current_url(true));
            }

            return true;

        } else {
            return redirect()->back()->with('failed', "ERROR: Opération non effectuée. Veuillez réessayer plus tard !");
        }
    }

    function saveTypeEcole()
    {
        if ($this->request->getMethod() == 'post') {

            $code_typeecole = trim(htmlspecialchars($this->request->getPost('code_type_ecole')));
            $libelle_typeecole = trim(htmlspecialchars($this->request->getPost('libelle_type_ecole')));

            $current_datetime = date('Y-m-d H:i:s');
            if ($this->segment->getSegment(3) == "create") {
                $uid_typeecole = $this->generateIdentifiant();
                //create new type
                $createNewTypeData = [
                    'typesecole_uid' => $uid_typeecole,
                    'typesecole_code' => $code_typeecole,
                    'typesecole_libelle' => $libelle_typeecole,
                    'typesecole_statut' => 'actif',
                    'typesecole_created_at' => $current_datetime,
                    'typesecole_created_by' => $this->session->fullname . '-' . $this->session->role,
                ];
                //save new data in table
                if ($this->modeldb->insert_data('ts_typesecoles', $createNewTypeData)) {
                    return redirect()->back()->with('success', "SUCCESS: Opération effectuée avec succés");
                }
            } elseif ($this->segment->getSegment(3) == "update") {
                //update data
                $typesecole_uid = $this->segment->getSegment(4);
                $updateTypeData = [
                    'typesecole_code' => $code_typeecole,
                    'typesecole_libelle' => $libelle_typeecole,
                    'typesecole_updated_at' => $current_datetime,
                    'typesecole_updated_by' => $this->session->fullname . '-' . $this->session->role,
                ];
                //update data in table
                if ($this->modeldb->update_data('ts_typesecoles', $updateTypeData, array('typesecole_uid' => $typesecole_uid))) {
                    return redirect()->back()->with('success', "SUCCESS: Opération effectuée avec succés");
                }
            } else {
                return redirect()->to(current_url(true));
            }

            return true;

        } else {
            return redirect()->back()->with('failed', "ERROR: Opération non effectuée. Veuillez réessayer plus tard !");
        }
    }
    function saveCoordination()
    {
        if ($this->request->getMethod() == 'post') {

            $code = trim(htmlspecialchars($this->request->getPost('code_coordination')));
            $libelle = trim(htmlspecialchars($this->request->getPost('libelle_coordination')));

            $current_datetime = date('Y-m-d H:i:s');
            if ($this->segment->getSegment(3) == "create") {
                $uid_coordination = $this->generateIdentifiant();
                //create new type
                $createNewTypeData = [
                    'coordination_uid' => $uid_coordination,
                    'coordination_code' => $code,
                    'coordination_libelle' => $libelle,
                    'coordination_statut' => 'actif',
                    'coordination_created_at' => $current_datetime,
                    'coordination_created_by' => $this->session->fullname . '-' . $this->session->role,
                ];
                //save new data in table
                if ($this->modeldb->insert_data('ts_coordinations', $createNewTypeData)) {
                    return redirect()->back()->with('success', "Création coordination: Opération effectuée avec succés");
                }
            } elseif ($this->segment->getSegment(3) == "update") {
                //update data
                $typesecole_uid = $this->segment->getSegment(4);
                $updateTypeData = [
                    'coordination_code' => $code,
                    'coordination_libelle' => $libelle,
                    'coordination_updated_at' => $current_datetime,
                    'coordination_updated_by' => $this->session->fullname . '-' . $this->session->role,
                ];
                //update data in table
                if ($this->modeldb->update_data('ts_coordinations', $updateTypeData, array('coordination_uid' => $typesecole_uid))) {
                    return redirect()->back()->with('success', "Modification coordination: Opération effectuée avec succés");
                }
            } else {
                return redirect()->to(current_url(true));
            }

            return true;

        } else {
            return redirect()->back()->with('failed', "ERROR: Opération non effectuée. Veuillez réessayer plus tard !");
        }
    }

    function saveTypeEnseignement()
    {
        if ($this->request->getMethod() == 'post') {

            $code_typeens = trim(htmlspecialchars($this->request->getPost('code_type_enseignement')));
            $libelle_typeens = trim(htmlspecialchars($this->request->getPost('libelle_type_enseignement')));

            $current_datetime = date('Y-m-d H:i:s');
            if ($this->segment->getSegment(3) == "create") {
                $uid_typeens = $this->generateIdentifiant();
                //create new type
                $createNewTypeData = [
                    'typesens_uid' => $uid_typeens,
                    'typesens_code' => $code_typeens,
                    'typesens_libelle' => $libelle_typeens,
                    'typesens_statut' => 'actif',
                    'typesens_created_at' => $current_datetime,
                    'typesens_created_by' => $this->session->fullname . '-' . $this->session->role,
                ];
                //save new data in table
                if ($this->modeldb->insert_data('ts_typesenseignements', $createNewTypeData)) {
                    return redirect()->back()->with('success', "Creation: Opération effectuée avec succés");
                }
            } elseif ($this->segment->getSegment(3) == "update") {
                //update data
                $typesecole_uid = $this->segment->getSegment(4);
                $updateTypeData = [
                    'typesens_code' => $code_typeens,
                    'typesens_libelle' => $libelle_typeens,
                    'typesens_updated_at' => $current_datetime,
                    'typesens_updated_by' => $this->session->fullname . '-' . $this->session->role,
                ];
                //update data in table
                if ($this->modeldb->update_data('ts_typesenseignements', $updateTypeData, array('typesens_uid' => $typesecole_uid))) {
                    return redirect()->back()->with('success', "Modification: Opération effectuée avec succés");
                }
            } else {
                return redirect()->to(current_url(true));
            }

            return true;

        } else {
            return redirect()->back()->with('failed', "ERROR: Opération non effectuée. Veuillez réessayer plus tard !");
        }
    }

    function saveCategorieetudiants()
    {
        if ($this->request->getMethod() == 'post') {

            $code_typeetudiant = trim(($this->request->getPost('code_type_etudiant')));
            $libelle_typeetudiant = trim(($this->request->getPost('libelle_type_etudiant')));

            //$this->displayResults($libelle_typeetudiant);

            $current_datetime = date('Y-m-d H:i:s');
            if ($this->segment->getSegment(3) == "create") {
                $uid_typeetudiant = $this->generateIdentifiant();
                //create new type
                $createNewTypeData = [
                    'typesetudiant_uid' => $uid_typeetudiant,
                    'typesetudiant_code' => $code_typeetudiant,
                    'typesetudiant_libelle' => $libelle_typeetudiant,
                    'typesetudiant_statut' => 'actif',
                    'typesetudiant_created_at' => $current_datetime,
                    'typesetudiant_created_by' => $this->session->fullname . '-' . $this->session->role,
                    'typesetudiant_ecole_uid' => $this->session->schooluid,
                ];
                //save new data in table
                if ($this->modeldb->insert_data('ts_typesetudiants', $createNewTypeData)) {
                    return redirect()->back()->with('success', "Creation: Opération effectuée avec succés");
                }
            } elseif ($this->segment->getSegment(3) == "update") {
                //update data
                $typeseetudiant_uid = $this->segment->getSegment(4);
                $updateTypeData = [
                    'typesetudiant_code' => $code_typeetudiant,
                    'typesetudiant_libelle' => $libelle_typeetudiant,
                    'typesetudiant_updated_at' => $current_datetime,
                    'typesetudiant_updated_by' => $this->session->fullname . '-' . $this->session->role,
                    'typesetudiant_ecole_uid' => $this->session->schooluid,
                ];
                //update data in table
                if ($this->modeldb->update_data('ts_typesetudiants', $updateTypeData, array('typesetudiant_uid' => $typeseetudiant_uid))) {
                    return redirect()->back()->with('success', "Modification: Opération effectuée avec succés");
                }
            } else {
                return redirect()->to(current_url(true));
            }

            return true;

        } else {
            return redirect()->back()->with('failed', "ERROR: Opération non effectuée. Veuillez réessayer plus tard !");
        }
    }

    function saveDegrespromotions()
    {
        if ($this->request->getMethod() == 'post') {

            $code_degres = trim(htmlspecialchars($this->request->getPost('code_degres')));
            $libelle_degres = trim(htmlentities($this->request->getPost('libelle_degres'), ENT_QUOTES));

            $current_datetime = date('Y-m-d H:i:s');
            if ($this->segment->getSegment(3) == "create") {
                $random_uid_degres = $this->generateIdentifiant();
                //create new type
                $createNewTypeData = [
                    'degres_uid' => $random_uid_degres,
                    'degres_code' => $code_degres,
                    'degres_libelle' => $libelle_degres,
                    'degres_statut' => 'actif',
                    'degres_created_at' => $current_datetime,
                    'degres_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                    'degres_ecole_uid' => $this->session->schooluid,
                ];
                //save new data in table
                if ($this->modeldb->insert_data('ts_degrespromotions', $createNewTypeData)) {
                    return redirect()->back()->with('success', "Creation: Opération effectuée avec succés");
                }
            } elseif ($this->segment->getSegment(3) == "update") {
                //update data
                $degres_uid = $this->segment->getSegment(4);
                $updateTypeData = [
                    'degres_code' => $code_degres,
                    'degres_libelle' => $libelle_degres,
                    'degres_updated_at' => $current_datetime,
                    'degres_updated_by' => $this->session->fullname . ' - ' . $this->session->role,
                    'degres_ecole_uid' => $this->session->schooluid,
                ];
                //update data in table
                if ($this->modeldb->update_data('ts_degrespromotions', $updateTypeData, array('degres_uid' => $degres_uid))) {
                    return redirect()->back()->with('success', "Modification: Opération effectuée avec succés");
                }
            } else {
                return redirect()->to(current_url(true));
            }

            return true;

        } else {
            return redirect()->back()->with('failed', "ERROR: Opération non effectuée. Veuillez réessayer plus tard !");
        }
    }

    function saveCycles()
    {
        if ($this->request->getMethod() == 'post') {

            $code_cycle = trim(htmlspecialchars($this->request->getPost('code_cycle')));
            $libelle_cycle = trim(htmlentities($this->request->getPost('libelle_cycle'), ENT_QUOTES));

            $current_datetime = date('Y-m-d H:i:s');
            if ($this->segment->getSegment(3) == "create") {
                $random_uid_cycle = $this->generateIdentifiant();
                //create new type
                $createNewTypeData = [
                    'cycle_uid' => $random_uid_cycle,
                    'cycle_code' => $code_cycle,
                    'cycle_libelle' => $libelle_cycle,
                    'cycle_statut' => 'actif',
                    'cycle_created_at' => $current_datetime,
                    'cycle_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                    'cycle_ecole_uid' => $this->session->schooluid,
                ];
                //save new data in table
                if ($this->modeldb->insert_data('ts_cycles', $createNewTypeData)) {
                    return redirect()->back()->with('success', "Création: Opération effectuée avec succés");
                }
            } elseif ($this->segment->getSegment(3) == "update") {
                //update data
                $cycle_uid = $this->segment->getSegment(4);
                $updateTypeData = [
                    'cycle_code' => $code_cycle,
                    'cycle_libelle' => $libelle_cycle,
                    'cycle_updated_at' => $current_datetime,
                    'cycle_updated_by' => $this->session->fullname . ' - ' . $this->session->role,
                    'cycle_ecole_uid' => $this->session->schooluid,
                ];
                //update data in table
                if ($this->modeldb->update_data('ts_cycles', $updateTypeData, array('cycle_uid' => $cycle_uid))) {
                    return redirect()->back()->with('success', "Modification: Opération effectuée avec succés");
                }
            } else {
                return redirect()->to(current_url(true));
            }

            return true;

        } else {
            $this->session->setTempdata('failed', "ERROR: Opération non effectuée. Veuillez réessayer plus tard !");
            return redirect()->back()->withInput();
        }
    }

    function savefiliere()
    {
        if ($this->request->getMethod() == 'post') {

            $code_filiere = trim(htmlspecialchars($this->request->getPost('code_filiere')));
            $libelle_filiere_sid = trim(htmlentities($this->request->getPost('filiere_sid'), ENT_QUOTES));

            $libelle_option = trim(htmlentities($this->request->getPost('libelle_option'), ENT_QUOTES));

            $libelle_filiere = ($libelle_filiere_sid == 'new') ? trim(htmlentities($this->request->getPost('libelle_filiere'), ENT_QUOTES)) : $libelle_filiere_sid;

            $current_datetime = date('Y-m-d H:i:s');
            if ($this->segment->getSegment(3) == "create") {
                $random_uid_filiere = $this->generateIdentifiant();
                //create new type
                $createNewTypeData = [
                    'filiere_uid' => $random_uid_filiere,
                    'filiere_code' => $code_filiere,
                    'filiere_libelle' => $libelle_filiere,
                    'option_libelle' => $libelle_option,
                    'filiere_statut' => 'actif',
                    'filiere_created_at' => $current_datetime,
                    'filiere_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                    'filiere_ecole_uid' => $this->session->schooluid,
                ];
                //save new data in table
                if ($this->modeldb->insert_data('ts_filieres', $createNewTypeData)) {
                    return redirect()->back()->with('success', "Création: Opération effectuée avec succés");
                }
            } elseif ($this->segment->getSegment(3) == "update") {
                //update data
                $filiere_uid = $this->segment->getSegment(4);
                $updateTypeData = [
                    'filiere_code' => $code_filiere,
                    'filiere_libelle' => $libelle_filiere,
                    'option_libelle' => $libelle_option,
                    'filiere_updated_at' => $current_datetime,
                    'filiere_updated_by' => $this->session->fullname . ' - ' . $this->session->role,
                    'filiere_ecole_uid' => $this->session->schooluid,
                ];
                //update data in table
                if ($this->modeldb->update_data('ts_filieres', $updateTypeData, array('filiere_uid' => $filiere_uid))) {
                    return redirect()->back()->with('success', "Modification: Opération effectuée avec succés");
                }
            } else {
                return redirect()->to(current_url(true));
            }

            return true;

        } else {
            $this->session->setTempdata('failed', "ERROR: Opération non effectuée. Veuillez réessayer plus tard !");
            return redirect()->back()->withInput();
        }
    }

    function savePeriode()
    {
        $data = [];
        $rulers = [
            'code_periode' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Code obligatoire",
                ],
            ],
            'libelle_periode' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Libelle obligatoire',
                ]
            ], 'type_periode' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Type obligatoire',
                ]
            ], 
        ];

        if ($this->validate($rulers)) {
            $code_periode = trim(htmlspecialchars($this->request->getPost('code_periode')));
            $libelle_periode = trim(htmlspecialchars($this->request->getPost('libelle_periode')));
            $type_periode = trim(htmlspecialchars($this->request->getPost('type_periode')));
            $date_debut_periode = trim(htmlspecialchars($this->request->getPost('date_debut_periode')));
            $date_fin_periode = trim(htmlspecialchars($this->request->getPost('date_fin_periode')));
            $random_uid_periode = $this->generateIdentifiant();
            $current_datetime = date('Y-m-d H:i:s');

            $periode_type_selected = ($type_periode == 'new') ? trim(htmlspecialchars($this->request->getPost('nouveau_type_periode'))) : $type_periode;
            if ($this->segment->getSegment(3) == "create") {
                //table data
                $saveTypeData = [
                    'periode_uid' => $random_uid_periode,
                    'periode_code' => $code_periode,
                    'periode_libelle' => $libelle_periode,
                    'periode_type' => $periode_type_selected,
                    'periode_date_debut' => $date_debut_periode,
                    'periode_date_fin' => $date_fin_periode,
                    'periode_statut' => 'actif',
                    'periode_created_at' => $current_datetime,
                    'periode_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                    'periode_ecole_uid' => $this->session->schooluid,
                ];
                //save new data in table
                if ($this->modeldb->insert_data('ts_periodes', $saveTypeData)) {
                    return redirect()->back()->with('success', "SUCCESS: Opération effectuée avec succés");
                }
            } elseif ($this->segment->getSegment(3) == "update") {
                //update data
                $periode_uid = $this->segment->getSegment(4);
                $updateTypeData = [
                    'periode_code' => $code_periode,
                    'periode_libelle' => $libelle_periode,
                    'periode_type' => $type_periode,
                    'periode_date_debut' => $date_debut_periode,
                    'periode_date_fin' => $date_fin_periode,
                    'periode_updated_at' => $current_datetime,
                    'periode_comment' => trim(htmlentities($this->request->getPost('commentaire_periode'))),
                    'periode_updated_by' => $this->session->fullname . ' - ' . $this->session->role,
                ];
                //update data in table
                if ($this->modeldb->update_data('ts_periodes', $updateTypeData, array('periode_uid' => $periode_uid))) {
                    return redirect()->back()->with('success', "SUCCESS: Opération effectuée avec succés");
                }
            } else {
                return redirect()->to(current_url(true));
            }
        } else {
            $this->session->setFlashdata('failed', 'ERROR: Opération non effectuée. Veuillez  vérifier ci-dessous les erreurs rencontrées puis réessayer !');
            $data['validation'] = $this->validator;
            $data['_view'] = ($this->segment->getSegment(3) == "update") ? ('app/params/update/periode') : ('app/params/create/periode');
        }
        return view('layouts/app', $data);
    }

    function saveEcole()
    {
        $data = [];
        $rulers = [
            'code_ecole' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Code obligatoire",
                ],
            ],
            'libelle_ecole' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Libelle obligatoire',
                ]
            ], 'typeens_sid' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Type Enseignement obligatoire',
                ]
            ], 'typeecole_sid' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Type Ecole obligatoire',
                ]
            ],'coordination_ecole' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'coordination_ecole obligatoire',
                ]
            ],
        
        ];
    
        if ($this->validate($rulers)) {
            $code_ecole = trim(htmlspecialchars($this->request->getPost('code_ecole')));
            $libelle_ecole = trim(htmlspecialchars($this->request->getPost('libelle_ecole')));
            $type_enseign_fk = trim(htmlspecialchars($this->request->getPost('typeens_sid')));
            $type_ecole_fk = trim(htmlspecialchars($this->request->getPost('typeecole_sid')));
            $gestionnaire = trim(htmlspecialchars($this->request->getPost('gestionnaire_ecole')));
            $coordination = trim(htmlspecialchars($this->request->getPost('coordination_ecole')));

            $client = trim(htmlspecialchars($this->request->getPost('client_ecole')));

            $current_datetime = date('Y-m-d H:i:s');

            if ($this->segment->getSegment(3) == "create") {
                $random_uid_ecole = $this->generateIdentifiant();
                //table data
                $saveTypeData = [
                    'ecole_uid' => $random_uid_ecole,
                    'ecole_code' => $code_ecole,
                    'ecole_libelle' => $libelle_ecole,
                    'typesecole_uid' => $type_ecole_fk,
                    'typesens_uid' => $type_enseign_fk,
                    'ecole_coordination' => $coordination,
                    'ecole_gestionnaire' => $gestionnaire,
                    'ecole_statut' => 'actif',
                    'ecole_created_at' => $current_datetime,
                    'ecole_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                    'ecole_client_uid' => $client, // client de l'ecole
                ];
                //save new data in table  '', ''


                if ($this->modeldb->insert_data('ts_ecoles', $saveTypeData)) {
                   
                    return redirect()->back()->with('success', "Creation: Opération effectuée avec succés");
                }
            } elseif ($this->segment->getSegment(3) == "update") {
                //update data
                $ecole_uid = $this->segment->getSegment(4);

                $ville = trim(htmlspecialchars($this->request->getPost('ville_ecole')));
                $province = trim(htmlspecialchars($this->request->getPost('province_ecole')));
                $email = trim(htmlspecialchars($this->request->getPost('email_ecole')));
                $telephone = trim(htmlspecialchars($this->request->getPost('telephone_ecole')));
                $devise = trim(htmlspecialchars($this->request->getPost('devise_ecole')));
                $siteweb = trim(htmlspecialchars($this->request->getPost('siteweb_ecole')));
                $adresse = trim(htmlspecialchars($this->request->getPost('adresse_ecole')));
                $comments = trim(htmlspecialchars($this->request->getPost('commentaire_ecole')));

                $fullpathlogo = '';
                if ($this->request->getFile('logo_ecole') != '') {
                    $logoFile = $this->request->getFile('logo_ecole');
                    //foreach($imagefile['images'] as $img){
                    if ($logoFile->isValid() && !$logoFile->hasMoved()) {
                        //rename image
                        $newNameLogoFileUpload = $logoFile->getRandomName();
                        $fullPathFile = 'global/uploads/images';
                        //move to upload directory
                        $logoFile->move(ROOTPATH . $fullPathFile, $newNameLogoFileUpload);
                        $fullpathlogo = base_url() . '/' . $fullPathFile . '/' . $newNameLogoFileUpload;
                    }
                }

                $updateTypeData = [
                    'ecole_code' => $code_ecole,
                    'ecole_libelle' => $libelle_ecole,
                    'typesecole_uid' => $type_ecole_fk,
                    'typesens_uid' => $type_enseign_fk,
                    'ecole_gestionnaire' => $gestionnaire,
                    'ecole_updated_at' => $current_datetime,
                    'ecole_updated_by' => $this->session->fullname . ' - ' . $this->session->role,
                    'ecole_coordination' => $coordination,
                    'ecole_ville' => $ville,
                    'ecole_province' => $province,
                    'ecole_email' => $email,
                    'ecole_telephone' => $telephone,
                    'ecole_devise' => $devise,
                    'ecole_siteweb' => $siteweb,
                    'ecole_adresse' => $adresse,
                    'ecole_comment' => $comments,
                    'ecole_logo' => $fullpathlogo,
                    //'ecole_client_uid' => $client, // client de l'ecole
                ];
                //update data in table
                if ($this->modeldb->update_data('ts_ecoles', $updateTypeData, array('ecole_uid' => $ecole_uid))) {
                    return redirect()->back()->with('success', "Modification: Opération effectuée avec succés");
                }
            } else {
                return redirect()->to(current_url(true));
            }
        } else {
            $data['ecole'] = ($this->segment->getTotalSegments() >= 4) ? $this->modeldb->fetch_row_data('ts_ecoles', array('ecole_uid' => $this->segment->getSegment(4))) : '';
            $this->session->setFlashdata('failed', 'ERROR: Opération non effectuée. Veuillez  vérifier ci-dessous les erreurs rencontrées puis réessayer !');
           
            $data['typesecoles'] = $this->modeldb->fetch_all_data('ts_typesecoles', array('typesecole_statut' => 'actif'), 'typesecole_created_at');

            $data['typesens'] = $this->modeldb->fetch_all_data('ts_typesenseignements', array('typesens_statut' => 'actif'), 'typesens_created_at'); 

            $data['coordinations'] = $this->modeldb->fetch_all_data('ts_coordinations', array('coordination_statut' => 'actif'), 'coordination_created_at');

             $data['clients'] = $this->modeldb->fetch_all_data('ts_clients', array('client_statut'=>'actif'), 'client_created_at');

            $data['validation'] = $this->validator;
            $data['_view'] = ($this->segment->getSegment(3) == "update") ? ('app/params/update/ecole') : ('app/params/create/ecole');
        }
         return view('layouts/app', $data);
    }

    function lancerNouvelleAnneeScolaire()
    {
        $data = [];
        $rulers = [
            'code_annee' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Code obligatoire",
                ],
            ],
            'libelle_annee' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Libelle obligatoire',
                ]
            ],
        ];

        if ($this->validate($rulers)) {
            $code_annee = trim(htmlspecialchars($this->request->getPost('code_annee')));
            $libelle_annee = trim(htmlspecialchars($this->request->getPost('libelle_annee')));
            $current_datetime = date('Y-m-d H:i:s');
            $random_uid_annee = $this->generateIdentifiant();

            //verifier si l'annee lancee existe deja pour cette ecole
            $chechExistsYear = $this->modeldb->fetch_field_value('ts_annees', array('annee_statut' => 'actif'));

            if (!empty($chechExistsYear)) {
                if ($chechExistsYear->annee_libelle == $libelle_annee) {
                    return redirect()->back()->with('failed', "ERREUR: Désolé, cette année est déja lancée");
                }
            }
            //table data
            $saveTypeData = [
                'annee_uid' => $random_uid_annee,
                'annee_code' => $code_annee,
                'annee_libelle' => $libelle_annee,
                'annee_statut' => 'actif',
                'annee_date_ouverture' => date('Y-m-d'),
                'annee_created_at' => $current_datetime,
                'annee_created_by' => $this->session->fullname . ' - ' . $this->session->role,
            ];
            //save new data in table  '', ''
            $upStatus = ['annee_statut' => 'inactif', 'annee_date_cloture' => date('Y-m-d')];
            if ($this->modeldb->update_data('ts_annees', $upStatus, array('annee_statut' => 'actif'))) {
                $this->modeldb->insert_data('ts_annees', $saveTypeData);

                //disconnect user
                //return redirect()->to(base_url('secure/initNewSchoolYear'));

                $this->session->set('yearuid', $random_uid_annee);
                $this->session->set('yearlibelle', $libelle_annee);
                return redirect()->back()->with('success', "Nouvelle année lancée avec succés. l'affichage de données liees aux années sera initialisé.");
            } else
                return redirect()->back()->with('failed', "ERREUR: Désolé, une erreur systeme s'est produite. Veuillez réessayer plus tard.");


        } else {
            $data['annee'] = ($this->segment->getTotalSegments() >= 4) ? $this->modeldb->fetch_row_data('ts_annees', array('annee_uid' => $this->segment->getSegment(4))) : '';
            $this->session->setFlashdata('failed', 'ERROR: Opération non effectuée. Veuillez  vérifier ci-dessous les erreurs rencontrées puis réessayer !');
            $data['validation'] = $this->validator;
            $data['_view'] = ('app/params/listing/annees');
            return view('layouts/app', $data);
        }
    }

    function saveAnneeScolaire()
    {
        $data = [];
        $rulers = [
            'code_annee' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Code obligatoire",
                ],
            ],
            'libelle_annee' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Libelle obligatoire',
                ]
            ],
        ];

        if ($this->validate($rulers)) {
            $code_annee = trim(htmlspecialchars($this->request->getPost('code_annee')));
            $libelle_annee = trim(htmlspecialchars($this->request->getPost('libelle_annee')));

            $current_datetime = date('Y-m-d H:i:s');

            if ($this->segment->getSegment(3) == "update") {
                //update data
                $annee_uid = $this->segment->getSegment(4);

                /*
                $gestionnaire = trim(htmlspecialchars($this->request->getPost('gestionnaire_ecole')));
                $effectif_etudiants = trim(htmlspecialchars($this->request->getPost('effectif_etudiants_annee')));
                $effectif_agents = trim(htmlspecialchars($this->request->getPost('effectif_personnels_annee')));
                $disciplinaire_annee = trim(htmlspecialchars($this->request->getPost('directeur_discipline_annee')));
                $prefet_annee = trim(htmlspecialchars($this->request->getPost('prefet_annee')));
                $directeur_annee = trim(htmlspecialchars($this->request->getPost('directeur_etudes_annee')));
                */
                $cloture_annee = trim(htmlspecialchars($this->request->getPost('date_fin_annee')));
                $ouverture_annee = trim(htmlspecialchars($this->request->getPost('date_debut_annee')));
                $comments = trim(htmlspecialchars($this->request->getPost('commentaire_annee')));
                //'annee_ecole_uid' => $ecole_fk,
                //'annee_gestionnaire' => $gestionnaire,
                //  //'annee_effectif_etudiants' => $effectif_etudiants,
                //                    //'annee_effectif_agents' => $effectif_agents,
                //                    //'annee_prefet' => $prefet_annee,
                //                    //'annee_directeur' => $directeur_annee,
                //                    //'annee_disciplinaire' => $disciplinaire_annee,
                $updateTypeData = [
                    'annee_code' => $code_annee,
                    'annee_libelle' => $libelle_annee,
                    'annee_updated_at' => $current_datetime,
                    'annee_updated_by' => $this->session->fullname . ' - ' . $this->session->role,
                    'annee_date_ouverture' => $ouverture_annee,
                    'annee_date_cloture' => $cloture_annee,
                    'annee_comment' => $comments,
                ];
                //update data in table
                if ($this->modeldb->update_data('ts_annees', $updateTypeData, array('annee_uid' => $annee_uid))) {
                    return redirect()->back()->with('success', "Modification: Opération effectuée avec succés");
                }
            } else {
                return redirect()->to(current_url(true));
            }
        } else {
            $data['annee'] = ($this->segment->getTotalSegments() >= 4) ? $this->modeldb->fetch_row_data('ts_annees', array('annee_uid' => $this->segment->getSegment(4))) : '';
            $this->session->setFlashdata('failed', 'ERROR: Opération non effectuée. Veuillez  vérifier ci-dessous les erreurs rencontrées puis réessayer !');
            $data['validation'] = $this->validator;
            $data['_view'] = ($this->segment->getSegment(3) == "update") ? ('app/params/update/annee') : ('app/params/listing/annees');

            
        }
        return view('layouts/app', $data);
    }

    function savepromotion()
    {
        $data = [];
        $rulers = [
            'code_promotion' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Code obligatoire",
                ],
            ],
            'libelle_promotion' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Libelle obligatoire',
                ]
            ], 'degres_sid_promotion' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Degres obligatoire',
                ]
            ], 'cycle_sid_promotion' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Cycle obligatoire',
                ]
            ], 'filiere_sid_promotion' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'filiere obligatoire',
                ]
            ],
        ];

        if ($this->validate($rulers)) {
            $code_promotion = trim(htmlspecialchars($this->request->getPost('code_promotion')));
            $libelle_promotion = trim(htmlspecialchars($this->request->getPost('libelle_promotion')));
            $degres_fk = trim(htmlspecialchars($this->request->getPost('degres_sid_promotion')));
            $cycle_fk = trim(htmlspecialchars($this->request->getPost('cycle_sid_promotion')));
            $filiere_fk = trim(htmlspecialchars($this->request->getPost('filiere_sid_promotion')));

            $current_datetime = date('Y-m-d H:i:s');

            if ($this->segment->getSegment(3) == "create") {
                $random_uid_promotion = $this->generateIdentifiant();
                //table data
                $saveTypeData = [
                    'promotion_uid' => $random_uid_promotion,
                    'promotion_code' => $code_promotion,
                    'promotion_libelle' => $libelle_promotion,
                    'promotion_degres_uid' => $degres_fk,
                    'promotion_cycle_uid' => $cycle_fk,
                    'promotion_filiere_uid' => $filiere_fk,

                    'promotion_statut' => 'actif',
                    'promotion_created_at' => $current_datetime,
                    'promotion_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                    'promotion_ecole_uid' => $this->session->schooluid,
                ];
                //save new data in table  '', ''
                if ($this->modeldb->insert_data('ts_promotions', $saveTypeData)) {
                    return redirect()->back()->with('success', "Creation: Opération effectuée avec succés");
                }
            } elseif ($this->segment->getSegment(3) == "update") {
                //update data
                $promotion_uid = $this->segment->getSegment(4);

                $titulaire = trim(htmlspecialchars($this->request->getPost('titulaire_promotion')));
                $effectif = trim(htmlspecialchars($this->request->getPost('effectif_etudiants')));
                $comments = trim(htmlspecialchars($this->request->getPost('commentaire_promotion')));

                $updateTypeData = [
                    'promotion_code' => $code_promotion,
                    'promotion_libelle' => $libelle_promotion,
                    'promotion_degres_uid' => $degres_fk,
                    'promotion_cycle_uid' => $cycle_fk,
                    'promotion_filiere_uid' => $filiere_fk,

                    'promotion_titulaire' => $titulaire,
                    'promotion_effectif' => $effectif,
                    'promotion_statut' => 'actif',
                    'promotion_updated_at' => $current_datetime,
                    'promotion_updated_by' => $this->session->fullname . ' - ' . $this->session->role,
                    'promotion_ecole_uid' => $this->session->schooluid,
                    'promotion_comment' => $comments,
                ];
                //update data in table
                if ($this->modeldb->update_data('ts_promotions', $updateTypeData, array('promotion_uid' => $promotion_uid))) {
                    return redirect()->back()->with('success', "Modification: Opération effectuée avec succés");
                }
            } else {
                return redirect()->to(current_url(true));
            }
        } else {

        $ecole = $this->session->schooluid;

            $data['promotion'] = ($this->segment->getTotalSegments() >= 4) ? $this->modeldb->fetch_row_data('ts_promotions', array('promotion_uid' => $this->segment->getSegment(4))) : '';

            $data['degres'] = $this->modeldb->fetch_all_data('ts_degrespromotions', array('degres_statut' => 'actif', 'degres_ecole_uid'=>$ecole), 'degres_created_at');
            $data['cycles'] = $this->modeldb->fetch_all_data('ts_cycles', array('cycle_statut' => 'actif', 'cycle_ecole_uid'=>$ecole), 'cycle_created_at');
            $data['filieres'] = $this->modeldb->fetch_all_data('ts_filieres', array('filiere_statut' => 'actif', 'filiere_ecole_uid'=>$ecole), 'filiere_created_at');

            $this->session->setFlashdata('failed', 'ERROR: Opération non effectuée. Veuillez  vérifier ci-dessous les erreurs rencontrées puis réessayer !');

            $data['validation'] = $this->validator;
            $data['_view'] = ($this->segment->getSegment(3) == "update") ? ('app/params/update/promotion') : ('app/params/create/promotion');
        }
        return view('layouts/app', $data);
    }
}
