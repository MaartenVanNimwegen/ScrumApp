<?php
include '../config/dbconn.php';
include '../page/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $StartDate = strtotime($_POST["StartDate"]);
  $StartDate = date('Y-m-d H:i:s', $StartDate);
  $EndDate = strtotime($_POST["EndDate"]);
  $EndDate = date('Y-m-d H:i:s', $EndDate);

    AddScrumgroup($conn, $_POST['Scrumnaam'], $_POST['ScrumProject'], $StartDate, $EndDate);
    header("location: ../page/scrumDashboard.php");

}
else
{
    echo"Er is iets mis gegaan.";
}