<?php
// write logout code
session_start();
unset($_SESSION['admin_login']);
unset($_SESSION['admin_email']);
unset($_SESSION['admin_name']);

// destroy session
// deletes all the sessions of this domain and resets PHPSESSID cookie
// session_destroy(); 

header("Location: login.php");
die;