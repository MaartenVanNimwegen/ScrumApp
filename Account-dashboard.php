<!DOCTYPE html>
<html lang="nl">

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
        include('sidebar.php');
        include "config/dbconn.php";
        include "Handlers/functions.php";

        // Verwijder account functie
        if (isset($_GET['userId'])) {
            $userId = $_GET['userId'];
            accountVerwijderen($userId, $conn);
        }

        // Build the SQL query
        $sql = "SELECT * FROM users";

        // Execute the query
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $role = $row["role"];

            if ($role == "1") { // replace with correct role
                header("Location: index.php"); // redirect to access denied page
                exit();
            }
        }

        // Check if there are any results
        if ($result->num_rows > 0) {
            // Output table header
            echo "
                <table>
                    <tr>
                        <th>Naam</th>
                        <th>E-mail</th>
                        <th>verwijderen</th>
                        <th>Status</th>
                    </tr>
            ";
        }

        foreach ($result as $row) {
            $id = $row['id'];
            if ($id != $_SESSION['id']) {
                echo '
                    <tr>
                        <td>' . $row["naam"] . '<input type="hidden" name="id[]" value="' . $row['id'] . '"></td>
                        <td>' . $row["email"] . '</td>
                        <td><a href="?userId=' . $id . '"> <i class="fa-solid fa-trash"></i></a></td>';
                        if ($row["isActivated"] == 1) {
                            echo '<td>Geactiveerd</td>';
                        } else {
                            echo '<td>Niet geactiveerd</td>';
                        }
                echo'
                    </tr>
                ';
            } else
                echo '<tr>
                        	<td>' . $row["naam"] . '<input type="hidden" name="id[]" value="' . $row['id'] . '"></td>
                            <td>' . $row["email"] . '</td>
                            <td></td>
                            <td>Geactiveerd</td>
                        </tr>
                    ';
        }

        echo "</table><br><br>";
        ?>
        <div class="p-10 toevoegknop bt">
            <a href="Account-toevoegen.php" class="btn btn-primary" role="button">Account aanmaken</a>
        </div>
    </div>
</body>

</html>