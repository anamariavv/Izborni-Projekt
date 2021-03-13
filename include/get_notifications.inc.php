<?php

    session_start();
    require_once "database_connect.inc.php";
    $message = "success";

    if(isset($_POST['data'])) {
        $data = $_POST['data'][0]['identification'];

        if($_POST['data'][0]['type'] == 'student') {
            $column = "student_oib";
        } else {
            $column = "company_id";
            $data = "'".$_POST['data'][0]['identification']."'";
        }

        $sql = "SELECT * FROM notification WHERE ".$column." = ".$data . " ORDER BY id DESC";

        if(!($result = $conn->query($sql))) {
            $message = "SQL error";
        }

        $result_array = $result->fetch_all(MYSQLI_ASSOC);
        $message = $result_array;
        echo json_encode($message);
       
        foreach($result_array as $row) {
            $sql = "UPDATE notification SET status = 'read' WHERE id = " . $row['id'];

            if(!($result = $conn->query($sql))) {
                echo "SQL error";
            }            
        }
    }
    

    