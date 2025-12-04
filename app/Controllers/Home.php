<?php

namespace App\Controllers;

use Config\Services;


class Home extends BaseController
{
    public function index()
    {
        $torneoModel = new \App\Models\TorneoModel();
        $partidoModel = new \App\Models\PartidoModel();

        $data = [
            'torneos' => $torneoModel->findAll(),
            'partidos' => $partidoModel->getPartidosPaginados(10), // 10 matches per page
            'pager' => $partidoModel->pager
        ];

        return view('template/header', $data)
            . view('modules/home', $data)
            . view('template/footer');
    }
}
