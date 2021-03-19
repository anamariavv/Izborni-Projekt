<?php
    include_once "header.php";
    require_once "include/forum.inc.php";
    echo "<script src='js/forum_comments.js'></script>";


    echo "<h1>".$_GET['name']." internship discussion</h1>";
    echo "<div><h3>Welcome to company forums!</h3></div>";
    echo "<div><p>This forum is meant for students to share their internship experience for this company.
        Please be respectful of one another. Comments will appear once approved by an administrator - inappropriate comments will not be approved or diplayed.</p></div>";

    foreach($review_array as $review) {

        echo "<span>";
        if($review['picture']) {
            echo "<span><img src='".$review['picture']."' width='40' height='40'></img></span>";
        }
        echo "<input type='hidden' id='".$review['oib']."' value='".$review['id']."'></input><span>".$review['firstname']." ".$review['lastname']." ".$review['time']."</span></br>".$review['text']."<br></span>";
        if($_SESSION['user_level'] == 'student') {
            if($review['oib'] == $_SESSION['oib']) {
                echo "<button type='button' name='delete_comment' value='".$review['oib']."'>Delete</button>";
            }
        }
        echo "</br>";
    }   

    //napravi form za novi komentar
    if($_SESSION['user_level'] == 'student') {
        echo "<form action='include/new_comment.inc.php' method='post' name='new_comment_form' id='new_comment_form'>
        <textarea form='new_comment_form' id='comment_text' name='comment_text' cols='50'></textarea><br>
        <input type='hidden' name='company' value='".$_GET['company']."'></input>
        <input type='hidden' name='company_name' value='".$_GET['name']."'></input>
        <input type='submit' value='Comment' id='comment_submit'></input>
        </form>";
    }    
     
    include_once "footer.php";
?>