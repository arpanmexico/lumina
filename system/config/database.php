<?php

class Database extends mysqli
{    
    private $DB_HOST = '34.71.80.62';
    private $DB_USER = 'root';
    private $DB_PASS = 'yKI5G7bzaIxp842H';
    private $DB_NAME = 'lumina';

    public function __construct()
    {
        parent::__construct($this->DB_HOST, $this->DB_USER, $this->DB_PASS, $this->DB_NAME);
        if ($this->connect_errno) {
            die('Error en la conexión ' . mysqli_connect_errno());
            exit();
        } else {
            //echo "Conectado";
            mysqli_set_charset($this, 'utf8');
        }
    }
}