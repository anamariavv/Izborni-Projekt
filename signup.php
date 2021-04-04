<?php
    include_once "header.php";
?>

<h2 class='signup_title'>Sign up</h2>
<div class='signup'>
    <form action="include/signup.inc.php" method="post" target="_self" name="signupform">
        <label class='signup_label'>Firstname:</label> <input type="text" id="firstname" name="firstname"><br>
        <label class='signup_label'>Lastname:</label> <input type="text" id="lastname" name="lastname"><br>
        <label class='signup_label'>TIN*:</label> <input type="number" id="oib" name="oib"><br> <!--nije oib na engleskom->dodaj pored polja-->
        <label class='signup_label'>Age:</label> <input type="number" id="age" name="age"><br>
        <label class='signup_label'>E-mail:</label> <input type="email" id="email" name="email"><br>
        <label class='signup_label'>City:</label> <input type="text" id="city" name="city"><br> 
        <label class='signup_label'>University:</label> <input type="text" id="university" name="university"><br> 
        <label class='signup_label'>Password:</label> <input type="password" id="pwd1" name="pwd1"><br> 
        <label class='signup_label'>Please confirm password:</label> <input type="password" id="pwd2" name="pwd2"><br> 
        <input type="submit" value="Sign up!" name="signupsubmit">  
    </form>
</div>
<div class='signup_div1'>
    <img src="resources/warning2.png" width="55" height="55"></img>
    <p>TIN* (Tax Identification Number) <br> The personal identification number is a constant identifier of
    any person (natural or legal) that the public authorities use in the official records, in their everyday
    work and by data exchange. E.g. (Croatia - OIB, Germany - Steuer-ID, Italy - Codice fiscale)</p>
</div>

<script src="js/signup.js"></script> 

<?php
    if(isset($_GET["error"])) {
        if($_GET["error"] == "sql") {
            echo "<p class='signup_error'>There was an SQL error. Please try again.</p>";
        }
        if($_GET["error"] == "email_taken") {
            echo "<p class='signup_error'>This email is already in use.</p>";
        }
    }

    include_once "footer.php";
?>