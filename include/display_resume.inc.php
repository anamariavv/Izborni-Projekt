<?php

    require_once "include/database_connect.inc.php";
    //this isn't final query-> it needs to get the whole resume data
    $sql = 'SELECT * FROM resume INNER JOIN student ON (student.oib = resume.id) WHERE id = "' . $_SESSION['oib'] . '"';
  
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
