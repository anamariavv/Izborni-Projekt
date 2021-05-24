<?php
    require_once "database_connect.inc.php";


    //get company information
    $sql = 'SELECT internship.id, internship.created, internship.salary, internship.position, internship.description, internship.city, 
    internship.requirements, internship.status, internship.deadline, company.id AS company_id, company.description as company_description, 
    company.name as company_name, company.city as company_city, company.address as company_address, company.postal_code as company_postal,
    company.email as company_email, company.phone_number as company_phone, company.website as company_website, 
    company.field as company_field FROM internship inner JOIN company ON (company.id = internship.company_id)';

    $result = $conn->query($sql);
    $result_array = $result->fetch_all(MYSQLI_ASSOC);

   
    //--create page for each internship--    
    foreach ($result_array as $row) {
        //get rating
        $sql_rate = 'SELECT ROUND(AVG(grade), 2) as average FROM rating WHERE company_id = "'.$row['company_id'].'"';
        
        $result_rate = $conn->query($sql_rate);
        $average_rating_rate = $result_rate->fetch_all(MYSQLI_ASSOC);
        
        $rate = $average_rating_rate[0]['average'];
        if($average_rating_rate[0]['average'] == NULL) {
            $rate = 0;
        }
         
        //get number of votes
        $sql_rate_no = 'SELECT COUNT(*) as rating_count FROM rating WHERE company_id = "'.$row['company_id'].'"';
        
        $result_rate_no = $conn->query($sql_rate_no);
        $rating_count_rate_no = $result_rate_no->fetch_all(MYSQLI_ASSOC);

        $new_file_name = 'internship_'.$row['id'].'.php';

        //create content and source code
        $src_code = file_get_contents("header.php");
        $src_data = "<div id='company_info_div'>
            <table class='company_info_table'>
                <tr><th class='company_info_header' colspan='2'>Company Information</th></tr>
                <tr><td class='td_left'>Company rating</td><td>".$rate.", voted by ".$rating_count_rate_no[0]['rating_count']." users</td></tr>
                <tr><td class='td_left'>Company Name</td><td>".$row['company_name']."</td></tr>
                <tr><td class='td_left'>Field of work</td><td>".$row['company_field']."</td></tr>
                <tr><td class='td_left'>Company Description</td><td>".$row['company_description']."</td></tr>
                <tr><td class='td_left'>City</td><td>".$row['company_city']."</td></tr>
                <tr><td class='td_left'>Address</td><td>".$row['company_address']."</td></tr>
                <tr><td class='td_left'>Postal code</td><td>".$row['company_postal']."</td></tr>
                <tr><td class='td_left'>Email</td><td>".$row['company_email']."</td></tr>
                <tr><td class='td_left'>Phone number</td><td>".$row['company_phone']."</td></tr>
                <tr><td class='td_left'>Website</td><td>".$row['company_website']."</td></tr>
            </table>
        </div>";
        $src_code .= $src_data;
        $src_data = "<div id='information_div'>
            <table id='information_table' class='internship_info_table'>
                <tr><th class='internship_info_header' colspan='2'>Internship information</th></tr>
                <tr><td class='td_left'>ID</td><td id='id'>".$row['id']."</td></tr>
                <tr><td class='td_left'>Date Created</td><td id='created'>".$row['created']."</td></tr>
                <tr><td class='td_left'>Position</td><td id='position'>".$row['position']."</td></tr>
                <tr><td class='td_left'>Work Description</td><td id='description'>".$row['description']."</td></tr>
                <tr><td class='td_left'>City</td><td id='city'>".$row['city']."</td></tr>
                <tr><td class='td_left'>Requirements</td><td id='requirements'>".$row['requirements']."</td></tr>
                <tr><td class='td_left'>Status</td><td id='status'>".$row['status']."</td></tr>
                <tr><td class='td_left'>Monthly Salary (Gross Pay)</td><td id='salary'>".$row['salary']."</td></tr>
                <tr><td class='td_left'>Application Deadline</td><td id='deadline'>".$row['deadline']."</td></tr>
                <tr><td class='td_left'>Description</td><td id='description'>".$row['description']."</td></tr>
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
    

