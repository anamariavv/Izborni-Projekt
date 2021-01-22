<?php
    include_once "header.php";
    require_once "include/profile.inc.php";

    if($_SESSION["user_level"] == "student") {
        $html_title = "<h1>My Profile<h1><h3>Personal information</h3>";
        $picture_src = $row["picture"];
        $html_info = "<div id='info_div'><table id='information'>
        <tr><td>First Name</td><td id='fname'>".$row['firstname']."</td></tr>
        <tr><td>Last Name</td><td id='lname'>".$row['lastname']."</td></tr>
        <tr><td>OIB</td><td id='oib'>".$row['oib']."</td></tr>
        <tr><td>Age</td><td id='age'>".$row['age']."</td></tr>
        <tr><td>University</td><td id='university'>".$row['university']."</td></tr>";
    } else {
        $html_title = "<h1>Profile<h1><h3>Company information</h3>";
        $picture_src = $row["logo"];
        $html_info = "<div id='info_div'><table id='information'>
        <tr><td>Company Name</td><td id='cname'>".$row['name']."</td></tr>
        <tr><td>Field of Work</td><td id='field'>".$row['field']."</td></tr>
        <tr><td>Website</td><td id='website'>".$row['website']."</td></tr>
        <tr><td>Description</td><td id='description'>".$row['description']."</td></tr>"; 
    }

    echo $html_title;
    if(!empty($picture_src)) {
        echo "<img src=' ".$picture_src."' alt='Profile picture' width=170 height=170><br>";
        echo "<button type ='button' id='delete_picture'>Remove picture</button><br>";
    }
    echo "<button type ='button' id='change_picture'>Change picture</button><br>";
    echo "<div id='picture_div'></div>";

    echo $html_info;
    echo "<tr><td>Email</td><td id='email'>".$row['email']."</td></tr>
    <tr><td>Phone Number</td><td id='phone'>".$row['phone_number']."</td></tr>
    <tr><td>City</td><td id='city'>".$row['city']."</td></tr>
    <tr><td>Address</td><td id='address'>".$row['address']."</td></tr>
    <tr><td>Postal Code</td><td id='postal'>".$row['postal_code']."</td></tr>
    </table>
    </div>";

    echo "<div id='passdiv'></div>";
    echo "<button type='button' id='edit_profile'>Edit Profile</button><br>";
    echo "<button type='button' id='change_pass'><p id='buttontext'>Change Password</p></button>";
    echo "<div id='passresult'></div>";
    echo "<script src='js/changepass.js'></script>";
    echo "<script src='js/editprofile.js'></script>";
    echo "<script src ='js/change_picture.js'></script>";
    
?>

<?php
    if(isset($_GET['error'])) {
               
    } else if(isset($_GET['success'])) {
        
    }

    include_once "footer.php";

?>