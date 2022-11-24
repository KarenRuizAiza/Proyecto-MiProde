<?php

namespace App\Controllers;

use App\Models\FaseModel;
use App\Models\PartidoModel;
use App\Models\TorneoModel;
use DateTime;

class Partido extends BaseController
{
    public function index($id_fase)
    {
        $partidoModel = new PartidoModel();
        $faseModel = new FaseModel();

        $fase = $faseModel->find($id_fase);
        $partidos = $partidoModel->listarPorFase($id_fase);

        $data = array(
            'titulo' => 'Partidos',
            'fase' => $fase,
            'partidos' => $partidos,
            'listado' => true,
            'partidoEditar' => false,
        );

        return view('template/header')
            . view('template/sidebar')
            . view('modules/partidos', $data)
            . view('template/footer');
    }

    public function partidoSeleccionado($id = null, $id_fase = null)
    {
        $partidoModel = new PartidoModel();
        $faseModel = new FaseModel();

        $fase = $faseModel->find($id_fase);
        $partidos = $partidoModel->listarPorFase($id_fase);

        $partidoEditar = $partidoModel->find($id);
        $partidoEditar['fecha'] = DateTime::createFromFormat('Y-m-d', $partidoEditar['fecha'])->format('d-m-Y');
        $partidoEditar['hora'] = date("H:i", strtotime($partidoEditar['hora']));

        $data = array(
            'titulo' => 'Partidos',
            'fase' => $fase,
            'partidos' => $partidos,
            'listado' => false,
            'partidoEditar' => $partidoEditar,
        );

        return view('template/header')
            . view('template/sidebar')
            . view('modules/partidos', $data)
            . view('template/footer');
    }

    public function agregarModificarPartido()
    {
        if ($this->request->getPost()) {
            $partido = [
                'fecha' => $this->request->getPost('fecha'),
                'hora' => $this->request->getPost('hora'),
                'id_fase' => $this->request->getPost('id_fase')
            ];

            $partido['fecha'] = DateTime::createFromFormat('d/m/Y', $partido['fecha'])->format('Y-m-d');

            $partidoModel = new PartidoModel();
            if ($this->request->getPost('id')) {
                $partido['id'] = $this->request->getPost('id');
                $partidoModel->update($this->request->getPost('id'), $partido);
            }
            else {
                $partidoModel->insert($partido);
            }
        }

        return redirect()->to(base_url()."/partidos"."/fase=".$partido['id_fase']);
    }

    public function eliminarPartido($id = NULL)
    {
        $partidoModel = new PartidoModel();
        $partido = $partidoModel->find($id);
        $id_fase = $partido['id_fase'];
        $data['user'] = $partidoModel->where('id', $id)->delete($id);

        return redirect()->to(base_url()."/partidos"."/fase=".$id_fase);
    }
}