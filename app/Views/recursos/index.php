<?= $header; ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Lista de Recursos</h3>
        <a href="<?= base_url('recursos/crear'); ?>" class="btn btn-primary">Nuevo Recurso</a>
    </div>

    <table class="table table-bordered table-striped mt-3">
        <thead class="table-primary">
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
                <th>PDF</th>
                <th>Acciones</th>
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
                    <td>
                        <?php if($r['tipo'] === 'DIGITAL' && !empty($r['rutarecurso'])): ?>
                            <a href="<?= base_url($r['rutarecurso']) ?>" target="_blank" class="btn btn-sm btn-info">📄 Ver PDF</a>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?= base_url('recursos/editar/'.$r['idrecurso']) ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="<?= base_url('recursos/eliminar/'.$r['idrecurso']) ?>" 
                           class="btn btn-sm btn-danger" 
                           onclick="return confirm('¿Está seguro de eliminar este recurso?');">
                           Eliminar
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $footer; ?>
