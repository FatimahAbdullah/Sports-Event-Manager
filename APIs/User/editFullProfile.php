<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/User.php';

  // Initialize DB & connect
  $database = new Database();
  $db_conn = $database->connect();
  $response_arr["status_code"]    =       200;  
  $response_arr["status_message"] =       "Profile Edited Successfully!"; //default ..else failure message

  // Initialize user object
  $user = new User($db_conn);

  // Get raw posted data 
  $data = json_decode(file_get_contents("php://input"));

  // Set values to update...based on id its done
  $user->uid = $data->uid;

  $user->userName = $data->userName;
  $user->fullName = $data->fullName;
  $user->email = $data->email;
  $user->password = $data->password;
  $user->about = $data->about;
  $user->forgetPasswordQA = $data->forgetPasswordQA;


  // Update User Attributes
  if($user->editCompleteProfile()) 
  {
    echo json_encode( $response_arr);
  }
   else 
  {
    echo json_encode($response_arr["status_code"] = 305, $response_arr["status_message"] = "Error, Profile Could Not be Edited!"
    );
  }

