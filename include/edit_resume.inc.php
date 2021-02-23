<?php
    session_start();
    require_once "database_connect.inc.php";

    $message = "success";

    if(isset($_POST['title'])) {
        //alter resume title
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $id = $_SESSION['oib'];

        $sql = 'UPDATE resume SET title = "'.$title.'"  WHERE id = "'.$id.'"';
        $conn->query($sql);

        echo json_encode($message);
    }