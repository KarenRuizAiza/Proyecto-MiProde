<?php

namespace App\Controllers;

use App\Models\ApuestaModel;
use App\Models\EquipoModel;
use App\Models\PartidoModel;
use App\Models\FaseModel;
use App\Models\PrediccionModel;
use DateTime;

class Partido extends BaseController
{
    public function index($id_fase)
    {
        $partidoModel = new PartidoModel();
        $equipoModel = new EquipoModel();
        $faseModel = new FaseModel();

        $partidos = $partidoModel->listarPorFaseConApuestas($id_fase, $this->session->usuarioId);
        $fase = $faseModel->find($id_fase);
        $equipos = $equipoModel->findAll();

        $data = array(
            'titulo' => 'Partidos',
            'partidos' => $partidos,
            'fase'=> $fase,
            'equipos' => $equipos,
            'listado' => true,
            'partidoEditar' => false,
            'partidoPrediccion' => false,
            'apuesta' => false
        );

        return view('template/header')
            . view('template/sidebar')
            . view('modules/partidos', $data)
            . view('template/footer');
    }

    public function partidoSeleccionado($id = null, $id_fase = null)
    {
        $partidoModel = new PartidoModel();
        $equipoModel = new EquipoModel();
        $faseModel = new FaseModel();

        $fase = $faseModel->find($id_fase);
        $equipos = $equipoModel->findAll();
        $partidos = $partidoModel->listarPorFaseConApuestas($id_fase, $this->session->usuarioId);

        $partidoEditar = $partidoModel->find($id);
        $partidoEditar['fecha'] = DateTime::createFromFormat('Y-m-d', $partidoEditar['fecha'])->format('d-m-Y');
        $partidoEditar['hora'] = date("H:i", strtotime($partidoEditar['hora']));

        $data = array(
            'titulo' => 'Partidos',
            'fase'=> $fase,
            'equipos' => $equipos,
            'partidos' => $partidos,
            'listado' => false,
            'partidoEditar' => $partidoEditar,
            'partidoPrediccion' => false,
            'apuesta' => false
        );

        return view('template/header')
            . view('template/sidebar')
            . view('modules/partidos', $data)
            . view('template/footer');
    }

    public function cargarPrediccion($id = null, $id_fase = null)
    {
        $faseModel = new FaseModel();
        $partidoModel = new PartidoModel();
        $equipoModel = new EquipoModel();
        $apuestaModel = new ApuestaModel();
        $prediccionModel = new PrediccionModel();

        $fase = $faseModel->find($id_fase);
        $partidos = $partidoModel->listarPorFaseConApuestas($id_fase, $this->session->usuarioId);
        $equipos = $equipoModel->findAll();

        $apuesta = $apuestaModel->existeApuesta($this->session->usuarioId, $id_fase);

        if (count($apuesta) == 0) {
            $apuestaModel->insert(
                [
                    'fecha_creacion' => date_format(date_create(), 'Y-m-d'),
                    'id_participante' => $this->session->usuarioId,
                    'id_fase' => $id_fase
                ]);

            $apuesta = $apuestaModel->existeApuesta($this->session->usuarioId, $id_fase);
        }

        $partidoPrediccion = $partidoModel->partidoPorFase($id, $id_fase);
        $tieneEquipoDefinido = $partidoPrediccion || session()->rol == 'Participante' ?
                            ($partidoPrediccion[0]['id_equipo_local'] && $partidoPrediccion[0]['id_equipo_visitante'] || session()->rol == 'Participante') : false;
        $prediccion = $prediccionModel->existePrediccion($id, $apuesta[0]['id']);

        $data = array(
            'titulo' => 'Partidos',
            'fase'=> $fase,
            'equipos' => $equipos,
            'partidos' => $partidos,
            'listado' => true,
            'partidoEditar' => false,
            'partidoPrediccion' => $partidoPrediccion,
            'prediccion'=> $prediccion,
            'equiposDefinidos'=> $tieneEquipoDefinido,
            'apuesta' => $apuesta
        );

        return view('template/header')
            . view('template/sidebar')
            . view('modules/partidos', $data)
            . view('template/footer');
    }

    public function agregarPrediccion()
    {
        if ($this->request->getPost()) {

            $prediccion = [
                'resultado' => $this->request->getPost('resultado_prediccion'),
                'id_equipo_local' => $this->request->getPost('equipo_local_prediccion'),
                'id_equipo_visitante' => $this->request->getPost('equipo_visitante_prediccion'),
                'id_partido' => $this->request->getPost('id_partido'),
                'id_apuesta' => $this->request->getPost('id_apuesta'),
            ];

            $prediccionModel = new PrediccionModel();
            $prediccionCargada = $prediccionModel->existePrediccion($prediccion['id_partido'], $prediccion['id_apuesta']);

            if (count($prediccionCargada) == 0) {
                $prediccionModel->insert($prediccion);
            } else {
                $prediccionModel->update(array_values($prediccionCargada)[0]['id'], $prediccion);
            }
        }

        return redirect()->to(base_url()."/partidos"."/fase=".$this->request->getPost('id_fase'));
    }

    public function eliminarPrediccion($id_prediccion)
    {
        
        $prediccionModel = new PrediccionModel();
        $prediccion = $prediccionModel->find($id_prediccion);

        $partidoModel = new PartidoModel();
        $partido = $partidoModel->find($prediccion['id_partido']);
        $id_fase = $partido['id_fase'];
        
        $prediccionModel->where('id', $id_prediccion)->delete($id_prediccion);

        return redirect()->to(base_url()."/partidos"."/fase=".$id_fase);
    }

    public function agregarModificarPartido()
    {
        if ($this->request->getPost()) {


            $partido = [
                'fecha' => $this->request->getPost('fecha'),
                'hora' => $this->request->getPost('hora'),
                'id_fase' => $this->request->getPost('id_fase'),
                'id_equipo_local' => $this->request->getPost('local') ? $this->request->getPost('local') : null,
                'id_equipo_visitante' => $this->request->getPost('visitante') ? $this->request->getPost('visitante') : null
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

    public function cargarResultado($id = null, $id_fase = null)
    {
        $faseModel = new FaseModel();
        $partidoModel = new PartidoModel();
        $equipoModel = new EquipoModel();

        $fase = $faseModel->find($id_fase);
        $partidos = $partidoModel->listarPorFase($id_fase);
        $partidoSeleccionado = $partidoModel->partidoPorFase($id, $id_fase);
        $equipos = $equipoModel->findAll();

        $tieneEquipoDefinido = $partidoSeleccionado ? $partidoSeleccionado[0]['id_equipo_local'] && $partidoSeleccionado[0]['id_equipo_visitante'] : false;

        $data = array(
            'titulo' => 'Partidos',
            'fase'=> $fase,
            'equipos' => $equipos,
            'partidos' => $partidos,
            'partidoResultado' => $partidoSeleccionado,
            'listado' => true,
            'partidoEditar' => false,
            'equiposDefinidos'=> $tieneEquipoDefinido,
        );

        return view('template/header')
            . view('template/sidebar')
            . view('modules/partidos', $data)
            . view('template/footer');
    }

    public function agregarResultado()
    {
        if ($this->request->getPost()) {

            $resultadoPartido = [
                'resultado' => $this->request->getPost('resultado_partido'),
            ];

            $partidoModel = new PartidoModel();
            $partidoModel->update($this->request->getPost('id_partido'), $resultadoPartido);
        }

        return redirect()->to(base_url()."/partidos"."/fase=".$this->request->getPost('id_fase'));
    }

}
