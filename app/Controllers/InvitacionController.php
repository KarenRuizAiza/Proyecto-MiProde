<?php
namespace App\Controllers;

use App\Models\InvitacionModel;
use App\Models\DesafioParticipanteModel;
use App\Models\UsuarioModel;
use App\Models\TorneoModel;

use DateTime;

class InvitacionController extends BaseController
{
    public function index()
    {
        $invitacionModel = new InvitacionModel();

        $invitaciones = $invitacionModel->misInvitaciones($this->session->email);
        $data = array(
            'titulo' => 'Mis Invitaciones a Desafíos',
            'participante' => $this->session->usuarioId,
            'invitaciones' => $invitaciones,
        );
        return view('template/header') 
        . view('template/sidebar')
        . view('modules/invitaciones', $data) 
        . view('template/footer');
    }

    public function aceptarInvitacion($id)
    {
        $invitacionModel = new InvitacionModel();
        $desafioParticipanteModel = new DesafioParticipanteModel();

        $invitacion = $invitacionModel->find($id);

        if (!$invitacion) {
            return redirect()->back()->with('error', 'Invitación no encontrada');
        }
        
        $desafioParticipante = [
            'id_desafio' => $invitacion['id_desafio'],
            'id_participante' => $this->session->usuarioId,
        ];
        $desafioParticipanteModel->insert($desafioParticipante);

        $invitacionModel->update($id, [
            'estado' => 'ACEPTADA'
        ]);

        return redirect()->to(base_url("/invitaciones"))->with('success', 'Se ha aceptado la invitacion!');;
    }

    public function rechazarInvitacion($id)
    {
        $invitacionModel = new InvitacionModel();
        $invitacion = $invitacionModel->find($id);

        if (!$invitacion) {
            return redirect()->back()->with('error', 'Invitación no encontrada');
        }

        $invitacionModel->update($id, [
            'estado' => 'RECHAZADA'
        ]);
        return redirect()->to(base_url("/invitaciones"))->with('success', 'Se ha rechazado la invitacion!');;
    }
}