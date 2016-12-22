<!DOCTYPE html>
<html>
	<head>
		<title></title>
	</head>
	<body>

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

	</body>
</html>