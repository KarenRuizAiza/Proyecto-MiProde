<?php

namespace App\Models;

use CodeIgniter\Model;

class ParticipanteModel extends Model
{
    protected $table = 'usuario';
    protected $allowedFields = ['id_usuario', 'nombre_usuario', 'id_torneo', 'nombre_torneos','puntaje'];

    public function listarPorTorneo($id_torneo) {

        $sql = "
        SELECT 
            u.id AS id_usuario,
            u.nombre AS nombre_usuario,
            f.id_torneo AS id_torneo, 
            t.nombre AS nombre_torneo, 
            SUM(
                CASE 
                    WHEN pr.resultado = p.resultado and (
                        (pr.id_equipo_local is null and pr.id_equipo_visitante is null) 
                        or 
                        (pr.id_equipo_local = p.id_equipo_local and pr.id_equipo_visitante = p.id_equipo_visitante)
                    ) 
                    THEN 1 
                    else 0 
                END
            ) AS puntaje
        FROM `partido` p 
        JOIN `fase` f ON p.id_fase = f.id JOIN `torneo` t ON f.id_torneo = t.id
        LEFT JOIN `equipo` l ON p.id_equipo_local = l.id
        LEFT JOIN `equipo` v ON p.id_equipo_visitante = v.id
        JOIN `prediccion` pr ON pr.id_partido = p.id
        JOIN `apuesta` a ON a.id = pr.id_apuesta
        LEFT JOIN usuario u on u.id = a.id_participante
        WHERE f.id_torneo = $id_torneo
        GROUP by u.id
        ORDER by puntaje DESC;";

        $builder = $this->db->query($sql);

        $results = $builder->getResultArray();

        return $results;
    }

    public function listarPorDesafio($id_desafio)
    {
        $sql = "
        SELECT 
            u.id AS id_usuario, 
            u.nombre AS nombre_usuario, 
            d.id AS id_desafio,
            d.nombre AS nombre_desafio,
            SUM(
                CASE 
                    WHEN pr.resultado = p.resultado 
                    AND (
                        (pr.id_equipo_local IS NULL AND pr.id_equipo_visitante IS NULL) 
                        OR 
                        (pr.id_equipo_local = p.id_equipo_local 
                        AND pr.id_equipo_visitante = p.id_equipo_visitante)
                    ) 
                    THEN 1 
                    ELSE 0 
                END
            ) AS puntaje

        FROM partido p
        JOIN fase f ON p.id_fase = f.id
        JOIN torneo t ON f.id_torneo = t.id
        JOIN desafio d ON d.id_torneo = t.id

        JOIN prediccion pr ON pr.id_partido = p.id
        JOIN apuesta a ON a.id = pr.id_apuesta
        LEFT JOIN usuario u ON u.id = a.id_participante
        LEFT JOIN desafio_participante dp ON dp.id_participante = u.id AND dp.id_desafio = d.id

        WHERE d.id = ?
        AND (
            dp.id_participante IS NOT NULL
            OR u.id = d.id_creador
        )

        GROUP BY u.id
        ORDER BY puntaje DESC
        ";

        $query = $this->db->query($sql, [$id_desafio]);

        return $query->getResultArray();
    }

}