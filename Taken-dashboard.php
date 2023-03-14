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

    if (isset($_POST['submit'])){
        $taskName = $_POST['task'];
        $groupId = $userService->GetGroupId($_SESSION['id']);
        $taskService->AddTask($taskName, $groupId, 1);
        header('Location: Taken-dashboard.php');
    }


?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Taken dashboard</title>
</head>

<body>
    <div class="content">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Taak omschrijving</th>
                    <th scope="col">Gebruiker</th>
                    <th scope="col">Afgerond</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $taskService->GetAllTasks($groepId);
                ?>
            </tbody>
        </table>
        <div class="p-10 bt">
            <!-- Trigger the modal with a button -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Taak
                toevoegen</button>

            <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="">
                                <textarea name="task" cols="62" rows="3" required></textarea>
                                <input class="btn btn-primary" name="submit" type="submit" value="Taak toevoegen">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>