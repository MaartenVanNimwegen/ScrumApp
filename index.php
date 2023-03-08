<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/Style.css">
    <title>Dashboard</title>
</head>
<body>
    <div class="content">
        <?php
        include('sidebar.php');
        if(empty($_SESSION['id'])) {
            header("Location: login.php");
        }
        echo 'session: ';
        print_r($_SESSION);

        ?>
        <a href="retroinvulscherm.php">retro</a>
    </div>
</body>
</html>