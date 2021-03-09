<?php
    if($_SESSION) {
        require_once "database_connect.inc.php";

        $sql = "SELECT internship.id, internship.created, internship.position, internship.description, 
        internship.city, internship.requirements, internship.salary, internship.deadline, company.name, 
        company.id AS c_id FROM internship INNER JOIN company ON (internship.company_id = company.id)
        WHERE internship.status = 'open' ORDER BY internship.id";


        if(!($result = $conn->query($sql))) {
            header("Location: ../index.php?error=sql");
            exit();
        }
        $result_array = $result->fetch_all(MYSQLI_ASSOC);

        if($_SESSION['user_level'] == 'student') {
            $sql_applied = "SELECT internship.id, student_oib, company.name, internship.position, internship.city, internship.deadline FROM internship INNER JOIN application ON (internship.id = application.internship_id) INNER JOIN company ON (application.company_id = company.id) WHERE application.student_oib = " . $_SESSION['oib'];
            if(!($result_applied = $conn->query($sql_applied))) {
                header("Location: ../index.php?error=sql");
                exit();
            }
            $applied_array = $result_applied->fetch_all(MYSQLI_ASSOC);
        }
    }
    



    