<?php
include '../config/dbconn.php';
include 'functions.php';
$ScrumgroupId = $_GET['ScrumgroupId'];
$stmt = $conn->prepare("SELECT id FROM users WHERE naam = ?");
$stmt->bind_param('s', $ScrumgroupId);
    $stmt->execute();
    $sql = $stmt->get_result();
    $sql = $sql->fetch_all();
    $stmt->close();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $sql == !null) {
    addUserToScrumgroup($conn, $_POST['AddScrumgroupUser'], $ScrumgroupId);
    header("location: ../scrumDashboard.php");
}
else
{
    echo"Er is iets mis gegaan.";
}