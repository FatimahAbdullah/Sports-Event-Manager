<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PATCH');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/User.php';

  // Initialize DB & connect
  $database = new Database();
  $db_conn = $database->connect();
  $response_arr["status_code"]    =       200;  
  $response_arr["status_message"] =       "Password Edited Successfully!"; //default ..else failure message

  // Initialize user object
  $user = new User($db_conn);

  // Get raw posted data 
  $parameters = json_decode(file_get_contents("php://input"));

  // Set values to update...based on id its done
  $user->uid = $parameters->uid;
  $user->password = $parameters->password;



  // Update Password Attribute
  if($user->editPassword()) 
  {
    echo json_encode( $response_arr);
  }
   else 
  {
    echo json_encode($response_arr["status_code"] = 308, $response_arr["status_message"] = "Error, Password Could Not be Updated!"
    );
  }

