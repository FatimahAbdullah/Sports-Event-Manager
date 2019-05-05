<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
  include_once '../../config/Database.php';
  include_once '../../models/Club.php';
  // Instantiate DB & connect
  date_default_timezone_set("Asia/Karachi");
  
  $database = new Database();
  $db = $database->connect();
  $response_arr["status_code"] = 200;  
  $response_arr["status_message"] = "Club added successfully!";
  // Instantiate club object
  $club = new Club($db);
  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));
  
  $club->clubName = $data->clubName;
  $club->description = $data->description;
  $club->creationDate = date("Y-m-d H:i:s");
  $club->founderUid = $data->founderUid;
  $club->type = $data->type;
  // add club in db
  if($club->add_club()) {
    echo json_encode($response_arr);
  } else {
    echo json_encode($response_arr["status_code"] = 400, $response_arr["status_message"] = "Club name is not unique");
  }