<?php

include('../controller/PatientController.php');
$pacientes = new PatientController();

$unserialized_array = $_GET['detallesPaciente'];
$array = unserialize(urldecode($unserialized_array));

$generos = array(
  'M' => 'Masculino',
  'F' => 'Femenino'
);

$nacimiento = explode("-", $array['nacimiento']);

?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Pacientes - Información del paciente</h1>
</div>

<div class="card shadow mb-4">
  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    <a href="?listarPacientes"><i class="fas fa-chevron-left"></i> Volver a la lista de pacientes</a>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-12 text-center">
        <img src="../../src/img/heart.png" class="img-fluid">

        <p class="font-weight-bolder">
          Última Fecha de Actualización del Paciente:
        </p>
        <?php
        echo $pacientes->getGlobalController()->getFormattedDate($array['actualizado']);
        ?>
      </div>
      <div class="col-lg-8 col-md-8 col-sm-12 align-self-center">
        <form action="" method="post">

          <section class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 mt-3">
              <div class="form-group">
                <label for="nombrePaciente">Nombre del Paciente <span class="text-danger">*</span></label>
                <input type="text" name="nombrePaciente" class="form-control" id="nombrePaciente" placeholder="Escribe aquí el nombre del paciente" value="<?php echo $array['nombre']; ?>">
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 mt-3">
              <div class="form-group">
                <label for="apellidoPaternoPaciente">Apellido Paterno del Paciente <span class="text-danger">*</span></label>
                <input type="text" name="apellidoPaternoPaciente" class="form-control" id="apellidoPaternoPaciente" placeholder="Escribe aquí el apellido" value="<?php echo $array['apellido_paterno']; ?>">
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 mt-3">
              <div class="form-group">
                <label for="apellidoMaternoPaciente">Apellido Materno del Paciente <span class="text-danger">*</span></label>
                <input type="text" name="apellidoMaternoPaciente" class="form-control" id="apellidoMaternoPaciente" placeholder="Escribe aquí el apellido" value="<?php echo $array['apellido_materno']; ?>">
              </div>
            </div>
          </section>

          <section class="row mt-3">
            <div class="col-lg-6 col-md-6 col-sm-12">
              <span class="font-weight-bolder">Fecha de Nacimiento</span>
              <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                  <div class="form-group">
                    <label for="diaNacimientoPaciente">Día <span class="text-danger">*</span></label>
                    <select class="form-control" id="diaNacimientoPaciente" name="diaNacimientoPaciente">
                      <option disabled selected>Selecciona el día</option>
                      <?php
                      for ($i = 1; $i < 32; $i++) {
                        if ($nacimiento[0] == $i)
                          echo "<option value='" . $i . "' selected>" . $i . "</option>";
                        else
                          echo "<option value='" . $i . "'>" . $i . "</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                  <div class="form-group">
                    <label for="mesNacimientoPaciente">Mes <span class="text-danger">*</span></label>
                    <select class="form-control" id="mesNacimientoPaciente" name="mesNacimientoPaciente">
                      <option disabled selected>Selecciona el día</option>
                      <?php

                      foreach ($pacientes->getGlobalController()->getMonths() as $key => $value) {
                        if ($nacimiento[1] == $key)
                          echo "<option value='" . $key . "' selected>" . $value . "</option>";
                        else
                          echo "<option value='" . $key . "'>" . $value . "</option>";
                      }


                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                  <div class="form-group">
                    <label for="anoNacimientoPaciente">Año <span class="text-danger">*</span></label>
                    <select class="form-control" id="anoNacimientoPaciente" name="anoNacimientoPaciente">
                      <option disabled selected>Selecciona el año</option>
                      <?php
                      for ($i = date("Y"); $i >= 1930; $i--) {
                        if ($nacimiento[2] == $i)
                          echo "<option value='" . $i . "' selected>" . $i . "</option>";
                        else
                          echo "<option value='" . $i . "'>" . $i . "</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="correoPaciente">Correo Electrónico del Paciente</label>
                    <input type="email" name="correoPaciente" class="form-control" id="correoPaciente" placeholder="Escribe aquí el correo electrónico" value="<?php echo $array['correo'] ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="ocupacionPaciente">Ocupación</label>
                    <input type="text" name="ocupacionPaciente" class="form-control" id="ocupacionPaciente" placeholder="Ej. Medico General" value="<?php echo $array['ocupacion']; ?>">
                  </div>
                </div>
              </div>
            </div>

          </section>

          <section class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
              <div class="form-group">
                <label for="direccionPaciente">Lugar de Residencia</label>
                <input type="text" name="direccionPaciente" class="form-control" id="direccionPaciente" placeholder="Escribe aquí la dirección de residencia" value="<?php echo $array['direccion']; ?>">
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
              <div class="form-group">
                <label for="generoPaciente">Genero <span class="text-danger">*</span></label>
                <select class="form-control" id="generoPaciente" name="generoPaciente">
                  <option disabled selected>Selecciona el genero del paciente</option>
                  <?php
                  foreach ($generos as $key => $value) {
                    if ($array['genero'] == $key)
                      echo "<option value='$key' selected>" . $value . "</option>";
                    else
                      echo "<option value='$key'>" . $value . "</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
              <div class="form-group">
                <label for="telefonoFijoPaciente">Número de Teléfono Fijo (Casa)</label>
                <input type="number" name="telefonoFijoPaciente" class="form-control" id="telefonoFijoPaciente" placeholder="Escribe aquí el teléfono" value="<?php echo $array['telefono_primario']; ?>">
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
              <div class="form-group">
                <label for="telefonoMovilPaciente">Número de Teléfono Celular (Móvil) <span class="text-danger">*</span></label>
                <input type="number" name="telefonoMovilPaciente" class="form-control" id="telefonoMovilPaciente" placeholder="Escribe aquí el teléfono" value="<?php echo $array['telefono_secundario']; ?>">
              </div>
            </div>
          </section>
          <button type="submit" name="actualizarPaciente" class="btn btn-info btn-block">Actualizar Paciente</button>
        </form>
        <?php
        if (isset($_POST['actualizarPaciente'])) {
          $data = array(
            'codigo' => $array['id'],
            'nombre' => ucwords(strtolower($_POST['nombrePaciente'])),
            'apellido_paterno' => ucwords(strtolower($_POST['apellidoPaternoPaciente'])),
            'apellido_materno' => ucwords(strtolower($_POST['apellidoMaternoPaciente'])),
            'dia' => $_POST['diaNacimientoPaciente'],
            'mes' => $_POST['mesNacimientoPaciente'],
            'anio' => $_POST['anoNacimientoPaciente'],
            'correo' => $_POST['correoPaciente'],
            'ocupacion' => ucwords(strtolower($_POST['ocupacionPaciente'])),
            'direccion' => ucwords(strtolower($_POST['direccionPaciente'])),
            'genero' => $_POST['generoPaciente'],
            'telefono_fijo' => $_POST['telefonoFijoPaciente'],
            'telefono_movil' => $_POST['telefonoMovilPaciente']
          );

          // 1 => UPDATE
          $pacientes->patientsManager($data, 2);
        }
        ?>
      </div>
    </div>
  </div>
</div>

<div class="card shadow mb-4">
  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    <h6 class="m-0 font-weight-bold text-primary">Historiales Clínicos Registrados <i class="fas fa-arrow-right ml-2 mr-2"></i>
      <a href="?crearHistorial=<?php echo $array['id']; ?>&accionHistorial=1" class="btn btn-info"><i class="fas fa-plus-circle"></i> Crear Revisión</a>
    </h6>
  </div>
  <div class="card-body">
    <div class="row">
      <?php
      $pacientes->getAllHistoriesByIdentifier($array['id']);
      ?>
    </div>
  </div>
</div>

<div class="card shadow mb-4">
  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    <h6 class="m-0 font-weight-bold text-primary">Ventas Registradas <i class="fas fa-arrow-right ml-2 mr-2"></i>
      <a href="?listarVentas" class="btn btn-info"><i class="fas fa-plus-circle"></i> Ver Todas las Ventas</a>
    </h6>
  </div>
  <div class="card-body">
    <div class="row">
      <?php
        $pacientes->getAllSoldProducts($array['id']);
      ?>
    </div>
  </div>
</div>