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
        
        $torneos = [];
        if (session()->has('usuarioId') && session()->rol == 'Participante') {
            $torneos = $torneoModel->listarVigentesConPredicciones(session()->usuarioId);
        } else {
            // Para admin o visitantes, mostrar todos los vigentes (o una lógica similar)
            $torneos = $torneoModel->where('fecha_fin >=', date('Y-m-d'))->findAll();
        }

        $data = [
            'torneos' => $torneos
        ];

        $view = view('template/header');
        if (session()->has('usuarioId')) {
            $view .= view('template/sidebar');
        }
        $view .= view('modules/home', $data);
        $view .= view('template/footer');

        return $view;
    }
}
