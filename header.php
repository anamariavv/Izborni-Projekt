<?php
    session_start();
?>

<!DOCTYPE html>
    <head>
        <title>Internship Platform</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <script src="js/jquery-3.5.1.min.js"></script>
        <script src="js/jquery.validate.js"></script>
        <link rel="stylesheet" href="css/main.css">
        <ul class="navbar">
            <?php
                if(isset($_SESSION["status"])) {
                    echo '<a href="index.php"><button>Home</button></a>';
                    if($_SESSION["user_level"] == "student") {
                        echo '<a href="include/generate_resume.inc.php"><button>My CV</button></a>';
                    }
                    if($_SESSION["user_level"] == "company") {
                        echo '<a href="internships.php"><button>My Internships</button></a>';
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
                    echo '<a href="company_forums.php"><button>Company forums</button></a>';
                    echo '<script src="js/notifications.js"></script>';
                    echo '<button class="notification_button" type="button" name="notifications" id="notifications">Notifications</button>';
                    echo '<div class="notification_div" id="notification_div"></div>';
                    echo '<a class="log" href="include/logout.inc.php?logout=true"><button>Log out</button></a>';
                    echo '<a class="right" href="profile.php"><button>My profile</button></a>';
                    if($_SESSION["user_level"] == "administrator") {
                        echo '<a href="user_list.php"><button>User list</button></a>
                        <a href="approve_comments.php"><button>Comment approval</button></a>
                        <a href="add_administrator.php"><button>Add administrator</button></a>
                        </div></div>';
                    }
                } else {
                    echo '<a href="index.php"><button>Home</button></a>'; 
                    echo '<a href="signup.php"><button>Register as student</button></a>'; 
                    echo '<a href="signup_company.php"><button>Register as company</button></a>';
                    echo '<a class="log" href="login.php"><button>Log in</button></a>';
                }
            ?>
        </ul> 
        <div class="notification_alert" id="notification_alert">
            <p>You have new notifications! Click to dismiss</p>
        </div>
    </head>
<body>

