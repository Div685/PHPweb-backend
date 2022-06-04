<?php

$host = 'db';
$user = 'devuser'; // divUser
$password = 'devpass'; //G+XwvPc{FDJ2jiYm
$db = 'test_db';

// $dsn = 'mysql:host='.$this->$host.';dbname='.$this->$db, $this->$user, $this->$password;

// $conn = new mysqli($host,$user,$password,$db);
try {
  $conn = new PDO('mysql:host='.$host.';dbname='.$db, $user, $password);
} catch (PDOException $e) {
  echo 'Connection Error '.$e->getMessage();
}


//$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
//$db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
//$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($conn->connect_error) {
  echo 'Connection Failed' . $conn->connect_error;
  exit;
}

echo 'Succesfuly connected to MySQL';

?>
