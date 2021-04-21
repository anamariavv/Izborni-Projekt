<?php
    include_once "header.php";
    include_once "include/internships.inc.php";
    include_once "include/internship_feed.inc.php";
?>
   
<?php
    if(isset($_GET["success"])) {
        echo "<p>You have registered successfully!</p>";
    }
   
    if($_SESSION) {
        echo "<table class='index_table_2'>
            <tr><th class='table_header_2' colspan='9'>All internships</th></tr>
            <tr class='index_column_names'><th>ID</th><th>Position</th><th>Company Name</th><th>City</th><th>Deadline</th><th>Action</th></tr>";
            foreach($result_array as $row) {
                echo "<tr><td>".$row['id']."</td><td>".$row['position']."</td><td>".$row['name']."</td><td>".$row['city']."</td><td>".$row['deadline']."</td><td><a href='internship_".$row['id'].".php?id=".$row['id']."&company=".$row['c_id']."'><button type='button'>View</button></a></td></tr>";
            }
        echo "</table>";
        if($_SESSION['user_level'] == "student") {
            echo "<script src='js/cancel_application.js'></script>";
            echo "<table class='index_table_2'>
            <tr><th class='table_header_2' colspan='9'>Applied internships</th></tr>
            <tr class='index_column_names'><th>ID</th><th>Position</th><th>Company Name</th><th>City</th><th>Deadline</th><th>Action</th></tr>";
            foreach($applied_array as $applied_row) {
                echo "<tr><td>".$applied_row['id']."</td><td>".$applied_row['position']."</td><td>".$applied_row['name']."</td><td>".$applied_row['city']."</td><td>".$applied_row['deadline']."</td><td><button type='button' name='cancel'  id='".$applied_row['id']."'>Cancel</button></td></tr>";
            }
        echo "</table>";
        }
    } else {
        echo '<h1 class = "title_header">Internship Platform</h1>';
        echo "<div class='logo'>";
        echo "<div class='logo_index'><img src='resources/logo.png' width=350px></img></div>";
        echo "<div class='div_right'>
        <h3>Looking for an internship?</h3>
        <p>Internship Platform is a web application that helps students find internships that suit them.
        With features such as personal profiles, company reviews and online CV creation, Internship Platform allows
        you to do everything online!</p>
        </div></div>";
    }


    include_once "footer.php";
?>


