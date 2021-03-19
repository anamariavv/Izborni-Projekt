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