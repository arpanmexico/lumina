<?php
include($_SERVER['DOCUMENT_ROOT'] . "/lumina/system/config/database.php");

class GlobalController
{
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

    public function addToLogFile($log_msg)
    {
        $logfile_name = 'logs';
        if (!file_exists($logfile_name)) {
            mkdir($logfile_name, 0777, true);
        }
        $log_file_data = $logfile_name . '/log_' . date('d-M-Y') . '.log';

        file_put_contents($log_file_data, $log_msg . "\n", FILE_APPEND);
    }

    public function getFormattedDate($unformatted_date)
    {
        // 0 => Año , 1 => Mes , 2 => Dia y Hora
        $date = explode('-', $unformatted_date);
        // 0 => Día 1 => Hora
        $time = explode(' ', $date[2]);

        echo $time[0] . " de " . GlobalController::getMonths()[$date[1]] . " de " . $date[0] . " a las " . $time[1];
    }

    public function getMonths()
    {
        $months = array(
            '01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo',
            '04' => 'Abril', '05' => 'Mayo', '06' => 'Junio',
            '07' => 'Julio', '08' => 'Agosto', '09' => 'Septiembre',
            '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre'
        );

        return $months;
    }
}
