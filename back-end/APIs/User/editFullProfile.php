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
  $rest_json = file_get_contents("php://input");
  $_POST = json_decode($rest_json, true);
  
  if(isset($_POST["uid"]) && isset($_POST["userName"]) && isset($_POST["password"]) && isset($_POST["email"]) && isset($_POST["about"])){
    
    
    // Set values to update...based on id its done
    $user->uid = $_POST["uid"];
    $user->userName = $_POST["userName"];
    $user->password =$_POST["password"];
    $user->about=$_POST["about"];
    $user->email=$_POST["email"];
    $user->forgetPasswordQA=$_POST["forgetPasswordQA"];

    // Update UserName Attribute
    if($user->editUserName()) 
    {
      echo json_encode( $response_arr);
    }
    else 
    {
      $response_arr["status_code"] = 308;
      $response_arr["status_message"] = "Error, UserName Could Not be Edited!";
      echo json_encode($response_arr);
    }
  }
  else {
    $response_arr["status_code"] = 300;
    $response_arr["status_message"] = "Invalid Parameters";
    echo json_encode($response_arr);
  }

