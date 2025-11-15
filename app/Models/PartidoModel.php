<?php

namespace App\Models;
use CodeIgniter\Model;

class PartidoModel extends Model
{
    protected $table = 'partido';
    protected $allowedFields = ['id', 'fecha', 'hora', 'id_equipo_local', 'id_equipo_visitante', 'id_fase', 'id_grupo', 'resultado'];

    public function listarPorFase($id_fase) {

        $builder = $this->db->table('partido p');

        $builder->select('p.*, f.nombre nombre_fase, f.id id_fase, l.nombre local, v.nombre visitante, g.nombre grupo, pr.resultado resultado_prediccion')
            ->join('fase f', 'p.id_fase = f.id')
            ->join('equipo l', 'p.id_equipo_local = l.id', 'left')
            ->join('equipo v', 'p.id_equipo_visitante = v.id', 'left')
            ->join('grupo g', 'p.id_grupo = g.id', 'left')
            ->join('prediccion pr', 'pr.id_partido = p.id', 'left')
            ->where('p.id_fase', $id_fase);

        $results = $builder->get()->getResultArray();

        return $results;
    }
    public function listarPorFaseConApuestas($id_fase, $id_usuario) {

        $sql = "
        SELECT p.*, 
            f.nombre AS nombre_fase, 
            f.id AS id_fase, 
            f.fecha_inicio AS inicio_fase,
            l.nombre AS local, 
            v.nombre AS visitante,
            g.id AS id_grupo, 
            g.nombre AS grupo, 
            pr.id AS id_prediccion,
            pr.resultado AS resultado_prediccion,
            lp.nombre AS local_prediccion,
            vp.nombre AS visitante_prediccion,
            CASE 
             	WHEN pr.resultado = p.resultado and ((pr.id_equipo_local is null and pr.id_equipo_visitante is null) or (pr.id_equipo_local = p.id_equipo_local and pr.id_equipo_visitante = p.id_equipo_visitante)) then 1 else 0
            END as acerto_prediccion
        FROM `partido` p 
        JOIN `fase` f ON p.id_fase = f.id
        LEFT JOIN `equipo` l ON p.id_equipo_local = l.id
        LEFT JOIN `equipo` v ON p.id_equipo_visitante = v.id
        LEFT JOIN `grupo` g ON p.id_grupo = g.id
        LEFT JOIN `prediccion` pr ON pr.id_partido = p.id AND pr.id IN (
            SELECT pr1.id
            FROM `prediccion` pr1
            LEFT JOIN `apuesta` a1 ON a1.id = pr1.id_apuesta
            WHERE a1.id_participante = ".$id_usuario."
        )
        LEFT JOIN `equipo` lp ON pr.id_equipo_local = lp.id
        LEFT JOIN `equipo` vp ON pr.id_equipo_visitante = vp.id
        WHERE p.id_fase = ".$id_fase."
        order by g.id, p.fecha, p.hora;";

        $builder = $this->db->query($sql);


        $results = $builder->getResultArray();

        return $results;
    }

    public function partidoPorFase($id_partido, $id_fase) {

        $builder = $this->db->table('partido p');

        $builder->select('p.*, f.nombre nombre_fase, f.id id_fase, l.nombre local, v.nombre visitante, g.nombre grupo')
            ->join('fase f', 'p.id_fase = f.id')
            ->join('equipo l', 'p.id_equipo_local = l.id', 'left')
            ->join('equipo v', 'p.id_equipo_visitante = v.id', 'left')
            ->join('grupo g', 'p.id_grupo = g.id', 'left')
            ->where('p.id', $id_partido)
            ->where('p.id_fase', $id_fase);

        $results = $builder->get()->getResultArray();

        return $results;
    }

    public function partidos() {

        $builder = $this->db->table('partido p');

        $builder->select('p.*, f.nombre nombre_fase, f.id id_fase, l.nombre local, v.nombre visitante, g.nombre grupo')
            ->join('fase f', 'p.id_fase = f.id')
            ->join('equipo l', 'p.id_equipo_local = l.id')
            ->join('equipo v', 'p.id_equipo_visitante = v.id')
            ->join('grupo g', 'p.id_grupo = g.id');

        $results = $builder->get()->getResultArray();

        return $results;
    }

}
