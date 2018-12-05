<?php

require_once 'database_object.php'; 

class hall extends database_object
{
    private $pdo;
    public static $table_name = "Hall";
    public static $id = "Id";
    public static $db_fields = array("Id", "Cinema_id", "Name");
    public $hall_id;
    public $hall_cinema_id;
    public $hall_name;

    function __construct(){
        $this->pdo = $this->connect();
    }  
}
