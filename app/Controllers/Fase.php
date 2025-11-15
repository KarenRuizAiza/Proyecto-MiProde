<?php

namespace App\Controllers;
use App\Models\EquipoModel;
use App\Models\GrupoModel;
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
            'titulo' => 'Agregar Fase',
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
        $faseEditar['fecha_inicio'] = DateTime::createFromFormat('Y-m-d', $faseEditar['fecha_inicio'])->format('d-m-Y');
        $faseEditar['fecha_fin'] = DateTime::createFromFormat('Y-m-d', $faseEditar['fecha_fin'])->format('d-m-Y');

        $data = array(
            'titulo' => 'Editar fase',
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

            
            $fase['fecha_inicio'] = DateTime::createFromFormat("d/m/Y", $fase['fecha_inicio'])->format('Y-m-d');
            $fase['fecha_fin'] = DateTime::createFromFormat("d/m/Y", $fase['fecha_fin'])->format('Y-m-d');

            $faseModelo = new FaseModel();
            if ($this->request->getPost('id')) {
                $fase['id'] = $this->request->getPost('id');
                $faseModelo->update($this->request->getPost('id'), $fase);
            }
            else {
                $faseModelo->insert($fase);
            }
        }

        print_r($fase);
        
        return redirect()->to(base_url()."/fases"."/torneo=".$fase['id_torneo']);
    }

    public function eliminarFase($id = NULL)
    {
        $faseModelo = new FaseModel();
        $fase = $faseModelo->find($id);
        $id_torneo = $fase['id_torneo'];
        $data['user'] = $faseModelo->where('id', $id)->delete($id);

        return redirect()->to(base_url()."/fases"."/torneo=".$id_torneo);
    }

    public function agregarPartido($id_fase)
    {
        $partidoModel = new PartidoModel();
        $equipoModel = new EquipoModel();
        $grupoModel = new GrupoModel();
        $faseModel = new FaseModel();

        $fase = $faseModel->find($id_fase);
        $equipos = $equipoModel->findAll();
        $grupos = $grupoModel->findAll();
        $partidos = $partidoModel->listarPorFaseConApuestas($id_fase, $this->session->usuarioId);

        $data = array(
            'fase'=> $fase,
            'partidos' => $partidos,
            'equipos' => $equipos,
            'grupos' => $grupos,
            'listado' => false,
            'partidoEditar' => false,
            'titulo' => 'Agregar partido',
            'partidoPrediccion' => false,
            'apuesta' => false
        );

        return view('template/header')
            . view('template/sidebar')
            . view('modules/partidos', $data)
            . view('template/footer');
    }

    public function recuperarFixture($id_torneo)
    {
        $torneoModel = new TorneoModel();
        $nombre_torneo = $torneoModel->find($id_torneo)['nombre'];
        
        $faseModel = new FaseModel();
        $fases = $faseModel->where('id_torneo', $id_torneo)->orderBy('fecha_inicio', 'ASC')->findAll();

        $partidoModel = new PartidoModel();
        $diccionario = [];

        $cantidada_aciertos = 0;

        foreach ($fases as $fase) {
            $partidos = $partidoModel->listarPorFaseConApuestas($fase['id'], $this->session->usuarioId);

            foreach ($partidos as $partido) {
                $cantidada_aciertos += $partido['acerto_prediccion'];

                if ($partido['grupo']) {
                    // solo habia que agregar [] vacio, no tengo idea como funca php
                    $diccionario[$fase['nombre'] . ' - Grupo ' . $partido['grupo']][] = $partido;
                } else {
                    $diccionario[$fase['nombre']][] = $partido;
                }
            }
        }

        $data['fixture'] =  $diccionario;
        $data['titulo'] =  "Fixture " . $nombre_torneo;
        $data['cantidada_aciertos'] = $cantidada_aciertos;

        return view('template/header')
            . view('template/sidebar')
            . view('modules/fixture', $data)
            . view('template/footer');
      
    }
}
