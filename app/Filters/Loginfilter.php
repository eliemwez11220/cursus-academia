<?php namespace App\Filters;
/**
 * Created by PhpStorm.
 * User: ElieMwezRubuz
 * Date: 08-May-21
 * Time: 8:48 AM
 */

use \CodeIgniter\Http\RequestInterface;
use \CodeIgniter\Http\ResponseInterface;
use \CodeIgniter\Filters\FilterInterface;

class Loginfilter implements FilterInterface
{
    /**
     * @param RequestInterface $request
     * @param null $arguments
     * @return $this|bool|\Illuminate\Http\RedirectResponse|mixed
     */
    public function before(RequestInterface $request, $arguments = null){
        if (! session()->has('loggedIn')) {
            echo 'Disconnect';
            return redirect()->to(base_url().'/secure/disconnect');               // redirect to login page if not connected
        }
        //return false;
    }
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null){
        // TODO: Implement after() method.
    }
}