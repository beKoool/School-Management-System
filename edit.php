<?php
session_start();
include('./connection.php');

if (!isset($_SESSION['username'])) {
    header("location: index.php");
    $_SESSION['message'] = 'You are logged out';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit a data 📃</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include('./sidebar.php') ?>
    <div class="main_content add">
        <?php

        $rollno = $_GET["rollno"];
        $sql = "SELECT * FROM school WHERE rollno=$rollno";
        $res = $conn->query($sql);
        if ($res->num_rows) {
            $row = $res->fetch_assoc();
            $old_fname = $row["first_name"];
            $old_lname = $row["last_name"];
            $old_gender = $row["gender"];
            $old_dob = $row["dob"];
            $old_address = $row["address"];
            $old_grade = $row["grade"];
            $old_course = $row["course"];
        }

        if (isset($_POST['submit'])) {
            $fname = $_POST["new_fname"];
            $lname = $_POST["new_lname"];
            $gender = $_POST["new_gender"];
            $dob = $_POST["new_dob"];
            $address = $_POST["new_address"];
            $grade = $_POST["new_grade"];
            $course = $_POST["new_course"];

            if ($fname == "" || $lname == "" || $gender == "" || $dob == "" || $address == "" || $grade == "" || $course == "") {
                echo "All the fields must be filled.";
            } else {
                $sql = "UPDATE school SET first_name='" . $fname . "',last_name='" . $lname . "', gender='" . $gender . "', dob='" . $dob . "', address='" . $address . "', grade='" . $grade . "',course='" . $course . "' WHERE rollno=" . $rollno;

                if ($conn->query($sql) === TRUE) {
                    header("Location: ./home.php");
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

                $conn->close();
            }
        }
        // }
        ?>

        <div class="form_container">
            <button class="close" id="close_btn">Close</button>
            <h2 class="form_title">Edit Data of Roll Number: <?php echo $row['rollno'] ?></h2>
            <form method="POST" id="add_form">
                <div class="form_group">
                    <label for="fname">First Name:</label>
                    <input type="text" name="new_fname" id="fname" placeholder="Enter first name">
                </div>

                <div class="form_group">
                    <label for="lname">Last Name:</label>
                    <input type="text" name="new_lname" id="lname" placeholder="Enter last name">
                </div>

                <div class="form_group">
                    <label>Gender:</label>
                    <div class="gender_options">
                        <label for="male">
                            <input type="radio" name="new_gender" id="male" value="M" <?php if ($old_gender == "M") echo "checked"; ?>>
                            Male
                        </label>
                        <label for="female">
                            <input type="radio" name="new_gender" id="female" value="F" <?php if ($old_gender == "F") echo "checked"; ?>>
                            Female
                        </label>
                        <label for="other">
                            <input type="radio" name="new_gender" id="other" value="O" <?php if ($old_gender == "O") echo "checked"; ?>>
                            Other
                        </label>
                    </div>
                </div>

                <div class="form_group">
                    <label for="dob">Date of Birth:</label>
                    <input type="date" name="new_dob" id="dob">
                </div>

                <div class="form_group">
                    <label for="address">Address:</label>
                    <input type="text" name="new_address" id="address" placeholder="Enter address">
                </div>

                <div class="form_group">
                    <label for="grade">Grade:</label>
                    <select name="new_grade" id="grade">
                        <option value="11" <?php if ($old_grade == "11") echo "selected"; ?>>11</option>
                        <option value="12" <?php if ($old_grade == "12") echo "selected"; ?>>12</option>
                    </select>
                </div>

                <div class="form_group">
                    <label for="course">Course:</label>
                    <select name="new_course" id="course">
                        <option value="Science" <?php if ($old_course == "science") echo "selected"; ?>>Science</option>
                        <option value="Management" <?php if ($old_course == "management") echo "selected"; ?>>Management</option>
                        <option value="Law" <?php if ($old_course == "law") echo "selected"; ?>>Law</option>
                    </select>
                </div>

                <div class="form_group">
                    <input type="submit" value="Submit" name="submit" class="btn_submit">
                </div>
            </form>
        </div>

    </div>
    </div>


    <script>
        document.getElementById("fname").value = "<?php echo $old_fname ?>";
        document.getElementById("lname").value = "<?php echo $old_lname ?>";
        document.getElementById("dob").value = "<?php echo $old_dob ?>";
        document.getElementById("address").value = "<?php echo $old_address ?>";
        document.getElementById("grade").value = "<?php echo $old_grade ?>";
        document.getElementById("course").value = "<?php echo $old_course ?>";

        const closeButton = document.getElementById('close_btn');
        closeButton.addEventListener('click', () => {
            window.location.href = 'home.php'; // Redirect to home.php
        });
    </script>

</body>

</html>