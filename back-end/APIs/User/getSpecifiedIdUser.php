<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/User.php';

  // Initialize database and create
  $database = new Database();
  $db_conn = $database->connect();

  // Instantiate User object
  $user = new User($db_conn);

  // Get ID from request Url eg eg.php?id=3
  $user->uid = isset($_GET['uid']) ? $_GET['uid'] : die();

  // Get User of specified uid
  $result = $user->fetchSpecificUser();
  $num = $result->rowCount();

  if($num>0)//means a user with this id was indeed found
  {
    // Create array to return response
    $user_arr =    array();
    $user_arr['user_data']  =     array();//actual user object data goes here
    $user_arr["status_code"]    =       200;  
    $user_arr["status_message"] =       "User Found!"; 

  $user_item = array(
    'uid' => $user->uid,
    'userName' => $user->userName,
    'fullName' => $user->fullName,
    'email' => $user->email,
    'password' => $user->password,
    'about' => $user->about,
    'forgetPasswordQA' => $user->forgetPasswordQA
  );
  // Push to "user_data"
  array_push($user_arr["user_data"], $user_item);

  // Make JSON
  print_r(json_encode($user_arr));
  }
  else
  {
    $user_arr["status_code"]    =       299;  
    $user_arr["status_message"] =       "No User Found Against Given Id!";
    // No Users
    echo json_encode($user_arr);
  }

  