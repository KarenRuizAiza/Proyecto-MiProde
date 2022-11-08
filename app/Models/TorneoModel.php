<?php

namespace App\Models;

use CodeIgniter\Model;

class TorneoModel extends Model
{
    protected $table = 'torneo';
    protected $allowedFields = ['id', 'nombre', 'descripcion', 'fecha_inicio','fecha_fin'];

    public function obtenerTorneo($dato) {
    
        $builder = $this->db->table('torneo t');
        
        $builder->select('t.nombre nombreTorneo, t.id torneo_id')
        ->join('fase f', 't.id = f.id_torneo')
        ->where('t.id', $dato);
        
        $resultado = $builder->get()->getCustomResultObject(Torneo::class);

        return $resultado;
    }
}
