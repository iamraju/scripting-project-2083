<?php
session_start();

include_once '../bootstrap.php';

$conn = new Database();
$conn = $conn->db; // get the mysqli connection object

// check if the form is submitted 
    // this page must be accesed through the form with method POST
if(Request::isPost()) {
    // get the email and password from the form
    $email = Request::getPost('email');
    $password = Request::getPost('password');

    // sql injection prevention
    // Admin123\'
    // select * from users where email='ram@gmail.com' and password=md5('ram123') or 1=1; --
    $email = $conn->real_escape_string($email);
    $password = $conn->real_escape_string($password);

    $sql = "SELECT * FROM users WHERE email = '$email'";

    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if(md5($password) !== $user['password']) {
            // if the password is incorrect, redirect to the login page with an error message
            $_SESSION['admin_login_error'] = 'Invalid password.';
            header('Location: login.php');
            exit;
        }
        // if the user is found, start a session and redirect to the admin index page

        $_SESSION['admin_login'] = true;
        $_SESSION['admin_email'] = $email;
        $_SESSION['admin_name'] = $user['name'];

        header('Location: index.php');
        exit;
    } else {
        // if the user is not found, redirect to the login page with an error message
        $_SESSION['admin_login_error'] = 'This email does not exist.';
        header('Location: login.php');
        exit;
    }
} else {
    // die('in valid access to the file, it must be visited via POST form');
    // if the form is not submitted, redirect to the login page
    header('Location: login.php');
    exit;
}