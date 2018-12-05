<?php

require_once 'database_object.php'; 

class customer extends database_object
{
    private $pdo;
    public static $table_name = "Customer";
    public static $id = "Id";
    public static $db_fields = array("Id", "Firstname", "Lastname", "Adress", "Zipcode", "Town");
    public $customer_id;
    public $customer_firstname;
    public $customer_lastname;
    public $customer_adress;
    public $customer_zipcode;
    public $customer_town;

    function __construct(){
        $this->pdo = $this->connect();
    }  
}
