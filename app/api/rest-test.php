<?php 
session_start();

print_r($_SESSION);

header('Content-Type: application/json');
$input = json_decode(file_get_contents('php://input'));


?>