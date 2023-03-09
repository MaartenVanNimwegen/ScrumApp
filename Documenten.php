<?php
include "config/dbconn.php";
include('sidebar.php');


// Retrieve data from Table 1
$sql1 = "SELECT `datum`, `bijdrage`, `meerwaarden`, `tegenaan`, `tips`, `tops` FROM retros";
$result1 = mysqli_query($conn, $sql1);

// Retrieve data from Table 2
$sql2 = "SELECT `datum`, `backlogitems`, `demonstreren`, `samenwerking`, `todoitems` FROM reviews";
$result2 = mysqli_query($conn, $sql2);

// Retrieve data from Table 3
$sql3 = "SELECT `datum`, `description`, `taken` FROM standups";
$result3 = mysqli_query($conn, $sql3);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="Styles/Style.css">
	<title>Database Information</title>
</head>
<body>
    <div class="content">
	<!-- Display data from Table 1 -->
	<table>
		<thead>
			<tr>
                <th>Datum</th>
                <th>Bijdrage</th>
				<th>Meerwaarden</th>
				<th>Tegenaan</th>
			</tr>
		</thead>
		<tbody>
			<?php while ($row = mysqli_fetch_assoc($result1)): ?>
			<tr>
				<td><?php echo $row['datum']; ?></td>
				<td><?php echo $row['bijdrage']; ?></td>
				<td><?php echo $row['meerwaarden']; ?></td>
                <td><?php echo $row['tegenaan']; ?></td>
                
			</tr>
		</tbody>
	</table>
    <!-- Display data from Table 1 -->
	<table>
		<thead>
			<tr>
				<th>Tips</th>
                <th>Tops</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><?php echo $row['tips']; ?></td>
				<td><?php echo $row['tops']; ?></td>
                
			</tr>
			<?php endwhile; ?>
		</tbody>
	</table>

	<!-- Display data from Table 2 -->
	<table>
		<thead>
			<tr>
                <th>Datum</th>
				<th>BacklogItems</th>
				<th>Demonstreren</th>
				<th>Samenwerking</th>
                <th>To do items</th>
			</tr>
		</thead>
		<tbody>
			<?php while ($row = mysqli_fetch_assoc($result2)): ?>
			<tr>
				<td><?php echo $row['datum']; ?></td>
				<td><?php echo $row['backlogitems']; ?></td>
				<td><?php echo $row['demonstreren']; ?></td>
                <td><?php echo $row['samenwerking']; ?></td>
                <td><?php echo $row['todoitems']; ?></td>
            </tr>
            <?php endwhile; ?>
        </tdbody>
    </table>

    <!-- Display data from Table 1 -->
	<table>
		<thead>
			<tr>
				<th>datum</th>
				<th>Beschrijving</th>
				<th>Taken</th>
			</tr>
		</thead>
		<tbody>
			<?php while ($row = mysqli_fetch_assoc($result1)): ?>
			<tr>
				<td><?php echo $row['datum']; ?></td>
				<td><?php echo $row['beschrijving']; ?></td>
				<td><?php echo $row['taken']; ?></td>
			</tr>
			<?php endwhile; ?>
		</tbody>
	</table>
            </body>
            </div>