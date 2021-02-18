<?php
class BranchController
{
    public function getGlobalController()
    {
        return new GlobalController();
    }

    public function getDatabaseConnection()
    {
        return new Database();
    }

    public function getBranchInformation()
    {
        $database = BranchController::getDatabaseConnection();
        $query = "SELECT * FROM sucursal";
        $runQuery = $database->query($query);

        if ($runQuery->num_rows > 0) {
            $row = $runQuery->fetch_array();
            $data = array(
                'id' => $row['id_sucursal'],
                'nombre' => $row['nombre'],
                'direccion' => $row['direccion'],
                'telefono_primario' => $row['telefono_primario'],
                'telefono_secundario' => $row['telefono_secundario'],
                'correo' => $row['correo'],
                'costo_consulta' => $row['costo_consulta']
            );
            return $data;
        }

        $database->close();
    }

    public function manageBranchInformation($data, $action)
    {
        $database = BranchController::getDatabaseConnection();

        switch ($action) {
            case 1:
                $query = "CALL manageBranch(null,'" . $data['nombre'] . "','" . $data['direccion'] . "','" . $data['telefono_primario'] . "','" . $data['telefono_secundario'] . "','" . $data['correo'] . "','" . $data['costo_consulta'] . "', 1)";
                break;
            case 2:
                $query = "CALL manageBranch(" . $data['id'] . ",'" . $data['nombre'] . "','" . $data['direccion'] . "','" . $data['telefono_primario'] . "','" . $data['telefono_secundario'] . "','" . $data['correo'] . "','" . $data['costo_consulta'] . "', 2)";
                break;
        }

        $runQuery = $database->query($query);
        if ($runQuery) {
            header('Location: dashboard.php?sucursal');
        } else {
            BranchController::getGlobalController()->getAlerts('error', 'Ocurrió un error al guardar los datos -> ' . $database->error);
        }

        $database->close();
    }
}
