<?php
    require_once "database_connect.inc.php";
    //for the forum page - check if a student has rated that company or not
        if($_SESSION['user_level'] == 'student') {
            $student = $_SESSION['oib'];

            $sql = "SELECT * FROM rating WHERE student_oib = ? AND company_id = ?";

            if(!($stmt = $conn->prepare($sql))) {
                header("Location: ../forum?error=".$conn->error);
            }
            if(!($stmt->bind_param("is", $student, $company))) {
                header("Location: ../forum?error=".$conn->error);
            }
            if(!($stmt->execute())) {
                header("Location: ../forum?error=".$conn->error);
            }

            $rated = 0;
            $result = $stmt->get_result();

            //if the result set is empty, student hasn't rated it
            if(mysqli_num_rows($result) == 0) {
                $rated = 0;
            } else { 
                //student has rated the company
                $rated = 1;
            }
       }
       

        //get average grade for company
        $company = $_GET['company'];       

        $sql = 'SELECT ROUND(AVG(grade), 2) as average FROM rating WHERE company_id = "'.$company.'"';
        
        $result = $conn->query($sql);
        $average_rating = $result->fetch_all(MYSQLI_ASSOC);
         
       //get number of students that have rated that company
        $sql = 'SELECT COUNT(*) as rating_count FROM rating WHERE company_id = "'.$company.'"';
        
        $result = $conn->query($sql);
        $rating_count = $result->fetch_all(MYSQLI_ASSOC);