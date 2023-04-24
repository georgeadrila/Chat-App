<?php
    session_start();
    if (isset($_SESSION['unique_id'])) { //if user is logged in then
        header("location: users.php");
    }
?>


<?php include_once "./header.php" ?>
<body>
    <div class="wrapper">
        <section class="form signup">
            <header>
                George's chat app
            </header>
            <form action="#" enctype="multipart/form-data" autocomplete="off">
                <div class="error-txt"></div>
                <div class="name-details">
                    <div class="field input">
                        <label for="">First Name</label>
                        <input type="text" placeholder="First Name" name="fname" required>
                    </div>
 
                    <div class="field input">
                        <label for="">Last Name</label>
                        <input type="text" placeholder="Last Name" name="lname" required>
                    </div>
                </div>

                <div class="field input">
                    <label for="">Email Address</label>
                    <input type="email" placeholder="Enter your email Address" name="email" required>
                </div>

                <div class="field input">
                    <label for="">Password</label>
                    <input type="password" placeholder="Enter your password" name="password" required>
                    <i class="uil uil-eye"></i>
                </div>

                <div class="field">
                    <label for="">select image</label>
                    <input type="file" name="image/" required>
                </div>

                <div class="field button">
                    <input type="submit" value="Continue to chat">
                </div>
            </form>

            <div class="link">Already signed up? <a href="./login.php">Login now </a></div>
        </section>
    </div>

    <script src="./js/js1.js"></script>
    <script src="./js/signup.js"></script>
</body>
</html>