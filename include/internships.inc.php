<?php
    require_once "database_connect.inc.php";

    $sql = 'SELECT internship.id, internship.created, internship.salary, internship.position, internship.description, internship.city, internship.requirements, internship.status, internship.deadline, company.id AS company_id FROM internship inner JOIN company ON (company.id = internship.company_id) ';

    $result = $conn->query($sql);
    $result_array = $result->fetch_all(MYSQLI_ASSOC);

    //--create page for each internship--    
    foreach ($result_array as $row) {
        $new_file_name = 'internship_'.$row['id'].'.php';

        //create content and source code
        $src_code = file_get_contents("header.php");
        $src_data = "<div id='information_div'>
            <table id='information_table'>
                <tr><th colspan='9'>Internship information</th></tr>
                <tr><th>ID</th><th>Date Created</th><th>Position</th><th>Work Description</th><th>City</th><th>Requirements</th><th>Status</th><th>Monthly Salary (Gross Pay)</th><th>Application Deadline</th></tr>
                <tr><td id='id'>".$row['id']."</td><td id='created'>".$row['created']."</td><td id='position'>".$row['position']."</td><td id='description'>".$row['description']."</td><td id='city'>".$row['city']."</td><td id='requirements'>".$row['requirements']."</td><td id='status'>".$row['status']."</td><td id='salary'>".$row['salary']."</td><td id='deadline'>".$row['deadline']."</td></tr>
            </table>
        </div>";      
        $src_code .= $src_data;
        $src_code .= '<?php $company_id = "'.$row['company_id'].'" ?>';
        $src_code .= file_get_contents("template.php");
        $src_code .= file_get_contents("footer.php");

        //create file, name based od internship id
        $mode = 'w';
        $file = fopen($new_file_name, $mode);
        
        //write source code to file
        fwrite($file, $src_code);

        //close file
        fclose($file);    
    }
    

