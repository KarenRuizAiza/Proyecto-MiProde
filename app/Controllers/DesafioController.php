<?php
namespace App\Controllers;

use App\Models\DesafioModel;
use App\Models\InvitacionModel;
use App\Models\UsuarioModel;
use App\Models\TorneoModel;

use DateTime;

class DesafioController extends BaseController
{
    public function index()
    {
        $desafioModel = new DesafioModel();
        $torneoModel = new TorneoModel();
        
        $torneos = $torneoModel->findAll();

        $desafios = $desafioModel->listarInvitacionesPorUsuario();
        $data = array(
            'titulo' => 'Desafíos',
            'participante' => $this->session->usuarioId,
            'desafios' => $desafios,
            'torneos' => $torneos
        );
        return view('template/header') 
        . view('template/sidebar')
        . view('modules/desafios', $data) 
        . view('template/footer');
    }


    public function misDesafios()
    {
        $desafioModel = new DesafioModel();
        $torneoModel = new TorneoModel();

        $torneos = $torneoModel->where('fecha_inicio >', date('Y-m-d'))->findAll();

        $desafios = $desafioModel->listarDesafiosPorUsuario($this->session->usuarioId);
        $data = array(
            'titulo' => 'Lista de Desafios' ,
            'participante' => $this->session->usuarioId,
            'desafios' => $desafios,
            'torneos' => $torneos
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
                'id_torneo' => $this->request->getPost('torneo'),
                'nombre' => $this->request->getPost('nombre'),
                //'fecha' => DateTime::createFromFormat("d/m/Y", $this->request->getPost('fecha'))->format('Y-m-d'),
                //'hora' => $this->request->getPost('hora'),
                'id_creador' => $this->session->usuarioId
            ];

            $desafioModelo = new DesafioModel();

            if ($this->request->getPost('id')) {
                $desafio['id'] = $this->request->getPost('id');
                $desafioModelo->update($this->request->getPost('id'), $desafio);
            }
            else {
                $desafioModelo->insert($desafio);
            }
        }
        return redirect()->to(base_url("/desafios"))->with('success', 'Desafio creado correctamente!');
    }


    /*public function eliminarDesafio($id)
    {
        $desafioModel = new DesafioModel();
        $desafioModel->delete($id);
        return redirect()->to('/desafios');
    }*/

    public function eliminarDesafio($id)
    {
        $desafioModel = new DesafioModel();

        if ($desafioModel->find($id)) {
            $desafioModel->delete($id);
            return redirect()->to(base_url("/desafios"))->with('success', 'Desafio eliminado!');
        }

        return redirect()->to(base_url('desafios'))
                        ->with('error', 'Desafío no encontrado');
    }

    public function enviarInvitaciones()
    {
        $desafioModel = new DesafioModel();
        $invitacionModel = new InvitacionModel();

        $idDesafio = $this->request->getPost('idDesafio');        
        $emailsString = $this->request->getPost('emails');
        $mensaje = $this->request->getPost('mensaje');

        $emails = explode(',', $emailsString);

        foreach ($emails as $correo) {

            // optional: validate email
            if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                continue; // skip invalid emails
            }

            $exists = $invitacionModel
                ->where('id_desafio', $idDesafio)
                ->where('correo', $correo)
                ->whereIn('estado', ['PENDIENTE', 'ACEPTADA'])
                ->first();

            if (!$exists) {
                $email = \Config\Services::email();

                $email->setTo($correo);
                $email->setSubject('Invitación al desafío');

                $email->setMessage("
                    <h3>¡Te invitaron a un desafío!</h3>
                    <p>Ingresá a la app para participar. si no tienes usuario, registrate!</p>
                ");

                $data = [
                    'id_desafio' => $idDesafio,
                    'correo'     => $correo,
                    'mensaje'    => $mensaje,
                    'fecha'      => date('Y-m-d'),
                    'estado'     => 'PENDIENTE'
                ];
                $invitacionModel->insert($data);
                $email->send();
            }
        }
        return redirect()->to(base_url('desafios'))->with('success', 'Invitaciones enviadas');    
    }

    public function desafioSeleccionado($id = null)
    {
        $desafioModel = new DesafioModel();
        $torneoModel = new TorneoModel();
        
        $desafios = $desafioModel->listarDesafiosPorUsuario($this->session->usuarioId);

        $desafioEditar = $desafioModel->find($id);
        
        $torneos = $torneoModel->where('fecha_inicio >', date('Y-m-d'))->findAll();

        $data = array(
            'titulo' => 'Editar desafio',
            'participante' => $this->session->usuarioId,
            'desafios' => $desafios,
            'listado' => false,
            'desafioEditar' => $desafioEditar,
            'torneos' => $torneos,
        );

        return view('template/header')
            . view('template/sidebar')
            . view('modules/desafios', $data)
            . view('template/footer');
    }
    

}