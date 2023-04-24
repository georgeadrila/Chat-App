<?php
    session_start();
    if (isset($_SESSION['unique_id'])) { //if user is logged in then
        header("location: users.php");
    }
?>


<?php include_once "./header.php" ?>
<body>
    <div class="wrapper">
        <section class="form login">
            <header>
                Real-time chat app
            </header>
            <form action="./php/login.php" method="POST"> 
                <div class="error-txt"></div>

                <div class="field input">
                    <label for="">Email Address</label>
                    <input type="text" placeholder="Enter your email Address" name="email">
                </div>

                <div class="field input">
                    <label for="">Password</label>
                    <input type="password" placeholder="Enter your password" name="password">
                    <i class="uil uil-eye"></i>
                </div>

                <div class="field button">
                    <input type="submit" value="Continue to chat">
                </div>
            </form>

            <div class="link">Not yet signed up? <a href="./index.php">signup now </a></div>
        </section>
    </div>

    <script src="./js/js1.js"></script>
    <!-- <script src="./js/login.js"></script> -->

</body>
</html>