<?php
    session_start();
    require_once "database_connect.inc.php";

    //if the student doesn't have a resume, create it in database
    $sql = "SELECT resume_id FROM student WHERE oib = ". $_SESSION['oib'];
    $result = $conn->query($sql);

    if(!$result == null) {
        $new_id = "'" . $_SESSION['oib']  . "'";
        $sql = "INSERT INTO resume(id) VALUES (" . $new_id . ")";
        $conn->query($sql);

        $sql = "UPDATE student SET resume_id = " . $new_id . " WHERE oib = " . $_SESSION['oib'];
        $conn->query($sql);
    }

    $new_file_name = "../resume_".$_SESSION['oib'].".php";

    $src_code = file_get_contents("../header.php");
    $src_code .= file_get_contents("../resume_template.php");
    $src_code .= file_get_contents("../footer.php");

    $mode = "w";
    $file = fopen($new_file_name, $mode);
    fwrite($file, $src_code);

    fclose($file);

    header("Location: ".$new_file_name);
    exit();
?>