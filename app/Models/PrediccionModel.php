<?php

namespace App\Models;

use CodeIgniter\Model;

class PrediccionModel extends Model
{
    protected $table = 'prediccion';
    protected $allowedFields = ['id', 'resultado', 'id_partido', 'id_apuesta'];

    public function existePrediccion($id_partido, $id_apuesta) {

        $builder = $this->db->table('prediccion p');

        $builder->select('p.*')
            ->where('p.id_partido', $id_partido)
            ->where('p.id_apuesta', $id_apuesta);

        $results = $builder->get()->getResultArray();

        return $results;
    }


}
