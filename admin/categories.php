<?php
include_once "./includes/islogin.php";

include_once '../bootstrap.php';
require_once '../libraries/category.php';

$category = new Category();
$categories = $category->selectAll("select * from categories");

?>
<!doctype html>
<html lang="en">
  <head>
    <?php include './includes/head.php'; ?>
    <title>Administrative Panel - Swastik E-Commerce</title>
  </head>
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
      <?php include './includes/header.php'; ?>
      <?php include './includes/sidebar.php'; ?>
      <main class="app-main">
        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-0">Categories</h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Categories</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="app-content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="card mb-4">
                  <div class="card-header">
                    <h3 class="card-title">List of categories</h3>
                    
                      <a href="./category_form.php" class="btn btn-primary">Add New Category</a>
                    
                  </div>
                  
                  <?php include_once "./includes/alert-messages.php"; ?>
                  <div class="card-body">
                    <table class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Category Name</th>
                          <th>Description</th>
                          <th>Image</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($categories as $category) {?>
                        <tr>
                          <td><?php echo $category['id']; ?></td>
                          <td><?php echo $category['name']; ?></td>
                          <td><?php echo $category['description']; ?></td>
                          <td>
                            <?php if(isset($category['image_name']) && !empty($category['image_name'])){ ?>
                              <img width="100" src="../category-images/<?php echo $category['image_name']; ?>" alt="<?php echo $category['name']; ?>" />
                            <?php } ?>
                          </td>
                          <td><?php echo $category['status'] == '1' ? 'Active' : 'Inactive'; ?></td>
                          <td class="d-flex gap">
                            <a href="./category_form.php?id=<?php echo $category['id']; ?>" class="btn btn-sm btn-primary me-2">Edit</a>
                            <a onclick="return confirm('Are you sure to delete this category ?');" href="./category_delete.php?id=<?php echo $category['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                  <?php include './includes/pagination.php'; ?>
                </div>

              </div>
            </div>
          </div>
        </div>
      </main>
      <?php include './includes/footer.php'; ?>
    </div>
    
    <?php include './includes/footer-scripts.php'; ?>
  </body>
  <!--end::Body-->
</html>
