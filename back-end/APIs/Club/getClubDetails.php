<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  include_once '../../config/Database.php';
  include_once '../../Models/Club.php';
  // Initialize database and create
  $database = new Database();
  $db_conn = $database->connect();
  // Instantiate User object
  $club = new Club($db_conn);
  // Get ID from request Url eg eg.php?id=3
  $club->clubName = isset($_GET['clubName']) ? $_GET['clubName'] : die();
  // Get User of specified uid
  $result = $club->get_club_details();
  $num = $result->rowCount();
  if($num>0)
  {
    // Create array to return response
    $club_arr = array();
    $club_arr['club_details']  = array();
    $club_arr["status_code"] = 200;  
    $club_arr["status_message"] = "Club Found!"; 
  $club_item = array(
    'clubId' => $club->clubId,
    'clubName' => $club->clubName,
    'description' => $club->description,
    'creationDate' => $club->creationDate,
    'founderUid' => $club->founderUid,
    'type' => $club->type,
    );
  // Push to "club_data"
  array_push($club_arr["club_data"], $club_item);
  // Make JSON
  print_r(json_encode($club_arr));
  }
  else
  {
    // No club
    echo json_encode(
    $club_arr["status_code"]    =       299,  
    //$club_arr["status_message"] = 'No club Found with this name!' 
      //array('message' => 'No Users Found')
    );
  }