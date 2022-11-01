<?php

namespace App\Controllers;

use App\Models\TorneoModel;

class Torneo extends BaseController
{
    public function index()
    {
        $torneoModel = new TorneoModel();
        $torneos = $torneoModel->findAll();

        $data = array(
            'titulo' => 'Lista de Torneos',
            'torneos' => $torneos,
            'torneoEditar' => '',
        );

        return view('template/header')
            . view('template/sidebar')
            . view('modules/torneos', $data)
            . view('template/footer');
    }

    public function torneoSeleccionado($id = null)
    {
        $torneoModel = new TorneoModel();
        $torneos = $torneoModel->findAll();

        $torneoEditar = $torneoModel->find($id);

        $data = array(
            'titulo' => 'Lista de Torneos',
            'torneos' => $torneos,
            'torneoEditar' => $torneoEditar,
        );

        return view('template/header')
            . view('template/sidebar')
            . view('modules/torneos', $data)
            . view('template/footer');
    }

    public function agregarModificarTorneo()
    {
        if ($this->request->getPost()) {
            $torneo = [
                'nombre' => $this->request->getPost('nombre'),
                'descripcion' => $this->request->getPost('descripcion'),
                'fecha_inicio' => $this->request->getPost('fecha_inicio'),
                'fecha_fin' => $this->request->getPost('fecha_fin')
            ];
            $torneoModelo = new TorneoModel();
            if ($this->request->getPost('id')) {
                $torneo['id'] = $this->request->getPost('id');
                $torneoModelo->update($this->request->getPost('id'), $torneo);
            }
            else {
                $torneoModelo->insert($torneo);
            }
        } 
                             
        return $this->response->redirect(site_url('/torneos'));
    }

    public function eliminarTorneo($id = NULL)
    {
        $torneoModelo = new TorneoModel();
        $data['user'] = $torneoModelo->where('id', $id)->delete($id);

        return $this->response->redirect(site_url('/torneos'));
    }
}
