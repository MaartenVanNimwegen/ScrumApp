<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href= "Styles/Style.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
	<title>Account Toevoegen</title>
</head>
<body>
	<div class="content">
		<div class="container w-25">
				<label for="naam">Gebruiker Toevoegen</label>
				<form method="post" action="#">
				  
					<input type="txt" id="naam" name="naam" class="nieuwe_user" placeholder="Naam" minlength="3" maxlength="15" required>
		
					<input type="txt" name="e-mail"class="nieuwe_user" placeholder="e-mail" required>
					<select name="role">
						   <option value="0">Student</option>
							<option value="1">Docent</option>
					</select>
		
		
					<input name="submit" type="submit" value="Account aanmaken">
				</form>
			</div>	        
    </div>
</body>
</html>
<?php
include('sidebar.php');
include "config/dbconn.php";
include "Handlers/functions.php";
accountToevoegen($conn);
 ?>
 