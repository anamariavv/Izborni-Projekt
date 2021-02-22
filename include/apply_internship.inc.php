<?php
    session_start();
    require_once "database_connect.inc.php";

    $sql = "INSERT INTO application VALUES (?,?,?)";
    $internship_id =mysqli_real_escape_string($conn, $_GET['id']);
    $company_id = mysqli_real_escape_string($conn, $_GET['company']);
    
    if(!($stmt = $conn->prepare($sql))) {
        header("Location: ..?error=sql1");
        exit();
    }  

    if(!($stmt->bind_param("ssi", $internship_id, $company_id, $_SESSION['oib']))) {
        header("Location: ..?error=sql2");
        exit();
    }

    if(!($stmt->execute())) {
        header("Location: ..?error=".mysqli_error($conn));
        exit();
    }
    
    header("Location: ..?apply=success");
    exit();
