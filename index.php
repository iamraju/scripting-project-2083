<?php
// Load bootstrap and setup file
include_once './bootstrap.php';

include_once './libraries/category.php';
$category = new Category();
$categories = $category->selectAll("select * from categories where status = 1 order by name asc");
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <?php include_once './includes/head.php'; ?>

      <title><?php echo get_site_title(); ?></title>
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
      <!-- ============================================================
         HERO
         ============================================================ -->
      <section id="hero">
         <div class="hs hs1"></div>
         <div class="hs hs2"></div>
         <div class="hbgtxt">FOOD</div>
         <div class="container">
            <div class="row align-items-center g-5" style="min-height:88vh;">
               <div class="col-lg-6">
                  <div class="hbadge">
                     <div class="hbi"><i class="fas fa-star"></i></div>
                     <span>#1 Rated Fast Food Restaurant in New York</span>
                  </div>
                  <h1 class="htitle">Delicious <span class="hl">Fast Food</span><br/>for Every Moment</h1>
                  <p class="hdesc">Experience bold flavors crafted from premium ingredients. From crispy burgers to gourmet pizzas - every bite is an adventure worth savoring.</p>
                  <div class="d-flex flex-wrap gap-3 mb-2">
                     <a href="#menu" class="btn-red"><i class="fas fa-utensils"></i>Explore Menu</a>
                     <!-- FIX 2: Magnific popup video trigger -->
					 <a href="https://www.youtube.com/watch?v=RXv_uIN6e-Y" class="magnific_popup btn-play popup-youtube">
						<div class="pico"><i class="fas fa-play"></i></div>
						<span>Watch Our Story</span>
					 </a>
                  </div>
                  <div class="hstats d-flex gap-3 flex-wrap mt-4">
                     <div class="hstat"><span class="snum">850<em>+</em></span><small>Happy Customers</small></div>
                     <div class="sdiv"></div>
                     <div class="hstat"><span class="snum">120<em>+</em></span><small>Menu Items</small></div>
                     <div class="sdiv"></div>
                     <div class="hstat"><span class="snum">15<em>+</em></span><small>Expert Chefs</small></div>
                     <div class="sdiv"></div>
                     <div class="hstat"><span class="snum">12<em>yr</em></span><small>Experience</small></div>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div style="position:relative;text-align:center;">
                     <div class="hcircle">
                        <img src="img/banner-img.jpg" alt="Burger"/>
                     </div>
                     <div class="fcard fc1">
                        <div class="fcoi r"><i class="fas fa-fire"></i></div>
                        <div><span class="fcnum">Hot Deal</span><span class="fcsm">30% off today</span></div>
                     </div>
                     <div class="fcard fc2">
                        <div class="fcoi y"><i class="fas fa-star"></i></div>
                        <div><span class="fcnum">4.9/5</span><span class="fcsm">2k+ reviews</span></div>
                     </div>
                     <div class="fcard fc3">
                        <div class="fcoi g"><i class="fas fa-clock"></i></div>
                        <div><span class="fcnum">20 min</span><span class="fcsm">Fast delivery</span></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- MARQUEE -->
      <div class="mqsec">
         <div class="mqtrack">
            <div class="mqitem"><i class="fas fa-circle"></i>Crispy Fried Chicken</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Gourmet Burgers</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Artisan Pizzas</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Fresh Wraps &amp; Rolls</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Loaded Fries</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Ice Cream Shakes</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Grilled Sandwiches</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Crispy Fried Chicken</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Gourmet Burgers</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Artisan Pizzas</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Fresh Wraps &amp; Rolls</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Loaded Fries</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Ice Cream Shakes</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Grilled Sandwiches</div>
         </div>
      </div>
      <!-- CATEGORY -->
      <section id="category">
         <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
               <span class="slbl">What We Offer</span>
               <h2 class="stitle">Browse by <span>Category</span></h2>
               <div class="sline"></div>
               <p class="sdesc mx-auto" style="max-width:480px;">From sizzling burgers to exotic world cuisines - find your favourite in our menu</p>
            </div>
            <div class="row g-3 justify-content-center">
               <div class="col-6 col-sm-4 col-md-3 col-lg-2" data-aos="zoom-in" data-aos-delay="0">
                  <div class="catcard active" data-filter="all">
                     <img class="catimg" src="img/category/1.jpg" alt=""/>
                     <div class="catnm">All Items</div>
                     <div class="catct">99 items</div>
                  </div>
               </div>

               <?php foreach($categories as $category) {?>
               <div class="col-6 col-sm-4 col-md-3 col-lg-2" data-aos="zoom-in" data-aos-delay="70">
                  <div class="catcard" data-filter="burgers">
                     <?php if(isset($category['image_name']) && !empty($category['image_name'])){ ?>
                     <img class="catimg" src="./category-images/<?php echo $category['image_name']; ?>" alt="<?php echo $category['name']; ?>"/>
                     <?php } else { ?>
                     <img class="catimg" src="img/category/2.jpg" alt=""/>
                     <?php } ?>

                     <div class="catnm"><?php echo $category['name']; ?></div>
                     <div class="catct"><?php echo $category['item_count'] ?? 0; ?> items</div>
                  </div>
               </div>
               <?php } ?>

               
            </div>
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
