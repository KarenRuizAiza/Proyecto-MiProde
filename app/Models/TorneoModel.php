<?php

namespace App\Models;

use CodeIgniter\Model;

class TorneoModel extends Model
{
    protected $table = 'torneo';
    protected $allowedFields = ['id', 'nombre', 'descripcion', 'fecha_inicio','fecha_fin'];

    public function listarTorneosPorUsuario($id_usuario) {
        return $this->db->table('torneo t')
            ->select('t.*')
            ->join('fase f', 'f.id_torneo = t.id')
            ->join('apuesta a', 'a.id_fase = f.id')
            ->where('a.id_participante', $id_usuario)
            ->groupBy('t.id')
            ->get()
            ->getResultArray();
    }
}
