<?php
    session_start();
    $user = $_SESSION['logged-in-user'];
    $recipe = $_POST['recipe'];
    $comment = $_POST['comment'];

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
    // Build query and get the reults.
    $sql = "INSERT INTO `comment`(`id`, `user`, `comment`, `recipe`) VALUES (null,'$user','$comment','$recipe')";
    $conn->query($sql);

    //closes the connection
    $conn->close();

    header("Location: $recipe-recipe.php");
    exit();
?>
