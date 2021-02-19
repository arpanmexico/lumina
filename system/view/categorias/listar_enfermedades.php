<?php
include('../controller/CategoryController.php');
$categorias = new CategoryController();
?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Categorías - Enfermedades</h1>
</div>
<p class="text-muted">Bienvenido al módulo de categorías, acá puede realizar operaciones como agregar nuevas enfermedades para ser usadas en los pacientes, <br> ver la lista de enfermedades y eliminar opciones del sistema.</p>

<div class="card shadow mb-4">
  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    <h6 class="m-0 font-weight-bold text-primary">Agregar una nueva enfermedad</h6>
  </div>
  <div class="card-body">
    <form action="" method="post">
      <div class="form-group">
        <label for="enfermedad">Titulo de la enfermedad</label>
        <input type="text" name="enfermedad" class="form-control" id="enfermedad" placeholder="Ej. Levis">
      </div>
      <button type="submit" name="guardarEnfermedad" class="btn btn-info btn-block mt-3">Agregar Marca</button>
    </form>
    <br>
    <?php
    // 1 => Lente, 2 => Marca, 3 => Enfermedad
    if (isset($_POST['guardarEnfermedad'])) {
      $data = array(
        'type' => 3,
        'name' => strtolower($_POST['enfermedad'])
      );
      $categorias->createNewCategory($data);
    }
    ?>
  </div>
</div>

<div class="card shadow mb-4">
  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    <h6 class="m-0 font-weight-bold text-primary">Listado de enfermedades</h6>
  </div>

  <div class="card-body">
    <section class="row">
      <?php
      $categorias->getAllCategoryInformation(3);
      ?>
    </section>
  </div>
</div>