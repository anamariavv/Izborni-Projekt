
<?php
    if(!isset($_GET['closed']) && $_SESSION['user_level'] == 'company') {
        echo "<button type='button' id='edit_internship'>Edit</button>
        <button type='button' id='delete_internship'>Delete</button>
        <button type='button' id='close_internship'>Close internship</button>
        <button type='button' id='show_candidates'>Show candidates</button>";
        echo "<script src='js/manage_internship.js'></script>";
        echo "<div id='candidate_div'></div>";
    } else if( $_SESSION['user_level'] == 'student') {
        echo "<a href='include/apply_internship.inc.php'><button type='button' id='apply_internship'>Apply</button></a>";
    }
?>

