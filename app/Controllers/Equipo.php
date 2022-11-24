<?php

namespace App\Controllers;

use App\Models\EquipoModel;
use App\Models\GrupoModel;

class Equipo extends BaseController
{

    public function index()
    {
        $equipoModel = new EquipoModel();
        $grupoModel = new GrupoModel();

        $id_grupo = $equipoModel->id_grupo;

        $grupo = $grupoModel->find($id_grupo);
        $nombre_grupo = $grupo->nombre;
        dd($nombre_grupo);
        $equipos = $equipoModel->listarEquiposPorGrupo($id_grupo);
        
        $data = array(
            'grupo' => $grupo,
            'nombre_grupo' => $nombre_grupo,
            'id_grupo' => $id_grupo,
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
        $grupoModel = new GrupoModel();

        $grupo = $grupoModel->find($id_grupo);
        $nombre_grupo = $grupo->nombre;
        dd($nombre_grupo);
        $equipos = $equipoModel->listarEquiposPorGrupo($id_grupo);
        $data = array(
            'grupo' => $grupo,
            'nombre_grupo' => $nombre_grupo,
            'id_grupo' => $id_grupo,
            'listado' => false,
            'titulo' => 'Equipos',
            'equipos' => $equipos,
            'equipoEditar' => false,
        );
        //dd($data);
        return view('template/header')
            . view('template/sidebar')
            . view('modules/equipos', $data)
            . view('template/footer');
    }

    public function equipoSeleccionado($id = null, $id_grupo = null)
    {
        $equipoModel = new EquipoModel();
        $grupoModel = new GrupoModel();

        $grupo = $grupoModel->find($id_grupo);
        $nombre_grupo = $grupo->nombre;
        
        $equipos = $equipoModel->listarEquiposPorGrupo($id_grupo);
        $equipoEditar = $equipoModel->find($id);

        $data = array(
            'grupo' => $grupo,
            'nombre_grupo' => $nombre_grupo,
            'id_grupo' => $id_grupo,
            'listado' => false,
            'titulo' => 'Equipos',
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
                'id_grupo' => $this->request->getPost('id_grupo'),
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

        return redirect()->to(base_url()."/equipos"."/".$equipo['id_grupo']);
    }

    public function eliminarEquipo($id = NULL)
    {
        $equipoModelo = new EquipoModel();
        $data['user'] = $equipoModelo->where('id', $id)->delete($id);

        return $this->response->redirect(site_url('/equipos'));
    }
}
