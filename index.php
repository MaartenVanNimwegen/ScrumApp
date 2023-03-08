<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/Style.css">
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
        <marquee scrollamount="30" direction="down" width="100%" height="900px" behavior="alternate">
            <marquee scrollamount="30" style="font-size: 100px; position: absolute; z-index: 2; color: blue;" behavior="alternate">Welkom <?php echo $_SESSION['naam'];?></marquee>
            <marquee scrollamount="30" style="font-size: 100px;" behavior="alternate"><img src="Image/6f3aa366-4eb6-37bd-b6ed-806b557a2c0e.jpg"></img></marquee>
        </marquee>
    </div>
</body>
</html>