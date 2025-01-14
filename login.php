<?php
session_start();
include("./connection.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["pass"];

    echo $username = $conn->real_escape_string($username);
    echo $password = $conn->real_escape_string($password);

    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";

    $res = $conn->query($sql);

    if (empty($username)) {
        // header("Location: ./index.php?error=100");
        header("Location: ./index.php");
        $_SESSION['message'] = 'Username is required';
    } elseif (empty($password)) {
        // header("Location: ./index.php?error=101");
        $_SESSION['message'] = 'Password is required';
        header("Location: ./index.php");
    } elseif ($row = $res->num_rows == 1) {
        $_SESSION['username'] = $username;
        header("Location: ./home.php");
        exit();
    } else {
        $_SESSION['message'] = 'Incorrect username or password';
        header("Location: ./index.php");
    }
} else {
    header("Location: ./index.php");
    die();
}
