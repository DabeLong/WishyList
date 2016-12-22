<!DOCTYPE html>
	<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Wishlist of <?php echo htmlentities($_GET["user"])."<br/>";  ?></title>
	</head>

	<body>
		Wishlist of <?php echo htmlentities($_GET["user"])."<br/>";  ?>
		<?php
			require_once("Includes/db.php");

			// // try to connect
			// $con = mysqli_connect("localhost", "phpuser", "phpuserpw","localhost");
			// if (!$con){
			//     exit('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
			// }

			// mysqli_set_charset($con, 'utf-8');
			

			// $user = mysqli_real_escape_string($con, htmlentities($_GET["user"]));

			// $wisher = mysqli_query($con, "SELECT id FROM wishers WHERE name='" . $user . "'");

			// if (mysqli_num_rows($wisher) < 1){
			// 	exit("The person " . htmlentities($_GET["user"]) . " is not found.");
			// }

			// $row = mysqli_fetch_row($wisher);
			// $wisherID = $row[0]; // the Wisher ID
			// mysqli_free_result($wisher);

			if ($_GET["user"] == "") {
				exit("You need to specifiy a user name.");
			}

			$wisher_id = WishDB::getInstance()->get_wisher_id_by_name($_GET["user"]);
			if (!$wisher_id) {
			    exit("The person " .$_GET["user"]. " is not found. Please check the spelling and try again" );
			}
		?>

		<table border="black">
			<tr>
				<th>Item</th>
				<th>Due Date</th>
			</tr>

			<?php
				// $result = mysqli_query($con, "SELECT description, due_date FROM wishes WHERE wisher_id=" . $wisherID);
				$rows = WishDB::getInstance()->get_wishes_by_wisher_id($wisher_id);
				foreach ($rows as $row) {
				    echo "<tr><td>" . htmlentities($row["description"]) . "</td>";
					echo "<td>" . htmlentities($row["due_date"]) . "</td></tr>\n";
				}

				// mysqli_free_result($result);
				// mysqli_close($con);
			?>

		</table>

	</body>
</html>