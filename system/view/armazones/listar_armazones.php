<?php
include('../controller/CategoryController.php');
$categorias = new CategoryController();
?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Productos - Catálogo</h1>
</div>
<p class="text-muted">Bienvenido al módulo de productos, acá puede realizar operaciones como agregar nuevos proveedores y productos, <br> ver la lista de produtcos, actualizar datos y eliminar productos y/o categorias del sistema.</p>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">ACCIONES <i class="fas fa-arrow-right ml-2 mr-2"></i>
        <a class="btn btn-info" href="?crearArmazon"><i class="fas fa-plus-circle"></i> Crear Nuevo Producto</a> 
        <a href="?armazonesSuspendidos" class="btn btn-warning"><i class="fas fa-trash-alt"></i> Recuperar Productos</a>
        </h6>
    </div>
    <div class="card-body">
    <h6 id="search-title" class="text-muted"></h6>
    <section id="search" class="mb-5"></section>
    <div id="data" class="">
    </div>
    </div>
</div>
 