<?php
    session_start();
    if (!isset($_SESSION['unique_id'])) {
        header("location: login.php");
    }
?>


<?php include_once "./header.php" ?>
<body>
    <div class="wrapper">
        <section class="users">  
            <header>
                <?php
                    include_once "php/config.php";
                    // select user where unique id is equal to session unique id using pdo
                    $sql = $pdo -> prepare("SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
                    $sql -> execute();
                    if ($sql -> rowCount() > 0) {
                        $row = $sql -> fetch(PDO::FETCH_ASSOC);
                    }
                ?>
                <div class="content">
                    <img src="./php/images/<?php echo $row['image'] ?>" alt="">
                    <div class="details">
                        <span><?php echo $row ['fname'] . " " . $row['lname'] ?></span>
                         <p><?php echo $row ['status'] ?></p>
                    </div>
                </div>
                <a href="./php/logout.php?logout_id=<?php echo $row['unique_id'] ?>" class="logout">Logout</a>
            </header>

            <div class="search">
                <span class="text">Select a user to start a chat</span>
                <input type="text" placeholder="Enter name to search" id="">
                <button><i class="uil uil-search-alt"></i></button>
            </div>

            <div class="users-list">
            
            </div>
        </section>
    </div>


<script src="./js/users.js"></script>
<script src="https://unicons.iconscout.com/release/v4.0.0/script/monochrome/bundle.js" ></script>
</body>
</html>