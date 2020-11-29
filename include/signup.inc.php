<?php

    
    if(isset($_POST['signupsubmit'])) {

        require_once('database_connect.inc.php');

        $oib = mysqli_real_escape_string($conn, $_POST['oib']);
        $fname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $lname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $age = mysqli_real_escape_string($conn, $_POST['age']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $city = mysqli_real_escape_string($conn, $_POST['city']);
        $uni = mysqli_real_escape_string($conn, $_POST['university']);
        $password1 = mysqli_real_escape_string($conn, $_POST['pwd1']);
        $password2 = mysqli_real_escape_string($conn, $_POST['pwd2']);

        //check for empty fields
        if(empty($oib) || empty($fname) || empty($lname) ||  empty($age) || empty($email) || empty($city) || empty($uni) || empty($password1) || empty($password2)) {
            header("Location: ../signup.php?error=empty_fields");
            exit();
        }

        //check if email is taken
        $sql = "SELECT * FROM student WHERE email = ?";
        if(!($stmt = $conn->prepare($sql))) {
            header("Location: ../signup.php?error=sql_prepare1");
            exit();
        }
        if(!($stmt->bind_param("s", $email))) {
            header("Location: ../signup.php?error=sql_bind1");
            exit();
        }
        if(!($stmt->execute())) {
            header("Location: ../signup.php?error=sql_execute1");
            exit();
        }
        $result = $stmt->get_result();
        if(mysqli_num_rows($result) > 0) {
            //the email is taken so redirect back so signup page
            header("Location: ../signup.php?error=email_taken");
            exit();
        } 

        //if email was alright-> check for valid password (password1)
        if(!preg_match('/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,32}$/', $password1)) {
            header("Location: ../signup.php?error=password_weak");
            exit();
        }

        //then check if passwords match
        if($password1 != $password2) {
            header("Location: ../signup.php?error=password_mismatch");
            exit();
        }

        //insert user into database
        $sql = "INSERT INTO student(oib,firstname,lastname,age,email,city,university,user_level_id,password) VALUES (?,?,?,?,?,?,?,?,?);";
        //if the statement prepare fails
        if(!($stmt = $conn->prepare($sql))) {
            header("Location: ../signup.php?error=sql_prepare2");
            exit();
        }
        $password_hashed = password_hash($password1, PASSWORD_BCRYPT);
        $user_level_id = 2;

        //if binding fails
        if(!($stmt->bind_param("ississsis", $oib, $fname, $lname, $age, $email, $city, $uni, $user_level_id, $password_hashed))) {
            header("Location: ../signup.php?error=sql_bind2");
            exit();
        }
        //if execution fails
        if(!($stmt->execute())) {
            header("Location: ../signup.php?error=sql_execute2");
            exit();
        }
        //if all was successful, return to signup page
        header("Location: ../index.php?success");
        exit();
    } else {
        //we accessed the .inc script in an invalid way
        header("Location: ../signup.php"); 
        exit();
    }