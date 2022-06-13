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
      $query = 'SELECT pid, SKU, Name, Price, Measure FROM '. $this->table .' ORDER BY created_at DESC';

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

        // printf("Err", $ids);
        $val = "122";

        // $query = 'DELETE FROM ' . $this->table . ' WHERE pid IN ($ids)';
        $query = 'DELETE FROM products WHERE pid IN ('. $ids .')';

        echo ''.$query;
        // return query
        $stmt = $this->conn->prepare($query);

        if($stmt->execute()){
          echo 'Successfull';
          return true;
        }else {
         printf("Error: $s. \n", $stmt->error);
          return false;
        }
         // Print error if something goes wrong
        //  printf("Error: $s. \n", $stmt->error);

        //  return false;

      }  catch(PDOException $exception) {
        die('ERROR: '. $exception->getMessage());
      }
    }

    function deleteMultipleData($conn, $checkedId){
      try {

        $checkedIdGroup = implode(',', $checkedId);
        $query = "DELETE FROM products WHERE pid IN ($checkedIdGroup)";
        echo ''.$query;

        $result = $this->conn->prepare($query);
        echo $result->execute() ? 'true' : 'False';
      // $result = $conn->query($query);
      if($result==true){
        echo "<h1> Product Deleted Successfully </h1>";
        echo json_encode(
          array('message' => 'Product Deleted!')
        );
        // header("location:index.php");
      } else {
        echo json_encode(
          array('message' => 'Something Went Wrong!')
        );
      }
       // Execute query
      // if($result->execute()) {
      //   return true;
      // }

      // // Print error if something goes wrong
      // printf("Error: $s. \n", $result->error);

      // return false;
      } catch(PDOException $exception) {
        die('ERROR: '. $exception->getMessage());
      }
    }

  }
?>