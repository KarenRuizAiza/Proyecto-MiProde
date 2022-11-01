<?php

namespace App\Models;

use CodeIgniter\Model;

class FaseModel extends Model
{
    protected $table = 'fase';
    protected $allowedFields = ['id', 'nombre', 'fecha_inicio','fecha_fin', 'id_torneo'];
}