<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
  include_once '../../config/Database.php';
  include_once '../../models/Sport.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog post object
  $sport = new Sport($db);
  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));
  // Set ID to update
  $sport->sport_id = $data->sport_id;
  $sport->sportName = $data->sportName;
 
  // Update post
  if($sport->update()) {
    echo json_encode(
      array('message' => 'Sport Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Sport Not Updated')
    );
  }
