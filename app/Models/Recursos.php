<?php

namespace App\Models;
use CodeIgniter\Model;

class Recursos extends Model{
    protected $table = 'recursos';
    protected $primaryKey = 'idrecursos';
    protected $allowedFields = [
        'idsubcategoria',
        'ideditorial',
        'tipo',
        'titulo',
        'apublicacion',
        'isbn',
        'numpaginas',
        'rutaportada',
        'rutarecursos',
        'estado',
        'creado',
        'modificado'
    ];
}