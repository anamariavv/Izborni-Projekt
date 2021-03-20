<?php
    include_once "header.php";
?>

<h2>Add an administrator</h2>

<form action="include/add_administrator.inc.php" id='administrator_form' method='post' target="_self" name="administrator_form">
    Firstname: <input type="text" id="firstname" name="firstname"><br>
    Lastname: <input type="text" id="lastname" name="lastname"><br>
    E-mail: <input type="email" id="email" name="email"><br>
    Password: <input type="password" id="password" name="password"><br>
    Please confirm password: <input type="password" id="password_check" name="password_check"><br>
    <input type="submit" value="Submit" name="administratorsubmit"> 
</form>

<?php
    include_once "footer.php";
?>