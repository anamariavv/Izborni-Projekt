<?php

    require_once "database_connect.inc.php";
    
    $sql_admin = "SELECT * FROM admin";
    $result = $conn->query($sql_admin);
    $administrators = $result->fetch_all(MYSQLI_ASSOC);

    $sql_student = "SELECT * FROM student";
    $result = $conn->query($sql_student);
    $students = $result->fetch_all(MYSQLI_ASSOC);

    $sql_company = "SELECT * FROM company";
    $result = $conn->query($sql_company);
    $companies = $result->fetch_all(MYSQLI_ASSOC);