<?php
    session_start();
    include_once "./config.php";
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {
        // checking email validity
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) { //if email is valid
            //checking if email exists already
            $sql = $pdo -> prepare("SELECT email FROM users WHERE email = :email");
            $sql -> bindParam(":email", $email);
            $sql -> execute();
            if ($sql->rowCount() > 0) { //if email exists
                echo "$email . already exists";
            }else {
                //check user upload file
                if (isset($_FILES['image'])) { //if file is uppd
                    $img_name = $_FILES['image']['name']; //getting uppd img name
                    $tmp_name = $_FILES['image']['tmp_name']; //temp name used to stre the file

                    //exploding img to get exte
                    $img_explode = explode('.', $img_name);
                    $img_ext = end($img_explode); //getting the exte

                    $extension = ['png', 'jpeg', 'jpg']; //comon exte
                    if (in_array($img_ext, $extension) === true) {
                        $time = time(); //returns current time as part 
                                        //of name of user uppd file
                        //moving user img to our folder
                        $new_img_name = $time.$img_name;
                        if (move_uploaded_file($tmp_name, "images/".$new_img_name)) { //when user img is moved to our folfer sucfly
                            $status = "Active now";  //active status
                            $random_id = rand(time(), 100000); //creating random id

                            //inserting user data in table
                            $sql2 = $pdo -> prepare("INSERT INTO users (unique_id, fname, lname, email, password, image, status)
                            VALUES (:unique_id, :fname, :lname, :email, :password, :image, :status)");
                            $sql2 -> bindParam(":unique_id", $random_id);
                            $sql2 -> bindParam(":fname", $fname);
                            $sql2 -> bindParam(":lname", $lname);
                            $sql2 -> bindParam(":email", $email);
                            $sql2 -> bindParam(":password", $password);
                            $sql2 -> bindParam(":image", $new_img_name);
                            $sql2 -> bindParam(":status", $status);
                            $sql2 -> execute();
                            if ($sql2) { //if data is inserted
                                $sql3 = $pdo -> prepare("SELECT * FROM users WHERE email = :email");
                                if ($sql3->rowCount() > 0) {
                                    $row = $sql3 -> fetch(PDO::FETCH_ASSOC);
                                    $_SESSION['unique_id'] = $row['unique_id']; //using session to get unique id in php file
                                    echo "success";
                                }
                            }else {
                                echo "Something else went wrong";
                            }
                        }
                    }else{
                        echo "please enter a valid image - jpg, jpeg, png";
                    }

                }else{
                    echo "Please select an image file";
                }
            }
        }else{
            echo "$email is not a valid email address";
        }
    }else{
        echo "All input fields are required";
    }

?>