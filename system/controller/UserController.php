<?php 
include('../config/database.php');

class UserController{
    
    public function getDatabaseConnection(){
        return new Database();
    }
    
    public function closeDatabaseConnection(){
        return $database->close();
    }
    
    public function userLogin($data){
        //Open Database
        $database = UserContoller::getDatabaseConnection();
        
        $query = "CALL userLogin('".$data['user']."','".$data['password']."')";
        $runQeuery = $database->query($query);
        
        if($runQuery){
            if($runQuery->num_rows > 0){
                session_start();
                $_SESSION['username'] = $data['user'];
                header('Location: ../dashboard.php');
            }else{
                UserController::getAlerts('error','El nombre de usuario o la contraseña son incorrectos, verifica e intenta de nuevo.');
            }
        }else{
            UserController::getAlerts('error','Ocurrió un error en el servidor: ' . $database->error);
        }
        
        //Close Database
        UserContoller::closeDatabaseConnection();
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

?>