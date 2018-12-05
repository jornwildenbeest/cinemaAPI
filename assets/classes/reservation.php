<?php

require_once 'database_object.php'; 

class reservation extends database_object
{
    private $pdo;
    public static $table_name = "Reservation";
    public static $id = "Id";
    public static $db_fields = array("Id", "Playtime_id", "Employee_id", "Customer_id");
    public $reservation_id;
    public $reservation_playtime_id;
    public $reservation_employee_id;
    public $reservation_customer_id;

    function __construct(){
        $this->pdo = $this->connect();
    }
}
