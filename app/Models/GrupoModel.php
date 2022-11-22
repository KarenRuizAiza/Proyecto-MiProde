<?php

namespace App\Models;

use CodeIgniter\Model;

class GrupoModel extends Model
{
    protected $table = 'grupo';
    protected $allowedFields = ['id', 'nombre'];
}
