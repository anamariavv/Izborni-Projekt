<?php
    include_once "header.php";
?>

    <h2>Partner with us!</h2>

<form action="include/signup_company.inc.php" method="post" target="_self">
    Company name: <input type="text" id="cname" name="cname"><br>
    City: <input type="text" id="city" name="city"><br>
    Address: <input type="text" id="address" name="address"><br>
    Postal code: <input type="number" id="postal" name="postal"><br>
    Email: <input type="email" id="email" name="email"><br>
    Phone number: <input type="text" id="phone" name="phone"><br>
    Field of work: <input type="text" id="field" name="field"><br>
    Password: <input type="password" id ="pwd1" name="pwd1"><br>
    Please confirm password: <input type="password" id="pwd2" name="pwd2"><br>
    <input type="submit" value="Sign up!" name="signup_companysubmit">  
</form>

<?php
    if(isset($_GET["error"])) {
        if($_GET["error"] == "sql") {
            echo "<p>There was an SQL error. Please try again.</p>";
        }
        if($_GET["error"] == "empty_fields") {
            echo "<p>Please fill in all fields.</p>";
        }
        if($_GET["error"] == "email_taken") {
            echo "<p>This email is already taken.</p>";
        }
        if($_GET["error"] == "password_weak") {
            echo "<p>The password must be 8-32 characters long, with atleast one uppercase letter and number.</p>";
        }
        if($_GET["error"] == "password_mismatch") {
            echo "<p>Passwords don't match.</p>";
        } 
    }

    include_once "footer.php";
?>