<div class="sidebar">
    <div class="logo_content">
        <div class="logo">
            <img src="./img/logo.png" alt="Logo">
            <div class="logo_name">MKC <br>
                <div class="logo_info">Institute Of Technology</div>
            </div>
        </div>
    </div>
    <ul>
        <li><a href="add.php">Add</a></li>
    </ul>
    <div class="profile_content">
        <div class="profile_details">
            <img src="./img/pfp.jpg" alt="Profile">
            <div class="name"><?php echo $_SESSION['username'] ?></div>
            <ul>
                <li class="open_search"><a href="logout.php">Log Out</a></li>
            </ul>
        </div>
    </div>

    </ul>
</div>