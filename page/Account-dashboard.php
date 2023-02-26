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
<?php
include "dbconn.php";
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

// Check if there are any results
if ($result->num_rows > 0) {
    // Output table header
    echo "<table><tr><th>Id</th><th>Naam</th><th>E-mail</th><th>verwijderen</th></tr>";
?>
    <?php
    
    foreach ($result as $row)
    {
        $id = $row['id'];
        echo '
        <tr>
                    <td>' . $row["id"] . '</td>
                    <td><input type="text" name="name[]" value="' . $row["naam"] . '"><input type="hidden" name="id[]" value="' . $row['id'] . '"></td>
                    <td><input type="text" name="email[]" value="' . $row["email"] . '"></td>
                    <td><a href="?userId='.$id.'"> <i class="fa-solid fa-trash"></i></a>
                    </tr>
                    ';
    }
                    ?>
                
  <?php

    echo "</table>";
} else {
    echo "0 results";
}

?>
 <h2><a class="toevoegen" href="Account-toevoegen.php">Account aanmaken</a></h2>

</body>
</html>