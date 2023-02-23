<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/42b6daea05.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Styles/Style.css">
    <title>Review Retro invullen</title>
</head>

<body>
    <div class="invulscherm h-100 w-100 d-flex align-items-center justify-content-center">
        <form action="" method="post">
            <div class="retro w-100">
                <h3>Retrospective</h3>

                <label for="bijdrage">Wat was mijn bijdrage de afgelopen week?</label><br>
                <textarea class="w-100" name="bijdrage" id="bijdrage" cols="50" rows="3"></textarea><br>

                <label for="meerwaarden">Wat was jou meerwaarden?</label><br>
                <textarea class="w-100" name="meerwaarden" id="meerwaarden" cols="50" rows="3"></textarea><br>

                <label for="tegenaan">Waar liep je tegenaan?</label><br>
                <textarea class="w-100" name="tegenaan" id="tegenaan" rows="3"></textarea><br>

                <div class="parent">c
                    <div class="p-2">
                        <label for="tips">Tip voor
                            <?$naam?>
                        </label><br>
                        <input type="text">
                    </div>
                    <div class="p-2">
                        <label for="tips">Tip voor
                            <?$naam?>
                        </label><br>
                        <input type="text">
                    </div>
                    <div class="p-2">
                        <label for="tips">Tip voor
                            <?$naam?>
                        </label><br>
                        <input type="text">
                    </div>

                    <?php foreach($users as $naam){echo"";}?> 

                    <div class="p-2">
                        <label for="tops">Top voor
                            <?$naam?>
                        </label><br>
                        <input type="text">
                    </div>
                    <div class="p-2">
                        <label for="tops">Top voor
                            <?$naam?>
                        </label><br>
                        <input type="text">
                    </div>
                    <div class="p-2">
                        <label for="tops">Top voor
                            <?$naam?>
                        </label><br>
                        <input type="text">
                    </div>
                </div>

            </div>

            <br>

            <div class="review w-100">
                <h3>Review</h3>

                <label for="backlogitems">Aan welke backlogitems hebben jullie gewerkt?</label><br>
                <textarea class="w-100" name="backlogitems" id="backlogitems" cols="50" rows="3"></textarea><br>

                <label for="demonstreren">Wat gaan jullie demonstreren?</label><br>
                <textarea class="w-100" name="demonstreren" id="demonstreren" cols="50" rows="3"></textarea><br>

                <label for="samenwerking">Hoe was jullie samenwerking?</label><br>
                <textarea class="w-100" name="samenwerking" id="samenwerking" cols="50" rows="3"></textarea><br>

                <label for="todoitems">Welke items gaan jullie de komende sprint werken?</label><br>
                <textarea class="w-100" name="todoitems" id="todoitems" cols="50" rows="3"></textarea><br>
            </div>
        </form>
    </div>
</body>

</html>