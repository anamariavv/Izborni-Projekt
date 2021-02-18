
<?php
    if(!isset($_GET['closed'])) {
        echo "<button type='button' id='edit_internship'>Edit</button>
        <button type='button' id='delete_internship'>Delete</button>
        <button type='button' id='close_internship'>Close internship</button>
        <button type='button' id='show_candidates'>Show candidates</button>";
        echo "<script src='js/manage_internship.js'></script>";
        echo "<div id='candidate_div'></div>";
    }
?>

