<?php
/**
 * Created by PhpStorm.
 * User: ElieMwezRubuz
 * Date: 27-Feb-21
 * Time: 10:08 AM
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

class Profile extends BaseController
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

    public function _remap($method, $param1 = null, $param2 = null, $param3 = null)
    {
        if (!session()->has('loggedIn')) {
            //echo 'Disconnect';
            return redirect()->to(base_url() . '/secure/disconnect');               // redirect to login page if not connected
        } else {

            //verify method call if exist in this controller
            if (method_exists($this, $method)) {
                return $this->$method($param1, $param2, $param3);
            } else {
                return $this->index();
            }
        }
    }

    public function index()
    {
        $this->page('manage');
    }

    public function page($namePage)
    {
        $uid = $this->session->get('usertoken');

        $data['compte'] = $this->modeldb->fetch_join_comptes(array('compte_uid' =>$uid), 'compte_created_at', 'row');
        $data['agent'] = $this->modeldb->fetch_join_agents(array('agent_uid' => $data['compte']['compte_agent_uid']), 'agent_created_at', 'row');

        $data['title'] = ucfirst("$namePage - Profile | School Web Application");
        $data['_view'] = ('profile/'.$namePage);
        echo view('layouts/app', $data);
    }

    public function lockscreen()
    {
        $this->session->set('status', 'lockscreen'); 
        $data['title'] = ucfirst('Profile | School Web Application');
        $data['_view'] = ('profile/lockscreen');
        echo view('layouts/main', $data);
    }
    public function retreiveSession()
    {
        if($this->session->get('usertoken') != ''){

            $psw_db = '';
            $usermail = '';
              if($this->session->get('profile') == 'sysadmin'){
                 $infosAdmin = $this->modeldb->fetch_row_data('ts_admins', array('admin_uid' => $this->session->get('usertoken')));
                $psw_db = $infosAdmin['admin_password'];
                $usermail = $infosAdmin['admin_email'];

              }else{
                $infosCompte = $this->modeldb->fetch_row_data('ts_comptes', array('compte_uid' => $this->session->get('usertoken')));
                $psw_db = $infosCompte['compte_password'];
                $usermail = $infosCompte['compte_email'];
              }
            
            if (password_verify($this->request->getPost('password'), $psw_db)) {
                  $this->session->set('status', 'unlockscreen');
                  return redirect()->to(base_url('overview'));
            }
            else{
                
                $nbrtrylogin = $this->session->essai;
                $essai = 0;

                while ($essai <= 3) {
                    
                    if ($essai >= 3 && $this->session->essai >=0) {
                       $nbrtrylogin = $nbrtrylogin + 1 ;
                    }
                    $essai++; 
                }//end while 

                $this->session->set('essai', $nbrtrylogin);
                //$this->displayResults($this->session->essai);

                $attempts_login = $this->session->essai;
                if ($attempts_login >= 4) {

                    if($this->session->get('profile') != 'sysadmin'){
                        $compte_nbr_trylogin = 0;
                        $compte_status = 'blocked';
                        $data_login_failled = compact('compte_nbr_trylogin', 'compte_status');
                        $this->modeldb->update_data('ts_comptes', $data_login_failled,array('compte_uid' => $this->session->get('usertoken')));
                    }
                    
                      $userAgentData = $this->getUserAgentInfo();
                      $ip = $this->getClientIpAddress();
                      $lieu = $this->getClientLocation();

                      $content = "Plusieurs tentatives d'accès au compte de [$usermail] ont été detectées approximatiif à [$lieu] sur [$userAgentData] dont l'adresse IP utilisée est [$ip] lors du déverouillage d'une session verouillée par vous-meme.";

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
                    'log_ecole' => $infosCompte['compte_ecole_uid'],
                    ];
                    $this->modeldb->insert_data('ts_logs', $arrayLogActivityData);
                    return redirect()->to(base_url('secure/accountLocked'));
            
                }else{
                    $data['failed'] = "Le Mot de passe incorrect. Vous pouvez egalement cliquer sur le bouton ouvrir session avec un autre pour se connecter en nouveau dans votre espace de travail.";
                    $data['title'] = ucfirst('Profile | School Web Application');
                    $data['_view'] = ('profile/lockscreen');
                    echo view('layouts/main', $data);
                }
            }
        }else{

            return redirect()->to(base_url());
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

            if ($this->validate($rulers)) {

                $oldpass = trim(htmlspecialchars($this->request->getPost('oldpass')));
                $newpass = trim(htmlspecialchars($this->request->getPost('pass')));

                $current_datetime = date('Y-m-d H:i:s');

                $salt_options = array('cost' => 12);
                $new_password = password_hash($newpass, PASSWORD_BCRYPT, $salt_options);

                $usruid_sess = $this->session->get('usertoken');

                $infosCompte = $this->modeldb->fetch_row_data('ts_comptes', array('compte_uid' => $usruid_sess));

                //check old password 

                if ($infosCompte['compte_password'] == password_verify($oldpass, $infosCompte['compte_password'])) {

                    //chack strong password
                    $stringPasswordAdminChecked = $this->checkStrongPassword($newpass);
                    //if ($stringPasswordAdminChecked >= 25) {
                        //table data
                        $saveUpdateUserData = [
                            'compte_password' => $new_password,
                            'compte_oldpass' => $infosCompte['compte_password'],
                            'compte_password_expire' => 0,
                            'compte_changepass_at' => $current_datetime,
                        ];

                        if ($this->modeldb->update_data('ts_comptes', $saveUpdateUserData, array('compte_uid' => $infosCompte['compte_uid']))) {
                            
                            return redirect()->back()->with('success', "Changement du mot de passe effectué avec succès");

                        } else {
                            return redirect()->back()->with('failed', "Désolé, une erreur systeme s'est produite. Veuillez réessayer plus tard.");
                        }
                    /*} else {

                        $this->session->setFlashdata('failed', "Le mot de passe doit avoir au moins 1 lettre Majuscule,
                            1 lettre miniscule, 1 caractere special choisi parmi [*|#|@|$|.|?] et 1 chiffre de [0-9] et une longueure d'au moins 8 caracteres.");
                        $data['validation'] = $this->validator;
                        $data['title'] = 'ChangePassword  - Profile | School Web Application';
                        $data['_view'] = ('profile/password');
                    }*/
            } else {

                $this->session->setFlashdata('failed', 'ERROR: Veuillez  vérifier ci-dessous les erreurs rencontrées puis réessayer !');
                $data['validation'] = $this->validator;
                $data['title'] = 'Change Password  - Profile | School Web Application';
                $data['_view'] = ('profile/password');
                
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
                    $data_login_failled = compact('compte_nbr_trylogin', 'compte_status');
                    $this->modeldb->update_data('ts_comptes', $data_login_failled,array('compte_uid' => $this->session->get('usertoken')));
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
                    'log_ecole' => $infosCompte['compte_ecole_uid'],
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
        return view('layouts/app', $data);
    }

    public function changePicture()
    {
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
                    'compte_avatar' => $fullpathphoto,
                    'compte_updated_at' => date('Y-m-d H:i:s'),
                    'compte_updated_by' => $this->session->fullname .' - '. $this->session->role,
                ];
                    if($this->modeldb->update_data('ts_comptes', $arrayUpdateAccountData, array('compte_uid' => $this->session->usertoken))){

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
            $data['_view'] = ('profile/picture');
            echo view('layouts/app', $data);
        }
    }

    public function updateFicheAgent()
    {
        $data = [];
        $rulers = [

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
        ];

        if ($this->validate($rulers)) {

            if ($this->segment->getTotalSegments() == 3) {
                //get uid random
                $random_table_uid = $this->segment->getSegment(3);
                $current_datetime = date('Y-m-d H:i:s');

                $nom = trim(htmlspecialchars($this->request->getPost('nom')));
                $prenom = trim(htmlspecialchars($this->request->getPost('prenom')));
                $postnom = trim(htmlspecialchars($this->request->getPost('postnom')));
                $date_naissance = trim(htmlspecialchars($this->request->getPost('dateNaissance')));
                $lieu_naissance = trim(htmlspecialchars($this->request->getPost('lieuNaissance')));
                $adresse = trim(htmlspecialchars($this->request->getPost('adresse')));
                $email = trim(htmlspecialchars($this->request->getPost('email')));
                $telephone = trim(htmlspecialchars($this->request->getPost('telephone')));
                $sexe = trim(htmlspecialchars($this->request->getPost('sexe')));
            
                $conjoint = trim(htmlspecialchars($this->request->getPost('nom_conjoint')));
                $nombre_enfants = trim(htmlspecialchars($this->request->getPost('nombre_enfants')));
                $numero_securite = trim(htmlspecialchars($this->request->getPost('numero_securite')));

                $ville = trim(htmlspecialchars($this->request->getPost('ville')));
                $province = trim(htmlspecialchars($this->request->getPost('province')));
                $taille = trim(htmlspecialchars($this->request->getPost('taille')));
                $poids = trim(htmlspecialchars($this->request->getPost('poids')));
                $groupe_sanguin = trim(htmlspecialchars($this->request->getPost('groupeSanguin')));
                //table data
                $agentDataPrepared = [
                    'agent_nom' => $nom,
                    'agent_postnom' => $postnom,
                    'agent_prenom' => $prenom,
                    'agent_sexe' => $sexe,
                    'agent_date_naissance' => $date_naissance,
                    'agent_lieu_naissance' => $lieu_naissance,
                    'agent_email' => $email,
                    'agent_telephone' => $telephone,

                    'agent_nom_conjoint' => $conjoint,
                    'agent_nombre_enfants' => $nombre_enfants,
                    'agent_numero_securite' => $numero_securite,

                    'agent_ville' => $ville,
                    'agent_province' => $province,
                    'agent_adresse' => $adresse,

                    'agent_poids' => $poids,
                    'agent_taille' => $taille,
                    'agent_groupe_sanguin' => $groupe_sanguin,

                    'agent_updated_at' => $current_datetime,
                    'agent_updated_by' => $this->session->fullname . ' - ' . $this->session->role,
                ];

                //$this->displayResults($agentDataPrepared);

                if ($this->modeldb->update_data('ts_agents', $agentDataPrepared, array('agent_uid' => $random_table_uid))) {
                    return redirect()->back()->with('success', "Mise a jour Fiche Agent: Opération effectuée avec succés");
                } else {
                    return redirect()->back()->with('failed', "Erreur Serveur: Fiche Agent non modifiée. Veuillez réessayer plus tard !");
                }
            }//end update

        } else {
            $uid = $this->session->get('usertoken');

            $data['compte'] = $this->modeldb->fetch_join_comptes(array('compte_uid' =>$uid), 'compte_created_at', 'row');
            $data['agent'] = $this->modeldb->fetch_join_agents(array('agent_uid' => $data['compte']['compte_agent_uid']), 'agent_created_at', 'row');
            
            $this->session->setFlashdata('failed', 'ERROR: Opération non effectuée. Veuillez  vérifier ci-dessous les erreurs rencontrées puis réessayer !');
            $data['validation'] = $this->validator;
            $data['_view'] = ('profile/manage');
            return view('layouts/app', $data);
        }
    }public function updateNotesAgent()
    {
        $data = [];
        

            if ($this->segment->getTotalSegments() == 3) {
                //get uid random
                $random_table_uid = $this->segment->getSegment(3);
                $current_datetime = date('Y-m-d H:i:s');

                $biographie = trim(htmlspecialchars($this->request->getPost('biographie')));
                $competences = trim(htmlspecialchars($this->request->getPost('competences')));
                $etudes = trim(htmlspecialchars($this->request->getPost('education')));

              
                $caracteristiques = trim(htmlspecialchars($this->request->getPost('caracteristiques')));
                $observation_generale = trim(htmlspecialchars($this->request->getPost('observation')));
                $applicationetudiant = trim(htmlspecialchars($this->request->getPost('application')));
                $attitudeetudiant = trim(htmlspecialchars($this->request->getPost('attitude')));

                //table data
                $agentDataPrepared = [
                    
                    'agent_biographie' => $biographie,
                    'agent_competences' => $competences,
                    'agent_education' => $etudes,
                    
                    'agent_application' => $applicationetudiant,
                    'agent_observation' => $observation_generale,
                    'agent_caracteristiques' => $caracteristiques,
                    'agent_attitude' => $attitudeetudiant,

                    'agent_updated_at' => $current_datetime,
                    'agent_updated_by' => $this->session->fullname . ' - ' . $this->session->role,
                ];

                //$this->displayResults($agentDataPrepared);

                if ($this->modeldb->update_data('ts_agents', $agentDataPrepared, array('agent_uid' => $random_table_uid))) {
                    return redirect()->back()->with('success', "Mise a jour Fiche Agent: Opération effectuée avec succés");
                } else {
                    return redirect()->back()->with('failed', "Erreur Serveur: Fiche Agent non modifiée. Veuillez réessayer plus tard !");
                }
           
        } else {
            $uid = $this->session->get('usertoken');

            $data['compte'] = $this->modeldb->fetch_join_comptes(array('compte_uid' =>$uid), 'compte_created_at', 'row');
            $data['agent'] = $this->modeldb->fetch_join_agents(array('agent_uid' => $data['compte']['compte_agent_uid']), 'agent_created_at', 'row');
            
            $this->session->setFlashdata('failed', 'ERROR: Opération non effectuée. Veuillez  vérifier ci-dessous les erreurs rencontrées puis réessayer !');
            $data['validation'] = $this->validator;
            $data['_view'] = ('profile/manage');
            return view('layouts/app', $data);
        }
    }
    public function updateCompteAgent()
    {
        if ($this->request->getMethod() == 'post') {
            $current_datetime = date('Y-m-d H:i:s');
            $random_uid = ($this->segment->getTotalSegments() >= 3) ? $this->segment->getSegment('3') : '';
            if (! empty($random_uid)) {
                
                $updateTypeData = [
                    'compte_username' => trim(htmlentities($this->request->getPost('username'))),
                    'compte_email' => trim(htmlentities($this->request->getPost('email'))),
                    'compte_observation' => trim(htmlentities($this->request->getPost('observation'))),
                    'compte_question1' => trim(htmlentities($this->request->getPost('question1'))),
                    'compte_question2' => trim(htmlentities($this->request->getPost('question2'))),
                    'compte_question3' => trim(htmlentities($this->request->getPost('question3'))),
                    'compte_reponse1' => trim(htmlentities($this->request->getPost('reponse1'))),
                    'compte_reponse2' => trim(htmlentities($this->request->getPost('reponse2'))),
                    'compte_reponse3' => trim(htmlentities($this->request->getPost('reponse3'))),
                    'compte_updated_at' => $current_datetime,
                    'compte_updated_by' => $this->session->fullname . ' - ' . $this->session->role,
                ];
                //update data in table
                if ($this->modeldb->update_data('ts_comptes', $updateTypeData, array('compte_uid' => $random_uid))) {
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
           $msg_type = "Votre compte a été modifié. Pour de raison de sécurité, veuillez accèder pour securiser votre compte. Si c\'était vous-meme, ignorez ce mail";
           $subject_type = "Modification compte  - Eduschool Application";
        }elseif ($type == 'password') {
           $msg_type = "Votre mot de passe a été modifié. Pour de raison de sécurité, veuillez accèder pour securiser votre compte. Si c\'était vous-meme, ignorez ce mail";
           $subject_type = "Modification mot de passe  - Eduschool Application";
        }else{
            $msg_type = "Votre compte a été bloqué pour de raison de sécurité. Veuillez contacter votre administrateur pour le débloquer. Si c\'était vous-meme, ignorez ce mail";
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
            $mail->setFrom('noreply@domain.com', ' Application');
            $mail->addAddress($from, '');
            $mail->addReplyTo($this->session->schoolemail, 'Ecole');
            if (count($addresses) > 1) {
                $mail->addCC($cc1);
            }
			$mail->isSMTP();
            $mail->Host = 'mail.domain.com';
            $mail->SMTPAuth = TRUE;
            $mail->SMTPSecure = 'tls';
            $mail->Username = 'emil@domain.com';
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
