<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="Styles/Style.css">
    <title>Dashboard</title>
</head>
<body> 
    <div class="content">
        <?php
        include('sidebar.php');
        if(empty($_SESSION['id'])) {
            header("Location: login.php");
        }
        ?>
        
    </div>
</body>
</html>