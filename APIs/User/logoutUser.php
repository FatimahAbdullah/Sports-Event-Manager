<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/User.php';

// Initialize DB & connect
$database = new Database();
$db_conn = $database->connect();
$response_arr["status_code"]    =       200;
$response_arr["status_message"] =       "Logged out Successfully!"; //default ..else failure message

// Initialize User object
$user = new User($db_conn);
session_start();
// Getting raw posted data 
if(isset($_SESSION['userName'])){
    unset($_SESSION['userName']);
    echo json_encode($response_arr);
}
else {
  $response_arr["status_code"] = 301;
  $response_arr["status_message"] = "No user already Logged in!";
  echo json_encode($response_arr);
}
