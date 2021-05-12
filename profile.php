<?php
    include_once "header.php";
    require_once "include/profile.inc.php";


    if($_SESSION["user_level"] == "student") {
        $html_title = "<div class='profile_wrapper'><h1 class='h1'>My Profile</h1>";
        $picture_src = $row["picture"];
        $html_info = "<div id='info_div' class='profile_form'><table class='profile_table' id='information'>
        <tr><td class='profile_table_col'>Firstname</td><td id='fname'>".$row['firstname']."</td></tr>
        <tr><td class='profile_table_col'>Lastname</td><td id='lname'>".$row['lastname']."</td></tr>
        <tr><td class='profile_table_col'>TIN <br>*(Tax Identification Number) <br> The personal identification number is a constant identifier of
        any person (natural or legal) that the public authorities use in the official records, in their everyday
        work and by data exchange. E.g. (Croatia - OIB, Germany - Steuer-ID, Italy - Codice fiscale)</td><td id='oib'>".$row['oib']."</td></tr>
        <tr><td class='profile_table_col'>Age</td><td id='age'>".$row['age']."</td></tr>
        <tr><td class='profile_table_col'>University</td><td id='university'>".$row['university']."</td></tr>";
    } else if($_SESSION['user_level'] == 'company') {
        $html_title = "<div class='profile_wrapper'><h1 class='h1'>Profile</h1>";
        $picture_src = $row["logo"];
        $html_info = "<div id='info_div' class='profile_form_company'><table class='profile_table' id='information'>
        <tr><td class='profile_table_col'>Company Name</td><td id='cname'>".$row['name']."</td></tr>
        <tr><td class='profile_table_col'>Field of Work</td><td id='field'>".$row['field']."</td></tr>
        <tr><td class='profile_table_col'>Website</td><td id='website'>".$row['website']."</td></tr>
        <tr><td class='profile_table_col'>Description</td><td id='description'>".$row['description']."</td></tr>"; 
    } else {
        $html_title = "<h1 class='h1'>My Profile</h1>";
        $html_info = "<div id='info_div' class='profile_form_admin'><table class='profile_table' id='information'>
        <tr><td class='profile_table_col'>Firstname</td><td id='fname'>".$row['firstname']."</td></tr>
        <tr><td class='profile_table_col'>Lastname</td><td id='lname'>".$row['lastname']."</td></tr>";
    }

    echo "<script src='js/changepass.js'></script>";
    if($_SESSION["user_level"] != "administrator") {
        echo "<script src='js/editprofile.js'></script>";
        echo "<script src ='js/change_picture.js'></script>";
    } 

    if($_SESSION["user_level"] == 'administrator') {
        echo "<script src='js/edit_profile_admin.js'></script>";
    }

    echo $html_title;

    if($_SESSION['user_level'] != "administrator") {
        if(!empty($picture_src)) {
            echo "<img class='profile_picture' src=' ".$picture_src."' alt='Profile picture' width=170 height=170><br>";
            echo "<div class='profile_buttons1'><a id='delete_link'><button type ='button' id='delete_picture'>Remove picture</button></a>";
        }
        echo "<button type ='button' id='change_picture'>Change picture</button></div></div>";
        echo "<div id='picture_div' class='picture_div'></div>";
    }
    

    echo $html_info;
    echo "<tr><td class='profile_table_col'>Email</td><td id='email'>".$row['email']."</td></tr>";
    if($_SESSION['user_level'] != 'administrator') {
        echo "<tr><td class='profile_table_col'>Phone Number</td><td id='phone'>".$row['phone_number']."</td></tr>
        <tr><td class='profile_table_col'>City</td><td id='city'>".$row['city']."</td></tr>
        <tr><td class='profile_table_col'>Address</td><td id='address'>".$row['address']."</td></tr>
        <tr><td class='profile_table_col'>Postal Code</td><td id='postal'>".$row['postal_code']."</td></tr>";
    }
    echo "</table>";
    if(isset($_GET['error'])) {
        if($_GET['error']=='empty_fields') {
            echo "<p class='login_error'>Please fill in all fields</p>";
        }
    }
    echo "</div>";
   
    echo "<div class='profile_buttons'><button type='button' id='edit_profile'>Edit Profile</button>";
    echo "<button type='button' id='change_pass'><p id='buttontext'>Change Password</p></button></div>";
    echo "<div id='passdiv' class='passdiv'></div>";
    echo "<div id='passresult' class='result_text'></div>";
?>

<?php
   
    include_once "footer.php";

?>