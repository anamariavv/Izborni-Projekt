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
    </head>
<body>

<?php
    include_once "include/display_resume.inc.php";

    echo '<div id="cv_wrapper" class="cv_wrapper">';
    echo '<div id="sidebar" class="sidebar">';
    echo '<img src='.$row['picture'].' width="200" height="200"></img>';
    echo '<div id="contact" class="contact" >';
    echo  $row['firstname'].' '.$row['lastname'];
    echo '<p>Email: '.$row['email'].'</p>
        <p>Phone: '.$row['phone_number'].'</p>
        </div></div>';

    echo '<div id="cv_content" class="cv_content">';
    echo '<h1 id="h1_title" class="h1">'.$row['title'].'</h1>
        <div id="title" class="title">';
        if($_SESSION["user_level"] == "student") {
            echo "<button type='button' id='edit_title' class='edit_button'>Edit</button>";
        }
        echo'</div>';
    echo '<h2>Introduction</h2>
        <div id="intro" class="intro"><p>'.$row['description'].'</p>';
        if($_SESSION['user_level'] == "student") {
            echo "<button type='button' id='edit_intro' class='edit_button'>Edit</button>";
        }
    echo '</div>';
    echo  '<h2>Education</h2>
        <div id="education" class="education">
        <table id="education_table" class="cv_table">';
    echo '<thead><tr><th>Start year</th><th>End year</th><th>Title</th><th>Country</th><th>City</th></tr></thead><tbody id="education_body">';
        $count = 0;
        foreach ($array_education as $row_education) {
            echo '<tr><td hidden id="education_id'.$count.'">'.$row_education['id'].'</td><td id="education_start_year'.$count.'">'.$row_education['start_year'].'</td><td id="education_end_year'.$count.'">'.$row_education['end_year'].'</td><td id="education_title'.$count.'">'.$row_education['title'].'</td><td id="education_country'.$count.'">'.$row_education['country'].'</td><td id="education_city'.$count.'">'.$row_education['city'].'</td></tr>';
            $count += 1;
        }
    echo '</tbody></table>';
        if(!empty($array_education)){ 
            if($_SESSION['user_level'] == "student") {
                echo "<button type='button' id='edit_education' class='edit_button'>Edit</button>";
            }   
        }
        if($_SESSION['user_level'] == "student") {
            echo "<button type='button' id='add_education' class='edit_button'>Add</button>";
        }
    echo '</div>';

    echo '<h2>Work Experience</h2>
        <div id="work_experience" class="work_experience">
        <table id="work_table" width="35%" class="cv_table">';
        $count = 1;
        foreach($array_work as $row_work) {
            echo '<tr><th hidden id="work_id'.$count.'">'.$row_work['id'].'</th><th id="work_start_month'.$count.'">'.$row_work['start_month'].'</th><th id="work_start_year'.$count.'">'.$row_work['start_year'].'</th><th id="work_end_month'.$count.'">'.$row_work['end_month'].'</th><th id="work_end_year'.$count.'">'.$row_work['end_year'].'</th><th id="work_title'.$count.'">'.$row_work['title'].'</th><th id="work_city'.$count.'">'.$row_work['city'].'</th><th id="work_country'.$count.'">'.$row_work['country'].'</th></tr>';
            echo '<tr><td colspan="7" id="work_description'.$count.'">'.$row_work['description'].'</td></tr>';
            $count += 1;
        }
    echo '</table>';
        if(!empty($array_work)) {
            if($_SESSION['user_level'] == "student") {
                echo "<button type='button' id='edit_work_experience' class='edit_button'>Edit</button>";
            }
        }
        if($_SESSION['user_level'] == "student") {
            echo "<button type='button' id='add_work' class='edit_button'>Add</button>";
        }
    echo '</div>';

    echo '<h2>Skills</h2>
        <div id="skills" class="skills">
        <table id="skill_table" class="cv_table">';
    echo '<thead><tr><th>Skill</th><th>Level</th></tr></thead><tbody id="skill_body">';
        $count = 0;
        foreach($array_skill as $row_skill) {
            echo '<tr><td hidden id="skill_id'.$count.'">'.$row_skill['id'].'</td><td id="skill_name'.$count.'">'.$row_skill['name'].'</td><td id="skill_level'.$count.'">'.$row_skill['level'].'</td></tr>';
            $count += 1;
        }
    echo '</tbody></table>';
        if(!empty($array_skill)) {
            if($_SESSION['user_level'] == "student") {
                echo "<button type='button' id='edit_skills' class='edit_button'>Edit</button>";
            }
        }  
        if($_SESSION['user_level'] == "student") {
            echo "<button type='button' id='add_skill' class='edit_button'>Add</button>";
        }
    echo '</div>';
    
    echo '<h2>Languages</h2>
        <div id="languages" class="languages">
        <table id="language_table" class="cv_table">';
    echo '<thead><tr><th>Language</th><th>Level</th></tr></thead><tbody id="language_body">';
        $count = 0;
        foreach($array_language as $row_language) {
            echo '<tr><td hidden id="language_id'.$count.'">'.$row_language['id'].'</td><td id="language_name'.$count.'">'.$row_language['name'].'</td><td id="language_level'.$count.'">'.$row_language['level'].'</td></tr>';
            $count += 1;
        }        
    echo '</tbody></table>';
        if(!empty($array_language)) {
            if($_SESSION['user_level'] == "student") {
                echo "<button type='button' id='edit_languages' class='edit_button'>Edit</button>";
            }

        }
        if($_SESSION['user_level'] == "student") {
            echo "<button type='button' id='add_language' class='edit_button'>Add</button>";
        }
    echo '</div>';

    echo '<h2>Keywords</h2>
        <div id="keywords" class="keywords">        
        <table id="keyword_table" class="cv_table">';
    echo '<thead><tr><th>Category</th><th>Keyword</th></tr></thead><tbody id="keyword_body">';
        $count = 0;
        foreach($array_keyword as $row_keyword) {
            echo '<tr><td hidden id="keyword_id'.$count.'">'.$row_keyword['id'].'</td><td id="keyword_category'.$count.'">'.$row_keyword['category'].'</td><td id="keyword_word'.$count.'">'.$row_keyword['word'].'</td><td><button name="delete_keyword" id="'.$row_keyword['id'].'">Delete</button></td></tr>';
            $count += 1;
        }
    echo '</tbody></table>';
        if($_SESSION['user_level'] == "student") {
            echo "<button type='button' id='add_keyword' class='edit_button'>Add</button>";
        }
    echo '</div>';
    echo '</div>';

?>

<?php
    if($_SESSION['user_level'] == "student") {
        echo "<script src='js/manage_resume.js'></script>";
    }
?>


        <div class="footer">Riteh 2020.</div>
    </body>
</html>