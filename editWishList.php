<!DOCTYPE html>
<html>
	<head>
		<title></title>
	</head>
	<body>

		<!-- Check if user is logged in -->
		<?php
			session_start();
			if (array_key_exists("user", $_SESSION)){
				echo "Hello " . $_SESSION['user'] . "!";
			} else {
				// redirect to index
				header("index.php");
				exit;
			}
		?>

		<!-- Shows current wish as a table -->
		<table border="black">
		    <tr><th>Item</th><th>Due Date</th></tr>
		    <?php
			    require_once("Includes/db.php");
			    $wisher_id = WishDB::getInstance()->get_wisher_id_by_name($_SESSION["user"]);
			    $rows = WishDB::getInstance()->get_wishes_by_wisher_id($wisher_id);
				foreach ($rows as $row) {
				    echo "<tr><td>" . htmlentities($row["description"]) . "</td>";
					echo "<td>" . htmlentities($row["due_date"]) . "</td></tr>\n";
				}
		    ?>
		</table>

		<!-- Add new wish -->
		<form name="addNewWish" action="editWish.php">            
            <input type="submit" value="Add Wish">
	    </form>

	</body>



</html>