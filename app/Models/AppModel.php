<?php

namespace App\Models;

use CodeIgniter\Model;

class AppModel extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function fetch_orWhere_data($table, $where = array(), $orwhere = array())
    {
        $builder = $this->db->table($table);
        $builder->select('*');
        $builder->where($where);
        $builder->orWhere($orwhere);
        $result = $builder->get();
        if (count($result->getResult()) > 0) {
            return $result->getRowArray();
        } else {
            return false;
        }
    }

  
    public function insert_transaction(array $table, array $data)
    {
        $this->db->transStart();
        for ($i = 1; $i <= count($table); $i++) {
            for ($j = 1; $j <= count($data); $j++) {
                $this->db->table($table[$i])->insert($data[$j]);
            }
        }
        $this->db->transComplete();
        if ($this->db->transStatus() === FALSE) {
            return false;
        }
        return true;
    }

    public function insert_inscription($dataTableetudiant, $dataTableInscription)
    {
        $this->db->transStart();
        $this->db->table('ts_etudiants')->insert($dataTableetudiant);
        $this->db->table('ts_inscriptions')->insert($dataTableInscription);
        $this->db->transComplete();
        if ($this->db->transStatus() === FALSE) {
            return false;
        }
        return true;
    }

    public function save_data($table, $data)
    {

        $this->db->table($table)->insert($data);
        return $this->db->insertID();
    }

    public function insert_data($table, $data)
    {
        $this->db->escape($data);
        if ($this->db->table($table)->insert($data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function insert_batch($table, $data)
    {
        if ($this->db->table($table)->insertBatch($data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function update_data($table, $data, $where)
    {
        return $this->db->table($table)->update($data, $where);
    }

    public function update_batch($table, $data, $where)
    {
        return $this->db->table($table)->updateBatch($data, $where);
    }

    public function delete_data($table, $where = [])
    {
        return $this->db->table($table)->delete($where);
    }

    public function delete_batch($table, $where = [])
    {
        return $this->db->table($table)->delete($where);
    }

    public function fetch_count($table, $where = array(), $groupBy = null)
    {
        //return $this->db->where($where)->count_all_results($table);
        //return $this->db->table($table)->selectCount($where);
        $builder = $this->db->table($table);
        if (!empty($groupBy)) {
            $builder->groupBy($groupBy);
        }
        $builder->where($where);
        $result = $builder->countAllResults();
        return $result;
    }

    public function fetch_count_students($where = array(), $groupby = null)
    {
        $builder = $this->db->table('ts_inscriptions');
        $builder->select('*');
        $builder->where($where);
        
        $builder->join('ts_etudiants', 'ts_etudiants.etudiant_uid = ts_inscriptions.inscription_etudiant_uid'); //join etudiants
        $builder->join('ts_promotions', 'ts_promotions.promotion_uid = ts_inscriptions.inscription_promotion_uid'); //join promotions
        $builder->join('ts_annees', 'ts_annees.annee_uid = ts_inscriptions.inscription_annee_uid'); //join annees
        //$builder->join('ts_parents', 'ts_parents.parent_uid = ts_etudiants.etudiant_tuteur_uid'); //join tuteur
        //$builder->join('ts_cycles', 'ts_cycles.cycle_uid = ts_promotions.promotion_cycle_uid'); //join table
        
        if (!empty($groupBy)) {
            $builder->groupBy($groupBy);
        }
        $builder->where($where);
        $result = $builder->countAllResults();
        return $result;
    }
    public function fetch_field_value($table, $where = array())
    {
        return $this->db->table($table)->getWhere($where)->getRow();
    }

    public function fetch_row_data($table, $where = array())
    {
        $builder = $this->db->table($table);
        $builder->select('*');
        $builder->where($where);
        $result = $builder->get();
        if (count($result->getResult()) > 0) {
            return $result->getRowArray();
        } else {
            return false;
        }
    }

    public function fetch_all_data($table, $where = array(), 
    $order_by_field = '', $limit = null, $offset = null, $order_type = null, $groupbyField = null)
    {
        $mode_order_data = (!empty($order_type)) ? $order_type : 'DESC';
        $builder = $this->db->table($table);
        $builder->select('*');
        $builder->orderBy($order_by_field, $mode_order_data);
        $builder->where($where);
        if (!empty($groupbyField)) {
            $builder->groupBy($groupbyField);
        }
        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if (count($result->getResult()) > 0) {
            return $result->getResultArray();
        } else {
            return false;
        }
    }

    public function fetch_distinct($table, $where = array(), $order_by_field = null, $limit = null, $offset = null)
    {
        $builder = $this->db->table($table);
        if (!empty($limit)) {
            $builder->limit($limit, $offset);
        }
        $builder->distinct();
        $builder->select('*');
        $builder->orderBy($order_by_field, 'DESC');
        $builder->where($where);
        $result = $builder->get();
        if (count($result->getResultArray()) > 0) {
            return $result->getResultArray();
        } else {
            return false;
        }
    }


    /**
     * @param array $where - select conditions
     * @param string $order_by_field - field to order
     * @param null $mode
     * @param array $limit - limit record selection
     * @param array $offset - offset of limit
     * @return array|bool return data or false if no record
     */
    public function fetch_join_ecoles($where = array(), $order_by_field = '', $mode = null, $limit = array(), $offset = array())
    {
        $builder = $this->db->table('ts_ecoles');
        $builder->select('*');
        $builder->where($where);
        $builder->orderBy($order_by_field, 'DESC');

        $builder->join('ts_typesecoles', 'ts_typesecoles.typesecole_uid = ts_ecoles.typesecole_uid'); //join table
        $builder->join('ts_typesenseignements', 'ts_typesenseignements.typesens_uid = ts_ecoles.typesens_uid'); //join table
        $builder->join('ts_coordinations', 'ts_coordinations.coordination_uid = ts_ecoles.ecole_coordination'); //join table

        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($mode == 'row') {
            if (count($result->getRowArray()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResultArray()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }

    public function fetch_join_promotions($where = array(), $order_by_field = '', $mode = null, $typeOrder = 'DESC', $limit = array(), $offset = array())
    {
        $builder = $this->db->table('ts_promotions');
        $builder->select('*');
        $builder->where($where);
        $builder->orderBy($order_by_field, $typeOrder);

        $builder->join('ts_degrespromotions', 'ts_degrespromotions.degres_uid = ts_promotions.promotion_degres_uid'); //join table
        $builder->join('ts_cycles', 'ts_cycles.cycle_uid = ts_promotions.promotion_cycle_uid'); //join table
        $builder->join('ts_filieres', 'ts_filieres.filiere_uid = ts_promotions.promotion_filiere_uid'); //join table

        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($mode == 'row') {
            if (count($result->getRowArray()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResultArray()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }

    public function fetch_join_inscription($where = array(), $order_by_field = '', $line = null, $groupby = null, $limit = array(), $offset = array(), $modeOrder = "DESC")
    {
        $builder = $this->db->table('ts_inscriptions');
        $builder->select('*');
        $builder->where($where);
        $builder->orderBy($order_by_field, $modeOrder);
        if (!empty($groupby)) {
            $builder->groupBy($groupby);
        }
        $builder->join('ts_etudiants', 'ts_etudiants.etudiant_uid = ts_inscriptions.inscription_etudiant_uid'); //join etudiants
        $builder->join('ts_promotions', 'ts_promotions.promotion_uid = ts_inscriptions.inscription_promotion_uid'); //join promotions
        $builder->join('ts_annees', 'ts_annees.annee_uid = ts_inscriptions.inscription_annee_uid'); //join annees
        //$builder->join('ts_parents', 'ts_parents.parent_uid = ts_etudiants.etudiant_tuteur_uid'); //join tuteur
        $builder->join('ts_cycles', 'ts_cycles.cycle_uid = ts_promotions.promotion_cycle_uid'); //join table
        $builder->join('ts_filieres', 'ts_filieres.filiere_uid = ts_promotions.promotion_filiere_uid'); //join table

        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($line == 'row') {
            if (count($result->getRowArray()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResultArray()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }

    public function fetch_join_etudiants($where = array(), $order_by_field = '', $mode = null, $limit = array(), $offset = array())
    {
        $builder = $this->db->table('ts_etudiants');
        $builder->select('*');
        $builder->where($where);
        $builder->orderBy($order_by_field, 'DESC');

        //$builder->join('ts_parents', 'ts_parents.parent_uid = ts_etudiants.etudiant_tuteur_uid'); //join tuteur
        //$builder->join('ts_parents', 'ts_parents.parent_uid = ts_etudiants.etudiant_pere_uid'); //join tuteur
        //$builder->join('ts_parents', 'ts_parents.parent_uid = ts_etudiants.etudiant_mere_uid'); //join tuteur
        $builder->join('ts_typesetudiants', 'ts_typesetudiants.typesetudiant_uid = ts_etudiants.etudiant_type_uid'); //join categorie

        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($mode == 'row') {
            if (count($result->getRowArray()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResultArray()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }
    public function fetch_join_agents($where = array(), $order_by_field = '', $mode = null, $limit = array(), $offset = array())
    {
        $builder = $this->db->table('ts_agents');
        $builder->select('*');
        $builder->where($where);
        $builder->orderBy($order_by_field, 'DESC');

        $builder->join('ts_fonctions_agents', 'ts_fonctions_agents.fonction_uid = ts_agents.agent_fonction_uid'); //join fonction
        $builder->join('ts_grades_agents', 'ts_grades_agents.grade_uid = ts_agents.agent_grade_uid'); //join grade
        $builder->join('ts_secteurs', 'ts_secteurs.secteur_uid = ts_agents.agent_secteur_uid'); //join grade

        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($mode == 'row') {
            if (count($result->getRowArray()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResultArray()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }

    public function fetch_join_taches($where = array(), $order_by_field = '', $mode = null, $limit = array(), $offset = array())
    {
        $builder = $this->db->table('ts_taches');
        $builder->select('*');
        $builder->where($where);
        $builder->orderBy($order_by_field, 'DESC');

        $builder->join('ts_agents', 'ts_agents.agent_uid = ts_taches.tache_agent_uid'); //join agent
        $builder->join('ts_typestaches', 'ts_typestaches.typestache_uid = ts_taches.tache_type_uid'); //join type

        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($mode == 'row') {
            if (count($result->getRowArray()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResultArray()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }

    public function fetch_join_evaluations($where = array(), $order_by_field = '', $mode = null, $limit = array(), $offset = array())
    {
        $builder = $this->db->table('ts_cotations_agents');
        $builder->select('*');
        $builder->where($where);
        $builder->orderBy($order_by_field, 'DESC');

        $builder->join('ts_agents', 'ts_agents.agent_uid = ts_cotations_agents.cotation_agent_uid'); //join agent
        $builder->join('ts_criteres_agents', 'ts_criteres_agents.critere_uid = ts_cotations_agents.cotation_critere_uid'); //join critere
        $builder->join('ts_periodes', 'ts_periodes.periode_uid = ts_cotations_agents.cotation_periode_uid'); //join critere

        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($mode == 'row') {
            if (count($result->getRowArray()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResultArray()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }

    public function fetch_join_matieres($where = array(), $order_by_field = '', $mode = null, $limit = array(), $offset = array())
    {
        $builder = $this->db->table('ts_matieres');
        $builder->select('*');
        $builder->where($where);
        $builder->orderBy($order_by_field, 'DESC');

        $builder->join('ts_agents', 'ts_agents.agent_uid = ts_matieres.matiere_agent_uid'); //join agent
        $builder->join('ts_promotions', 'ts_promotions.promotion_uid = ts_matieres.matiere_promotion_uid'); //join critere
        $builder->join('ts_branches', 'ts_branches.branche_uid = ts_matieres.matiere_branche_uid'); //join critere
        //$builder->join('ts_maximas', 'ts_maximas.maxima_uid = ts_matieres.matiere_maxima_uid'); //join critere

        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($mode == 'row') {
            if (count($result->getRowArray()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResultArray()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }

    public function fetch_join_epreuves($where = array(), $order_by_field = '', $mode = null, $limit = array(), $offset = array())
    {
        $builder = $this->db->table('ts_epreuves');
        $builder->select('*');
        $builder->where($where);
        $builder->orderBy($order_by_field, 'DESC');

        $builder->join('ts_typesepreuves', 'ts_typesepreuves.typesepreuve_uid = ts_epreuves.epreuve_type_uid'); //join critere
        $builder->join('ts_branches', 'ts_branches.branche_uid = ts_epreuves.epreuve_branche_uid'); //join critere
        $builder->join('ts_periodes', 'ts_periodes.periode_uid = ts_epreuves.epreuve_periode_uid'); //join critere

        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($mode == 'row') {
            if (count($result->getRowArray()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResultArray()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }

    public function fetch_join_cotes($where = array(), $order_by_field = '', $mode = null, $limit = array(), $offset = array())
    {
        $builder = $this->db->table('ts_cotes');
        $builder->select('*');
        $builder->where($where);
        $builder->orderBy($order_by_field, 'ASC');

        $builder->join('ts_etudiants', 'ts_etudiants.etudiant_uid = ts_cotes.cote_etudiant_uid');
        $builder->join('ts_matieres', 'ts_matieres.matiere_uid = ts_cotes.cote_matiere_uid'); //join annees
        $builder->join('ts_periodes', 'ts_periodes.periode_uid = ts_cotes.cote_periode_uid'); //join critere
        $builder->join('ts_branches', 'ts_branches.branche_uid = ts_matieres.matiere_branche_uid'); //join critere

        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($mode == 'row') {
            if (count($result->getResult()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResult()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }

    public function fetch_join_travaux($where = array(), $order_by_field = '', $mode = null, $limit = array(), $offset = array())
    {
        $builder = $this->db->table('ts_travaux');
        $builder->select('*');
        $builder->where($where);
        $builder->orderBy($order_by_field, 'DESC');

        $builder->join('ts_etudiants', 'ts_etudiants.etudiant_uid = ts_travaux.travaux_etudiant_uid'); //join etudiants
        $builder->join('ts_exercices', 'ts_exercices.exercice_uid = ts_travaux.travaux_exercice_uid'); //join annees

        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($mode == 'row') {
            if (count($result->getRowArray()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResultArray()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }

    public function fetch_join_notes($where = array(), $order_by_field = '', $mode = null, $limit = array(), $offset = array())
    {
        $builder = $this->db->table('ts_notes');
        $builder->select('*');
        $builder->where($where);
        $builder->orderBy($order_by_field, 'DESC');

        $builder->join('ts_branches', 'ts_branches.branche_uid = ts_notes.note_branche_uid'); //join etudiants
        $builder->join('ts_promotions', 'ts_promotions.promotion_uid = ts_notes.note_promotion_uid'); //join promotions
        $builder->join('ts_agents', 'ts_agents.agent_uid = ts_notes.note_enseignant_uid'); //join annees

        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($mode == 'row') {
            if (count($result->getRowArray()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResultArray()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }

    public function fetch_join_exercices($where = array(), $order_by_field = '', $mode = null, $limit = array(), $offset = array())
    {
        $builder = $this->db->table('ts_exercices');
        $builder->select('*');
        $builder->where($where);
        $builder->orderBy($order_by_field, 'DESC');

        $builder->join('ts_notes', 'ts_notes.note_uid = ts_exercices.exercice_note_uid'); //join note

        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($mode == 'row') {
            if (count($result->getRowArray()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResultArray()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }


    public function fetch_join_resultats($where = array(), $order_by_field = '', $mode = null, $limit = array(), $offset = array(), $typeOrder = '')
    {
        $builder = $this->db->table('ts_resultats');
        $builder->select('*');
        $builder->where($where);
        $builder->orderBy($order_by_field, $typeOrder);

        $builder->join('ts_etudiants', 'ts_etudiants.etudiant_uid = ts_resultats.resultat_etudiant_uid'); //join etudiants
        $builder->join('ts_promotions', 'ts_promotions.promotion_uid = ts_resultats.resultat_promotion_uid'); //join promotions

        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($mode == 'row') {
            if (count($result->getRowArray()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResultArray()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }

    public function fetch_join_comptes($where = array(), $order_by_field = '', $mode = null, $limit = array(), $offset = array())
    {
        $builder = $this->db->table('ts_comptes');
        $builder->select('*');
        $builder->where($where);
        $builder->orderBy($order_by_field, 'DESC');

        $builder->join('ts_agents', 'ts_agents.agent_uid = ts_comptes.compte_agent_uid'); //join agent
        $builder->join('ts_groupes', 'ts_groupes.groupe_uid = ts_comptes.compte_groupe_uid'); //join agent

        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($mode == 'row') {
            if (count($result->getRowArray()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResultArray()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }

    public function fetch_join_privileges($where = array(), $order_by_field = '', $mode = null, $limit = array(), $offset = array())
    {
        $builder = $this->db->table('ts_privileges');
        $builder->select('*');
        $builder->where($where);
        $builder->orderBy($order_by_field, 'ASC');

        $builder->join('ts_acces', 'ts_acces.acces_uid = ts_privileges.privilege_acces_uid'); //join agent
        $builder->join('ts_groupes', 'ts_groupes.groupe_uid = ts_privileges.privilege_groupe_uid'); //join agent

        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($mode == 'row') {
            if (count($result->getResult()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResult()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }

    public function fetch_status_data($viewTables, $where = array(), $group_by_field = '', $mode = null, 
    $limit = null, $offset = null, $orderFiled = '', $orderType = '', $filterField = '', $startdate=null, $enddate=null)
    {
        $builder = $this->db->table($viewTables);
        //$builder->distinct();
        $builder->select('*');
        $builder->orderBy($orderFiled, $orderType);
        $builder->where($where);
        $builder->groupBy($group_by_field);

        if (!empty($filterField)) {
            $builder->where("`$filterField` BETWEEN '$startdate' AND '$enddate'");
        }

        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($mode == 'row') {
            if (count($result->getRowArray()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResultArray()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }

    public function fetch_dashboard_data($table, $where = array(), $dateFiled = null, $year = null)
    {
        $builder = $this->db->table($table);
        $query = array();
        for ($i = 1; $i <= 12; $i++) {
            # code...
            $builder->select('*');
            $builder->where($where);
            $builder->where('MONTH(' . $dateFiled . ')', $i);
            $builder->where('YEAR(' . $dateFiled . ')', $year);
            $query[$i] = $builder->get();
        }
        return $query;
    }

    public function fetch_statistics_payments($where = array(), $dateFiled = null, $year = null)
    {
        $builder = $this->db->table('ts_detailspayments');

        $query = array();
        for ($i = 1; $i <= 12; $i++) {
            $builder->select('*');
            $builder->where($where);
            $builder->where('MONTH(' . $dateFiled . ')', $i);
            $builder->where('YEAR(' . $dateFiled . ')', $year);

            $builder->join('ts_typesfrais', 'ts_typesfrais.typesfrai_uid = ts_detailspayments.payment_frais_uid');
            $query[$i] = $builder->get();
        }
        return $query;
    }


    public function fetch_sum_data($table, $where = array(), $field_sum_data = null, $monnaie = null)
    {
        $builder = $this->db->table($table);
        $builder->select($field_sum_data, $monnaie);
        $builder->where($where);
        $builder->selectSum($field_sum_data);
        $result = $builder->get();

        if (count($result->getResult()) > 0) {
            return $result->getRowArray();
        } else {
            return false;
        }
    }

    public function fetchMaximaBulletin($where = array())
    {
        $builder = $this->db->table('ts_matieres');
        $builder->distinct();
        $builder->select('matiere_max_periode');
        $builder->where($where);
        $builder->orderBy('matiere_uid', 'ASC');
        //$builder->groupBy('matiere_uid');

        $builder->join('ts_agents', 'ts_agents.agent_uid = ts_matieres.matiere_agent_uid'); //join agent
        $builder->join('ts_promotions', 'ts_promotions.promotion_uid = ts_matieres.matiere_promotion_uid'); //join critere
        $builder->join('ts_branches', 'ts_branches.branche_uid = ts_matieres.matiere_branche_uid'); //join critere

        $result = $builder->get();

        if (count($result->getResult()) > 0) {
            return $result->getResult();
        } else {
            return false;
        }
    }

    public function fetch_cotes_bulletin($where = array(), $order_by_field = '', $order_type = null)
    {
        $mode_order_data = (!empty($order_type)) ? $order_type : 'DESC';
        $builder = $this->db->table('ts_bulletins');
        $builder->select('*');
        $builder->orderBy($order_by_field, $mode_order_data);
        $builder->where($where);

        $builder->join('ts_etudiants', 'ts_etudiants.etudiant_uid = ts_bulletins.bulletin_etudiant_uid'); //join etudiant

        $builder->join('ts_promotions', 'ts_promotions.promotion_uid = ts_bulletins.bulletin_promotion_uid'); //join promotion

        $builder->join('ts_matieres', 'ts_matieres.matiere_uid = ts_bulletins.bulletin_matiere_uid'); //join matiere

        $builder->join('ts_branches', 'ts_branches.branche_uid = ts_matieres.matiere_branche_uid'); //join critere
        //$builder->join('ts_maximas', 'ts_maximas.maxima_uid = ts_matieres.matiere_maxima_uid'); //join critere

        $result = $builder->get();
        if (count($result->getResult()) > 0) {
            return $result->getResultArray();
        } else {
            return false;
        }
    }

    public function fetch_join_detailspayments($where = array(), $order_by_field = '', $mode = null, $typeOrder = '', $limit = array(), $offset = array())
    {
        $orderRedors = (!empty($typeOrder)) ? $typeOrder : 'DESC';
        $builder = $this->db->table('ts_detailspayments');
        $builder->select('*');
        $builder->where($where);
        $builder->orderBy($order_by_field, $orderRedors);

        $builder->join('ts_typesfrais', 'ts_typesfrais.typesfrai_uid = ts_detailspayments.payment_frais_uid');
        $builder->join('ts_entetespayments', 'ts_entetespayments.recu_numero_uid = ts_detailspayments.payment_recu_numero');

        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($mode == 'row') {
            if (count($result->getRowArray()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResultArray()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }

    public function fetch_join_entetespayments($where = array(), $order_by_field = '', $mode = null, $typeOrder = '', $limit = array(), $offset = array())
    {
        $orderRedors = (!empty($typeOrder)) ? $typeOrder : 'DESC';
        $builder = $this->db->table('ts_entetespayments');
        $builder->select('*');
        $builder->where($where);
        $builder->orderBy($order_by_field, $orderRedors);

        $builder->join('ts_caisses', 'ts_caisses.caisse_uid = ts_entetespayments.recu_caisse_uid'); //join caisse
        $builder->join('ts_etudiants', 'ts_etudiants.etudiant_uid = ts_entetespayments.recu_etudiant_uid'); //join etudiants
        $builder->join('ts_promotions', 'ts_promotions.promotion_uid = ts_entetespayments.recu_promotion_uid'); //join promotion

        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($mode == 'row') {
            if (count($result->getRowArray()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResultArray()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }

    public function fetch_join_maximas($where = array(), $order_by_field = '', $mode = null, $typeOrder = '', $limit = array(), $offset = array())
    {
        $orderRedors = (!empty($typeOrder)) ? $typeOrder : 'DESC';
        $builder = $this->db->table('ts_maximas');
        $builder->select('*');
        $builder->where($where);
        $builder->orderBy($order_by_field, $orderRedors);

        $builder->join('ts_cycles', 'ts_cycles.cycle_uid = ts_maximas.maxima_cycle_uid'); //join caisse

        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($mode == 'row') {
            if (count($result->getRowArray()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResultArray()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }

    public function fetch_join_invitations($where = array(), $mode= 'all', $limit = array(), $offset = array())
    {
        $builder = $this->db->table('ts_messages');
        $builder->select('*');
        $builder->where($where);
        $builder->orderBy('message_created_at', 'DESC');

        $builder->join('ts_parents', 'ts_parents.parent_uid = ts_messages.message_destinateur'); //join parent

        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($mode == 'row') {
            if (count($result->getRowArray()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResultArray()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }

    //GET PAYMENTS REPORTING
    public function fetch_report_versments($where = array(), $selectFields='', $orderFiled = '', $typeOrder = '',
     $group_by_field = '', $modeRow = FALSE, $filterField = '', $startdate=null, $enddate=null)
    {
        $orderRedors = (!empty($typeOrder)) ? $typeOrder : 'DESC';
        $selectFieldsQuery = (!empty($selectFields)) ? $selectFields : '*';

        $builder = $this->db->table('ts_detailspayments', 'ts_inscriptions');
        $builder->select($selectFieldsQuery);
        $builder->where($where);
        $builder->orderBy($orderFiled, $orderRedors);
        $builder->join('ts_entetespayments', 'ts_entetespayments.recu_numero_uid = ts_detailspayments.payment_numero_recu'); //join annees
        $builder->join('ts_typesfrais', 'ts_typesfrais.typesfrai_uid = ts_detailspayments.payment_frais_uid');
        $builder->join('ts_inscriptions', 'ts_inscriptions.inscription_etudiant_uid= ts_entetespayments.recu_etudiant_uid'); //join etudiants
        
        //$builder->join('ts_inscriptions', 'ts_inscriptions.inscription_etudiant_uid = ts_etudiants.etudiant_uid'); //join etudiants
        $builder->join('ts_etudiants', 'ts_etudiants.etudiant_uid = ts_inscriptions.inscription_etudiant_uid');
        $builder->join('ts_promotions', 'ts_promotions.promotion_uid = ts_inscriptions.inscription_promotion_uid');

        //$builder->join('ts_promotions', 'ts_promotions.promotion_uid = ts_entetespayments.recu_promotion_uid'); //join annees
        $builder->join('ts_cycles', 'ts_cycles.cycle_uid = ts_promotions.promotion_cycle_uid'); //join caisse
        
        if (!empty($filterField)) {
            $builder->where("`$filterField` BETWEEN '$startdate' AND '$enddate'");
        }
        
        if (!empty($group_by_field)) {
            $builder->groupBy($group_by_field);
        } 
         
        $result = $builder->get();
        
        if ($modeRow == TRUE) {
            if (count($result->getRowArray()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResultArray()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }

    //GET PAYMENTS REPORTING
    public function fetch_report_payments($where = array(), $selectFields='', $orderFiled = '', $typeOrder = '',
     $group_by_field = '', $modeRow = FALSE, $filterField = '', $startdate=null, $enddate=null)
    {
        $orderRedors = (!empty($typeOrder)) ? $typeOrder : 'DESC';
        $selectFieldsQuery = (!empty($selectFields)) ? $selectFields : '*';

        $builder = $this->db->table('ts_detailspayments');
        $builder->select($selectFieldsQuery);
        $builder->where($where);
        $builder->orderBy($orderFiled, $orderRedors);
        $builder->join('ts_entetespayments', 'ts_entetespayments.recu_numero_uid = ts_detailspayments.payment_numero_recu'); //join annees
        $builder->join('ts_typesfrais', 'ts_typesfrais.typesfrai_uid = ts_detailspayments.payment_frais_uid');
        $builder->join('ts_inscriptions', 'ts_inscriptions.inscription_etudiant_uid = ts_entetespayments.recu_etudiant_uid'); //join etudiants
        $builder->join('ts_etudiants', 'ts_etudiants.etudiant_uid = ts_inscriptions.inscription_etudiant_uid');
        $builder->join('ts_promotions', 'ts_promotions.promotion_uid = ts_inscriptions.inscription_promotion_uid');

        //$builder->join('ts_promotions', 'ts_promotions.promotion_uid = ts_entetespayments.recu_promotion_uid'); //join annees
        $builder->join('ts_cycles', 'ts_cycles.cycle_uid = ts_promotions.promotion_cycle_uid'); //join caisse
        

        if (!empty($filterField)) {
            $builder->where("`$filterField` BETWEEN '$startdate' AND '$enddate'");
        }
        
        if (!empty($group_by_field)) {
            $builder->groupBy($group_by_field);
        } 
         
        $result = $builder->get();
        
        if ($modeRow == TRUE) {
            if (count($result->getRowArray()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResultArray()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }

    
    //GET PAYMENTS REPORTING
    public function fetch_minerval_payments($where = array(),  $orderFiled = '', $typeOrder = '',
     $group_by_field = '', $modeRow = FALSE, $filterField = '', $startdate=null, $enddate=null)
    {
        $orderRedors = (!empty($typeOrder)) ? $typeOrder : 'DESC';
        //etudiant_nom, etudiant_postnom, etudiant_prenom, etudiant_matricule, promotion_libelle, cycle_libelle, recu_etudiant_uid, etudiant_uid
        $selectFieldsQuery = "*, 
        MAX(IF(payment_mois_uid='janvier', payment_montant_paye, null)) AS janvier,
        MAX(IF(payment_mois_uid='fevrier', payment_montant_paye, null)) AS fevrier,
        MAX(IF(payment_mois_uid='mars', payment_montant_paye, null)) AS mars,
        MAX(IF(payment_mois_uid='avril', payment_montant_paye, null)) AS avril,
        MAX(IF(payment_mois_uid='mai', payment_montant_paye, null)) AS mai,
        MAX(IF(payment_mois_uid='juin', payment_montant_paye, null)) AS juin,
        MAX(IF(payment_mois_uid='juillet', payment_montant_paye, null)) AS juillet,
        MAX(IF(payment_mois_uid='aout', payment_montant_paye, null)) AS aout,
        MAX(IF(payment_mois_uid='septembre', payment_montant_paye, null)) AS septembre,
        MAX(IF(payment_mois_uid='octobre',payment_montant_paye, null)) AS octobre,
        MAX(IF(payment_mois_uid='novembre', payment_montant_paye, null)) AS novembre,
        MAX(IF(payment_mois_uid='decembre', payment_montant_paye, null)) AS decembre";

        $builder = $this->db->table('ts_detailspayments');
        $builder->select($selectFieldsQuery);
        $builder->where($where);
        $builder->orderBy($orderFiled, $orderRedors);
        $builder->join('ts_entetespayments', 'ts_entetespayments.recu_numero_uid = ts_detailspayments.payment_numero_recu'); //join annees
        $builder->join('ts_typesfrais', 'ts_typesfrais.typesfrai_uid = ts_detailspayments.payment_frais_uid');
        $builder->join('ts_inscriptions', 'ts_inscriptions.inscription_etudiant_uid = ts_entetespayments.recu_etudiant_uid'); //join etudiants
        $builder->join('ts_etudiants', 'ts_etudiants.etudiant_uid = ts_inscriptions.inscription_etudiant_uid');
        $builder->join('ts_promotions', 'ts_promotions.promotion_uid = ts_inscriptions.inscription_promotion_uid');

        //$builder->join('ts_promotions', 'ts_promotions.promotion_uid = ts_entetespayments.recu_promotion_uid'); //join annees
        $builder->join('ts_cycles', 'ts_cycles.cycle_uid = ts_promotions.promotion_cycle_uid'); //join caisse
        

        if (!empty($filterField)) {
            $builder->where("`$filterField` BETWEEN '$startdate' AND '$enddate'");
        }
        
        if (!empty($group_by_field)) {
            $builder->groupBy($group_by_field);
        } 
         
        $result = $builder->get();
        
        if ($modeRow == TRUE) {
            if (count($result->getRowArray()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResultArray()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }

    public function fetch_search_etudiant($where = array(), $like = null, $limit = null, $offset = null, $oneRow=FALSE)
    {
        $builder = $this->db->table('ts_inscriptions');
        $builder->select('*');
        $builder->where($where);
        if (!empty($like)) {
            $builder->like('etudiant_matricule', $like);
            $builder->orLike('etudiant_nom', $like);
            $builder->orLike('etudiant_postnom', $like);
            $builder->orLike('etudiant_prenom', $like);
            $builder->orLike('promotion_libelle', $like);
            $builder->orLike('cycle_libelle', $like);
        }

        $builder->orderBy('inscription_created_at', 'DESC');
        $builder->join('ts_etudiants', 'ts_etudiants.etudiant_uid = ts_inscriptions.inscription_etudiant_uid');
        $builder->join('ts_promotions', 'ts_promotions.promotion_uid = ts_inscriptions.inscription_promotion_uid'); //join annees
        $builder->join('ts_cycles', 'ts_cycles.cycle_uid = ts_promotions.promotion_cycle_uid'); //join caisse

        if (!empty($limit)) {
            $builder->limit($limit, $offset);
            $result = $builder->get($limit, $offset);
        } else {
            $result = $builder->get();
        }
        if ($oneRow == TRUE) {
            if (count($result->getResult()) > 0) {
                return $result->getRowArray();
            } else {
                return false;
            }
        } else {
            if (count($result->getResult()) > 0) {
                return $result->getResultArray();
            } else {
                return false;
            }
        }
    }
}