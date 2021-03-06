<?php
    session_start();
    require_once "database_connect.inc.php";
    
    //when a user rates a company, update the rating table
    if(isset($_POST['ratingsubmit'])) {

        $student = $_SESSION['oib'];
        $company = $_POST['company_id'];
        $company_name = $_POST['company_name'];
        $grade = $_POST['rating'];

        $sql = "INSERT INTO rating(grade, company_id, student_oib) VALUES (?,?,?)";

        if(!($stmt = $conn->prepare($sql))) {
            header("Location: ../forum?error=".$conn->error);
        }
        if(!($stmt->bind_param("isi", $grade, $company, $student))) {
            header("Location: ../forum?error=".$conn->error);
        }
        if(!($stmt->execute())) {
            header("Location: ../forum?error=".$conn->error);
        }

        //return with the original paramters in GET
        header("Location: ../forum?company=".$company."&name=".$company_name);
    }
    