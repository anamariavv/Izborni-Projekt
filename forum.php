<?php
    include_once "header.php";
    require_once "include/forum.inc.php";
    echo "<script src='js/forum_comments.js'></script>";

    echo "<h1 class='h1'>".$_GET['name']." internship discussion</h1>";

    if($_SESSION['user_level'] == 'student') {
        echo "<form class='comment_form' action='include/new_comment.inc.php' method='post' name='new_comment_form' id='new_comment_form'>
        <textarea form='new_comment_form' id='comment_text' name='comment_text' cols='60' rows='5'></textarea><br>
        <input type='hidden' name='company' value='".$_GET['company']."'></input>
        <input type='hidden' name='company_name' value='".$_GET['name']."'></input>
        <input type='submit' value='Comment' id='comment_submit'></input>
        </form>";
    }    

    foreach($review_array as $review) {
        if($review['status'] == 'approved') {
            echo "<div class='comment'>";
            if($review['picture']) {
                echo "<div class='comment_left'><img src='".$review['picture']."' width='40' height='40'></img></div>";
            }
            echo "<div class='comment_text' id='text_".$review['id']."'>".$review['text']."</div><br><input type='hidden' id='".$review['oib']."' value='".$review['id']."'></input><span class='comment_author'>".$review['firstname']." ".$review['lastname']." ".$review['time']."</span></br>";
            if($_SESSION['user_level'] == 'student') {
                if($review['oib'] == $_SESSION['oib']) {
                    echo "<div class='forum_buttons'><button type='button' name='delete_comment' value='".$review['oib']."'>Delete</button>";
                    echo "<button type='button' name='edit_comment' value='".$review['id']."'>Edit</button></div>";
                }
            }
            echo "</div>";
        } else if ($review['status'] == 'pending') {
            if(($_SESSION['user_level'] == 'student' && $_SESSION['oib'] == $review['oib']) || ($_SESSION['user_level'] == 'administrator')) {
                echo "<div class='comment_pending'>";
                if($review['picture']) {
                    echo "<div class='comment_left_pending'><img src='".$review['picture']."' width='40' height='40'></img></div>";
                }
                echo "<input type='hidden' id='".$review['oib']."' value='".$review['id']."'></input><span class='comment_author_pending'>".$review['firstname']." ".$review['lastname']." ".$review['time']." -Comment pending approval </span></br>".$review['text']."<br></div>";
            }
        } 
    }        
    include_once "footer.php";
?>