<?php

namespace App\Controllers;

use App\Models\EquipoModel;

class Equipo extends BaseController
{

    public function index()
    {
        $equipoModel = new EquipoModel();
        $equipos = $equipoModel->findAll();

        $data = array(
            /*'titulo' => 'Lista de Equipos',
            'equipos' => $equipos,
            'equipoEditar' => '',
            'grupo' => $grupo,*/
            'listado' => false,
            'titulo' => 'Agregar Equipo',
            'equipos' => $equipos,
            'equipoEditar' => false,
        );

        return view('template/header')
            . view('template/sidebar')
            . view('modules/equipos', $data)
            . view('template/footer');
    }
    public function equiposPorGrupo($id_grupo)
    {
        $equipoModel = new EquipoModel();
        $equipos = $equipoModel->listarEquiposPorGrupo($id_grupo);
        dd($equipos);
        $data = array(
            /*'titulo' => 'Lista de Equipos',
            'equipos' => $equipos,
            'equipoEditar' => false,
            'grupo' => $grupo,*/
            'listado' => false,
            'titulo' => 'Agregar Equipo',
            'equipos' => $equipos,
            'equipoEditar' => false,
        );
        dd($data);
        return view('template/header')
            . view('template/sidebar')
            . view('modules/equipos', $data)
            . view('template/footer');
    }

    public function equipoSeleccionado($id = null)
    {
        $equipoModel = new EquipoModel();
        $equipos = $equipoModel->findAll();

        $equipoEditar = $equipoModel->find($id);

        $data = array(
            'titulo' => 'Lista de Equipos',
            'equipos' => $equipos,
            'equipoEditar' => $equipoEditar,
        );

        return view('template/header')
            . view('template/sidebar')
            . view('modules/equipos', $data)
            . view('template/footer');
    }

    public function agregarModificarEquipo()
    {
        if ($this->request->getPost()) {
            $equipo = [
                'nombre' => $this->request->getPost('nombre'),
                'mundiales_jugados' => $this->request->getPost('mundiales_jugados'),
                'mundiales_ganados' => $this->request->getPost('mundiales_ganados'),
                'ranking_fifa' => $this->request->getPost('ranking_fifa')
            ];
            $equipoModelo = new EquipoModel();
            if ($this->request->getPost('id')) {
                $equipo['id'] = $this->request->getPost('id');
                $equipoModelo->update($this->request->getPost('id'), $equipo);
            }
            else {
                $equipoModelo->insert($equipo);
            }
        }

        return $this->response->redirect(site_url('/equipos'));
    }

    public function eliminarEquipo($id = NULL)
    {
        $equipoModelo = new EquipoModel();
        $data['user'] = $equipoModelo->where('id', $id)->delete($id);

        return $this->response->redirect(site_url('/equipos'));
    }
}
