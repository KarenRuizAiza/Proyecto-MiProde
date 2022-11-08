<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use Config\Services;

class Login extends BaseController
{
    public function index()
    {

        return view('sessions/log-in');
    }

    public function autenticar()
        {
            if ($this->request->getPost()) {
                $model = new UsuarioModel();
                $usuario = $model->where('nombre', $this->request->getPost('nombre'))->find();

                if ($usuario != null && count($usuario) > 0) {
                    $usuario = $usuario[0];
                    if ($usuario["contraseña"] == $this->request->getPost('contraseña')) {
                        $this->session->usuario = $usuario["nombre"];
                        $this->session->rol = $usuario["rol"];
                        $this->session->logged = true;

                        return $this->response->redirect(site_url('/equipos'));
                    } else return "Contraseña inválida.";
                }

                else {
                    echo "No existe el usuario ingresado.";
                }
            } else return $this->response->redirect(site_url('/login'));
        }

    public function logout()
    {
        $this->session->destroy();
        return $this->response->redirect(site_url('/login'));
    }
}
?>