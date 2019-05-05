<?php 
  class Club {
    // DB stuff
    private $conn;
    private $table = 'club';
    // Post Properties
    public $clubid;
    public $clubName;
    public $description;
    public $creationDate;
    public $founderUid;
    public $type;
    public $sport;
    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }
    
    // Add club
    public function add_club() {
      // Create query
      $query = 'INSERT INTO ' . $this->table . ' SET clubName = :clubName, description = :description, 
      creationDate = :creationDate, founderUid = :founderUid, type = :type ';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Clean data..make sure no html or special chars there as user sent data
      $this->clubName = htmlspecialchars(strip_tags($this->clubName));
      $this->description = htmlspecialchars(strip_tags($this->description));
      $this->creationDate = htmlspecialchars(strip_tags($this->creationDate));
      $this->founderUid = htmlspecialchars(strip_tags($this->founderUid));
      $this->type= htmlspecialchars(strip_tags($this->type));
      // Bind data
      $stmt->bindParam(':clubName', $this->clubName);
      $stmt->bindParam(':description', $this->description);
      $stmt->bindParam(':creationDate', $this->creationDate);
      $stmt->bindParam(':founderUid', $this->founderUid);
      $stmt->bindParam(':type', $this->type);
      // Execute query
      if($stmt->execute()) {
        return true;
      }
      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);
      return false;
    }
    // Get club details
    public function get_club_details() {
      // Create query
      $query = 'SELECT *  FROM ' . $this->table . ' WHERE clubName = ? LIMIT 0,1';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Bind ID
      $stmt->bindParam(1, $this->clubName);
      // Execute query
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      // Set properties
      $this->clubId = $row['clubId'];
      $this->clubName = $row['clubName'];
      $this->description = $row['description'];
      $this->creationDate = $row['creationDate'];
      $this->founderUid = $row['founderUid'];
      $this->type = $row['type'];
      return $stmt;
}
    public function search_club() {
      // Create query
      $query = 'SELECT *  FROM ' . $this->table . ' WHERE clubId = ? LIMIT 0,1';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Bind ID
      $stmt->bindParam(1, $this->clubId);
      // Execute query
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      // Set properties
      $this->clubId = $row['clubId'];
      $this->clubName = $row['clubName'];
      $this->description = $row['description'];
      $this->creationDate = $row['creationDate'];
      $this->founderUid = $row['founderUid'];
      $this->type = $row['type'];
      return $stmt;
    }
    
    
    
    // public function get_club_details($name) {
    //   // Create query
    //   $query='SELECT * FROM ' . $this->table . 'WHERE clubname=' . $name .;
    //   // Prepare statement
    //   $stmt = $this->conn->prepare($query);
    //   // Execute query
    //   $stmt->execute();
    //   return $stmt;
    // }
  
    // // Update Post
    // public function update() {
    //       // Create query
    //       $query = 'UPDATE ' . $this->table . '
    //                             SET title = :title, body = :body, author = :author, category_id = :category_id
    //                             WHERE id = :id';
    //       // Prepare statement
    //       $stmt = $this->conn->prepare($query);
    //       // Clean data
    //       $this->title = htmlspecialchars(strip_tags($this->title));
    //       $this->body = htmlspecialchars(strip_tags($this->body));
    //       $this->author = htmlspecialchars(strip_tags($this->author));
    //       $this->category_id = htmlspecialchars(strip_tags($this->category_id));
    //       $this->id = htmlspecialchars(strip_tags($this->id));
    //       // Bind data
    //       $stmt->bindParam(':title', $this->title);
    //       $stmt->bindParam(':body', $this->body);
    //       $stmt->bindParam(':author', $this->author);
    //       $stmt->bindParam(':category_id', $this->category_id);
    //       $stmt->bindParam(':id', $this->id);
    //       // Execute query
    //       if($stmt->execute()) {
    //         return true;
    //       }
    //       // Print error if something goes wrong
    //       printf("Error: %s.\n", $stmt->error);
    //       return false;
    // }
    // // Delete Post
    // public function delete() {
    //       // Create query
    //       $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
    //       // Prepare statement
    //       $stmt = $this->conn->prepare($query);
    //       // Clean data
    //       $this->id = htmlspecialchars(strip_tags($this->id));
    //       // Bind data
    //       $stmt->bindParam(':id', $this->id);
    //       // Execute query
    //       if($stmt->execute()) {
    //         return true;
    //       }
    //       // Print error if something goes wrong
    //       printf("Error: %s.\n", $stmt->error);
    //       return false;
    // }
    
  }