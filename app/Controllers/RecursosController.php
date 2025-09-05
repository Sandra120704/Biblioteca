<?php
namespace App\Controllers;

use App\Models\Categoria;
use App\Models\Recursos;
use App\Models\Editoriales;
use App\Models\Subcategoria;

class RecursosController extends BaseController
{
    protected $recursoModel;
    protected $categoriaModel;
    protected $subcategoriaModel;
    protected $editorialModel;

    public function __construct()
    {
        $this->recursoModel = new Recursos();
        $this->categoriaModel = new Categoria();
        $this->subcategoriaModel = new Subcategoria();
        $this->editorialModel = new Editoriales();
    }

    // Vista listar
    public function index()
    {
        $recursos = $this->recursoModel
            ->select('recursos.*, e.editorial, c.categoria, s.subcategoria')
            ->join('editoriales e', 'recursos.ideditorial = e.ideditorial')
            ->join('subcategoria s', 'recursos.idsubcategoria = s.idsubcategoria')
            ->join('categoria c', 's.idcategoria = c.idcategoria')
            ->findAll();

        $datos['header'] = view('Layouts/header');
        $datos['footer'] = view('Layouts/footer');
        $datos['recursos'] = $recursos;

        return view('recursos/index', $datos);
    }

    // Vista registrar
    public function crear()
    {
        $datos['header'] = view('Layouts/header');
        $datos['footer'] = view('Layouts/footer');
        $categorias = $this->categoriaModel->findAll();
        $editoriales = $this->editorialModel->findAll();

        return view('recursos/crear', [
            'categorias' => $categorias,
            'editoriales' => $editoriales,
            'header' => $datos['header'],
            'footer' => $datos['footer']
        ]);
    }

    // Guardar recurso
    public function store()
    {
        $data = [
            'idsubcategoria' => $this->request->getPost('idsubcategoria'),
            'ideditorial'    => $this->request->getPost('ideditorial'),
            'tipo'           => $this->request->getPost('tipo'),
            'titulo'         => $this->request->getPost('titulo'),
            'apublicacion'   => $this->request->getPost('apublicacion'),
            'isbn'           => $this->request->getPost('isbn'),
            'numpaginas'     => $this->request->getPost('numpaginas'),
            'estado'         => $this->request->getPost('estado'),
        ];

        // Subida de portada
        $portada = $this->request->getFile('rutaportada');
        if ($portada && $portada->isValid()) {
            $nuevoNombre = $portada->getRandomName();
            $portada->move('uploads/portadas/', $nuevoNombre);
            $data['rutaportada'] = 'uploads/portadas/' . $nuevoNombre;
        }

        // Subida de recurso PDF (solo si tipo = DIGITAL)
        if ($this->request->getPost('tipo') === 'DIGITAL') {
            $pdf = $this->request->getFile('rutarecurso');
            if ($pdf && $pdf->isValid()) {
                $nuevoPDF = $pdf->getRandomName();
                $pdf->move('uploads/recursos/', $nuevoPDF);
                $data['rutarecurso'] = 'uploads/recursos/' . $nuevoPDF;
            }
        }

        $this->recursoModel->save($data);

        return redirect()->to(base_url('recursos'))->with('msg', 'Recurso registrado correctamente');
    }
}
