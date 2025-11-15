<?php

namespace App\Controllers;

use App\Models\PrediccionModel;
use App\Models\UsuarioModel;

class Prediccion extends BaseController
{
    public function index($id_usuario = null)
    {
        $prediccionModel = new PrediccionModel();
        $usuarioModel = new UsuarioModel();
        $predicciones = $prediccionModel->listarPorUsuario($id_usuario);
        $usuarios = $usuarioModel->where('rol', 'Participante')->findAll();

        $data = array(
            'titulo' => 'Predicciones por Participante',
            'predicciones' => $predicciones,
            'participantes' => $usuarios,
            'participante_seleccionado' => $id_usuario
        );

        return view('template/header')
            . view('template/sidebar')
            . view('modules/predicciones', $data)
            . view('template/footer');
    }

}
