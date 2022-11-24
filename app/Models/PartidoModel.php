<?php

namespace App\Models;
use CodeIgniter\Model;

class PartidoModel extends Model
{
    protected $table = 'partido';
    protected $allowedFields = ['id', 'fecha', 'hora', 'id_fase'];

    public function listarPorFase($id_fase) {

        $builder = $this->db->table('partido p');

        $builder->select('p.*, f.nombre nombre_fase, f.id id_fase')
            ->join('fase f', 'p.id_fase = f.id')
            ->where('p.id_fase', $id_fase);

        $results = $builder->get()->getResultArray();

        return $results;
    }

}