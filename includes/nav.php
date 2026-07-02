<?php
global $mainMenuItems;
$currentPage = basename($_SERVER['SCRIPT_NAME']);
?>
<nav class="navbar navbar-expand-lg" id="nav">
         <div class="container">
            <a class="navbar-brand" href="./">
               <div class="blogo">
                  <div class="bico"><i class="fas fa-utensils"></i></div>
                  <div>
                     <div class="bname">Kalinchowk<span>Mobiles</span></div>
                     <div class="bsub">One stop shop for mobiles</div>
                  </div>
               </div>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
            <i class="fas fa-bars" style="color:var(--primary);font-size:1.35rem;"></i>
            </button>
            <div class="collapse navbar-collapse" id="navmenu">
               <ul class="navbar-nav mx-auto">
                  
                  <?php foreach($mainMenuItems as $mainMenuItem) {?>
                  <li class="nav-item">
                     <a class="nav-link" href="<?php echo $mainMenuItem['link']; ?>">
                        <?php echo $mainMenuItem['title']; ?>
                     </a>
                  </li>
                  <?php } ?>
                  
               </ul>
               <div class="d-flex align-items-center gap-1">
                  <!-- FIX 1: Search button -->
                  <button id="navSearchBtn" title="Search"><i class="fas fa-search"></i></button>
                  <!-- <a href="#menu" class="nav-link nav-cta"><i class="fas fa-shopping-bag me-1"></i>Order Now</a> -->
               </div>
            </div>
         </div>
      </nav>