<?php

$servername="localhost";
$username="root";
$password="";
$db="scrumapp";

$conn = mysqli_connect($servername, $username, $password, $db);

if(!$conn){
    echo "Connection Failed";
}

?>
