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
        <div id="title"></div>
        <div id="edit_title_button">';
        if($_SESSION["user_level"] == "student") {
            echo "<button type='button' id='edit_title'>Edit</button>";
        }
    echo '</div>';
    echo '<h2>Introduction</h2>
        <div id="intro" class="intro">'.$row['description'].'</div>
        <div id="edit_intro_button">';
        if($_SESSION['user_level'] == "student") {
            echo "<button type='button' id='edit_intro'>Edit</button>";
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
    echo '</tbody></table></div>';
        if(!empty($array_education)){ 
            echo '<div id="edit_education_button">';
            if($_SESSION['user_level'] == "student") {
                echo "<button type='button' id='edit_education'>Edit</button>";
            }
            echo '</div>';   
        }
    echo '<div id="add_education_button">';
        if($_SESSION['user_level'] == "student") {
            echo "<button type='button' id='add_education'>Add</button>";
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
    echo '</table></div>';
        if(!empty($array_work)) {
            echo '<div id="edit_work_experience_button">';
            if($_SESSION['user_level'] == "student") {
                echo "<button type='button' id='edit_work_experience'>Edit</button>";
            }
            echo '</div>';
        }
        
    echo '<div id="add_work_button">';
        if($_SESSION['user_level'] == "student") {
            echo "<button type='button' id='add_work'>Add</button>";
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
    echo '</tbody></table></div>';
        if(!empty($array_skill)) {
            echo '<div id="edit_skills_button">';
            if($_SESSION['user_level'] == "student") {
                echo "<button type='button' id='edit_skills'>Edit</button>";
            }
            echo '</div>';
        }  
    echo '<div id="add_skill_button">';
        if($_SESSION['user_level'] == "student") {
            echo "<button type='button' id='add_skill'>Add</button>";
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
    echo '</tbody></table></div>';
        if(!empty($array_language)) {
            echo  '<div id="edit_languages_button">';
            if($_SESSION['user_level'] == "student") {
                echo "<button type='button' id='edit_languages'>Edit</button>";
            }
            echo '</div>';
        }
    echo '<div id="add_language_button">';
        if($_SESSION['user_level'] == "student") {
            echo "<button type='button' id='add_language'>Add</button>";
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
    echo '</tbody></table></div>';
    echo '<div id="add_keyword_button">';
        if($_SESSION['user_level'] == "student") {
            echo "<button type='button' id='add_keyword'>Add</button>";
        }
    echo '</div></div>';
    echo '</div>';

?>

<?php
    if($_SESSION['user_level'] == "student") {
        echo "<script src='js/manage_resume.js'></script>";
    }
?>

