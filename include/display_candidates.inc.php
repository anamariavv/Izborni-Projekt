<?php
    session_start();
    require_once "database_connect.inc.php";
    
    $sql = "SELECT student.oib, student.firstname, student.lastname FROM student INNER JOIN application
        ON (student.oib = application.student_oib) WHERE application.internship_id = ?";

    if(!($stmt = $conn->prepare($sql))) {
        $message = mysqli_error($conn);
    }

    if(!($stmt->bind_param("s", $_POST['id']))) {
        $message = mysqli_error($conn);
    }

    if(!($stmt->execute())) {
        $message = mysqli_error($conn);
    } else {
        $result = $stmt->get_result();
        $result_array = $result->fetch_all(MYSQLI_ASSOC);
        $message = $result_array;      
    }
    
    echo json_encode($message);
   