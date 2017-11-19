<?php
    session_start();
    $id = $_POST['comment-id'];

    $servername = "localhost";
    $username = "root";
    $password = "tidabmajs";
    $dbname = "tasty_recipes";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check that connection is valid and works.
    if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
    }

    $sql = "DELETE FROM `comment` WHERE `id`='$id'";
    $conn->query($sql);
    $conn->close();
    $url = $_SESSION['current-page'];
    header("Location: $url");
    exit();
?>
