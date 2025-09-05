<?= $header; ?>

<div class="container mt-4">
  <h3>Lista de Recursos</h3>
  <a href="<?= base_url('recursos/crear'); ?>" class="btn btn-primary">Nuevo Recurso</a>
  <table class="table table-bordered table-striped mt-3">
    <thead class="table-dark">
      <tr>
        <th>#</th>
        <th>Título</th>
        <th>Categoría</th>
        <th>Subcategoría</th>
        <th>Editorial</th>
        <th>Año</th>
        <th>ISBN</th>
        <th>Estado</th>
        <th>Portada</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($recursos as $r): ?>
        <tr>
          <td><?= $r['idrecurso'] ?></td>
          <td><?= $r['titulo'] ?></td>
          <td><?= $r['categoria'] ?></td>
          <td><?= $r['subcategoria'] ?></td>
          <td><?= $r['editorial'] ?></td>
          <td><?= $r['apublicacion'] ?></td>
          <td><?= $r['isbn'] ?></td>
          <td><?= $r['estado'] ?></td>
          <td>
            <?php if (!empty($r['rutaportada'])): ?>
                <img src="<?= base_url($r['rutaportada']) ?>" alt="Portada" width="60">
            <?php else: ?>
                <span class="text-muted">Sin portada</span>
            <?php endif; ?> 
        </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>


<?= $footer; ?>