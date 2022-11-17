<?php

namespace App\Controllers;
use App\Models\PartidoModel;
use DateTime;

use App\Models\FaseModel;
use App\Models\TorneoModel;

class Fase extends BaseController
{
    public function index($id_torneo)
    {
        $faseModel = new FaseModel();
        $torneoModel = new TorneoModel();
       
        $torneo = $torneoModel->find($id_torneo);
        $fases = $faseModel->listarFasesPorTorneo($id_torneo);

        $data = array(
            'titulo' => 'Lista de Fases',
            'torneo' => $torneo,
            'fases' => $fases,
            'listado' => true,
            'faseEditar' => false,
        );

        return view('template/header')
            . view('template/sidebar')
            . view('modules/fases', $data)
            . view('template/footer');
    }
   
    public function faseSeleccionada($id = null, $id_torneo = null)
    {
        $faseModel = new FaseModel();
        $torneoModel = new TorneoModel();

        $torneo = $torneoModel->find($id_torneo);
        $fases = $faseModel->listarFasesPorTorneo($id_torneo);

        $faseEditar = $faseModel->find($id);

        $data = array(
            'titulo' => 'Lista de Fases',
            'torneo' => $torneo,
            'fases' => $fases,
            'listado' => false,
            'faseEditar' => $faseEditar,
        );

        return view('template/header')
            . view('template/sidebar')
            . view('modules/fases', $data)
            . view('template/footer');
    }

    public function agregarModificarFase()
    {
        
        if ($this->request->getPost()) {
            $fase = [
                'nombre' => $this->request->getPost('nombre'),
                'fecha_inicio' => $this->request->getPost('fecha_inicio'),
                'fecha_fin' => $this->request->getPost('fecha_fin'),
                'id_torneo' => $this->request->getPost('id_torneo')
            ];
            //dd(base_url()."/fases"."/".$fase['id_torneo']);
           
            $faseModelo = new FaseModel();
            
            $fase['fecha_inicio'] = DateTime::createFromFormat("d-m-Y", $fase['fecha_inicio'])->format('Y-m-d');
            $fase['fecha_fin'] = DateTime::createFromFormat("d-m-Y", $fase['fecha_fin'])->format('Y-m-d');
            if ($this->request->getPost('id')) {
                $fase['id'] = $this->request->getPost('id');
                $faseModelo->update($this->request->getPost('id'), $fase);
            }
            else {
                $faseModelo->insert($fase);
            }
        }
        
        return redirect()->to(base_url()."/fases"."/".$fase['id_torneo']);
    }

    public function eliminarFase($id = NULL)
    {
        $faseModelo = new FaseModel();
        $fase = $faseModelo->find($id);
        $id_torneo = $fase['id_torneo'];
        $data['user'] = $faseModelo->where('id', $id)->delete($id);

        return redirect()->to(base_url()."/fases"."/".$id_torneo);
    }

    public function agregarPartido($id_fase)
    {
        $faseModel = new FaseModel();
        $fase = $faseModel->find($id_fase);

        $partidoModel = new PartidoModel();
        $partidos = $partidoModel->findAll();
        //dd($torneo);
        $data = array(
            'fase' => $fase,
            'listado' => false,
            'partidoEditar' => false,
            'titulo' => 'Agregar partido',
            'partidos' => $partidos
        );

        return view('template/header')
            . view('template/sidebar')
            . view('modules/partidos', $data)
            . view('template/footer');
    }
}
