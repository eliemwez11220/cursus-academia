<?php

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

class Secure extends BaseController
{
    protected $session;
    protected $modeldb;

    function __construct()
    {
        helper(['url', 'html', 'form', 'text', 'email', 'date', 'download', 'file', 'security', 'string']);
        $this->session = session();
        //load generic model
        $this->modeldb = new AppModel();
    }

    public function signIn()
    {
        if (!session()->has('loggedIn')) {
           $data = [
            'title' => ucfirst('Bienvenue | School Web Application'), // Capitalize the first letter
            '_view' => ('pages/login'),
            'admins' => $this->modeldb->fetch_count('ts_admins', array('admin_statut' => 'actif')),
        ];
        echo view('layouts/main', $data);
        } else {
            return redirect()->to(previous_url());
        }
    }

    public function page($name="about")
    {
        $data = [
            'title' => ucfirst('Gestion de délibération des étudiants'), // Capitalize the first letter
            '_view' => ('pages/'.$name),
        ];
        echo view('layouts/main', $data);
    }

    public function createAdminAccount()
    {
        $data = [];
        $rulers = [
            'fullname' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Nom Complet Obligatoire",
                ],
            ], 'username' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Pseudo Admin Obligatoire",
                ],
            ], 'email' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Email Admin Obligatoire",
                ],
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mot de passe obligatoire',
                    'min_lenght' => 'Le mot de passe doit avoir au moins 8 caracteres',
                ]
            ], 'password_confirm' => [
                'rules' => 'matches[password]',
                'errors' => [
                    'matches' => 'Le mot de passe de confirmation est differente du mot de passe saisi',
                ]
            ],
        ];

        if ($this->validate($rulers)) {
            $fullname = trim(htmlspecialchars($this->request->getPost('fullname')));
            $username = trim(htmlspecialchars($this->request->getPost('username')));
            $email = trim(htmlspecialchars($this->request->getPost('email')));
            $password = trim(htmlspecialchars($this->request->getPost('password')));

            $current_datetime = date('Y-m-d H:i:s');
            $random_uid_admin = $this->generateIdentifiant();

            $salt_options = array('cost' => 12);
            $new_password = password_hash($password, PASSWORD_BCRYPT, $salt_options);

            //$this->displayData($userID);
            $stringPasswordAdminChecked = $this->checkStrongPassword($password);

            if ($stringPasswordAdminChecked >= 25) {

                //table data
                $saveAdminData = [
                    'admin_uid' => $random_uid_admin,
                    'admin_pseudo' => $username,
                    'admin_fullname' => $fullname,
                    'admin_email' => $email,
                    'admin_password' => $new_password,
                    'admin_statut' => 'actif',
                    'admin_profile' => 'webmaster',
                    'admin_type' => 'sysadmin',
                    'admin_created_at' => $current_datetime,
                ];

                if ($this->modeldb->insert_data('ts_admins', $saveAdminData)) {

                    return redirect()->back()->with('success', "Successfully Admin Account Created !");
                } else
                    return redirect()->back()->with('failed', "ERREUR: Désolé, une erreur systeme s'est produite. Veuillez réessayer plus tard.");
            } else {

                $this->session->setTempdata('failed', "Le mot de passe doit avoir au moins une lettre Majuscule,
                 une lettre miniscule, un caractere special choisi parmi [*|#|@|$|.|?] et un chiffre de [0-9] et une longueure d'au moins 8 caracteres.");
                $data['validation'] = $this->validator;
                $data['admins'] = $this->modeldb->fetch_count('ts_admins', array('admin_statut' => 'actif'));
                $data['_view'] = ('pages/login');
                echo view('layouts/main', $data);
            }

        } else {

            $this->session->setTempdata('failed', 'ERROR: Veuillez  vérifier ci-dessous les erreurs rencontrées puis réessayer !');
            $data['validation'] = $this->validator;

            $data['admins'] = $this->modeldb->fetch_count('ts_admins', array('admin_statut' => 'actif'));
            $data['_view'] = ('pages/login');
            echo view('layouts/main', $data);
        }
    }

    public function login()
    {
        /*// Création d'un gestionnaire cURL41.243.2.29
        $ch = curl_init("http://ipinfo.io/");

        // Exécution
        $locipdata = curl_exec($ch);

        // Vérification du code d'état HTTP
        if (!curl_errno($ch)) {
            switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
                case 200:
                    $locdata = curl_getinfo($ch);
                    break;
                default:
                    echo 'Unexpected HTTP code: ', $http_code, "\n";
            }
        }
        // Close handle
        curl_close($ch);
        $lieu = $this->getClientLocation();
        $this->displayResults($locipdata);
*/
        if ($this->request->getPost('honeypot') != "") {
            return redirect()->back()->withInput();
        } else {
            $data = [];
            $rulers = [
                'username' => [
                    'rulers' => 'required',
                    'errors' => [
                        'required' => "Identifiant obligatoire",
                    ],
                ],
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Mot de passe obligatoire',
                    ]
                ]
            ];

            if ($this->validate($rulers)) {
                $username = trim(htmlspecialchars($this->request->getPost('username')));
                $password = trim(htmlspecialchars($this->request->getPost('password')));

                //verifier si l'annee lancee existe deja pour cette ecole
                $chechExistsYear = $this->modeldb->fetch_field_value('ts_annees', array('annee_statut' => 'actif'));

                if (!empty($chechExistsYear)) {
                    if ($this->modeldb->fetch_orWhere_data('ts_admins', array('admin_pseudo' => $username), array('admin_email' => $username))) {
                        if ($this->checkAdminPassword($username, $password)) {
                            //check account status
                            if ($this->checkAdminAccountStatus($username)) {
                                //put information in flash data session
                                $this->session->setFlashdata('success', "Connexion Etablie !: Bienvenue cher admin $username dans votre espace de travail.");

                                /*send email notify admin
                                if (!empty($this->session->email)) {
                                    //send email to register user email
                                    $this->sendMailNotifieUser($this->session->email, 'Acces a votre espace de travail.');
                                }*/

                                return redirect()->to(base_url('overview'));
                            } else {
                                //return to login page with errors messages and keep old values
                                return redirect()->back()->with('failed', 'Votre compte est bloqué. Veuillez connecter votre administrateur');
                            }

                        } else {
                            //verifier existance du compte
                            $infosCompteAdmin = $this->modeldb->fetch_orWhere_data('ts_admins', array('admin_pseudo' => $username), array('admin_email' => $username));

                            $admin_nbr_trylogin = $infosCompteAdmin['admin_nbr_trylogin'];
                            $attempts_login_admin = $admin_nbr_trylogin;
                            if ($this->checkAttempTryLogin($username, 'admin')) {
                                $admin_nbr_trylogin = $attempts_login_admin - 1;
                                $admin_statut = ($admin_nbr_trylogin == 0) ? 'blocked' : 'actif';
                                $data_login_failled = compact('admin_nbr_trylogin', 'admin_statut');
                                $this->modeldb->update_data('ts_admins', $data_login_failled, array('admin_uid' => $infosCompteAdmin['admin_uid']));
                                $msg_notifie = ($admin_nbr_trylogin < 2) ? "Attention ! Il ne vous reste plus qu'un essai pour bloquer votre compte. Introduisez un bon mot de passe. " : "Mot de passe incorrect";
                                //return to login page with errors messages and keep old values
                                return redirect()->back()->with('failed', $msg_notifie);
                            } else {
                                //redirect to account blocked page
                                return redirect()->to(base_url('secure/accountLocked'));
                            }//end check attempt try login
                        }
                    } elseif ($this->modeldb->fetch_orWhere_data('ts_comptes', array('compte_username' => $username), array('compte_email' => $username))) {
                        //verifier existance du compte
                        $infosCompte = $this->modeldb->fetch_orWhere_data('ts_comptes', array('compte_username' => $username), array('compte_email' => $username));

                        $compte_nbr_trylogin = $infosCompte['compte_nbr_trylogin'];
                        $attempts_login = $compte_nbr_trylogin;
                        //if ($this->checkAttempTryLogin($username, 'agent')) {
                        //check password password_verify
                        if ($this->checkUserPassword($username, $password)) {
                            if ($this->checkUserActivated($username)) {
                                //check if is login with default password
                                if ($infosCompte['compte_password_expire'] == 1) {
                                    //set user uid in session
                                    $this->session->set('usrtkn', $infosCompte['compte_uid']);
                                    $this->session->set('usravatar', $infosCompte['compte_avatar']);
                                    $this->session->set('usrname', $infosCompte['compte_username']);
                                    $this->session->setFlashdata('info', "Veuillez changer votre mot de passe par defaut.");
                                    return redirect()->to(base_url('password/changeDefault'));
                                } else {
                                    $this->session->setFlashdata('success', "Connexion Etablie !: Bienvenue cher  $username dans votre espace de travail.");

                                    //send email notify user
                                    if (!empty($this->session->email)) {
                                        //send email to register user email
                                        $this->sendMailNotifieUser($this->session->email, 'Acces a votre espace de travail.');
                                    }

                                    return redirect()->to(base_url('overview'));
                                }//end else //check default password
                            } else {
                                //return to login page with errors messages and keep old values
                                return redirect()->back()->with('failed', 'Votre compte est bloqué. Veuillez contacter votre administrateur ou le webmaster');
                            }//end check account status

                        } else {
                            $compte_nbr_trylogin = $infosCompte['compte_nbr_trylogin'];
                            $attempts_login = $compte_nbr_trylogin;
                            if ($this->checkAttempTryLogin($username, 'agent')) {
                                $compte_nbr_trylogin = $attempts_login - 1;
                                $compte_status = ($compte_nbr_trylogin == 0) ? 'blocked' : 'actif';
                                $data_login_failled = compact('compte_nbr_trylogin', 'compte_status');
                                $this->modeldb->update_data('ts_comptes', $data_login_failled, array('compte_uid' => $infosCompte['compte_uid']));
                                $msg_notifie = ($compte_nbr_trylogin < 2) ? "Attention ! Il ne vous reste plus qu'un essai pour bloquer votre compte. Introduisez un bon mot de passe. " : "Mot de passe incorrect";
                                //return to login page with errors messages and keep old values
                                return redirect()->back()->with('failed', $msg_notifie);
                            } else {
                                //redirect to account blocked page
                                return redirect()->to(base_url('secure/accountLocked'));
                            }//end check attempt try login
                        }//end check password

                    } else {
                        //return to login page with errors messages and keep old values
                        return redirect()->back()->with('failed', "Vos identifiants de connexion sont incorrects");
                    }
                } else {
                    //return to login page with errors messages and keep old values
                    return redirect()->back()->with('failed', "Aucune année scolaire scolaire n'est ouverte");
                }

            } else {

                $data['failed'] = "Vos identifiants de connexion sont incorrects !";
                $data['validation'] = $this->validator;
            }
            $data['admins'] = $this->modeldb->fetch_count('ts_admins', array('admin_statut' => 'actif'));
            $data['_view'] = 'pages/login';
            return view('layouts/main', $data);
        }
    }

    public function checkAttempTryLogin($username, $accountType)
    {
        if ($accountType == 'agent') {
            $infosCompte = $this->modeldb->fetch_orWhere_data('ts_comptes', array('compte_username' => $username), array('compte_email' => $username));
        } else {
            $infosCompte = $this->modeldb->fetch_orWhere_data('ts_admins', array('admin_pseudo' => $username), array('admin_email' => $username));
        }

        $compte_nbr_trylogin = ($accountType == 'agent') ? $infosCompte['compte_nbr_trylogin'] : $infosCompte['admin_nbr_trylogin'];
        $attempts_login = $compte_nbr_trylogin;
        if ($attempts_login != 0) {

            return true;

        } else {
            $userAgentData = $this->getUserAgentInfo();
            $ip = $this->getClientIpAddress();
            $lieu = $this->getClientLocation();

            $usermail = ($accountType == 'agent') ? $infosCompte['compte_email'] : $infosCompte['admin_email'];
            $content = "Plusieurs tentatives d'accès au compte de [$usermail] ont été detectées approximatiif à [$lieu] sur [$userAgentData] dont l'adresse IP utilisée est [$ip]";

            if (!empty($usermail)) {
                //send email to register user email
                $this->sendMailNotifieUser($usermail, $content);
            }

            // create log infos
            $arrayLogActivityData = [
                'log_uid' => $this->generateIdentifiant(),
                'log_created_at' => date('Y-m-d H:i:s'),
                'log_content' => $content,
                'log_user' => $usermail,
                'log_ecole' => ($accountType == 'agent') ? $infosCompte['compte_ecole_uid'] : $infosCompte['admin_ecole_uid'],
            ];
            $this->modeldb->insert_data('ts_logs', $arrayLogActivityData);

            //redirect to account blocked page
            return false;
        }//end check attempt try login
    }

    public function checkUserPassword($username, $password)
    {
        $infosCompte = $this->modeldb->fetch_orWhere_data('ts_comptes', array('compte_username' => $username), array('compte_email' => $username));

        $compte_nbr_trylogin = $infosCompte['compte_nbr_trylogin'];
        $attempts_login = $compte_nbr_trylogin;

        //check password password_verify
        if (password_verify($password, $infosCompte['compte_password'])) {
            return true;
        } else {
            return false;
        }//end check password

    }

    public function checkUserActivated($username)
    {
        $chechExistsYear = $this->modeldb->fetch_field_value('ts_annees', array('annee_statut' => 'actif'));
        $infosCompte = $this->modeldb->fetch_orWhere_data('ts_comptes', array('compte_username' => $username), array('compte_email' => $username));
        //infos agent + groupe
        $infosAgent = $this->modeldb->fetch_join_comptes(array('agent_uid' => $infosCompte['compte_agent_uid']), 'agent_created_at', 'row');
        $infosEcole = $this->modeldb->fetch_row_data('ts_ecoles', array('ecole_uid' => $infosCompte['compte_ecole_uid']));
        $infosFonction = $this->modeldb->fetch_row_data('ts_fonctions_agents', array('fonction_uid' => $infosAgent['agent_fonction_uid']));
        if ($infosCompte['compte_status'] == 'actif') {

            //table data in session
            $newSessionData = [
                'usertoken' => $infosCompte['compte_uid'],
                'username' => $infosCompte['compte_username'],
                'agenttoken' => $infosAgent['agent_uid'],
                'fullname' => $infosAgent['agent_nom'] . '-' . $infosAgent['agent_prenom'],
                'matricule' => $infosAgent['agent_matricule'],
                'adresse' => (!empty($infosAgent['agent_adresse'])) ? $infosAgent['agent_adresse'] : $this->getClientLocation(),
                'phone' => $infosAgent['agent_telephone'],
                'email' => $infosCompte['compte_email'],
                'avatar' => $infosCompte['compte_avatar'],
                'role' => $infosFonction['fonction_libelle'],
                 'usertype' => $infosCompte['compte_type'],
                'groupe' => $infosAgent['groupe_libelle'],
                'groupeuid' => $infosAgent['groupe_uid'],
                'schooluid' => $infosEcole['ecole_uid'],
                'schoolcode' => $infosEcole['ecole_code'],
                'schoolname' => $infosEcole['ecole_libelle'],
                'schooladdress' => $infosEcole['ecole_adresse'],
                'schoolemail' => $infosEcole['ecole_email'],
                'schoolphone' => $infosEcole['ecole_telephone'],
                'schoolmgr' => $infosEcole['ecole_gestionnaire'],
                'schoollogo' => $infosEcole['ecole_logo'],
                'yearuid' => $chechExistsYear->annee_uid,
                'yearlibelle' => $chechExistsYear->annee_libelle,
                'yearstatus' => $chechExistsYear->annee_statut,
                'annee_scolaire' => $chechExistsYear->annee_libelle,
                'annee_token' => $chechExistsYear->annee_uid,
                'profile' => 'user',
                'loggedIn' => TRUE
            ];

            $AccessString = "";
            $arrayObjects = "";
            if (!empty($infosCompte['compte_groupe_uid'])) {
                $infosAccessObjects = $this->modeldb->fetch_join_privileges(array('groupe_uid' => $infosCompte['compte_groupe_uid'],
                    'privilege_ecole_uid' => $infosCompte['compte_ecole_uid'], 'privilege_status' => 'actif'), 'acces_ordre');
                if (!empty($infosAccessObjects)) {
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
                'compte_nbr_trylogin' => 3,
                'compte_session' => 'online',
                'compte_session_nbr' => (!empty($chechExistsSession->compte_session_nbr)) ? $chechExistsSession->compte_session_nbr + 1 : 1,
                'compte_lastlogin_at' => date('Y-m-d H:i:s'),
            ];
            $this->modeldb->update_data('ts_comptes', $arrayDataSessionUpdated, array('compte_uid' => $infosCompte['compte_uid']));
            //keep session data
            $this->session->set($arrayDataSessionUpdated);
            $this->session->set($newSessionData);
            return true;

        } else {
            return false;
        }
    }

    public function checkAdminPassword($username, $password)
    {
        //verifier existance du compte
        $infosCompteAdmin = $this->modeldb->fetch_orWhere_data('ts_admins', array('admin_pseudo' => $username), array('admin_email' => $username));
        //check password password_verify
        if (password_verify($password, $infosCompteAdmin['admin_password'])) {
            if (!empty($infosCompteAdmin['admin_ecole_uid'])) {
                //SCHOOL INFOS
                $infosEcoleAdmin = $this->modeldb->fetch_row_data('ts_ecoles', array('ecole_uid' => $infosCompteAdmin['admin_ecole_uid']));

                $InfosSessionEcoleAdmin = [
                    'schooluid' => $infosEcoleAdmin['ecole_uid'],
                    'schoolcode' => $infosEcoleAdmin['ecole_code'],
                    'schoolname' => $infosEcoleAdmin['ecole_libelle'],
                    'schooladdress' => $infosEcoleAdmin['ecole_adresse'],
                    'schoolemail' => $infosEcoleAdmin['ecole_email'],
                    'schoolphone' => $infosEcoleAdmin['ecole_telephone'],
                    'schoolmgr' => $infosEcoleAdmin['ecole_gestionnaire'],
                    'schoollogo' => $infosEcoleAdmin['ecole_logo'],
                ];
                $this->session->set($InfosSessionEcoleAdmin);
            }
            return true;

        } else {
            return false;
        }
    }

    public function checkAdminAccountStatus($username)
    {
        $chechExistsYear = $this->modeldb->fetch_field_value('ts_annees', array('annee_statut' => 'actif'));
        //verifier existance du compte
        $infosCompteAdmin = $this->modeldb->fetch_orWhere_data('ts_admins', array('admin_pseudo' => $username), array('admin_email' => $username));
        if ($infosCompteAdmin['admin_statut'] == 'actif') {
            //table data in session
            $newSessionAdminData = [
                'usertoken' => $infosCompteAdmin['admin_uid'],
                'username' => $infosCompteAdmin['admin_pseudo'],
                'fullname' => $infosCompteAdmin['admin_fullname'],
                'email' => $infosCompteAdmin['admin_email'],
                'avatar' => $infosCompteAdmin['admin_avatar'],
                'role' => $infosCompteAdmin['admin_profile'],
                'profile' => $infosCompteAdmin['admin_type'],
                'groupe' => 'administrateurs',
                'yearuid' => $chechExistsYear->annee_uid,
                'yearlibelle' => $chechExistsYear->annee_libelle,
                'yearstatus' => $chechExistsYear->annee_statut,
                'annee_scolaire' => $chechExistsYear->annee_libelle,
                'annee_token' => $chechExistsYear->annee_uid,
                'lastloginat' => date('Y-m-d H:i:s'),
                'loggedIn' => TRUE
            ];
            //keep session data
            $this->session->set($newSessionAdminData);
            $AccessString = "";
            $arrayObjects = "";
            //$infosAccessObjects = $this->modeldb->fetch_all_data('ts_acces', array('acces_status' => 'actif'), 'acces_ordre', null, null, 'ASC');
            $infosAccessObjects = $this->modeldb->fetch_join_privileges(array(
                'privilege_ecole_uid' => $infosCompteAdmin['admin_uid'], 'privilege_status' => 'actif'), 'acces_ordre');
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
                $this->session->set('AccessFolderObjects', 'all');
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
            //return to login page with errors messages and keep old values
            return false;
        }
    }

    public function accountLocked()
    {
        $this->session->destroy();
        $data['title'] = "Compte bloqué | Eduschool Application";
        $data['failed'] = "Votre compte est bloqué. Vous avez essayer plusieurs fois sans succès.
         Veuillez contacter votre administrateur pour le débloquer.";
        $data['_view'] = "pages/account_locked";
        echo view('layouts/main', $data);
    }

    public function guest()
    {
        if (!session()->has('loggedIn')) {
            $data = [
                'title' => ucfirst('Main | Eduschool Web Application'), // Capitalize the first letter
                '_view' => ('pages/login_guest')
            ];
            echo view('layouts/main', $data);
        } else {
            return redirect()->back();
        }
    }

    public function students()
    {
        $data = [];
       if ($this->request->getMethod() == 'post') {
            $rulers = [
                'identifiant' => [
                    'rulers' => 'required',
                    'errors' => [
                        'required' => "Numero Matricule obligatoire",
                    ],
                ]
            ];
        if ($this->validate($rulers)) {
            $identifiant = trim(htmlspecialchars($this->request->getPost('identifiant')));
            $type = 'étudiant';
            //verifier si l'annee lancee existe deja pour cette ecole
            $chechExistsYear = $this->modeldb->fetch_field_value('ts_annees', array('annee_statut' => 'actif'));
            if (!empty($chechExistsYear)) {
                if ($this->modeldb->fetch_orWhere_data('ts_etudiants', array('etudiant_pseudo' => $identifiant),
                    array('etudiant_matricule' => $identifiant), 'row')) {
                    //info sur etudiant
                    $infosetudiant = $this->modeldb->fetch_orWhere_data('ts_etudiants', array('etudiant_pseudo' => $identifiant), array('etudiant_matricule' => $identifiant), 'row');
                    if (!empty($infosetudiant)) {
                        //info sur inscription
                        $infosInscription = $this->modeldb->fetch_join_inscription(array('inscription_etudiant_uid' => $infosetudiant['etudiant_uid']), 'inscription_created_at', 'row');
                        //info promotion
                        $infospromotion = $this->modeldb->fetch_join_promotions(array('promotion_uid' => $infosInscription['inscription_promotion_uid']), 'promotion_created_at', 'row');
                        //infos ecole
                        $infosEcole = $this->modeldb->fetch_row_data('ts_ecoles', array('ecole_uid' => $infosetudiant['etudiant_ecole_uid']));
                        if ($infosetudiant['etudiant_statut'] == 'actif') {
                            //table data in session
                            $newSessionData = [
                                'usertoken' => $infosetudiant['etudiant_uid'],
                                'username' => $infosetudiant['etudiant_matricule'],
                                'fullname' => $infosetudiant['etudiant_nom'] . '-' . $infosetudiant['etudiant_prenom'],
                                'matricule' => $infosetudiant['etudiant_matricule'],
                                'email' => $infosetudiant['etudiant_email'],
                                'avatar' => $infosetudiant['etudiant_photo'],
                                'promotiontoken' => $infospromotion['promotion_uid'],
                                'promotion' => $infospromotion['promotion_libelle'],
                                'filiere' => $infospromotion['filiere_libelle'],
                                'filieretoken' => $infospromotion['filiere_uid'],
                                'cycle' => $infospromotion['cycle_libelle'],
                                'cycletoken' => $infospromotion['cycle_uid'],
                                'option' => $infospromotion['option_libelle'],
                                'role' => $type,
                                'schooluid' => $infosEcole['ecole_uid'],
                                'schoolcode' => $infosEcole['ecole_code'],
                                'schoolname' => $infosEcole['ecole_libelle'],
                                'schooladdress' => $infosEcole['ecole_adresse'],
                                'schoolemail' => $infosEcole['ecole_email'],
                                'schoolphone' => $infosEcole['ecole_telephone'],
                                'schoolmgr' => $infosEcole['ecole_gestionnaire'],
                                'schoollogo' => $infosEcole['ecole_logo'],
                                'yearuid' => $chechExistsYear->annee_uid,
                                'yearlibelle' => $chechExistsYear->annee_libelle,
                                'yearstatus' => $chechExistsYear->annee_statut,
                                'loggedIn' => TRUE
                            ];
                            $this->session->set($newSessionData);
                            //put information in flash data session
                            $this->session->setFlashdata('success', "Connexion établie. Bienvenue cher étudiant !");
                            return redirect()->to(base_url('home'));
                        } else {
                            //return to login page with errors messages and keep old values
                            return redirect()->back()->with('failed', "Votre profil étudiant est bloqué. Veuillez contacter votre admin");
                        }
                    } else {
                        return redirect()->back()->with('failed', "Identifiant invalide");
                    }
                } else {
                    return redirect()->back()->with('failed', "Identifiant invalide");
                }
            } else {
                //return to login page with errors messages and keep old values
                return redirect()->back()->with('failed', "Aucune année scolaire n'est ouverte");
            }
        } else {
            $data['failed'] = "Identifiant invalide !";
            $data['validation'] = $this->validator;
            $data['_view'] = 'pages/students';
            echo view('layouts/main', $data);
        }
        } else {
            $data['title'] = "Accès étudiants";
            $data['_view'] = 'pages/students';
            echo view('layouts/main', $data);
        }
    }

    public function disconnect()
    {
        $uid_sess = $this->session->usertoken;
        if ($this->session->profile == 'sysadmin') {
            $arrayDataSessionUpdated = [
                'admin_session' => ($this->session->compte_session_nbr > 1) ? 'offline' : 'online',
                'admin_session_nbr' => $this->session->compte_session_nbr - 1,
                'admin_lastlogout_at' => date('Y-m-d H:i:s'),
            ];
            $this->modeldb->update_data('ts_admins', $arrayDataSessionUpdated, array('admin_uid' => $uid_sess));
        } else {
            $arrayDataSessionUpdated = [
                'compte_session' => ($this->session->compte_session_nbr > 1) ? 'offline' : 'online',
                'compte_session_nbr' => $this->session->compte_session_nbr - 1,
                'compte_lastlogout_at' => date('Y-m-d H:i:s'),
            ];
            $this->modeldb->update_data('ts_comptes', $arrayDataSessionUpdated, array('compte_uid' => $uid_sess));
        }
        $this->session->destroy();
        return redirect()->to(base_url());
    }

    public function sendMailNotifieUser($email, $content)
    {
        $userAgentData = $this->getUserAgentInfo();
        $lieu = $this->getClientLocation();
        $datetime = date('Y-m-d H:i:s');
        $username = (!empty($email)) ? $email : 'Anonyme';
        $subject = "Access Account $datetime - Eduschool Application";
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
            //$mail->addAttachment($this->session->schoollogo, $this->session->schoolname);
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = $subject;
            $mail->Body =
                '<html>
                    <body style="font-family: Verdana; font-size:14px; color:#666666;">
                            <p> Bonjour cher ' . $username . '. Nous informons au sujet de ' . $subject . '</p>
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
                                Système: ' . $userAgentData . '<br/>
                                Lieu Approximatif : ' . $lieu . '<br/>
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