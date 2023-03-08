<?php
    include('sidebar.php');
    include "config/dbconn.php";
    require('Handlers/Services.php');

    if(!$_SESSION['role'] == 0) {
        header('Location: index.php');
    }

    $taskService = new TaskServices($conn);
    $userService = new UserServices($conn);
    $groepId = $userService->GetGroupId($_SESSION['id']);
    
    if (isset($_GET['deleteTaakId'])) {
        $taakId = $_GET['deleteTaakId'];
        $taskService->DeleteTask($taakId);
    }

    if (isset($_GET['changeTaakId'])) {
        $taakId = $_GET['changeTaakId'];
        $status = $_GET['status'];
        $taskService->ChangeTask($taakId, $status);
    }
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://kit.fontawesome.com/42b6daea05.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <title>Taken dashboard</title>
</head>
<body>
    <div class="content">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Taal omschrijving</th>
                <th scope="col">Gebruiker</th>
                <th scope="col">Afgerond</th>
                <th scope="col">Verwijderen</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $taskService->GetAllTasks($groepId);
                ?>
            </tbody>
        </table>
        <div class="p-10 bt">
                <a href="" class="btn btn-primary" role="button">Taak toevoegen</a>
        </div>
    </div>
</body>
</html>