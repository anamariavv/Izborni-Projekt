<?php
    require_once "database_connect.inc.php";
 
    if($_SESSION["user_level"] == "student") {
       $table = "student";
       $column = "oib";
       $data = $_SESSION[$column];
    } else if($_SESSION["user_level"] == "company"){
        $table = "company";
        $column = "id";
        $data = " '$_SESSION[$column]' ";
    } else {
        $table = "admin";
        $column = "id";
        $data = " '$_SESSION[$column]' ";
    }

    $sql = "SELECT * FROM " . $table . " WHERE " . $column . " = " . $data;
    if(!$result = ($conn->query($sql))) {
        header("Location: index.php?error=sql");
        exit();
    }

    $row = $result->fetch_assoc();  
    