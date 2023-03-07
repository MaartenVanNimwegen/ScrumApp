<?php
include('sidebar.php');
session_start();
if(empty($_SESSION['id'])) {
    header("Location: page/login.php");
}
echo 'session: ';
print_r($_SESSION);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <a href="page/retroinvulscherm.php">retro</a>
    <form action="logout.php" method="post">
        <button type="submit">Uitloggen</button>
        <a href="page/Account-persoonlijk.php">accountje</a>
    </form>
</body>
</html>