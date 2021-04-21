<?php
    include_once "header.php";
    require_once "include/company_forums.inc.php";
?>
    <h1 class='h1'>Company forums</h1>

<?php
    echo "<div class='forum_wrapper'>";
    echo "<img src='resources/forum_icon2.png' width='100' height='100'></img>";
    echo "<div class='forum_warning'><p>This forum is meant for students to share their internship experience for a company.
    Please be respectful of one another. Comments will appear once approved by an administrator - inappropriate comments will not be approved or diplayed.</p></div>";
    echo "</div>";
    foreach ($result_array as $company_row) {
        echo "<div class='forum_list'><a href='forum?company=".$company_row['id']."&name=".$company_row['name']."'>".$company_row['name']."</a></div>";
    }

    include_once "footer.php";
?>