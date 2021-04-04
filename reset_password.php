<?php
    include_once "header.php";
?>
<h2>Password reset</h2>

<?php
    if(!isset($_GET['token_id'])) {
        echo "<div class='reset_password'>";
        echo "<p>Enter your email:</p>
        <form action='include/password_recovery.inc.php' method='post' target='_self' name='link_form' id='link_form'> 
            <input type='email' id='email' name='email'>
            <input type='submit' value='Submit' name='send_password_link' id='send_password_link'>  
        </form></div>";
    } else {
        if(isset($_GET['token_id'])) {

            require_once "include/database_connect.inc.php";

            $token_id = '"'.$_GET['token_id'].'"';

            $sql = "SELECT * FROM token WHERE token_id = " . $token_id;
            $result = $conn->query($sql);
            $info = $result->fetch_assoc();

           if($info["token_created"] && $info["token_status"]=="valid") {
            date_default_timezone_set('Europe/Zagreb');
            $current_date = date("Y-m-d H:i:s");
            $current_date_object =  DateTime::createFromFormat("Y-m-d H:i:s", $current_date);  
            $created_date = date($info["token_created"]);
            $created_date_object = DateTime::createFromFormat("Y-m-d H:i:s", $created_date);
            $difference =date_diff($current_date_object, $created_date_object);

            if($difference->i < 10) {
                echo "<p>Enter your email:</p>
                <script src='js/reset_password.js'></script>
                Token id: <input type='text' readonly='readonly' value=".$_GET["token_id"]." id='token_id' name='token_id'><br>
                <form action='include/password_recovery.inc.php' method='post' target='_self' name='passwordform' id='passwordform'> 
                Email: <input type='email' id='email' name='email'></br>
                Password: <input type='password' id='password' name='password'></br>
                Confirm password: <input type='password' name='password_check'></br>
                <input type='submit' value='Submit' name='submitpassword' id='submitpassword'>  
                </form>";
            } else {
                echo "Link has expired. Please request password change again";
            }
            

           }
        }
    }
?>

<?php
    if(isset($_GET['link'])) {
        echo "<div class='reset_password_error'>If the email exists, a reset password link was sent</div>";
    }
    include_once "footer.php";
?>