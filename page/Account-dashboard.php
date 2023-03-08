<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://kit.fontawesome.com/42b6daea05.js" crossorigin="anonymous"></script>
	<title>Document</title>
</head>
<body>
    <div class="content">

            <?php
            include('../sidebar.php');
            include "../config/dbconn.php";
            include "functions.php";
            // Verwijder account functie
            if (isset($_GET['userId'])) {
                $userId = $_GET['userId'];
                accountVerwijderen($userId, $conn);
            }
            
            // Build the SQL query
            $sql = "SELECT `id`, `naam`, `email` FROM users";
            
            // Execute the query
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $role = $row["role"];
            
                if ($role != "0") { // replace with correct role
                    header("Location: ../index.php"); // redirect to access denied page
                    exit();
                }
            }
            
            // Check if there are any results
            if ($result->num_rows > 0) {
                // Output table header
                echo "<table><tr><th>Id</th><th>Naam</th><th>E-mail</th><th>verwijderen</th></tr>";}
            ?>
                <?php
                
                foreach ($result as $row)
                {
                    $id = $row['id'];
                    echo '
                    <tr>
                                <td>' . $row["naam"] . '</td>
                                <td>' . $row["email"] . '</td>
                                <td><a href="?userId='.$id.'"> <i class="fa-solid fa-trash"></i></a>
                                </tr>
                                ';
                }
                                
            
            
            
            ?>
            <h2><a class="toevoegen" href="Account-toevoegen.php">Account aanmaken</a></h2>
        </div>


 
</body>
</html>