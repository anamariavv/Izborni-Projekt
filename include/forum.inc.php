<?php

    require_once "database_connect.inc.php";
        
    if(isset($_POST['delete_comment'])) {
        $message = "success";
        $sql = "DELETE FROM review WHERE id = " . $_POST['delete_comment'];
        if(!($conn->query($sql))) {
            $message = "sql error";
        }
        echo json_encode($message);
    } else {
        $sql = "SELECT date_format(review.created, '%H:%i %d.%m.%y.') as 'time', review.id, review.status, review.text, company.name, student.firstname, student.lastname, student.oib, student.picture FROM review INNER JOIN company ON (review.company_id = company.id) INNER JOIN student ON (student.oib = review.student_oib) WHERE company.id = '".$_GET['company']."' AND status = 'approved'";
    
        $result = $conn->query($sql);
        $review_array = $result->fetch_all(MYSQLI_ASSOC);
    }