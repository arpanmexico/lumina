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
        $query = "SELECT id_paciente, nombre, apellido_paterno, apellido_materno, nacimiento, correo, ocupacion, direccion, genero, telefono_primario, telefono_secundario, ingresado, actualizado FROM pacientes WHERE suspendido = 0";

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
                <div class='col-lg-3 col-md-6 col-sm-12'>
                <div class='card shadow-sm'>
                    <div class='card-body'>
                        <div class='row mb-2'>
                            <div class='col-12'>
                                <small><i class='far fa-clock'></i> " . $row['ingresado'] . "</small>
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
                                <div class='col-md-6 text-right'>
                                    <p class='text-muted'>" . $row['telefono_primario'] . "</p>
                                </div>
                                <div class='col-md-6 text-left'>
                                    <p class='text-muted'>" . $row['telefono_secundario'] . "</p>
                                </div>
                            </div>
                            <hr>
                            <a type='button' href='../controller/DeleteData.php?idPaciente=" . $row['id_paciente'] . "&accionPaciente=suspend' class='text-danger'>Borrar Paciente</a>
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

    public function getSuspendedPatientsInformacion()
    {
        $database = PatientController::getDatabaseConnection();
        $query = "SELECT id_paciente, nombre, apellido_paterno, apellido_materno, nacimiento, correo, ocupacion, direccion, genero, telefono_primario, telefono_secundario, ingresado, actualizado FROM pacientes WHERE suspendido = 1";

        $runQuery = $database->query($query);

        if ($runQuery->num_rows > 0) {
            while ($row = $runQuery->fetch_array()) {
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
                                    <img src='../../src/img/heart.png' width='130' class='img-fluid'>
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
                            <a type='button' href='../controller/DeleteData.php?idPaciente=" . $row['id_paciente'] . "&accionPaciente=restore' class='text-warning'>Recuperar Paciente</a>
                        </div>
                    </div>
                </div>
            </div>
                ";
            }
        } else {
            PatientController::getGlobalController()->getAlerts('warning', 'No existe ningún paciente eliminado');
        }
    }

    public function getAllHistoriesByIdentifier($id)
    {
        $database = PatientController::getDatabaseConnection();
        $query = "SELECT id_historial, id_paciente, antecedentes_pat_generales, antecedentes_pat_oculares, motivo_consulta, ultimo_examen, odAVLejosSRX, odCVLejos, odAVCercaSRX, odAVLejosRX, odAVCercaRX, ioAVLejosSRX, ioCVLejos, ioAVCercaSRX, ioAVLejosRX, ioAVCercaRX, rxodEsfera, rxodCilindro, rxodEje, rxodAdd, rxodDip, rxioEsfera, rxioCilindro, rxioEje, rxioAdd, rxioDip, observaciones, tipo_vision, tipo_lente, folio, validacion_medico, validacion_paciente, ingresado, actualizado FROM historiales WHERE id_paciente = '" . $id . "' ";
        $runQuery = $database->query($query);

        if ($runQuery->num_rows > 0) {
            while ($row = $runQuery->fetch_array()) {
                $validacion_medico = intval($row['validacion_medico']) == 1 ? "<i class='fas fa-check-circle text-success'></i>"  : "<i class='fas fa-times-circle text-danger'></i>";
                $validacion_paciente = intval($row['validacion_paciente']) == 1 ? "<i class='fas fa-check-circle text-success'></i>"  : "<i class='fas fa-times-circle text-danger'></i>";

                $array = array(
                    'id_historial' => $row['id_historial'],
                    'id_paciente' => $row['id_paciente'],
                    'antecedentes_pat_generales' => $row['antecedentes_pat_generales'],
                    'antecedentes_pat_oculares' => $row['antecedentes_pat_oculares'],
                    'motivo_consulta' => $row['motivo_consulta'],
                    'ultimo_examen' => $row['ultimo_examen'],

                    'odAVLejosSRX' => $row['odAVLejosSRX'],
                    'odCVLejos' => $row['odCVLejos'],
                    'odAVCercaSRX' => $row['odAVCercaSRX'],
                    'odAVLejosRX' => $row['odAVLejosRX'],
                    'odAVCercaRX' => $row['odAVCercaRX'],

                    'ioAVLejosSRX' => $row['ioAVLejosSRX'],
                    'ioCVLejos' => $row['ioCVLejos'],
                    'ioAVCercaSRX' => $row['ioAVCercaSRX'],
                    'ioAVLejosRX' => $row['ioAVLejosRX'],
                    'ioAVCercaRX' => $row['ioAVCercaRX'],

                    'rxodEsfera' => $row['rxodEsfera'],
                    'rxodCilindro' => $row['rxodCilindro'],
                    'rxodEje' => $row['rxodEje'],
                    'rxodAdd' => $row['rxodAdd'],
                    'rxodDip' => $row['rxodDip'],

                    'rxioEsfera' => $row['rxioEsfera'],
                    'rxioCilindro' => $row['rxioCilindro'],
                    'rxioEje' => $row['rxioEje'],
                    'rxioAdd' => $row['rxioAdd'],
                    'rxioDip' => $row['rxioDip'],

                    'observaciones' => $row['observaciones'],
                    'tipo_vision' => $row['tipo_vision'],
                    'tipo_lente' => $row['tipo_lente'],
                    'folio' => $row['folio'],

                    'validacion_medico' => $row['validacion_medico'],
                    'valicacion_paciente' => $row['validacion_paciente'],
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
                        </div>
                        <div class='text-center'>
                            <div class='row'>
                                <div class='col-6 mx-auto'>
                                    <a href='?crearHistorial=" . $row['id_paciente'] . "&accionHistorial=2&datosHistorial=" . $url . "'>
                                        <img src='../../src/img/resume.png' width='130' class='img-fluid'>
                                    </a>
                                </div>
                                <div class='col-12'>
                                    <h5>" . $row['folio'] . "</h5>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-md-2'></div>
                                <div class='col-md-4'>
                                    <p class='text-muted'>
                                        Confirmación Médico <br>
                                        " . $validacion_medico . "
                                    </p>
                                </div>
                                <div class='col-md-4'>
                                    <p class='text-muted'>
                                        Confirmación Paciente <br>
                                        " . $validacion_paciente . "
                                    </p>
                                </div>
                                <div class='col-md-2'></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                ";
            }
        } else
            PatientController::getGlobalController()->getAlerts('warning', 'El paciente no tiene ni tiene ninguna revisión registrada.');

        $database->close();
    }
}
