<?php
require('../Classes/user.php');
require('../Classes/Services.php');
require('dbconn.php');

if (isset($_GET["activationCode"])) {
    $activationCode = $_GET["activationCode"];
    $userService = new userServices($conn);
    $isActivated = $userService->IsActivated($activationCode, $conn);
    if ($isActivated) {
        header("Location: ../login.php");
        exit;
    }
    if (isset($_POST['password']) && isset($_POST['herhaalPassword'])) {
        $password = $_POST['password'];
        $herhaalPassword = $_POST['herhaalPassword'];

        if ($password == $herhaalPassword) {
            $defiPassword = $password;
            $user = $userService->GetUserByActivationCode($activationCode, $conn);
            $userService->ActivateAccount($user, $defiPassword, $conn);
            header("Location: ../login.php");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://kit.fontawesome.com/42b6daea05.js" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="../Styles/Style.css">
        <title>Activeer je account</title>
    </head>
    <body>
        <div class="container">
            <form action="" method="post">
            <label for="password">Wachtwoord</label>
            <input type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
            <label for="herhaalPassword">Herhaal wachtwoord</label>
            <input type="password" id="herhaalPassword" name="herhaalPassword" required>
            <input type="submit" value="Submit">
            </form>
            <div id="message">
                <h3>Het wachtwoord moet aan de volgende eisen voldoen:</h3>
                <p id="letter" class="invalid">Een <b>kleine</b> letter</p>
                <p id="capital" class="invalid">Een <b>hoofdletter</b> letter</p>
                <p id="number" class="invalid">Een <b>getal</b></p>
                <p id="length" class="invalid">Minimaal <b>8</b> karakters</p>
            </div>
        </div>

                    
        <script>
        var myInput = document.getElementById("password");
        var letter = document.getElementById("letter");
        var capital = document.getElementById("capital");
        var number = document.getElementById("number");
        var length = document.getElementById("length");

        myInput.onfocus = function() {
        document.getElementById("message").style.display = "block";
        }

        myInput.onblur = function() {
        document.getElementById("message").style.display = "none";
        }

        myInput.onkeyup = function() {
        var lowerCaseLetters = /[a-z]/g;
        if(myInput.value.match(lowerCaseLetters)) {  
            letter.classList.remove("invalid");
            letter.classList.add("valid");
        } else {
            letter.classList.remove("valid");
            letter.classList.add("invalid");
        }
        
        var upperCaseLetters = /[A-Z]/g;
        if(myInput.value.match(upperCaseLetters)) {  
            capital.classList.remove("invalid");
            capital.classList.add("valid");
        } else {
            capital.classList.remove("valid");
            capital.classList.add("invalid");
        }

        var numbers = /[0-9]/g;
        if(myInput.value.match(numbers)) {  
            number.classList.remove("invalid");
            number.classList.add("valid");
        } else {
            number.classList.remove("valid");
            number.classList.add("invalid");
        }
        
        if(myInput.value.length >= 8) {
            length.classList.remove("invalid");
            length.classList.add("valid");
        } else {
            length.classList.remove("valid");
            length.classList.add("invalid");
        }
        }
        </script>
    </body>
</html>