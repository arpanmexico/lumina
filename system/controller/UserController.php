<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//include($_SERVER['DOCUMENT_ROOT'] . "/coca-cola/model/database.php");
include($_SERVER['DOCUMENT_ROOT'] . "/lumina/system/config/database.php");

class UserController
{

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
                UserController::getAlerts('error', 'El nombre de usuario o la contraseña son incorrectos, verifica e intenta de nuevo.');
            }
        } else {
            UserController::getAlerts('error', 'Ocurrió un error en el servidor: ' . $database->error);
        }

        //Close Database
        $database->close();
    }

    public function getAlerts($type, $message)
    {
        switch ($type) {
            case "success":
                echo "<div class='alert alert-success'>
                        " . $message . "
                     </div>";
                break;
            case "warning":
                echo "<div class='alert alert-warning'>
                        " . $message . "
                     </div>";
                break;
            case "error":
                echo "<div class='alert alert-danger'>
                        " . $message . "
                     </div>";
                break;
            default:
                echo "<div class='alert alert-info'>
                        " . $message . "
                     </div>";
                break;
        }
    }
}
