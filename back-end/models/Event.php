<?php
  class Event {
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
      $query = 'SELECT e.eventName , e.eventId, e.description, e.date, e.location
                FROM ' . $this->table . ' e
                LEFT JOIN
                club c ON e.forClub = c.clubId
                ORDER BY
                e.date DESC';

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
        public function read_single() {
              // Create query
              $query = 'SELECT e.eventName , e.eventId, e.description, e.date, e.location
                        FROM ' . $this->table . ' e
                        WHERE
                        e.eventId = ?
                        LIMIT 0,1';
              // Prepare statement
              $stmt = $this->conn->prepare($query);
              // Bind ID
              $stmt->bindParam(1, $this->eventId);
              // Execute query
              $stmt->execute();
              $row = $stmt->fetch(PDO::FETCH_ASSOC);
              // Set properties
              $this->eventId = $row['eventId'];
              $this->eventName = $row['eventName'];
              $this->description = $row['description'];
              $this->date = $row['date'];
              $this->location = $row['location'];
        }


        // Delete Post
        public function delete() {
              // Create query
              $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
              // Prepare statement
              $stmt = $this->conn->prepare($query);
              // Clean data
              $this->id = htmlspecialchars(strip_tags($this->id));
              // Bind data
              $stmt->bindParam(':id', $this->id);
              // Execute query
              if($stmt->execute()) {
                return true;
              }
              // Print error if something goes wrong
              printf("Error: %s.\n", $stmt->error);
              return false;
        }
    }
