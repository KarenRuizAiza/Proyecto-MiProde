<?php

namespace App\Models;

use CodeIgniter\Model;

class ApuestaModel extends Model
{
    protected $table = 'apuesta';
    protected $allowedFields = ['id', 'fecha_creacion', 'id_participante', 'id_fase'];

    public function existeApuesta($id_participante, $id_fase) {

        $builder = $this->db->table('apuesta a');

        $builder->select('a.*')
            ->where('a.id_participante', $id_participante)->where('a.id_fase', $id_fase);

        $results = $builder->get()->getResultArray();

        return $results;
    }

}
