<?php

namespace App\Controllers;

use Config\Services;
use App\Models\UsuarioModel;


class Register extends BaseController
{
      
    public function index()
    {
        return $this->selectView();
    }

    private function selectView()
    {
        $view = NULL;
        $error = session()->getFlashdata('error');

        $nombre_ingresado = session()->getFlashdata('nombre_ingresado');
        $email_ingresado = session()->getFlashdata('email_ingresado');

        $data = array(
            'error' => $error,
            'nombre'=> $nombre_ingresado,
            'email'=> $email_ingresado,
            '$usuarioEditar'=> ''
        );

        if (isset($_SESSION['logged'])) {
            $view = view('template/header')
                    . view('template/sidebar')
                    . view('sessions/register', $data)
                    . view('template/footer');
        } else {
            $view = view('sessions/register', $data);
        }

        return $view;
    }

    public function agregarModificarUsuario()
    {
        //dd($this->request->getPost('fecha_inicio'));
        if ($this->request->getPost()) {
            $usuario = [
                'nombre' => $this->request->getPost('nombre'),
                'email' => $this->request->getPost('email'),
                'contraseña' => $this->request->getPost('contraseña'), 
                'contraseña_repetida' => $this->request->getPost('contraseña_repetida'),
                'rol' => 'Participante',
                'nombre_completo' => $this->request->getPost('nombre_completo'),
                'apellido' => $this->request->getPost('apellido'),
                'dni' => $this->request->getPost('dni'),
                'fecha_nacimiento' => $this->request->getPost('fecha_nacimiento'),
            ];

            if ($this->verificarExistenciaUsuario($usuario) && $this->verificarCoincidenciaDeContraseña($usuario)) {
                $usuarioModelo = new UsuarioModel();
                
                print_r($this->request->getBody());
                if ($this->request->getPost('id') != NULL) {
                    
                    $usuario['id'] = $this->request->getPost('id');
                    $usuarioModelo->update($this->request->getPost('id'), $usuario);
                }
                else { 
                    print_r($usuario);
                    $usuarioModelo->insert($usuario);
                    print_r("bien...");
                    $_SESSION['alta_exitosa'] = 'Tu usuario se creó correctamente.';
                    return $this->response->redirect(site_url('/login'));
                }

            }
            else {
                session()->setflashdata('nombre_ingresado', $usuario['nombre']);
                session()->setflashdata('email_ingresado', $usuario['email']);
                return $this->response->redirect(site_url('/register'));
            }

            
        }                    
        //return $this->response->redirect(site_url('/torneos'));
    }

    private function verificarExistenciaUsuario($datos_usuario)
    {
        $usuarioModel = new UsuarioModel();
        $usuarios = $usuarioModel->findAll();
        $resultado = array_filter($usuarios, function($user) use ($datos_usuario) {
            return $user['nombre'] === $datos_usuario['nombre'] || $user['email'] === $datos_usuario['email'];
        });

        if ($resultado != NULL) {
            session()->setFlashdata('error', 'Ya existe un usuario con el nombre o el correo electrónico ingresados.');
        }

        return $resultado == NULL;
    }

    private function verificarCoincidenciaDeContraseña($datos_usuario)
    {        
        if ($datos_usuario['contraseña'] != $datos_usuario['contraseña_repetida']) {
            session()->setFlashdata('error', 'Las contraseñas no coinciden.');
        }
        return $datos_usuario['contraseña'] == $datos_usuario['contraseña_repetida'];
    }

    /*private function redirectUser() 
    {
        if (isset($_SESSION['logged'])) {
            return = view('template/header')
                    . view('template/sidebar')
                    . view('sessions/register')
                    . view('template/footer');
        } else {
            return = view('sessions/register');
        }
    }*/
}
