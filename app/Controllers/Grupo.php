<?php

namespace App\Controllers;

use App\Models\GrupoModel;
use App\Models\EquipoModel;

class Grupo extends BaseController
{

    public function index()
    {
        $grupoModel = new GrupoModel();
        $grupos = $grupoModel->findAll();

        $data = array(
            'titulo' => 'Lista de Grupos',
            'grupos' => $grupos,
            'grupoEditar' => '',
        );

        return view('template/header')
            . view('template/sidebar')
            . view('modules/grupos', $data)
            . view('template/footer');
    }

    public function grupoSeleccionado($id = null)
    {
        $grupoModel = new GrupoModel();
        $grupos = $grupoModel->findAll();

        $grupoEditar = $grupoModel->find($id);

        $data = array(
            'titulo' => 'Lista de Equipos',
            'grupos' => $grupos,
            'grupoEditar' => $grupoEditar,
        );

        return view('template/header')
            . view('template/sidebar')
            . view('modules/grupos', $data)
            . view('template/footer');
    }

    public function agregarModificarGrupo()
    {
        if ($this->request->getPost()) {
            $grupo = [
                'nombre' => $this->request->getPost('nombre'),
            ];
            $grupoModelo = new GrupoModel();
            if ($this->request->getPost('id')) {
                $grupo['id'] = $this->request->getPost('id');
                $grupoModelo->update($this->request->getPost('id'), $grupo);
            }
            else {
                $grupoModelo->insert($grupo);
            }
        }

        return $this->response->redirect(site_url('/grupos'));
    }

    public function eliminarGrupo($id = NULL)
    {
        $grupoModelo = new GrupoModel();
        $data['user'] = $grupoModelo->where('id', $id)->delete($id);

        return $this->response->redirect(site_url('/grupos'));
    }

    public function agregarEquipo($id_grupo)
    {
        $equipoModel = new EquipoModel();
        $grupoModel = new GrupoModel();

        $grupo = $grupoModel->find($id_grupo);
        $nombre_grupo = $grupo->nombre;
        
        $equipos = $equipoModel->findAll();
        
        $data = array(
            'grupo' => $grupo,
            'nombre_grupo' => $nombre_grupo,
            'id_grupo' => $id_grupo,
            'listado' => false,
            'equipoEditar' => false,
            'titulo' => 'Agregar Equipo',
            'equipos' => $equipos,
            
        );
        
        return view('template/header')
        . view('template/sidebar')
        . view('modules/equipos', $data)
        . view('template/footer');
    }
}