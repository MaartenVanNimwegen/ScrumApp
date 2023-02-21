<?php

include('Classes/user.php');
include('dbconn.php');

$activationCode = $_GET["activationCode"];
$password = $_GET["password"];
$userclass = new user();
$user = $userclass->GetUserByActivationCode($activationCode, $conn);
print_r($user);

$result = $userclass->ActivateAccount($user, $activationCode, $password, $conn);