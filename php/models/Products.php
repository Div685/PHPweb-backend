<?php
class Products
{
  // DB Stuff
  private $conn;
  private $table = 'products';

  // Properties
  public $SKU;
  public $Name;
  public $Price;
  public $Measure;

  public function __construct($db)
  {
    $this->conn = $db;
  }

  // Get Products

  public function read()
  {
    $query = 'SELECT pid, SKU, Name, Price, Measure FROM ' . $this->table . ' ORDER BY created_at DESC';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Execute query
    $stmt->execute();

    return $stmt;
  }

  public function create()
  {
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
      $stmt->bindParam(':SKU', $this->SKU);
      $stmt->bindParam(':Name', $this->Name);
      $stmt->bindParam(':Price', $this->Price);
      $stmt->bindParam(':Measure', $this->Measure);


      // Execute query
      if ($stmt->execute()) {
        return true;
      }

      // Print error if something goes wrong
      printf("Error: \n", $stmt->error);

      return false;
    } catch (PDOException $exception) {
      die('ERROR: ' . $exception->getMessage());
    }
  }

  // Delete Selected Products
  function deleteMultipleData($conn, $checkedId)
  {
    try {
      $checkedIdGroup = implode(',', $checkedId);
      $query = "DELETE FROM " . $this->table . " WHERE pid IN ($checkedIdGroup)";
      $result = $this->conn->prepare($query);
      if ($result == true) {
        echo json_encode(
          array('message' => 'Product Deleted!')
        );
      } else {
        echo json_encode(
          array('message' => 'Something Went Wrong!')
        );
      }
      // Execute query
      if ($result->execute()) {
        return true;
      }

      // Print error if something goes wrong
      printf("Error: \n", $result->error);

      return false;
    } catch (PDOException $exception) {
      die('ERROR: ' . $exception->getMessage());
    }
  }
}
