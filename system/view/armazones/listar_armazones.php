<?php
include('../controller/CategoryController.php');
$categorias = new CategoryController();
?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Armazones - Lista de Productos</h1>
</div>
<p class="text-muted">Bienvenido al módulo de armazones, acá puede realizar operaciones como agregar nuevos proveedores, <br> ver la lista de armazones, actualizar datos y eliminar una categoría del sistema.</p>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Ver todos los armazones - <a class="text-info" href="?crearArmazon">Crear Nuevo Producto</a> </h6>
    </div>
    <div class="card-body">
        <div class="row">
            <?php
                $categorias->getAllFramesInformacion();
            ?>
        </div>
    </div>
</div>
