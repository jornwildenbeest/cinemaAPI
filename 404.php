<?php
header('Content-type:application/json;');

$json = array();
$json[] = "Endpoint does not exist";
echo json_encode($json);