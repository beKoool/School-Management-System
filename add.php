<?php
session_start();
include('./connection.php');

if (!isset($_SESSION['username'])) {
    $_SESSION['message'] = 'You are logged out';
    header("location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add a data 📃</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include('./sidebar.php') ?>

    <div class="main_content add">

        <div class="form_container">
            <button class="close" id="close_btn">Close</button>
            <h2 class="form_title">Add New Data</h2>
            <form method="POST" id="add_form">
                <div class="form_group">
                    <label for="fname">First Name:</label>
                    <input type="text" name="fname" id="fname" placeholder="Enter first name">
                </div>

                <div class="form_group">
                    <label for="lname">Last Name:</label>
                    <input type="text" name="lname" id="lname" placeholder="Enter last name">
                </div>

                <div class="form_group">
                    <label>Gender:</label>
                    <div class="gender_options">
                        <label for="male">
                            <input type="radio" name="gender" id="male" value="M"> Male
                        </label>
                        <label for="female">
                            <input type="radio" name="gender" id="female" value="F"> Female
                        </label>
                        <label for="other">
                            <input type="radio" name="gender" id="other" value="O"> Other
                        </label>
                    </div>
                </div>

                <div class="form_group">
                    <label for="dob">Date of Birth:</label>
                    <input type="date" name="dob" id="dob">
                </div>

                <div class="form_group">
                    <label for="address">Address:</label>
                    <input type="text" name="address" id="address" placeholder="Enter address">
                </div>

                <div class="form_group">
                    <label for="grade">Grade:</label>
                    <select name="grade" id="grade">
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                </div>

                <div class="form_group">
                    <label for="course">Course:</label>
                    <select name="course" id="course">
                        <option value="Science">Science</option>
                        <option value="Law">Law</option>
                        <option value="Management">Management</option>
                    </select>
                </div>

                <div class="form_group">
                    <input type="submit" value="Submit" name="submit" class="btn_submit">
                </div>
            </form>

            <?php

            if (isset($_POST['submit'])) {

                $fname = $_POST["fname"];
                $lname = $_POST["lname"];
                $gender = $_POST["gender"];
                $dob = $_POST["dob"];
                $address = $_POST["address"];
                $grade = $_POST["grade"];
                $course = $_POST["course"];

                if ($fname == "" || $lname == "" || $gender == "" || $dob == "" || $address == "" || $grade == "" || $course == "") {
                    echo '<script>alert("All the fields must be filled.")</script>';
                } else {
                    $sql = "INSERT INTO school (first_name,last_name,gender,dob,address,grade,course) VALUES ('$fname','$lname','$gender','$dob','$address','$grade','$course')";

                    if ($conn->query($sql) === TRUE) {
                        header("Location: ./home.php");
                    } else {
                        header("Location: ./home.php");
                    }

                    $conn->close();
                }
            }
            ?>
        </div>
    </div>


    <script>
        const closeButton = document.getElementById('close_btn');
        closeButton.addEventListener('click', () => {
            window.location.href = 'home.php'; // Redirect to home.php
        });
    </script>
</body>

</html>