<?php
    include_once "include/display_resume.inc.php";

    echo '<h1 id="h1_title">'.$row['title'].'</h1>
        <div id="title"></div>
        <div id="edit_title_button">';
        if($_SESSION["user_level"] == "student") {
            echo "<button type='button' id='edit_title'>Edit</button>";
        }
    echo '</div>';

    echo '<h2 id="h2_name">'.$row['firstname'].' '.$row['lastname'].'</h2>';
    echo '<h2>Introduction</h2>
        <div id="intro">'.$row['description'].'</div>
        <div id="edit_intro_button">';
        if($_SESSION['user_level'] == "student") {
            echo "<button type='button' id='edit_intro'>Edit</button>";
        }
    echo '</div>';
    echo '<h2>Contact</h2>
        <div id="contact">
        <p>Email:'.$row['email'].'</p>
        <p>Phone:'.$row['phone_number'].'</p>
        </div>';
?>

<h2>Skills</h2>
    <div id="skills"></div>
    <div id="edit_skills_button">
        <?php
            if($_SESSION['user_level'] == "student") {
                echo "<button type='button' id='edit_skills'>Edit</button>";
            }
        ?>
    </div>

<h2>Languages</h2>
    <div id="languages"></div>
    <div id="edit_languages_button">
        <?php
            if($_SESSION['user_level'] == "student") {
                echo "<button type='button' id='edit_languages'>Edit</button>";
            }
        ?>
    </div>

<?php
    if($_SESSION['user_level'] == "student") {
        echo "<script src='js/manage_resume.js'></script>";
    }
?>