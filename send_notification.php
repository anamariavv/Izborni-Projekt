<?php
    include_once "header.php";
?>

<h2>Send a custom notification</h2>

<form action="include/user_list.inc.php" method="post" target="_self" name="messageform" id="messageform">
    <textarea form="messageform" cols="50" rows="10" name="message_text"></textarea><br>
    <?php echo "<input type='hidden' value='".$_GET['id']."' name='identification'>";
            echo "<input type='hidden' value='".$_GET['type']."' name='type'>"; 
    ?>
    <input type="submit" value="Send" name="messagesubmit">  
</form>

<?php
    include_once "footer.php";
?>