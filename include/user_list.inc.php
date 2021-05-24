<?php

    require_once "database_connect.inc.php";
    //For sending a custom message to one user
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
    
    } else if(isset($_POST['submitpush'])) { //For sending push notifications
        $type = mysqli_real_escape_string($conn, $_POST['usertype']);
        $message = mysqli_real_escape_string($conn, $_POST['pushtext']);
        $result;

        //depending on which user type, define column, indentifier and bind string to be used in query,
        //get all users of that type
        if($type == 'Student') {
            $column = 'student_oib';
            $sql = "SELECT oib FROM student";
            $result = $conn->query($sql);
            $param_string = "si";
            $id = 'oib';
        } else if($type == 'Company') {
            $column = 'company_id';
            $sql = "SELECT id FROM company";
            $result = $conn->query($sql);
            $param_string = "ss";
            $id = 'id';
        } else {
            $column = 'admin_id';
            $sql = "SELECT id FROM admin";
            $result = $conn->query($sql);
            $param_string = "ss";
            $id = 'id';
        }

        //for each user of that type, insert notification
        $result_array = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($result_array as $identification) {

            $sql = "INSERT INTO notification(notif_text, ".$column.") VALUES (?, ?)";

            if(!($stmt = $conn->prepare($sql))) {
                header("Location: ../user_list.php?error=sql");
                exit();
            }
            if(!($stmt->bind_param($param_string, $message, $identification[$id]))) {
                header("Location: ../user_list.php?error=sql");
                exit();
            }
            if(!($stmt->execute())) {
                header("Location: ../user_list.php?error=sql");
                exit();
            }
        }
        header("Location: ../user_list.php?push=sent");

    } else { //default - display all users
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