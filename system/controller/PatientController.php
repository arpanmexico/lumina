<?php
class PatientController
{
    public function getGlobalController()
    {
        return new GlobalController();
    }

    public function getDatabaseConnection()
    {
        return new Database();
    }

    public function patientsManager($data, $action)
    {
        $database = PatientController::getDatabaseConnection();

        $nacimiento = $data['dia'] . "-" . $data['mes'] . "-" . $data['anio'];

        switch ($action) {
            case 1:
                $query = "CALL patientsManager(null, '" . $data['nombre'] . "','" . $data['apellido_paterno'] . "','" . $data['apellido_materno'] . "','" . $nacimiento . "','" . $data['correo'] . "','" . $data['ocupacion'] . "','" . $data['direccion'] . "','" . $data['genero'] . "','" . $data['telefono_fijo'] . "', '" . $data['telefono_movil'] . "', 1)";
                break;
            case 2:
                $query = "CALL patientsManager('" . $data['codigo'] . "', '" . $data['nombre'] . "','" . $data['apellido_paterno'] . "','" . $data['apellido_materno'] . "','" . $nacimiento . "','" . $data['correo'] . "','" . $data['ocupacion'] . "','" . $data['direccion'] . "','" . $data['genero'] . "','" . $data['telefono_fijo'] . "', '" . $data['telefono_movil'] . "', 2)";
                break;
        }

        echo $query;

        $runQuery = $database->query($query);

        if ($runQuery)
            header('Location: ?listarPacientes');
        else
            PatientController::getGlobalController()->getAlerts('error', 'Ocurrió un error al guardar los datos, intenta <a href="?crearArmazon">Recargar la página</a>, si el problema persiste escribe a <a href="mailto:contacto@arpan.com.mx">contacto@arpan.com.mx</a>');

        $database->close();
    }

    public function getAllPatientsInformation()
    {
        $database = PatientController::getDatabaseConnection();
        $query = "SELECT id_paciente, nombre, apellido_paterno, apellido_materno, nacimiento, correo, ocupacion, direccion, genero, telefono_primario, telefono_secundario, ingresado, actualizado FROM pacientes";

        $runQuery = $database->query($query);

        if ($runQuery->num_rows > 0) {
            while ($row = $runQuery->fetch_array()) {
                $array = array(
                    'id' => $row['id_paciente'],
                    'nombre' => $row['nombre'],
                    'apellido_paterno' => $row['apellido_paterno'],
                    'apellido_materno' => $row['apellido_materno'],
                    'nacimiento' => $row['nacimiento'],
                    'correo' => $row['correo'],
                    'ocupacion' => $row['ocupacion'],
                    'direccion' => $row['direccion'],
                    'genero' => $row['genero'],
                    'telefono_primario' => $row['telefono_primario'],
                    'telefono_secundario' => $row['telefono_secundario'],
                    'ingresado' => $row['ingresado'],
                    'actualizado' => $row['actualizado']
                );

                $serialized_array = serialize($array);
                $url = urlencode($serialized_array);


                echo "
                <div class='col-lg-3 col-md-3 col-sm-12'>
                <div class='card shadow-sm'>
                    <div class='card-body'>
                        <div class='row mb-2'>
                            <div class='col-7'>
                                <small><i class='far fa-clock'></i> " . $row['ingresado'] . "</small>
                            </div>
                            <div class='col-5 text-right'>
                                ...
                            </div>
                        </div>
                        <div class='text-center'>
                            <div class='row'>
                                <div class='col-6 mx-auto'>
                                    <a href='?detallesPaciente=" . $url . "'>
                                        <img src='../../src/img/heart.png' width='130' class='img-fluid'>
                                    </a>
                                </div>
                                <div class='col-12'>
                                    <h5>" . $row['nombre'] . " " . $row['apellido_paterno'] . " " . $row['apellido_materno'] . "</h5>
                                </div>
                            </div>
                            <p class='text-muted'>" . $row['correo'] . "</p>
                            <div class='row'>
                                <div class='col-md-2'></div>
                                <div class='col-md-4'>
                                    <p class='text-muted'>" . $row['telefono_primario'] . "</p>
                                </div>
                                <div class='col-md-4'>
                                    <p class='text-muted'>" . $row['telefono_secundario'] . "</p>
                                </div>
                                <div class='col-md-2'></div>
                            </div>
                            <hr>
                            <a type='button' href='../controller/DeleteData.php?idPaciente=" . $row['id_paciente'] . "&accionDoctor=suspend' class='text-danger'>Borrar Paciente</a>
                        </div>
                    </div>
                </div>
            </div>
                ";
            }
        } else
            PatientController::getGlobalController()->getAlerts('warning', 'Oops! Parece que no hay ningún paciente registrado, <br><a href="?crearPaciente">Registrar un nuevo paciente</a>');

        $database->close();
    }
}
