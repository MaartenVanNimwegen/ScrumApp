<?php
if (isset($_POST['submit'])) {
	session_start();
	require('../Classes/user.php');
	require('../Handlers/Services.php');
	require('dbconn.php');
    $userService = new userServices($conn);
	$userId = $_SESSION['id'];
	$groepId = $userService->GetGroupId($userId);
    $scrummasterId = $userService->GetScrummasterId($groepId);
	$names = $userService->GetAllNames($_SESSION['id']);
	$removedOwnName = $userService->RemoveOwnName($_SESSION['naam'], $names);
	$bijdrage = $_POST['bijdrage'];
	$meerwaarden = $_POST['meerwaarden'];
	$tegenaan = $_POST['tegenaan'];
	$tips = array();
	$tops = array();
	foreach($removedOwnName as $naam) {
		$tip = $_POST['tip'.$naam];
		$top = $_POST['top'.$naam];
		$tips[] = $tip;
		$tops[] = $top;
	}
	$userService->SaveRetro($userId, $groepId, $scrummasterId, null, $bijdrage, $meerwaarden, $tegenaan, $tips, $tops);
	header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/42b6daea05.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../Styles/Style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <title>Retro invullen</title>
</head>

<body>
	<form action="" method="post">
		<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
			</ol>
			<div class="carousel-inner">
				<div class="carousel-item active">
					<div class="overlay"></div>
					<div class="carousel-caption">
						<label for="bijdrage">Wat was mijn bijdrage de afgelopen week?</label><br>
						<textarea id="bijdrage" name="bijdrage" required></textarea>
					</div>
				</div>
				<div class="carousel-item">
					<div class="overlay"></div>
					<div class="carousel-caption">
						<label for="meerwaarden">Wat was jou meerwaarden?</label><br>
						<textarea id="meerwaarden" name="meerwaarden" required></textarea>
					</div>
				</div>
				<div class="carousel-item">
					<div class="overlay"></div>
					<div class="carousel-caption">
						<label for="tegenaan">Waar liep je tegenaan?</label><br>
						<textarea id="tegenaan" name="tegenaan" required></textarea>
					</div>
				</div>
				<div class="carousel-item">
					<div class="overlay"></div>
					<div class="carousel-caption parent">
						<?php 
						session_start();
						require('../Classes/user.php');
						require('../Handlers/Services.php');
						require('dbconn.php');
						$userService = new userServices($conn);
						$names = $userService->GetAllNames($_SESSION['id']);
						$removedOwnName = $userService->RemoveOwnName($_SESSION['naam'], $names);
						foreach($removedOwnName as $naam) {
							echo "<div class='p-2'>
								<label for='tips'>Tip voor $naam</label><br>
								<input name='tip$naam' type='text' required>
							</div>";
						}
						foreach($removedOwnName as $naam) {
							echo "<div class='p-2'>
								<label for='tops'>Top voor $naam</label><br>
								<input name='top$naam' type='text' required>
							</div>";
						}
						?>
						<input class='submit w-25' type='submit' name='submit' id='submit'>
					</div>
					</div>
				</div>
			</div>
			<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</form>
    
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
	<script>
		$('.carousel').carousel({
			interval: 99999999999,
			pause: true
		});
	</script>
</body>

</html>