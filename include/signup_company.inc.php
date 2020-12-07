<?php
    if(isset($_POST['signup_companysubmit'])) {

        require_once("database_connect.inc.php");
        $cname = mysqli_real_escape_string($conn, $_POST['cname']);
        $city = mysqli_real_escape_string($conn, $_POST['city']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $postal = mysqli_real_escape_string($conn, $_POST['postal']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $field = mysqli_real_escape_string($conn, $_POST['field']);
        $pwd1 = mysqli_real_escape_string($conn, $_POST['pwd1']);
        $pwd2 = mysqli_real_escape_string($conn, $_POST['pwd2']);

        //check for empty fields
        if(empty($cname) || empty($city) || empty($address) || empty($postal) || empty($email) || empty($phone) || empty($field) || empty($pwd1) || empty($pwd2)) {
            header("Location: ../signup_company.php?error=empty_fields");
            exit();
        }

        //check for taken email
        $sql = "SELECT * FROM company WHERE email = ?";
        if(!($stmt = $conn->prepare($sql))) {
            header("Location: ../signup_company.php?error=sql");
            exit();
        }
        if(!($stmt->bind_param("s", $email))) {
            header("Location: ../signup_company.php?error=sql");
            exit();
        }
        if(!$stmt->execute()) {
            header("Location: ../signup_company.php?error=sql");
            exit();
        }
        $result = $stmt->get_result();
        if(mysqli_num_rows($result) > 0) {
            //the email is taken so redirect back so signup page
            header("Location: ../signup_company.php?error=email_taken");
            exit();
        } 
        
        //if email is free, check for valid password
        if(!preg_match('/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,32}$/', $pwd1)) {
            header("Location: ../signup_company.php?error=password_weak");
            exit();
        }

        //check if passwords match
        if($pwd1 != $pwd2) {
            header("Location: ../signup_company.php?error=password_mismatch");
            exit();
        }

        //insert company into database
        $id = bin2hex(random_bytes(32));
        $user_level_id = 3;
        $password_hashed = password_hash($pwd1, PASSWORD_BCRYPT);
        $sql = "INSERT INTO company(id,name,city,address,postal_code,email,phone_number,field,user_level_id,password) VALUES (?,?,?,?,?,?,?,?,?,?)";
        if(!($stmt = $conn->prepare($sql))) {
            header("Location: ../signup_company.php?error=sql");
            exit();
        }  
        if(!($stmt->bind_param("ssssisssis", $id, $cname, $city, $address, $postal, $email, $phone, $field, $user_level_id, $password_hashed))) {
            header("Location: ../signup_company.php?error=sql");
            exit();
        } 
        if(!$stmt->execute()) {
            header("Location: ../signup_company.php?error=sql");
            exit();
        }
        //if all was successful, return to index page
        header("Location: ../index.php?success");
        exit();
    } else {
        header("Location: ../signup_company.php");
        exit();
    }