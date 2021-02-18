<?php
    require_once "database_connect.inc.php";

    $sql = "SELECT internship.id, internship.created, internship.position, internship.description, 
    internship.city, internship.requirements, internship.salary, internship.deadline, company.name 
    FROM internship INNER JOIN company ON (internship.company_id = company.id)
    WHERE internship.status = 'open' ORDER BY internship.id";

    if(!($result = $conn->query($sql))) {
        header("Location: ../index.php?error=sql");
        exit();
    }
    
    $result_array = $result->fetch_all(MYSQLI_ASSOC);

    