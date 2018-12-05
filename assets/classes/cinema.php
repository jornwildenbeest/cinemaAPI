<?php

require_once 'database_object.php'; 


class cinema extends database_object
{
    private $pdo;
    public static $table_name = "Cinema";
    public static $id = "Id";
    public static $db_fields = array("Id", "Name", "Location");
    public $cinema_id;
    public $cinema_name;
    public $cinema_location;

    function __construct(){
        $this->pdo = $this->connect();
    }  
}
