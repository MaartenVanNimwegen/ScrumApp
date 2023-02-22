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
// Build the SQL query
$sql = "SELECT `naam`, `email` FROM users";

// Execute the query
$result = $conn->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
    // Output table header
    echo "<table><tr><th>Naam</th><th>E-mail</th><th>verwijderen</th></tr>";

    // Output table rows
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["naam"] . "</td><td>" . $row["email"] . "</td><td> <i class='fa-solid fa-trash'></i</tr>";
    }

    // Output table footer
    echo "</table>";
} else {
    echo "0 results";
}

// Close the database connection
$conn->close();

?>
 <h2><a class="toevoegen" href="Account-toevoegen.php">Account aanmaken</a></h2>
</body>
</html>