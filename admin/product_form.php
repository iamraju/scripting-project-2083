<?php
include_once "./includes/islogin.php";
include_once '../bootstrap.php';
require_once '../libraries/product.php';
require_once '../libraries/category.php';

$product = new Product();
$id = (int) Request::getGet('id');
if($id) {
  $editProduct = $product->findById($id);
}

$category = new Category();
$categories = $category->selectAll("select * from categories");
$uploadDir = '../product-images';

// handle form submission
if(Request::isPost()) {

    $imageName = Request::getPost('old_image_name') ?? ''; // default to old image name if no new image is uploaded

    // check and handle image upload
    if(is_uploaded_file($_FILES['image_name']['tmp_name'])) {
        $imageName = time() . '-' . $_FILES['image_name']['name']; // get actual uploaded file's name
        move_uploaded_file($_FILES['image_name']['tmp_name'], $uploadDir . '/' . $imageName);

        $oldImageName = Request::getPost('old_image_name');
        if($oldImageName && file_exists($uploadDir . '/' . $oldImageName)) {
            unlink($uploadDir . '/' . $oldImageName);
        }
    }

    $data = [
        'name' => Request::getPost('name'),
        'short_info' => Request::getPost('short_info'),
        'description' => Request::getPost('description'),
        'status' => Request::getPost('status'),
        'is_sale' => Request::getPost('is_sale'),
        'is_featured' => Request::getPost('is_featured'),
        'sku' => Request::getPost('sku'),
        'category_id' => Request::getPost('category_id'),
        'price' => Request::getPost('price'),
        'sales_price' => Request::getPost('sales_price') ?? 0,
        'stock' => Request::getPost('stock') ?? 1,
        'image_name' => $imageName,
    ];

    if($id) {
      $insertedId = $product->update($data, $id);
      $message = "Product updated successfully.";
    } else {
      $message = "Product added successfully.";
      $insertedId = $product->insert($data);
    }
    
    if($insertedId) {
        // redirect to products list page
        $_SESSION['msg_success'] = $message;
        header("Location: products.php");
        exit;
    } else {
        $_SESSION['msg_error'] = 'Error inserting product.';
        header("Location: products.php");
        exit;
    }
}
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
                <h3 class="mb-0">Add Product</h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="./">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Add Product</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="app-content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="card card-primary card-outline mb-4">
                  <div class="card-header">
                    <div class="card-title">Add Product</div>
                  </div>

                  <form enctype="multipart/form-data" action="product_form.php?id=<?php echo $id; ?>" method="POST">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-6">
                          <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input
                              type="text"
                              class="form-control"
                              id="name"
                              name="name"
                              value="<?php echo isset($editProduct['name']) ? $editProduct['name'] : ''; ?>"
                              required
                            />
                          </div>

                          <div class="mb-3">
                            <label for="name" class="form-label">Short Info</label>
                            <input
                              type="text"
                              class="form-control"
                              id="short_info"
                              name="short_info"
                              value="<?php echo isset($editProduct['short_info']) ? $editProduct['short_info'] : ''; ?>"
                              required
                            />
                          </div>
                        

                          <label class="form-label">Status</label>
                          <div class="form-check mb-2">
                            <input
                              class="form-check-input"
                              type="radio"
                              name="status"
                              id="status-1"
                              value="1"
                              <?php echo isset($editProduct['status']) && $editProduct['status'] === '1' ? 'checked' : ''; ?>
                            />
                            <label class="form-check-label" for="status-1">Active</label>
                          </div>

                          <div class="form-check mb-3">
                            <input class="form-check-input" 
                              value="0" 
                              type="radio" 
                              name="status" 
                              id="status-0"
                              <?php echo isset($editProduct['status']) && $editProduct['status'] === '0' ? 'checked' : ''; ?>
                              />
                            <label class="form-check-label" for="status-0">Inactive</label>
                          </div>

                          <label class="form-label">Is Sale?</label>
                          <div class="form-check mb-2">
                            <input
                              class="form-check-input"
                              type="radio"
                              name="is_sale"
                              id="is_sale-1"
                              value="1"
                              <?php echo isset($editProduct['is_sale']) && $editProduct['is_sale'] === '1' ? 'checked' : ''; ?>
                            />
                            <label class="form-check-label" for="is_sale-1">Yes</label>
                          </div>

                          <div class="form-check mb-3">
                            <input class="form-check-input" 
                              value="0" 
                              type="radio" 
                              name="is_sale" 
                              id="is_sale-0"
                              <?php echo isset($editProduct['is_sale']) && $editProduct['is_sale'] === '0' ? 'checked' : ''; ?>
                              />
                            <label class="form-check-label" for="is_sale-0">No</label>
                          </div>

                          <label class="form-label">Is Featured?</label>
                          <div class="form-check mb-2">
                            <input
                              class="form-check-input"
                              type="radio"
                              name="is_featured"
                              id="is_featured-1"
                              value="1"
                              <?php echo isset($editProduct['is_featured']) && $editProduct['is_featured'] === '1' ? 'checked' : ''; ?>
                            />
                            <label class="form-check-label" for="is_featured-1">Yes</label>
                          </div>

                          <div class="form-check mb-3">
                            <input class="form-check-input" 
                              value="0" 
                              type="radio" 
                              name="is_featured" 
                              id="is_featured-0"
                              <?php echo isset($editProduct['is_featured']) && $editProduct['is_featured'] === '0' ? 'checked' : ''; ?>
                              />
                            <label class="form-check-label" for="is_featured-0">No</label>
                          </div>
                        </div>

                        <div class="col-6">
                          <div class="mb-3">
                            <label for="name" class="form-label">SKU</label>
                            <input
                              type="text"
                              class="form-control"
                              id="sku"
                              name="sku"
                              value="<?php echo isset($editProduct['sku']) ? $editProduct['sku'] : ''; ?>"
                              required
                            />
                          </div>

                          <div class="mb-3">
                            <label for="name" class="form-label">Category</label>

                            <select name="category_id" id="category_id" class="form-control">
                              <option value="">Select Category</option>
                              <?php foreach($categories as $cat) { ?>
                                <option value="<?php echo $cat['id']; ?>" <?php echo isset($editProduct['category_id']) && $editProduct['category_id'] == $cat['id'] ? 'selected' : ''; ?>>
                                  <?php echo $cat['name']; ?>
                                </option>
                              <?php } ?>
                            </select>
                          </div>
                          <div class="mb-3">
                            <label for="name" class="form-label">Price</label>

                            <input
                              type="number"
                              class="form-control"
                              id="price"
                              name="price"
                              value="<?php echo isset($editProduct['price']) ? $editProduct['price'] : ''; ?>"
                              required
                            />
                          </div>

                          <div class="mb-3">
                            <label for="name" class="form-label">Sales Price</label>

                            <input
                              type="number"
                              class="form-control"
                              id="sales_price"
                              name="sales_price"
                              value="<?php echo isset($editProduct['sales_price']) ? $editProduct['sales_price'] : ''; ?>"
                              required
                            />
                          </div>

                          <div class="mb-3">
                            <label for="name" class="form-label">Stock</label>

                            <input
                              type="number"
                              class="form-control"
                              id="stock"
                              name="stock"
                              value="<?php echo isset($editProduct['stock']) ? $editProduct['stock'] : ''; ?>"
                              required
                            />
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-12">
                          <?php if(isset($editProduct['image_name']) && !empty($editProduct['image_name'])){ ?>
                          <input type="hidden" name="old_image_name" value="<?php echo $editProduct['image_name']; ?>" />
                            <div class="img">
                              <img width="100" src="../product-images/<?php echo $editProduct['image_name']; ?>" alt="<?php echo $editProduct['name']; ?>" />
                              </div>
                            <?php } ?>

                          <div class="input-group mb-3">
                            
                            
                            <input type="file" class="form-control" name="image_name" id="image_name" />
                            <label class="input-group-text" for="image_name">Upload</label>
                          </div>
                        </div>
                      </div>
                    
                      <div class="row">
                        <div class="mb-3 mt-5">
                          <label for="description" class="form-label">Description</label>
                          <textarea name="description" id="description" class="form-control"><?php echo isset($editProduct['description']) ? $editProduct['description'] : ''; ?></textarea>
                        </div>
                      </div>
                    </div>
                    
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      <a href="./categories.php" class="btn btn-secondary">Cancel</a>
                    </div>
                  </form>
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
