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

            <input type="txt" name="e-mail"class="nieuwe_user" placeholder="e-mail" minlength="4" maxlength="15"  required>
			<select name="role">
				<option value="">Kies een role</option>
   				<option value="0">Student</option>
  			  	<option value="1">Docent</option>
			</select>


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
  $guid = uniqid();
  strval($email);
  strval($guid);
  strval($naam);
  $role = $_POST['role'];
  //prepare en bind
  $insertSQL = "INSERT INTO users (`naam`, `e-mail`, `role`, `activationCode`) VALUES (?, ?, ?, ?)";
  $stmt = $conn->prepare($insertSQL);
$stmt->bind_param("ssis", $naam , $email, $role, $guid);
  $stmt->execute();
}
