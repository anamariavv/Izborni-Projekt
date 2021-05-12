<?php

    session_start();
    require_once "database_connect.inc.php";
    $message = "success";

    if(isset($_POST['data'])) {
        $data = $_POST['data'][0]['identification'];

        if($_POST['data'][0]['type'] == 'student') {
            $column = "student_oib";
        } else if($_POST['data'][0]['type'] == 'company') {
            $column = "company_id";
            $data = "'".$_POST['data'][0]['identification']."'";
        } else {
            $column = "admin_id";
            $data = "'".$_POST['data'][0]['identification']."'";
        }

        $sql = "SELECT * FROM notification WHERE ".$column." = ".$data . " ORDER BY id DESC";

        if(!($result = $conn->query($sql))) {
            $message = "SQL error";
        }

        $result_array = $result->fetch_all(MYSQLI_ASSOC);
        $message = $result_array;
      
    } else if(isset($_POST['read'])) {

        $sql = "UPDATE notification SET status = 'read' WHERE id = ".$_POST['read'];

        if(!($result = $conn->query($sql))) {
            $message =  $conn->error;
        }  
        $message = $sql;          
    }
 
    echo json_encode($message);

    