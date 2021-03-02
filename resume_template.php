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
    echo '<h2>Education</h2>
        <div id="education">
        <table id="education_table">';
        $count = 0;
        foreach ($array_education as $row_education) {
            echo '<tr><td id="education_start_year'.$count.'">'.$row_education['start_year'].'</td><td id="education_end_year'.$count.'">'.$row_education['end_year'].'</td><td id="education_title'.$count.'">'.$row_education['title'].'</td><td id="education_country'.$count.'">'.$row_education['country'].'</td><td id="education_city'.$count.'">'.$row_education['city'].'</td></tr>';
            $count += 1;
        }
    echo '</table></div>
        <div id="edit_education_button">';
        if($_SESSION['user_level'] == "student") {
            echo "<button type='button' id='edit_education'>Edit</button>";
        }
    echo '</div>';

    echo '<h2>Work Experience</h2>
        <div id="work_experience">
        <table id="work_table" width="35%"';
        $count = 0;
        foreach($array_work as $row_work) {
            echo '<tr><td id="work_start_month'.$count.'">'.$row_work['start_month'].'</td><td id="work_start_year'.$count.'">'.$row_work['start_year'].'</td><td id="work_end_month'.$count.'">'.$row_work['end_month'].'</td><td id="work_end_year'.$count.'">'.$row_work['end_year'].'</td><td id="work_title'.$count.'">'.$row_work['title'].'</td><td id="work_city'.$count.'">'.$row_work['city'].'</td><td id="work_country'.$count.'">'.$row_work['country'].'</td></tr>';
            echo '<tr><td colspan="7" id="work_description'.$count.'">'.$row_work['description'].'</td></tr>';
            $count += 1;
        }
    echo '</table></div>
        <div id="edit_work_experience_button">';
        if($_SESSION['user_level'] == "student") {
            echo "<button type='button' id='edit_work_experience'>Edit</button>";
        }
    echo '</div>';

    echo '<h2>Skills</h2>
        <div id="skills">
        <table id="skill_table">';
        $count = 0;
        foreach($array_skill as $row_skill) {
            echo '<tr><td hidden id="skill_id'.$count.'">'.$row_skill['id'].'</td><td id="skill_name'.$count.'">'.$row_skill['name'].'</td><td id="skill_level'.$count.'">'.$row_skill['level'].'</td></tr>';
            $count += 1;
        }
    echo '</table></div>
        <div id="edit_skills_button">';
        if($_SESSION['user_level'] == "student") {
            echo "<button type='button' id='edit_skills'>Edit</button>";
        }
    echo '</div>';
    
    echo '<h2>Languages</h2>
        <div id="languages">
        <table id="language_table">';
        $count = 0;
        foreach($array_language as $row_language) {
            echo '<tr><td id="language_name'.$count.'">'.$row_language['name'].'</td><td id="language_level'.$count.'">'.$row_language['level'].'</td></tr>';
            $count += 1;
        }        
    echo '</table></div>
        <div id="edit_languages_button">';
        if($_SESSION['user_level'] == "student") {
            echo "<button type='button' id='edit_languages'>Edit</button>";
        }
    echo '</div>';

    echo '<h2>Keywords</h2>
        <div id="keywords">        
        <table id="keyword_table">';
        $count = 0;
        foreach($array_keyword as $row_keyword) {
            echo '<tr><td id="keyword_category'.$count.'">'.$row_keyword['category'].'</td><td id="keyword_word'.$count.'">'.$row_keyword['word'].'</td></tr>';
            $count += 1;
        }
    echo '</table></div>
        <div id="edit_keywords_button">';
        if($_SESSION['user_level'] == "student") {
            echo "<button type='button' id='edit_keywords'>Edit</button>";
        }
    echo '</div>';

?>

<?php
    if($_SESSION['user_level'] == "student") {
        echo "<script src='js/manage_resume.js'></script>";
    }
?>

