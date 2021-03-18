<?php
include('../controller/CategoryController.php');
$categorias = new CategoryController();
?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Armazones - Proveedores</h1>
</div>
<p class="text-muted">Bienvenido al módulo de armazones, acá puede realizar operaciones como agregar nuevos proveedores, <br> ver la lista de armazones, actualizar datos y eliminar una categoría del sistema.</p>

<div class="card shadow mb-4">
  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    <h6 class="m-0 font-weight-bold text-primary">Agregar un nuevo proveedor</h6>
  </div>
  <div class="card-body">
    <form action="" method="post">
      <div class="form-group">
        <label for="nombreProveedor">Titulo de la categoría</label>
        <input type="text" name="nombreProveedor" class="form-control" id="nombreProveedor" placeholder="Escribe aquí el nombre del proveedor">
      </div>
      <button type="submit" name="guardarProveedor" class="btn btn-info btn-block mt-3">Guardar Proveedor</button>
    </form>
    <br>
    <?php
    // 1 => Lente, 2 => Marca, 3 => Enfermedad, 4 => Proveedor
    if (isset($_POST['guardarProveedor'])) {
      $data = array(
        'type' => 4,
        'name' => strtolower($_POST['nombreProveedor'])
      );
      $categorias->createNewCategory($data);
    }
    ?>
  </div>
</div>

<div class="card shadow mb-4">
  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    <h6 class="m-0 font-weight-bold text-primary">Listado de proveedores</h6>
  </div>

  <div class="card-body">
    <section id="data" class="">
      <?php
        //$categorias->getAllCategoryInformation(4);
      ?>
    </section>
  </div>
</div>