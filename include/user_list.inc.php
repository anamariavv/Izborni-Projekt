<?php

    require_once "database_connect.inc.php";
    
    if(isset($_POST['messagesubmit'])) {

        $message = mysqli_real_escape_string($conn, $_POST['message_text']);
        
        if($_POST['type'] == 'student') {
            $column = "student_oib";
            $data = mysqli_real_escape_string($conn, $_POST['identification']);
        } else {
            $column = "company_id";
            $data = "'".mysqli_real_escape_string($conn, $_POST['identification'])."'";
        }

        $sql = "INSERT INTO notification(notif_text,".$column.") VALUES ('". $message ."', ". $data.")";

        if(!($conn->query($sql))) {
            header("Location: ../send_notification.php?error=sql");
            exit();
        } else {
            header("Location: ../user_list.php?message=sent");
            exit();
        }
    
    }else if(isset($_POST['passwordsubmit'])) {
        var_dump($_POST);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $password_hashed = password_hash($password, PASSWORD_BCRYPT);
        if($_POST['type'] == 'student') {
            $table = "student";
            $column = "oib";
            $data = mysqli_real_escape_string($conn, $_POST['identification']);
        } else if($_POST['type'] == 'company') {
            $table = "company";
            $column = "id";
            $data = "'".mysqli_real_escape_string($conn, $_POST['identification'])."'";
        } else {
            $table = "admin";
            $column = "id";
            $data = "'".mysqli_real_escape_string($conn, $_POST['identification'])."'";
        }

        $sql = "UPDATE ".$table." SET password = '".$password_hashed."' WHERE ".$column ." = " .$data;
        if(!($conn->query($sql))) {
            header("Location: ../reset_password.php?error=sql");
            exit();
        } else {
            $email_text = "Hello ".$_POST['user_name']."! <br> Your password has been reset by an administrator. Your new password is: <br> <h2>".$password."</h2><br> You can change your password once you log in to your account. <br> -Internship Platform";
            $email_text = wordwrap($email_text, 70);
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: Internship@Platform.com" . "\r\n";
            if(mail($_POST['email'],"Internship platform - Password change", $email_text, $headers)) {
                header("Location: ../user_list.php?password=reset");
                exit();
            } else {
                header("Location: ../user_list.php?mail=error");
                exit();
            }
            
        }


    } else {
        $sql_admin = "SELECT * FROM admin";
        $result = $conn->query($sql_admin);
        $administrators = $result->fetch_all(MYSQLI_ASSOC);

        $sql_student = "SELECT * FROM student";
        $result = $conn->query($sql_student);
        $students = $result->fetch_all(MYSQLI_ASSOC);

        $sql_company = "SELECT * FROM company";
        $result = $conn->query($sql_company);
        $companies = $result->fetch_all(MYSQLI_ASSOC);
    }