<?php
session_start();
require('../Classes/user.php');
require('../Handlers/Services.php');
require('dbconn.php');
$userService = new userServices($conn);

$userId = $_SESSION['id'];
$groepId = $userService->GetGroupId($userId);
$scrummasterId = $userService->GetScrummasterId($groepId);

if($_SESSION['id'] != $scrummasterId) {
	header("Location: ../index.php");
}

if (isset($_POST['submit'])) {

	$names = $userService->GetAllNames($_SESSION['id']);
	$removedOwnName = $userService->RemoveOwnName($_SESSION['naam'], $names);
	
	$backlogitems = $_POST['backlogitems'];
	$demonstreren = $_POST['demonstreren'];
	$samenwerking = $_POST['samenwerking'];
	$todoitems = $_POST['todoitems'];
	
	$userService->SaveReview($userId, $groepId, $scrummasterId, null, $backlogitems, $demonstreren, $samenwerking, $todoitems);
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
    <title>Review invullen</title>
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
						<label for="backlogitems">Aan welke backlogitems hebben jullie de afgelopen week gewerkt?</label><br>
						<textarea id="backlogitems" name="backlogitems" required></textarea>
					</div>
				</div>
				<div class="carousel-item">
					<div class="overlay"></div>
					<div class="carousel-caption">
						<label for="demonstreren">Wat gaan jullie demonstreren?</label><br>
						<textarea id="demonstreren" name="demonstreren" required></textarea>
					</div>
				</div>
				<div class="carousel-item">
					<div class="overlay"></div>
					<div class="carousel-caption">
						<label for="samenwerking">Hoe is de samenwerking verlopen?</label><br>
						<textarea id="samenwerking" name="samenwerking" required></textarea>
					</div>
				</div>
				<div class="carousel-item">
					<div class="overlay"></div>
					<div class="carousel-caption">
						<label for="todoitems">Aan welke items gaan jullie de komende sptint werken?</label><br>
						<textarea id="todoitems" name="todoitems" required></textarea>
						<input class='submit w-25' type='submit' name='submit' id='submit'>
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