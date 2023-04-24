<?php
    session_start();
    if (isset($_SESSION['unique_id'])) { //if user is logged in then come to this page
        include_once "config.php";

        $logout_id = $_GET['logout_id'];
        if (isset($logout_id)) { //when log out is set
            $status = "Offline now";
            $sql = $pdo->prepare("UPDATE users SET status = :status WHERE unique_id = :unique_id");
            $sql->bindParam(":status", $status);
            $sql->bindParam(":unique_id", $logout_id);
            $sql->execute();
            if ($sql) {
                session_unset();
                session_destroy();
                header("location: ../login.php");
            }else{
                header("location: ../users.php");
            }
        }
    }else{ //if not then go to login page
        header("location: ../login.php");
    }
?>