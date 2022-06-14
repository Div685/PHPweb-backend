<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

include_once '../config/Database.php';
include_once '../models/Products.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

$products = new Products();

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

if (isset($_POST['checkbox'])) {
  $checkedId = $_POST['checkbox'];
  $deleteMsg = $products->deleteMultipleData($checkedId);
}
