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
    include_once "footer.php";
?>