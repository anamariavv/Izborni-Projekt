<?php
    require_once "database_connect.inc.php";

    //get list of all applicants for internship

    $sql = "SELECT student.oib, student.firstname, student.lastname, application.acceptance FROM student INNER JOIN application
    ON (student.oib = application.student_oib) WHERE application.internship_id = ?";

    if(!($stmt = $conn->prepare($sql))) {
        header("Location: ../internships.php?error=mysql");
        exit();
    }

    if(!($stmt->bind_param("s", $_GET['id']))) {
        header("Location: ../internships.php?error=mysql");
        exit();
    }

    if(!($stmt->execute())) {
        header("Location: ../internships.php?error=mysql");
        exit();
    } 
    $result = $stmt->get_result();
    $result_array = $result->fetch_all(MYSQLI_ASSOC);
    

    
   
   