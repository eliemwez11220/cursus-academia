<?php
/**
 * Created by PhpStorm.
 * User: Congo Agile
 * Date: 22/07/2020
 * Time: 11:31
 */
defined('BASEPATH') OR exit('No direct script access allowed');

require_once ('PHPExcel/IOFactory.php');

class IOFactory extends PHPExcel_IOFactory {

    public function __construct()
    {
        //parent::__construct();
    }
}
?>