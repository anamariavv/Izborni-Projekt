<?php
    session_start();
?>

<!DOCTYPE html>
    <head>
        <title>Internship Platform</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <script src="js/jquery-3.5.1.min.js"></script>
        <script src="js/jquery.validate.js"></script>
        <ul>
            <?php
                if(isset($_SESSION["status"])) {
                    echo '<a href="include/logout.inc.php?logout=true">Log out</a>';
                    echo '<a href="index.php">Home</a>';
                } else {
                    echo '<a href="login.php">Log in</a>'; 
                    echo '<a href="signup.php">Register as student</a>'; 
                    echo '<a href="signup_company.php">Register as company</a>';
                    echo '<a href="index.php">Home</a>';
                }
            ?>
        </ul> 
    </head>
<body>