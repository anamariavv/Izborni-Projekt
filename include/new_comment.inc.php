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

    $sql = "SELECT id FROM admin";
    $result = $conn->query($sql);
    $admins = $result->fetch_all(MYSQLI_ASSOC);
    var_dump($admins);
    foreach($admins as $admin) {
        $sql = 'INSERT INTO notification(notif_text, admin_id) VALUES
         ("Dear administrator, a new comment has been made on the '.$company_name.' forum. Please review it.", "'.$admin['id'].'")'; 
        $conn->query($sql);
    }
    header("Location: ../forum.php?company=".$company."&name=".$company_name);
    exit();