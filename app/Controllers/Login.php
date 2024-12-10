<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use Config\Services;

class Login extends BaseController
{
    public function index()
    {
        $error = session()->getFlashdata('error');
        return view('sessions/log-in', ['error' => $error]);
    }

    public function autenticar()
        {
            if ($this->request->getPost()) {
                $model = new UsuarioModel();
                $usuario = $model->where('nombre', $this->request->getPost('nombre'))->find();

                if ($usuario != null && count($usuario) > 0) {
                    $usuario = $usuario[0];
                    if ($usuario["contraseña"] == $this->request->getPost('contraseña')) {
                        $this->session->usuarioId = $usuario["id"];
                        $this->session->usuario = $usuario["nombre"];
                        $this->session->rol = $usuario["rol"];
                        $this->session->logged = true;

                        return $this->response->redirect(site_url('/'));
                    } else  {
                        return $this->errorMessage();
                    }
                }
                else {
                    return $this->errorMessage();
                }

            } else return $this->response->redirect(site_url('/login'));
        }

    private function errorMessage()
        {
            session()->setFlashdata('error', 'Usuario y/o contraseña incorrectos.');
            return $this->response->redirect(site_url('/login'));
        }

    public function logout()
    {
        $this->session->destroy();
        return $this->response->redirect(site_url('/login'));
    }
}
?>
