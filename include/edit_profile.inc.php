<?php
    session_start();
    require_once "database_connect.inc.php";
    
    if($_SESSION['user_level'] == 'student') {
        $fname = mysqli_real_escape_string($conn, $_POST['fname']);
        $lname = mysqli_real_escape_string($conn, $_POST['lname']);
        $oib = mysqli_real_escape_string($conn, $_POST['oib']);
        $age = mysqli_real_escape_string($conn, $_POST['age']);
        $university = mysqli_real_escape_string($conn, $_POST['university']);
        
    } else {
        $cname = mysqli_real_escape_string($conn, $_POST['cname']);
        $field = mysqli_real_escape_string($conn, $_POST['field']);
        $website = mysqli_real_escape_string($conn, $_POST['website']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
    }

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $postal = mysqli_real_escape_string($conn, $_POST['postal']);

    if($_SESSION['user_level'] == 'student') {
        if(empty($phone)) $phone = NULL;     
        if(empty($address)) $address = NULL;  
        if(empty($postal)) $postal = NULL;    
        if(empty($city) ||empty($fname) || empty($lname) || empty($oib) || empty($age) || empty($university)) {
            header("Location: ../profile.php?error=empty_fields");
            exit();
        }

        $sql = "UPDATE student SET  oib = ?, firstname = ?, lastname = ?, age = ?,
        email = ?, phone_number = ?, city = ?, address = ?, postal_code = ?, university = ? WHERE oib = " . $_SESSION['oib'];
        if(!($stmt = $conn->prepare($sql))) {
            header("Location: ../profile.php?error=sql");
            exit();
        }
        if(!($stmt->bind_param("issisissis", $oib, $fname, $lname, $age, $email, $phone, $city, $address, $postal, $university))) {
            header("Location: ../profile.php?error=sql");
            exit();
        }
        if(!($stmt->execute())) {
            header("Location: ../profile.php?error=sql");
            exit();
        }
        header("Location: ../profile.php?success");
    } else {
        if(empty($website)) $website = NULL;
        if(empty($description)) $description = NULL;
        if(empty($cname) || empty($email) || empty($phone) || empty($city) || empty($address) || empty($postal) || empty($field)) {
            header("Location: ../profile.php?error=empty_fields");
            exit();
        }

        $sql = 'UPDATE company SET name = ?, city = ?, address = ?,
        postal_code = ?, email = ?, phone_number = ?, website = ?, description = ?, field = ? WHERE id = "'. $_SESSION['id']. '"';
    
        if(!($stmt = $conn->prepare($sql))) {
            header("Location: ../profile.php?error=sql");
            exit();
        }

        if(!($stmt->bind_param("sssisisss", $cname, $city, $address, $postal, $email, $phone, $website, $description, $field))) {
            header("Location: ../profile.php?error=sql");
            exit();
        }

        if(!($stmt->execute())) {
            header("Location: ../profile.php?error=sql");
            exit();
        }

        header("Location: ../profile.php?success");
    }    

?>