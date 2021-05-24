<?php

    //get a list of all companies for the company forums page

    require "database_connect.inc.php";

    $sql = "SELECT * FROM company";

    $result = $conn->query($sql);
    $result_array = $result->fetch_all(MYSQLI_ASSOC);

   