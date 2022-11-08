<?php

namespace App\Models;

use CodeIgniter\Model;

class EquipoModel extends Model
{
    protected $table = 'equipo';
    protected $allowedFields = ['id', 'nombre', 'mundiales_ganados', 'ranking_fifa','mundiales_jugados'];
}
