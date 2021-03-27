<?php

    require_once "database_connect.inc.php";
        
    if(isset($_POST['delete_comment'])) {
        $message = "success";
        $sql = "DELETE FROM review WHERE id = " . $_POST['delete_comment'];
        if(!($conn->query($sql))) {
            $message = "SQL error";
        }
        echo json_encode($message);
    }else if(isset($_POST['edit_comment'])) {
        $message = "success";
        $status = 'pending';
        $comment_text = mysqli_real_escape_string($conn, $_POST['edit_comment'][0]["comment_text"]);
        $comment_id = $_POST['edit_comment'][0]["comment_id"];
        $sql = "UPDATE review SET text = ?, status = ? WHERE id = ?";

        if(!($stmt = $conn->prepare($sql))) {
            $message = "SQL error";
        }
        if(!($stmt->bind_param("ssi", $comment_text, $status, $comment_id))) {
            $message = "SQL error";
        }
        if(!($stmt->execute())) {
            $message = "SQL error";
        }

        echo json_encode($message);
    } else {
        $sql = 'SELECT date_format(review.created, "%H:%i %d.%m.%Y.") as "time", review.id, review.status, review.text, company.name, student.firstname, student.lastname, student.oib, student.picture FROM review INNER JOIN company ON (review.company_id = company.id) INNER JOIN student ON (student.oib = review.student_oib) WHERE company.id = "'.$_GET['company'].'"';
    
        $result = $conn->query($sql);
        $review_array = $result->fetch_all(MYSQLI_ASSOC);
    }