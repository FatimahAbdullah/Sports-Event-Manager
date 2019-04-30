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
  $response_arr["status_message"] =       "Event added Successfully!"; //default ..else failure message

  // Initialize User object
  $user = new User($db_conn);

  // Getting raw posted data 
  $data = json_decode(file_get_contents("php://input"));
  
  $user->eventName = $data->eventName;
  $user->description = $data->description;
  $user->date = $data->date;
  $user->location = $data->location;
  $user->addedByUId = $data->addedByUid;
  $user->forClub = $data->forClub;

  // SignUp User ...create entry in db
  if($user->signUp())
    {
    echo json_encode($response_arr);
     } 
  else {
    $response_arr["status_code"] = 301;
    $response_arr["status_message"] = "Event cant be created";
    echo json_encode($response_arr);
  }

