<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\SubcategoriaModel;

class Subcategoria extends BaseController
{
    public function getSubcategoriaByCategoria($idcategoria = "")
    {
        $this->response->setContentType('application/json');

        $subcategoriaModel = new SubcategoriaModel();
        $listaSubcategoria = $subcategoriaModel->where('idcategoria', $idcategoria)->findAll();
        return $this->response->setJSON($listaSubcategoria);
    }
}
