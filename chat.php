<?php
    session_start();
    if (!isset($_SESSION['unique_id'])) {
        header("location: login.php");
    }
?>


<?php include_once "./header.php" ?>
<body>
    <div class="wrapper">
        <section class="chat-area">  
            <header>

                 <?php
                    include_once "./php/config.php";
                    $user_id = $_GET['user_id'];
                    $sql = $pdo -> prepare("SELECT * FROM users WHERE unique_id = {$user_id}");
                    $sql -> execute();
                    if ($sql -> rowCount() > 0) {
                        $row = $sql -> fetch(PDO::FETCH_ASSOC);
                    }
                ?>

                <a href="./users.php" class="back-icon"><i class="uil uil-arrow-left"></i></a>
                <img src="./php/images/<?php echo $row['image'] ?>" alt="">
                <div class="details1">
                    <span><?php echo $row ['fname'] . " " . $row['lname'] ?></span>
                    <p><?php echo $row ['status'] ?></p>
                </div>
            </header>
            <div class="chat-box">

            </div>

            <form action="#" class="typing-area">
                <input type="text" name="outgoing_id" value="<?php echo $_SESSION['unique_id']; ?>" hidden>
                <input type="text" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
                <input type="text" name="message" class="input-field" placeholder="Type a message here....">
                <button><i class="uil uil-message"></i></button>
            </form>

        </section>
    </div>

<script src="./js/chat.js"></script>
</body>
</html>