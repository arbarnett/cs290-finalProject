<?php
session_start();

$tableRows = array();

$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "barnetal-db", "jVIV8TuG4g2sc4ER", "barnetal-db");

if (!$mysqli->connect_errno && session_status() == PHP_SESSION_ACTIVE && isset($_SESSION['userid'])) {

		//build the query
		$query = "SELECT id, name, unit, quantity FROM Groceries WHERE userId = '". $_SESSION['userid']."'";

		//run the query
		if($result = $mysqli->query($query)) {

			//store the query
			while ($row = $result->fetch_row()) {
				$tableRows[]=array(
					"id" => $row[0],
					"name" => $row[1],
					"unit" => $row[2],
					"quantity" => $row[3]
					);
			}

			//close the query
			$result->close();
		}
}	
?>

<table id="grocery-list-table" class="table">
	<thead>
		<tr>
			<th>Item</th>
			<th>Unit</th>
			<th>Quantity</th>
			<th>Got it? (delete item)</th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach($tableRows as $row) {
		?>
				<tr>
					<td><?= $row["name"]; ?></td>
					<td><?= $row["unit"]; ?></td>
					<td><?= $row["quantity"]; ?></td>
					<td><button class="delete-item btn btn-default" value="<?= $row["id"]; ?>">Yup!</button></td>
				</tr>
		<?php	
			}
		?>
	</tbody>
</table>