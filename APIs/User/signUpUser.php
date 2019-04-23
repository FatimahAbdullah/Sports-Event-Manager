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
  $response_arr["status_message"] =       "Signed Up Successfully!"; //default ..else failure message

  // Initialize User object
  $user = new User($db_conn);

  // Getting raw posted data 
  $data = json_decode(file_get_contents("php://input"));

  $user->userName = $data->userName;
  $user->fullName = $data->fullName;
  $user->email = $data->email;
  $user->password = $data->password;
  $user->about = $data->about;
  $user->forgetPasswordQA = $data->forgetPasswordQA;

  // SignUp User ...create entry in db
  if($user->signUp())
    {
    echo json_encode($response_arr);
     } 
  else {
    echo json_encode($response_arr["status_code"] = 301, $response_arr["status_message"] = "Invalid Credentials"
    );
  }

