<?php

namespace App\Controllers;

use DateTime;

use App\Models\TorneoModel;
use App\Models\FaseModel;

class Torneo extends BaseController
{
    public function index()
    {
        $torneoModel = new TorneoModel();
        $torneos = $torneoModel->findAll();

        $data = array(
            'titulo' => 'Torneos',
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
        //dd($this->request->getPost('fecha_inicio'));
        if ($this->request->getPost()) {
            $torneo = [
                'nombre' => $this->request->getPost('nombre'),
                'descripcion' => $this->request->getPost('descripcion'),
                'fecha_inicio' => $this->request->getPost('fecha_inicio'), 
                'fecha_fin' => $this->request->getPost('fecha_fin')
            ];
            $torneoModelo = new TorneoModel();
            $torneo['fecha_inicio'] = DateTime::createFromFormat("d-m-Y", $torneo['fecha_inicio'])->format('Y-m-d');
            $torneo['fecha_fin'] = DateTime::createFromFormat("d-m-Y", $torneo['fecha_fin'])->format('Y-m-d');
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

    public function agregarFase($id_torneo)
    {
        $torneoModel = new TorneoModel();
        $torneo = $torneoModel->find($id_torneo);
        
        $faseModel = new FaseModel();
        $fases = $faseModel->findAll();
        //dd($torneo);
        $data = array(
            'torneo' => $torneo,
            'listado' => false,
            'faseEditar' => false,
            'titulo' => 'Agregar fase',
            'fases' => $fases
        );
        
        return view('template/header')
        . view('template/sidebar')
        . view('modules/fases', $data)
        . view('template/footer');
    }
    public function torneosVigentes()
    {
        $torneo = new TorneoModel();
        $data['titulo'] = "Torneos disponibles";
        $data['torneos'] = $torneo->where('fecha_fin >', date("Y-m-d"))->orderBy('id', 'ASC')->findAll();
        
        return view('template/header')
        . view('template/sidebar')
        . view('modules/torneosVigentes', $data)
        . view('template/footer');
    }
}
