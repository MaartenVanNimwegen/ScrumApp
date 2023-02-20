<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>LOGIN</title>
        <link rel="stylesheet" type="text/css" href="/Styles/Style.css">
    </head>
    <body>
        <?php
        session_start();
        if (isset($_SESSION['email'])){
            echo "Je bent al ingelogd";
        } else { ?>
        <form action="" method="post">
            <h2 class="h2">LOGIN</h2>

            <?php if(isset($_GET['error'])) { ?>
                <p class="error"> <?php echo $_GET['error']; ?> </p>
                <?php } 
            ?>

            <label>Gebruikersnaam</label>
            <input type="text" name="email" placeholder="Email" require autofocus> <br>
            <label>Wachtwoord</label>
            <input type="password" name="password" placeholder="Wachtwoord" require> <br>

            <button name='submit' type="submit">Login</button>
        <?php } ?>
    </body>
</html>

<?php
if (isset($_POST['submit'])) 
{
    include('dbconn.php');
    include('user.php');

    $email = $_POST['email'];
    $pass = $_POST['password'];
    $pass = md5($pass);

    if(empty($email)) {
        header ("Location: ?error=Email is vereist");
        exit();
    } else if(empty($pass)) {
        header ("Location: ?error=wachtwoord is vereist");
        exit();
    }

    $sql = "SELECT * FROM users WHERE `email`='$email' AND `password`='$pass'"; 

    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if($row['email'] === $email) {
            echo "succesvol ingelogd";
            $_SESSION['id'] = $row['id'];
            $_SESSION['naam'] = $row['naam'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['role'] = $row['role'];
            header("Location: index.php");
            exit();
        }
    }
        else{
            header("Location: ?error=Incorrect Gebruikersnaam of wachtwoord");
            exit();
        }
}
?>