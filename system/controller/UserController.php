<?php
include($_SERVER['DOCUMENT_ROOT'] . "/lumina/system/config/database.php");
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
}
