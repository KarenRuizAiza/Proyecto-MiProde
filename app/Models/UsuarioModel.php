<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'usuario';
    protected $allowedFields = ['id', 'nombre', 'email','contraseña', 'rol', 'nombre_completo', 'apellido', 'dni', 'sfecha_nacimiento'];
}