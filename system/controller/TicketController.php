<?php 
    class TicketController
    {
    
        public function getGlobalController()
        {
        return new GlobalController();
        }

        public function getMessages(){
            $database = new Database();
            $query = "SELECT id_ticket, mensaje, estatus, fecha FROM ticket";
            $runQuery = $database->query($query);
           
            if ($runQuery->num_rows > 0) {
                while ($row = $runQuery->fetch_array()) {
                    echo ucfirst($row['mensaje']);
                }
            }    
        }
        

        public function ticketManage($data){
            include($_SERVER['DOCUMENT_ROOT'] . "/lumina/system/config/database.php");
            //include($_SERVER['DOCUMENT_ROOT'] . "/system/config/database.php");
            $database = new Database();
            $query = "call manageTicket(".$data['id_ticket'].",'".$data['mensaje']."', ".$data['accion'].")";
            $runQuery = $database->query($query);
            $response = "";

            if ($runQuery) {
                $response = 'true';
            } else {
                $response = 'false';
                $response = $query;
            }
            echo $response;
        }

    }
    $ticket = new TicketController();
    if(isset($_POST['action'])){
        $ticket->ticketManage($_POST['ticket']);
    }
?>