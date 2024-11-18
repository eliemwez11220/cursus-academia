<?php
/**
 * Created by PhpStorm.
 * User: Congo Agile
 * Date: 22/07/2020
 * Time: 11:31
 */
defined('BASEPATH') OR exit('No direct script access allowed');

require_once ('PHPExcel.php');

class Excel extends PHPExcel{
    public function __construct()
    {
        parent::__construct();
    }
}
?>