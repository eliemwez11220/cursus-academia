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
use PHPMailer\PHPMailer\SMTP;

//mail files sending
require_once APPPATH . 'ThirdParty/PHPMailer/src/Exception.php';
require_once APPPATH . 'ThirdParty/PHPMailer/src/PHPMailer.php';
require_once APPPATH . 'ThirdParty/PHPMailer/src/SMTP.php';


class Password extends BaseController
{
    protected $session;
    protected $modeldb;
    protected $segment;

    function __construct()
    {
        helper(['url', 'html', 'form', 'text', 'email', 'date', 'download', 'file', 'security', 'string']);

        $this->session = session();
        $this->segment = \CodeIgniter\Config\Services::uri();

        //load generic model
        $this->modeldb = new AppModel();
    }

    public function index()
    {
        if (!session()->has('loggedIn')) {
            $data = [
                'title' => ucfirst('Main | School Web Application'), // Capitalize the first letter
                '_view' => ('pages/login'),
                'admins' => $this->modeldb->fetch_count('ts_admins', array('admin_statut' => 'actif')),
            ];
            echo view('layouts/main', $data);
        } else {
            return redirect()->back();
        }
    }
    public function changeDefaultAdmin($uid, $newPassword)
    {
        $infosCompteAdmin = $this->modeldb->fetch_row_data('ts_admins', array('admin_uid' => $uid));

                    //table data
                    $saveAdminData = [
                        'admin_password' => $newPassword,
                        'admin_oldpass' => $infosCompteAdmin['admin_password'],
                        'admin_lastchange_pass' => date('Y-m-d H:i:s'),
                    ];
        if ($this->modeldb->update_data('ts_admins', $saveAdminData, array('admin_uid' => $uid))) {

            $chechExistsYear = $this->modeldb->fetch_field_value('ts_annees', array('annee_statut' => 'actif'));

            //open new session 
            $newSessionAdminData = [
                'usertoken' => $infosCompteAdmin['admin_uid'],
                'username' => $infosCompteAdmin['admin_pseudo'],
                'fullname' => $infosCompteAdmin['admin_fullname'],
                'email' => $infosCompteAdmin['admin_email'],
                'avatar' => $infosCompteAdmin['admin_avatar'],
                'role' => 'administrateur systeme',
                'groupe' => 'administrateurs',
                'yearuid' => $chechExistsYear->annee_uid,
                'yearlibelle' => $chechExistsYear->annee_libelle,
                'yearstatus' => $chechExistsYear->annee_statut,
                'annee_scolaire' => $chechExistsYear->annee_libelle,
                'annee_token' => $chechExistsYear->annee_uid,
                'profile' => 'sysadmin',
                'lastloginat' => date('Y-m-d H:i:s'),
                'loggedIn' => TRUE
            ];
            //keep session data
            $this->session->set($newSessionAdminData);
            $AccessString = "";
            $arrayObjects = "";

            $infosAccessObjects = $this->modeldb->fetch_all_data('ts_acces', array('acces_status' => 'actif'), 'acces_ordre', null, null, 'ASC');

                if (!empty($infosCompteAdmin['admin_client_uid'])) {
                    $clientFiche = $this->modeldb->fetch_row_data('ts_clients', array('client_uid' => $infosCompteAdmin['admin_client_uid']));

                        $newSessionAdminClientData = [
                            'clienttoken' => $clientFiche['client_uid'],
                            'clientname' => $clientFiche['client_name'],
                            'clienttype' => $clientFiche['client_type'],
                        ];
                    //keep session data
                    $this->session->set($newSessionAdminClientData);
                }

                if (!empty($infosAccessObjects)) {
                    foreach ($infosAccessObjects as $AccesT) {
                        $AccessString .= $AccesT['acces_objet'] . "|";
                        $arrayObjects = explode('|', $AccessString);
                    }
                    $this->session->set('AccessFolderObject', $arrayObjects);
                } else {
                    $this->session->set('AccessObjects', 'all');
                }
            #=====================================================================
            #============= change some account session infos =====================
            //verifier si l'annee lancee existe deja pour cette ecole
            $chechExistsSession = $this->modeldb->fetch_field_value('ts_admins', array('admin_uid' => $infosCompteAdmin['admin_uid'], 'admin_session' => 'online'));
            $arrayDataSessionUpdated = [
                'admin_nbr_trylogin' => 3,
                'admin_session' => 'online',
                'admin_session_nbr' => (!empty($chechExistsSession->compte_session_nbr)) ? $chechExistsSession->compte_session_nbr + 1 : 1,
                'admin_lastlogin_at' => date('Y-m-d H:i:s'),
            ];
            $this->modeldb->update_data('ts_admins', $arrayDataSessionUpdated, array('admin_uid' => $infosCompteAdmin['admin_uid']));
            
            return true;

        } else {
            return false;
        }
    }

    public function changeDefault()
    {
        $data = [];
        if ($this->request->getMethod() == 'post') {
            $rulers = [
                'pass' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Mot de passe obligatoire',
                    ]
                ], 

                'cpass' => [
                    'rules' => 'matches[pass]',
                    'errors' => [
                        'matches' => 'Le mot de passe de confirmation est différente du mot de passe saisi',
                    ]
                ],
            ];

            if ($this->validate($rulers)) {

                $password = trim(htmlspecialchars($this->request->getPost('pass')));

                $current_datetime = date('Y-m-d H:i:s');
                //$random_uid_admin = $this->generateIdentifiant();

                $salt_options = array('cost' => 12);
                $new_password = password_hash($password, PASSWORD_BCRYPT, $salt_options);

                //*2021@ADM.cd $this->displayData($userID);
                //$stringPasswordAdminChecked = $this->checkStrongPassword($password);

                //if ($stringPasswordAdminChecked >= 10) {

                    $usrprofile = $this->session->get('usrprofile');
                    $usruid_sess = $this->session->get('usrtkn');

                    //check account type 

                    if ($usrprofile == 'sysadmin') {
                        # admin account.
                         if ($this->changeDefaultAdmin($usruid_sess, $new_password)) {
                            $this->session->setFlashdata('success', "Connexion Etablie !: Bienvenue cher admin dans votre espace de travail.");
                            return redirect()->to(base_url('overview'));
                        } else {
                            return redirect()->back()->with('failed', "Désolé, une erreur système s'est produite. Veuillez réessayer plus tard.");
                        }
                    } else {
                        # user account

                    //verifier existance du compte
                    $infosCompte = $this->modeldb->fetch_row_data('ts_comptes', array('compte_uid' => $usruid_sess));

                    //table data
                    $saveUserAccountData = [
                        'compte_password' => $new_password,
                        'compte_oldpass' => $infosCompte['compte_password'],
                        'compte_password_expire' => 0,
                        'compte_changepass_at' => $current_datetime,
                    ];

                    if ($this->modeldb->update_data('ts_comptes', $saveUserAccountData, array('compte_uid' => $infosCompte['compte_uid']))) {
                        $chechExistsYear = $this->modeldb->fetch_field_value('ts_annees', array('annee_statut' => 'actif'));

                        //infos agent + groupe
                        $infosAgent = $this->modeldb->fetch_join_comptes(array('agent_uid' => $infosCompte['compte_agent_uid']), 'agent_created_at', 'row');
                        //$this->displayResults($infosAgent);

                        $infosAccess = $this->modeldb->fetch_join_privileges(array('groupe_uid' => $infosCompte['compte_groupe_uid']), 'groupe_created_at', 'row');

                        $infosEcole = $this->modeldb->fetch_row_data('ts_ecoles', array('ecole_uid' => $infosCompte['compte_ecole_uid']));
                        $infosFonction = $this->modeldb->fetch_row_data('ts_fonctions_agents', array('fonction_uid' => $infosAgent['agent_fonction_uid']));

                        //table data in session
                        $newSessionData = [
                            'usertoken' => (!empty($infosCompte)?$infosCompte['compte_uid']:''),
                            'username' => (!empty($infosCompte)?$infosCompte['compte_username']:''),
                            'fullname' => (!empty($infosAgent)?$infosAgent['agent_nom']:''), '-' . (!empty($infosAgent)?$infosAgent['agent_prenom']:''),
                            'matricule' => (!empty($infosAgent)?$infosAgent['agent_matricule']:''),
                            'email' => (!empty($infosCompte)?$infosCompte['compte_email']:''),
                            'avatar' => (!empty($infosCompte)?$infosCompte['compte_avatar']:''),
                            'role' => (!empty($infosFonction)?$infosFonction['fonction_libelle']:''),
                            'groupe' => (!empty($infosAgent)?$infosAgent['groupe_libelle']:''),
                            'access' => (!empty($infosAccess)?$infosAccess['acces_libelle']:''),
                            'accessObject' => (!empty($infosAccess)?$infosAccess['acces_objet']:''),
                            'droitLire' => (!empty($infosAccess)?$infosAccess['privilege_lecture']:''),
                            'droitEcrire' => (!empty($infosAccess)?$infosAccess['privilege_ecriture']:''),
                            'droitExecute' => (!empty($infosAccess)?$infosAccess['privilege_execute']:''),
                            'droitFull' => (!empty($infosAccess)?$infosAccess['privilege_tout']:''),
                            'schooluid' => (!empty($infosEcole)?$infosEcole['ecole_uid']:''),
                            'schoolcode' => (!empty($infosEcole)?$infosEcole['ecole_code']:''),
                            'schoolname' => (!empty($infosEcole)?$infosEcole['ecole_libelle']:''),
                            'yearuid' => $chechExistsYear->annee_uid,
                            'yearlibelle' => $chechExistsYear->annee_libelle,
                            'annee_scolaire' => $chechExistsYear->annee_libelle,
                            'annee_token' => $chechExistsYear->annee_uid,
                            'profile' => 'user',
                            'loggedIn' => TRUE
                        ];

                        $AccessString = "";
                        $arrayObjects = "";
                        if (!empty($infosCompte['compte_groupe_uid'])) {
                            $infosAccessObjects = $this->modeldb->fetch_join_privileges(array('groupe_uid' => $infosCompte['compte_groupe_uid'], 'privilege_status' => 'actif'), 'acces_ordre');
                            if (is_array($infosAccessObjects) && (! empty($infosAccessObjects))) {
                                foreach ($infosAccessObjects as $AccesT) {
                                    $AccessString .= $AccesT['acces_objet'] . "|";
                                    $arrayObjects = explode('|', $AccessString);
                                }
                                $this->session->set('AccessFolderObject', $arrayObjects);
                            }
                        }
                        #=====================================================================
                        #============= change some account session infos =====================
                        //verifier si l'annee lancee existe deja pour cette ecole
                        $chechExistsSession = $this->modeldb->fetch_field_value('ts_comptes', array('compte_uid' => $infosCompte['compte_uid'], 'compte_session' => 'online'));

                        $arrayDataSessionUpdated = [
                            'compte_session' => 'online',
                            'compte_session_nbr' => (!empty($chechExistsSession->compte_session_nbr)) ? $chechExistsSession->compte_session_nbr + 1 : 1,
                            'compte_lastlogin_at' => date('Y-m-d H:i:s'),
                        ];
                        $this->modeldb->update_data('ts_comptes', $arrayDataSessionUpdated, array('compte_uid' => $infosCompte['compte_uid']));

                        //keep session data
                        $this->session->set($arrayDataSessionUpdated);
                        $this->session->set($newSessionData);
                        //put information in flash data session
                        $this->session->setFlashdata('success', "Connexion Etablie !: Bienvenue dans votre espace de travail.");
                        return redirect()->to(base_url('overview'));

                    } else {
                        return redirect()->back()->with('failed', "Désolé, une erreur systeme s'est produite. Veuillez réessayer plus tard.");
                        }
                    }
                /*} else {
                    $this->session->setFlashdata('failed', "Le mot de passe doit avoir au moins une lettre Majuscule,
                        une lettre miniscule, un caractere special choisi parmi [*|#|@|$|.|?] et un chiffre de [0-9] et une longueure d'au moins 8 caracteres.");
                    $data['validation'] = $this->validator;
                    $data['title'] = 'Change Default - Password';
                    $data['_view'] = ('password/changedefault');
                    echo view('layouts/main', $data);
                }*/

            } else {
                //$this->session->setFlashdata('failed', 'ERROR: Veuillez  vérifier ci-dessous les erreurs rencontrées puis réessayer !');
                $data['validation'] = $this->validator;
                $data['title'] = 'Change Default - Password';
                $data['_view'] = ('password/changedefault');
                echo view('layouts/main', $data);
            }

        } else {
            //$this->session->setFlashdata('failed', 'ERROR: Test');
            $data['title'] = 'Changement mot de passe par defaut';
            $data['_view'] = ('password/changedefault');        
            echo view('layouts/main', $data);
        }
    }

    public function forgotten()
    {
        $data['title'] = "Mot de passe oublié";
        $data['_view'] = ('password/forgotten');
        echo view('layouts/main', $data);
    }

    public function reset()
    {
        $data = [];
        $rulers = [
            'email' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Email obligatoire",
                ],
            ],
        ];

        if ($this->validate($rulers)) {
            $email = trim(htmlspecialchars($this->request->getPost('email')));

            if ($this->modeldb->fetch_row_data('ts_comptes', array('compte_email' => $email))) {
                //verifier existance du compte
                $infosCompte = $this->modeldb->fetch_row_data('ts_comptes', array('compte_email' => $email));

                //check if account is not blocked
                if ($infosCompte['compte_nbr_trylogin'] !=0) {

                    $userAgentData = $this->getUserAgentInfo();
                    $uid_random = $this->generateIdentifiant();
                    $time = time();
                    $token = sha1($uid_random);
                    $useruid = $infosCompte['compte_uid'];

                    $real_token_reset = sha1($token . '@' . $uid_random . '@' . $useruid);
                    $code_reset = "ED-".substr(str_shuffle(str_repeat("0123456789", mt_rand(5, 10))), 0, 5);

                    $resetPasswordData = [
                        'pass_uid' => $uid_random,
                        'pass_user_uid' => $useruid,
                        'pass_ecole_uid' => $infosCompte['compte_ecole_uid'],
                        'pass_time' => $time,
                        'pass_digicode' => $code_reset,
                        'pass_system' => $userAgentData,
                        'pass_status' => 'actif',
                        'pass_ipaddress' => $this->getClientIpAddress(),
                        'pass_token' => $real_token_reset,
                        'pass_created_at' => date('Y-m-d H:i:s'),
                    ];
                
                    if ($this->modeldb->insert_data('ts_passwords', $resetPasswordData)) {

                        //send email
                        $this->sendMail($email, $code_reset, $real_token_reset, 'Reset Password Forgotten');

                        return redirect()->to(base_url('password/resetConfirmation'));

                    } else {
                        return redirect()->back()->with('failed', "Une erreur Système s'est produite. Veuillez  reessayer plus tard !");
                    }  
                } else {
                    //block account user in attemps > 3
                    return redirect()->to(base_url('secure/accountLocked'));
                }

            } else {

                // check if is admin 
                if ($this->resetAdmin($email)) {
                    return redirect()->to(base_url('password/resetConfirmation'));
                } else {
                    
                    //return to login page with errors messages and keep old values
                    return redirect()->back()->with('failed', "Aucun compte n'est lié a cette adresse mail. Contacter votre administrateur pour reinitialiser votre mot de passe.");
                }
            }

        } else {
            //$data['failed'] = "Email Introuvable. Vous devez saisir l'adresse mail liée a votre compte !";
            $data['validation'] = $this->validator;
            $data['_view'] = 'password/forgotten';
        }
        return view('layouts/main', $data);
    }

    public function resetAdmin($email)
    {
       if ($this->modeldb->fetch_row_data('ts_admins', array('admin_email' => $email))) {
                //verifier existance du compte
                $infosCompte = $this->modeldb->fetch_row_data('ts_admins', array('admin_email' => $email));

                //check if account is not blocked
                if ($infosCompte['admin_nbr_trylogin'] !=0) {

                    $userAgentData = $this->getUserAgentInfo();
                    $uid_random = $this->generateIdentifiant();
                    $time = time();
                    $token = sha1($uid_random);
                    $useruid = $infosCompte['admin_uid'];

                    $real_token_reset = sha1($token . '@' . $uid_random . '@' . $useruid);
                    $code_reset = "ED-".substr(str_shuffle(str_repeat("0123456789", mt_rand(5, 10))), 0, 5);

                    $resetPasswordData = [
                        'pass_uid' => $uid_random,
                        'pass_user_uid' => $useruid,
                        //'pass_ecole_uid' => $infosCompte['compte_ecole_uid'],
                        'pass_time' => $time,
                        'pass_digicode' => $code_reset,
                        'pass_system' => $userAgentData,
                        'pass_status' => 'actif',
                        'pass_ipaddress' => $this->getClientIpAddress(),
                        'pass_token' => $real_token_reset,
                        'pass_created_at' => date('Y-m-d H:i:s'),
                    ];
                
                    if ($this->modeldb->insert_data('ts_passwords', $resetPasswordData)) {

                        //send email
                        $this->sendMail($email, $code_reset, $real_token_reset, 'Admin Reset Password Forgotten');

                        return true;

                    } else {
                        return false;
                    }  
                } else {
                    //block account user in attemps > 3
                    return redirect()->to(base_url('secure/accountLocked'));
                }

            } else {
                //return to login page with errors messages and keep old values
                return false;
            }
    }

    public function resetConfirmation()
    {
        $data['success'] ="Un Email de réinitialisation a été  envoyé a l'adresse mail indiquée. Vous trouverez un lien ou un code de vérification que vous devez confirmer. NB: le code ou le lien expire dans 2 heures Max";
        $data['title'] = 'Confirm Reset Password | School Web Application';
        $data['_view'] = 'password/reset';
        echo view('layouts/main', $data);
    }

    public function checkTokenReset($token = null)
    {
        $infosPassword = '';
        if ($this->request->getPost('code_reset')) {
            $infosPassword = $this->modeldb->fetch_row_data('ts_passwords', array('pass_digicode' => $this->request->getPost('code_reset')));
        }elseif (! empty($token)) {
            //$token = $this->segment->getSegment(3);
            $infosPassword = $this->modeldb->fetch_row_data('ts_passwords', array('pass_token' => $token));
        }else{
            return redirect()->back()->with('failed', "Vous devez confirmer le code ou cliqué sur le lien de réinitialisation valide");
        }
        
        //$this->displayResults($token);
        if ($this->modeldb->fetch_row_data('ts_passwords', array('pass_uid' => $infosPassword['pass_uid']))) {

            $infosCompte ='';
            $infosCompteAdmin ='';
           if ($this->modeldb->fetch_row_data('ts_comptes', array('compte_uid' => $infosPassword['pass_user_uid']))) {
              $infosCompte = $this->modeldb->fetch_row_data('ts_comptes', array('compte_uid' => $infosPassword['pass_user_uid']));
           } else {
               $infosCompteAdmin = $this->modeldb->fetch_row_data('ts_admins', array('admin_uid' => $infosPassword['pass_user_uid']));
           }
           
            if ($this->checkExpiryTimeReset($infosPassword['pass_created_at'])) {

                if (! empty($infosCompte)) {
                    //Update Account Reset password info
                    $resetAccountData = [
                        'compte_oldpass' => $infosCompte['compte_password'],
                        'compte_resetpass_nbr' => $infosCompte['compte_resetpass_nbr'] + 1,
                        'compte_resetpass_at' => date('Y-m-d H:i:s'),
                        'compte_resetpass_by' => $infosCompte['compte_username'],
                    ];
                    if ($this->modeldb->update_data('ts_comptes', $resetAccountData, array('compte_uid' => $infosCompte['compte_uid']))) {
                        //update password status verify
                        $resetPasswordData = [
                            'pass_status' => 'inactif',
                            'pass_resetpass_at' => date('Y-m-d H:i:s'),
                        ];
                        $this->modeldb->update_data('ts_passwords', $resetPasswordData, array('pass_uid' => $infosPassword['pass_uid']));
                        //set user uid in session
                        $this->session->set('usrtkn', $infosCompte['compte_uid']);
                        $this->session->set('usravatar', $infosCompte['compte_avatar']);
                        $this->session->set('usrname', $infosCompte['compte_username']);

                        return redirect()->to(base_url('password/changeDefault'));
                    } else {
                         return redirect()->back()->with('failed', "Erreur ");
                    }
                } else {
                    #  reset admin account 
                    //Update Account Reset password info
                    $resetAccountDataAdmin = [
                        'admin_oldpass' => $infosCompteAdmin['admin_password'],
                        'admin_lastchange_pass' => date('Y-m-d H:i:s'),
                    ];
                    if ($this->modeldb->update_data('ts_admins', $resetAccountDataAdmin, array('admin_uid' => $infosCompteAdmin['admin_uid']))) {
                        //update password status verify
                        $resetPasswordData = [
                            'pass_status' => 'inactif',
                            'pass_resetpass_at' => date('Y-m-d H:i:s'),
                        ];
                        $this->modeldb->update_data('ts_passwords', $resetPasswordData, array('pass_uid' => $infosPassword['pass_uid']));
                        //set user uid in session
                        $this->session->set('usrtkn', $infosCompteAdmin['admin_uid']);
                        $this->session->set('usravatar', $infosCompteAdmin['admin_avatar']);
                        $this->session->set('usrname', $infosCompteAdmin['admin_fullname']);
                        
                        $this->session->set('usrprofile', 'sysadmin');

                        return redirect()->to(base_url('password/changeDefault'));
                    } else {
                         return redirect()->back()->with('failed', "Erreur ");
                    }
                }
            } else {
                 return redirect()->back()->with('failed', "Le code indiqué ou le lien que vous avez cliqué est déja expiré. Réessayer en saisissant votre email.");
            }
        }else {
          return redirect()->back()->with('failed', "Vérifiez votre adresse mail pour avoir un lien de reinitialisation");
        } 
    }

    public function checkExpiryTimeReset($reset_time){
        $current_time = time();
        $time_diff = ($current_time - strtotime($reset_time))/60;
        if ($time_diff <= 120) {
            return true;
        }else{
            return false;
        }
    }
    public function sendMail($email, $code_reset, $token, $subject)
    {
        $lienurl = base_url('password/checkTokenReset/' . $token);
        $userAgentData = $this->getUserAgentInfo();
        $lieu =  $this->getClientLocation();

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
            $mail->setFrom('noreply-eduschool@ditotase.com', 'Eduschool Application');
            $mail->addAddress($from, '');
            $mail->addReplyTo($this->session->schoolemail, 'Ecole');
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
			$mail->addAttachment($this->session->schoollogo, $this->session->schoolname); 
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = $subject;
            $mail->Body =
                '<html>
                    <body style="font-family: Verdana; font-size:14px; color:#666666;">

                            <p> Bonjour cher ' . $from . ' </p>
                            <p> Nous avons recu une demande de reinitialisation du mot de passe de votre 
                            compte le ' . date('d/m/Y') . ' a ' . date('H:i:s') . '</p>
                            
                            <p> Code de reinitialisation: ' . $code_reset. '</p>
                            
                            <p> Pour confirmer la reinitialisation de votre mot de passe, veuillez suivre le lien ci-après 
                             </p>
                           
                            <br/>
                             <p> 
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
                                   Confirmer la reinitialisation
                             </a>
                            </p>

                            <br/>
                             <p> 
                                Vous pouvez egalement copier et coller le lien ci-dessous dans votre navigateur : <br/>
                                <strong>' . $lienurl . '</strong>
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
