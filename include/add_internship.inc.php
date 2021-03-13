<?php
    session_start();
    
    require_once "database_connect.inc.php";
    $message = "Success";

    //get data
    $id = mysqli_real_escape_string($conn, json_decode($_REQUEST["id"]));
    $position = mysqli_real_escape_string($conn, json_decode($_REQUEST["position"]));
    $description = mysqli_real_escape_string($conn, json_decode($_REQUEST["desc"]));
    $city = mysqli_real_escape_string($conn, json_decode($_REQUEST["city"]));
    $requirements = mysqli_real_escape_string($conn, json_decode($_REQUEST["requirements"]));
    $salary = mysqli_real_escape_string($conn, json_decode($_REQUEST["salary"]));
    $deadline = json_decode($_REQUEST["deadline"]);
    $status = 'open';
    //insert into database
    $sql = "INSERT INTO internship(id,position,description,city,requirements,status,salary,deadline,company_id) VALUES (?,?,?,?,?,?,?,?,?)";

    if(!($stmt = $conn->prepare($sql))) {
        $message = $stmt->error;
    }

    if(!($stmt->bind_param("ssssssiss", $id, $position, $description, $city, $requirements, $status, $salary, $deadline, $_SESSION['id']))) {
        $message = $stmt->error;
    }

    if(!($stmt->execute())) {
        $message = $stmt->error;
        
    }

    echo json_encode($message);
   