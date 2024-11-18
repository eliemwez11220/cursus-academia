<?php 
	function display_validation_error($validation, $field){
        //$validation = \CodeIgniter\Config\Services::validation();
		if(isset($validation) && ! empty($validation))
		{
			if($validation->hasError($field)){
				echo $validation->getError($field);
            }
       }
       return false;
	}

	function currentPage($url, $page)
	{
		if ((!empty($page)) && (!empty($url))) {
			if ($url == $page) {
				echo 'current';
			}
		}
		return false;
	}
	
	function convertDateFormat($date, $type, $format)
	{
		$valueDate = "";
		if ($type == 'database') {
			$valueDate = date($format, strtotime(str_replace('/', '-', $date)));
		} else {
			$valueDate = utf8_encode(strftime($format, strtotime($date)));
		}
		return $valueDate;
	}
	
	function getTotalDays($start_date, $end_date, $type = null)
	{
		$date_end = (! empty($end_date))? $end_date: date('Y/m/d');
		//if ($start_date = $date_jr) {
		$d1 = new DateTime($start_date);
		$d2 = new DateTime($date_end);
		$diff = $d1->diff($d2, true);
		//
		$duree_annee = $diff->y;
		$duree_mois = $diff->m;
		$duree_jours = $diff->d;
		$total_annees = ($duree_annee * 12);
		$total_mois = ($duree_annee * 12) + $duree_mois;
		$total_jours = ($total_mois * 30) + $duree_jours;
		switch ($type) {
			case 'year':
				return $total_annees;
				break;
			case 'day':
				return $total_jours;
				break;
			default:
				return $total_mois;
				break;
		}
		//}
	}
	
	?>