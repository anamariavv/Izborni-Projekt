<?php

    require_once "database_connect.inc.php";
    if(isset($_POST['send_password_link'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);

        $sql = "SELECT * FROM student WHERE email = ?";
        if(!($stmt = $conn->prepare($sql))) {
            header("Location: ../reset_password?error=sql");
            exit();
        }
        if(!($stmt->bind_param("s", $email))) {
            header("Location: ../reset_password?error=sql");
            exit();
        }
        if(!($stmt->execute())) {
            header("Location: ../reset_password?error=sql");
            exit();
        }
        
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if($row) {
            $token_id_bytes = openssl_random_pseudo_bytes(8);
            $token_id = bin2hex($token_id_bytes);
            $token_id_string = '"'.$token_id.'"';
            $sql = "INSERT INTO token(token_id) VALUES (" . $token_id_string.")";

            if(!($conn->query($sql))) {
                header("Location: ../reset_password.php?error=sql".$conn->error);
                exit();
            }

            $link = "http://localhost/izborni_projekt/reset_password.php?token_id=".$token_id;
            $email_text = "Hello ".$row['firstname']."! <br> To reset your password please follow this link ".$link." <br> -Internship Platform";
            $email_text = wordwrap($email_text, 70);
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: Internship@Platform.com" . "\r\n";
            if(mail($row['email'],"Internship platform - Password reset", $email_text, $headers)) {
                header("Location: ../reset_password.php?link=sent");
                exit();
            }
        }

        $sql = "SELECT * FROM company WHERE email = ?";
        if(!($stmt = $conn->prepare($sql))) {
            header("Location: ../reset_password?error=sql");
            exit();
        }
        if(!($stmt->bind_param("s", $email))) {
            header("Location: ../reset_password?error=sql");
            exit();
        }
        if(!($stmt->execute())) {
            header("Location: ../reset_password?error=sql");
            exit();
        }
        
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if($row) {
            $token_id_bytes = openssl_random_pseudo_bytes(8);
            $token_id = bin2hex($token_id_bytes);
            $token_id_string = '"'.$token_id.'"';
            $sql = "INSERT INTO token(token_id) VALUES (" . $token_id_string.")";

            if(!($conn->query($sql))) {
                header("Location: ../reset_password.php?error=sql".$conn->error);
                exit();
            }

            $link = "http://localhost/izborni_projekt/reset_password.php?token_id=".$token_id;
            $email_text = "Hello ".$row['name']."! <br> To reset your password please follow this link ".$link." <br> -Internship Platform";
            $email_text = wordwrap($email_text, 70);
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: Internship@Platform.com" . "\r\n";
            if(mail($row['email'],"Internship platform - Password reset", $email_text, $headers)) {
                header("Location: ../reset_password.php?link=sent");
                exit();
            }
        }

        $sql = "SELECT * FROM admin WHERE email = ?";
        if(!($stmt = $conn->prepare($sql))) {
            header("Location: ../reset_password?error=sql");
            exit();
        }
        if(!($stmt->bind_param("s", $email))) {
            header("Location: ../reset_password?error=sql");
            exit();
        }
        if(!($stmt->execute())) {
            header("Location: ../reset_password?error=sql");
            exit();
        }
        
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if($row) {
            $token_id_bytes = openssl_random_pseudo_bytes(8);
            $token_id = bin2hex($token_id_bytes);
            $token_id_string = '"'.$token_id.'"';
            $sql = "INSERT INTO token(token_id) VALUES (" . $token_id_string.")";

            if(!($conn->query($sql))) {
                header("Location: ../reset_password.php?error=sql".$conn->error);
                exit();
            }

            $link = "http://localhost/izborni_projekt/reset_password.php?token_id=".$token_id;
            $email_text = "Hello ".$row['firstname']."! <br> To reset your password please follow this link ".$link." <br> -Internship Platform";
            $email_text = wordwrap($email_text, 70);
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: Internship@Platform.com" . "\r\n";
            if(mail($row['email'],"Internship platform - Password reset", $email_text, $headers)) {
                header("Location: ../reset_password.php?link=sent");
                exit();
            }
        }
        
    } else if(isset($_POST['submitpassword'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $password_hashed = password_hash($password, PASSWORD_BCRYPT);

        $sql = "SELECT * FROM student WHERE email = ?";
        if(!($stmt = $conn->prepare($sql))) {
            header("Location: ../reset_password?error=sql");
            exit();
        }
        if(!($stmt->bind_param("s", $email))) {
            header("Location: ../reset_password?error=sql");
            exit();
        }
        if(!($stmt->execute())) {
            header("Location: ../reset_password?error=sql");
            exit();
        }
        
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if($row) {
            $sql = "UPDATE student SET password = ? WHERE email = ?";
            if(!($stmt = $conn->prepare($sql))) {
                header("Location: ../reset_password?error=sql");
                exit();
            }
            if(!($stmt->bind_param("ss", $password_hashed, $email))) {
                header("Location: ../reset_password?error=sql");
                exit();
            }
            if(!($stmt->execute())) {
                header("Location: ../reset_password?error=sql");
                exit();
            }
            header("Location: ../login.php?reset=success");
        }

        $sql = "SELECT * FROM company WHERE email = ?";
        if(!($stmt = $conn->prepare($sql))) {
            header("Location: ../reset_password?error=sql");
            exit();
        }
        if(!($stmt->bind_param("s", $email))) {
            header("Location: ../reset_password?error=sql");
            exit();
        }
        if(!($stmt->execute())) {
            header("Location: ../reset_password?error=sql");
            exit();
        }
        
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if($row) {
            $sql = "UPDATE company SET password = ? WHERE email = ?";
            if(!($stmt = $conn->prepare($sql))) {
                header("Location: ../reset_password?error=sql");
                exit();
            }
            if(!($stmt->bind_param("ss", $password_hashed, $email))) {
                header("Location: ../reset_password?error=sql");
                exit();
            }
            if(!($stmt->execute())) {
                header("Location: ../reset_password?error=sql");
                exit();
            }
            header("Location: ../login.php?reset=success");
        }

        $sql = "SELECT * FROM admin WHERE email = ?";
        if(!($stmt = $conn->prepare($sql))) {
            header("Location: ../reset_password?error=sql");
            exit();
        }
        if(!($stmt->bind_param("s", $email))) {
            header("Location: ../reset_password?error=sql");
            exit();
        }
        if(!($stmt->execute())) {
            header("Location: ../reset_password?error=sql");
            exit();
        }
        
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if($row) {
            $sql = "UPDATE admin SET password = ? WHERE email = ?";
            if(!($stmt = $conn->prepare($sql))) {
                header("Location: ../reset_password?error=sql");
                exit();
            }
            if(!($stmt->bind_param("ss", $password_hashed, $email))) {
                header("Location: ../reset_password?error=sql");
                exit();
            }
            if(!($stmt->execute())) {
                header("Location: ../reset_password?error=sql");
                exit();
            }
            header("Location: ../login.php?reset=success");
        }

    }