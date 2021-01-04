<?php
    include_once "header.php";
    require_once "include/profile.inc.php";

    //to to:
    //edit profile-> detect changed fields with js and activate submit button if needed
    //change picture 

    if($_SESSION["user_level"] == "student") {
        $html_title = "<h1>My Profile<h1><h3>Personal information</h3>";
        $picture_src = $row["picture"];
        $html_info = "<form id='profileform'>
        First name: <input type='text' id='firstname' value=".$row["firstname"]."><br>
        Lastname: <input type='text' id='lastname' value=".$row["lastname"]."><br>
        OIB: <input type='number' id='oib' value=".$row["oib"]."><br> 
        Age: <input type='number' id='age' value=".$row["age"]."><br>
        University: <textarea name='university' form='profileform'>".$row['university']."</textarea><br> ";
    } else {
        $html_title = "<h1>Profile<h1><h3>Company information</h3>";
        $picture_src = $row["logo"];
        $html_info = "<form id='profileform'>
        Company name: <input type='text' id='cname' value=".$row["name"]."><br>
        Field of work: <input type='text' id='field' value=".$row["field"]."><br>
        Website: <input type='text' id='web' value=".$row["website"]."><br>
        Description: <textarea name='description' form='profileform'>".$row['description']."</textarea><br>";
    }

    echo $html_title;
    if(!empty($picture_src)) {
        echo "<img src=' ".$picture_src."' alt='Profile picture' width=100 height=100><br>";
    }
    echo $html_info;
    echo "Email: <input type='email' id='email' value=".$row["email"]."><br>
    Phone number: <input type='text' id='phone' value=".$row["phone_number"]."><br>
    City: <input type='text' id='city' value=".$row["city"]."><br>
    Address: <input type='text' id='address' value=".$row["address"]."><br>
    Postal code: <input type='number' id='postal' value=".$row["postal_code"]."><br>
    </form>";
    echo "<div id='passdiv'></div>";
    echo "<div id='passresult'></div>";
    echo "<button type='button' id='change_pass'><p id='buttontext'>Change Password</p></button>";
    echo "<script src='js/changepass.js'></script>";

    include_once "footer.php";
?>

    



