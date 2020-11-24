<?php
    
    if(isset($_POST['signupsubmit'])) {

        require_once('database_connect.inc.php');

        $fname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $lname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $age = mysqli_real_escape_string($conn, $_POST['age']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $city = mysqli_real_escape_string($conn, $_POST['city']);
        $uni = mysqli_real_escape_string($conn, $_POST['university']);
        $password1 = mysqli_real_escape_string($conn, $_POST['pwd1']);
        $password2 = mysqli_real_escape_string($conn, $_POST['pwd2']);

        //check for empty fields
        if(empty($fname) || empty($lname) ||  empty($age) || empty($email) || empty($city) || empty($uni) || empty($password1) || empty($password2)) {
            header("Location: ../signup.php?error=empty_fields");
            exit();
        }

        //check if email is taken
        $sql = "SELECT * FROM student WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if(mysqli_num_rows($result) > 0) {
            //the email is taken so redirect back so signup page
            header("Location: ../signup.php?error=email_taken");
        } 

        //check for valid password (password1)

        //then check if passwords match

        //insert user into database

    } else {
        //we accessed the .inc script in an invalid way
        header("Location: ../signup.php"); 
        exit();
    }