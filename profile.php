<?php
    include_once "header.php";
    require_once "include/profile.inc.php";

    //to to:
    /* edit profile->edit button next to each field when pressed turns it into form with 
    submit and cancel buttons --> each td is a form*/
    //change picture 
    echo "<script src='js/changepass.js'></script>";
    echo "<script src='js/editprofile.js'></script>";

    if($_SESSION["user_level"] == "student") {
        $html_title = "<h1>My Profile<h1><h3>Personal information</h3>";
        $picture_src = $row["picture"];
        $html_info = "<div id='info_div'>
        <form>
        <table id='information'>
        <tr><td>First Name</td><td id='fname'>".$row['firstname']."</td><td><button type='button' id='edit_fname'>Edit</button></td><td id='cancel_edit_div'></td></tr>
        <tr><td>Last Name</td><td id='lname'>".$row['lastname']."</td><td><button type='button' id='edit_lname'>Edit</button></td><td id='cancel_edit_div'></td></tr>
        <tr><td>OIB</td><td id='oib'>".$row['oib']."</td><td><button type='button' id='edit_oib'>Edit</button></td><td id='cancel_edit_div'></td></tr>
        <tr><td>Age</td><td id='age'>".$row['age']."</td><td><button type='button' id='edit_age'>Edit</button></td><td id='cancel_edit_div'></td></tr>
        <tr><td>University</td><td id='university'>".$row['university']."</td><td><button type='button' id='edit_university'>Edit</button></td><td id='cancel_edit_div'></td></tr>";
    } else {
        $html_title = "<h1>Profile<h1><h3>Company information</h3>";
        $picture_src = $row["logo"];
        $html_info = "<div id='info_div'>
        <table id='information'>
        <tr><td>Company Name</td><td id='cname'>".$row['name']."</td><td><button type='button' id='edit_cname'>Edit</button></td><td id='cancel_edit_div1'></td></tr>
        <tr><td>Field of Work Name</td><td id='field'>".$row['field']."</td><td><button type='button' id='edit_field'>Edit</button></td><td id='cancel_edit_div2'></td></tr>
        <tr><td>Website</td><td id='website'>".$row['website']."</td><td><button type='button' id='edit_website'>Edit</button></td><td id='cancel_edit_div3'></td></tr>
        <tr><td>Description</td><td id='description'>".$row['description']."</td><td><button type='button' id='edit_description'>Edit</button></td><td id='cancel_edit_div4'></td></tr>"; 
    }

    echo $html_title;
    if(!empty($picture_src)) {
        echo "<img src=' ".$picture_src."' alt='Profile picture' width=100 height=100><br>";
    }
    echo $html_info;
    echo "<tr><td>Email</td><td id='email'>".$row['email']."</td><td><button type='button' id='edit_email'>Edit</button></td><td id='cancel_edit_div1'></td></tr>
    <tr><td>Phone Number</td><td id='phone'>".$row['phone_number']."</td><td><button type='button' id='edit_phone'>Edit</button></td><td id='cancel_edit_div2'></td></tr>
    <tr><td>City</td><td id='city'>".$row['city']."</td><td><button type='button' id='edit_city'>Edit</button></td><td id='cancel_edit_div3'></td></tr>
    <tr><td>Address</td><td id='address'>".$row['address']."</td><td><button type='button' id='edit_address'>Edit</button></td><td id='cancel_edit_div4'></td></tr>
    <tr><td>Postal Code</td><td id='postal'>".$row['postal_code']."</td><td><button type='button' id='edit_postal'>Edit</button></td><td id='cancel_edit_div5'></td></tr>
    </div>
    </table>";

    echo "<div id='passdiv'></div>";
    echo "<div id='passresult'></div>";
    echo "<button type='button' id='change_pass'><p id='buttontext'>Change Password</p></button>";
    
    include_once "footer.php";
?>