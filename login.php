<?php 
    include_once "header.php";
?>
    
    <h2>Log in</h2>
    <form action="include/login.inc.php" method="post" target="_self">
        Email: <input type="text" id="email" name="email"><br>
        Password: <input type="password" id="password" name="password"><br>
        Are you a student or company? <br>
        Student <input type="radio" id="type" value="student" name="type"><br>
        Company <input type="radio" id="type" value="company" name="type"><br>
        <input type="submit" value="Log in" name="loginsubmit"><br>
    </form>

<?php 
    if(isset($_GET["error"])) {
        if($_GET["error"] == "sql") {
            echo "<p>There was an SQL error. Please try again.</p>";
        }
        if($_GET["error"] == "empty_fields") {
            echo "<p>Please fill in all fields.</p>";
        }
        if($_GET["error"] == "not_found") {
            echo "<p>User doesn't exist.</p>";
        }
        if($_GET["error"] == "incorrect_password") {
            echo "<p>The password you entered is incorrect.</p>";
        } 
    }

    include_once "footer.php";
?>