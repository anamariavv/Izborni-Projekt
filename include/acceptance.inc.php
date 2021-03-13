<?php
    session_start();
    require_once "database_connect.inc.php";
    $message = "success";

    if(isset($_POST['cancel'])) {
        $student_oib = $_SESSION['oib'];
        $internship_id = $_POST['cancel'][0]['internship'];
        $explanation = $_POST['cancel'][0]['explanation'];

        $sql = "SELECT student.firstname, student.lastname, company.name, company.id FROM 
        student inner join application ON (application.student_oib = student.oib) INNER JOIN 
        company ON (application.company_id = company.id) WHERE student.oib = ? AND internship_id = ? ";

        if(!($stmt = $conn->prepare($sql))) {
            $message = "sql_error";
        }
    
        if(!($stmt->bind_param("is", $student_oib, $internship_id))) {
            $message = "sql_error";
        }
    
        if(!($stmt->execute())) {
            $message = "sql_error";
        } 
        $result = $stmt->get_result();
        $result_array = $result->fetch_all(MYSQLI_ASSOC);

        $notification_text = "The student ".$result_array[0]['firstname']." ".$result_array[0]['lastname']." has cancelled their application for the internship " . $internship_id . ". Cancellation reason: " . $explanation;


        $sql = "INSERT INTO notification(notif_text, company_id) VALUES (?,?)";

        if(!($stmt = $conn->prepare($sql))) {
            $message = "sql_error";
        }
    
        if(!($stmt->bind_param("ss", $notification_text, $result_array[0]['id']))) {
            $message = "sql_error";
        }
    
        if(!($stmt->execute())) {
            $message = "sql_error";
        } 


        $sql = "DELETE FROM application WHERE student_oib = ? AND internship_id = ?";

        if(!($stmt = $conn->prepare($sql))) {
            $message = "sql_error";
        }
    
        if(!($stmt->bind_param("is", $student_oib, $internship_id))) {
            $message = "sql_error";
        }
    
        if(!($stmt->execute())) {
            $message = "sql_error";
        } 

    } else if(isset($_POST['reject'])) {
        $student_oib = $_POST['reject'][0]['oib'];
        $internship_id = $_POST['reject'][0]['internship'];
        $reason = mysqli_real_escape_string($conn, $_POST['reject'][0]['reason']);
        $notification_text = "You have been rejected for the internship " . $internship_id . ". Rejection reason: " . $reason;
        
        $sql = "INSERT INTO notification(notif_text, student_oib) VALUES (?,?)";

        if(!($stmt = $conn->prepare($sql))) {
            $message = "sql_error";
        }
    
        if(!($stmt->bind_param("si", $notification_text, $student_oib))) {
            $message = "sql_error";
        }
    
        if(!($stmt->execute())) {
            $message = "sql_error";
        } 

        $sql = "DELETE FROM application WHERE student_oib = ? AND internship_id = ?";

        if(!($stmt = $conn->prepare($sql))) {
            $message = "sql_error";
        }
    
        if(!($stmt->bind_param("is", $student_oib, $internship_id))) {
            $message = "sql_error";
        }
    
        if(!($stmt->execute())) {
            $message = "sql_error";
        } 
    }else if(isset($_POST['accept'])) {
        $student_oib = $_POST['accept'][0]['oib'];
        $internship_id = $_POST['accept'][0]['internship'];
        $notification_text = "Congratulations! You have been accepted for the internship " . $internship_id;
        $acceptance = "accepted";

        $sql = "INSERT INTO notification(notif_text, student_oib) VALUES (?,?)";

        if(!($stmt = $conn->prepare($sql))) {
            $message = "sql_error";
        }
    
        if(!($stmt->bind_param("si", $notification_text, $student_oib))) {
            $message = "sql_error";
        }
    
        if(!($stmt->execute())) {
            $message = "sql_error";
        } 

        $sql = "UPDATE application SET acceptance = ? WHERE student_oib = ? AND internship_id = ?";

        if(!($stmt = $conn->prepare($sql))) {
            $message = "sql_error";
        }
    
        if(!($stmt->bind_param("sis", $acceptance, $student_oib, $internship_id))) {
            $message = "sql_error";
        }
    
        if(!($stmt->execute())) {
            $message = "sql_error";
        } 
    }

    echo json_encode($message);