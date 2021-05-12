<?php
    include_once "header.php";
    include_once "include/approve_comments.inc.php";
?>
<script src="js/approve_comments.js"></script>

<h2>All comments</h2>

   <table class='index_table'>
   <tr class='index_column_names'><th>Created</th><th>Text</th><th>Company Forum</th><th>User</th><th>Comment Status</th><th>Actions</th></tr>
    <?php
        foreach($comments as $comment) {
            echo "<tr><td>".$comment['created']."</td><td style='width:600px'>".$comment['text']."</td><td>".$comment['name']."</td><td>".$comment['firstname']." ".$comment['lastname']."</td><td>".$comment['status']."</td><td>";
            if($comment['status'] == 'pending'|| $comment['status'] == 'rejected') {
                echo "<button name='approve' id='".$comment['id']."'>Approve</button>";
            }
            if($comment['status'] == 'pending'|| $comment['status'] == 'approved') {
                echo "<button name='reject' class='reject_button' id='".$comment['id']."'>Reject</button>";
            }         
            echo "</td></tr>";
        }
    ?>
   </table>


<?php
    include_once "footer.php";
?>