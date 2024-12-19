<?php
namespace App\Models;

use CodeIgniter\Model;

class DesafioModel extends Model
{
    protected $table = 'desafio';
    protected $allowedFields = ['id', 'nombre', 'id_torneo', 'fecha', 'hora', 'id_partido'];

    public function getDesafios()
    {
        return $this->findAll();
    }

    public function listarDesafiosPorUsuario($idUsuario)
    {
        return $this->db->table('desafio')
            ->select('desafio.*')
            ->join('desafio_participante', 'desafio.id = desafio_participante.id_desafio')
            ->where('desafio_participante.id_participante', $idUsuario)
            ->get()->getResultArray();
    }


    public function getInvitacionesByUsuario($idUsuario) {

        $builder = $this->db->table('invitacion_desafio');

        $builder->select('invitacion_desafio.*, desafio.nombre as nombre, desafio.fecha as desafio_fecha, desafio.hora as desafio_hora')
                ->join('desafio', 'invitacion_desafio.id_desafio = desafio.id')
                ->join('desafio_participante', 'desafio_participante.id_desafio = desafio.id')
                ->where('desafio_participante.id_participante', $idUsuario);

        $results = $builder->get()->getResultArray();

        return $results;
    }

}