<?php
include '../page/dbconn.php';
include '../page/functions.php';
$ScrumgroupId = $_GET['ScrumgroupId'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['AddScrumgroupUser'] == !null) {
    addUserToScrumgroup($conn, $_POST['AddScrumgroupUser'], $ScrumgroupId);
    header("location: ../page/scrumDashboard.php");
}
else
{
    echo"Er is iets mis gegaan.";
}