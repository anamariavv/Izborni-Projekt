<?php
    session_start();
    require_once "database_connect.inc.php"; 
    
    $message = "success";
    //get data into variables
    $old_id = mysqli_real_escape_string($conn, $_POST['old_id']);
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $description = mysqli_real_escape_string($conn, $_POST['desc']);
    $requirements = mysqli_real_escape_string($conn, $_POST['req']);
    $salary = mysqli_real_escape_string($conn, $_POST['salary']);
    $deadline = mysqli_real_escape_string($conn, $_POST['deadline']);
   
    //update data in database
    $sql = "UPDATE internship SET id = ?, position = ?, description = ?, city = ?, requirements = ?, salary = ?, deadline = ? WHERE id = ? AND company_id = ?";

    if(!($stmt = $conn->prepare($sql))) {
        $message = "error_1";
    }
    if(!($stmt->bind_param("sssssisss", $id, $position, $description, $city, $requirements, $salary, $deadline, $old_id, $_SESSION['id']))) {
        $message = "error_2";
    }
    if(!($stmt->execute())) {
        $message = "error_3";
    }

    echo json_encode($message);