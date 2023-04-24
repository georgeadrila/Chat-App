<?php
    session_start();
    include_once "./config.php";
    $email = $_POST['email'];
    $password = $_POST['password'];

    // if(isset($_SESSION['unique_id'])){
        if(!empty($email) && !empty($password)){
            //checking user email and password matching it to any table row using pdo
        $sql = $pdo -> prepare("SELECT * FROM users WHERE email = :email AND password = :password");
        $sql -> bindParam(":email", $email);
        $sql -> bindParam(":password", $password);
        $sql -> execute();
        if ($sql -> rowCount() > 0) { //if user credentials are passed
            $row = $sql -> fetch(PDO::FETCH_ASSOC);
            $status = "Active now";
            $sql2 = $pdo -> prepare("UPDATE users SET status = :status WHERE unique_id = :unique_id");
            $sql2 -> bindParam(":status", $status);
            $sql2 -> bindParam(":unique_id", $row['unique_id']);
            $sql2 -> execute();
            if ($sql2) {
                $_SESSION['unique_id'] = $row['unique_id']; //using session to get unique id in php file
                // echo "success";
                header("location: users.php");
            }
        }else{
            echo "Email or password is not kawa";
        }
        }else{
            echo "All input fields are fucking required";
        }
    // }
    

?>