<?php
/**
 * Created by PhpStorm.
 * User: ElieMwezRubuz
 * Date: 27-Feb-21
 * Time: 10:08 AM
 */

namespace App\Controllers;

use App\Models\AppModel;

class Overview extends BaseController
{
    protected $session;
    protected $modeldb;

    function __construct()
    {
        $this->session = session();
        //load generic model
        $this->modeldb = new AppModel();
        helper(['url', 'html', 'form', 'text', 'email', 'date', 'download', 'file', 'security', 'string']);
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

    public function index(){

 //$this->displayResults(session()->AccessFolderObjects);
        $ecole = $this->session->get('schooluid');
        $annee = $this->session->get('yearuid');
        
        $annee_utilisee =  ($this->request->getGet('y')) ? $this->request->getGet('y') : date('Y');
        $data['filles'] = $this->modeldb->fetch_count_students(
            array('inscription_annee_uid'=>$annee,'etudiant_statut'=>'actif','etudiant_sexe'=>'feminin'));

        $data['garcons'] = $this->modeldb->fetch_count_students(
            array('inscription_annee_uid'=>$annee,'etudiant_statut'=>'actif','etudiant_sexe'=>'masculin'));

            //get number records
            $data['nb_etudiants'] = $this->modeldb->fetch_count_students(array('inscription_annee_uid'=>$annee, 
             'etudiant_statut'=>'actif'));
            $data['nb_agents'] = $this->modeldb->fetch_count('ts_agents', array('agent_statut'=>'actif'));
          
            $data['nb_users'] = $this->modeldb->fetch_count('ts_agents', array('agent_statut'=>'actif'));
            $data['nb_options'] = $this->modeldb->fetch_count('ts_filieres', array('filiere_statut'=>'actif'));
            $data['nb_promotions'] = $this->modeldb->fetch_count('ts_promotions', array('promotion_statut'=>'actif'));
            $data['filles'] = $this->modeldb->fetch_count_students(
            array('inscription_annee_uid'=>$annee,'etudiant_statut'=>'actif','etudiant_sexe'=>'feminin'));

        $data['garcons'] = $this->modeldb->fetch_count_students(
            array('inscription_annee_uid'=>$annee,'etudiant_statut'=>'actif','etudiant_sexe'=>'masculin'));


       $data['title'] = ucfirst('Tableau de bord');
        $data['_view'] = ('app/overview/home');
        echo view('layouts/app', $data);
    }

    public function type(){
        $this->index();
    }

    public function refreshAccess(){
        if ($this->session->role == 'sysadmin') {
            $this->setFlasdata('info', 'Vous avez tous les droits de tous les modules');
        }else{
             $AccessString = "";
                            $arrayObjects = "";
                            if (! empty($this->session->groupeuid)) {
                                # code...
                            
                               $infosAccessObjects = $this->modeldb->fetch_join_privileges(array('groupe_uid' => $this->session->groupeuid, 'privilege_status'=>'actif'), 'groupe_created_at');
                                if (! empty($infosAccessObjects)) {
                                    foreach ($infosAccessObjects as $AccesT) {
                                    $AccessString .= $AccesT['acces_objet'] . "|";
                                    $arrayObjects = explode('|', $AccessString);

                                    }
                                    $this->session->set('AccessFolderObject', $arrayObjects);
                                }
                            }
        }
       return redirect()->back()->withInput();                  
    }
    public function changeSchoolYear(){
        if ($this->request->getPost('year')) {
            $year = $this->request->getPost('year');
           
           $annee = $this->modeldb->fetch_row_data('ts_annees', array('annee_uid'=>$year));

           $this->session->set('yearuid', $year);
           $this->session->set('yearlibelle', $annee['annee_libelle']);
           $this->session->set('yearstatus', $annee['annee_statut']);

        }
    $data['annees'] = $this->modeldb->fetch_all_data('ts_annees', array(), 'annee_created_at');

    $data['title'] = ucfirst('Change | School Web Application');
    $data['_view'] = ('app/change_schoolyear');
    echo view('layouts/app', $data);
    }
    public function search()
    {
        $ecole = $this->session->get('schooluid');
        $annee = $this->session->get('yearuid');

            $query = $this->request->getPost('query');

            $data['etudiants'] = $this->modeldb->fetch_search_etudiant(
                array('etudiant_ecole_uid' => $ecole, 'inscription_annee_uid' => $annee), $query, 500, 0);
            $data['query'] = $query;

        $data['annees'] = $this->modeldb->fetch_all_data('ts_annees', array(), 'annee_created_at');
        $data['title'] = ucfirst('Recherche de ').$query;
        $data['_view'] = ('app/overview/search');
        echo view('layouts/app', $data);
    }
}
