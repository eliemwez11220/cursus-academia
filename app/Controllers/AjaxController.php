<?php

namespace App\Controllers;

use CodeIgniter\Controller;
//import Models
use App\Models\AppModel;

class AjaxController extends BaseController
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
	public function index()
	{
	    $this->students();
	}
	public function students($etudiantuid)
	{
		$ecole = $this->session->schooluid;   # GET SCHOOL ID
        $annee  = $this->session->yearuid;
        if (!empty($etudiantuid)) {

	   	$data = $this->modeldb->fetch_join_inscription(array('ts_etudiants.etudiant_uid' =>$etudiantuid, 'etudiant_ecole_uid' => $ecole, 'inscription_annee_uid' => $annee), 'inscription_date', 'row');
		   $promotion = $data['promotion_libelle']. ' - '.$data['cycle_libelle'];
 $this->session->set('etudiant',$etudiantuid);
 $this->session->set('etudiantmatricule',$data['etudiant_matricule']);
 $this->session->set('etudiantpromotion',$promotion);
 $this->session->set('etudiantpromotionuid',$data['promotion_uid']);
 $this->session->set('etudiantpromotioncycle',$data['promotion_cycle_uid']);

	   	echo json_encode($data);

        }
	   //return json_encode(['success'=>'success', 'csrf'=>csrf_hash(), 'query'=>$queryetudiantUID]);
	}

	public function frais($fraisuid)
	{
		$ecole = $this->session->schooluid;   # GET SCHOOL ID
        $annee  = $this->session->yearuid;
        if (!empty($fraisuid)) {
		   $data = $this->modeldb->fetch_join_typesfrais(array('ts_typesfrais.typesfrai_uid' => $fraisuid, 'typesfrai_annee_uid' => $annee, 'typesfrai_ecole_uid'=>$ecole), 'typesfrai_created_at', 'row');
		   echo json_encode($data);
        }
	}
	public function cotationenseignant($critererefuid)
	{
		$ecole = $this->session->schooluid;   # GET SCHOOL ID

        if (!empty($critererefuid)) {
	   		$data = $this->modeldb->fetch_join_evaluations(array('critere_uid' => $critererefuid, 'cotation_ecole_uid' => $ecole), 'cotation_created_at', 'row');
	   		echo json_encode($data);
        }
	}
	public function cotesEnseignant($agentuid, $critereuid,$peruid)
	{
        if (!empty($critereuid) && !empty($agentuid) && !empty($peruid)) {
	   		$data = $this->modeldb->fetch_join_evaluations(array('critere_uid' => $critereuid, 'agent_uid' => $agentuid, 'periode_uid' => $peruid), 'cotation_created_at', 'row');
	   		echo json_encode($data);
        }
	}
}
