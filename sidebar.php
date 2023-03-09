<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/42b6daea05.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="Styles/Style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <style>
    /* Sidebar */
    .sidebar {
        height: 100%;
        /* full-height sidebar */
        width: 200px;
        /* fixed width sidebar */
        position: fixed;
        /* fixed position sidebar */
        display: block;
        z-index: 1;
        /* ensure sidebar is above other elements */
        top: 0;
        /* top position of sidebar */
        left: 0;
        /* left position of sidebar */
        background-color: #333;
        /* background color of sidebar */
        overflow-x: hidden;
        /* hide horizontal scrollbar */
        padding-top: 60px;
        /* add top padding to allow space for logo/header */
    }

    /* Sidebar links */
    .sidebar a {
        padding: 10px;
        /* add padding to links */
        text-decoration: none;
        /* remove underline from links */
        font-size: 18px;
        /* set font size for links */
        color: #fff;
        /* set font color for links */
        display: block;
        /* display links as block elements */
    }

    /* Add hover effect to links */
    .sidebar a:hover {
        background-color: #555;
        /* set background color on hover */
    }

    /* Add active class to current link */
    .sidebar a.active {
        background-color: #4CAF50;
        /* set background color for active link */
        color: white;
        /* set font color for active link */
    }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="index.php"><i class="fa fa-home"></i> Home</a>
        <?php
        session_start();
        // check user role
        $user_role = $_SESSION['role']; // set default value for testing
        // replace this with code to get the user's role from your database or session
    
        // create sidebar menu based on user role
        if ($user_role == 0) {
          ?>
        <a href="Standupinvulscherm.php"><i class="fa-sharp fa-solid fa-pencil"></i> Standup</a>
        <a href="retroinvulscherm.php"><i class="fa-solid fa-file-pen"></i> Retro/review</a>
        <a href="Taken-dashboard.php"><i class="fa-solid fa-clipboard"></i> Taken</a>
        <?php
        } else if ($user_role == 1) {
          ?>
        <a href="Account-dashboard.php"><i class="fa fa-users"></i> Accounts</a>
        <a href="scrumDashboard.php"><i class="fa fa-users-rectangle"></i> Groepen</a>
        <?php
        }
        ?>
        <a href="Documenten.php"><i class="fa fa-file"></i> Documenten</a>
        <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
    </div>
</body>

</html>