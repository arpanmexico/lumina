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
        
        //Close Database
        UserContoller::closeDatabaseConnection();
    }
}

?>