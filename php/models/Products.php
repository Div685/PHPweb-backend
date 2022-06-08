<?php
  class Products {
    // DB Stuff

    private $conn;
    private $table = 'products';

    // Properties
    public $SKU;
    public $Name;
    public $Price;
    public $Measure;

    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Products

    public function read() {
      $query = 'SELECT SKU, Name, Price, Measure FROM '. $this->table .' ORDER BY created_at DESC';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();
 
      return $stmt;
    }

    public function create() {
      try {

        $query = 'INSERT INTO ' . $this->table . ' 
            SET 
            SKU = :SKU, 
            Name = :Name, 
            Price = :Price, 
            Measure = :Measure';

            // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->SKU      = htmlspecialchars(strip_tags($this->SKU));
        $this->Name     = htmlspecialchars(strip_tags($this->Name));
        $this->Price    = htmlspecialchars(strip_tags($this->Price));
        $this->Measure  = htmlspecialchars(strip_tags($this->Measure));

        // Bind data
        $stmt-> bindParam(':SKU', $this->SKU);
        $stmt-> bindParam(':Name', $this->Name);
        $stmt-> bindParam(':Price', $this->Price);
        $stmt-> bindParam(':Measure', $this->Measure);


        // Execute query
        if($stmt->execute()) {
          return true;
        }

        // Print error if something goes wrong
        printf("Error: $s. \n", $stmt->error);

        return false;

      } catch(PDOException $exception) {
        die('ERROR: ' . $exception->getMessage());
      }

    }

    // Delete Selected Products

    public function delete($ids) {
      try {
        // sanitize
        $ids = htmlspecialchars(strip_tags($ids));

        $query = 'DELETE FROM ' . $this->table . ' WHERE id IN ($ids)';
        
        // return query
        $stmt = $this->conn->prepare($query);

        if($stmt->execute()){
          return true;
        }
         // Print error if something goes wrong
         printf("Error: $s. \n", $stmt->error);

         return false;

      } catch (PDOException $e) {
        die('ERROR: '. $e->getMessage());
      }
    }
  }
?>