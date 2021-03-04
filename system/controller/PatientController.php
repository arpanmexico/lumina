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

    public function patientsManager($data)
    {
        $database = PatientController::getDatabaseConnection();

        $nacimiento = $data['dia'] . "-" . $data['mes'] . "-" . $data['anio'];

        $query = "CALL patientsManager(null, '" . $data['nombre'] . "','" . $data['apellido_paterno'] . "','" . $data['apellido_materno'] . "','" . $nacimiento . "','" . $data['correo'] . "','" . $data['ocupacion'] . "','" . $data['direccion'] . "','" . $data['genero'] . "','" . $data['telefono_fijo'] . "', '" . $data['telefono_movil'] . "', 1)";

        $runQuery = $database->query($query);

        if ($runQuery)
            header('Location: ?listarPacientes');
        else
        PatientController::getGlobalController()->getAlerts('error', 'Ocurrió un error al guardar los datos, intenta <a href="?crearArmazon">Recargar la página</a>, si el problema persiste escribe a <a href="mailto:contacto@arpan.com.mx">contacto@arpan.com.mx</a>');

        $database->close();
    }
}
