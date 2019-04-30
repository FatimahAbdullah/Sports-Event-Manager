<?php
  class User {
    // DB and its table
    private $conn;
    private $table = 'user';//Table Name

    // User Object Attributes
    public $uid;
    public $userName;
    public $fullName;
    public $email;
    public $password;
    public $about;
    public $forgetPasswordQA;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get All Users
    public function read() {
      // Create query
      $query = 'SELECT * FROM ' . $this->table ;

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get One User
    public function fetchSpecificUser() {
          // Create query
          $query = 'SELECT *  FROM ' . $this->table . '
                                    WHERE
                                      uid = ?
                                    LIMIT 0,1';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->uid);

          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
          $this->userName = $row['userName'];
          $this->fullName = $row['fullName'];
          $this->email = $row['email'];
          $this->password = $row['password'];
          $this->about = $row['about'];
          $this->forgetPasswordQA = $row['forgetPasswordQA'];
          return $stmt;

    }

    // SignUp User
    public function signUp() {
      // Create query
      $query = 'INSERT INTO ' . $this->table . ' SET userName = :userName, fullName = :fullName,
      email = :email, password = :password, about = :about, forgetPasswordQA = :forgetPasswordQA';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Clean data..make sure no html or special chars there as user sent data
      $this->userName = htmlspecialchars(strip_tags($this->userName));
      $this->fullName = htmlspecialchars(strip_tags($this->fullName));
      $this->email = htmlspecialchars(strip_tags($this->email));
      $this->password = htmlspecialchars(strip_tags($this->password));
      $this->about= htmlspecialchars(strip_tags($this->about));
      $this->forgetPasswordQA = htmlspecialchars(strip_tags($this->forgetPasswordQA));

      // Bind data
      $stmt->bindParam(':userName', $this->userName);
      $stmt->bindParam(':fullName', $this->fullName);
      $stmt->bindParam(':email', $this->email);
      $stmt->bindParam(':password', $this->password);
      $stmt->bindParam(':about', $this->about);
      $stmt->bindParam(':forgetPasswordQA', $this->forgetPasswordQA);

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

    // Update User Full Profile
    public function editCompleteProfile() {
          // Create query to update all the user fields
          $query = 'UPDATE ' . $this->table . '
                                SET userName = :userName, fullName = :fullName, email = :email, password = :password, about = :about, forgetPasswordQA = :forgetPasswordQA
                                WHERE uid = :uid';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->uid = htmlspecialchars(strip_tags($this->uid));
          $this->userName = htmlspecialchars(strip_tags($this->userName));
          $this->fullName = htmlspecialchars(strip_tags($this->fullName));
          $this->email = htmlspecialchars(strip_tags($this->email));
          $this->password = htmlspecialchars(strip_tags($this->password));
          $this->about = htmlspecialchars(strip_tags($this->about));
          $this->forgetPasswordQA = htmlspecialchars(strip_tags($this->forgetPasswordQA));
          // Bind data
          $stmt->bindParam(':uid', $this->uid);
          $stmt->bindParam(':userName', $this->userName);
          $stmt->bindParam(':fullName', $this->fullName);
          $stmt->bindParam(':email', $this->email);
          $stmt->bindParam(':password', $this->password);
          $stmt->bindParam(':about', $this->about);
          $stmt->bindParam(':forgetPasswordQA', $this->forgetPasswordQA);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }

    //Edit Partial...........................

     public function editUserName() {
          // Create query to update only userName field
          $query = 'UPDATE ' . $this->table . '
                                SET userName = :userName
                                WHERE uid = :uid';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->uid = htmlspecialchars(strip_tags($this->uid));
          $this->userName = htmlspecialchars(strip_tags($this->userName));

          // Bind data
          $stmt->bindParam(':uid', $this->uid);
          $stmt->bindParam(':userName', $this->userName);


          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }

     public function editAbout() {
          // Create query to update only userName field
          $query = 'UPDATE ' . $this->table . '
                                SET about = :about
                                WHERE uid = :uid';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->uid = htmlspecialchars(strip_tags($this->uid));
          $this->userName = htmlspecialchars(strip_tags($this->about));

          // Bind data
          $stmt->bindParam(':uid', $this->uid);
          $stmt->bindParam(':about', $this->about);


          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }
     public function editEmail() {
          // Create query to update only email field
          $query = 'UPDATE ' . $this->table . '
                                SET email = :email
                                WHERE uid = :uid';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->uid = htmlspecialchars(strip_tags($this->uid));
          $this->email = htmlspecialchars(strip_tags($this->email));

          // Bind data
          $stmt->bindParam(':uid', $this->uid);
          $stmt->bindParam(':email', $this->email);


          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }

     public function editForgetPasswordQA() {
          // Create query to update only forgetPasswordQA field
          $query = 'UPDATE ' . $this->table . '
                                SET forgetPasswordQA = :forgetPasswordQA
                                WHERE uid = :uid';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->uid = htmlspecialchars(strip_tags($this->uid));
          $this->forgetPasswordQA = htmlspecialchars(strip_tags($this->forgetPasswordQA));

          // Bind data
          $stmt->bindParam(':uid', $this->uid);
          $stmt->bindParam(':forgetPasswordQA', $this->forgetPasswordQA);


          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }
    public function editPassword() {
          // Create query to update only forgetPasswordQA field
          $query = 'UPDATE ' . $this->table . '
                                SET password = :password
                                WHERE uid = :uid';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->uid = htmlspecialchars(strip_tags($this->uid));
          $this->password = htmlspecialchars(strip_tags($this->password));

          // Bind data
          $stmt->bindParam(':uid', $this->uid);
          $stmt->bindParam(':password', $this->password);


          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }
  }
