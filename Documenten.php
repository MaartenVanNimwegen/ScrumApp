<?php
include "config/dbconn.php";

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
	<title>Database Information</title>
</head>
<body>
	<!-- Display data from Table 1 -->
	<table>
		<thead>
			<tr>
                <th>Datum</th>
				<th>meerwaarden</th>
				<th>tegenaan</th>
				<th>tips</th>
                <th>tops</th>
			</tr>
		</thead>
		<tbody>
			<?php while ($row1 = mysqli_fetch_assoc($result1)): ?>
			<tr>
				<td><?php echo $row1['datum']; ?></td>
				<td><?php echo $row1['col2']; ?></td>
				<td><?php echo $row1['col3']; ?></td>
                <td><?php echo $row1['col4']; ?></td>
                <td><?php echo $row1['col5']; ?></td>
			</tr>
			<?php endwhile; ?>
		</tbody>
	</table>

	<!-- Display data from Table 2 -->
	<table>
		<thead>
			<tr>
                <th>Datum</th>
				<th>backlogItems</th>
				<th>Demonstreren</th>
				<th>Samenwerking</th>
                <th>To do items</th>
			</tr>
		</thead>
		<tbody>
			<?php while ($row2 = mysqli_fetch_assoc($result2)): ?>
			<tr>
				<td><?php echo $row2['col1']; ?></td>
				<td><?php echo $row2['col2']; ?></td>
				<td><?php echo $row3['col3']; ?></td>
                <td><?php echo $row3['col3']; ?></td>
                <td><?php echo $row3['col3']; ?></td>
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
			<?php while ($row1 = mysqli_fetch_assoc($result1)): ?>
			<tr>
				<td><?php echo $row1['col1']; ?></td>
				<td><?php echo $row1['col2']; ?></td>
				<td><?php echo $row1['col3']; ?></td>
			</tr>
			<?php endwhile; ?>
		</tbody>
	</table>