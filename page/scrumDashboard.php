<?php
include '../functions.php';
include('../dbconn.php');
?>
<script>
    function AddScrumgroepPopup() {
        var popup = document.getElementById("myPopup");
        popup.classList.toggle("show");
    }

    function CloseAddScrumgroepPopup() {
        var popup = document.getElementById("myPopup");
        popup.classList.toggle("show");
    }
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/Style.css">
    <title>Document</title>
</head>
<body>
<div class="popup" onclick="AddScrumgroepPopup()">Scrumgroep toevoegen</div>

<div class="container" id="myPopup">
    <div class="popuptext">Scrumgroep</div>
    <div class="" onclick="AddScrumgroepPopup()">Close</div>
</div>

    <div class="ScrumDashboardLayout">
        <?php
        if (isset($productID)) {
            DeleteScrumgroep($conn);
        }
            ScrumgroepenTonen($conn)
        ?>
    </div>
</body>
</html>