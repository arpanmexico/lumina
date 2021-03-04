<?php
include('../controller/DoctorController.php');
$doctores = new DoctorController();

$unserialized_array = $_GET['detallesDoctor'];
$array = unserialize(urldecode($unserialized_array));

$estados = array(
    0 => 'Inactivo',
    1 => 'Activo'
);
?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Doctores - Información del Doctor</h1>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <a href="?listarDoctores"><i class="fas fa-chevron-left"></i> Volver a la lista de doctores</a>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12 text-center">
                <img src="../../src/img/doctors.png" class="img-fluid">
                <p class="font-weight-bolder">
                    Última Fecha de Actualización del Paciente:
                </p>
                <?php
                echo $doctores->getGlobalController()->getFormattedDate($array['actualizado']);
                ?>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-12 align-self-center">
                <form action="" method="post">
                    <section class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="codigoDoctor">Código del Doctor <span class="text-danger">(No se puede cambiar)</span></label>
                                <input type="number" name="codigoDoctor" class="form-control" id="codigoDoctor" placeholder="Escribe aquí el código del doctor" value="<?php echo $array['id']; ?>" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="estadoDoctor">Estado</label>
                                <select class="form-control" id="estadoDoctor" name="estadoDoctor">
                                    <option disabled selected>Selecciona el estado del doctor</option>
                                    <?php
                                    foreach ($estados as $key => $value) {
                                        if ($array['estado'] == $value) {
                                            echo "<option value='" . $key . "' selected>" . $value . "</option>";
                                        } else {
                                            echo "<option value='" . $key . "'>" . $value . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                            <div class="form-group">
                                <label for="nombreDoctor">Nombre Doctor</label>
                                <input type="text" name="nombreDoctor" class="form-control" id="nombreDoctor" placeholder="Escribe aquí el código del doctor" value="<?php echo $array['nombre']; ?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                            <div class="form-group">
                                <label for="apellidoDoctor">Apellido del Doctor</label>
                                <input type="text" name="apellidoDoctor" class="form-control" id="apellidoDoctor" placeholder="Escribe aquí el código del doctor" value="<?php echo $array['apellido']; ?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                            <div class="form-group">
                                <label for="telefonoDoctor">Número de Teléfono</label>
                                <input type="number" name="telefonoDoctor" class="form-control" id="telefonoDoctor" placeholder="Escribe aquí el código del doctor" value="<?php echo $array['telefono']; ?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                            <div class="form-group">
                                <label for="especialidadDoctor">Especialidad Doctor</label>
                                <input type="text" name="especialidadDoctor" class="form-control" id="especialidadDoctor" placeholder="Escribe aquí el código del doctor" value="<?php echo $array['especialidad']; ?>">
                            </div>
                        </div>
                        <button type="submit" name="actualizarDoctor" class="btn btn-info btn-block mt-3">Actualizar Doctor</button>
                    </section>
                </form>
            </div>
            <div class="container">
                <?php
                if (isset($_POST['actualizarDoctor'])) {
                    $data = array(
                        'codigo' => $array['id'],
                        'estado' => $_POST['estadoDoctor'],
                        'nombre' => ucwords(strtolower($_POST['nombreDoctor'])),
                        'apellido' => ucwords(strtolower($_POST['apellidoDoctor'])),
                        'telefono' => $_POST['telefonoDoctor'],
                        'especialidad' => ucwords(strtolower($_POST['especialidadDoctor']))
                    );
                    // 2 => Actualizar
                    $doctores->doctorsManager($data, 2);
                }
                ?>
            </div>
        </div>
    </div>
</div>