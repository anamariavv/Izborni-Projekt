<?php
    include_once "header.php";
    include_once "include/internships.inc.php";
    include_once "include/internship_feed.inc.php";
 ?>

   <h1>Welcome!</h1>
   <p>Work in progress</p>

<?php
    if(isset($_GET["success"])) {
        echo "<p>You have registered successfully!</p>";
    }
   
    if($_SESSION) {
        echo "<table>
            <tr><th colspan='9'><h2>All internships</h2></th></tr>
            <tr><th>ID</th><th>Position</th><th>Company Name</th><th>City</th><th>Deadline</th></tr>";
            foreach($result_array as $row) {
                echo "<tr><td>".$row['id']."</td><td>".$row['position']."</td><td>".$row['name']."</td><td>".$row['city']."</td><td>".$row['deadline']."</td><td><a href='internship_".$row['id'].".php?id=".$row['id']."&company=".$row['c_id']."'><button type='button'>View</button></a></td></tr>";
            }
        echo "</table>";
        if($_SESSION['user_level'] == "student") {
            echo "<script src='js/cancel_application.js'></script>";
            echo "<table>
            <tr><th colspan='9'><h2>Applied internships</h2></th></tr>
            <tr><th>ID</th><th>Position</th><th>Company Name</th><th>City</th><th>Deadline</th></tr>";
            foreach($applied_array as $applied_row) {
                echo "<tr><td>".$applied_row['id']."</td><td>".$applied_row['position']."</td><td>".$applied_row['name']."</td><td>".$applied_row['city']."</td><td>".$applied_row['deadline']."</td><td><button type='button' name='cancel'  id='".$applied_row['id']."'>Cancel</button></td></tr>";
            }
        echo "</table>";
        }
    }


    include_once "footer.php";
?>


