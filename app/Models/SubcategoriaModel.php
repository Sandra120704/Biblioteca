<?php

namespace App\Models;
use CodeIgniter\Model;

class SubcategoriaModel extends Model{
    protected $table = 'subCategoria';
    protected $primaryKey = 'idsubcategoria';
    protected $allowedFields = ['subcategoria','idcategoria'];
}