<?php
class Database
{
  // DB params
  private $host = 'db'; //localhost
  private $db_name = 'test_db'; //id19004304_scandiproductsdb
  private $username = 'devuser'; // divUser
  private $password = 'devpass'; //G+XwvPc{FDJ2jiYm
  protected $conn;

  // DB Connect
  public function connect()
  {
    $this->conn = null;

    try {
      $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      echo 'Connection Error: ' . $e->getMessage();
    }

    return $this->conn;
  }
}
