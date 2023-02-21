<?php
include '../functions.php';
include('dbconn.php');
?>
<script>
    function myFunction() {
        var x;
        var r = confirm("Press OK or Cancel button");
        if (r == true) {
         x = "You pressed OK!";
     }
        else {
         x = "You pressed Cancel!";
     }
     document.getElementById("demo").innerHTML = x;
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
    <div class="ScrumDashboardLayout">
    <button onclick="AddScrumgroepPopup()">Scrumgroep toevoegen</button>
        <?php
        if (isset($productID)) {
            DeleteScrumgroep($conn);
        }
            ScrumgroepenTonen($conn)
        ?>
    </div>
</body>
</html>