<?php
class Sport
{
    // DB stuff
    private $conn;
    private $table = 'sport';
    // Event Properties
    public $sport_id;
    public $sportName;

    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }
    // Get Events
    public function read()
    {
        // Create query
        $query = 'SELECT s.sport_id , s.sportName
                FROM ' . $this->table . ' s
                ORDER BY
                s.sport_id ASC';

        // Prepare statement
        $stmt = $this->conn->prepare($query);
        // Execute query
        $stmt->execute();
        return $stmt;
    }
    public function getName($sport_id){
         // Create query
         $query = 'SELECT sportName FROM' . $this->table . ' WHERE sport_id = :sport_id';
         // Prepare statement
         $stmt = $this->conn->prepare($query);
         // Clean data
         $this->sport_id = htmlspecialchars(strip_tags($sport_id));
 
         // Bind data
         $stmt->bindParam(':sport_id', $this->sport_id);
 
         // Execute query
         if ($stmt->execute()) {
             return true;
         }
         // Print error if something goes wrong
         printf("Error: %s.\n", $stmt->error);
         return '';
    }
    // Create Post
    public function create()
    {
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' SET sport_id = :sport_id, sportName = :sportName';
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        // Clean data
        $this->sport_id = htmlspecialchars(strip_tags($this->sport_id));
        $this->sportName = htmlspecialchars(strip_tags($this->sportName));

        // Bind data
        $stmt->bindParam(':sport_id', $this->sport_id);
        $stmt->bindParam(':sportName', $this->sportName);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
        return false;
    }


    // Update Post
    public function update()
    {
        // Create query
        $query = 'UPDATE ' . $this->table . '
                              SET  sportName = :sportName
                              WHERE sport_id = :sport_id';
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        // Clean data
        $this->sportName = htmlspecialchars(strip_tags($this->sportName));
        $this->sport_id = htmlspecialchars(strip_tags($this->sport_id));

        // Bind data
        $stmt->bindParam(':sportName', $this->sportName);
        $stmt->bindParam(':sport_id', $this->sport_id);


        // Execute query
        if ($stmt->execute()) {
            return true;
        }
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
        return false;
    }


    // Delete Post
    public function delete()
    {
        // Create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE sport_id = :sport_id';
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        // Clean data
        $this->sport_id = htmlspecialchars(strip_tags($this->sport_id));
        // Bind data
        $stmt->bindParam(':sport_id', $this->sport_id);
        // Execute query
        if ($stmt->execute()) {
            return true;
        }
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
}
