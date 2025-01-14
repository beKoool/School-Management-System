<?php
session_start();
include('./connection.php');

$delrollno = $_GET["rollno"];
$sql = "DELETE FROM school where rollno=$delrollno";

if ($conn->query($sql) === TRUE) {
    $_SESSION['message'] = "Deleted successfully";
    header("Location: ./home.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
