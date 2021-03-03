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

    if(isset($_POST['skills'])) {

        foreach ($_POST['skills'] as $row) {
           $id = mysqli_real_escape_string($conn, $row['id']);
           $name = mysqli_real_escape_string($conn, $row['name']);
           $level = mysqli_real_escape_string($conn, $row['level']);

           $sql = 'UPDATE skill SET name = ?, level = ? WHERE id = ?';
            
            
            if(!($stmt = $conn->prepare($sql))) {
                $message = "SQL error";
            }
            if(!($stmt->bind_param("sis", $category, $level, $id))) {
                $message = "SQL error";
            }
            if(!($stmt->execute())) {
                $message = "SQL error";
            }

        }
    }

    if(isset($_POST['languages'])) {

        foreach ($_POST['languages'] as $row) {
           $id = mysqli_real_escape_string($conn, $row['id']);
           $name = mysqli_real_escape_string($conn, $row['name']);
           $level = mysqli_real_escape_string($conn, $row['level']);

           $sql = 'UPDATE language SET name = ?, level = ? WHERE id = ?';
            
            
            if(!($stmt = $conn->prepare($sql))) {
                $message = "SQL error";
            }
            if(!($stmt->bind_param("sis", $name, $level, $id))) {
                $message = "SQL error";
            }
            if(!($stmt->execute())) {
                $message = "SQL error";
            }

        }
    }

    if(isset($_POST['keywords'])) {

        foreach ($_POST['keywords'] as $row) {
           $id = mysqli_real_escape_string($conn, $row['id']);
           $category = mysqli_real_escape_string($conn, $row['category']);
           $word = mysqli_real_escape_string($conn, $row['word']);

           $sql = 'UPDATE keyword SET category = ?, word = ? WHERE id = ?';
            
            if(!($stmt = $conn->prepare($sql))) {
                $message = "SQL error";
            }
            if(!($stmt->bind_param("sss", $category, $word, $id))) {
                $message = "SQL error";
            }
            if(!($stmt->execute())) {
                $message = "SQL error";
            }
        }
    }

    if(isset($_POST['work'])) {

        foreach ($_POST['work'] as $row) {
           $id = mysqli_real_escape_string($conn, $row['id']);
           $start_month = mysqli_real_escape_string($conn, $row['start_month']);
           $start_year = mysqli_real_escape_string($conn, $row['start_year']);
           $end_month = mysqli_real_escape_string($conn, $row['end_month']);
           $end_year = mysqli_real_escape_string($conn, $row['end_year']);
           $title = mysqli_real_escape_string($conn, $row['title']);
           $city = mysqli_real_escape_string($conn, $row['city']);
           $country = mysqli_real_escape_string($conn, $row['country']);
           $description = mysqli_real_escape_string($conn, $row['description']);
           

           $sql = 'UPDATE work_experience SET start_month = ?, end_month = ?, start_year = ?, end_year = ?, title = ?, country = ?, city = ?, description = ? WHERE id = ?';
            
            if(!($stmt = $conn->prepare($sql))) {
                $message = "SQL error";
            }
            if(!($stmt->bind_param("iiiissssi", $start_month, $end_month, $start_year, $end_year, $title, $country, $city, $description, $id))) {
                $message = "SQL error";
            }
            if(!($stmt->execute())) {
                $message = "SQL error";
            }
        }
    }
    echo json_encode($message);

  
