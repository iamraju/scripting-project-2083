<?php
include_once "./includes/islogin.php";

// include all files required
include_once '../bootstrap.php';

// include categories model/class file
require_once '../libraries/category.php';

$category = new Category();
$id = (int) Request::getGet('id');

if ($id) {
  $categoryExists = $category->findById($id);
  if(!$categoryExists) {
    $_SESSION['msg_error'] = "Given id ($id) does not exist in the database.";
    header("Location: ./categories.php");
    die;
  }

  $ifCategoryHasProducts = $category->selectOne("select id from products where category_id=$id");
  if($ifCategoryHasProducts) {
    $_SESSION['msg_error'] = "Cannot delete category. Products exist under this category.";
    header("Location: ./categories.php");
    die;
  }

  $category->delete($id);
  $_SESSION['msg_success'] = "Category deleted successfully.";
  header("Location: ./categories.php");
  die;
}
else {
  $_SESSION['msg_error'] = "Invalid category id.";
  header("Location: ./categories.php");
  die;
}