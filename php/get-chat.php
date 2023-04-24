<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once "./config.php";
    $outgoing_id = $_POST['outgoing_id'];
    $incoming_id = $_POST['incoming_id'];
    $output = "";

    $sql = $pdo->prepare("SELECT * FROM messages
    LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
    WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
    OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id");
    $sql->execute();
    if ($sql->rowCount() > 0) {
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            if ($row['outgoing_msg_id'] === $outgoing_id) {
                $output .= '<div class="chat outgoing">
                <div class="details">
                    <p>' . $row['msg'] . '</p>
                </div>
            </div>';
            } else {
                $output .= '<div class="chat incoming">
                <img src="php/images/' . $row['img'] . '" alt="">
                <div class="details">
                    <p>' . $row['msg'] . '</p>
                </div>
            </div>';
            }
        }
        echo $output;
    }
} else {
    header("../login.php");
}
?>

            <!-- if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_assoc($query)) {
                    if ($row['outgoing_msg_id'] === $outgoing_id) { //if equal then thius the sender
                        $output .= '<div class="chat outgoing">
                                        <div class="details">
                                            <p>'. $row['msg'].'</p>
                                        </div>
                                    </div>';
                    }else{ // so be this the receiver 
                        $output .= '<div class="chat incoming">
                                        <img src="php/images/'. $row['image'].'" alt="">
                                        <div class="details">
                                            <p>'. $row['msg'].'</p>
                                        </div>
                                    </div>';
                    }
                }
                echo $output;
            }
    
}else{
    header("../login.php");
} -->
