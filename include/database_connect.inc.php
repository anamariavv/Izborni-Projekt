<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "database";
    $port = 3308; //adjust this based your amp->default is usually 3306

    $conn = mysqli_connect($servername, $username, $password, $database, $port);
   
    if (!$conn->set_charset("utf8")) {
        printf("Error loading character set utf8: %s\n", $conn->error);
        exit();
    }
    if(!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

  
