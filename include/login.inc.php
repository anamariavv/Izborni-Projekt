<?php

    if(isset($_POST["loginsubmit"])) {

        require_once "database_connect.inc.php";

        $email = mysqli_real_escape_string($conn,$_POST["email"]);
        $password = mysqli_real_escape_string($conn,$_POST["password"]); 
       
        //check for empty fields
        if(empty($email) || empty($password)) {
            header("Location: ../login.php?error=empty_fields");
            exit();
        }

        //search in student
        $sql = "SELECT * FROM student WHERE email = ?";
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

        //if the user exists-> check password
        if($row) {
            if(!password_verify($password, $row["password"])) {
                header("Location: ../login.php?error=incorrect_password");
                exit();
            }

            session_start();

            $_SESSION["status"] = "logged";
            $_SESSION["user_level"] = "student";
            $_SESSION["oib"] = $row["oib"];
            header("Location: ../index.php");
            exit();
        }

        //search in company
        $sql = "SELECT * FROM company WHERE email = ?";
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

        //if the company exists-> check password
        if($row) {
            if(!password_verify($password, $row["password"])) {
                header("Location: ../login.php?error=incorrect_password");
                exit();
            }
            session_start();
            $_SESSION["status"] = "logged";
            $_SESSION["user_level"] = "company";
            $_SESSION["id"] = $row["id"];
            header("Location: ../index.php");
            exit();
        }

        //search in admin
        $sql = "SELECT * FROM admin WHERE email = ?";
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

        //if the admin exists-> check password
        if($row) {
            if(!password_verify($password, $row["password"])) {
                header("Location: ../login.php?error=incorrect_password");
                exit();
            }
            session_start();
            $_SESSION["status"] = "logged";
            $_SESSION["user_level"] = "administrator";
            $_SESSION["id"] = $row["id"];
            header("Location: ../index.php");
            exit();
        } else { //user wasn't found in all 3 tables
            header("Location: ../login.php?error=not_found");
            exit();
        }

    } else { //if we tried to access the page incorrectly
        header("Location: ../login.php");
    }