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

  $products = new Products($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  if(isset($_POST['checkbox'])){
    $checkedId = $_POST['checkbox'];
    $deleteMsg = $products->deleteMultipleData($db, $checkedId);
  }
  
  // function deleteMultipleData($conn, $checkedId){
  //   $checkedIdGroup = implode(',', $checkedId);
  //   $query = "DELETE FROM products WHERE pid IN ($checkedIdGroup)";
  //   $result = $conn->query($query);
  //   if($result==true){
  //     echo "<h1> Product Deleted Successfully </h1>";
  //     header("location:index.php");
  //     echo json_encode(
  //       array('message' => 'Product Deleted!')
  //     );
  //     header("location:index.php");
  //   } else {
  //     echo json_encode(
  //       array('message' => 'Something Went Wrong!')
  //     );
  //   }
  //   return $result;
  // }
// if($_POST) {
  
// //   // Headers
// //   // header('Access-Control-Allow-Origin: *');
// //   // header('Content-Type: application/json');
// //   // header('Access-Control-Allow-Methods: DELETE');
// //   // header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

// //   include_once '../config/Database.php';
// //   include_once '../models/Products.php';

// //   // Instantiate DB & connect
// //   $database = new Database();
// //   $db = $database->connect();
  
// //   // Instantiate Product object
// //   $products = new Products($db);

//   $ids = "";
//   foreach($_POST['checkbox'] as $id){
//     $ids = $id.", ";
//     echo 'id:'.$ids;
//   }
//   // $ids = trim($ids, ",");

//   // delete the product
//   if($products->delete($ids)) {

//     echo $ids.'Product Deleted Successfully!';
//     return true;
//   }
//   // if($products->delete($ids)) {
//   //   echo json_encode(
//   //     array('message' => 'Product Deleted!')
//   //   );
//   // }else {
//   //   echo json_encode(
//   //     array('message' => 'Something Went Wrong!')
//   //   );
//   // }

//   echo $product->delete($ids) ? "true" : "false";

// }
?>