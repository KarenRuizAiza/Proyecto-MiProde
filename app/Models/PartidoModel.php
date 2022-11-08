<?php

namespace App\Models;

use CodeIgniter\Model;

class TorneoModel extends Model
{
    protected $table = 'partido';
    protected $allowedFields = ['id', 'fecha', 'hora'];

    public function partidosListarTodos() {
        query = $this->db->table('partidos p'){
            
        }
    }
}