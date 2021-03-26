<?php
    include_once "header.php";
?>
<h2>Password reset</h2>

<?php
    if(!isset($_GET['token_id'])) {
        echo "<p>Enter your email:</p>
        <form action='include/password_recovery.inc.php' method='post' target='_self' name='link_form' id='link_form'> 
            <input type='email' id='email' name='email'>
            <input type='submit' value='Submit' name='send_password_link' id='send_password_link'>  
        </form>";
    } else {
        if(isset($_GET['token_id'])) {

            require_once "include/database_connect.inc.php";

            $token_id = '"'.$_GET['token_id'].'"';

            $sql = "SELECT * FROM token WHERE token_id = " . $token_id;
            $result = $conn->query($sql);
            $info = $result->fetch_assoc();
           //check token validity
        }
        echo "<p>Enter your email:</p>
        <script src='js/reset_password.js'></script>
        <form action='include/password_recovery.inc.php' method='post' target='_self' name='passwordform' id='passwordform'> 
            Email: <input type='email' id='email' name='email'></br>
            Password: <input type='password' id='password' name='password'></br>
            Confirm password: <input type='password' name='password_check'></br>
            <input type='submit' value='Submit' name='submitpassword' id='submitpassword'>  
        </form>";
    }
?>

<?php
    if(isset($_GET['link'])) {
        echo "<div>If the email exists, a reset password link was sent</div>";
    }
    include_once "footer.php";
?>