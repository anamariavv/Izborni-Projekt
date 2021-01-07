<?php
    session_start();
    
    require_once "database_connect.inc.php";
    if($_SESSION['user_level'] == 'student') {
        $fname = mysqli_real_escape_string($conn, $_POST['fname']);
        $lname = mysqli_real_escape_string($conn, $_POST['lname']);
        $oib = mysqli_real_escape_string($conn, $_POST['oib']);
        $age = mysqli_real_escape_string($conn, $_POST['age']);
        $university = mysqli_real_escape_string($conn, $_POST['university']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $city = mysqli_real_escape_string($conn, $_POST['city']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $postal = mysqli_real_escape_string($conn, $_POST['postal']);
    }


?>