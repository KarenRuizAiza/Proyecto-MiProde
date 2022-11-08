<?php

namespace App\Models;

use CodeIgniter\Model;

class TorneoModel extends Model
{
    protected $table = 'partido';
    protected $allowedFields = ['id', 'fecha', 'hora'];
}