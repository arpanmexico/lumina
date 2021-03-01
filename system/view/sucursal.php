<?php
include('../controller/BranchController.php');
$sucursal = new BranchController();

?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Sucursal</h1>
</div>
<p class="text-muted">Bienvenido al módulo de sucursales, acá puedes realizar operaciones como registrar los datos de su clínica <br> óptica y actualizar los datos cuando lo desee para que sean visibles en la página principal.</p>

<div class="card shadow mb-4">
  <!-- Card Header - Dropdown -->
  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    <h6 class="m-0 font-weight-bold text-primary">Datos de la Óptica</h6>
  </div>
  <div class="card-body">
    <section class="row text-center">
      <div class="col-lg-4 col-md-4 col-sm-12">
        <h5 class="font-weight-bolder">Nombre</h5>
        <p><?php echo $sucursal->getBranchInformation()['nombre']; ?></p>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12">
        <h5 class="font-weight-bolder">Dirección</h5>
        <p><?php echo $sucursal->getBranchInformation()['direccion']; ?></p>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12">
        <h5 class="font-weight-bolder">Teléfono</h5>
        <p><?php echo '+52 ' . $sucursal->getBranchInformation()['telefono_primario']; ?></p>
      </div>

      <div class="col-lg-4 col-md-4 col-sm-12 mt-3">
        <h5 class="font-weight-bolder">Teléfono Secundario</h5>
        <p><?php echo '+52 ' . $sucursal->getBranchInformation()['telefono_secundario']; ?></p>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12 mt-3">
        <h5 class="font-weight-bolder">Correo Electrónico</h5>
        <p><?php echo $sucursal->getBranchInformation()['correo']; ?></p>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12 mt-3">
        <h5 class="font-weight-bolder">Costo de la Consulta</h5>
        <p><?php echo '$' . $sucursal->getBranchInformation()['costo_consulta']; ?></p>
      </div>
    </section>
  </div>
</div>

<div class="card shadow mb-4">
  <!-- Card Header - Dropdown -->
  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    <h6 class="m-0 font-weight-bold text-primary">Cambiar datos generales</h6>
  </div>
  <!-- Card Body -->
  <div class="card-body">
    <form action="" method="POST">
      <input type="number" name="idSucursal" value="<?php echo $sucursal->getBranchInformation()['id']; ?>" hidden />

      <section class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
          <div class="form-group">
            <label for="nombreSucursal">Nombre de la Óptica</label>
            <input type="text" name="nombreSucursal" class="form-control" id="nombreSucursal" placeholder="Escribe aquí el nombre de la óptica" value="<?php echo $sucursal->getBranchInformation()['nombre']; ?>">
          </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12">
          <div class="form-group">
            <label for="direccionSucursal">Dirección de la Óptica</label>
            <input type="text" name="direccionSucursal" class="form-control" id="direccionSucursal" placeholder="Escribe aquí la dirección de la óptica" value="<?php echo $sucursal->getBranchInformation()['direccion']; ?>">
          </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
          <div class="form-group">
            <label for="telefonoSucursal">Teléfono de la Óptica</label>
            <input type="number" name="telefonoSucursal" class="form-control" id="telefonoSucursal" placeholder="Escribe aquí el teléfono de la óptica" value="<?php echo $sucursal->getBranchInformation()['telefono_primario']; ?>">
          </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
          <div class="form-group">
            <label for="telefonoSecundarioSucursal">Teléfono secundario de la Óptica</label>
            <input type="number" name="telefonoSecundarioSucursal" class="form-control" id="telefonoSecundarioSucursal" placeholder="Escribe aquí el teléfono secundario de la óptica" value="<?php echo $sucursal->getBranchInformation()['telefono_secundario']; ?>">
          </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
          <div class="form-group">
            <label for="correoSucursal">Correo Electrónico de la Óptica</label>
            <input type="email" name="correoSucursal" class="form-control" id="correoSucursal" placeholder="Escribe aquí el teléfono secundario de la óptica" value="<?php echo $sucursal->getBranchInformation()['correo']; ?>">
          </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
          <div class="form-group">
            <label for="correoSucursal">Costo de la Consulta</label>
            <input type="number" name="costoConsulta" class="form-control" id="costoConsulta" placeholder="Escribe aquí el precio base de la consulta" value="<?php echo $sucursal->getBranchInformation()['costo_consulta']; ?>">
          </div>
        </div>

        <?php
        if (isset($sucursal->getBranchInformation()['id'])) {
          echo '<button type="submit" name="actualizarSucursal" class="btn btn-info btn-block mt-3">Actualizar Datos</button>';
        } else {
          echo '<button type="submit" name="guardarSucursal" class="btn btn-info btn-block mt-3">Guardar Datos</button>';
        }
        ?>
      </section>
    </form>
    <br>
    <?php

    if (isset($_POST['guardarSucursal']) || isset($_POST['actualizarSucursal'])) {
      $data = array(
        'id' => $_POST['idSucursal'],
        'nombre' => $_POST['nombreSucursal'],
        'direccion' => $_POST['direccionSucursal'],
        'telefono_primario' => $_POST['telefonoSucursal'],
        'telefono_secundario' => $_POST['telefonoSecundarioSucursal'],
        'correo' => $_POST['correoSucursal'],
        'costo_consulta' => $_POST['costoConsulta']
      );

      if (isset($_POST['guardarSucursal'])) {
        $sucursal->manageBranchInformation($data, 1);
      } else if (isset($_POST['actualizarSucursal'])) {
        $sucursal->manageBranchInformation($data, 2);
      }
    }
    ?>
  </div>
</div>