<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class LoggedAdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {

        if (session()->rol != 'Administrador' ) {
//            return redirect()->to(site_url('/'));
            return '';
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}