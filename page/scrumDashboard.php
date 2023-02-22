<?php
include '../functions.php';
include('../dbconn.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    $scrumgroupQuery = getScrumgroups($conn);
    createScrumgroupObject($scrumgroupQuery, $conn);
?>
</body>
</html>




<!-- <script>
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
 <div class="ScrumgroepWijzigPopup">
<form action="../Handlers/ScrumgroepToevoeg.php" method="post" enctype="multipart/form-data">
            <div><input type="text" name="Scrumnaam" class="WijzigScrumgroepNaam" placeholder="ScrumgroepNaam" required> </div>
            <div><input type="text" name="ScrumProject" class="WijzigScrumgroepProject" placeholder="Project" required> </div>
            <div><input type="text" name="ScrumgroepLeden" class="WijzigScrumgroepLeden" placeholder="" min="0" max="100" required> </div>
            <div><select class="WijzigScrumgroepScrummaster" name="ScrumgroepScrummaster" id="Scrummaster" required>
            <?php
               // SelectScrummaster($conn);
            ?>
            </select></div>
            <div><input type="submit" name="submit" class="WijzigScrumgroepSubmit"></div>
            <div class="WijzigScrumgroepClose" onclick="AddScrumgroepPopup()">Close</div>
        </div>
    </div>
</form>
</div>
</div>
    <div class="ScrumDashboardLayout">
        <?php
        // if (isset($productID)) {
        //     DeleteScrumgroep($conn);
        // }
        //     ScrumgroepenTonen($conn)
        ?>
    </div>
</body>
</html> -->