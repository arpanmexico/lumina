<?php
    ob_start();
    header('Content-Type: application/json');
   
    // Sorry no se puede usar tu archivo de conexión IDKW :'c
    $pdo = new PDO("mysql:dbname=lumina;host=34.71.80.62", "root","eNFr49WxFpsnFy");
    class CalendarController
    {
        static function addEvent(){
            $response = false;
            $query = "INSERT INTO citas (nombre, apellidos, telefono, descripcion, title, date, color) VALUES (:nombre, :apellidos, :telefono, :descripcion, :title, :date, :color)";
            $runQuery = $GLOBALS['pdo']->prepare($query);
            $result = $runQuery->execute(array(
                "nombre" => ucwords($_POST['nombre']), 
                "apellidos" => ucwords($_POST['apellidos']),
                "telefono" => ucwords($_POST['telefono']),
                "descripcion" => ucfirst($_POST['descripcion']), 
                "title" => ucwords($_POST['title']), 
                "date" => $_POST['date'],
                "color" => $_POST['color'],
            ));
            echo json_encode($response);
        }
        
        static function getEvents(){
            $query = "SELECT * FROM citas";
            $runQuery = $GLOBALS['pdo']->prepare($query);
            $runQuery->execute();
            
            $row = $runQuery->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($row);
        }

        static function dropEvent(){
            $response = false;

            if(isset($_POST['id'])){
                $query = "DELETE FROM citas WHERE id =:id";
                $runQuery = $GLOBALS['pdo']->prepare($query);
                $result = $runQuery->execute(array("id"=>$_POST['id']));
            }

            echo json_encode($response);
        }

        static function updateEvent(){
            $response = false;

            if(isset($_POST['id'])){
                $query = "UPDATE citas SET
                nombre =:nombre,
                apellidos =:apellidos,
                telefono =:telefono,
                descripcion =:descripcion,
                title =:title,
                date=:date
                WHERE id=:id";

                $runQuery = $GLOBALS['pdo']->prepare($query);
                $result = $runQuery->execute(array(
                    "nombre" => ucwords($_POST['nombre']), 
                    "apellidos" => ucwords($_POST['apellidos']),
                    "telefono" => $_POST['telefono'],
                    "descripcion" => ucfirst($_POST['descripcion']), 
                    "title" => ucwords($_POST['title']), 
                    "date" => $_POST['date'],
                    "id"=>$_POST['id']
                ));
            }

            echo json_encode($response);
        }
    }

    $calendar = new CalendarController();
    $action = (isset($_GET['action']))?$_GET['action']:'read';

    switch($action){
        case 'add':
            $calendar -> addEvent();
            break;
        case 'drop':
            $calendar -> dropEvent();
            break;
        case 'update':
            $calendar -> updateEvent();
            break;    
        default:
            $calendar -> getEvents();
            break;    
    }
    
?>
    