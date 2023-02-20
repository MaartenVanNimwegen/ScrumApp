<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
<div class="gegevens_container">
        <h3 class="gebruiker_tekst">Gebruiker Toevoegen</h3>
        <form method="post" action="#">
          
            <input type="txt" name="naam" class="nieuwe_user" placeholder="Naam" minlength="3" maxlength="15" required>

            <input type="txt" name="e-mail"class="nieuwe_user" placeholder="e-mail"minlength="4" maxlength="15"  required>

            <input type="password" name="wachtwoord" class="nieuwe_user" placeholder="Wachtwoord" minlength="4" maxlength="15" required>

            <button type="submit" name="submit" class="voeg_toe">Voeg Toe</button>
        </form>

    </div>	
</body>
</html>
<?php
include "dbconn.php";
//als je op de voeg toe knop klikt
if(isset($_POST['submit'])) {
  $naam = $_POST['naam'];
  $email = $_POST['e-mail'];
  $wachtwoord = $_POST['wachtwoord'];
  
  //prepare en bind
  $insertSQL = "INSERT INTO users (`naam`, `e-mail`, `wachtwoord`) VALUES (?, ?, ?)";
  $stmt = $conn->prepare($insertSQL);
  $stmt->bind_param("sss", $naam, $email, $wachtwoord,);
  $stmt->execute();
}
