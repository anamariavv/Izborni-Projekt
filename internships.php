<?php
    include_once "header.php";
    require_once "include/internships.inc.php"; 
?>
    <table class='index_table'>
        <tr><th class='table_header' colspan="9">Open internships<th></tr>
        <tr class='index_column_names'><th>ID</th><th>Company Rating</th><th>Position</th><th>City</th><th>Status</th><th>Deadline</th><th>Actions</th></tr>
        <?php
            foreach($result_array as $row) {

                $sql_2 = 'SELECT ROUND(AVG(grade), 2) as average FROM rating WHERE company_id = "'.$row['company_id'].'"';
        
                $result_2 = $conn->query($sql_2);
                $average_rating_2 = $result_2->fetch_all(MYSQLI_ASSOC);

                if($row['status'] == 'open' && $row['company_id'] == $_SESSION['id']) {
                    echo "<tr><td>".$row['id']."</td><td>".$average_rating_2[0]['average']."</td><td>".$row['position']."</td><td>".$row['city']."</td><td>".$row['status']."</td><td>".$row['deadline']."</td><td><a href='internship_".$row['id'].".php?id=".$row['id']."'><button type='button'>View</button></a></td></tr>";
                }
            }
        ?>
    </table>
    
    <table class='index_table'>
        <tr><th class='table_header' colspan = "9">Internship Archive<th></tr>
        <tr class='index_column_names'><th>ID</th><th>Position</th><th>City</th><th>Actions</th></tr>
        <?php
            foreach($result_array as $row) {
                    if($row['status'] == 'closed' && $row['company_id'] == $_SESSION['id']) {
                        echo "<tr><td>".$row['id']."</td><td>".$row['position']."</td><td>".$row['city']."</td><td><a href='internship_".$row['id'].".php?closed'><button type='button'>View</button></a></td></tr>";
                    }
                }
        ?>
    </table>


    <button type="button" class="button_grey_center" id="new_internship">Create new internship</button>
    <div id="create_new"></div>
    <script src="js/new_internship.js"></script>
<?php
    include_once "footer.php";
?>