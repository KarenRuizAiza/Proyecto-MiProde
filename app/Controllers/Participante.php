<?php

namespace App\Controllers;

use App\Models\DesafioModel;
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
            'mostrarTorneo' => true,
            'torneos' => $torneos,
            'torneo_seleccionado' => $id_torneo
        );

        return view('template/header')
            . view('template/sidebar')
            . view('modules/participantes', $data)
            . view('template/footer');
    }

    public function rankingDesafio($id_desafio = null)
    {
        $participanteModel = new ParticipanteModel();
        $desafioModel = new DesafioModel();
        $torneoModel = new TorneoModel();
        $participantes = $participanteModel->listarPorDesafio($id_desafio);
        $desafio = $desafioModel->where('id', $id_desafio)->first();
        $torneo = $torneoModel->where('id', $desafio['id_torneo'])->first();

        $data = array(
            'titulo' => 'Ranking del desafio: '.$desafio['nombre'],
            'desafio' => $desafio,
            'torneo' => $torneo,
            'desafio_seleccionado' => $torneo,
            'participantes' => $participantes,
            'mostrarTorneo' => false,
        );

        return view('template/header')
            . view('template/sidebar')
            . view('modules/participantes', $data)
            . view('template/footer');
    }

}
