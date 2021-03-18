<?php
include('../controller/CategoryController.php');
$categorias = new CategoryController();
?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Categorías - Lentes</h1>
</div>
<p class="text-muted">Bienvenido al módulo de categorías, acá puede realizar operaciones como agregar nuevos tipos de lentes, <br> ver la lista de categorías, actualizar datos de una categoría y eliminar una categoría del sistema.</p>

<div class="card shadow mb-4">
  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    <h6 class="m-0 font-weight-bold text-primary">Agregar un nuevo tipo de lente</h6>
  </div>
  <div class="card-body">
    <form action="" method="post">
      <div class="form-group">
        <label for="nombreLente">Titulo de la categoría</label>
        <input type="text" name="nombreLente" class="form-control" id="nombreLente" placeholder="Ej. Lentes de Sol">
      </div>
      <button type="submit" name="guardarLente" class="btn btn-info btn-block mt-3">Crear categoría</button>
    </form>
    <br>
    <?php
    // 1 => Lente, 2 => Marca, 3 => Enfermedad, 4 => Proveedor
    if (isset($_POST['guardarLente'])) {
      $data = array(
        'type' => 1,
        'name' => strtolower($_POST['nombreLente'])
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
    <section id="data" class="">
      <?php
        //$categorias->getAllCategoryInformation(1);
      ?>
    </section>
  </div>
</div>