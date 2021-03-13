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
                    echo '<a href="profile.php">My profile</a>';
                    if($_SESSION["user_level"] == "student") {
                        echo '<a href="include/generate_resume.inc.php">My CV</a>';
                    }
                    if($_SESSION["user_level"] == "company") {
                        echo '<a href="internships.php">Internships Overview</a>';
                    }
                    $notif_id_data;
                    if($_SESSION['user_level'] == 'student') {
                        $notif_id_data = $_SESSION['oib'];
                        $notif_id_type = $_SESSION['user_level'];
                    } else {
                        $notif_id_data = $_SESSION['id'];
                        $notif_id_type = $_SESSION['user_level'];
                    }
                    echo "<input id='notif_id' type='hidden' value='".$notif_id_data."'></hidden>";
                    echo "<input id='notif_id_type' type='hidden' value='".$notif_id_type."'></hidden>";
                    echo '<script src="js/notifications.js"></script>';
                    echo '<button type=notifications name="notifications" id="notifications">Notifications</button>';
                    echo '<div id="notification_div"></div>';
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