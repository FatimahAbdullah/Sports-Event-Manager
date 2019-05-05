<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
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
  $sport->sport_id = $data->sport_id;
  $sport->sportName = $data->sportName;
 
  // Create Sport
  if($sport->create()) {
    echo json_encode(
      array('message' => 'sport Created')
    );
  } else {
    echo json_encode(
      array('message' => 'sport Not Created')
    );
  }
