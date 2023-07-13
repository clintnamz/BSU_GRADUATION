<?php
session_start();
if(!isset($_SESSION['admin_username'])){
    header("location:login_admin.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=1.0, initial-scale=1.0"/>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="icon" href="images/icon.ico">
    <title>BSU Student Clearance Portal | Welcome</title>
    <style>
        /* CSS styles here */
    </style>
</head>
<body>
<header id="main-header">
    <div class="container">
        <h1 style="font-size: 40px; color: orange">BSU Student Clearance Portal</h1>
        <h1 style="color: white">Welcome <?php echo $_SESSION['admin_username'] ?></h1>
    </div>
</header>

<nav id="navbar">
    <div class="container">
        <ul>
            <li><a href="view_clearance_status.php"><img src="images/icons/icons8_Ok_48px.png">Clearance Info</a></li>
            <li><a href="managedesignee.php"><img src="images/icons/icons8_Staff_48px.png">View Staff</a></li>
            <li><a href="add_admin.php"><img src="images/icons/icons8_Admin_48px.png">PW Supervisors</a></li>
            <li><a href="add_user.php"><img src="images/icons/icons8_Add_User_Male_48px.png">Add User</a></li>
            <li><a href="admin_change_password.php"><img src="images/icons/icons8_Password_48px.png">Change Password</a></li>
            <li><a href="admin_logout.php"><img src="images/icons/icons8_Sign_Out_48px.png">Logout</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <!-- Additional content here -->
</div>

<script src="js/bootstrap.min.js"></script>
</body>
</html>
