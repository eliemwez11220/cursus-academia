<?php

namespace App\Controllers;

use CodeIgniter\Controller;
//mail sending namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//mail files sending
require_once APPPATH . 'ThirdParty/PHPMailer/src/Exception.php';
require_once APPPATH . 'ThirdParty/PHPMailer/src/PHPMailer.php';
require_once APPPATH . 'ThirdParty/PHPMailer/src/SMTP.php';

//import Models
use App\Models\AppModel;
class Page extends BaseController
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
        if (method_exists($this, $method)) {
            return $this->$method($param1, $param2, $param3);
        } else {
            return $this->index();
        }
    }
	public function index()
	{
	    $this->view('about');
	}
	public function view($page = null)
	{
		$data=[];
        switch ($page) {
            case 'clients':
                $data['typesecoles'] = $this->modeldb->fetch_all_data('ts_typesecoles', array('typesecole_statut' => 'actif'), 'typesecole_created_at');
                $data['typesens'] = $this->modeldb->fetch_all_data('ts_typesenseignements', array('typesens_statut' => 'actif'), 'typesens_created_at');
                $data['coordinations'] = $this->modeldb->fetch_all_data('ts_coordinations', array('coordination_statut' => 'actif'), 'coordination_created_at');
                break;
            default:
                null;
        }
	    $data['title'] = ucfirst($page); // Capitalize the first letter
        $data['page'] = ucfirst($page); // Capitalize the first letter
        $data['_view'] = 'pages/'.$page;
        echo view('layouts/main',$data);
	}
    public function register(){
		if($this->request->getPost('honeypot') != ""){
			return redirect()->back()->withInput();
		}else{
        $data = [];

		$data['typesecoles'] = $this->modeldb->fetch_all_data('ts_typesecoles', array('typesecole_statut' => 'actif'), 'typesecole_created_at');
        $data['typesens'] = $this->modeldb->fetch_all_data('ts_typesenseignements', array('typesens_statut' => 'actif'), 'typesens_created_at');
     $data['coordinations'] = $this->modeldb->fetch_all_data('ts_coordinations', array('coordination_statut' => 'actif'), 'coordination_created_at');

        $rulers = [
            'nom_client' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Nom obligatoire",
                ],
            ],
			'username' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Identifiant obligatoire",
                ],
            ],
			'type_client' => [
                'rulers' => 'required',
                'errors' => [
                    'required' => "Profil obligatoire",
                ],
            ],
            'libelle_ecole' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Ecole obligatoire',
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
            ],
			'terms_users' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'cochez cette case',
                ]
            ],
            'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Mot de passe obligatoire',
                    ]
                ], 

                'cpass' => [
                    'rules' => 'matches[password]',
                    'errors' => [
                        'matches' => 'Le mot de passe de confirmation est differente du mot de passe saisi',
                    ]
                ],
        ];

        if ($this->validate($rulers)) {

			//new code generated automatically
            $aleatoire_value = "0123456789";
            $code_client_ecole = "c" . substr(str_shuffle(str_repeat($aleatoire_value, mt_rand(5, 20))), 0, 5)."c";

            $libelle_ecole = trim(htmlspecialchars($this->request->getPost('libelle_ecole')));
            $type_enseign_fk = trim(htmlspecialchars($this->request->getPost('typeens_sid')));
            $type_ecole_fk = trim(htmlspecialchars($this->request->getPost('typeecole_sid')));
			$coordination_fk = trim(htmlspecialchars($this->request->getPost('coordination_ecole')));
            $client_email = trim(htmlspecialchars($this->request->getPost('email_client')));
            $client_profil = trim(htmlspecialchars($this->request->getPost('type_client')));
			$client_name = trim(htmlspecialchars($this->request->getPost('nom_client')));
            $current_datetime = date('Y-m-d H:i:s');

			$random_uid_client = $this->generateIdentifiant();
			$random_uid_ecole = $this->generateIdentifiant();
			$random_uid_admin = $this->generateIdentifiant();

                $username = trim(htmlspecialchars($this->request->getPost('username')));
                $password = trim(htmlspecialchars($this->request->getPost('password')));
                $salt_options = array('cost' => 12);
                $new_password = password_hash($password, PASSWORD_BCRYPT, $salt_options);
			//infos client
                $saveClientData = [
                        'client_uid' => $random_uid_client,
                        'client_name' => $client_name,
                        'client_type' => $client_profil,
                        'client_email' => $client_email,
                        'client_statut' => 'actif',
                        'client_created_at' => $current_datetime,
                        'client_created_by' => $this->session->fullname . ' - ' . $this->session->role,


                    ];
                //infos ecole
                $saveEcoleData = [
                    'ecole_uid' => $random_uid_ecole,
                    'ecole_code' => $code_client_ecole,
                    'ecole_libelle' => $libelle_ecole,
                    'typesecole_uid' => $type_ecole_fk,
                    'typesens_uid' => $type_enseign_fk,
					'ecole_coordination' => $coordination_fk,
                    'ecole_gestionnaire' => $client_name,
                    'ecole_statut' => 'actif',
                    'ecole_created_at' => $current_datetime,
                    'ecole_created_by' => 'System - Self',
                    'ecole_client_uid' => $random_uid_client, // client de l'ecole
                ];
				/**
				***
				Compte admin pour école
				***
				**/
				//$username = trim(htmlspecialchars($code_client_ecole));
                //$password = $code_client_ecole.'*Adm'.time();
                //$salt_options = array('cost' => 12);
                //$new_password = password_hash($password, PASSWORD_BCRYPT, $salt_options);
				//table admin ecole data
                    $saveAdminData = [
                        'admin_uid' => $this->generateIdentifiant(),
                        'admin_pseudo' => $username,
                        'admin_fullname' => $client_name,
                        'admin_email' => $client_email,
                        'admin_password' => $new_password,
                        'admin_statut' => 'actif',
                        'admin_profile' => $client_profil,
						'admin_type' => 'client',
                        'admin_created_at' => $current_datetime,
                        'admin_client_uid' => $random_uid_client, //client uid
                    ];
                    if ($this->modeldb->insert_data('ts_clients', $saveClientData)) {
                        //send credentials to client
                        $content = "Vos identifiants de connexion suite à votre abonnement à Eduschool Application. Identifiant ou Nom d'utilisateur : $username et le mot de passe est $password.";
                        if (! empty($client_email)) {
                            // code...
                            $this->sendMailCredentials($client_email, $content, 'Vos identifiants de connexion');
                        }
                        //save admin account
                        $this->modeldb->insert_data('ts_admins', $saveAdminData);
						//check if school created
						if ($this->modeldb->insert_data('ts_ecoles', $saveEcoleData)) {
							return redirect()->back()->with('success', "Opération effectuée avec succés. Votre école a été enregistrée. Consulter votre adresse mail pour voir les identifiants de connexion et valider votre compte. A présent, vous pouvez vous connecter avec les identifiants saisi.");
						}
					}
		} else {
            $data['validation'] = $this->validator;
            $data['_view'] = ('pages/clients');
            return view('layouts/main', $data);
        }
		}
	}
	public function sendMailCredentials($email, $content, $subject){
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
            $mail->setFrom('noreply@domain.com', ' Application');
            $mail->addAddress($from, '');
            $mail->addReplyTo('email@domain.com', ' Administration');
            if (count($addresses) > 1) {
                $mail->addCC($cc1);
            }
			$mail->isSMTP();
            $mail->Host = 'mail.domain.com';
            $mail->SMTPAuth = TRUE;
            $mail->SMTPSecure = 'tls';
            $mail->Username = '';
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
							<h1>Abonnement  à Eduschool Web Application</h1>
                            <p>Bonjour cher ' . $username . '. Nous avons reçu une demande concernant
														votre abonnement à notre application. En effet votre abonnement est mis en attente.</p>
                            <p>' . $content . '</p>
                            <p>Veuillez cliquer sur le lien ci-après pour confirmer votre inscription.</p>
                            <br/>
                            <br/>
                            <br/>
                             <p>
                                <a href="' . base_url('secure/signin') . '"
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
                                       Valider mon compte
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
            }
            return false;
        } catch (Exception $e) {
            return false;
        }
    }
}
