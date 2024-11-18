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

class Message extends BaseController
{
    protected $session;
    protected $segment;
    protected $modeldb;

    function __construct()
    {
        $this->session = session();
        $this->segment = \CodeIgniter\Config\Services::uri();
        helper(['url', 'html', 'form', 'text', 'email', 'date', 'download', 'file', 'security', 'string']);

        $this->modeldb = new AppModel();
    }

    public function _remap($method, $param1 = null, $param2 = null, $param3 = null)
    {
        if (!session()->has('loggedIn')) {
            return redirect()->to(base_url() . '/secure/disconnect'); // redirect to login page if not connected
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
        $ecole = $this->session->schooluid;
        $data = [
            'title' => ucfirst(' Message | School Web Application'), // Capitalize the first letter
            'messages' => $this->modeldb->fetch_all_data('ts_messages', array('message_deleted_at' => null, 'message_ecole_uid' => $ecole), 'message_created_at'),
            '_view' => ('app/message/index')
        ];
        echo view('layouts/app', $data);
    }

    public function invitations()
    {
        $ecole = $this->session->schooluid;
        $data = [
            'title' => ucfirst(' Message | School Web Application'), // Capitalize the first letter
            'invitations' => $this->modeldb->fetch_join_invitations(array('message_type' => 'invitation', 'message_destinateur !=' => 'all','message_ecole_uid' => $ecole), null),
            '_view' => ('app/message/invitations')
        ];
        echo view('layouts/app', $data);
    }

    public function copyInvitation($reference_key)
    {
        $ecole = $this->session->schooluid;
        $data = [
            'title' => ucfirst(' Message | School Web Application'), // Capitalize the first letter
            'message' => $this->modeldb->fetch_join_invitations(array('message_uid' => $reference_key), 'row'),
            'parents' => $this->modeldb->fetch_all_data('ts_parents',
                array('parent_statut' => 'actif', 'parent_ecole_uid' => $ecole), 'parent_created_at'),
            '_view' => ('app/message/copy-invitation')
        ];
        echo view('layouts/app', $data);
    }
    public function details($reference_key, $type = null)
    {
        if ($type == 'invitation') {
            $data = [
                'title' => ucfirst(' Message | School Web Application'), // Capitalize the first letter
                'message' => $this->modeldb->fetch_join_invitations(array('message_uid' => $reference_key), 'row'),
                '_view' => ('app/message/details-invitation')
            ];
        } else {
            $data = [
                'title' => ucfirst(' Message | School Web Application'), // Capitalize the first letter
                'message' => $this->modeldb->fetch_row_data('ts_messages', array('message_uid' => $reference_key)),
                '_view' => ('app/message/details')
            ];
            //update etat message au passage de l'utilisateur
            $updateEtatMessage = [
                'message_etat' => 'lu',
            ];
            $this->modeldb->update_data('ts_messages', $updateEtatMessage, array('message_uid' => $reference_key));
        }
        echo view('layouts/app', $data);
    }

    public function compose()
    {
        //si annee est inactif, aucune creation n'est autorisee
        if ($this->session->yearstatus == 'inactif') {
            return redirect()->back()->with('info', "Année Fermée: La création n'est pas autorisée sur une année fermée");
        } else {
            $ecole = $this->session->schooluid;
            $data = [
                'title' => ucfirst('New Message | School Web Application'), // Capitalize the first letter
                'cycles' => $this->modeldb->fetch_all_data('ts_cycles', array('cycle_statut' => 'actif', 'cycle_ecole_uid' => $ecole), 'cycle_created_at'),
                'parents' => $this->modeldb->fetch_all_data('ts_parents',
                    array('parent_statut' => 'actif', 'parent_ecole_uid' => $ecole), 'parent_created_at'),
                '_view' => ('app/message/create')
            ];

            echo view('layouts/app', $data);
        }
    }

    public function createInvitation()
    {
        if ($this->request->getMethod() == "post"):
            $rulers = [
                'objet_message' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'titre obligatoire',
                    ]
                ],
                'contenu_message' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'contenu obligatoire',
                    ]
                ],
                'parent' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'parent obligatoire',
                    ]
                ],
            ];
            if ($this->validate($rulers)) {
                $contenu = $this->request->getPost('contenu_message');
                $object = trim(htmlspecialchars($this->request->getPost('objet_message')));
                $parent = trim(htmlspecialchars($this->request->getPost('parent')));
                $current_datetime = date('Y-m-d h:i:s');
                $ecole = $this->session->schooluid;
                $annee = $this->session->yearuid;
                $message_uid = $this->generateIdentifiant();
                //prepare data insert
                $data_new_message = array(
                    'message_uid' => $message_uid,
                    'message_objet' => $object,
                    'message_contenu' => $contenu,
                    'message_type' => 'invitation',
                    'message_statut' => 'actif',
                    'message_etat' => 'actif',
                    'message_destinateur' => $parent,
                    'message_created_at' => $current_datetime,
                    'message_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                    'message_annee_uid' => $annee,
                    'message_ecole_uid' => $ecole,
                );
                if ($this->modeldb->insert_data('ts_messages', $data_new_message)) {
                    /*send to one parent
                    if ($parent != 'all') {
                        //get parent infos
                        $infosparent = $this->modeldb->fetch_row_data('ts_parents', array('parent_uid' => $parent));
                        //send single email
                        $this->sendMail($this->session->schoolname, $infosparent['parent_tuteur_email'], $contenu, $object, null);
                    }*/
                    //return message
                    $this->session->setFlashdata('success', "Votre invitation a été envoyée avec succès. Félicitations !");
                    return redirect()->to(base_url('message/details/'.$message_uid.'/invitation'));
                } else {
                    $this->session->set('titlemsg', $object);
                    $this->session->set('bodymsg', $contenu);
                    $this->session->set('errormsg', 'sendfailed');
                }
            } else {
                //$this->session->setFlashdata('failed', "Votre message n'a pas été envoyée. Vérifiez les erreurs ci-dessous");
                return redirect()->back()->withInput();
            }
        else:
            //si annee est inactif, aucune creation n'est autorisee
            if ($this->session->yearstatus == 'inactif') {
                return redirect()->back()->with('info', "Année Fermée: La création n'est pas autorisée sur une année fermée");
            } else {
                $ecole = $this->session->schooluid;
                $annee = $this->session->yearuid;
                $data = [
                    'title' => ucfirst('New Message | School Web Application'), // Capitalize the first letter
                    'etudiants' => $this->modeldb->fetch_join_inscription(array('etudiant_ecole_uid' => $ecole,
                        'inscription_annee_uid' => $annee, 'ts_etudiants.etudiant_statut' => 'actif'), 'inscription_created_at'),
                    'parents' => $this->modeldb->fetch_all_data('ts_parents',
                        array('parent_statut' => 'actif', 'parent_ecole_uid' => $ecole), 'parent_created_at'),
                    '_view' => ('app/message/create-invitation')
                ];
                echo view('layouts/app', $data);
            }
        endif;
    }

    public function saveNewMessage()
    {
        //var_dump($this->request->getPost('sms'));
        //exit();

        $rulers = [
            'objet_message' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'objet obligatoire',
                ]
            ],
            'contenu_message' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'contenu message obligatoire',
                ]
            ], 'cycle_audience' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Cycle obligatoire',
                ]
            ], 'mode_envoie' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mode envoie obligatoire',
                ]
            ], 'degres_urgence' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Degres obligatoire',
                ]
            ], 'type_message' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'type_message obligatoire',
                ]
            ], 'parent' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'parent obligatoire',
                ]
            ],
        ];
        if ($this->validate($rulers)) {
            $contenu = $this->request->getPost('contenu_message');
            $object = trim(htmlspecialchars($this->request->getPost('objet_message')));
            $cycle = trim(htmlspecialchars($this->request->getPost('cycle_audience')));
            $mode_envoie = ($this->request->getPost('sms'))?"sms":'email';
            $degres_urgence = trim(htmlspecialchars($this->request->getPost('degres_urgence')));
            $type_message = trim(htmlspecialchars($this->request->getPost('type_message')));
            $parent = trim(htmlspecialchars($this->request->getPost('parent')));
            $current_datetime = date('Y-m-d h:i:s');
            $ecole = $this->session->schooluid;
            $annee = $this->session->yearuid;
            $newNameFileUpload = '';
            $fullPathFile = '';
            //if file exits
            if ($this->request->getFile('attache_message')) {
                $attachFile = $this->request->getFile('attache_message');
                //foreach($imagefile['images'] as $img){
                if ($attachFile->isValid() && !$attachFile->hasMoved()) {
                    //rename image
                    $newNameFileUpload = $attachFile->getRandomName();
                    $fullPathFile = 'global/uploads/files';
                    //move to upload directory
                    $attachFile->move(ROOTPATH . $fullPathFile, $newNameFileUpload);
                }
            }
            $filepathattachment = $fullPathFile . '/' . $newNameFileUpload;
            //prepare data insert
            $data_new_message = array(
                'message_uid' => $this->generateIdentifiant(),
                'message_objet' => $object,
                'message_contenu' => $contenu,
                'message_mode_envoie' => $mode_envoie,
                'message_degres' => $degres_urgence,
                'message_type' => $type_message,
                'message_statut' => 'actif',
                'message_etat' => 'nonlu',
                'message_destinateur' => ($parent == 'all') ? 'Tous les parents' : $parent,
                'message_cycle_uid' => $cycle,
                'message_attaches' => $filepathattachment,
                'message_created_at' => $current_datetime,
                'message_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                'message_annee_uid' => $annee,
                'message_ecole_uid' => $ecole,
            );
            #===========================================
            ##================== get All class ===================

            $allParents = $this->modeldb->fetch_all_data('ts_parents',
                array('parent_ecole_uid' => $ecole, 'parent_statut' => 'actif', 'parent_tuteur_email !=' => null), 'parent_created_at');

            //$this->displayResults($parents[0]['parent_email']);

            if ($this->modeldb->insert_data('ts_messages', $data_new_message)) {
                #===========================================
                #====[==============Send Email ===================

                //send to one parent
                if ($parent != 'all') {
                    //get parent infos
                    $infosparent = $this->modeldb->fetch_row_data('ts_parents', array('parent_uid' => $parent));
                    // send mobile message
                    if($mode_envoie == 'sms'){$this->sendSMS($infosparent['parent_phone_sms'], $object);}
                        
                    //send single email
                    $this->sendMail($this->session->schoolname, $infosparent['parent_tuteur_email'], $contenu, $object, $filepathattachment);

                    //send to all parents
                } elseif ($parent == 'all' && $cycle == 'all') {

                    foreach ($allParents as $parentValue) {
                        //list of all parents
                       // send mobile message
                    if($mode_envoie == 'sms'){$this->sendSMS($parentValue['parent_phone_sms'], $object);}

                        $this->sendMail($this->session->schoolname, $parentValue['parent_tuteur_email'], $contenu, $object, $filepathattachment);
                    }
                } else {
                    //check cycle
                    if ($cycle != 'all') {
                        $etudiantsCyclesSelected = $this->modeldb->fetch_join_inscription(
                            array('promotion_cycle_uid' => $cycle, 'etudiant_statut' => 'actif',
                                'inscription_ecole_uid' => $ecole, 'inscription_annee_uid' => $annee), 'inscription_created_at');
                        // send by cycle selected
                        foreach ($allParents as $parentCycle) {
                            foreach ($etudiantsCyclesSelected as $etudiantCycle) {
                                if ($etudiantCycle['etudiant_tuteur_uid'] == $parentCycle['parent_uid']) {
                                    //list of parents by cycle
                                    // send mobile message
                                    if($mode_envoie == 'sms'){$this->sendSMS($parentCycle['parent_phone_sms'], $object);}
                                    $this->sendMail($this->session->schoolname, $parentCycle['parent_tuteur_email'], $contenu, $object, $filepathattachment);
                                }
                            }

                        }
                    }
                }
                //return message
                $this->session->setFlashdata('success', "Votre message a été envoyée avec succès. Félicitations !");
                return redirect()->back();
            } else {
                $this->session->set('titlemsg', $object);
                $this->session->set('bodymsg', $contenu);
                $this->session->set('errormsg', 'sendfailed');
            }
        } else {
            //$this->session->setFlashdata('failed', "Votre message n'a pas été envoyée. Vérifiez les erreurs ci-dessous");
            return redirect()->back()->withInput();
        }
        return false;
    }

    public function sendSMS($phoneNumber, $content)
    {
        
        $basic  = new \Vonage\Client\Credentials\Basic("d5d09c3e", "M4m42Mb67rawgrh2");
        $client = new \Vonage\Client($basic);

        $response = $client->sms()->send(
            new \Vonage\SMS\Message\SMS("243858533285", "Ribambelle", $content)
        );
        
        $message = $response->current();
        if ($message->getStatus() == 0) {
           return true;
        } else {
            return false;
        }
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
            $mail->setFrom('noreply-eduschool@ditotase.com', 'Eduschool Application');
            $mail->addAddress($from, '');
            //$mail->addReplyTo($emailEcole, 'Ecole - '.$ecole);
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
            if (!empty($attachment))
                $mail->addAttachment($attachment, 'Piece Jointe');    // Optional name//Recipients
            $mail->Body =
                '<html>
                    <body style="font-size:14px; color:#666666;">
                            <h1>' . $subject . ' </h1>
                            <hr>
                            <p> Bonjour cher parent  </p>
                            <p> Voici votre resumé du communiqué envoyé par le gestionnaire de <strong>' . $ecole . '</strong>  le ' . date("d-m-Y H:i:s") . ' </p>
                            
                            <br/>
                            <p> Vous pouvez suivre le lien ci-après pour voir le message en entierté <br/><br/><br/>
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
                                 Consulter le message </a>
                            </p>
                      </body>
                      </html>';
            //check if the message has been send
            if ($mail->send()) {
                return true;
            }
        } catch (Exception $e) {
            return false;
        }
        return true;
    }
}
