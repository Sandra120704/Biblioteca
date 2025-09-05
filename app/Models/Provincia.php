<?php

namespace App\Models;
use CodeIgniter\Model;

class Provincia extends Model{
    protected $table = 'provincias';
    protected $primarykey = 'idprovincia';
    protected $allowedFields = ['provincia','iddepartamento'];
}