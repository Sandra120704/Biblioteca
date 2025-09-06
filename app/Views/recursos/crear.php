<?= $header; ?>

<style>
  .form-control,
  .form-select:focus {
    background-color: beige;
  }
</style>

<div class="container mt-2">
  <div class="my-2">
    <h3>Registrar Recurso</h3>
    <a href="<?= base_url('recursos'); ?>" class="btn btn-secondary mb-3">← Volver a lista</a>
  </div>

  <form action="<?= base_url('recursos/store'); ?>" method="post" enctype="multipart/form-data" id="formRecurso">
    <div class="card">
      <div class="card-body">
        <div class="row g-3">
          <!-- Categoría y Subcategoría -->
          <div class="col-md-6">
            <label for="categorias" class="form-label">Categoría</label>
            <select id="categorias" name="categoria" class="form-select" required>
              <option value="">Seleccione categoría</option>
              <?php foreach($categorias as $c): ?>
                <option value="<?= $c['idcategoria'] ?>"><?= $c['categoria'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-6">
            <label for="subcategorias" class="form-label">Subcategoría</label>
            <select id="subcategorias" name="idsubcategoria" class="form-select" required>
              <option value="">Seleccione subcategoría</option>
            </select>
          </div>

          <!-- Editorial y Tipo -->
          <div class="col-md-6">
            <label for="ideditorial" class="form-label">Editorial</label>
            <select name="ideditorial" id="ideditorial" class="form-select" required>
              <option value="">Seleccione editorial</option>
              <?php foreach ($editoriales as $ed): ?>
                <option value="<?= $ed['ideditorial'] ?>"><?= $ed['editorial'] ?> (<?= $ed['nacionalidad'] ?>)</option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-6">
            <label for="tipo" class="form-label">Tipo</label>
            <select name="tipo" id="tipo" class="form-select" required>
              <option value="">Seleccione tipo</option>
              <option value="FISICO">Físico</option>
              <option value="DIGITAL">Digital</option>
            </select>
          </div>

          <!-- Título -->
          <div class="col-12">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" name="titulo" id="titulo" class="form-control" required>
          </div>

          <!-- Año, ISBN y Nro. Páginas -->
          <div class="col-md-4">
            <label for="apublicacion" class="form-label">Año publicación</label>
            <input type="number" name="apublicacion" id="apublicacion" class="form-control" min="1900" max="<?= date('Y'); ?>" required>
          </div>
          <div class="col-md-4">
            <label for="isbn" class="form-label">ISBN</label>
            <input type="text" name="isbn" id="isbn" class="form-control" required>
          </div>
          <div class="col-md-4">
            <label for="numpaginas" class="form-label">Nro. Páginas</label>
            <input type="number" name="numpaginas" id="numpaginas" class="form-control" required>
          </div>

          <!-- Estado -->
          <div class="col-md-6">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" id="estado" class="form-select" required>
              <option value="">Seleccione estado</option>
              <option value="BUENO">Bueno</option>
              <option value="REGULAR">Regular</option>
              <option value="MALO">Malo</option>
            </select>
          </div>

          <!-- Portada y PDF -->
          <div class="col-md-6">
            <label for="rutaportada" class="form-label">Portada (imagen)</label>
            <input type="file" name="rutaportada" id="rutaportada" class="form-control" accept="image/*" required>
          </div>
          <div class="col-md-6" id="campoPdf" style="display:none;">
            <label for="rutarecurso" class="form-label">Recurso PDF</label>
            <input type="file" name="rutarecurso" id="rutarecurso" class="form-control" accept="application/pdf">
          </div>
        </div>
      </div>

      <div class="card-footer text-end">
        <button type="submit" class="btn btn-success">Guardar</button>
      </div>
    </div>
  </form>
</div>

<?= $footer; ?>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// JS permanece igual que antes
const categorias = document.querySelector('#categorias');
const subcategorias = document.querySelector('#subcategorias');
const tipo = document.querySelector('#tipo');
const campoPdf = document.querySelector('#campoPdf');
const formulario = document.querySelector('#formRecurso');

tipo.addEventListener('change', () => {
  campoPdf.style.display = (tipo.value === 'DIGITAL') ? 'block' : 'none';
  if(tipo.value !== 'DIGITAL') document.querySelector('#rutarecurso').value = '';
});

categorias.addEventListener('change', async () => {
  const idcat = categorias.value;
  subcategorias.innerHTML = `<option value="">Seleccione subcategoría</option>`;
  if (!idcat) return;

  try {
    const response = await fetch(`<?= base_url() ?>api/subcategoria/${idcat}`);
    const data = await response.json();
    if(data.length === 0){
      Swal.fire({icon:'info', text:'No hay subcategorías para esta categoría', toast:true, position:'top-end', timer:3000, showConfirmButton:false});
    }
    data.forEach(sc => {
      subcategorias.innerHTML += `<option value="${sc.idsubcategoria}">${sc.subcategoria}</option>`;
    });
  } catch (err) {
    console.error("Error cargando subcategorías:", err);
  }
});

formulario.addEventListener('submit', (e) => {
  e.preventDefault();
  if(categorias.value === '' || subcategorias.value === '' || tipo.value === ''){
    Swal.fire('Error','Por favor complete todos los campos requeridos','error');
    return;
  }
  Swal.fire({
    title: 'Guardar Recurso',
    text: '¿Desea guardar este recurso?',
    icon: 'question',
    showCancelButton: true,
    confirmButtonText: 'Aceptar',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if(result.isConfirmed){
      formulario.submit();
    }
  });
});
</script>
