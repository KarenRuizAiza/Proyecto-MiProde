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
            $usuario = $model->where('nombre', $this->request->getPost('nombre'))->first();

            if ($usuario) {
                if ($usuario["contraseña"] == $this->request->getPost('contraseña')) {
                    // Set both keys to ensure compatibility with old controllers (usuarioId) 
                    // and new views (id)
                    $this->session->set([
                        'id'        => $usuario["id"],
                        'usuarioId' => $usuario["id"], 
                        'usuario'   => $usuario["nombre"],
                        'rol'       => $usuario["rol"],
                        'logged'    => true,
                    ]);

                    $id_sess = $this->session->session_id ?? 'no-id';
                    file_put_contents(WRITEPATH . 'debug_session.log', date('Y-m-d H:i:s') . " - LOGIN SUCCESS - SessID: $id_sess - UserID: " . ($usuario["id"]) . "\n", FILE_APPEND);

                    return $this->response->redirect(site_url('/'));
                } else {
                    return $this->errorMessage();
                }
            } else {
                return $this->errorMessage();
            }
        } else {
            return $this->response->redirect(site_url('/login'));
        }
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
