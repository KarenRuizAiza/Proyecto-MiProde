<?php

namespace App\Models;

use CodeIgniter\Model;

class EquipoModel extends Model
{
    protected $table = 'equipo';
    protected $allowedFields = ['id', 'nombre', 'id_grupo'];

    public function listarEquiposPorGrupo($id_grupo) {
    
        $builder = $this->db->table('equipo e');
        
        $builder->select('e.*, g.nombre nombre_grupo, g.id id_grupo')
        ->join('grupo g', 'g.id=e.id_grupo')
        ->where('e.id_grupo', $id_grupo);
        
        $results = $builder->get()->getResultArray();

        return $results;
    }
}
