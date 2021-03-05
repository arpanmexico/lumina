<?php
class DoctorController
{
    public function getGlobalController()
    {
        return new GlobalController();
    }

    public function getDatabaseConnection()
    {
        return new Database();
    }

    public function doctorsManager($data, $action)
    {
        $database = DoctorController::getDatabaseConnection();
        $query = "CALL doctorsManager(" . $data['codigo'] . ", '" . $data['nombre'] . "', '" . $data['apellido'] . "', " . $data['telefono'] . ", '" . $data['especialidad'] . "', " . $data['estado'] . ", " . $action . ")";

        echo $query;

        $runQuery = $database->query($query);

        if ($runQuery)
            header('Location: dashboard.php?listarDoctores');
        else
            DoctorController::getGlobalController()->getAlerts('error', 'Ocurrió un error al guardar los datos, intenta <a href="?crearArmazon">Recargar la página</a>, si el problema persiste escribe a <a href="mailto:contacto@arpan.com.mx">contacto@arpan.com.mx</a>');

        $database->close();
    }

    public function getAllDoctorsInformation()
    {
        $database = DoctorController::getDatabaseConnection();

        $query = "SELECT id_doctor, nombre, apellido, telefono, especialidad, estado, ingresado, actualizado FROM doctores WHERE suspendido = 0";
        $runQuery = $database->query($query);

        if ($runQuery->num_rows > 0) {
            while ($row = $runQuery->fetch_array()) {

                $array = array(
                    'id' => $row['id_doctor'],
                    'nombre' => $row['nombre'],
                    'apellido' => $row['apellido'],
                    'telefono' => $row['telefono'],
                    'especialidad' => $row['especialidad'],
                    'estado' => $row['estado'],
                    'ingresado' => $row['ingresado'],
                    'actualizado' => $row['actualizado'],
                );

                $serialized_array = serialize($array);
                $url = urlencode($serialized_array);

                if ($row['estado' == 'Activo'])
                    $estado = "<small id='businessImgText1' class='text-success font-weight-bold'>Activo</small>";
                else
                    $estado = "<small id='businessImgText1' class='text-danger font-weight-bold'>Inactivo</small>";

                echo "
                <div class='col-lg-3 col-md-6 col-sm-12'>
                    <div class='card  h-100 shadow-sm'>
                        <div class='card-body'>
                            <div class='row mb-2'>
                                <div class='col-12'>
                                    <small><i class='far fa-clock'></i> " . $row['ingresado'] . "</small>
                                </div>
                            </div>
                            <div class='text-center'>
                                <div class='row'>
                                    <div class='col-6 mx-auto'>
                                        <a href='?detallesDoctor=" . $url . "'>
                                            <img src='../../src/img/doctors.png' width='130' class='img-fluid'>
                                        </a>
                                    </div>
                                    <div class='col-12'>
                                        <h5>" . $row['nombre'] . " " . $row['apellido'] . "</h5>
                                    </div>
                                </div>
                                <p class='text-muted'>" . $row['especialidad'] . "</p>
                                <hr>
                                <a type='button' href='../controller/DeleteData.php?idDoctor=" . $row['id_doctor'] . "&accionDoctor=suspend' class='text-danger'>Borrar Doctor</a>
                            </div>
                        </div>
                    </div>
                </div>";
            }
        } else {
            DoctorController::getGlobalController()->getAlerts('warning', 'No existe ningún doctor registrado, <br> <a href="?crearDoctores">Registrar un nuevo doctror</a>');
        }
        $database->close();
    }

    public function getSuspendedDoctorsInformacion()
    {
        $database = DoctorController::getDatabaseConnection();

        $query = "SELECT id_doctor, nombre, apellido, telefono, especialidad, estado, ingresado, actualizado FROM doctores WHERE suspendido = 1";

        $runQuery = $database->query($query);

        if ($runQuery->num_rows > 0) {
            while ($row = $runQuery->fetch_array()) {
                if ($row['estado' == 'Activo'])
                    $estado = "<small id='businessImgText1' class='text-success font-weight-bold'>Activo</small>";
                else
                    $estado = "<small id='businessImgText1' class='text-danger font-weight-bold'>Inactivo</small>";

                echo "
                <div class='col-lg-3 col-md-3 col-sm-12'>
                    <div class='card shadow-sm'>
                        <div class='card-body'>
                            <div class='row mb-2'>
                                <div class='col-7'>
                                    <small><i class='far fa-clock'></i> " . $row['ingresado'] . "</small>
                                </div>
                                <div class='col-5 text-right'>
                                    " . $estado . "
                                </div>
                            </div>
                            <div class='text-center'>
                                <div class='row'>
                                    <div class='col-6 mx-auto'>
                                        <img src='../../src/img/doctors.png' width='130' class='img-fluid'>
                                    </div>
                                    <div class='col-12'>
                                        <h5>" . $row['nombre'] . " " . $row['apellido'] . "</h5>
                                    </div>
                                </div>
                                <p class='text-muted'>" . $row['especialidad'] . "</p>
                                <hr>
                                <a type='button' href='../controller/DeleteData.php?idDoctor=" . $row['id_doctor'] . "&accionDoctor=restore' class='text-warning'>Recuperar Doctor</a>
                            </div>
                        </div>
                    </div>
                </div>";
            }
        } else {
            DoctorController::getGlobalController()->getAlerts('warning', 'No existe ningún doctor eliminado.');
        }

        $database->close();
    }
}
