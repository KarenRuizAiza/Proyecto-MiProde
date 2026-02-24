<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Usuario extends BaseController
{
    public function index()
    {
        $usuarioModel = new UsuarioModel();
        $usuarios = $usuarioModel->findAll();
        $roles = ['Administrador', 'Participante'];

        $data = array(
            'titulo' => 'Usuarios',
            'usuarios' => $usuarios,
            'roles' => $roles,
            'usuarioEditar' => '',
        );

        return view('template/header')
            . view('template/sidebar')
            . view('modules/usuarios', $data)
            . view('template/footer');
    }

    public function usuarioSeleccionado($id = null)
    {
        $usuarioModel = new UsuarioModel();
        $usuarios = $usuarioModel->findAll();
        $roles = ['Administrador', 'Participante'];

        $usuarioEditar = $usuarioModel->find($id);

        $data = array(
            'titulo' => 'Usuarios',
            'usuarios' => $usuarios,
            'roles' => $roles,
            'usuarioEditar' => $usuarioEditar,
        );

        return view('template/header')
            . view('template/sidebar')
            . view('modules/usuarios', $data)
            . view('template/footer');
    }

    public function agregarModificarUsuario()
    {
        //dd($this->request->getPost('fecha_inicio'));
        if ($this->request->getPost()) {
            $id = $this->request->getPost('id');
            $usuario = [
                'nombre' => $this->request->getPost('nombre'),
                'email' => $this->request->getPost('email'),
                'rol' => $this->request->getPost('rol')
            ];
            $usuarioModelo = new UsuarioModel();
            
            if ($this->verificarExistenciaUsuario($usuario, $id)) {
                if ($id) {
                    $usuario['id'] = $id;
                    $usuarioModelo->update($id, $usuario);
                }
                else {
                    $usuario['contraseña'] = '123abc';
                    $usuarioModelo->insert($usuario);
                }
            }
        } 
                             
        return redirect()->to(site_url('/usuarios'));
    }


    private function verificarExistenciaUsuario($datos_usuario, $id = null)
    {
        $usuarioModel = new UsuarioModel();
        $usuarios = $usuarioModel->findAll();
        $resultado = array_filter($usuarios, function($user) use ($datos_usuario, $id) {
            // Si el usuario tiene el mismo ID que el que estamos editando, lo ignoramos
            if ($id && $user['id'] == $id) {
                return false;
            }
            return $user['nombre'] === $datos_usuario['nombre'] || $user['email'] === $datos_usuario['email'];
        });

        if ($resultado != NULL) {
            session()->setFlashdata('error', 'Ya existe un usuario con el nombre o el correo electrónico ingresados.');
        }

        return $resultado == NULL;
    }

    public function eliminarUsuario($id = NULL)
    {
        $usuarioModelo = new UsuarioModel();
        $data['user'] = $usuarioModelo->where('id', $id)->delete($id);

        return redirect()->to(site_url('/usuarios'));
    }

    public function restablecerContraseña($id = NULL)
    {
        $usuarioModelo = new UsuarioModel();
        $usuarioModelo->update($id, ['contraseña'=> '123abc']);

        return redirect()->to(site_url('/usuarios'));
    }
}
