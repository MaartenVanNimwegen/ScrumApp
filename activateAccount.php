<?php

include('user.php');
include('dbconn.php');

$activationCode = $_GET["activationCode"];
$userclass = new user();
$user = $userclass->GetUserByActivationCode($activationCode, $conn);
print_r($user);

