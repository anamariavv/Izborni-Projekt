<?php
    include_once "header.php";
?>
<script src="js/reset_password.js"></script>
<h2>Password reset</h2>

 <p>New password:</p>
<form action="include/user_list.inc.php" method="post" target="_self" name="passwordform" id="passwordform">
    <?php    
        $password = openssl_random_pseudo_bytes(4);
        $password = bin2hex($password);
        $upper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $max = strlen($upper)-1;
        $password .= $upper[rand(0,$max)];
        $password .= $upper[rand(0,$max)];
    
        echo "<input type='text' value=".$password." readonly='readonly' name='password'></input>";
        echo "<input type='hidden' value='".$_GET['id']."' name='identification'></input>";
        echo "<input type='hidden' value='".$_GET['email']."' name='email'></input>";
        echo "<input type='hidden' value='".$_GET['name']."' name='user_name'></input>";
        echo "<input type='hidden' value='".$_GET['type']."' name='type'></input>"; 
        echo "<button type='button' id='regen_password_button'>Regenerate</button>";
    ?>
    <input type="submit" value="Send" name="passwordsubmit" id="passwordsubmit">  
</form>

<?php
    include_once "footer.php";
?>