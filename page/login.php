<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" type="text/css" href="../Styles/Style.css">
</head>

<body>
    <?php
        session_start();
        if (isset($_SESSION['email'])){
            echo "Je bent al ingelogd";
        } else { ?>
    <div class="d-flex justify-content-center">
     <div class="loginform">
                <form method="post">
                    <h2 style="color: white;" class="h2">LOGIN</h2>

                    <?php if(isset($_GET['error'])) { ?>
                    <p style="color: white;" class="error"> <?php echo $_GET['error']; ?> </p>
                    <?php } 
            ?>
                    <input class="form-text" type="text" name="email" placeholder="Email" require autofocus> <br>
                    <input class="form-text" type="password" name="password" placeholder="Wachtwoord" require> <br>

                    <button name='submit' type="submit">Login</button>

                    <?php } ?>
                </form>
                </div>
    </div>
</body>

</html>

<?php
if (isset($_POST['submit'])) 
{
    include('dbconn.php');

    $email = $_POST['email'];
    $pass = $_POST['password'];
    $pass = md5($pass);
    $echt = '$2y$10$Z6pOsGCteiy8PR75f1Dy8ecEY4MssSAs8FG50MCC6w6s9j04bE4QO';

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
            print_r($pass);
            echo "<br>";
            print_r($echt);
            // header("Location: ?error=Incorrect Gebruikersnaam of wachtwoord");
            // exit();
        }
}
?>