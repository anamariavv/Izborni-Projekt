<?php
    session_start();
    require_once "database_connect.inc.php";

    $message = "success";

    if(isset($_POST['title'])) {
        //alter resume title
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $id = $_SESSION['oib'];

        $sql = 'UPDATE resume SET title = "'.$title.'"  WHERE id = "'.$id.'"';
        $conn->query($sql);
    }

    if(isset($_POST['intro'])) {
        $intro = mysqli_real_escape_string($conn, $_POST['intro']);
        $id = $_SESSION['oib'];

        $sql = 'UPDATE resume SET description = "'.$intro.'"  WHERE id = "'.$id.'"';
        $conn->query($sql);
    }

    if(isset($_POST['education'])) {
        //loop through array->for each row, turn it into sql and update in database


        foreach($_POST['education'] as $row) {
            $start_year = mysqli_real_escape_string($conn, $row['start_year']);
            $end_year = mysqli_real_escape_string($conn, $row['end_year']);
            $title = mysqli_real_escape_string($conn, $row['title']);
            $country = mysqli_real_escape_string($conn, $row['country']);
            $city = mysqli_real_escape_string($conn, $row['city']);
            $old_title = mysqli_real_escape_string($conn, $row['old_title']);

            $sql = 'UPDATE education SET start_year = ?, end_year = ?, title = ?, country = ?, city = ? WHERE resume_id = ? AND title = ?';
            
            if(!($stmt = $conn->prepare($sql))) {
                $message = "SQL error";
            }
            if(!($stmt->bind_param("iisssis", $start_year, $end_year, $title, $country, $city, $_SESSION['oib'], $old_title))) {
                $message = "SQL error";
            }
            if(!($stmt->execute())) {
                $message = "SQL error";
            }
        } 
    }
    echo json_encode($message);

  
