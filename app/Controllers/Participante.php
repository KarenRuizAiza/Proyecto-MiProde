<?php

namespace App\Controllers;

use App\Models\ParticipanteModel;
use App\Models\TorneoModel;

class Participante extends BaseController
{
    public function index($id_torneo = null)
    {
        $participanteModel = new ParticipanteModel();
        $torneoModel = new TorneoModel();
        $participantes = $participanteModel->listarPorTorneo($id_torneo);
        $torneos = $torneoModel->findAll();

        $data = array(
            'titulo' => 'Ranking por Torneo',
            'participantes' => $participantes,
            'torneos' => $torneos,
            'torneo_seleccionado' => $id_torneo
        );

        return view('template/header')
            . view('template/sidebar')
            . view('modules/participantes', $data)
            . view('template/footer');
    }

}
