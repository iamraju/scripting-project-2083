<?php
// Load bootstrap and setup file
include_once './bootstrap.php';
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <?php include_once './includes/head.php'; ?>

      <title><?php echo get_site_title("About Us"); ?></title>
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
      
      <!-- ABOUT -->
      <section id="about">
         <div class="container">
            <div class="row align-items-center g-5">
               <div class="col-lg-5" data-aos="fade-right">
                  <div class="astack">
                     <div class="aexp"><span class="anum">12+</span><small>Years of<br/>Excellence</small></div>
                     <div class="amain"><img src="img/about1.jpg" alt="Restaurant"/></div>
                     <div class="asm"><img src="img/about2.jpg" alt=""/></div>
                  </div>
               </div>
               <div class="col-lg-7" data-aos="fade-left">
                  <span class="slbl">Our Story</span>
                  <h2 class="stitle text-start">We Invite You to Visit<br/>Our <span>Food Restaurant</span></h2>
                  <div class="sline lft"></div>
                  <p class="sdesc mb-4">Founded in 2012, Sarab began as a small corner joint with a big dream - to serve food that brings people together. Today we're proud to serve thousands of happy customers every week with the same passion that started it all.</p>
                  <div class="mb-4">
                     <div class="fti">
                        <div class="ftico r"><i class="fas fa-leaf"></i></div>
                        <div>
                           <h6>100% Fresh Ingredients</h6>
                           <p>We source locally and sustainably. Every ingredient is hand-picked daily for maximum freshness.</p>
                        </div>
                     </div>
                     <div class="fti">
                        <div class="ftico y"><i class="fas fa-award"></i></div>
                        <div>
                           <h6>Award-Winning Recipes</h6>
                           <p>Our signature recipes have won national culinary awards 5 years in a row.</p>
                        </div>
                     </div>
                     <div class="fti">
                        <div class="ftico g"><i class="fas fa-shipping-fast"></i></div>
                        <div>
                           <h6>Lightning-Fast Delivery</h6>
                           <p>Order online and get hot, fresh food at your door in under 25 minutes, guaranteed.</p>
                        </div>
                     </div>
                  </div>
                  <a href="#menu" class="btn-red"><i class="fas fa-book-open"></i>View Full Menu</a>
               </div>
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
