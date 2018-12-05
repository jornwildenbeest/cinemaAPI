<?php

require_once 'database_object.php'; 

class employee extends database_object
{
    private $pdo;
    public static $table_name = "Employee";
    public static $id = "Id";
    public static $db_fields = array("Id", "Firstname", "Lastname", "Adress", "Zipcode", "Town");
    public $employee_id;
    public $employee_firstname;
    public $employee_lastname;
    public $employee_adress;
    public $employee_zipcode;
    public $employee_town;

    function __construct(){
        $this->pdo = $this->connect();
    }
}
