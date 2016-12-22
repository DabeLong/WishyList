<!DOCTYPE html>
	<html>
	<head>
		<title></title>
	</head>

	<body>
		Welcome! Make a new account.
		<form action="createNewWisher.php" method="POST">
			Name: <input type="text" name="user" /> <br/>
			Password: <input type="password" name="password1" /> <br/>
			Re-enter Password: <input type="password" name="password2" /> <br/>

			<input type="submit" value="Register New Account" />
		</form>
		<?php
			require_once("Includes/db.php");

			// $dbHost = "localhost";
			// $dbUsername="phpuser";
			// $dbPassword="phpuserpw";

			$isUserNameUnique = true;
			$isPasswordValid = true;
			$isFieldEmpty = false;

			if ($_SERVER["REQUEST_METHOD"] == "POST"){
				if ($_POST["user"] == "" || $_POST["password1"] == "" || $_POST["password2"] == "") {
					$isFieldEmpty = true;
				}
				if ($_POST["password1"] != $_POST["password2"]) {
					$isPasswordValid = false;
				}

				// $con = mysqli_connect($dbHost, $dbUsername, $dbPassword, "localhost");
				// if (!$con){
				// 	exit('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
				// }

				// mysqli_set_charset($con, 'utf-8');
				// $user = mysqli_real_escape_string($con, $_POST["user"]);
				// $query = "SELECT id from wishers where name='" . $user . "'";
				// $wisher=mysqli_query($con, $query);
				// $wisherIDnum=mysqli_num_rows($wisher);
				// if ($wisherIDnum) {
			 	// 		$isUserNameUnique = false;
				// }

				$wisherID = WishDB::getInstance()->get_wisher_id_by_name($_POST["user"]);
				if ($wisherID) {
				   $isUserNameUnique = false;
				}

			    // make new account
			    if ($isPasswordValid && !$isFieldEmpty && $isUserNameUnique) {
			  //   	$password = mysqli_escape_string($con, $_POST["password1"]);

			  //   	$query = "INSERT wishers (name, password) VALUES ('".$user."','".$password."')";
					// $wisher=mysqli_query($con, $query);

					// mysqli_free_result($wisher);
			  //       mysqli_close($con);
			  //       header('Location: editWishList.php');
			  //       exit;

			    	WishDB::getInstance()->create_wisher($_POST["user"], $_POST["password1"]);

			    	// starts a session for the user who signed up
			    	session_start();
			    	$_SESSION['user'] = $_POST['user'];

				    header('Location: editWishList.php' );
				    exit;
			    }

			    if ($isFieldEmpty) {
			    	echo ("<br/>");
			        echo ("Please fill in all fields!");
			    }                
			    if (!$isUserNameUnique) {
			    	echo ("<br/>");
			        echo ("The person already exists. Please check the spelling and try again");
			    }
			    if (!$isPasswordValid){
			    	echo ("<br/>");
					echo ("Please make sure both passwords match!");
			    }
			}

		?>

	</body>
</html>