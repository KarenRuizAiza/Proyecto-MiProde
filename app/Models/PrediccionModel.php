<?php

namespace App\Models;

use CodeIgniter\Model;

class PrediccionModel extends Model
{
    protected $table = 'prediccion';
    protected $allowedFields = ['id', 'resultado', 'id_equipo_local', 'id_equipo_visitante','id_partido', 'id_apuesta'];

    public function existePrediccion($id_partido, $id_apuesta) {

        $builder = $this->db->table('prediccion p');

        $builder->select('p.*')
            ->where('p.id_partido', $id_partido)
            ->where('p.id_apuesta', $id_apuesta);

        $results = $builder->get()->getResultArray();

        return $results;
    }

    public function listarPorUsuario($id_usuario) {

        $sql = "
        SELECT pr.*, t.nombre as nombre_torneo, f.nombre AS nombre_fase, el.nombre AS equipo_local_prediccion, ev.nombre AS equipo_visitante_prediccion
        FROM `prediccion` pr
        LEFT JOIN `apuesta` a ON pr.id_apuesta = a.id
        LEFT JOIN `fase` f ON a.id_fase = f.id
        LEFT JOIN `equipo` el ON pr.id_equipo_local = el.id
        LEFT JOIN `equipo` ev ON pr.id_equipo_visitante = ev.id
        LEFT JOIN `torneo` t ON f.id_torneo = t.id
        WHERE a.id_participante = ".$id_usuario."
        ORDER by f.fecha_inicio DESC, pr.id;";

        $builder = $this->db->query($sql);


        $results = $builder->getResultArray();

        return $results;
    }

}
