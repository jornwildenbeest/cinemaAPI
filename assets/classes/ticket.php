<?php

require_once 'database_object.php'; 

class ticket extends database_object
{
    private $pdo;
    public static $table_name = "Ticket";
    public static $id = "Id";
    public static $db_fields = array("Id", "Reservation_id", "Price_id");
    public $ticket_id;
    public $ticket_reservation_id;
    public $ticket_price_id;

    function __construct(){
        $this->pdo = $this->connect();
    }
}
