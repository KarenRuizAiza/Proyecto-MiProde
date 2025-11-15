<?php

namespace App\Controllers;

use Config\Services;


class Home extends BaseController
{
    public function index()
    {
        return view('template/header')
            . view('template/sidebar')
            . view('modules/home')
            . view('template/footer');
    }
}
