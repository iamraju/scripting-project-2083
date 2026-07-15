<?php
// Load bootstrap and setup file
include_once './bootstrap.php';
include_once './libraries/category.php';
include_once './libraries/product.php';
$category = new Category();
$categories = $category->selectAll("select * from categories where status = 1 order by name asc");

$product = new Product();
$sql = "select 
      products.*,
      categories.name as category_name 
   from products 
   inner join categories on products.category_id = categories.id
   where products.status = 1 order by products.name asc";
$products = $product->selectAll($sql);
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <?php include_once './includes/head.php'; ?>

      <title><?php echo get_site_title("Our Products"); ?></title>
   </head>
   <body>
      <!-- ============================================================
         TOP BAR
         ============================================================ -->
      <?php include_once './includes/topbar.php'; ?>
      <!-- ============================================================
         NAVBAR
         ============================================================ -->
      <?php include_once './includes/nav.php'; ?>
      <!-- ============================================================
         FIX 1 � SEARCH OVERLAY POPUP
         ============================================================ -->
      <?php include_once './includes/searchform.php'; ?>
      
      <!-- SHOP -->
      <section id="menu">
         <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
               <span class="slbl">What's Cooking</span>
               <h2 class="stitle">Our Delicious <span>Menu</span></h2>
               <div class="sline"></div>
            </div>
            <!-- FIX 3 � filter buttons -->
            <div class="text-center mb-4" data-aos="fade-up">
               <button class="filtbtn active" data-f="all">All</button>

               <?php foreach($categories as $category) { ?>
               <button class="filtbtn" data-f="<?php echo strtolower($category['name']); ?>"><?php echo $category['name']; ?></button>
               <?php } ?>

            </div>
            <div class="row g-4" id="mgrid">
               <!-- CARD 1: Burgers -->
                <?php foreach($products as $product) { ?>
               <div class="col-sm-6 col-lg-4 mwrap" data-c="<?php echo strtolower($product['category_name']); ?>" data-aos="fade-up">
                  <div class="mcard"
                     data-img="img/menu/1.jpg"
                     data-title="<?php echo $product['name']; ?>"
                     data-cat="<?php echo $product['category_name']; ?>"
                     data-price="<?php echo $product['price']; ?>" data-old="$18.99"
                     data-rating="4.9" data-reviews="128"
                     data-cal="620" data-time="12"
                     data-desc="<?php echo $product['description']; ?>"
                     data-tags="Spicy,Bestseller,Beef">
                     <div class="mimg">
                        <?php if (!empty($product['image_name'])): ?>
                           <img src="./product-images/<?php echo $product['image_name']; ?>" alt="<?php echo $product['name']; ?>"/>
                        <?php else: ?>
                           <img src="img/menu/1.jpg" alt="Smash Burger"/>
                        <?php endif; ?>
                        <div class="mbdg hot"><i class="fas fa-star"></i> Hot</div>
                        <div class="mhrt"><i class="far fa-heart"></i></div>
                     </div>
                     <div class="mbody">
                        <div class="mcat"><?php echo $product['category_name']; ?></div>
                        <div class="mtit"><?php echo $product['name']; ?></div>
                        <div class="mdesc"><?php echo $product['short_info']; ?></div>
                        <div class="mfoot">
                           <div>
                              <div class="mprice"><?php echo $product['price']; ?> <small>$18.99</small></div>
                              <div class="mstars"><i class="fas fa-star"></i> <span style="color:#bbb;font-size:.7rem;">(128)</span></div>
                           </div>
                           <button class="madd" title="View Details"><i class="fas fa-plus"></i></button>
                        </div>
                     </div>
                  </div>
               </div>
               <?php } ?>

            </div>
            <!-- end #mgrid -->
            <div class="text-center mt-5"><a href="#" class="btn-red"><i class="fas fa-th-large"></i>View Full Menu</a></div>
         </div>
      </section>
	  
      <!-- FOOTER -->
      
      <?php include_once './includes/footer.php'; ?>

      <!-- Floating cart -->
      <!-- <div class="cartfl"><i class="fas fa-shopping-cart"></i><span>My Cart</span><div class="ccount" id="cartCount">0</div></div> -->
      <!-- Back to top -->
      <button id="btt" onclick="window.scrollTo({top:0,behavior:'smooth'})"><i class="fas fa-chevron-up"></i></button>
    
	   <!-- jQuery -->
      <script src="js/jquery-3.7.1.min.js"></script>
      <!-- Bootstrap 5 -->
      <script src="js/bootstrap.bundle.min.js"></script>
      <!-- AOS -->
      <script src="js/aos.js"></script>
      <!-- Swiper -->
      <script src="js/swiper-bundle.min.js"></script>
      <!-- CounterUp -->
      <script src="js/jquery.magnific-popup.min.js"></script>
      <!-- Main js -->
      <script src="js/main.js"></script>
   </body>
</html>
