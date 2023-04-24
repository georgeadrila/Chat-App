<?php
    session_start();
    include_once "./config.php";
    $outgoing_id = $_SESSION['unique_id'];
    $sql = $pdo->prepare("SELECT * FROM users WHERE NOT unique_id = {$outgoing_id}");
    $sql->execute();
    $output = "";
    if ($sql->rowCount() == 1) {
        $output .= "No users are available to chat"; 
    }elseif ($sql->rowCount() > 0) {
        include "./data.php";
    }
    echo $output;

?> 