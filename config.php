<?php
// define a constant for site name
define('SITE_NAME', 'Swastik E-commerce');

// database connection settings
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root123');
define('DB_NAME', 'swastik_ecom');


// site main menus
$mainMenuItems = [
    [
        'title' => 'Home',
        'link' => './'
    ],
    [
        'title' => 'About',
        'link' => './about.php'
    ],
    [
        'title' => 'Our Products',
        'link' => './shop.php'
    ],
    [
        'title' => 'Testimonials',
        'link' => './testimonials.php'
    ],
    [
        'title' => 'Contact',
        'link' => './contact.php'
    ],

    [
        'title' => 'Booking',
        'link' => './booking.php'
    ],
    
];