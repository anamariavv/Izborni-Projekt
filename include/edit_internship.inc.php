<?php
    session_start();
    require_once "database_connect.inc.php";

   

    //get data into variables
    $old_id = mysqli_real_escape_string($conn, json_decode($_REQUEST['old_id']));
    $id = mysqli_real_escape_string($conn, json_decode($_REQUEST['id']));
    $position = mysqli_real_escape_string($conn, json_decode($_REQUEST['position']));
    $city = mysqli_real_escape_string($conn, json_decode($_REQUEST['city']));
    $description = mysqli_real_escape_string($conn, json_decode($_REQUEST['desc']));
    $requirements = mysqli_real_escape_string($conn, json_decode($_REQUEST['req']));
    $salary = mysqli_real_escape_string($conn, json_decode($_REQUEST['salary']));
    $deadline = json_decode($_REQUEST['deadline']);
    $message = $old_id.$id.$position.$city.$description.$requirements.$salary.$deadline;
    //update data in database
    $sql = "UPDATE internship SET id = ?, position = ?, description = ?, city = ?, requirements = ?, salary = ?, deadline = ? WHERE id = ? AND company_id = ?";

    if(!($stmt = $conn->prepare($sql))) {
        $message = $old_id.$id.$position.$city.$description.$requirements.$salary.$deadline;
    }
    if(!($stmt->bind_param("sssssisss", $id, $position, $description, $city, $requirements, $salary, $deadline, $old_id, $_SESSION['id']))) {
        $message = $old_id.$id.$position.$city.$description.$requirements.$salary.$deadline;
    }
    if(!($stmt->execute())) {
        $message = $old_id.$id.$position.$city.$description.$requirements.$salary.$deadline;
    }

    echo json_encode($message);