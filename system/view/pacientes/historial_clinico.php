<?php 
    /* 
        1 => Para crear un historial clínico
        2 => Para ver la información detallada de un historial seleccionado
    */
    if(isset($_GET['accionHistorial']) == 1){
        echo "Crearle un historial al usuario: " , $_GET['crearHistorial'];
    }else if(isset($_GET['accionHistorial']) == 2){
        echo "Revisar el historial al usuario: " , $_GET['crearHistorial'];      
    }
