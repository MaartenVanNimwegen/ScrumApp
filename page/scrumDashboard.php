<?php
include 'functions.php';
include('dbconn.php');
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

<div class="containerScrumDashboard" id="myPopup">
<div class="ScrumgroepWijzigPopup">
<form action="../Handlers/ScrumgroepToevoeg.php" method="post" enctype="multipart/form-data">
            <div><input type="text" name="Scrumnaam" class="AddScrumgroupName" placeholder="Scrumgroepnaam" required> </div>
            <div><input type="text" name="ScrumProject" class="AddScrumgroupProject" placeholder="Project" required> </div>
            <div id=ScrumgrooupAddUsers>
                <div class="SearchWrapper">
                    <div class="search-input">
                        <a href="" target="_blank" hidden></a>
                        <!-- <input type="text" placeholder="Type to search.."> -->
                        <input type="text" name="ScrumgroepUsers[]" class="AddScrumgroupUsers" placeholder="Leerlingnaam" required><br> 
                    <div class="autocom-box">
                    </div>
                  </div>
                </div>
            </div>
            <div class="controls">
      <a href="#" id="add_more_fields"><i class="fa fa-plus"></i>Voeg student toe</a>
      <a href="#" id="remove_fields"><i class="fa fa-plus"></i>Verwijder student</a>
       <script src="../Javascript/scrumDashboard.js"></script> 
       <script src="../Javascript/functions.js"></script> 
    </div>
            
            <div><input type="submit" name="submit" class="WijzigScrumgroepSubmit"></div>
            <div class="WijzigScrumgroepClose" onclick="AddScrumgroepPopup()">Close</div>
        </div>
    </div>
</form>
</div>
</div>
    <div class="ScrumDashboardLayout">
        <?php
        $scrumgroupQuery = getScrumgroups($conn);
        createScrumgroupObject($scrumgroupQuery, $conn);
        ?>
    </div>


  
</html>
