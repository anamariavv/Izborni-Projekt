
<?php
    if(!isset($_GET['closed']) && $_SESSION['user_level'] == 'company') {
        require_once "include/display_candidates.inc.php";
        echo "<button type='button' id='edit_internship'>Edit</button>
        <button type='button' id='delete_internship'>Delete</button>
        <button type='button' id='close_internship'>Close internship</button>";
        echo "<script src='js/manage_internship.js'></script>";
        echo "<div id='candidate_div'>";
        echo "<table>";
        echo "<thead><tr><th>OIB</th><th>Firstname</th><th>Lastname</th><th>CV</th><th>Keywords</th><th colspan='2'>Acceptance</th></tr></thead>";
        echo "<tbody id='applicants'>";
    
        foreach ($result_array as $row) {
            require_once "include/database_connect.inc.php";

            $sql = "SELECT word FROM keyword WHERE resume_id = ?";

            if(!($stmt = $conn->prepare($sql))) {
                header("Location: ../internships.php?error=mysql");
                exit();
            }

            if(!($stmt->bind_param("s", $row['oib']))) {
                header("Location: ../internships.php?error=mysql");
                exit();
            }

            if(!($stmt->execute())) {
                header("Location: ../internships.php?error=mysql");
                exit();
            } 
            $result = $stmt->get_result();
            $keyword_array = $result->fetch_all(MYSQLI_ASSOC);

            $link_string = 'resume_'.$row["oib"].'.php?oib='.$row["oib"];
            echo "<tr><td id='stu_oib'>".$row['oib']."</td><td>".$row['firstname']."</td><td>".$row['lastname']."</td><td><a href='".$link_string."' target='_blank'>View</a></td>";
            echo "<td>";
            $flag = 1;
            foreach($keyword_array as $word) {
                echo $word["word"];
                if($flag == 1 && sizeof($keyword_array) > 1) {
                    echo ",";
                    $flag = 0;
                } else {
                    $flag = 1;
                }
            }
            echo "</td>";
            if($row['acceptance'] == 'pending') {
                echo "<td id='rejection'><button type='button' name='reject' id='".$row['oib']."'>Reject</button></td><td id='acceptance'><button type='button'name='accept' id='".$row['oib']."'>Accept</button></td></tr>";
            } else if($row['acceptance'] == 'accepted') {
                echo "<td>Student accepted</td>";
            }
            
        }
        echo "</tbody></table></div>";


    } else if( $_SESSION['user_level'] == 'student') {
        require_once "include/database_connect.inc.php";
        $sql = "SELECT student_oib FROM application WHERE internship_id = ?";

        if(!($stmt = $conn->prepare($sql))) {
            $message = $stmt->error;
        }
    
        if(!($stmt->bind_param("s", $_GET['id']))) {
            $message = $stmt->error;
        }
    
        if(!($stmt->execute())) {
            $message = $stmt->error;  
        } else {
            $result_candidates = $stmt->get_result();
            $applicant_list = $result_candidates->fetch_all(MYSQLI_ASSOC);
        }

        $applied = 0;
 
        foreach ($applicant_list as $applicant) {
            if($applicant["student_oib"] == $_SESSION['oib']) {
                $applied = 1;
            }
        }

        if(!$applied) {
            echo "<a href='include/apply_internship.inc.php?id=".$_GET['id']."&company=".$_GET['company']."'><button type='button' id='apply_internship'>Apply</button></a>";
        } else {
            echo "You are already applied for this internship!";
        }
    }
?>

