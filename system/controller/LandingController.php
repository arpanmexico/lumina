<?php
include('../config/database.php');
if(isset($_POST['accion'])){
    $accion = $_POST['accion'];
    $seccion = $_POST['seccion'];
    $database = new Database();
    $response = "";
    $query = "call manageStats('".$accion."', '".$seccion."', 1)";
    $runQuery = $database -> query($query);

    if($runQuery){
        $response = "true";
    }else{
        $response = "Error: " . mysqli_error($database);
    }

    echo $response;
}