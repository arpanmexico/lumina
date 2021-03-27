<?php

include('GlobalController.php');

class UserController
{
    public function getGlobalController()
    {
        return new GlobalController();
    }

    public function getDatabaseConnection()
    {
        return new Database();
    }

    public function userLogin($data)
    {
        //Open Database
        $database = UserController::getDatabaseConnection();

        $query = "CALL userLogin('" . $data['user'] . "','" . hash('sha256', $data['password']) . "')";
        $runQuery = $database->query($query);

        if ($runQuery) {
            if ($runQuery->num_rows > 0) {
                session_start();
                $_SESSION['userID'] = $data['user'];
                header('Location: ../system/view/dashboard.php');
            } else {
                UserController::getGlobalController()->getAlerts('error', 'El nombre de usuario o la contraseña son incorrectos, verifica e intenta de nuevo.');
            }
        } else {
            UserController::getGlobalController()->getAlerts('error', 'Ocurrió un error en el servidor, el registr ose guardó y será revisado.');

            UserController::getGlobalController()->addToLogFile($database->error);
        }

        //Close Database 
        $database->close();
    }

    public function getUserName($userID)
    {
        $database = UserController::getDatabaseConnection();

        $query = "SELECT nombre FROM usuarios WHERE id_usuario = " . $userID . "";
        $runQuery = $database->query($query);
        $row = $runQuery->fetch_array();

        return $row['nombre'];

        $database->close();
    }

    public function getCountPatients(){
        $database = UserController::getDatabaseConnection();

        $query = "SELECT count(id_paciente) as pacientes FROM pacientes";
        $runQuery = $database->query($query);
        $row = $runQuery->fetch_array();

        return $row['pacientes'];

        $database->close();
    }

    public function getCountAdmin()
    {
        $database = UserController::getDatabaseConnection();

        $query = "SELECT count(id_usuario) as admins FROM usuarios WHERE tipo = 'Usuario'";
        $runQuery = $database->query($query);
        $row = $runQuery->fetch_array();

        return $row['admins'];

        $database->close();
    }

    public function getIncomeByMonthByYear($year){
        
        $database = UserController::getDatabaseConnection();

        $query = "call getSoldByMonthByYear($year)";
        $runQuery = $database->query($query);
        
        while ($row = $runQuery->fetch_array()) {
            $jsonObject = array(
                'Enero' => $row['enero'],
                'Febrero' => $row['febrero'],
                'Marzo' => $row['marzo'],
                'Abril' => $row['abril'],
                'Mayo' => $row['mayo'],
                'Junio' => $row['junio'],
                'Julio' => $row['julio'],
                'Agosto' => $row['agosto'],
                'Septiembre' => $row['septiembre'],
                'Octubre' => $row['octubre'],
                'Noviembre' => $row['noviembre'],
                'Diciembre' => $row['diciembre'],
            );
        }
      
        echo json_encode($jsonObject, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

        
    }
}



if(isset($_POST['year'])){
    header('Content-Type: application/json');
    $user = new UserController();
    $user -> getIncomeByMonthByYear($_POST['year']);
}
