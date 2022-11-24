<?php

namespace App\Models;
use CodeIgniter\Model;

class PartidoModel extends Model
{
    protected $table = 'partido';
    protected $allowedFields = ['id', 'fecha', 'hora', 'id_equipo_local', 'id_equipo_visitante', 'id_fase', 'id_grupo'];

    public function listarPorFase($id_fase, $id_usuario) {

        $builder = $this->db->table('partido p');

        $builder->select('p.*, f.nombre nombre_fase, f.id id_fase, l.nombre local, v.nombre visitante, g.nombre grupo, pr.resultado resultado_prediccion')
            ->join('fase f', 'p.id_fase = f.id')
            ->join('equipo l', 'p.id_equipo_local = l.id')
            ->join('equipo v', 'p.id_equipo_visitante = v.id')
            ->join('grupo g', 'p.id_grupo = g.id')
            ->join('prediccion pr', 'pr.id_partido = p.id', 'left')
            ->join('apuesta a', 'a.id_fase = p.id_fase')
            ->join('usuario u', 'u.id = a.id_participante')
            ->where('u.id', $id_usuario)
            ->where('p.id_fase', $id_fase);

        $results = $builder->get()->getResultArray();

        return $results;
    }

    public function partidoPorFase($id_partido, $id_fase) {

        $builder = $this->db->table('partido p');

        $builder->select('p.*, f.nombre nombre_fase, f.id id_fase, l.nombre local, v.nombre visitante, g.nombre grupo')
            ->join('fase f', 'p.id_fase = f.id')
            ->join('equipo l', 'p.id_equipo_local = l.id')
            ->join('equipo v', 'p.id_equipo_visitante = v.id')
            ->join('grupo g', 'p.id_grupo = g.id')
            ->where('p.id', $id_partido)
            ->where('p.id_fase', $id_fase);

        $results = $builder->get()->getResultArray();

        return $results;
    }

}
