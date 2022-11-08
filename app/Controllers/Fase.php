<?php

namespace App\Controllers;

use App\Models\FaseModel;

class Fase extends BaseController
{
    public function index()
    {
        $faseModel = new FaseModel();
        $fases = $faseModel->findAll();

        $data = array(
            'titulo' => 'Lista de Fases',
            'fases' => $fases,
            'faseEditar' => '',
        );

        return view('template/header')
            . view('template/sidebar')
            . view('modules/fases', $data)
            . view('template/footer');
    }

    public function faseSeleccionada($id = null)
    {
        $faseModel = new FaseModel();
        $fases = $faseModel->findAll();

        $faseEditar = $faseModel->find($id);

        $data = array(
            'titulo' => 'Lista de Fases',
            'fases' => $fases,
            'faseEditar' => $faseEditar,
        );

        return view('template/header')
            . view('template/sidebar')
            . view('modules/fases', $data)
            . view('template/footer');
    }

    public function agregarModificarFase($id_torneo)
    {
        if ($this->request->getPost()) {
            $fase = [
                'nombre' => $this->request->getPost('nombre'),
                'fecha_inicio' => $this->request->getPost('fecha_inicio'),
                'fecha_fin' => $this->request->getPost('fecha_fin'),
                'id_torneo' => $this->request->getPost($id_torneo)
            ];
            $faseModelo = new FaseModel();
            if ($this->request->getPost('id')) {
                $fase['id'] = $this->request->getPost('id');
                $faseModelo->update($this->request->getPost('id'), $fase);
            }
            else {
                $faseModelo->insert($fase);
            }
        }

        return $this->response->redirect(site_url('/fases'));
    }

    public function eliminarFase($id = NULL)
    {
        $faseModelo = new FaseModel();
        $data['user'] = $faseModelo->where('id', $id)->delete($id);

        return $this->response->redirect(site_url('/fases'));
    }
}
