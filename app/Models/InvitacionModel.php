<?php

namespace App\Models;

use CodeIgniter\Model;

class InvitacionModel extends Model
{
    protected $table = 'invitacion_desafio';
    protected $allowedFields = [
        'id',
        'id_desafio',
        'correo',
        'mensaje',
        'fecha',
        'estado'
    ];

    public function misInvitaciones($correoUsuario) {
      return $this->select('invitacion_desafio.*, desafio.nombre AS desafio')
        ->join('desafio', 'desafio.id = invitacion_desafio.id_desafio', 'left')
        ->where('invitacion_desafio.correo', $correoUsuario)
        ->where('invitacion_desafio.estado', 'PENDIENTE')
        ->orderBy('invitacion_desafio.fecha', 'ASC')
        ->findAll();
    }
}