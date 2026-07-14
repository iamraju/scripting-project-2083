<?php
$var = fn() => "Hello, World!";

include_once "./includes/islogin.php";

// include all files required
include_once '../bootstrap.php';

// include categories model/class file
require_once '../libraries/product.php';

$product = new Product();

$sql = "SELECT 
	products.*,
    categories.name AS category_name
FROM `products`
INNER JOIN categories ON categories.id = products.category_id";
$products = $product->selectAll($sql);
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
                <h3 class="mb-0">Products</h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Products</li>
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
                    <h3 class="card-title">List of products</h3>

                    <a href="./product_form.php" class="btn btn-primary">Add Product</a>
                  </div>

                  <?php include_once "./includes/alert-messages.php"; ?>

                  <!-- /.card-header -->
                  <div class="card-body">
                    <table class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Product Name</th>
                          <th>Category</th>
                          <th>Price</th>
                          <th>Stock</th>
                          <th>Photo</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($products as $product) {?>
                        <tr>
                          <td><?php echo $product['id']; ?></td>
                          <td><?php echo $product['name']; ?></td>
                          <td><?php echo $product['category_name']; ?></td>
                          <td>Rs.<?php echo $product['price']; ?></td>
                          <td><?php echo $product['stock']; ?></td>
                          <td>
                            <?php if(isset($product['image_name']) && !empty($product['image_name'])){ ?>
                              <img width="100" src="../product-images/<?php echo $product['image_name']; ?>" alt="<?php echo $product['name']; ?>" />
                            <?php } ?>
                          </td>
                          <td class="d-flex gap">
                            <a href="./product_form.php?id=<?php echo $product['id']; ?>" class="me-3 btn btn-sm btn-primary">Edit</a>
                            <a onclick="return confirm('Are you sure to delete this product?');" href="./product_delete.php?id=<?php echo $product['id']; ?>" class="me-3 btn btn-sm btn-danger">Delete</a>
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
</html>
