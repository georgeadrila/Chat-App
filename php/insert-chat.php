<?php 
    session_start();
    if (isset($_SESSION['unique_id'])) {
        include_once "./config.php";
        $outgoing_id = $_POST['outgoing_id'];
        $incoming_id = $_POST['incoming_id'];
        $message = $_POST['message'];

        if (!empty($message)) {
            $sql = $pdo->prepare("INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
            VALUES (:incoming_id, :outgoing_id, :msg)");
            $sql->bindParam(":incoming_id", $incoming_id);
            $sql->bindParam(":outgoing_id", $outgoing_id);
            $sql->bindParam(":msg", $message);
            $sql->execute();
        }
    }else{
        header("../login.php");
    }
?>