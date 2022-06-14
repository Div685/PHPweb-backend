<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');


include_once '../config/Database.php';
include_once '../models/Products.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate category object
$products = new Products($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$products->SKU = $data->SKU;
$products->Name = $data->Name;
$products->Price = $data->Price;
$products->Measure = $data->Measure;


// Create Post

if ($products->create()) {
  echo json_encode(
    array('message' => 'Product Created!')
  );
} else {
  echo json_encode(
    array('message' => 'Product Not Created!')
  );
}
