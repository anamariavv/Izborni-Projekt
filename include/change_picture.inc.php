<?php
    session_start();
    require_once "database_connect.inc.php";

    if($_SESSION['user_level'] == 'student') {
        $folder = $_SESSION['oib'];
        $identifier= 'oib';
        $identifier_value = $_SESSION['oib'];
        $identifier_value_no_bind = $identifier_value;
        $column = 'picture';
        $bind_string = "si";
    } else {
        $folder = $_SESSION['id'];
        $identifier = 'id';
        $identifier_value = $_SESSION['id'];
        $identifier_value_no_bind = "'".$_SESSION['id']. "'";
        $column = 'logo';
        $bind_string = "ss";
    }

    //if the picture is to be deleted
    if(isset($_GET['delete']) == 'true)') {
        $sql = "UPDATE " . $_SESSION['user_level'] . " SET " . $column . " = NULL WHERE " . $identifier . " = " . $identifier_value_no_bind; 
         if(!($conn->query($sql))) {
            header("Location: ../profile.php?error=sql");
            exit();
        }
        header("Location: ../profile.php?success=deleted");
        exit();
    } else {
        //if the picture is to be changed
        
        if(!file_exists("../pictures")) {
            mkdir("../pictures");
        }

        $picture_name = $_FILES['picture']['name'];
        $current_path_string = pathinfo($picture_name);

        $tmp_picture_name =  $_FILES['picture']['tmp_name'];
        $new_file_name = $current_path_string['filename'];
        $new_file_ext= $current_path_string['extension'];
        $new_path_string = dirname(__DIR__, 1)."\pictures\\";

        if(!file_exists($new_path_string.$folder)) {
            mkdir($new_path_string.$folder);  
        }

        $local = 'pictures\\'.$folder.'\\'.$new_file_name.'.'.$new_file_ext;
        $target = $new_path_string.$folder.'\\'.$new_file_name.'.'.$new_file_ext;
    
        move_uploaded_file($tmp_picture_name, $target);
       
        $sql = "UPDATE " . $_SESSION['user_level'] . " SET " . $column . " = ? WHERE " . $identifier . " = ? ";
        if(!($stmt = $conn->prepare($sql))) {
            header("Location: ../profile.php?error=sql");
            exit();
        } 
        if(!($stmt->bind_param($bind_string, $local, $identifier_value))) {
            header("Location: ../profile.php?error=sql");
            exit();
        }
        if(!($stmt->execute())) {
            header("Location: ../profile.php?error=sql");
            exit();
        }
        header("Location: ../profile.php?success=changed");
        exit();
    }
?>