<?php

require_once 'database_object.php'; 

class movie extends database_object
{
    private $pdo;
    public static $table_name = "Movie";
    public static $id = "Id";
    public static $db_fields = array("Id", "Title", "Description", "Duration");
    public $movie_id;
    public $movie_title;
    public $movie_description;
    public $movie_duration;

    function __construct(){
        $this->pdo = $this->connect();
    }  
}
