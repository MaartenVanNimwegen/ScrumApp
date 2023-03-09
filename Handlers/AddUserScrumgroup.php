<?php
include '../config/dbconn.php';
include 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ScrumgroupId = $_GET['ScrumgroupId'];
    $stmt = $conn->prepare("SELECT id FROM users WHERE naam = ?");
    $stmt->bind_param('s', $ScrumgroupId);
    $stmt->execute();
    $sql = $stmt->get_result();
    $sql = $sql->fetch_all();
    $stmt->close();
    if ($sql == !null) {
        addUserToScrumgroup($conn, $_POST['AddScrumgroupUser'], $ScrumgroupId);
        header("location: ../scrumDashboard.php");
    } else {
        echo "U heeft geen geldige leerling toegevoegd.";
    }
} else {
    echo "Er is iets mis gegaan.";
}
