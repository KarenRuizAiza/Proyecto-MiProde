<?php

namespace App\Models;

use CodeIgniter\Model;

class TorneoModel extends Model
{
    protected $table = 'torneo';
    protected $allowedFields = ['id', 'nombre', 'descripcion', 'fecha_inicio','fecha_fin'];

<<<<<<< HEAD
    public function listarTorneosPorUsuario($id_usuario) {
        return $this->db->table('torneo t')
            ->select('t.*')
            ->join('fase f', 'f.id_torneo = t.id')
            ->join('apuesta a', 'a.id_fase = f.id')
            ->where('a.id_participante', $id_usuario)
            ->groupBy('t.id')
            ->get()
            ->getResultArray();
=======
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
>>>>>>> 353c15b961dc5b9b70bb952a008e6cc7bfd22909
    }
}
