<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Errors extends BaseController
{
	public function index()
	{
	    $this->error404();
	}
	public function error404()
	{
	    $data['title'] = ucfirst('Error404 - Page not found'); // Capitalize the first letter
        $data['page'] = ucfirst('home'); // Capitalize the first letter
        $data['_view'] = 'errors/error404';
        echo view('layouts/main',$data);
	}
    
}
