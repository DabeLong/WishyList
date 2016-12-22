<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>WishyLists</title>
        <!--Import Google Icon Font-->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    
	<body>
        <section>
            <h1 style="text-align:center; background: #2196F3;
                height: 2em; vertical-align: middle; line-height: 2em;
                border-color: black; border-width: 2px; border-style: solid;
                color: #FFFFFF">
            Welcome to WishyLists
            </h1>
        </section>
        
		<?php
			require_once("Includes/db.php");
			$logonSuccess = false;

			if ($_SERVER['REQUEST_METHOD'] == "POST"){
				$logonSuccess = WishDB::getInstance()->verify_wisher_credentials($_POST['user'], $_POST['userpassword']);

				if ($logonSuccess == true){
					session_start();
					$_SESSION['user'] = $_POST['user'];
					header('Location: editWishList.php');
					exit;
				}
			}
		?>

        <section style="position: relative">
            <form name="wishList" action="wishlist.php">
                <h2 style="margin: 10px;">Show wish list of:
                    <input type="submit" value="Go" 
                           style="border-width: 0px; color: #2196F3;
                           background: transparent; position: absolute;
                           right: 0px;
                           z-index: 1; padding: 2em; margin-right: 2em" />
                    
                    <input type="text" name="user" value="" 
                     style="margin: 15px 0px 0px 0px; position: relative"/>
                    
                </h2> 
            </form>      
        </section>
		
        <br>

        <section style="margin: 10px;">
            <h2>
                <form name="logon" action="index.php" method="POST">
                    Username: <input type="text" name="user">
                    <br>
                    Password: <input type="password" name="userpassword">
                    <br>
                    <input type="submit" value="Edit My Wish List"/>
                </form>

                <?php
			 	if ($_SERVER["REQUEST_METHOD"] == "POST") { 
			     	 if (!$logonSuccess)
			     	    echo "Invalid name and/or password";
			  	}
				?>

            </h2>
        </section>
		
        <br>
        
		<h2 style="margin: 10px;">
            Still don't have a list? <a href="createNewWisher.php" style="margin-left:2em"> Create Now!</a>
        </h2>
		


		

	</body>
    
    
    <body>
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
    
</html>