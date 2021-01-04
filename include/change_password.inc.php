<?php
    session_start();
    require_once "database_connect.inc.php";

    $password = mysqli_real_escape_string($conn, $_REQUEST["pass"]);

    if(!empty($data_form)) {
        $ajax_message = "Empty field";
    }

    if($_SESSION["user_level"] == "student") {
        $column = "oib";
        $data = $_SESSION[$column];
    } else {
        $column = "id";
        $data = "'".$_SESSION[$column]."'";
    }

    $password_hashed = password_hash($password, PASSWORD_BCRYPT);
    $sql = "UPDATE " . $_SESSION["user_level"] . " SET " .$_SESSION["user_level"]. ".password = '" .$password_hashed. "' " . "WHERE " . $column . " = " . $data;
    
    if(!($conn->query($sql))) {
        $ajax_message = "sql error";
    } 
    
    if(empty($ajax_message)) {
        $ajax_message = "Change successfull.";
    }
    echo json_encode($ajax_message);
?>
