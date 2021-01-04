<?php
    session_start();
    require_once "database_connect.inc.php";

    $type = $_SESSION['user_level'];
    echo json_encode($type);
?>