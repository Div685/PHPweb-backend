<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../config/Database.php';
include_once '../models/Products.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate category object
$products = new Products();

// Products read query
$result = $products->read();

// Get row count
$num = $result->rowCount();

// Check if any categories
if ($num > 0) {
  // Product array
  $product_arr = array();
  $product_arr['data'] = array();

  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    extract($row);

    $product_item = array(
      'pid' => $pid,
      'SKU' => $SKU,
      'Name' => $Name,
      'Price' => $Price,
      'Measure' => $Measure
    );

    // Push to "data"
    array_push($product_arr['data'], $product_item);
  }

  // Turn to JSON & output
  echo json_encode($product_arr);
} else {
  // No Categories
  echo json_encode(
    array('message' => 'No Categories Found')
  );
}
