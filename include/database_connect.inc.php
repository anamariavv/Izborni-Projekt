<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "database"; 
    $port = 3308; //adjust this based your amp->default is usually 3306

    $conn = mysqli_connect($servername, $username, $password, $database, $port);

    if(!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

  
