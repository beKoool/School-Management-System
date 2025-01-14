<?php
session_start();
include('./connection.php');
$searchCondition = "";


if (!isset($_SESSION['username'])) {
    header("location: index.php");
    $_SESSION['message'] = 'You are logged out';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['search']) && isset($_POST['search_from'])) {
        $searchTerm = trim($_POST['search']);
        $searchIn = $_POST['search_from'];

        $searchTerm = $conn->real_escape_string($searchTerm);
        $searchIn = $conn->real_escape_string($searchIn);

        if (!empty($searchTerm) && !empty($searchIn)) {
            $searchCondition = "WHERE $searchIn LIKE '%$searchTerm%'";
        }
    }

    if (isset($_POST['filter']) && isset($_POST['course'])) {
        $filterFrom = $_POST['course'];
        // echo "$filterFrom";
        // $filterFrom = $conn->real_escape_string($searchIn);

        if (!empty($filterFrom)) {
            $searchCondition = "WHERE course='$filterFrom'";
        }
    }
    if (isset($_POST['reset'])) {
        $searchCondition = "";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include('./sidebar.php') ?>
    <div class="main_content">

        <h1>Welcome <span class="highlight"><?php echo $_SESSION['username']; ?></span></h1>
        <h3>Total students: <?php

                            include('connection.php');

                            $sql = "SELECT * FROM school";
                            if ($res = $conn->query($sql)) {
                                echo $res->num_rows;
                            }

                            ?></h3>

        <?php

        $sql = "SELECT * FROM school $searchCondition";
        if ($result = mysqli_query($conn, $sql)) {
            if (mysqli_num_rows($result) > 0) {
                echo "<table border=2 cellpadding=5>";
                echo "<tr>";
                echo "<th>Roll No.</th>";
                echo "<th>First Name</th>";
                echo "<th>Last Name</th>";
                echo "<th>Gender</th>";
                echo "<th>DOB</th>";
                echo "<th>Address</th>";
                echo "<th>Grade</th>";
                echo "<th>Course</th>";
                echo "<th colspan=2>Actions</th>";
                echo "</tr>";

                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['rollno'] . "</td>";
                    echo "<td>" . $row['first_name'] . "</td>";
                    echo "<td>" . $row['last_name'] . "</td>";
                    echo "<td>" . $row['gender'] . "</td>";
                    echo "<td>" . $row['dob'] . "</td>";
                    echo "<td>" . $row['address'] . "</td>";
                    echo "<td>" . $row['grade'] . "</td>";
                    echo "<td>" . $row['course'] . "</td>";
                    echo "<td> <a href=delete.php?rollno=" . $row['rollno'] . '> <?xml version="1.0"?><svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 30 30" width="24px" height="24px">    <path d="M 14.984375 2.4863281 A 1.0001 1.0001 0 0 0 14 3.5 L 14 4 L 8.5 4 A 1.0001 1.0001 0 0 0 7.4863281 5 L 6 5 A 1.0001 1.0001 0 1 0 6 7 L 24 7 A 1.0001 1.0001 0 1 0 24 5 L 22.513672 5 A 1.0001 1.0001 0 0 0 21.5 4 L 16 4 L 16 3.5 A 1.0001 1.0001 0 0 0 14.984375 2.4863281 z M 6 9 L 7.7929688 24.234375 C 7.9109687 25.241375 8.7633438 26 9.7773438 26 L 20.222656 26 C 21.236656 26 22.088031 25.241375 22.207031 24.234375 L 24 9 L 6 9 z"/></svg></a> </td>';
                    echo "<td> <a href=./edit.php?rollno=" . $row['rollno'] . '><?xml version="1.0"?><svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" width="24px" height="24px">    <path d="M 19.171875 2 C 18.448125 2 17.724375 2.275625 17.171875 2.828125 L 16 4 L 20 8 L 21.171875 6.828125 C 22.275875 5.724125 22.275875 3.933125 21.171875 2.828125 C 20.619375 2.275625 19.895625 2 19.171875 2 z M 14.5 5.5 L 3 17 L 3 21 L 7 21 L 18.5 9.5 L 14.5 5.5 z"/></svg></a> </td>';
                    echo "</tr>";
                }
                echo "</table>";
                mysqli_free_result($result);
            } else {
                echo "<br>No records found";
            }
        } else {
            echo "ERROR: $sql." . mysqli_error($conn);
        }
        mysqli_close($conn);

        ?>

        <div class="right_sidebar">

            <div class="search_menu">
                <h3>Search Students:</h3>
                <form action="home.php" method="post">
                    <input type="text" name="search" placeholder="Search...">

                    <select name="search_from" id="search_from">
                        <option value="rollno">Roll Number</option>
                        <option value="first_name">First Name</option>
                    </select>
                    <input type="submit" name="submit" value="Search">
                </form>
                <br>

                <h3>Filter Students:</h3>
                <form action="home.php" method="post" id="filter">
                    <label for="course">By Course:</label>
                    <br>
                    <input type="radio" name="course" id="science" value="science">
                    <label for="science">Science</label><br>
                    <input type="radio" name="course" id="management" value="management">
                    <label for="management">Management</label><br>
                    <input type="radio" name="course" id="law" value="law">
                    <label for="law">Law</label><br><br>
                    <input type="submit" name="filter" value="Filter">
                </form>
                <br>

                <form action="home.php" method="post" id="reset">
                    <input type="submit" name="reset" value="RESET">
                </form>
            </div>
        </div>


        <!-- <div class="search_menu">
            <h3>Search Students:</h3>
            <form action="home.php" method="post">
                <input type="text" name="search" placeholder="Search...">
                <br><br>
                <select name="search_from" id="search_from">
                    <option value="rollno">Roll Number</option>
                    <option value="first_name">First Name</option>
                </select><br><br>
                <input type="submit" name="submit" value="Search">
            </form>
            <br>
            <hr><br>

            <h3>Filter Students:</h3>
            <form action="home.php" method="post">
                <label for="course">Course:</label>
                <br>
                <input type="radio" name="course" id="science" value="science">
                <label for="science">Science</label><br>
                <input type="radio" name="course" id="management" value="management">
                <label for="management">Management</label><br>
                <input type="radio" name="course" id="law" value="law">
                <label for="law">Law</label><br><br>
                <input type="submit" name="filter" value="Filter">
            </form>
            <br>
            <hr><br>

            <form action="home.php" method="post">
                <input type="submit" name="reset" value="RESET">
            </form>
        </div> -->

    </div>
    <br>
</body>

</html>