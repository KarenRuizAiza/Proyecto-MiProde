<?php

namespace App\Models;

use CodeIgniter\Model;

class DesafioParticipanteModel extends Model
{
    protected $table = 'desafio_participante';
    protected $allowedFields = [
        'id',
        'id_desafio',
        'id_participante',
        'puntos'
    ];
}