<?php
session_start();

// Permission check
if ($_SESSION['role'] == 1) {
    header('Location: index.php');
}

// All requirements
require('Classes/user.php');
require('Handlers/Services.php');
require('config/dbconn.php');

// Service
$userService = new userServices($conn);
$groepService = new GroepServices($conn);
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/42b6daea05.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="Styles/Style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <title>Standup invullen</title>
</head>

<body>
    <?php if (isset($_GET['MakeStandup'])) : ?>
        <form action="" method="post">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="overlay"></div>
                        <div class="carousel-caption">
                            <label for="gedaan">Wat heb ik gedaan?</label><br>
                            <textarea id="gedaan" name="gedaan" required></textarea>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="overlay"></div>
                        <div class="carousel-caption">
                            <label for="doen">Wat ga ik doen?</label><br>
                            <textarea id="doen" name="doen" required></textarea>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="overlay"></div>
                        <div class="carousel-caption">
                            <label for="tegenaan">Waar loop ik tegenaan?</label><br>
                            <textarea id="tegenaan" name="tegenaan" required></textarea>
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
    <? endif; ?>

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