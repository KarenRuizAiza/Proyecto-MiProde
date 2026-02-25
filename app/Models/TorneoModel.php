<?php

namespace App\Models;

use CodeIgniter\Model;

class TorneoModel extends Model
{
    protected $table = 'torneo';
    protected $allowedFields = ['id', 'nombre', 'descripcion', 'fecha_inicio', 'fecha_fin'];

    /**
     * Retorna todos los torneos donde el usuario tiene apuestas (Histórico)
     */
    public function listarPorUsuario($id_usuario)
    {
        $sql = "
        SELECT DISTINCT t.*
        FROM torneo t
        JOIN fase f ON f.id_torneo = t.id
        JOIN partido p ON p.id_fase = f.id
        JOIN prediccion pr ON pr.id_partido = p.id
        JOIN apuesta a ON a.id = pr.id_apuesta
        WHERE a.id_participante = ?
        ORDER BY t.fecha_inicio DESC;";

        return $this->db->query($sql, [$id_usuario])->getResultArray();
    }

    /**
     * Retorna solo los torneos vigentes donde el usuario tiene apuestas (Para la Home)
     */
    public function listarVigentesConPredicciones($id_usuario)
    {
        $today = date('Y-m-d');
        $sql = "
        SELECT DISTINCT t.*
        FROM torneo t
        JOIN fase f ON f.id_torneo = t.id
        JOIN partido p ON p.id_fase = f.id
        JOIN prediccion pr ON pr.id_partido = p.id
        JOIN apuesta a ON a.id = pr.id_apuesta
        WHERE a.id_participante = ? 
        AND t.fecha_fin >= ?
        ORDER BY t.fecha_inicio DESC;";

        return $this->db->query($sql, [$id_usuario, $today])->getResultArray();
    }
}
