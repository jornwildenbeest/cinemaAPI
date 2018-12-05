<?php

require_once 'database_object.php'; 

class playtime extends database_object
{
    private $pdo;
    public static $table_name = "Playtime";
    public static $id = "Id";
    public static $db_fields = array("Id", "Hall_id", "Start", "End", "Movie_id");
    public $playtime_id;
    public $playtime_hall_id;
    public $playtime_start;
    public $playtime_end;
    public $playtime_movie_id;

    function __construct(){
        $this->pdo = $this->connect();
    }
}
