<?php
// error_reporting(-1); // reports all errors
// ini_set("display_errors", "1"); // shows all errors
// ini_set("log_errors", 1);
// ini_set("error_log", "/tmp/php-error.log");

header('Content-type:application/json;'); 

require_once 'assets/classes/cinema.php';
require_once 'assets/classes/apikey.php';
$apikey = new apikey();
$apikey->checkkey();
$cinemas = new cinema();
$json = array();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && $apikey->Level >= 1) {

    // check if acces is granted.
    // check if user has the right level.
    if($apikey->getstatus() == 1){
        if(!isset($_GET['id'])){

            // get all items.
            $cinemas = $cinemas->find_all();
            // put all items in json array.
            foreach($cinemas as $cinema):
                $json[]= $cinema;
            endforeach;

            // show jwt key if client uses api for the first time.
            if($apikey->getused() == 0) {
                $json['jwtkey'] = $apikey->getjwtkey();
            }
            
            // update used column to 1;
            $apikey->Used = 1;
            $apikey->update($apikey->Id);

            // display all items in json
            echo json_encode($json);

        } else if (isset($_GET['id']) && is_numeric($_GET['id'])){
            // echo $_GET['id'];
            $cinemas = $cinemas->find_by_id($_GET['id']);

            // show jwt key if client uses api for the first time.
            if($apikey->getused() == 0) {
                $cinemas['jwtkey'] = $apikey->getjwtkey();
            }
            
            // update used column to 1;
            $apikey->Used = 1;
            $apikey->update($apikey->Id);

            // display all items in json
            echo json_encode($cinemas);

        }
    } else {
        $json['access'] = "invalid keys";
        echo json_encode($json);
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'POST' && $apikey->Level >= 2) { 
    if($apikey->getstatus() == 1){
        $json['access'] = "level 2 access"; 

        // show jwt key if client uses api for the first time.
        if($apikey->getused() == 0) {
            $json['jwtkey'] = $apikey->getjwtkey();
        }

        // update used column to 1;
        $apikey->Used = 1;
        $apikey->update($apikey->Id);

        // display all items in json
        echo json_encode($json);

    } else {
        $json['access'] = "invalid keys for level 2";
        echo json_encode($json);
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'PUT' && $apikey->Level >= 3) {
    if($apikey->getstatus() == 1){
         $json['access'] = "level 3 access"; 

        // show jwt key if client uses api for the first time.
        if($apikey->getused() == 0) {
            $json['jwtkey'] = $apikey->getjwtkey();
        }

        // update used column to 1;
        $apikey->Used = 1;
        $apikey->update($apikey->Id);
       
        // display all items in json
        echo json_encode($json);
    } else {
        $json['access'] = "invalid keys for level 3";
        echo json_encode($json);
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && $apikey->Level >= 4) { 
    if($apikey->getstatus() == 1){
         $json['access'] = "level 4 access"; 

        // show jwt key if client uses api for the first time.
        if($apikey->getused() == 0) {
            $json['jwtkey'] = $apikey->getjwtkey();
        }

        // update used column to 1;
        $apikey->Used = 1;
        $apikey->update($apikey->Id);

        // display all items in json
        echo json_encode($json);

    } else {
        $json['access'] = "invalid keys for level 4";
        echo json_encode($json);
    }
} else {
    $json['access'] = "no access";
    echo json_encode($json);
}

?>
 