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
}
