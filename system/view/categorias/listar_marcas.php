<?php
include('../controller/CategoryController.php');
$categorias = new CategoryController();
?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Categorías - Marcas</h1>
</div>
<p class="text-muted">Bienvenido al módulo de categorías, acá puede realizar operaciones como agregar nuevas marcas para lentes, <br> ver la lista de marcas y eliminar una  marca del sistema.</p>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Agregar una nueva marca</h6>
    </div>
    <div class="card-body">
        <form action="" method="post">
            <div class="form-group">
                <label for="marcaLente">Titulo de la categoría</label>
                <input type="text" name="marcaLente" class="form-control" id="marcaLente" placeholder="Ej. Levis">
            </div>
            <button type="submit" name="guardarMarca" class="btn btn-info btn-block mt-3">Agregar Marca</button>
        </form>
        <br>
        <?php
        // 1 => Lente, 2 => Marca, 3 => Enfermedad, 4 => Proveedor
        if (isset($_POST['guardarMarca'])) {
            $data = array(
                'type' => 2,
                'name' => strtolower($_POST['marcaLente'])
            );
            $categorias->createNewCategory($data);
        }
        ?>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Listado de categorías</h6>
    </div>

    <div class="card-body">
        <section class="row">
            <?php
            $categorias->getAllCategoryInformation(2);
            ?>
        </section>
    </div>
</div>