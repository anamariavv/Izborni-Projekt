<?php

    session_start();
    require_once "database_connect.inc.php";

    //insert new admin information to table

    $message = "sucess";
  
    $firstname = mysqli_real_escape_string($conn, $_POST['profile_data'][0]['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['profile_data'][0]['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['profile_data'][0]['email']);
    
    $sql = 'UPDATE admin SET firstname = ?, lastname = ?, email = ? WHERE id = ?';
    
    if(!($stmt = $conn->prepare($sql))) {
        $message = "SQL error";
    }
    if(!($stmt->bind_param("ssss", $firstname, $lastname, $email, $_SESSION['id']))) {
        $message = "SQL error";
    }
    if(!($stmt->execute())) {
        $message = "SQL error";
    }

    echo json_encode($message);