<?php

    if(isset($_POST["loginsubmit"])) {

        require_once "database_connect.inc.php";

        $email = mysqli_real_escape_string($conn,$_POST["email"]);
        $password = mysqli_real_escape_string($conn,$_POST["password"]); 
        $type = mysqli_real_escape_string($conn,$_POST["type"]);
       
        //check for empty fields
        if(empty($email) || empty($password) || empty($type)) {
            header("Location: ../login.php?error=empty_fields");
            exit();
        }

        //prepare query->use $type for table name because we have 2 user types
        $sql = "SELECT * FROM " . $type . " WHERE email = ?";
        if(!($stmt = $conn->prepare($sql))) {
            header("Location: ../login.php?error=sql");
            exit();
        }
        if(!($stmt->bind_param("s", $email))) {
            header("Location: ../login.php?error=sql");
            exit();
        }
        if(!($stmt->execute())) {
            header("Location: ../login.php?error=sql");
            exit();
        }
        
       
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        //if the user doesn't exist
        if(!$row) {
            header("Location: ../login.php?error=not_found");
            exit();
        }
        
        //check password
        if(!password_verify($password, $row["password"])) {
            header("Location: ../login.php?error=incorrect_password");
            exit();
        }

        //everything was successful, start session, set session variables and return to homepage
        session_start();
        //might need to add different variables based on user type later on
        $_SESSION["status"] = "logged";
        $_SESSION["user_level"] = $type;
        if($type == "student") {
            $_SESSION["oib"] = $row["oib"];
            $_SESSION["firstname"] = $row["firstname"];
        } else if($type == "company") {
            $_SESSION["id"] = $row["id"];
            $_SESSION["name"] = $row["name"];
        }
        header("Location: ../index.php");
    } else { //if we tried to access the page incorrectly
        header("Location: ../login.php");
    }