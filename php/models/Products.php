<?php

include_once '../config/Database.php';

class Products extends Database
{
  // DB Stuff
  protected $conn;
  private $table = 'products';

  // Properties
  public $SKU;
  public $Name;
  public $Price;
  public $Measure;

  public function __construct()
  {
    parent::connect();
  }

  public function setSKU($SKU)
  {
    $this->SKU = $SKU;
  }

  public function getSKU()
  {
    return $this->SKU;
  }

  public function setName($Name)
  {
    $this->Name = $Name;
  }

  public function getName()
  {
    return $this->Name;
  }

  public function setPrice($Price)
  {
    $this->Price = $Price;
  }

  public function getPrice()
  {
    return $this->Price;
  }

  public function setMeasure($Measure)
  {
    $this->Measure = $Measure;
  }

  public function getMeasure()
  {
    return $this->Measure;
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
      $this->setSKU(htmlspecialchars(strip_tags($this->getSKU())));
      $this->setName(htmlspecialchars(strip_tags($this->getName())));
      $this->setPrice(htmlspecialchars(strip_tags($this->getPrice())));
      $this->setMeasure(htmlspecialchars(strip_tags($this->getMeasure())));

      // Bind data
      $stmt->bindParam(':SKU', $this->getSKU());
      $stmt->bindParam(':Name', $this->getName());
      $stmt->bindParam(':Price', $this->getPrice());
      $stmt->bindParam(':Measure', $this->getMeasure());


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
  function deleteMultipleData($checkedId)
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
