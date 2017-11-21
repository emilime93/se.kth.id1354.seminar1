<?php

    session_start();
    require 'keys.php';

    /*if (isset($_SESSION['logged-in-user']) && $_POST['username'] == $_SESSION['logged-in-user']) {
        header("Location: calendar.php");
        exit();
    }*/

    if ($_POST['username'] == "" || $_POST['password']=="") {
        $_SESSION['missing-field'] = 1;
        header("Location: login.php");
        exit();
    }

    $login_username = $_POST['username'];
    $login_password = $_POST['password'];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check that connection is valid and works.
    if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
    }

    // Creates the
    $table = "`user`";
    $where_condition = "WHERE `username`='$login_username' AND `password`='$login_password'";

    // Build query and get the reults.
    $sql = "SELECT `username` FROM $table $where_condition";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
       // output data of each row
       $row = $result->fetch_assoc();
       $_SESSION['logged-in-user'] = $row['username'];
       $conn->close();
       $url = $_SESSION['current-page'];
       header("Location: $url");
       exit();
   } elseif($result->num_rows > 1) {
       echo 'Too many results. Error <br>';
   } else {
       $_SESSION['incorrect-login'] = 1;
       $conn->close();
       header("Location: login.php");
       exit();
    }
    $conn->close();
 ?>
