<?php
    session_start();
    
    require_once "database_connect.inc.php";
    
    echo $_SESSION['user_level'];

?>