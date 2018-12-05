<?php

require_once 'database_object.php'; 

class price extends database_object
{
    private $pdo;
    public static $table_name = "Prices";
    public static $id = "Id";
    public static $db_fields = array("Id", "Name", "Price");
    public $price_id;
    public $price_name;
    public $price_price;

    function __construct(){
        $this->pdo = $this->connect();
    }
}
