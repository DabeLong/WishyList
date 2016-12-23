<?php
	include('templates/header.htm');
	require_once('Includes/db.php');
?>

<div>
	<h1>Wishlist of <?php echo htmlentities($_GET["user"])."<br/>";  ?></h1>

	<?php
		require_once("Includes/db.php");

		if ($_GET["user"] == "") {
			exit("<h2>You need to specifiy a user name.</h2>");
		}

		$wisher_id = WishDB::getInstance()->get_wisher_id_by_name($_GET["user"]);
		if (!$wisher_id) {
		    exit("<h2>The person " .$_GET["user"]. " is not found. Please check the spelling and try again.</h2>" );
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

</div>

<?php
	include('templates/footer.htm');
?>