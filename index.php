<?php
header('Content-type:application/json;'); 
$json = array();

$json['endpoints'] = ['/cinemas', '/customers', '/employees', '/halls', '/movies', '/playtimes', '/prices', '/reservations', '/tickets'];
echo json_encode($json);
?>