<?php
namespace App\Controllers;

use App\Models\DesafioModel;
use App\Models\UsuarioModel;
use DateTime;

class DesafioController extends BaseController
{
    public function index()
    {
        $desafioModel = new DesafioModel();

        $desafios = $desafioModel->getInvitacionesByUsuario(session()->usuarioId);
        $data = array(
            'titulo' => 'Lista de Invitaciones',
            'desafios' => $desafios
        );
        return view('template/header') 
        . view('template/sidebar')
        . view('modules/desafios', $data) 
        . view('template/footer');
    }


    public function misDesafios()
    {
        $desafioModel = new DesafioModel();
        $usuarioModel = new UsuarioModel();

        $idUsuario = session()->usuarioId;

        $usuario = $usuarioModel->find($idUsuario);
        $desafios = $desafioModel->listarDesafiosPorUsuario($idUsuario);
        $data = array(
            'titulo' => 'Lista de Desafios',
            'desafios' => $desafios
        );

        return view('template/header')
        . view('template/sidebar') 
        . view('modules/desafios', $data) 
        . view('template/footer');
    }

    public function agregarModificarDesafio()
    {

        if ($this->request->getPost()) {
            $desafio = [
                'id_torneo' => $this->request->getPost('id_torneo'),
                'nombre' => $this->request->getPost('nombre'),
                'fecha' => $this->request->getPost('fecha'),
                'hora' => $this->request->getPost('hora'),
            ];

            $desafio['fecha'] = DateTime::createFromFormat('d/m/Y', $desafio['fecha'])->format('Y-m-d');
            $desafio['hora'] = date("H:i", strtotime($desafio['hora']));

            $desafioModelo = new DesafioModel();

            if ($this->request->getPost('id')) {
                $desafio['id'] = $this->request->getPost('id');
                $desafioModelo->update($this->request->getPost('id'), $desafio);
            }
            else {
                $desafioModelo->insert($desafio);
            }
        }
        return redirect()->to(base_url("/desafios"));
    }


    /*public function eliminarDesafio($id)
    {
        $desafioModel = new DesafioModel();
        $desafioModel->delete($id);
        return redirect()->to('/desafios');
    }*/

}