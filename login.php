<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>LOGIN</title>
        <link rel="stylesheet" type="text/css" href="/Styles/Style.css">
    </head>
    <body>
        <form action="" method="post">
            <h2 class="h2">LOGIN</h2>

            <?php if(isset($_GET['error'])) { ?>
                <p class="error"> <?php echo $_GET['error']; ?> </p>
                <?php } 
            ?>

            <label>Gebruikersnaam</label>
            <input type="text" name="email" placeholder="Email" autofocus> <br>
            <label>Wachtwoord</label>
            <input type="password" name="password" placeholder="Wachtwoord"> <br>

            <button type="submit">Login</button>
    </body>
</html>

<?php
include('user.php');

if(isset($_POST['email']) && isset($_POST['password'])) {

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

$email = validate($_POST['email']);
$pass = validate($_POST['password']);

if(empty($email)) {
    header ("Location: ?error=Email is vereist");
    exit();
}
else if(empty($pass)) {
    header ("Location: ?error=wachtwoord is vereist");
    exit();
}

$sql = "SELECT * FROM users WHERE `email`='$email' AND `password`='$pass'"; 

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if($row['name'] === $email) {
        echo "succesvol ingelogd";
        session_start();
        $_SESSION['id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['email'] = $row['email'];
        header("Location: index.php");
        exit();
    }
}
    else{
        header("Location: ?error=Incorrect Gebruikersnaam of wachtwoord");
        exit();
    }
?>