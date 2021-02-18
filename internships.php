<?php
    include_once "header.php";
    require_once "include/internships.inc.php"; 
?>
    <h1>Internships</h1>

    <table>
        <tr><th colspan="9"><h2>Open internships</h2></th></tr>
        <tr><th>ID</th><th>Position</th><th>City</th><th>Status</th><th>Deadline</th></tr>
        <?php
            foreach($result_array as $row) {
                if($row['status'] == 'open' && $row['company_id'] == $_SESSION['id']) {
                    echo "<tr><td>".$row['id']."</td><td>".$row['position']."</td><td>".$row['city']."</td><td>".$row['status']."</td><td>".$row['deadline']."</td><td><a href='internship_".$row['id'].".php'><button type='button'>View</button></a></td></tr>";
                }
            }
        ?>
    </table>
    
    <table>
        <tr><th colspan = "9"><h2>Internship Archive</h2></th></tr>
        <tr><th>ID</th><th>Position</th><th>City</th></tr>
        <?php
            foreach($result_array as $row) {
                    if($row['status'] == 'closed' && $row['company_id'] == $_SESSION['id']) {
                        echo "<tr><td>".$row['id']."</td><td>".$row['position']."</td><td>".$row['city']."</td><td><a href='internship_".$row['id'].".php?closed'><button type='button'>View</button></a></td></tr>";
                    }
                }
        ?>
    </table>


    <button type="button" id="new_internship">Create new internship</button>
    <div id="create_new"></div>
    <script src="js/new_internship.js"></script>
<?php
    include_once "footer.php";
?>