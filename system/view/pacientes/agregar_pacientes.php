<?php
include('../controller/PatientController.php');
$pacientes = new PatientController();
?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Pacientes</h1>
</div>
<p class="text-muted">Bienvenido al módulo de pacientes, acá puede realizar operaciones como agregar nuevos pacientes, <br> ver la lista de pacientes, actualizar datos de un paciente y eliminar un paciente del sistema. <br> <br>
<b>Los campos marcados con un <span class="text-danger">*</span> son obligatorios.</b>
</p>

<div class="card shadow mb-4">
  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    <h6 class="m-0 font-weight-bold text-primary">Información general</h6>
  </div>

  <div class="card-body">
    <form action="" method="post">
      <section class="row">
        <div class="col-lg-4 col-md-4 col-sm-12 mt-3">
          <div class="form-group">
            <label for="nombrePaciente">Nombre del Paciente <span class="text-danger">*</span> </label>
            <input type="text" name="nombrePaciente" class="form-control" id="nombrePaciente" placeholder="Escribe aquí el nombre del paciente" required>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 mt-3">
          <div class="form-group">
            <label for="apellidoPaternoPaciente">Apellido Paterno del Paciente <span class="text-danger">*</span></label>
            <input type="text" name="apellidoPaternoPaciente" class="form-control" id="apellidoPaternoPaciente" placeholder="Escribe aquí el apellido" required>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 mt-3">
          <div class="form-group">
            <label for="apellidoMaternoPaciente">Apellido Materno del Paciente <span class="text-danger">*</span></label>
            <input type="text" name="apellidoMaternoPaciente" class="form-control" id="apellidoMaternoPaciente" placeholder="Escribe aquí el apellido" required>
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
                <select class="form-control" id="diaNacimientoPaciente" name="diaNacimientoPaciente" required>
                  <option disabled selected>Selecciona el día</option>
                  <?php
                  for ($i = 1; $i < 32; $i++) {
                    echo "<option value='" . $i . "'>" . $i . "</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="form-group">
                <label for="mesNacimientoPaciente">Mes <span class="text-danger">*</span></label>
                <select class="form-control" id="mesNacimientoPaciente" name="mesNacimientoPaciente" required>
                  <option disabled selected>Selecciona el día</option>
                  <?php
                  foreach ($pacientes->getGlobalController()->getMonths() as $key => $value) {
                    echo "<option value='" . $key . "'>" . $value . "</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="form-group">
                <label for="anoNacimientoPaciente">Año <span class="text-danger">*</span></label>
                <select class="form-control" id="anoNacimientoPaciente" name="anoNacimientoPaciente" required>
                  <option disabled selected>Selecciona el año</option>
                  <?php
                  for ($i = date("Y"); $i >= 1930; $i--) {
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
                <input type="email" name="correoPaciente" class="form-control" id="correoPaciente" placeholder="Escribe aquí el correo electrónico">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="ocupacionPaciente">Ocupación</label>
                <input type="text" name="ocupacionPaciente" class="form-control" id="ocupacionPaciente" placeholder="Ej. Medico General">
              </div>
            </div>
          </div>
        </div>

      </section>

      <section class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
          <div class="form-group">
            <label for="direccionPaciente">Lugar de Residencia</label>
            <input type="text" name="direccionPaciente" class="form-control" id="direccionPaciente" placeholder="Escribe aquí la dirección de residencia">
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
          <div class="form-group">
            <label for="generoPaciente">Genero <span class="text-danger">*</span></label>
            <select class="form-control" id="generoPaciente" name="generoPaciente" required>
              <option disabled selected>Selecciona el genero del paciente</option>
              <option value="M">Masculino</option>
              <option value="F">Femenino</option>
            </select>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
          <div class="form-group">
            <label for="telefonoFijoPaciente">Número de Teléfono Fijo (Casa)</label>
            <input type="number" name="telefonoFijoPaciente" class="form-control" id="telefonoFijoPaciente" placeholder="Escribe aquí el teléfono">
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
          <div class="form-group">
            <label for="telefonoMovilPaciente">Número de Teléfono Celular (Móvil) <span class="text-danger">*</span></label>
            <input type="number" name="telefonoMovilPaciente" class="form-control" id="telefonoMovilPaciente" placeholder="Escribe aquí el teléfono" required>
          </div>
        </div>
      </section>
      <div class="row">
        <div class="col-12 col-md-6 mx-auto">
          <button type="submit" name="guardarPaciente" class="btn btn-info btn-block">Agregar Paciente</button>
        </div>
        <div class="col-12 col-md-6 mx-auto">
          <button type="submit" name="guardarVender" class="btn btn-success btn-block">Guardar y crear venta en automático</button>
        </div>
       
        
      </div>
    </form>
    <br>

    <?php
    if (isset($_POST['guardarPaciente'])) {
      $data = array(
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
        'telefono_fijo' => $_POST['telefonoFijoPaciente'] == '' ? '0000000000' : $_POST['telefonoFijoPaciente'],
        'telefono_movil' => $_POST['telefonoMovilPaciente'] == '' ? '0000000000' : $_POST['telefonoMovilPaciente']
      );

      // 1 => INSERT
      $pacientes->patientsManager($data, 1, 'normal');
    }elseif(isset($_POST['guardarVender'])){
      $data = array(
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
        'telefono_fijo' => $_POST['telefonoFijoPaciente'] == '' ? '0000000000' : $_POST['telefonoFijoPaciente'],
        'telefono_movil' => $_POST['telefonoMovilPaciente'] == '' ? '0000000000' : $_POST['telefonoMovilPaciente']
      );

      // 1 => INSERT
      $pacientes->patientsManager($data, 1, 'auto');
    }
    ?>
  </div>
</div>