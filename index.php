<?php
session_start();
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
    <div class="login_page">

        <img src="./img/full-logo.png" alt="Logo" class="top_img">

        <div class="form_container">
            <h2 class="form_title">Login</h2>
            <form method="POST" action="./login.php" id="login_form">
                <!-- Error Message -->
                <p class="error" <?php if (isset($_SESSION['message'])) echo 'style="display:block;"'; ?>>
                    <?php if (isset($_SESSION['message'])) {

                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                    } ?>
                    </>

                    <!-- Username -->
                <div class="form_group">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" placeholder="Enter username">
                </div>

                <!-- Password -->
                <div class="form_group">
                    <label for="pass">Password:</label>
                    <input type="password" name="pass" id="pass" placeholder="Enter password">
                </div>

                <!-- Submit Button -->
                <div class="form_group">
                    <input type="submit" value="Login" name="submit" class="btn_submit">
                </div>
            </form>
        </div>

        <img src="./img/system.png" alt="Logo" class="bottom_img">
    </div>

</body>

</html>