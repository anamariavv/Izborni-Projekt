<?php
    include_once "header.php";
?>

<h2>Sign up</h2>

<form action="include/signup.inc.php" method="post" target="_self" name="signupform">
    Firstname: <input type="text" id="firstname" name="firstname"><br>
    Lastname: <input type="text" id="lastname" name="lastname"><br>
    OIB: <input type="number" id="oib" name="oib"><br> <!--nije oib na engleskom->dodaj pored polja-->
    Age: <input type="number" id="age" name="age"><br>
    E-mail: <input type="email" id="email" name="email"><br>
    City: <input type="text" id="city" name="city"><br> 
    University: <input type="text" id="university" name="university"><br> 
    Password: <input type="password" id="pwd1" name="pwd1"><br> 
    Please confirm password: <input type="password" id="pwd2" name="pwd2"><br> 
    <input type="submit" value="Sign up!" name="signupsubmit">  
</form>

<script src="js/signup.js"></script> 

<?php
    if(isset($_GET["error"])) {
        if($_GET["error"] == "sql") {
            echo "<p>There was an SQL error. Please try again.</p>";
        }
        if($_GET["error"] == "email_taken") {
            echo "<p>This email is already in use.</p>";
        }
    }

    include_once "footer.php";
?>