<?php

namespace App\Models;
use CodeIgniter\Model;

class FaseModel extends Model
{
    protected $table = 'fase';
    protected $allowedFields = ['id', 'nombre', 'fecha_inicio','fecha_fin', 'id_torneo'];

    public function listarFasesPorTorneo($id_torneo) {
    
        $builder = $this->db->table('fase f');
        
        $builder->select('f.*, t.nombre nombre_torneo, t.id id_torneo')
        ->join('torneo t', 't.id=f.id_torneo')
        ->where('f.id_torneo', $id_torneo);
        
        $results = $builder->get()->getResultArray();

        return $results;
    }
   
}