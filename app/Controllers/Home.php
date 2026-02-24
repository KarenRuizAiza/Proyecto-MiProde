<?php

namespace App\Controllers;

use Config\Services;


class Home extends BaseController
{
    public function index()
    {
        $sess = session();
        $id = $sess->get('usuarioId');
        $id_sess = $sess->session_id ?? 'no-id';
        file_put_contents(WRITEPATH . 'debug_session.log', date('Y-m-d H:i:s') . " - SessID: $id_sess - UserID: " . ($id ?? 'NULL') . "\n", FILE_APPEND);

        $torneoModel = new \App\Models\TorneoModel();
        
        $data = [
            'torneos' => $torneoModel->findAll()
        ];

        return view('template/header')
            . view('template/sidebar')
            . view('modules/home', $data)
            . view('template/footer');
    }
}
