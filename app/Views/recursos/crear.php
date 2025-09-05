<?= $header; ?>

<div class="container mt-4">
  <h3>Registrar Recurso</h3>
  <form action="<?= base_url('recursos/store'); ?>" method="post" enctype="multipart/form-data" id="formRecurso">

    <div class="row">
      <div class="col-md-6 mb-3">
        <label for="categoria" class="form-label">Categoría</label>
        <select class="form-select" id="categoria" required>
          <option value="">Seleccione categoría</option>
          <?php foreach ($categorias as $cat): ?>
            <option value="<?= $cat['idcategoria'] ?>"><?= $cat['categoria'] ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-6 mb-3">
        <label for="idsubcategoria" class="form-label">Subcategoría</label>
        <select name="idsubcategoria" id="idsubcategoria" class="form-select" required>
          <option value="">Seleccione subcategoría</option>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 mb-3">
        <label for="ideditorial" class="form-label">Editorial</label>
        <select name="ideditorial" id="ideditorial" class="form-select" required>
          <option value="">Seleccione editorial</option>
          <?php foreach ($editoriales as $ed): ?>
            <option value="<?= $ed['ideditorial'] ?>"><?= $ed['editorial'] ?> (<?= $ed['nacionalidad'] ?>)</option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-6 mb-3">
        <label for="tipo" class="form-label">Tipo</label>
        <select name="tipo" id="tipo" class="form-select" required>
          <option value="">Seleccione tipo</option>
          <option value="FISICO">Físico</option>
          <option value="DIGITAL">Digital</option>
        </select>
      </div>
    </div>
    <div class="mb-3">
      <label for="titulo" class="form-label">Título</label>
      <input type="text" name="titulo" id="titulo" class="form-control" required>
    </div>
    <div class="row">
      <div class="col-md-4 mb-3">
        <label for="apublicacion" class="form-label">Año publicación</label>
        <input type="number" name="apublicacion" id="apublicacion" class="form-control" min="1900" max="2099" required>
      </div>
      <div class="col-md-4 mb-3">
        <label for="isbn" class="form-label">ISBN</label>
        <input type="text" name="isbn" id="isbn" class="form-control" required>
      </div>
      <div class="col-md-4 mb-3">
        <label for="numpaginas" class="form-label">Nro. Páginas</label>
        <input type="number" name="numpaginas" id="numpaginas" class="form-control" required>
      </div>
    </div>
    <div class="mb-3">
      <label for="estado" class="form-label">Estado</label>
      <select name="estado" id="estado" class="form-select" required>
        <option value="">Seleccione estado</option>
        <option value="BUENO">Bueno</option>
        <option value="REGULAR">Regular</option>
        <option value="MALO">Malo</option>
      </select>
    </div>
    <div class="row">
      <div class="col-md-6 mb-3">
        <label for="rutaportada" class="form-label">Portada (imagen)</label>
        <input type="file" name="rutaportada" id="rutaportada" class="form-control" accept="image/*" required>
      </div>
      <div class="col-md-6 mb-3" id="campoPdf" style="display:none;">
        <label for="rutarecurso" class="form-label">Recurso PDF</label>
        <input type="file" name="rutarecurso" id="rutarecurso" class="form-control" accept="application/pdf">
      </div>
    </div>
    <div class="text-end">
      <button type="submit" class="btn btn-success">Guardar</button>
    </div>

  </form>
</div>

<?= $footer; ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.getElementById('tipo').addEventListener('change', function() {
    document.getElementById('campoPdf').style.display = 
      this.value === 'DIGITAL' ? 'block' : 'none';
  });

  <?php if(session()->getFlashdata('msg')): ?>
    Swal.fire({
      icon: 'success',
      title: 'Éxito',
      text: '<?= session()->getFlashdata('msg') ?>'
    });
  <?php endif; ?>
</script>
