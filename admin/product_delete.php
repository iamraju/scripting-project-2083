<?php
include_once "./includes/islogin.php";

// include all files required
include_once '../bootstrap.php';

// include categories model/class file
require_once '../libraries/product.php';

$product = new Product();

$id = (int) Request::getGet('id');

if ($id) {
  $productExists = $product->findById($id);
  if(!$productExists) {
    $_SESSION['msg_error'] = "Given id ($id) does not exist in the database.";
    header("Location: ./products.php");
    die;
  }

  $product->delete($id);
  $_SESSION['msg_success'] = "Product deleted successfully.";
  header("Location: ./products.php");
  die;
}
else {
  $_SESSION['msg_error'] = "Invalid category id.";
  header("Location: ./products.php");
  die;
}