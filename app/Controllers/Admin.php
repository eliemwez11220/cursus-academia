<?php
/**
 * Created by PhpStorm.
 * User: ElieMwezRubuz
 * Date: 27-Feb-21
 * Time: 10:08 AM
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

class Admin extends BaseController
{
    
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

    public function _remap($method, $param1 = null, $param2 = null, $param3 = null)
    {
        if (!session()->has('loggedIn')) {
            //echo 'Disconnect';
            return redirect()->to(base_url() . '/secure/disconnect');  // redirect to login page if not connected
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
        $this->profile();
    }
   public function profile()
    {
        $uid = $this->session->get('usertoken');

        $data['compte'] = $this->modeldb->fetch_row_data('ts_admins', array('admin_uid' =>$uid));

        //$this->displayResults( $data['compte']);

        $data['title'] = ucfirst("Profile - Admin | School Web Application"); // Capitalize the first letter
        $data['_view'] = ('app/admin/profile');
        echo view('layouts/app', $data);
    }

    public function exploreSchool($key_uid)
    {
        $this->session->set('schooluid', $key_uid);

        $data['ecole'] = $this->modeldb->fetch_join_ecoles(array('ts_ecoles.ecole_uid' => $key_uid), 'ecole_created_at', 'row');

        $this->session->set('schoolname', $data['ecole']['ecole_libelle']);

        $data['title'] = ucfirst("Explorer Ecole - School Web Application"); // Capitalize the first letter
        $data['_view'] = ('app/params/details/ecoles');
        echo view('layouts/app', $data);
    }

    public function view($type = null)
    {
        $cole = $this->session->schooluid;

        switch ($type) {
            case 'group':
            case 'privileges':
            case 'access':
                $data['privileges'] = $this->modeldb->fetch_join_privileges(array('privilege_deleted_at' => null, 'privilege_ecole_uid' => $cole), 'privilege_created_at');
                $data['groupes'] = $this->modeldb->fetch_all_data('ts_groupes', array('groupe_deleted_at' => null, 'groupe_ecole_uid' => $cole), 'groupe_created_at');
                $data['acces'] = $this->modeldb->fetch_all_data('ts_acces', array('acces_deleted_at' => null, 'acces_ecole_uid' => $cole), 'acces_created_at');
                break;
            case 'account':
                $data['comptes'] = $this->modeldb->fetch_join_comptes(array('compte_deleted_at' => null, 'compte_ecole_uid' => $cole), 'compte_created_at');
                break;
            default:
               $data['comptes'] = $this->modeldb->fetch_all_data('ts_admins', array('admin_created_at !=' => null), 
			   'admin_created_at');

                break;
        }
		
		//$this->displayResults($data['comptes']);
		
        $data['title'] = ucfirst("Administration - $type | School Web Application"); // Capitalize the first letter
        $data['_view'] = ('app/admin/' . $type . '/listing');
        echo view('layouts/app', $data);
    }

    public function addForm($type = null)
    {
        //si annee est inactif, aucune creation n'est autorisee
        if($this->session->yearstatus == 'inactif'){
            return redirect()->back()->with('info', "Année Fermée: La création n'est pas autorisée sur une année fermée");
        }else{

            $data = [];
            $agent = ($this->request->getGet('agtAcc')) ? $this->request->getGet('agtAcc') : '';     #GET YEAR ID

            if (!empty($agent)) {
                $data['agent'] = $this->modeldb->fetch_join_agents(array('ts_agents.agent_uid' => $agent), 'agent_created_at', 'row');
            }
            $cole = $this->session->schooluid;

            switch ($type) {
                case 'account':
                    $data['agents'] = $this->modeldb->fetch_join_agents(array('ts_agents.agent_deleted_at' => null, 'agent_ecole_uid' => $cole), 'agent_created_at');
                    $data['groupes'] = $this->modeldb->fetch_all_data('ts_groupes', array('groupe_deleted_at' => null, 'groupe_ecole_uid' => $cole), 'groupe_created_at');
                    break;
                default:
                    null;
            }

            $data['title'] = ucfirst("Administration - $type | School Web Application"); // Capitalize the first letter
            $data['_view'] = ('app/admin/' . $type . '/create');
            echo view('layouts/app', $data);
        }
    }

    public function editForm($type = null, $pk_id = null)
    {
        //si annee est inactif, aucune creation n'est autorisee
        if($this->session->yearstatus == 'inactif'){
            return redirect()->back()->with('info', "Année Fermée: La modification n'est pas autorisée sur une année fermée");
        }else{
            $data = [];
            $cole = $this->session->schooluid;
            switch ($type) {
                case 'account':
                    $data['agent'] = $this->modeldb->fetch_join_comptes(array('ts_comptes.compte_uid' => $pk_id), 'compte_created_at', 'row');
                    $data['groupes'] = $this->modeldb->fetch_all_data('ts_groupes', array('groupe_deleted_at' => null, 'groupe_ecole_uid' => $cole), 'groupe_created_at');
                    break;
                default:
                    null;
            }
            $data['title'] = ucfirst("Administration - $type | School Web Application"); // Capitalize the first letter
            $data['_view'] = ('app/admin/' . $type . '/update');
            echo view('layouts/app', $data);
        }
    }

    public function details($type = null, $type_uid = null)
    {
        switch ($type) {
            case 'group':
                $data['groupe'] = $this->modeldb->fetch_row_data('ts_groupes', array('groupe_uid' => $type_uid));
                break;
            case 'access':
                $data['access'] = $this->modeldb->fetch_row_data('ts_acces', array('acces_uid' => $type_uid));
                break;
            case 'privileges':
                $data['privilege'] = $this->modeldb->fetch_join_privileges(array('privilege_uid' => $type_uid), 'privilege_created_at', 'row');
                break;
            case 'account':
                $data['account'] = $this->modeldb->fetch_join_comptes(array('compte_uid' => $type_uid), 'compte_created_at', 'row');
                break;
            default:
              $data['account'] = $this->modeldb->fetch_row_data('ts_admins', array('admin_uid' => $type_uid));
              $clientuid = $data['account']['admin_client_uid'];
              $data['ecoles'] = (!empty($clientuid))? $this->modeldb->fetch_join_ecoles(array('ts_ecoles.ecole_client_uid' => $clientuid), 'ecole_created_at'):'';
              break;
        }

        $data['title'] = ucfirst("Administration - $type | School Web Application"); // Capitalize the first letter
        $data['_view'] = ('app/admin/' . $type . '/details');
        echo view('layouts/app', $data);
    }

    public function changeStatus($table = null, $status_value = null, $uid = null)
    {
        switch ($table) {
            case 'compte':
                $realnametable = 'ts_comptes';
                $real_uid = 'compte_uid';
                $status = 'compte_status';
                $updated_time = 'compte_updated_at';
                $updated_by = 'compte_updated_by';
                break;

            default:
                $realnametable = 'ts_' . $table . 's';
                $real_uid = $table . '_uid';
                $status = $table . '_status';
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
function resetAdminPassword($uid)
    {
        if (!empty($uid)) {

            $compteinfo = $this->modeldb->fetch_row_data('ts_admins', array('admin_uid' => $uid));

            $salt_options = array('cost' => 12);
            $new_password = password_hash(trim(htmlentities($this->request->getPost('asset_password'))), PASSWORD_BCRYPT, $salt_options);

            $current_datetime = date('Y-m-d H:i:s');

            $updateTypeData = [
                'admin_password' => $new_password,
                'admin_oldpass' => $compteinfo['admin_password'],
                'admin_lastchange_pass' => $current_datetime,
            ];
            //update data in table
            if ($this->modeldb->update_data('ts_admins', $updateTypeData, array('admin_uid' => $uid))) {
                $content = "Votre mot de passe a été réinitialisé. Oublié ce message si c'était vous-meme.";
				if (!empty($compteinfo['compte_email'])) {
                    //send email to register user email
					$this->sendMailNotifieUser($compteinfo['compte_email'], $content, 'password');
                }
				
				return redirect()->back()->with('success', "Réinitialisation du mot de passe effectuée avec succés");
            } else {
                return redirect()->back()->with('failed', "Réinitialisation Impossible. Veuillez réessayer plus tard !");
            }

        } else {
            $this->session->setTempdata('failed', "ERROR: Opération non effectuée");
            return redirect()->back()->withInput();
        }
    }
    function resetAccountPassword($uid)
    {
        if (!empty($uid)) {

            $compteinfo = $this->modeldb->fetch_row_data('ts_comptes', array('compte_uid' => $uid));

            $salt_options = array('cost' => 12);
            $new_password = password_hash(trim(htmlentities($this->request->getPost('asset_password'))), PASSWORD_BCRYPT, $salt_options);

            $current_datetime = date('Y-m-d H:i:s');

            $updateTypeData = [
                'compte_password_expire' => ($this->request->getPost('pass_expire'))?1:0,
                'compte_password' => $new_password,
                'compte_oldpass' => $compteinfo['compte_password'],
                'compte_resetpass_at' => $current_datetime,
                'compte_resetpass_nbr' => $compteinfo['compte_resetpass_nbr'] + 1,
                'compte_resetpass_by' => $this->session->fullname . ' - ' . $this->session->role,
            ];
            //update data in table
            if ($this->modeldb->update_data('ts_comptes', $updateTypeData, array('compte_uid' => $uid))) {
                $content = "Votre mot de passe a été réinitialisé. Oublié ce message si c'était vous-meme.";
				if (!empty($compteinfo['compte_email'])) {
                    //send email to register user email
					$this->sendMailNotifieUser($compteinfo['compte_email'], $content, 'password');
                }
				return redirect()->back()->with('success', "Réinitialisation du mot de passe: Opération effectuée avec succés");
            } else {
                return redirect()->back()->with('failed', "Réinitialisation Impossible. Veuillez réessayer plus tard !");
            }

        } else {
            $this->session->setTempdata('failed', "ERROR: Opération non effectuée");
            return redirect()->back()->withInput();
        }
    }

    function saveCompteAgent()
    {
        if ($this->request->getMethod() == 'post') {
            $action = ($this->segment->getTotalSegments() >= 3) ? $this->segment->getSegment('3') : '';

            $current_datetime = date('Y-m-d H:i:s');
            
                $salt_options = array('cost' => 12);
                $new_password = password_hash(trim(htmlentities($this->request->getPost('asset_password'))), PASSWORD_BCRYPT, $salt_options);

                $username = trim(htmlentities($this->request->getPost('username')));
                $email = trim(htmlentities($this->request->getPost('email')));
                $groupe = trim(htmlentities($this->request->getPost('groupe')));

                $random_uid_agent = ($this->segment->getTotalSegments() >= 4) ? $this->segment->getSegment('4') : '';

                $compteinfo = $this->modeldb->fetch_all_data('ts_comptes', array('compte_ecole_uid' => $this->session->schooluid), 'compte_created_at');

            if ($action == 'create') {

                $saveTypeData = [
                    'compte_uid' => $this->generateIdentifiant(),
                    'compte_username' => $username,
                    'compte_email' => $email,
                    'compte_password' => $new_password,
                    'compte_password_expire' => (trim(htmlentities($this->request->getPost('pass_expire'))) == TRUE) ? '1' : 0,
                    'compte_created_at' => $current_datetime,
                    'compte_nbr_trylogin' => 3,
                    'compte_status' => 'actif',
                    'compte_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                    'compte_annee_uid' => $this->session->yearuid,
                    'compte_ecole_uid' => $this->session->schooluid,
                    'compte_agent_uid' => $random_uid_agent,
                    'compte_groupe_uid' => $groupe,
                ];
                if (!empty($compteinfo)) {
                    foreach ($compteinfo as $value) {
                        if ($value['compte_agent_uid'] == $random_uid_agent) {
                            return redirect()->back()->with('failed', "L'agent dont vous assayez de créer, a déjà un compte !");
                        } elseif ($value['compte_username'] == $username) {
                            return redirect()->back()->with('failed', "L'identifiant choisi est déjà attribué");
                        } elseif ($value['compte_email'] == $email) {
                            return redirect()->back()->with('failed', "L'adresse est déjà attachée a un autre compte");
                        } else {
                            $this->modeldb->insert_data('ts_comptes', $saveTypeData);
                            return redirect()->back()->with('success', "Création compte: Opération effectuée avec succés");
                        }
                    }
                } else {
                    $this->modeldb->insert_data('ts_comptes', $saveTypeData);
                    return redirect()->back()->with('success', "Création compte: Opération effectuée avec succés");
                }
            } elseif ($action == 'update') {
                $fullpathAvatar = $this->request->getFile('file_old_value');
                if ($this->request->getFile('avatar_compte') != '') {
                    $logoFile = $this->request->getFile('avatar_compte');
                    //foreach($imagefile['images'] as $img){
                    if ($logoFile->isValid() && !$logoFile->hasMoved()) {
                        //rename image
                        $newNameLogoFileUpload = $logoFile->getRandomName();
                        $fullPathFile = 'global/uploads/images';
                        //move to upload directory
                        $logoFile->move(ROOTPATH . $fullPathFile, $newNameLogoFileUpload);
                        $fullpathAvatar = base_url() . '/' . $fullPathFile . '/' . $newNameLogoFileUpload;
                    }
                }
                $random_uid = ($this->segment->getTotalSegments() >= 4) ? $this->segment->getSegment('4') : '';
                $updateTypeData = [
                    'compte_groupe_uid' => $groupe,
                    'compte_username' => trim(htmlentities($this->request->getPost('username'))),
                    'compte_email' => trim(htmlentities($this->request->getPost('email'))),
                    'compte_observation' => trim(htmlentities($this->request->getPost('observation'))),
                    'compte_question1' => trim(htmlentities($this->request->getPost('question1'))),
                    'compte_question2' => trim(htmlentities($this->request->getPost('question2'))),
                    'compte_question3' => trim(htmlentities($this->request->getPost('question3'))),
                    'compte_reponse1' => trim(htmlentities($this->request->getPost('reponse1'))),
                    'compte_reponse2' => trim(htmlentities($this->request->getPost('reponse2'))),
                    'compte_reponse3' => trim(htmlentities($this->request->getPost('reponse3'))),
                    'compte_avatar' =>  $fullpathAvatar,
                    'compte_updated_at' => $current_datetime,
                    'compte_updated_by' => $this->session->fullname . ' - ' . $this->session->role,
                ];
                //update data in table
                if ($this->modeldb->update_data('ts_comptes', $updateTypeData, array('compte_uid' => $random_uid))) {

                    $infoCompteByID = $this->modeldb->fetch_row_data('ts_comptes', array('compte_uid'=>$random_uid));

                    $updateAgentEmailData = [
                        'agent_email' => trim(htmlentities($this->request->getPost('email'))),
                    ];
                    $this->modeldb->update_data('ts_agents', $updateAgentEmailData, array('agent_uid' => $infoCompteByID['compte_agent_uid']));

                    return redirect()->back()->with('success', "Modification compte: Opération effectuée avec succés");
                } else {
                    return redirect()->back()->with('failed', "Modification compte Impossible. Veuillez réessayer plus tard !");
                }
            } else {
                $this->session->setTempdata('failed', "ERROR: Opération non effectuée");
                return redirect()->back()->withInput();
            }

        } else {
            $this->session->setTempdata('failed', "ERROR: Opération non effectuée");
            return redirect()->back()->withInput();
        }
    }

    function saveGroupe()
    {
        if ($this->request->getMethod() == 'post') {

            $libelle = trim(htmlspecialchars($this->request->getPost('libelle_groupe')));
            $comment = trim(htmlspecialchars($this->request->getPost('observation_groupe')));

            $current_datetime = date('Y-m-d H:i:s');
            if ($this->segment->getSegment(3) == "create") {
                $random_uid = $this->generateIdentifiant();
                //create new type
                $createNewTypeData = [
                    'groupe_uid' => $random_uid,
                    'groupe_libelle' => $libelle,
                    'groupe_observation' => $comment,
                    'groupe_status' => 'actif',
                    'groupe_created_at' => $current_datetime,
                    'groupe_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                    'groupe_annee_uid' => $this->session->yearuid,
                    'groupe_ecole_uid' => $this->session->schooluid,
                ];
                //save new data in table
                if ($this->modeldb->insert_data('ts_groupes', $createNewTypeData)) {
                    return redirect()->back()->with('success', "Création Groupe: Opération effectuée avec succés");
                }
            } elseif ($this->segment->getSegment(3) == "update") {
                //update data
                $cycle_uid = $this->segment->getSegment(4);
                $updateTypeData = [
                    'groupe_libelle' => $libelle,
                    'groupe_observation' => $comment,
                    'groupe_updated_at' => $current_datetime,
                    'groupe_updated_by' => $this->session->fullname . ' - ' . $this->session->role,
                ];
                //update data in table
                if ($this->modeldb->update_data('ts_groupes', $updateTypeData, array('groupe_uid' => $cycle_uid))) {
                    return redirect()->back()->with('success', "Modification Groupe: Opération effectuée avec succés");
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

    function saveAccess()
    {
        if ($this->request->getMethod() == 'post') {

            //$libelle = trim(htmlspecialchars($this->request->getPost('libelle_acces')));
            $objet = trim(htmlspecialchars($this->request->getPost('objet_acces')));
            $comment = trim(htmlspecialchars($this->request->getPost('observation_acces')));

            $current_datetime = date('Y-m-d H:i:s');
            if ($this->segment->getSegment(3) == "create") {
                $random_uid = $this->generateIdentifiant();
                //create new type
                $createNewTypeData = [
                    'acces_uid' => $random_uid,
                    'acces_libelle' => 'Accès '.$objet,
                    'acces_objet' => $objet,
                    'acces_observation' => $comment,
                    'acces_status' => 'actif',
                    'acces_type' => 'allow',
                    'acces_created_at' => $current_datetime,
                    'acces_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                    'acces_annee_uid' => $this->session->yearuid,
                    'acces_ecole_uid' => $this->session->schooluid,
                ];
                //save new data in table
                if ($this->modeldb->insert_data('ts_acces', $createNewTypeData)) {
                    return redirect()->back()->with('success', "Création Acces: Opération effectuée avec succés");
                }
            } elseif ($this->segment->getSegment(3) == "update") {
                //update data
                $random_access_uid = $this->segment->getSegment(4);
                $updateTypeData = [
                    'acces_libelle' => 'Accès '.$objet,
                    'acces_objet' => $objet,
                    'acces_observation' => $comment,
                    'acces_updated_at' => $current_datetime,
                    'acces_updated_by' => $this->session->fullname . ' - ' . $this->session->role,
                ];
                //update data in table
                if ($this->modeldb->update_data('ts_acces', $updateTypeData, array('acces_uid' => $random_access_uid))) {
                    return redirect()->back()->with('success', "Modification Access: Opération effectuée avec succés");
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

    function savePrivilege()
    {
        if ($this->request->getMethod() == 'post') {

            $groupe = trim(htmlspecialchars($this->request->getPost('groupe')));
            $objet = trim(htmlspecialchars($this->request->getPost('objet_acces')));
            $comment = trim(htmlspecialchars($this->request->getPost('observation')));
            $ecriture = trim(htmlspecialchars($this->request->getPost('ecriture')));
            $lecture = trim(htmlspecialchars($this->request->getPost('ecriture')));
            $execute = trim(htmlspecialchars($this->request->getPost('execute')));
            $full = trim(htmlspecialchars($this->request->getPost('full')));

            $current_datetime = date('Y-m-d H:i:s');
            if ($this->segment->getSegment(3) == "create") {
                $random_uid = $this->generateIdentifiant();
                //create new type
                $createNewTypeData = [
                    'privilege_uid' => $random_uid,
                    'privilege_groupe_uid' => $groupe,
                    'privilege_acces_uid' => $objet,
                    'privilege_observation' => $comment,
                    'privilege_status' => 'actif',
                    'privilege_ecriture' => ($ecriture == TRUE) ? 'allow' : 'deny',
                    'privilege_lecture' => ($lecture == TRUE) ? 'allow' : 'deny',
                    'privilege_execute' => ($execute == TRUE) ? 'allow' : 'deny',
                    'privilege_tout' => ($full == TRUE) ? 'allow' : 'deny',
                    'privilege_created_at' => $current_datetime,
                    'privilege_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                    'privilege_annee_uid' => $this->session->yearuid,
                    'privilege_ecole_uid' => $this->session->schooluid,
                ];
                //save new data in table
                if ($this->modeldb->insert_data('ts_privileges', $createNewTypeData)) {
                    return redirect()->back()->with('success', "Création Privilege: Opération effectuée avec succés");
                }
            } elseif ($this->segment->getSegment(3) == "update") {
                //update data
                $random_access_uid = $this->segment->getSegment(4);
                $updateTypeData = [
                    'privilege_groupe_uid' => $groupe,
                    'privilege_acces_uid' => $objet,
                    'privilege_observation' => $comment,
                    'privilege_status' => 'actif',
                    'privilege_ecriture' => ($ecriture == TRUE) ? 'allow' : 'deny',
                    'privilege_lecture' => ($lecture == TRUE) ? 'allow' : 'deny',
                    'privilege_execute' => ($execute == TRUE) ? 'allow' : 'deny',
                    'privilege_tout' => ($full == TRUE) ? 'allow' : 'deny',
                    'privilege_updated_at' => $current_datetime,
                    'privilege_updated_by' => $this->session->fullname . ' - ' . $this->session->role,
                ];
                //update data in table
                if ($this->modeldb->update_data('ts_privileges', $updateTypeData, array('privilege_uid' => $random_access_uid))) {
                    return redirect()->back()->with('success', "Modification Privilege: Opération effectuée avec succés");
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

    public function changePassword()
    {

        $data = [];
        if ($this->request->getMethod() == 'post') {

            $rulers = [
                'oldpass' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Ancien mot de passe obligatoire',
                    ]
                ],  
                'pass' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Mot de passe obligatoire',
                    ]
                ], 

                'cpass' => [
                    'rules' => 'matches[pass]',
                    'errors' => [
                        'matches' => 'Le mot de passe de confirmation est differente du mot de passe saisi',
                    ]
                ],
            ];
             
        //uid admin session 
            $usruid_sess = $this->session->get('usertoken');

        $data['compte'] = $this->modeldb->fetch_row_data('ts_admins', array('admin_uid' =>$usruid_sess));


            if ($this->validate($rulers)) {

                $oldpass = trim(htmlspecialchars($this->request->getPost('oldpass')));
                $newpass = trim(htmlspecialchars($this->request->getPost('pass')));

                $current_datetime = date('Y-m-d H:i:s');

                $salt_options = array('cost' => 12);
                $new_password = password_hash($newpass, PASSWORD_BCRYPT, $salt_options);

                $infosCompte = $this->modeldb->fetch_row_data('ts_admins', array('admin_uid' => $usruid_sess));

                //check old password 

                if ($infosCompte['admin_password'] == password_verify($oldpass, $infosCompte['admin_password'])) {

                    //chack strong password
                    $stringPasswordAdminChecked = $this->checkStrongPassword($newpass);
                    if ($stringPasswordAdminChecked >= 25) {
                        //table data
                        $saveUpdateUserData = [
                            'admin_password' => $new_password,
                            'admin_oldpass' => $infosCompte['admin_password'],
                            'admin_lastchange_pass' => $current_datetime,
                        ];

                        if ($this->modeldb->update_data('ts_admins', $saveUpdateUserData, array('admin_uid' => $infosCompte['admin_uid']))) {
                            
                            return redirect()->back()->with('success', "Changement du mot de passe effectué avec succès");

                        } else {
                            return redirect()->back()->with('failed', "Désolé, une erreur systeme s'est produite. Veuillez réessayer plus tard.");
                        }
                    } else {

                        $this->session->setFlashdata('failed', "Le mot de passe doit avoir au moins 1 lettre Majuscule,
                            1 lettre miniscule, 1 caractere special choisi parmi [*|#|@|$|.|?] et 1 chiffre de [0-9] et une longueure d'au moins 8 caracteres.");
                        $data['validation'] = $this->validator;
                        $data['title'] = 'ChangePassword  - Profile | School Web Application';
                         $data['_view'] = ('app/admin/profile');
                         return view('layouts/app', $data);
                    }
            } else {

                $this->session->setFlashdata('failed', 'ERROR: Veuillez  vérifier ci-dessous les erreurs rencontrées puis réessayer !');
                $data['validation'] = $this->validator;
                $data['title'] = 'Change Password  - Profile | School Web Application';
                $data['_view'] = ('app/admin/profile');
                return view('layouts/app', $data);
            }
        } else {
            //check total try change password
            $nbrtrylogin = $this->session->essaichange;
            $essai = 0;

            while ($essai <= 3) {
                    
                if ($essai >= 3 && $this->session->essaichange >=0) {
                       $nbrtrylogin = $nbrtrylogin + 1 ;
                    }
                    $essai++; 
                }//end while 

                $this->session->set('essaichange', $nbrtrylogin);
                
                $attempts_login = $this->session->essaichange;
                if ($attempts_login >= 4) {

                    if($this->session->get('profile') != 'sysadmin'){
                        $compte_nbr_trylogin = 0;
                        $compte_status = 'blocked';
                    $data_login_failled = compact('admin_nbr_trylogin', 'admin_status');
                    $this->modeldb->update_data('ts_admins', $data_login_failled,array('admin_uid' => $this->session->get('usertoken')));
                    }
                    
                      $userAgentData = $this->getUserAgentInfo();
                      $ip = $this->getClientIpAddress();
                      $lieu = $this->getClientLocation();

                      $content = "Plusieurs tentatives d'accès au compte de [$usermail] ont été detectées approximatiif à [$lieu] sur [$userAgentData] dont l'adresse IP utilisée est [$ip] lors du changement du mot de passe sur une session ouverte.";

                      if (!empty($usermail)) {
                            //send email to register user email
                          $this->sendMailNotifieUser($usermail, $content, 'password');
                      }
                  
                  // create log infos
                  $arrayLogActivityData = [
                    'log_uid' => $this->generateIdentifiant(),
                    'log_created_at' => date('Y-m-d H:i:s'),
                    'log_content' => $content,
                    'log_user' => $usermail,
                    'log_ecole' => $infosCompte['admin_ecole_uid'],
                    ];
                    $this->modeldb->insert_data('ts_logs', $arrayLogActivityData);
                    return redirect()->to(base_url('secure/accountLocked'));
                }else{
                      return redirect()->back()->with('failed', "Ancien mot de passe incorrect. Vous devez fournir un mot de passe valide avant de changer le nouveau"); 
                }
         
        }

        } else {
            return redirect()->back()->with('failed', "Error change password");
        }
        
    }

    public function updatePicture()
    {
         $uid = $this->session->get('usertoken');

        $data['compte'] = $this->modeldb->fetch_row_data('ts_admins', array('admin_uid' =>$uid));

        $rulers = [
                'photo_avatar' => [
                'rules' => 'uploaded[photo_avatar]|max_size[photo_avatar,100]|ext_in[photo_avatar,png,jpg,jpeg,webp]',
                'errors' => [
                    'uploaded' => 'le fichier doit etre au format image et doit avoir tout au plus 5Mo'
                ],
            ],
            ];

            if ($this->validate($rulers)) {

                $photo = $this->request->getFile('photo_avatar');
                    if ($photo->isValid() && !$photo->hasMoved()) {
                        //rename image
                        $newNameFileUpload = $photo->getRandomName();
                        //$typeFileUpload = $photo->getClientExtension();
                        //$sizeFileUpload = $photo->getSize();
                        $PathFile = 'global/uploads/images/avatars';
                        //move to upload directory
                        $photo->move(ROOTPATH . $PathFile, $newNameFileUpload);
                        $fullpathphoto = base_url() . '/' . $PathFile . '/' . $newNameFileUpload;
                    
                  $arrayUpdateAccountData = [
                    'admin_avatar' => $fullpathphoto,
                    'admin_updated_at' => date('Y-m-d H:i:s'),
                ];
                    if($this->modeldb->update_data('ts_admins', $arrayUpdateAccountData, array('admin_uid' => $this->session->usertoken))){

                      $userAgentData = $this->getUserAgentInfo();
                      $ip = $this->getClientIpAddress();
                      $lieu = $this->getClientLocation();
                      $usermail = $this->session->email; 
                      $content = "Modification photo compte [$usermail] a été effectuée approximativement à [$lieu] sur [$userAgentData] dont l'adresse IP utilisée est [$ip] lors du changement de la photo de profile sur une session ouverte.";

                      if (!empty($usermail)) {
                            //send email to register user email
                          $this->sendMailNotifieUser($usermail, $content, 'info');
                      }
                      $this->session->set('avatar', $fullpathphoto);
                      return redirect()->back()->with('success', "Changement de la photo effectué avec succès");

                    }
                        
                    }else {
                            return redirect()->back()->with('failed', "Désolé, une erreur systeme s'est produite. Veuillez réessayer plus tard.");
                        }
                
        }else{
            $this->session->setFlashdata('failed', 'ERROR: Veuillez  vérifier ci-dessous les erreurs rencontrées puis réessayer !');
            $data['validation'] = $this->validator;

            $data['title'] = ucfirst('Profile - Picture | School Web Application');
            $data['_view'] = ('app/admin/profile');
            echo view('layouts/app', $data);
        }
    }

    public function updateProfile()
    {
        if ($this->request->getMethod() == 'post') {
            $current_datetime = date('Y-m-d H:i:s');
            $random_uid = ($this->segment->getTotalSegments() >= 3) ? $this->segment->getSegment('3') : '';
            if (! empty($random_uid)) {
                
                $updateTypeData = [
                    'admin_pseudo' => trim(htmlentities($this->request->getPost('username'))),
                    'admin_email' => trim(htmlentities($this->request->getPost('email'))),
                    'admin_question1' => trim(htmlentities($this->request->getPost('question1'))),
                    'admin_question2' => trim(htmlentities($this->request->getPost('question2'))),
                    'admin_question3' => trim(htmlentities($this->request->getPost('question3'))),
                    'admin_reponse1' => trim(htmlentities($this->request->getPost('reponse1'))),
                    'admin_reponse2' => trim(htmlentities($this->request->getPost('reponse2'))),
                    'admin_reponse3' => trim(htmlentities($this->request->getPost('reponse3'))),
                    'admin_updated_at' => $current_datetime,
                ];
                //update data in table
                if ($this->modeldb->update_data('ts_admins', $updateTypeData, array('admin_uid' => $random_uid))) {

                    //set session variables
                     $this->session->set('email', trim(htmlentities($this->request->getPost('email'))));
                     $this->session->set('username', trim(htmlentities($this->request->getPost('username'))));

                    return redirect()->back()->with('success', "Modification compte: Opération effectuée avec succés");
                } else {
                    return redirect()->back()->with('failed', "Erreur Modification Compte Personnel. Veuillez réessayer plus tard !");
                }
            } else {
                $this->session->setTempdata('failed', "ERROR: Opération non effectuée");
                return redirect()->back()->withInput();
            }

        } else {
            $this->session->setTempdata('failed', "ERROR: Opération non effectuée");
            return redirect()->back()->withInput();
        }
    }
    public function sendMailNotifieUser($email, $content, $type = null)
    {
        $msg_type = "";
        $subject_type = "";
        if ($type == 'info') {
           $msg_type = "Votre compte a été modifié. Pour de raison de sécurité, veuillez accèder pour le securiser. Si c\'était vous-meme, ignorez ce mail";
           $subject_type = "Modification compte  - Eduschool Application";
        }elseif ($type == 'password') {
           $msg_type = "Votre mot de passe a été modifié. Pour de raison de sécurité, veuillez accèder pour le securiser. Si c\'était vous-meme, ignorez ce mail";
           $subject_type = "Modification mot de passe  - Eduschool Application";
        }else{
            $msg_type = "Votre compte a été bloqué pour de raison de sécurité. Veuillez contacter votre webmaster pour le débloquer. Si c\'était vous-meme, ignorez ce mail";
            $subject_type = "Access Account Blocked - Eduschool Application";
        }
        $userAgentData = $this->getUserAgentInfo();
        $lieu =  $this->getClientLocation();
        $username = (!empty($email))? $email : 'Anonyme';
        $subject=$subject_type;

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
            //$mail->addReplyTo($this->session->schoolemail, 'Ecole');
            if (count($addresses) > 1) {
                $mail->addCC($cc1);
            }
			$mail->isSMTP();
            $mail->Host = 'mail.ditotase.com';
            $mail->SMTPAuth = TRUE;
            $mail->SMTPSecure = 'tls';
            $mail->Username = 'admin-eduschool@ditotase.com';
            $mail->Password = '*AEM@243#ZAD.cd';
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
            $mail->Body =
                '<html>
                    <body style="font-family: Verdana; font-size:14px; color:#666666;">

                            <p> Bonjour cher ' . $username . '. '.$msg_type.'</p>
                            <p> Voici ce qui s\'est passé : ' . $content . '</p>
                            <p> Pour sécuriser votre compte, veuillez suivre le lien ci-après </p>
                            <br/>
                             <p> 
                                <a href="' . base_url() . '"
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
                                       Sécuriser mon compte
                                 </a>
                            </p>
                             <hr>
                             <p>
                                Où et quand cela s\'est passé : <br/>
                                Date: ' . utf8_encode(strftime("%A %B %Y %T", strtotime(date('d/m/Y H:i:s')))) . ' <br/>
                                Système: ' . $userAgentData . '<br/>
                                Lieu: ' . $lieu . '<br/>
                                App: Eduschool<br/>
                             </p>
                      </body>
                      </html>';
            
            if ($mail->send()) {
                return true;
            }
            return false;

        } catch (Exception $e) {
            return false;
        }
    }
}
