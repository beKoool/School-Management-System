<?php

$host = "localhost";
$username = "root";
$pass = "";
$db = "comp_proj";

$conn = new mysqli($host, $username, $pass, $db);

if ($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
}
