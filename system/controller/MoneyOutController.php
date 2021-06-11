<?php
class MoneyOutController
{

    public function getGlobalController()
    {
    return new GlobalController();
    }

    public function manageMoneyOut($data){
        include($_SERVER['DOCUMENT_ROOT'] . "/lumina/system/config/database.php");
        $database = new Database();
        $query = "call manageMoneyOut(".$data['id_salida'].", ".$data['monto'].", '".$data['concepto']."', ".$data['accion'].")";
        $runQuery = $database->query($query);

        if($runQuery){
            echo 'true';
        }else{
            echo 'false';
        }
    }

}

if(isset($_POST['money'])){
    $money = new MoneyOutController();
    $money->manageMoneyOut($_POST['money']);
}


