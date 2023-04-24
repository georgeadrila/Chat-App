<?php
  
  // $conn = mysqli_connect("localhost", "root", "", "chat");

  // connect to database using pdo
  $pdo = new PDO("mysql:host=localhost;dbname=chat", "root", "");
  $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  ?>