<?php
    session_start();
    require_once "database_connect.inc.php"; 
    $message = "success";

    if(isset($_POST['close'])) {
        $internship_id = $_POST['close'][0]['internship'];
        $notification_text = "The internship " . $internship_id . " has been closed.";
        $status = 'closed';

        if(!$_POST["close"][0]["status"]) {
            foreach($_POST['close'] as $row) {
                $current_oib = $row['oib'];
                
                $sql = "INSERT INTO notification(notif_text, student_oib) VALUES (?,?)";
    
                if(!($stmt = $conn->prepare($sql))) {
                    $message = "sql_error";
                }
            
                if(!($stmt->bind_param("si", $notification_text, $current_oib))) {
                    $message = "sql_error";
                }
            
                if(!($stmt->execute())) {
                    $message = "sql_error";
                } 
    
                $sql = "DELETE FROM application WHERE student_oib = ? AND internship_id = ?";
    
                if(!($stmt = $conn->prepare($sql))) {
                    $message = "sql_error";
                }
            
                if(!($stmt->bind_param("is", $current_oib, $internship_id))) {
                    $message = "sql_error";
                }
            
                if(!($stmt->execute())) {
                    $message = "sql_error";
                } 
            }
        }
       
        $sql = "UPDATE internship SET status = ? WHERE id = ?";
            
        if(!($stmt = $conn->prepare($sql))) {
            $message = "sql_error";
        }
    
        if(!($stmt->bind_param("ss", $status, $internship_id))) {
            $message = "sql_error";
        }
    
        if(!($stmt->execute())) {
            $message = "sql_error";
        } 

    } else if(isset($_POST['delete'])) {
        $internship_id = $_POST['delete'][0]['internship'];
        $notification_text = "The internship " . $internship_id . " has been cancelled";
    
        if(!$_POST['delete'][0]["status"]) {
            foreach($_POST['delete'] as $row) {
                $current_oib = $row['oib'];
                
                $sql = "INSERT INTO notification(notif_text, student_oib) VALUES (?,?)";
    
                if(!($stmt = $conn->prepare($sql))) {
                    $message = "sql_error";
                }
            
                if(!($stmt->bind_param("si", $notification_text, $current_oib))) {
                    $message = "sql_error";
                }
            
                if(!($stmt->execute())) {
                    $message = "sql_error";
                } 
    
                $sql = "DELETE FROM application WHERE student_oib = ? AND internship_id = ?";
    
                if(!($stmt = $conn->prepare($sql))) {
                    $message = "sql_error";
                }
            
                if(!($stmt->bind_param("is", $current_oib, $internship_id))) {
                    $message = "sql_error";
                }
            
                if(!($stmt->execute())) {
                    $message = "sql_error";
                } 
            }
        }       

        $sql = "DELETE FROM internship WHERE id = ?";
            
        if(!($stmt = $conn->prepare($sql))) {
            $message = "sql_error";
        }
    
        if(!($stmt->bind_param("s", $internship_id))) {
            $message = "sql_error";
        }
    
        if(!($stmt->execute())) {
            $message = "sql_error";
        } 

    } else {
        //get data into variables
        $old_id = mysqli_real_escape_string($conn, $_POST['old_id']);
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $position = mysqli_real_escape_string($conn, $_POST['position']);
        $city = mysqli_real_escape_string($conn, $_POST['city']);
        $description = mysqli_real_escape_string($conn, $_POST['desc']);
        $requirements = mysqli_real_escape_string($conn, $_POST['req']);
        $salary = mysqli_real_escape_string($conn, $_POST['salary']);
        $deadline = mysqli_real_escape_string($conn, $_POST['deadline']);
    
        //update data in database
        $sql = "UPDATE internship SET id = ?, position = ?, description = ?, city = ?, requirements = ?, salary = ?, deadline = ? WHERE id = ? AND company_id = ?";

        if(!($stmt = $conn->prepare($sql))) {
            $message = "error_1";
        }
        if(!($stmt->bind_param("sssssisss", $id, $position, $description, $city, $requirements, $salary, $deadline, $old_id, $_SESSION['id']))) {
            $message = "error_2";
        }
        if(!($stmt->execute())) {
            $message = "error_3";
        }
    }
    
    echo json_encode($message);