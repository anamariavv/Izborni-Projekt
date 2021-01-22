<?php
    session_start();
    require_once "database_connect.inc.php";
    //create a pictures folder if it doesnt exist!!

    //insert file to include/pictures
    $picture_name = $_FILES['picture']['name'];
    $current_path_string = pathinfo($picture_name);
    $tmp_picture_name =  $_FILES['picture']['tmp_name'];

    $new_file_name = $current_path_string['filename'];
    $new_file_ext= $current_path_string['extension'];
    $new_path_string = dirname(__DIR__, 1)."\pictures\\";

    //insert into folder with oib of user
    if($_SESSION['user_level'] == 'student') {
        $folder = $_SESSION['oib'];
        $identifier= 'oib';
        $identifier_value = $_SESSION['oib'];
        $column = 'picture';
        $bind_string = "si";
    } else {
        $folder = $_SESSION['id'];
        $identifier = 'id';
        $identifier_value = $_SESSION['id'];
        $column = 'logo';
        $bind_string = "ss";
    }

    if(!file_exists($new_path_string.$folder)) {
        mkdir($new_path_string.$folder);  
    }
    $local = 'pictures\\'.$folder.'\\'.$new_file_name.'.'.$new_file_ext;
    $target = $new_path_string.$folder.'\\'.$new_file_name.'.'.$new_file_ext;

    move_uploaded_file($tmp_picture_name, $target);
   
    $sql = "UPDATE " . $_SESSION['user_level'] . " SET " . $column . " = ? WHERE " . $identifier . " = ? ";
  
    if(!($stmt = $conn->prepare($sql))) {
        header("Location: ../profile.php?error=sql_1");
        exit();
    } 
    if(!($stmt->bind_param($bind_string, $local, $identifier_value))) {
        header("Location: ../profile.php?error=sql_2");
        exit();
    }
    if(!($stmt->execute())) {
        header("Location: ../profile.php?error=sql_3");
        exit();
    }
    header("Location: ../profile.php?success");
    exit();
?>