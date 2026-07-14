<?php
include_once "./includes/islogin.php";

// include all files required
include_once '../bootstrap.php';

// include categories model/class file
require_once '../libraries/category.php';

$category = new Category();
// if the form is to edit category

$id = (int) Request::getGet('id');
if($id) {
  $editCategory = $category->findById($id);
}

// handle form submission
if(Request::isPost()) {
    $data = [
        'name' => Request::getPost('name'),
        'description' => Request::getPost('description'),
        'status' => Request::getPost('status')
    ];

    if($id) {
      $insertedId = $category->update($data, $id);
      $message = "Category updated successfully.";
    } else {
      $message = "Category added successfully.";
      $insertedId = $category->insert($data);
    }
    
    if($insertedId) {
        // redirect to categories list page
        $_SESSION['msg_success'] = $message;
        header("Location: categories.php");
        exit;
    } else {
        echo "Error inserting category.";
    }
}
?>
<!doctype html>
<html lang="en">
  <!--begin::Head-->
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
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-0">Add Category</h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="./">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Add Category</li>
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
        </div>
        <div class="app-content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="card card-primary card-outline mb-4">
                  <div class="card-header">
                    <div class="card-title">Add Category</div>
                  </div>

                  <form action="category_form.php?id=<?php echo $id; ?>" method="POST">
                    <div class="card-body">
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Name</label>
                        <input
                          type="text"
                          class="form-control"
                          id="name"
                          name="name"
                          value="<?php echo isset($editCategory['name']) ? $editCategory['name'] : ''; ?>"
                          required
                          aria-describedby="nameHelp"
                        />
                        <div id="nameHelp" class="form-text">
                          Enter the category name.
                        </div>
                      </div>

                      <label class="form-label">Status</label>
                      <div class="form-check mb-2">
                        <input
                          class="form-check-input"
                          type="radio"
                          name="status"
                          id="status-1"
                          value="1"
                          <?php echo isset($editCategory['status']) && $editCategory['status'] === '1' ? 'checked' : ''; ?>
                        />
                      <label class="form-check-label" for="status-1">Active</label>
                    </div>
                    <div class="form-check mb-3">
                      <input class="form-check-input" 
                        value="0" 
                        type="radio" 
                        name="status" 
                        id="status-0"
                        <?php echo isset($editCategory['status']) && $editCategory['status'] === '0' ? 'checked' : ''; ?>
                         />
                      <label class="form-check-label" for="status-0">Inactive</label>
                    </div>

                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control"><?php echo isset($editCategory['description']) ? $editCategory['description'] : ''; ?></textarea>
                      </div>
                    
                    </div>
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      <a href="./categories.php" class="btn btn-secondary">Cancel</a>
                    </div>
                  </form>
                </div>
              </div>
              <!-- /.col -->
              
              <!-- /.col -->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            
            <!-- /.row (main row) -->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->

      <!--begin::Footer-->
      <?php include './includes/footer.php'; ?>
      <!--end::Footer-->
      
    </div>
    
    <?php include './includes/footer-scripts.php'; ?>

  </body>
  <!--end::Body-->
</html>
