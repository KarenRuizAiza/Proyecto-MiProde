<?php

namespace App\Controllers;

use Config\Services;


class Home extends BaseController
{
    public function index()
    {
        $sess = session();
        $id = $sess->get('id');
        $id_sess = $sess->session_id ?? 'no-id';
        file_put_contents(WRITEPATH . 'debug_session.log', date('Y-m-d H:i:s') . " - SessID: $id_sess - UserID: " . ($id ?? 'NULL') . "\n", FILE_APPEND);

        $torneoModel = new \App\Models\TorneoModel();
        $partidoModel = new \App\Models\PartidoModel();

        $data = [
            'torneos' => $torneoModel->findAll(),
            'partidos' => $partidoModel->getPartidosPaginados(10), // 10 matches per page
            'pager' => $partidoModel->pager
        ];

        return view('template/header')
            . view('modules/home', $data)
            . view('template/footer');
    }
}
