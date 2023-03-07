<?php
include('../sidebar.php');

session_start();
if(empty($_SESSION['id'])) {
    header("Location: page/login.php");
}
echo "ID:  " . $_SESSION['id'] . "<br>Naam:  " . $_SESSION['naam']  . "<br>Email:  " . $_SESSION['email'];
?>
<a href="Account-persoonlijk.php">accountje</a>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>