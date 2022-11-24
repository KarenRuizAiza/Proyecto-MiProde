<?php

namespace App\Controllers;

use App\Models\ApuestaModel;
use App\Models\EquipoModel;
use App\Models\PartidoModel;
use App\Models\PrediccionModel;
use DateTime;

class Partido extends BaseController
{
    public function index($id_fase)
    {
        $partidoModel = new PartidoModel();
        $equipoModel = new EquipoModel();

        $partidos = $partidoModel->listarPorFase($id_fase, $this->session->usuarioId);
        $equipos = $equipoModel->findAll();

        $data = array(
            'titulo' => 'Partidos',
            'partidos' => $partidos,
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

        $equipos = $equipoModel->findAll();
        $partidos = $partidoModel->listarPorFase($id_fase, $this->session->usuarioId);

        $partidoEditar = $partidoModel->find($id);
        $partidoEditar['fecha'] = DateTime::createFromFormat('Y-m-d', $partidoEditar['fecha'])->format('d-m-Y');
        $partidoEditar['hora'] = date("H:i", strtotime($partidoEditar['hora']));

        $data = array(
            'titulo' => 'Partidos',
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
        $partidoModel = new PartidoModel();
        $equipoModel = new EquipoModel();
        $apuestaModel = new ApuestaModel();

        $partidos = $partidoModel->listarPorFase($id_fase, $this->session->usuarioId);
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

        $data = array(
            'titulo' => 'Partidos',
            'equipos' => $equipos,
            'partidos' => $partidos,
            'listado' => true,
            'partidoEditar' => false,
            'partidoPrediccion' => $partidoPrediccion,
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

    public function agregarModificarPartido()
    {
        if ($this->request->getPost()) {
            $partido = [
                'fecha' => $this->request->getPost('fecha'),
                'hora' => $this->request->getPost('hora'),
                'id_fase' => $this->request->getPost('id_fase'),
                'id_equipo_local' => $this->request->getPost('local'),
                'id_equipo_visitante' => $this->request->getPost('visitante')
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
