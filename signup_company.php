<?php
    include_once "header.php";
?>

    <h2 class='company_signup_title'>Partner with us!</h2>
<div class='company_signup'>
    <form action="include/signup_company.inc.php" method="post" target="_self" name="c_signupform">
        <label class='company_signup_label'>Company name:</label> <input type="text" id="cname" name="cname"><br>
        <label class='company_signup_label'>City:</label> <input type="text" id="city" name="city"><br>
        <label class='company_signup_label'>Address:</label> <input type="text" id="address" name="address"><br>
        <label class='company_signup_label'>Postal code:</label> <input type="number" id="postal" name="postal"><br>
        <label class='company_signup_label'>Email:</label> <input type="email" id="email" name="email"><br>
        <label class='company_signup_label'>Phone number:</label> <input type="text" id="phone" name="phone"><br>
        <label class='company_signup_label'>Field of work:</label> <input type="text" id="field" name="field"><br>
        <label class='company_signup_label'>Password:</label> <input type="password" id ="pwd1" name="pwd1"><br>
        <label class='company_signup_label'>Please confirm password:</label> <input type="password" id="pwd2" name="pwd2"><br>
        <input type="submit" value="Sign up!" name="signup_companysubmit">  
    </form>
</div>
<script src="js/signup_company.js"></script>

<?php
    if(isset($_GET["error"])) {
        if($_GET["error"] == "sql") {
            echo "<p class='signup_error'>There was an SQL error. Please try again.</p>";
        }
        if($_GET["error"] == "email_taken") {
            echo "<p class='signup_error'>This email is already taken.</p>";
        }
    }

    include_once "footer.php";
?>