<?php

    require_once "database_connect.inc.php";

    $message = "success";
    if(isset($_POST['approve'])) {
        
        $sql = "SELECT student_oib, company.name FROM review INNER JOIN company ON (review.company_id = company.id) WHERE review.id = " .$_POST['approve'];
        $result = $conn->query($sql);
        $student = $result->fetch_all(MYSQLI_ASSOC);

        $notification_text = "Your comment for the forum ".$student[0]['name']." has been approved";
        $sql = "UPDATE review SET status = 'approved' WHERE id = " .$_POST['approve'];
        if(!$conn->query($sql)) {
            $message = "SQL error";
            
        } else {
            $sql = 'INSERT INTO notification(notif_text, student_oib) VALUES ("'.$notification_text.'", '.$student[0]['student_oib'] . ')';
            if(!$conn->query($sql)) {
                $message = "SQL error";
            }
        }

        echo json_encode($message);

    } else if(isset($_POST['reject'])) {
        $sql = "SELECT student_oib, company.name FROM review INNER JOIN company ON (review.company_id = company.id) WHERE review.id = " .$_POST['reject'];
        $result = $conn->query($sql);
        $student = $result->fetch_all(MYSQLI_ASSOC);

        $notification_text = "Your comment for the forum ".$student[0]['name']." has been rejected due to inappropriate behaviour";
        $sql = "UPDATE review SET status = 'rejected' WHERE id = " .$_POST['reject'];
        if(!$conn->query($sql)) {
            $message = "SQL error";
            
        } else {
            $sql = 'INSERT INTO notification(notif_text, student_oib) VALUES ("'.$notification_text.'", '.$student[0]['student_oib'] . ')';
            if(!$conn->query($sql)) {
                $message = "SQL error";
            }
        }

        echo json_encode($message);


    } else {
        $sql = "SELECT review.id, review.created, review.status, review.text, company.name, student.oib, student.firstname, student.lastname
        FROM `review` INNER JOIN company ON (company.id = review.company_id)
        INNER JOIN student ON (student.oib = review.student_oib) ORDER BY review.status";
        $result = $conn->query($sql);
        $comments = $result->fetch_all(MYSQLI_ASSOC);
    }