<?php
/**
 * Created by PhpStorm.
 * User: ElieMwezRubuz
 * Date: 01-Mar-21
 * Time: 11:05 AM
 */

namespace App\Controllers;

//mail sending namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//mail files sending
require_once APPPATH . 'ThirdParty/PHPMailer/src/Exception.php';
require_once APPPATH . 'ThirdParty/PHPMailer/src/PHPMailer.php';
require_once APPPATH . 'ThirdParty/PHPMailer/src/SMTP.php';

//import Models
use App\Models\AppModel;

class etudiant extends BaseController
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
        $this->dossier('inscription');
    }
    public function affectation()
    {
        $ecole = $this->session->schooluid;   # GET SCHOOL ID

        $data['etudiants'] = $this->modeldb->fetch_join_inscription(array('etudiant_ecole_uid' => $ecole), 'inscription_created_at');
        $data['title'] = ucfirst("Affectation des étudiants"); // Capitalize the first letter
        $data['_view'] = ('app/etudiant/affectation');
        echo view('layouts/app', $data);
    }
    public function dossier($type = null)
    {
        $annee = ($this->request->getGet('y')) ? $this->request->getGet('y') : $this->session->yearuid;     #GET YEAR ID
        $ecole = ($this->request->getGet('s')) ? $this->request->getGet('s') : $this->session->schooluid;   # GET SCHOOL ID

        $anneeScolaire = $this->modeldb->fetch_field_value('ts_annees', array('annee_uid' => $annee))->annee_libelle; # GET YEAR LIBELLE

        $this->session->set('yearlibelle', $anneeScolaire);     # CHANGE YEAR LIBELLE VALUE USED ACTUALLY

        $data['annees'] = $this->modeldb->fetch_all_data('ts_annees', array('annee_deleted_at' => null), 'annee_created_at');
        switch ($type) {
            case 'parent':
                $data['parents'] = $this->modeldb->fetch_all_data('ts_parents', array('parent_deleted_at' => null, 'parent_ecole_uid' => $ecole), 'parent_created_at');
                break;
            case 'inscription':
                $data['etudiants'] = $this->modeldb->fetch_join_inscription(array('etudiant_ecole_uid' => $ecole,
                    'inscription_annee_uid' => $annee), 'inscription_created_at');
                break;
            case 'transfert':
                $data['transferts'] = $this->modeldb->fetch_join_transferts(array('ts_transferts.transfert_deleted_at' => null, 'etudiant_ecole_uid' => $ecole), 'transfert_created_at');
                break;

            case 'promotionment':
                $data['etudiants'] = $this->modeldb->fetch_join_inscription(array('ts_etudiants.etudiant_statut' => 'actif', 'etudiant_ecole_uid' => $ecole,
                    'inscription_annee_uid' => $annee, 'inscription_type' => 'affectation'), 'inscription_created_at');
                $data['promotions'] = $this->modeldb->fetch_join_promotions(array('ts_promotions.promotion_statut' => 'actif', 'promotion_ecole_uid' => $ecole),
                    'promotion_libelle');
                break;
            default:
                null;
        }
        if ($this->request->getGet('promotion')) {
            $promotion_filtre_etudiants = $this->request->getGet('promotion');
            $data['etudiants_promotions'] = $this->modeldb->fetch_join_inscription(array('ts_etudiants.etudiant_statut' => 'actif', 'etudiant_ecole_uid' => $ecole,
                'inscription_promotion_uid' => $promotion_filtre_etudiants), 'inscription_created_at');

            $this->session->set('promotion', $promotion_filtre_etudiants);     # CHANGE promotion FILTER

            $data['promotion'] = $this->modeldb->fetch_join_promotions(array('ts_promotions.promotion_uid' => $promotion_filtre_etudiants, 'promotion_ecole_uid' => $ecole),
                'promotion_created_at', 'row');
        }
        //$this->displayResults($data['etudiants_promotions']);

        $data['title'] = ucfirst("Dossier - $type | School Web Application"); // Capitalize the first letter
        $data['_view'] = ('app/etudiant/' . $type . '/listing');
        echo view('layouts/app', $data);
    }

    public function cursus($type = null, $type_id = null)
    {
        $annee = $this->session->yearuid;     #GET YEAR ID
        $ecole = $this->session->schooluid;   # GET SCHOOL ID

        $data = [];

        if (!empty($type_id)) {
            $data['etudiant'] = $this->modeldb->fetch_row_data('ts_etudiants', array('etudiant_uid' => $type_id));
            $data['inscription'] = $this->modeldb->fetch_status_data('vs_parcours_scolaires', array('etudiant_uid' => $type_id), 'annee_libelle');
            //page and folder
            $data['title'] = ucfirst("etudiant - $type | Eduschool Web Application"); // Capitalize the first letter
            $data['_view'] = ('app/etudiant/cursus/details/' . $type);
        } else {
            if ($type == 'parcours') {
                $data['etudiants'] = $this->modeldb->fetch_join_etudiants(array('etudiant_statut' => 'actif', 'etudiant_ecole_uid' => $ecole), 'etudiant_created_at');
            } else {
                if ($this->request->getGet('promotion')) {
                    $promotion_filtre_etudiants = $this->request->getGet('promotion');
                    $data['etudiants'] = $this->modeldb->fetch_join_inscription(array('ts_etudiants.etudiant_statut' => 'actif', 'etudiant_ecole_uid' => $ecole, 'inscription_promotion_uid' => $promotion_filtre_etudiants), 'inscription_created_at');

                    $data['promotion'] = $this->modeldb->fetch_join_promotions(array('ts_promotions.promotion_uid' => $promotion_filtre_etudiants, 'promotion_ecole_uid' => $ecole), 'promotion_created_at', 'row');
                } else {

                    $data['etudiants'] = $this->modeldb->fetch_join_inscription(array('etudiant_statut' => 'actif', 'etudiant_ecole_uid' => $ecole, 'inscription_annee_uid' => $annee), 'inscription_created_at');
                }

            }

            $data['title'] = ucfirst("Suivi Cursus - $type | School Web Application");
            $data['_view'] = ('app/etudiant/cursus/' . $type);
        }

        $data['promotions'] = $this->modeldb->fetch_join_promotions(array('ts_promotions.promotion_statut' => 'actif', 'promotion_ecole_uid' => $ecole), 'promotion_libelle');

        $data['annees'] = $this->modeldb->fetch_all_data('ts_annees', array('annee_deleted_at' => null), 'annee_libelle');

        //$this->displayResults($data['inscription']);

        return view('layouts/app', $data);
    }

    public function bulletin($etudiant = null, $promotion = null)
    {
        $annee = $this->session->yearuid;     #GET YEAR ID
        $ecole = $this->session->schooluid;   # GET SCHOOL ID

        $data['etudiant'] = $this->modeldb->fetch_row_data('ts_etudiants', array('etudiant_uid' => $etudiant));

        $data['promotion'] = $this->modeldb->fetch_join_promotions(array('promotion_uid' => $promotion, 'promotion_ecole_uid' => $ecole), 'promotion_created_at', 'row');

        $data['cotes'] = $this->modeldb->fetch_cotes_bulletin(array('etudiant_uid' => $etudiant, 'promotion_uid' => $promotion, 'bulletin_ecole_uid' => $ecole), 'matiere_ordre_bulletin', 'ASC');

        $cyclepromotion = $data['promotion']['promotion_cycle_uid'];

        $cycleInfos = $this->modeldb->fetch_row_data('ts_cycles', array('cycle_uid' => $cyclepromotion));

        $data['maximas'] = $this->modeldb->fetch_all_data('ts_maximas', array('maxima_ecole_uid' => $ecole, 'maxima_cycle_uid' => $cyclepromotion), 'maxima_created_at', null, null, 'maxima_libelle');

        $cycle_conv = $this->remove_string_accent(url_title(strtolower($cycleInfos['cycle_libelle'])));

        switch ($cycle_conv) {
            case 'secondaire':
            case 'scondaire':
                $data['_view'] = ('app/etudiant/cursus/details/secondaire');
                break;
            case 'maternel':
            case 'maternelle':
                $data['_view'] = ('app/etudiant/cursus/details/maternelle');
                break;
            default:
                $data['_view'] = ('app/etudiant/cursus/details/primaire');
                break;
        }

        $data['title'] = ucfirst("Bulletin - ") . $cycle_conv . " | School Web Application"; // Capitalize the first

        //$this->displayResults($data['_view']);

        echo view('layouts/app', $data);
    }

    public function details($type = null, $id = null, $fkuid = null)
    {
        switch ($type) {
            case 'parent':
                $data['parent'] = $this->modeldb->fetch_row_data('ts_parents', array('parent_uid' => $id));

                //$data['enfants'] = $this->modeldb->fetch_join_etudiants(array('etudiant_ecole_uid' => $this->session->schooluid,
                // 'parent_uid' => $id), 'etudiant_created_at');
                $data['enfants'] = $this->modeldb->fetch_join_inscription(array('etudiant_tuteur_uid' => $id), 'etudiant_created_at');

                break;
            case 'inscription':
                $data['inscription'] = $this->modeldb->fetch_join_inscription(array('ts_etudiants.etudiant_uid' => $id), 'inscription_date', 'row');
                $data['promotion'] = $this->modeldb->fetch_join_promotions(array('ts_promotions.promotion_uid' => $fkuid), 'promotion_created_at', 'row');
                $data['etudiant'] = $this->modeldb->fetch_join_etudiants(array('ts_etudiants.etudiant_uid' => $id), 'etudiant_created_at', 'row');
                $data['parents'] = $this->modeldb->fetch_all_data('ts_parents', array('parent_statut' => 'actif'), 'parent_created_at');
                break;
            case 'transfert':
                $data['transfert'] = $this->modeldb->fetch_join_transferts(array('ts_transferts.transfert_uid' => $id), 'transfert_created_at', 'row');
                break;
            default:
                null;
        }
        //$this->displayResults($data['enfants']);

        $data['title'] = ucfirst("Details - $type | School Web Application"); // Capitalize the first letter
        $data['_view'] = ('app/etudiant/' . $type . '/details');
        echo view('layouts/app', $data);
    }

    public function addForm($type = null)
    {
        //si annee est inactif, aucune creation n'est autorisee
        if ($this->session->yearstatus == 'inactif') {
            return redirect()->back()->with('info', "Année Fermée: La création n'est pas autorisée sur une année fermée");
        } else {
            $ecole = $this->session->schooluid;
            $annee_encours = $this->session->yearuid;

            $data = [];
            switch ($type) {
                case 'inscription':
                    $data['parents'] = $this->modeldb->fetch_all_data('ts_parents',
                        array('parent_statut' => 'actif', 'parent_ecole_uid' => $ecole), 'parent_nom_tuteur', null, null, 'ASC');

                    $data['typesetudiants'] = $this->modeldb->fetch_all_data('ts_typesetudiants',
                        array('typesetudiant_statut' => 'actif', 'typesetudiant_ecole_uid' => $ecole), 'typesetudiant_created_at');

                    $data['promotions'] = $this->modeldb->fetch_join_promotions(array('ts_promotions.promotion_statut' => 'actif', 'promotion_ecole_uid' => $ecole), 'promotion_libelle', null, 'ASC');
                    break;

                case 'transfert':
                    $data['ecoles'] = $this->modeldb->fetch_all_data('ts_ecoles',
                        array('ecole_statut' => 'actif'), 'ecole_created_at');

                    $data['etudiants'] = $this->modeldb->fetch_join_inscription(
                        array('ts_etudiants.etudiant_statut' => 'actif', 'etudiant_ecole_uid' => $ecole, 'inscription_annee_uid' => $annee_encours), 'etudiant_created_at');
                    break;
                default:
                    null;
            }
            ///$this->displayResults($data['parents']);
            $data['title'] = ucfirst("Adding - $type | School Web Application"); // Capitalize the first letter
            $data['_view'] = ('app/etudiant/' . $type . '/create');
            echo view('layouts/app', $data);
        }
    }

    public function editForm($type = null, $id = null)
    {
        //si annee est inactif, aucune creation n'est autorisee
        if ($this->session->yearstatus == 'inactif') {
            return redirect()->back()->with('info', "Année Fermée: La Modification n'est pas autorisée sur une année fermée");
        } else {

            $ecole = $this->session->schooluid;

            $data = [];
            switch ($type) {
                case 'parent':
                    $data['parent'] = $this->modeldb->fetch_row_data('ts_parents', array('parent_uid' => $id));
                    break;
                case 'inscription':
                    $data['etudiant'] = $this->modeldb->fetch_join_inscription(array('ts_etudiants.etudiant_uid' => $id), 'inscription_date', 'row');

                    $data['promotions'] = $this->modeldb->fetch_join_promotions(array('ts_promotions.promotion_statut' => 'actif', 'promotion_ecole_uid' => $ecole), 'promotion_created_at');

                    $data['parents'] = $this->modeldb->fetch_all_data('ts_parents', array('parent_statut' => 'actif', 'parent_ecole_uid' => $ecole), 'parent_created_at');

                    $data['typesetudiants'] = $this->modeldb->fetch_all_data('ts_typesetudiants', array('typesetudiant_statut' => 'actif', 'typesetudiant_ecole_uid' => $ecole), 'typesetudiant_created_at');

                    break;
                case 'transfert':
                    $data['ecoles'] = $this->modeldb->fetch_all_data('ts_ecoles', array('ecole_statut' => 'actif'), 'ecole_created_at');

                    $data['etudiants'] = $this->modeldb->fetch_join_inscription(array('ts_etudiants.etudiant_deleted_at' => null, 'etudiant_ecole_uid' => $ecole), 'etudiant_created_at');

                    $data['transfert'] = $this->modeldb->fetch_row_data('ts_transferts', array('transfert_uid' => $id));
                    break;
                default:
                    null;
            }
            ///$this->displayResults($data['parents']);

            $data['title'] = ucfirst("Updating - $type | School Web Application"); // Capitalize the first letter
            $data['_view'] = ('app/etudiant/' . $type . '/update');
            echo view('layouts/app', $data);
        }
    }

    public function changeStatus($table = null, $status_value = null, $uid = null)
    {
        if (!empty($table)) {

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

    public function saveParent()
    {
        $data = [];
        $rulers = [
            'nom_pere' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Nom père obligatoire",
                ],
            ],
            'nom_mere' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nom mère obligatoire',
                ]
            ],
            'nom_tuteur' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nom Tuteur obligatoire',
                ]
            ],
        ];

        if ($this->validate($rulers)) {
            $identifiant = trim(htmlspecialchars($this->request->getPost('code_parent')));
            $nom_autre_personne = trim(htmlspecialchars($this->request->getPost('nom_autre_personne')));
            $adresse_residence_tuteur = trim(htmlspecialchars($this->request->getPost('adresse_parent')));
            $nom_tuteur = trim(htmlspecialchars($this->request->getPost('nom_tuteur')));
            $nom_pere = trim(htmlspecialchars($this->request->getPost('nom_pere')));
            $nom_mere = trim(htmlspecialchars($this->request->getPost('nom_mere')));
            $phone_tuteur = trim(htmlspecialchars($this->request->getPost('telephone_tuteur')));
            $email_parent = trim(htmlspecialchars($this->request->getPost('email_tuteur')));
            $phone_pere = trim(htmlspecialchars($this->request->getPost('phone_pere')));
            $phone_mere = trim(htmlspecialchars($this->request->getPost('phone_mere')));
            $phone_sms = trim(htmlspecialchars($this->request->getPost('phone_sms')));
            $phone_pere2 = trim(htmlspecialchars($this->request->getPost('phone_second_pere')));
            $phone_mere2 = trim(htmlspecialchars($this->request->getPost('phone_second_mere')));
            $phone_tuteur2 = trim(htmlspecialchars($this->request->getPost('phone_second_tuteur')));
            $job_pere = trim(htmlspecialchars($this->request->getPost('profession_pere')));
            $job_mere = trim(htmlspecialchars($this->request->getPost('profession_mere')));
            $job_tuteur = trim(htmlspecialchars($this->request->getPost('profession_tuteur')));
$new_identifiant_generate = trim(htmlspecialchars($this->request->getPost('code_parent')));

            $current_datetime = date('Y-m-d H:i:s');

            $valid_phone_parent = '';
            switch ($phone_sms) {
                case 'pere':
                    $valid_phone_parent = $phone_pere;
                    break;
                case 'mere':
                    $valid_phone_parent = $phone_mere;
                    break;
                case 'tuteur':
                    $valid_phone_parent = $phone_tuteur;
                    break;
                default:
                    $valid_phone_parent = $phone_pere2;
                    break;
            }
            if ($this->segment->getSegment(3) == "create") {
                //generate uid random
                $random_uid_parent = $this->generateIdentifiant();

                //table data
                $saveTypeData = [
                    'parent_uid' => $random_uid_parent,
                    'parent_code' => $identifiant,
                    'parent_code' => $new_identifiant_generate,
                    'parent_nom_pere' => $nom_pere,
                    'parent_nom_mere' => $nom_mere,
                    'parent_nom_tuteur' => $nom_tuteur,
                    'parent_profession_pere' => $job_pere,
                    'parent_profession_mere' => $job_mere,
                    'parent_profession_tuteur' => $job_tuteur,
                    'parent_statut' => 'actif',
                    'parent_adresse' => $adresse_residence_tuteur,
                    'parent_phone' => $valid_phone_parent,
                    'parent_phone_sms' => $phone_sms,
                    'parent_email' => $email_parent,
                    'parent_phone_tuteur' => $phone_tuteur,
                    'parent_phone_pere' => $phone_pere,
                    'parent_phone_mere' => $phone_mere,
                    'parent_phone_pere2' => $phone_pere2,
                    'parent_phone_mere2' => $phone_mere2,
                    'parent_phone_tuteur2' => $phone_tuteur2,
                    'parent_created_at' => $current_datetime,
                    'parent_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                    'parent_ecole_uid' => $this->session->schooluid,
                ];
                //$this->displayResults($saveTypeData);
                if ($this->modeldb->insert_data('ts_parents', $saveTypeData)) {
                    return redirect()->back()->with('success', "Creation Parent: Opération effectuée avec succés");
                }

            } elseif ($this->segment->getSegment(3) == "update") {
                //update data
                $key_parent_uid = $this->segment->getSegment(4);
                $updateTypeData = [
                    'parent_nom_pere' => $nom_pere,
                    'parent_nom_mere' => $nom_mere,
                    'parent_nom_tuteur' => $nom_tuteur,
                    'parent_profession_pere' => $job_pere,
                    'parent_profession_mere' => $job_mere,
                    'parent_profession_tuteur' => $job_tuteur,
                    'parent_adresse' => $adresse_residence_tuteur,
                    'parent_phone' => $valid_phone_parent,
                    'parent_phone_sms' => $phone_sms,
                    'parent_email' => $email_parent,
                    'parent_phone_tuteur' => $phone_tuteur,
                    'parent_phone_pere' => $phone_pere,
                    'parent_phone_mere' => $phone_mere,
                    'parent_phone_pere2' => $phone_pere2,
                    'parent_phone_mere2' => $phone_mere2,
                    'parent_phone_tuteur2' => $phone_tuteur2,
                    'parent_autre_personnee' => $nom_autre_personne,

                    'parent_lien_tuteur' => trim(htmlspecialchars($this->request->getPost('tuteur_lien'))),
                    'parent_comment' => trim(htmlspecialchars($this->request->getPost('commentaire_parent'))),
                    'parent_updated_at' => $current_datetime,
                    'parent_updated_by' => $this->session->fullname . ' - ' . $this->session->role,
                ];
                //update data in table
                if ($this->modeldb->update_data('ts_parents', $updateTypeData, array('parent_uid' => $key_parent_uid))) {
                    return redirect()->back()->with('success', "Modification Parent: Opération effectuée avec succés");
                }
            } else {
                return redirect()->to(current_url(true));
            }
        } else {
            $this->session->setFlashdata('failed', 'Erreur Parent: Opération non effectuée. Veuillez  vérifier ci-dessous les erreurs rencontrées puis réessayer !');
            $data['validation'] = $this->validator;
            $data['_view'] = ($this->segment->getSegment(3) == "update") ? ('app/etudiant/parent/update') : ('app/etudiant/parent/create');
            return view('layouts/app', $data);
        }
        return false;
    }

    public function saveIncription()
    {
        $data = [];
        $rulers = [
            'matriculeetudiant' => [
                'rules' => 'required|is_unique[ts_etudiants.etudiant_matricule]',
                'errors' => [
                    'required' => "Matricule obligatoire",
                    'is_unique' => "Ce numéro matricule est déjà attribué. changer-le",
                ],
            ],
            'nometudiant' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nom etudiant obligatoire',
                ]
            ],
            'sexeetudiant' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Sexe etudiant obligatoire',
                ]
            ],
            'promotionetudiant' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'promotion obligatoire',
                ]
            ],
            'tuteuretudiant' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuteur obligatoire',
                ]
            ],
        ];

        if ($this->validate($rulers)) {
            $matricule = trim(htmlspecialchars($this->request->getPost('matriculeetudiant')));
            $nom = trim(htmlspecialchars($this->request->getPost('nometudiant')));
            $prenom = trim(htmlspecialchars($this->request->getPost('prenometudiant')));
            $postnom = trim(htmlspecialchars($this->request->getPost('postnometudiant')));
            $date_naissance = trim(htmlspecialchars($this->request->getPost('dateNaissanceetudiant')));
            $lieu_naissance = trim(htmlspecialchars($this->request->getPost('lieuNaissanceetudiant')));
            $type_uid = trim(htmlspecialchars($this->request->getPost('categorieetudiant')));
            $promotion_uid = trim(htmlspecialchars($this->request->getPost('promotionetudiant')));
            $tuteur_uid = trim(htmlspecialchars($this->request->getPost('tuteuretudiant')));
            $adresse = trim(htmlspecialchars($this->request->getPost('adresseetudiant')));
            $sexe = trim(htmlspecialchars($this->request->getPost('sexeetudiant')));

            $current_datetime = date('Y-m-d H:i:s');

            if ($tuteur_uid == 'new') {
                //new code for this tuteur
                $new_identifiant_generate = "e" . date('Y') . substr(str_shuffle(str_repeat("0123456789", mt_rand(4, 20))), 0, 4) . "e";
                $random_uid_tuteur = $this->generateIdentifiant(); //generate new unique id for database references

                $nom_tuteur = trim(htmlspecialchars($this->request->getPost('nom_tuteur_etudiant')));
                $nom_pere = trim(htmlspecialchars($this->request->getPost('nom_pere_etudiant')));
                $nom_mere = trim(htmlspecialchars($this->request->getPost('nom_mere_etudiant')));
                $phone_tuteur = trim(htmlspecialchars($this->request->getPost('telephone_tuteur')));
                $email_parent = trim(htmlspecialchars($this->request->getPost('email_tuteur')));
                $phone_pere = trim(htmlspecialchars($this->request->getPost('phone_pere')));
                $phone_mere = trim(htmlspecialchars($this->request->getPost('phone_mere')));
                $phone_sms = trim(htmlspecialchars($this->request->getPost('phone_sms')));
                $phone_pere2 = trim(htmlspecialchars($this->request->getPost('phone_pere_second')));
                $phone_mere2 = trim(htmlspecialchars($this->request->getPost('phone_mere_second')));
                $phone_tuteur2 = trim(htmlspecialchars($this->request->getPost('phone_tuteur_second')));
                $job_pere = trim(htmlspecialchars($this->request->getPost('profession_pere')));
                $job_mere = trim(htmlspecialchars($this->request->getPost('profession_mere')));
                $job_tuteur = trim(htmlspecialchars($this->request->getPost('profession_tuteur')));

                $valid_phone_parent = '';
                switch ($phone_sms) {
                    case 'pere':
                        $valid_phone_parent = $phone_pere;
                        break;
                    case 'mere':
                        $valid_phone_parent = $phone_mere;
                        break;
                    case 'tuteur':
                        $valid_phone_parent = $phone_tuteur;
                        break;
                    default:
                        $valid_phone_parent = $phone_pere2;
                        break;
                }
                $tuteurData = [
                    'parent_uid' => $random_uid_tuteur,
                    'parent_code' => $new_identifiant_generate,
                    'parent_nom_pere' => $nom_pere,
                    'parent_nom_mere' => $nom_mere,
                    'parent_nom_tuteur' => $nom_tuteur,
                    'parent_profession_pere' => $job_pere,
                    'parent_profession_mere' => $job_mere,
                    'parent_profession_tuteur' => $job_tuteur,
                    'parent_statut' => 'actif',
                    'parent_adresse' => $adresse,
                    'parent_phone' => $valid_phone_parent,
                    'parent_email' => $email_parent,
                    'parent_phone_tuteur' => $phone_tuteur,
                    'parent_phone_pere' => $phone_pere,
                    'parent_phone_mere' => $phone_mere,
                    'parent_phone_pere2' => $phone_pere2,
                    'parent_phone_mere2' => $phone_mere2,
                    'parent_phone_tuteur2' => $phone_tuteur2,
                    'parent_created_at' => $current_datetime,
                    'parent_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                    'parent_ecole_uid' => $this->session->schooluid,
                ];

                //create new tuteur
                $this->modeldb->insert_data('ts_parents', $tuteurData);
            }
            //get uid for tuteur specify
            $tuteur_uid_old = ($tuteur_uid == 'new') ? $random_uid_tuteur : $tuteur_uid;

            if ($this->segment->getSegment(3) == "create") {
                //generate uid random
                $random_uid_etudiant = $this->generateIdentifiant();
                $random_uid_inscription = $this->generateIdentifiant();
                $identifiant_access_etudiant = "c" . date('Y') . substr(str_shuffle(str_repeat("0123456789", mt_rand(4, 20))), 0, 4) . "c";

                //table data
                $saveetudiantData = [
                    'etudiant_uid' => $random_uid_etudiant,
                    'etudiant_matricule' => $matricule,
                    'etudiant_pseudo' => $identifiant_access_etudiant,
                    'etudiant_nom' => $nom,
                    'etudiant_postnom' => $postnom,
                    'etudiant_prenom' => $prenom,
                    'etudiant_sexe' => $sexe,
                    'etudiant_date_naissance' => $date_naissance,
                    'etudiant_lieu_naissance' => $lieu_naissance,

                    'etudiant_statut' => 'actif',
                    'etudiant_type_uid' => $type_uid,
                    'etudiant_tuteur_uid' => $tuteur_uid_old,
                    'etudiant_adresse' => $adresse,
                    'etudiant_created_at' => $current_datetime,
                    'etudiant_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                    'etudiant_ecole_uid' => $this->session->schooluid,
                ];
                $saveInscriptionData = [
                    'inscription_uid' => $random_uid_inscription,
                    'inscription_statut' => 'validee',
                    'inscription_mode' => 'locale',
                    'inscription_date' => date('Y-m-d'),
                    'inscription_etudiant_uid' => $random_uid_etudiant,
                    'inscription_promotion_uid' => $promotion_uid,
                    'inscription_annee_uid' => $this->session->yearuid,
                    'inscription_created_at' => $current_datetime,
                    'inscription_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                    'inscription_ecole_uid' => $this->session->schooluid,
                ];
                $tuteurInfo = $this->modeldb->fetch_row_data('ts_parents', array('parent_uid' => $tuteur_uid_old));
                if (!empty($tuteurInfo['parent_tuteur_email'])) {
                    $mail_parent = $tuteurInfo['parent_tuteur_email']; // email tuteur
                    $code_parent_access = $tuteurInfo['parent_code']; // email tuteur
                    //send credentials
                    $email_content = "Cher parent suite à la demande d'inscription de votre enfant repondant au nom de $nom $prenom, voici les identifiants d'accès à son compte. Code Accès Parent: $code_parent_access et son numéro matricule est : $matricule . Nous vous prions de garder le code secret dans un lieu secret à l'abri de toute personne tiers n'ayant pas accès.";

                    $this->sendStudentCredential($mail_parent, $identifiant_access_etudiant, $email_content, "Code d'accès Elève à l'application");
                }

                //$this->displayResults($this->sendStudentCredential($mail_parent, $identifiant_access_etudiant, $email_content, "Code d'accès Elève à l'application"));

                if ($this->modeldb->insert_inscription($saveetudiantData, $saveInscriptionData)) {
                    return redirect()->back()->with('success', "Inscription: Opération effectuée avec succés");
                } else {
                    return redirect()->back()->with('failed', "Erreur Serveur: Opération non effectuée. Veuillez réessayer plus tard !");
                }

            } else {
                return redirect()->to(current_url(true));
            }
        } else {

            $ecole = $this->session->schooluid;

            $data['parents'] = $this->modeldb->fetch_all_data('ts_parents', array('parent_deleted_at' => null, 'parent_ecole_uid' => $ecole), 'parent_nom_tuteur', null, null, 'ASC');
            $data['typesetudiants'] = $this->modeldb->fetch_all_data('ts_typesetudiants', array('typesetudiant_deleted_at' => null, 'typesetudiant_ecole_uid' => $ecole), 'typesetudiant_created_at');
            $data['promotions'] = $this->modeldb->fetch_join_promotions(array('ts_promotions.promotion_deleted_at' => null, 'promotion_ecole_uid' => $ecole), 'promotion_libelle', null, 'ASC');

            //$this->session->setFlashdata('failed', 'ERROR: Opération non effectuée. Veuillez  vérifier ci-dessous les erreurs rencontrées puis réessayer !');
            $data['validation'] = $this->validator;
            $data['_view'] = ('app/etudiant/inscription/create');
            return view('layouts/app', $data);
        }
    }

    public function updateDossieretudiant()
    {
        $data = [];
        $rulers = [
            'matriculeetudiant' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Matricule obligatoire",
                ],
            ],
            'nometudiant' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nom etudiant obligatoire',
                ]
            ],
            'sexeetudiant' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Sexe etudiant obligatoire',
                ]
            ],

            'promotionetudiant' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'promotion obligatoire',
                ]
            ], 'tuteuretudiant' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tuteur obligatoire',
                ]
            ],
        ];

        if ($this->validate($rulers)) {


            $fullpathphoto = '';
            if ($this->request->getFile('photo_etudiant') != '') {
                $logoFile = $this->request->getFile('photo_etudiant');
                //foreach($imagefile['images'] as $img){
                if ($logoFile->isValid() && !$logoFile->hasMoved()) {
                    //rename image
                    $newNameLogoFileUpload = $logoFile->getRandomName();
                    $fullPathFile = 'global/uploads/images';
                    //move to upload directory
                    $logoFile->move(ROOTPATH . $fullPathFile, $newNameLogoFileUpload);
                    $fullpathphoto = base_url() . '/' . $fullPathFile . '/' . $newNameLogoFileUpload;
                }
            }
            $fullpathfiche = '';
            if ($this->request->getFile('fiche_etudiant') != '') {
                $ficheFile = $this->request->getFile('fiche_etudiant');
                //foreach($imagefile['images'] as $img){
                if ($ficheFile->isValid() && !$ficheFile->hasMoved()) {
                    //rename image
                    $newNameficheFileUpload = $ficheFile->getRandomName();
                    $fullPathficheFile = 'global/uploads/files';
                    //move to upload directory
                    $ficheFile->move(ROOTPATH . $fullPathficheFile, $newNameficheFileUpload);
                    $fullpathfiche = base_url() . '/' . $fullPathficheFile . '/' . $newNameficheFileUpload;
                }
            }

            $matricule = trim(htmlspecialchars($this->request->getPost('matriculeetudiant')));
            $nom = trim(htmlspecialchars($this->request->getPost('nometudiant')));
            $prenom = trim(htmlspecialchars($this->request->getPost('prenometudiant')));
            $postnom = trim(htmlspecialchars($this->request->getPost('postnometudiant')));
            $date_naissance = trim(htmlspecialchars($this->request->getPost('dateNaissanceetudiant')));
            $lieu_naissance = trim(htmlspecialchars($this->request->getPost('lieuNaissanceetudiant')));
            $type_uid = trim(htmlspecialchars($this->request->getPost('categorieetudiant')));
            $promotion_uid = trim(htmlspecialchars($this->request->getPost('promotionetudiant')));
            $tuteur_uid = trim(htmlspecialchars($this->request->getPost('tuteuretudiant')));
            $adresse = trim(htmlspecialchars($this->request->getPost('adresseetudiant')));
            $email = trim(htmlspecialchars($this->request->getPost('emailetudiant')));
            $telephone = trim(htmlspecialchars($this->request->getPost('telephoneetudiant')));
            $sexe = trim(htmlspecialchars($this->request->getPost('sexeetudiant')));
            $contact_urgence = trim(htmlspecialchars($this->request->getPost('contactUrgence')));
            $code_access_etudiant = trim(htmlspecialchars($this->request->getPost('access_code')));

            // informations updated
            $statut = trim(htmlspecialchars($this->request->getPost('statutetudiant')));

            $ville = trim(htmlspecialchars($this->request->getPost('villeetudiant')));
            $province = trim(htmlspecialchars($this->request->getPost('provinceetudiant')));
            $groupe_sanguin = trim(htmlspecialchars($this->request->getPost('groupeSanguinetudiant')));
            $caracteristiques = trim(htmlspecialchars($this->request->getPost('caracteristiquesetudiant')));
            $observation_generale = trim(htmlspecialchars($this->request->getPost('observationetudiant')));
            $applicationetudiant = trim(htmlspecialchars($this->request->getPost('applicationetudiant')));
            $attitudeetudiant = trim(htmlspecialchars($this->request->getPost('attitudeetudiant')));
            $taille = trim(htmlspecialchars($this->request->getPost('tailleetudiant')));
            $poids = trim(htmlspecialchars($this->request->getPost('poidsetudiant')));
            $numero_serni = trim(htmlspecialchars($this->request->getPost('numeroSernietudiant')));
            $ecole_provenance = trim(htmlspecialchars($this->request->getPost('ecole_provenance')));

            $current_datetime = date('Y-m-d H:i:s');

            $inscription_key_uid = trim(htmlspecialchars($this->request->getPost('instoken')));

            $etudiant_key_uid = $this->segment->getSegment(3);

            //table data
            $saveetudiantData = [
                'etudiant_matricule' => $matricule,
                'etudiant_pseudo' => $code_access_etudiant,
                'etudiant_nom' => $nom,
                'etudiant_postnom' => $postnom,
                'etudiant_prenom' => $prenom,
                'etudiant_sexe' => $sexe,
                'etudiant_date_naissance' => $date_naissance,
                'etudiant_lieu_naissance' => $lieu_naissance,
                'etudiant_numero_serni' => $numero_serni,
                'etudiant_email' => $email,
                'etudiant_telephone' => $telephone,
                'etudiant_statut' => $statut,
                'etudiant_type_uid' => $type_uid,
                'etudiant_tuteur_uid' => $tuteur_uid,
                'etudiant_ville' => $ville,
                'etudiant_province' => $province,
                'etudiant_adresse' => $adresse,
                'etudiant_groupe_sanguin' => $groupe_sanguin,
                'etudiant_application' => $applicationetudiant,
                'etudiant_observation' => $observation_generale,
                'etudiant_caracteristiques' => $caracteristiques,
                'etudiant_attitude' => $attitudeetudiant,
                'etudiant_poids' => $poids,
                'etudiant_taille' => $taille,
                'etudiant_contact_urgence' => $contact_urgence,
                'etudiant_updated_at' => $current_datetime,
                'etudiant_updated_by' => $this->session->fullname . ' - ' . $this->session->role,
                'etudiant_ecole_uid' => $this->session->schooluid,
                'etudiant_photo' => $fullpathphoto,
                'etudiant_fiche' => $fullpathfiche,
            ];
            $saveInscriptionData = [
                'inscription_statut' => 'validee',
                'inscription_promotion_uid' => $promotion_uid,
                'inscription_provenance' => $ecole_provenance,
                'inscription_updated_at' => $current_datetime,
                'inscription_updated_by' => $this->session->fullname . ' - ' . $this->session->role,
                'inscription_ecole_uid' => $this->session->schooluid,
            ];

            if ($this->modeldb->update_data('ts_etudiants', $saveetudiantData, array('etudiant_uid' => $etudiant_key_uid))) {

                $this->modeldb->update_data('ts_inscriptions', $saveInscriptionData, array('inscription_uid' => $inscription_key_uid));
                return redirect()->back()->with('success', "Modification: Opération effectuée avec succés");
            } else {
                return redirect()->back()->with('failed', "Echec: Opération non effectuée. Veuillez réessayer plus tard !");
            }

        } else {

            $ecole = $this->session->schooluid;

            $data['parents'] = $this->modeldb->fetch_all_data('ts_parents', array('parent_deleted_at' => null, 'parent_ecole_uid' => $ecole), 'parent_created_at');
            $data['typesetudiants'] = $this->modeldb->fetch_all_data('ts_typesetudiants', array('typesetudiant_deleted_at' => null, 'typesetudiant_ecole_uid' => $ecole), 'typesetudiant_created_at');
            $data['promotions'] = $this->modeldb->fetch_join_promotions(array('ts_promotions.promotion_deleted_at' => null, 'promotion_ecole_uid' => $ecole), 'promotion_created_at');

            $this->session->setFlashdata('failed', 'ERROR: Opération non effectuée. Veuillez  vérifier ci-dessous les erreurs rencontrées puis réessayer !');
            $data['validation'] = $this->validator;
            $data['_view'] = ('app/etudiant/inscription/update');
            return view('layouts/app', $data);
        }
    }

    public function saveTransfert()
    {
        $data = [];
        $rulers = [
            'code_transfert' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Code obligatoire",
                ],
            ],
            'ecole_uid_transfert' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nouvelle Ecole obligatoire',
                ]
            ], 'etudiant_uid_transfert' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'etudiant obligatoire',
                ]
            ],
        ];

        if ($this->validate($rulers)) {
            $reference_code = trim(htmlspecialchars($this->request->getPost('code_transfert')));
            $ecole_uid = trim(htmlspecialchars($this->request->getPost('ecole_uid_transfert')));
            $etudiant_uid = trim(htmlspecialchars($this->request->getPost('etudiant_uid_transfert')));
            $motif = trim(htmlspecialchars($this->request->getPost('motif_transfert')));

            $current_datetime = date('Y-m-d H:i:s');

            if ($this->segment->getSegment(3) == "create") {
                //generate uid random
                $random_uid_transfert = $this->generateIdentifiant();
                //table data
                $saveTypeData = [
                    'transfert_uid' => $random_uid_transfert,
                    'transfert_code' => $reference_code,
                    'transfert_motif' => $motif,
                    'transfert_etudiant_uid' => $etudiant_uid,
                    'transfert_ecole_nouvelle' => $ecole_uid,
                    'transfert_statut' => 'encours',
                    'transfert_created_at' => $current_datetime,
                    'transfert_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                    'transfert_ecole_uid' => $this->session->schooluid,
                    'transfert_annee_uid' => $this->session->yearuid,
                ];
                if ($this->modeldb->insert_data('ts_transferts', $saveTypeData)) {
                    //update students status to inactive profil to transfert
                    $updateetudiantData = ['etudiant_statut' => 'transfert',];
                    $this->modeldb->update_data('ts_etudiants', $updateetudiantData, array('etudiant_uid' => $etudiant_uid));
                    return redirect()->back()->with('success', "Creation: Opération effectuée avec succés");
                }

            } elseif ($this->segment->getSegment(3) == "update") {
                //update data
                $key_transfert_uid = $this->segment->getSegment(4);

                $updateTypeData = [
                    'transfert_code' => $reference_code,
                    'transfert_motif' => $motif,
                    'transfert_etudiant_uid' => $etudiant_uid,
                    'transfert_ecole_nouvelle' => $ecole_uid,
                    'transfert_statut' => trim(htmlspecialchars($this->request->getPost('statut_transfert'))),
                    'transfert_created_at' => $current_datetime,
                    'transfert_comment' => trim(htmlspecialchars($this->request->getPost('commentaire_transfert'))),
                    'transfert_updated_at' => $current_datetime,
                    'transfert_updated_by' => $this->session->fullname . ' - ' . $this->session->role,
                    'transfert_ecole_uid' => $this->session->schooluid,
                    'transfert_annee_uid' => $this->session->yearuid,
                ];
                //update data in table
                if ($this->modeldb->update_data('ts_transferts', $updateTypeData, array('transfert_uid' => $key_transfert_uid))) {
                    return redirect()->back()->with('success', "Modification: Opération effectuée avec succés");
                }
            } else {
                return redirect()->to(current_url(true));
            }
        } else {

            $data['ecoles'] = $this->modeldb->fetch_all_data('ts_ecoles',
                array('ecole_statut' => 'actif'), 'ecole_created_at');

            $data['etudiants'] = $this->modeldb->fetch_join_inscription(
                array('ts_etudiants.etudiant_statut' => 'actif', 'etudiant_ecole_uid' => $this->session->schooluid, 'inscription_annee_uid' => $this->session->yearuid), 'etudiant_created_at');

            $this->session->setFlashdata('failed', 'ERROR: Opération non effectuée. Veuillez  vérifier ci-dessous les erreurs rencontrées puis réessayer !');
            $data['validation'] = $this->validator;
            $data['_view'] = ($this->segment->getSegment(3) == "update") ? ('app/etudiant/transfert/update') : ('app/etudiant/transfert/create');
            return view('layouts/app', $data);
        }
        return false;
    }

    public function affectationetudiantspromotion()
    {

        if ($this->request->getPost('promotion_uid_nouvelle') != '') {
            $nouvelle_promotion_uid = ($this->request->getPost('promotion_uid_nouvelle'));
            $ancienne_promotion_uid = ($this->request->getPost('promotion_ancienne'));

            //get promotion status affectation
            $verifyOldpromotionstatusAffectation = $this->modeldb->fetch_row_data('ts_promotions', array('promotion_uid' => $ancienne_promotion_uid));

            //check match new and old class
            if ($nouvelle_promotion_uid != $ancienne_promotion_uid) {
                //veriry class
                if ($verifyOldpromotionstatusAffectation['annee_affectation'] != session()->get('yearuid')) {
                    if ($this->request->getPost('etudiantIdentifiant')) {
                        $count = 1;
                        $inscrip_random_uid = $this->generateIdentifiant();
                        foreach ($this->request->getPost('etudiantIdentifiant') as $etudiant) {

                            //prepare insert data in ts_inscriptions
                            $nouvelleInscriptionData = [
                                'inscription_uid' => $inscrip_random_uid . 'IN' . $count++,
                                'inscription_etudiant_uid' => $etudiant,
                                'inscription_promotion_uid' => $this->request->getPost('promotion_uid_nouvelle'),
                                'inscription_annee_uid' => session()->get('yearuid'),
                                'inscription_date' => date('Y-m-d'),
                                'inscription_mode' => 'locale',
                                'inscription_type' => 'affectation',
                                'inscription_statut' => 'validee',
                                'inscription_comment' => $this->request->getPost('commentaire_affectation'),
                                'inscription_created_at' => date('Y-m-d'),
                                'inscription_created_by' => session()->get('fullname') . ' - ' . session()->get('role'),
                                'inscription_ecole_uid' => session()->get('schooluid'),
                            ];

                            //prepare update data in ts_promotions
                            $updateStatusOldpromotionData = [
                                'annee_affectation' => session()->get('yearuid'),
                                'affectation_provenance' => true,
                            ];//prepare update data in ts_promotions
                            $updateStatusNewpromotionData = [
                                //'annee_affectation' => session()->get('yearuid'),
                                'affectation_destination' => true,
                            ];
                            //insert etudiants
                            $this->modeldb->insert_data('ts_inscriptions', $nouvelleInscriptionData);

                            //update old class annee_affectation - affectation_provenance
                            $this->modeldb->update_data('ts_promotions', $updateStatusOldpromotionData, array('promotion_uid' => $ancienne_promotion_uid));
                            //update new class annee_affectation - affectation_provenance
                            $this->modeldb->update_data('ts_promotions', $updateStatusNewpromotionData, array('promotion_uid' => $this->request->getPost('promotion_uid_nouvelle')));
                        }
                        return redirect()->back()->with('success', "Bascullement effectué avec succès des etudiants dans une nouvelle promotion");
                    } else {
                        return redirect()->back()->with('failed', "Aucun éleve n'a été selectionnée ou trouvé dans cette promotion.");
                    }
                } else {
                    return redirect()->back()->with('failed', "Les etudiants de la promotion choisie sont deja affecte. Veuillez réessayer");
                }
            } else {
                return redirect()->back()->with('failed', "La nouvelle promotion doit etre differente de l'ancienne. Veuillez réessayer");
            }
        } else {
            return redirect()->back()->with('failed', "La nouvelle promotion est obligatoire. Veuillez réessayer");
        }
    }

    public function saveBascullementGlobal()
    {
        $year = $this->session->yearuid;
        $idpromotionNouvelle = $this->request->getPost('promotion_uid_nouvelle_global');
        $anciennepromotion = $this->request->getPost('promotion_uid_ancienne_global');
        foreach ($anciennepromotion as $key => $valueOldCls) {
            d($valueOldCls);
        }
        $this->displayResults($anciennepromotion);
        $this->session->setFlashdata('info', 'Cette fonctionnalite est encours de developpement');
        return redirect()->back();


        if (count($idpromotionNouvelle) > 0) {

            //recuperer la liste de tous les etudiants dans la table inscription 'inscription_promotion_uid' => $anciennepromotion[0],

            $idetudiant = $this->modeldb->fetch_all_data('ts_inscriptions', array(
                'inscription_ecole_uid' => $this->session->schooluid, 'inscription_annee_uid !=' => $year,
                'inscription_promotion_uid ' => $anciennepromotion[0]), 'inscription_created_at');
            $current_datetime = date('Y-m-d H:i:s');
            $inscrip_random_uid = $this->generateIdentifiant();


            for ($count = 0; ($count < sizeof($idpromotionNouvelle) && $count < sizeof($anciennepromotion)); $count++) {

                if (!empty($idetudiant)) {
                    foreach ($idetudiant as $etudiant => $row) {
                        $dataAffecteNewpromotion = [
                            'inscription_uid' => $inscrip_random_uid . 'IN' . $count++,
                            'inscription_etudiant_uid' => $row['inscription_etudiant_uid'],
                            'inscription_promotion_uid' => $idpromotionNouvelle[$count],
                            'inscription_annee_uid' => $this->session->yearuid,
                            'inscription_date' => date('Y-m-d'),
                            'inscription_mode' => 'locale',
                            'inscription_type' => 'affectation',
                            'inscription_statut' => 'validee',
                            'inscription_comment' => 'Nouvelle Affectation Globale',
                            'inscription_created_at' => $current_datetime,
                            'inscription_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                            'inscription_ecole_uid' => $this->session->schooluid,
                        ];

                        //prepare update data in ts_promotions
                        $updateStatuspromotionData = [
                            'annee_affectation' => session()->get('yearuid'),
                        ];

                        $this->modeldb->insert_data('ts_inscriptions', $dataAffecteNewpromotion);
                        //update class annee_affectation
                        $this->modeldb->update_data('ts_promotions', $updateStatuspromotionData, array('promotion_uid' => $anciennepromotion[0]));
                    }
                }
            }
            return redirect()->back()->with('success', "Bascullement global effectué avec succès des etudiants dans une nouvelle promotion");
        } else {
            return redirect()->back()->with('failed', "Vous devez selectionner les promotions et leurs correspondances!");
        }
    }

    public function saveetudiantParcours($etudiant_reference = null)
    {
        if (!empty($etudiant_reference)) {

            //get all parcours
            $parcoursetudiants = $this->modeldb->fetch_join_inscription(
                array('ts_etudiants.etudiant_uid' => $etudiant_reference), 'etudiant_created_at');


            $annee_uid = trim(htmlspecialchars($this->request->getPost('annee_scolaire')));
            $promotion_uid = trim(htmlspecialchars($this->request->getPost('promotion_etudiant')));
            $ecole_provenance = trim(htmlspecialchars($this->request->getPost('ecole_provenance')));
            $inscription_date = trim(htmlspecialchars($this->request->getPost('date_inscription')));

            $anneeParcours = false;
            foreach ($parcoursetudiants as $key => $value) {
                if ($annee_uid == $value['inscription_annee_uid'] && $promotion_uid == $value['inscription_promotion_uid']) {
                    $anneeParcours = true;
                }
            }
            //$this->displayResults($anneeParcours);
            if ($anneeParcours == false) {
                $current_datetime = date('Y-m-d H:i:s');
                $ins_uid = $this->generateIdentifiant();
                if ($this->request->getMethod() == "post") {

                    $saveParcoursData = [
                        'inscription_uid' => $ins_uid,
                        'inscription_statut' => 'validee',
                        'inscription_mode' => 'locale',
                        'inscription_date' => !empty($inscription_date) ? $inscription_date : date('Y-m-d'),
                        'inscription_etudiant_uid' => $etudiant_reference,
                        'inscription_promotion_uid' => $promotion_uid,
                        'inscription_annee_uid' => $annee_uid,
                        'inscription_provenance' => $ecole_provenance,
                        'inscription_created_at' => $current_datetime,
                        'inscription_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                        'inscription_ecole_uid' => $this->session->schooluid,
                    ];

                    if ($this->modeldb->insert_data('ts_inscriptions', $saveParcoursData)) {
                        return redirect()->back()->with('success', "Création Parcours: Opération effectuée avec succés");
                    } else {
                        return redirect()->back()->with('failed', "Erreur: Opération non effectuée. Veuillez réessayer plus tard !");
                    }

                } else {
                    return redirect()->to(current_url(true));
                }
            } else {
                return redirect()->back()->with('failed', "Existance: Le parcours de l'année et la promotion selectionnée est deja enregistré");
            }
        } else {

            return redirect()->back()->with('failed', 'ERROR: Opération non effectuée. Aucun éléve selectionné');
        }
    }

    public function sendStudentCredential($email, $code, $content, $subject)
    {
        $userAgentData = $this->getUserAgentInfo();
        $lieu = $this->getClientLocation();
        $datetime = date('Y-m-d H:i:s');
        $username = (!empty($email)) ? $email : 'Anonyme';
        $subject = $subject;
        $from = "";
        $cc1 = "";
        $addresses = mb_split(";", $email);
        if (count($addresses) > 1) {
            $from = $addresses[0];
            $cc1 = $addresses[1];
        } else {
            $from = $email;
        }
        $mail = new PHPMailer(TRUE);
        try {
            //$mail->addAttachment($this->session->schoollogo, $this->session->schoolname); 
            $mail->setFrom('noreply-eduschool@ditotase.com', 'Eduschool Application');
            $mail->addAddress($from, '');
            //$mail->addReplyTo($this->session->schoolemail, 'Ecole - '.$this->session->schoolname);
            if (count($addresses) > 1) {
                $mail->addCC($cc1);
            }
            $mail->isSMTP();
            $mail->Host = 'mail.ditotase.com';
            $mail->SMTPAuth = TRUE;
            $mail->SMTPSecure = 'tls';
            $mail->Username = 'admin-eduschool@ditotase.com';
            $mail->Password = '*AEM@243#ZAD.cd';
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
            $mail->Body =
                '<html>
                    <body style="font-family: Verdana; font-size:14px; color:#666666;">
                            <h1>Inscription Elève à ' . $this->session->schoolname . ' - ' . $this->session->schoolemail . '</h1>
                            <p>Bonjour cher parent ' . $username . '. Nous avons reçu une demande d\'inscription de votre enfant.</p>
                            <h1>Code Accès Elève: ' . $code . '</h1>
                            <p>' . $content . '</p>
                            <p>Vous pouvez cliquer sur le lien ci-après pour accèder à la plateforme.</p>
                            <br/>
                            <br/>
                            <br/>
                             <p>
                                <a href="' . base_url('secure/guest') . '"
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
                                       Accèder au compte étudiant
                                 </a>
                            </p>
                             <hr>
                             <p>
                                Où et quand celà a été envoyé : <br/>
                                Date: ' . utf8_encode(strftime("%A %B %Y %T", strtotime(date('d/m/Y H:i:s')))) . ' <br/>
                                Système: ' . $userAgentData . '<br/>
                                Lieu: ' . $lieu . '<br/>
                                App: Eduschool<br/>
                             </p>
                      </body>
                      </html>';
            if ($mail->send()) {
                return true;
            } else {
                return false;
            }

        } catch (Exception $e) {
            return false;
            //echo $e->errorMessage();
        }
    }
}