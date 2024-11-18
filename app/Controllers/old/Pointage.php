<?php
/**
 * Created by PhpStorm.
 * User: ElieMwezRubuz
 * Date: 01-Mar-21
 * Time: 11:05 AM
 */

namespace App\Controllers;

use App\Models\AppModel;

class Pointage extends BaseController
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
        $this->view('etudiants');
    }

    public function view($type = null)
    {
        $data = [];
        $promotion = ($this->request->getGet('clsPrc')) ? $this->request->getGet('clsPrc') : '';     #GET YEAR ID
        $ecole = $this->session->schooluid;   # GET SCHOOL ID
        $anneeScolaire = $this->session->yearuid; # GET YEAR LIBELLE
        $this->session->set('promotionpointage', $promotion);     # CHANGE YEAR LIBELLE VALUE USED ACTUALLY

        $date_pointage = ($this->request->getGet('dayof')) ? $this->request->getGet('dayof') : date('Y-m-d'); 

        if (!empty($promotion)) {
            $data['etudiants_pointages'] = $this->modeldb->fetch_join_inscription(array('ts_etudiants.etudiant_statut' => 'actif', 'etudiant_ecole_uid' => $ecole,
                'inscription_promotion_uid' => $promotion, 'inscription_annee_uid' => $anneeScolaire), 'inscription_date');
        }else{
            $data['presences'] = $this->modeldb->fetch_join_presences(array('ts_presences.presence_deleted_at' => null, 'ts_presences.presence_date' => $date_pointage, 'presence_ecole_uid'=>$ecole), 'presence_created_at'); 
        }

        switch ($type) {
            case 'etudiants':
                $data['promotionselected'] = (!empty($promotion)) ? $this->modeldb->fetch_join_promotions(array('ts_promotions.promotion_uid' => $promotion), 'promotion_created_at', 'row') : '';
                $data['promotions'] = $this->modeldb->fetch_join_promotions(array('ts_promotions.promotion_deleted_at' => null, 'promotion_ecole_uid'=>$ecole), 'promotion_created_at');

                $data['pointages'] = $this->modeldb->fetch_status_data('ts_presences', 
                    array('ts_presences.presence_deleted_at' => null, 'presence_ecole_uid'=>$ecole), 'presence_date');
                break;
            default:
                null;
        }

        //$this->displayResults($data['etudiants_pointages']);

        $data['title'] = ucfirst("Pointage - $type | School Web Application"); // Capitalize the first letter
        $data['_view'] = ('app/pointage/' . $type);
        echo view('layouts/app', $data);
    }

    function savePointageJournalier()
    {
//si annee est inactif, aucune creation n'est autorisee
        if($this->session->yearstatus == 'inactif'){
            return redirect()->back()->with('info', "Année Fermée: La création n'est pas autorisée sur une année fermée");
        }else{
        if ($this->request->getPost('etudiantIdentifiant') != '') {

            $date_jour = date('Y-m-d');
            $count = 1;
            $presence_random_uid = $this->generateIdentifiant();  
             //get promotion status affectation
            $promotion_uid = $this->request->getPost('promotion_pointage');
            $verifypromotionstatusPointage = $this->modeldb->fetch_row_data('ts_promotions', array('promotion_uid' => $promotion_uid));

            if ($verifypromotionstatusPointage['promotion_lastday_pointage'] != $date_jour) {
                # code...
            
            foreach ($this->request->getPost('etudiantIdentifiant') as $etudiant) {
               
                     $nouvellePresenceData = [
                    'presence_uid' => $presence_random_uid . 'PRS' . $count++,
                    'presence_etudiant_uid' => $etudiant,
                    'presence_promotion_uid' => $promotion_uid ,
                    'presence_annee_uid' => $this->session->yearuid,
                    'presence_date' => $date_jour,
                    'presence_type' => 'etudiant',
                    'presence_statut' => 'actif',
                    'presence_libelle' => $this->request->getPost('presence_libelle'),
                    'presence_created_at' => date('Y-m-d h:i:s'),
                    'presence_created_by' => $this->session->fullname . ' - ' . $this->session->role,
                    'presence_ecole_uid' => $this->session->schooluid,
                ];
                $this->modeldb->insert_data('ts_presences', $nouvellePresenceData);


                
            }
            $promotion_lastday_pointage = [
             'promotion_lastday_pointage' => $date_jour,
         ];
            //update promotion
                $this->modeldb->update_data('ts_promotions', $promotion_lastday_pointage, array('promotion_uid' => $promotion_uid));

            return redirect()->back()->with('success', "Pointage presence etudiants effectué avec succès");

            }else {
            return redirect()->back()->with('failed', "Le pointage d'aujourd'hui est deja effectué pour la promotion selectionnée");
        }
        } else {
            return redirect()->back()->with('failed', "Aucune donnee n'a été selectionnée");
        }
    }
    }
    function updatePointage($ref_uid)
    {
        //si annee est inactif, aucune creation n'est autorisee
        if($this->session->yearstatus == 'inactif'){
            return redirect()->back()->with('info', "Année Fermée: La modification n'est pas autorisée sur une année fermée");
        }else{
        if ($this->request->getPost('presence_libelle') != '') {

           $nouvellePresenceData = [
                     
                    'presence_libelle' => $this->request->getPost('presence_libelle'),
                    'presence_comment' => $this->request->getPost('presence_comment'),
                    'presence_updated_at' => date('Y-m-d h:i:s'),
                    'presence_updated_by' => $this->session->fullname . ' - ' . $this->session->role,
                ];
                if($this->modeldb->update_data('ts_presences', $nouvellePresenceData, array('presence_uid' => $ref_uid))){
                    return redirect()->back()->with('success', "Pointage presence etudiants modifié avec succès");
                }else {
            return redirect()->back()->with('failed', "Aucune donnee n'a été selectionnée");
        }
                
        } else {
            return redirect()->back()->with('failed', "Aucune donnee n'a été selectionnée");
        }
    }}
}
