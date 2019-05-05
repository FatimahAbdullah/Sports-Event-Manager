<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  include_once '../../config/Database.php';
  include_once '../../models/Sport.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog post object
  $sport = new Sport($db);
  // Blog post query
  $result = $sport->read();
  // Get row count
  $num = $result->rowCount();
  // Check if any Events
  if($num > 0) {
    // Event array
    $sport_arr = array();
    // $posts_arr['data'] = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $sport_item = array(
        'sport_id' => $sport_id,
        'sportName' => $sportName,
      );
      // Push to "data"
      array_push($sport_arr, $sport_item);
      // array_push($posts_arr['data'], $post_item);
    }
    // Turn to JSON & output
    echo json_encode($sport_arr);
  } else {
    // No Posts
    echo json_encode(
      array('message' => 'No Sports Found')
    );
  }