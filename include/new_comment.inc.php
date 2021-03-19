<?php
     
    session_start();
    require_once "database_connect.inc.php";

    $comment_text = mysqli_real_escape_string($conn, $_POST['comment_text']);
    $company = mysqli_real_escape_string($conn, $_POST['company']);
    $company_name = mysqli_real_escape_string($conn, $_POST['company_name']);

    $sql = "INSERT INTO review(text, company_id, student_oib) VALUES (?,?,?)";

    if(!($stmt = $conn->prepare($sql))) {
        header("Location: ../forum.php?error=sql&company=".$company."&name=".$company_name);
        exit();
    }
    if(!($stmt->bind_param("ssi", $comment_text, $company, $_SESSION['oib']))) {
        header("Location: ../forum.php?error=sql&company=".$company."&name=".$company_name);
        exit();
    }
    if(!($stmt->execute())) {
        header("Location: ../forum.php?error=sql&company=".$company."&name=".$company_name);
        exit();
    }

    header("Location: ../forum.php?company=".$company."&name=".$company_name);
    exit();