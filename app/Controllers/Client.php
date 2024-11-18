<?php
/**
 * Created by PhpStorm.
 * User: ElieMwezRubuz
 * Date: 21-Jun-21
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

class Client extends BaseController
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
        } else {/**///

            if (method_exists($this, $method)) {
                return $this->$method($param1, $param2, $param3);
            } else {
                return $this->index();
            }
        }
    }

	public function index()
	{
	    $data['clients'] = $this->modeldb->fetch_all_data('ts_clients', array(), 'client_created_at');
        $data['title'] = ucfirst("clients | School Web Application"); // Capitalize the first letter
        $data['_view'] = ('clients/liste');
        echo view('layouts/app', $data);
	}

    public function compte()
    {
        $client_uid = session()->clienttoken;
        $data['client'] = $this->modeldb->fetch_row_data('ts_clients', array('client_uid' => $client_uid));
        
        $data['title'] = ucfirst("Client | Eduschool School Web Application"); // Capitalize the first letter
        $data['_view'] = ('clients/details');
        echo view('layouts/app', $data);
    }
    public function explorer($type, $key_uid)
    {
        $this->session->set('schooluid', $key_uid);

        $data['ecole'] = $this->modeldb->fetch_join_ecoles(array('ts_ecoles.ecole_uid' => $key_uid), 'ecole_created_at', 'row');

        $this->session->set('schoolname', $data['ecole']['ecole_libelle']);

        $data['title'] = ucfirst("clients | Explorer Ecole - School Web Application"); // Capitalize the first letter
        $data['_view'] = ('app/params/details/ecoles');
        echo view('layouts/app', $data);
    }
    public function details($client_uid = null)
    {
        $data['client'] = $this->modeldb->fetch_row_data('ts_clients', array('client_uid' => $client_uid));
        
        $data['title'] = ucfirst("Client | Eduschool School Web Application"); // Capitalize the first letter
        $data['_view'] = ('clients/details');
        echo view('layouts/app', $data);
    }
    public function update($client_uid = null)
    {
        $data['client'] = $this->modeldb->fetch_row_data('ts_clients', array('client_uid' => $client_uid));
        
        $data['title'] = ucfirst("Client | Eduschool School Web Application"); // Capitalize the first letter
        $data['_view'] = ('clients/update');
        echo view('layouts/app', $data);
    }

    public function saveAbonnement(){

        $email = trim(htmlspecialchars($this->request->getPost('email_client')));
                $name = trim(htmlspecialchars($this->request->getPost('nom_client')));
                $type = trim(htmlspecialchars($this->request->getPost('type_client')));
                $phone = trim(htmlspecialchars($this->request->getPost('phone_client')));

                $address = trim(htmlspecialchars($this->request->getPost('client_address')));
                $city = trim(htmlspecialchars($this->request->getPost('client_city')));
                $country = trim(htmlspecialchars($this->request->getPost('client_country')));
                $comment = trim(htmlspecialchars($this->request->getPost('client_comment')));
                $current_datetime = date('Y-m-d H:i:s');

        $updating = ($this->segment->getTotalSegments() >= 3) ? $this->segment->getSegment('3') : '';

        if ($updating == 'update') {
           $client_pk_reference = ($this->segment->getTotalSegments() >= 4) ? $this->segment->getSegment('4') : '';
                $saveClientDataUpdating = [
                        'client_name' => $name,
                        'client_type' => $type,
                        'client_email' => $email,
                        'client_phone' => $phone,
                        'client_address' => $address,
                        'client_city' => $city,
                        'client_country' => $country,
                        'client_comment' => $comment,
                        'client_updated_at' => $current_datetime,
                        'client_updated_by' => $this->session->fullname . ' - ' . $this->session->role,
                    ];
                
                    $saveAdminDataUpdating = [
                        'admin_fullname' => $name,
                        'admin_email' => $email,
                        'admin_created_at' => $current_datetime,
                    ];
                    if ($this->modeldb->update_data('ts_clients', $saveClientDataUpdating, array('client_uid' => $client_pk_reference))) {
                        //save admin account
                       $this->modeldb->update_data('ts_admins', $saveAdminDataUpdating, array('admin_client_uid' => $client_pk_reference));
                    return redirect()->back()->with('success', "Modificaton du Client: Opération effectuée avec succés");
                }
        }else{

                $client_pk_reference = $this->generateIdentifiant();
                $saveClientData = [
                        'client_uid' => $client_pk_reference,
                        'client_name' => $name,
                        'client_type' => $type,
                        'client_email' => $email,
                        'client_phone' => $phone,
                        'client_statut' => 'actif',
                        'client_created_at' => $current_datetime,
                        'client_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                    ];
                    $username = trim(htmlspecialchars($this->request->getPost('username')));
                $password = trim(htmlspecialchars($this->request->getPost('password')));
                
                $salt_options = array('cost' => 12);
                $new_password = password_hash($password, PASSWORD_BCRYPT, $salt_options);
            //table admin ecole data
                    $saveAdminData = [
                        'admin_uid' => $this->generateIdentifiant(),
                        'admin_pseudo' => $username,
                        'admin_fullname' => $name,
                        'admin_email' => $email,
                        'admin_password' => $new_password,
                        'admin_statut' => 'actif',
                        'admin_profile' => $type,
						'admin_type' => 'client',
                        'admin_created_at' => $current_datetime,
                        'admin_client_uid' => $client_pk_reference, //client uid
                    ];
                    if ($this->modeldb->insert_data('ts_clients', $saveClientData)) {
                        //send credentials to client 
                        $content = "Vos identifiants de connexion suite à votre abonnement à Eduschool Application. Identifiant ou Nom d'utilisateur : $username et le mot de passe est $password .";
                        $this->sendMailCredentials($email, $content, 'Vos identifiants de connexion');
                        //save admin account
                        $this->modeldb->insert_data('ts_admins', $saveAdminData);
                    return redirect()->back()->with('success', "Abonnement: Opération effectuée avec succés");
                }
        }   
    }
    public function sendMailCredentials($email, $content, $subject)
    {
        $userAgentData = $this->getUserAgentInfo();
        $lieu = $this->getClientLocation();
        $datetime = date('Y-m-d H:i:s');
        $username = (!empty($email)) ? $email : 'Anonyme';
        //$subject = $subject;
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
            $mail->addReplyTo('eduschool@ditotase.com', 'Eduschool Administration');
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
                            <h1>Abonnement  à Eduschool Web Application</h1>
                            <p>Bonjour cher ' . $username . '. Nous avons reçu une demande concernant
                                                        votre abonnement à notre application. En effet votre abonnement est mis en attente.</p>
                            <p>' . $content . '</p>
                            <p>Veuillez cliquer sur le lien ci-après pour confirmer votre inscription.</p>
                            <br/>
                            <br/>
                            <br/>
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
                                Où et quand cela a été envoyé : <br/>
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
