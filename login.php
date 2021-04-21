<?php 
    include_once "header.php";
?>
    <div class="login_title">
        <h2>Log in</h2>
    </div>
    <div class="login">
    <div class="login_title_img">
        <img src='resources/logo.png' width="400" height="396"></img>
    </div>
    <div class='login_form'>
    <form action="include/login.inc.php" method="post" target="_self">
        &nbsp &nbsp &nbsp Email: &nbsp <input type="text" id="email" name="email"><br>
        Password: &nbsp <input type="password" id="password" name="password"><br>
        <input type="submit" value="Log in" name="loginsubmit"><br>
        <?php
         if(isset($_GET["error"])) {
            if($_GET["error"] == "sql") {
                echo "<p class='login_error'>There was an SQL error. Please try again.</p>";
            }
            if($_GET["error"] == "empty_fields") {
                echo "<p class='login_error'>Please fill in all fields.</p>";
            }
            if($_GET["error"] == "not_found") {
                echo "<p class='login_error'>User doesn't exist.</p>";
            }
            if($_GET["error"] == "incorrect_password") {
                echo "<p class='login_error'>The password you entered is incorrect.</p>";
            } 
        }
        if(isset($_GET["reset"])) {
            echo "<p class='login_error'>Your password has been successfully reset.</p>";
        }
        ?>
        <p><a href="reset_password.php">Forgot your password?</a></p> 
    </form>
    </div>
    </div>

<?php 

    include_once "footer.php";
?>