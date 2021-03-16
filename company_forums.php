<?php
    include_once "header.php";
    require_once "include/company_forums.inc.php";
?>
    <h1>Company forums</h1>

<?php
    echo "<div id='company_forums_div'>";
    foreach ($result_array as $company_row) {
        echo "<div><a href='forum?company=".$company_row['id']."&name=".$company_row['name']."'>".$company_row['name']."</a><div>";
    }
    echo "</div>";

    include_once "footer.php";
?>