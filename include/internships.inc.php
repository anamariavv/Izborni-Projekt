<?php
    require_once "database_connect.inc.php";

    $sql = ' SELECT * FROM internship WHERE company_id = "' . $_SESSION['id'] . '"';

    $result = $conn->query($sql);
    $result_array = $result->fetch_all(MYSQLI_ASSOC);

    //--create page for each internship--    
    foreach ($result_array as $row) {
        $new_file_name = 'internship_'.$row['id'].'.php';
        if(!file_exists($new_file_name)) {
            //if file doesn't already exist
            //create content and source code
            $src_code = file_get_contents("header.php");
            //!!finish page content->see notebook
            $src_code .= file_get_contents("footer.php");

            //create file, name based od internship id
            $mode = 'w';
            $file = fopen($new_file_name, $mode);
            
            //write source code to file
            fwrite($file, $src_code);

            //close file
            fclose($file); 
        }       
    }
    

