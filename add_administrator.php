<?php
    include_once "header.php";
?>

<h2>Add an administrator</h2>

<script src="js/add_administrator.js"></script>
<form class='signup' action="include/add_administrator.inc.php" id='administrator_form' method='post' target="_self" name="administrator_form">
    <label class='signup_label'>Firstname:</label><input type="text" id="firstname" name="firstname"><br>
    <label class='signup_label'>Lastname:</label><input type="text" id="lastname" name="lastname"><br>
    <label class='signup_label'>E-mail:</label><input type="email" id="email" name="email"><br>
    <label class='signup_label'>Password:</label><input type="password" id="password" name="password"><br>
    <label class='signup_label'>Please confirm password:</label><input type="password" id="password_check" name="password_check"><br>
    <input type="submit" value="Submit" name="administratorsubmit"> 
</form>

<?php
    include_once "footer.php";
?>