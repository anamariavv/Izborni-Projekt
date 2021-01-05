<?php
    include_once "header.php";
    require_once "include/profile.inc.php";

    //to to:
    /* edit profile->edit button, editing on separate page*/
    //change picture 

    if($_SESSION["user_level"] == "student") {
        $html_title = "<h1>My Profile<h1><h3>Personal information</h3>";
        $picture_src = $row["picture"];
        $html_info = "<div id='info_div'>
        <form>
        <table id='information'>
        <tr><td>First Name</td><td id='fname'>".$row['firstname']."</td></tr>
        <tr><td>Last Name</td><td id='lname'>".$row['lastname']."</td></tr>";
    } else {
        $html_title = "<h1>Profile<h1><h3>Company information</h3>";
        $picture_src = $row["logo"];
        $html_info = "<div id='info_div'>
        <table id='information'>
        <tr><td>Company Name</td><td id='cname'>".$row['name']."</td></tr>
        <tr><td>Field of Work Name</td><td id='field'>".$row['field']."</td></tr>"; 
    }

    echo $html_title;
    if(!empty($picture_src)) {
        echo "<img src=' ".$picture_src."' alt='Profile picture' width=100 height=100><br>";
    }
    echo $html_info;
    echo "<tr><td>Email</td><td id='email'>".$row['email']."</td></tr>
    <tr><td>Phone Number</td><td id='phone'>".$row['phone_number']."</td></tr>
    <tr><td>City</td><td id='city'>".$row['city']."</td></tr>
    <tr><td>Address</td><td id='address'>".$row['address']."</td></tr>
    <tr><td>Postal Code</td><td id='postal'>".$row['postal_code']."</td></tr>
    </div>
    </table>";

    echo "<div id='passdiv'></div>";
    echo "<div id='passresult'></div>";
    echo "<a href='edit_profile.php'><button type='button'>Edit Profile</button></a>";
    echo "<button type='button' id='change_pass'><p id='buttontext'>Change Password</p></button>";
    echo "<script src='js/changepass.js'></script>";
    echo "<script src='js/editprofile.js'></script>";
    
    include_once "footer.php";
?>