<?php
  class User {
    // DB and its table
    private $conn;
    private $table = 'event';//Table Name

    // User Object Attributes
    public $eventId;
    public $eventName;
    public $description;
    public $date;
    public $location;
    public $addedByUid;
    public $forClub;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get All Events
    public function read() {
      // Create query
      $query = 'SELECT * FROM ' . $this->table ;

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }
    // Create Event
    public function create() {
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' SET eventName = :eventName, description  = :description,
        date = :date, location = :location, addedByUid = :addedByUid, forClub = :forClub';
    
        // Prepare statement
        $stmt = $this->conn->prepare($query);
    
        // Clean data..make sure no html or special chars there as user sent data
        $this->eventName = htmlspecialchars(strip_tags($this->eventName));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->date = htmlspecialchars(strip_tags($this->date));
        $this->location = htmlspecialchars(strip_tags($this->location));
        $this->addedByUid= htmlspecialchars(strip_tags($this->addedByUid));
        $this->forClub = htmlspecialchars(strip_tags($this->forClub));
    
        // Bind data
        $stmt->bindParam(':eventName', $this->eventName);
        $stmt->bindParam(':description', $this->description); 
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':location', $this->location);
        $stmt->bindParam(':addedByUid', $this->addedByUid);
        $stmt->bindParam(':forClub', $this->forClub);
    
        try{
            // Execute query
            if($stmt->execute()) {
            return true;
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
    
        return false;
        }
    }