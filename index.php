<?php
    include_once "header.php";
?>

   <h1>Welcome!</h1>
   <p>Work in progress</p>

<?php
    if(isset($_GET["success"])) {
        echo "<p>You have registered successfully!</p>";
    }

    include_once "footer.php";
?>


