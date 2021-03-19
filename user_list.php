<?php 
    include_once "header.php";
    include_once "include/user_list.inc.php";
?>
    
    <h2>User list</h2>

    <h3>Administrators</h3>
    
    <?php
        echo "<table>";
        echo "<tr><th>First name</th><th>Last name</th><th>Email</th></tr>";
        foreach($administrators as $admin) {
            echo "<tr><td>".$admin['firstname']."</td><td>".$admin['lastname']."</td><td>".$admin['email']."</td>";
            if($_SESSION['id'] != $admin['id']) {
                echo "<td><button type='button' name='reset_password' id='".$admin['id']."'>Reset password</button></td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    ?>

    <h3>Students</h3>

    <?php
        echo "<table>";
        echo "<tr><th>First name</th><th>Last name</th><th>Email</th><th>Phone number</th><th>OIB</th><th>Age</th><th>Address</th><th>City</th><th>Postal code</th><th>University</th></tr>";
        foreach($students as $student) {
            echo "<tr><td>".$student['firstname']."</td><td>".$student['lastname']."</td><td>".$student['email']."</td><td>".$student['phone_number']."</td><td>".$student['oib']."</td><td>".$student['age']."</td><td>".$student['address']."</td><td>".$student['city']."</td><td>".$student['postal_code']."</td><td>".$student['university']."</td><td><button type='button' name='send_notification' id='".$student['oib']."'>Send custom notification</button></td><td><button type='button' name='reset_password' id='".$student['oib']."'>Reset password</button></td></tr>";
        }
        echo "</table>";
    ?>

    <h3>Companies</h3>

    <?php
        echo "<table>";
        echo "<tr><th>Name</th><th>Email</th><th>Phone number</th><th>Field of Work</th><th>Website</th><th>Description</th><th>Address</th><th>City</th><th>Postal code</th></tr>";
        foreach($companies as $company) {
            echo "<tr><td>".$company['name']."</td><td>".$company['email']."</td><td>".$company['phone_number']."</td><td>".$company['field']."</td><td>".$company['website']."</td><td>".$company['description']."</td><td>".$company['address']."</td><td>".$company['city']."</td><td>".$company['postal_code']."</td><td><button type='button' name='send_notification' id='".$company['id']."'>Send custom notification</button></td><td><button type='button' name='reset_password' id='".$company['id']."'>Reset password</button></td></tr>";
        }
        echo "</table>";
    ?>
    
<?php 
    echo "<script src='js/user_list.js'></script>";
    include_once "footer.php";
?>