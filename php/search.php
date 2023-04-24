<?php
    session_start();
    include_once "./config.php";
    $outgoing_id = $_SESSION['unique_id'];
    $searchTerm = $_POST['searchTerm'];
    $output = "";

    $sql = $pdo->prepare("SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} AND (fname LIKE :searchTerm OR lname LIKE :searchTerm)");
    $sql->bindParam(":searchTerm", $searchTerm);
    $sql->execute();
    if ($sql->rowCount() > 0) {
        include "./data.php";
    }else{
        $output .= "No user found related to your search";
    }
    echo $output;
?>