<?php
    session_start();
    require_once "database_connect.inc.php";

    if(isset($_POST['administratorsubmit'])) {
        $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $user_level_id = 1;
        $id = openssl_random_pseudo_bytes(8);
        $id = bin2hex($id);
        
        $password_hashed = password_hash($password, PASSWORD_BCRYPT);

        $sql = "SELECT * FROM admin WHERE email = ?";
        if(!($stmt = $conn->prepare($sql))) {
            header("Location: ../add_administrator.php?error=sql");
            exit();
        }
        if(!($stmt->bind_param("s", $email))) {
            header("Location: ../add_administrator.php?error=sql");
            exit();
        }
        if(!($stmt->execute())) {
            header("Location: ../add_administrator.php?error=sql");
            exit();
        }
        $result = $stmt->get_result();
        if(mysqli_num_rows($result) > 0) {
            //the email is taken so redirect back so add_administrator page
            header("Location: ../add_administrator.php?error=email_taken");
            exit();
        } 

        $sql = "INSERT INTO admin(id,firstname,lastname,email,password,user_level_id) VALUES (?,?,?,?,?,?)";

        if(!($stmt = $conn->prepare($sql))) {
            header("Location: ../add_administrator.php?error=sql");
            exit();
        }
        if(!($stmt->bind_param("sssssi", $id, $firstname, $lastname, $email, $password_hashed, $user_level_id))) {
            header("Location: ../add_administrator.php?error=sql");
            exit();
        }
        if(!($stmt->execute())) {
            header("Location: ../add_administrator.php?error=sql");
            exit();
        }
        
        header("Location: ../add_administrator.php?success");
        exit();

    }
