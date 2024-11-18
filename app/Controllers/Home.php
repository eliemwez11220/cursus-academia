<?php
/**
 * Created by PhpStorm.
 * User: ElieMwezRubuz
 * Date: 01-Mar-21
 * Time: 11:05 AM
 */

namespace App\Controllers;

use App\Models\AppModel;

class Home extends BaseController
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
        
   $annee = $this->session->yearuid;     #GET YEAR ID
        $ecole = $this->session->schooluid;   # GET SCHOOL ID
        $student = $this->session->usertoken;
        $promotion = $this->session->promotiontoken;

        $data['inscription'] = $this->modeldb->fetch_join_inscription(array('ts_etudiants.etudiant_uid' => $student), 'inscription_date', 'row');
                $data['promotion'] = $this->modeldb->fetch_join_promotions(array('ts_promotions.promotion_uid' => $promotion), 'promotion_created_at', 'row');
                $data['etudiant'] = $this->modeldb->fetch_join_etudiants(array('ts_etudiants.etudiant_uid' => $student), 'etudiant_created_at', 'row');
                $data['title'] = ucfirst("Accès étudiants"); // Capitalize the first letter
        $data['_view'] = ('etudiant/profil');
        echo view('layouts/tiers', $data);
    }
	public function resultats()
	{
        $annee = $this->session->yearuid;     #GET YEAR ID
        $ecole = $this->session->schooluid;   # GET SCHOOL ID
        $student = $this->session->usertoken;
        $promotion = $this->session->promotiontoken;
         
        $data['etudiants'] = $this->modeldb->fetch_join_inscription(
                        array('ts_etudiants.etudiant_uid' => $student, 'etudiant_ecole_uid' => $ecole,
                         'inscription_promotion_uid' => $promotion), 'inscription_created_at');

        $data['promotion'] = $this->modeldb->fetch_join_promotions(
                        array('ts_promotions.promotion_uid' => $promotion, 'promotion_ecole_uid' => $ecole), 
                        'promotion_created_at', 'row');

        $data['matieres'] = $this->modeldb->fetch_join_matieres(
                array('matiere_annee_uid' => $annee, 'promotion_uid' => $promotion), 
                'branche_libelle');

        $data['cotes'] = $this->modeldb->fetch_join_cotes( 
         array('cote_deleted_at' => null, 'cote_etudiant_uid' => $student, 'cote_annee_uid' => $annee, 
         'matiere_promotion_uid' => $promotion), 'branche_libelle');
        $data['promotions'] = $this->modeldb->fetch_join_promotions(
            array('ts_promotions.promotion_statut' =>'actif', 'promotion_ecole_uid' => $ecole), 
                        'promotion_created_at');
        $data['title'] = ucfirst("Résultats de déliberation"); // Capitalize the first letter
        $data['_view'] = ('etudiant/resultats');
        echo view('layouts/tiers', $data);
	}
}
