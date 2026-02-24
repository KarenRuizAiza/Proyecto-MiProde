<?php

namespace App\Models;

use CodeIgniter\Model;

class TorneoModel extends Model
{
    protected $table = 'torneo';
    protected $allowedFields = ['id', 'nombre', 'descripcion', 'fecha_inicio','fecha_fin'];

    public function listarPorUsuario($id_usuario) {

        $sql = "
        SELECT DISTINCT t.*
        FROM torneo t
        JOIN fase f ON f.id_torneo = t.id
        JOIN partido p ON p.id_fase = f.id
        JOIN prediccion pr ON pr.id_partido = p.id
        JOIN apuesta a ON a.id = pr.id_apuesta
        WHERE a.id_participante = ".$id_usuario."
        ORDER BY t.id DESC;";

        $builder = $this->db->query($sql);

        $results = $builder->getResultArray();

        return $results;
    }
}

