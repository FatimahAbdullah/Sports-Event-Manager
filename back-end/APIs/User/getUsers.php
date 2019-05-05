<?php
  // Headers
  header('Access-Control-Allow-Origin: *');//since a public API
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/User.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate User object
  $users = new User($db);

  // users get query
  $result = $users->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any posts
  if($num > 0) {
    // User array..but we dont just wanna return simple user object details but may wanna return additional
    $users_arr = array();
    $users_arr['user_data'] = array();//actual user object data goes here
    $users_arr["status_code"]    =       200;
    $users_arr["status_message"] =       "Database indeed contains User/s!";


    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $user_item = array(
        'uid' => $uid,
        'userName' => $userName,
        'email' => $email,
        'password' => $password,
        'about' => html_entity_decode($about),
        'forgetPasswordQA' => $forgetPasswordQA,
 
      );

      // Push to "user_data"
      array_push($users_arr["user_data"], $user_item);
    }

    // Turn to JSON & output
    echo json_encode($users_arr);

  } else {
    // No Users
    $users_arr = array();
    $users_arr["status_code"]    =       409;
    $users_arr["status_message"] =       "No User Found In Database!";
    echo json_encode($users_arr);
  }
