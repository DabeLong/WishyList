<?php   
	// show the header
	include("templates/header.htm");   
	// load db
	require_once("Includes/db.php");
    $logonSuccess = false;
?>	 

<section>
    <h1 style="text-align:center; background: #2196F3;
        height: 2em; vertical-align: middle; line-height: 2em;
        border-color: black; border-width: 2px; border-style: solid;
        color: #FFFFFF">
    Welcome to WishyLists
    </h1>
</section>

<!-- SEARCH FOR WISHLIST -->
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


<!-- LOGIN -->
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
		    if ($_SERVER['REQUEST_METHOD'] == "POST"){
		    	$loginFieldFilled = true;
		    	?>

		    	<?php if ($_POST['user'] == "" || $_POST['userpassword'] == "") : ?>
				    <div style="color:red">
				        You have left a login field empty.
				    </div>
				<?php $loginFieldFilled = false; endif; ?>

		    	<?php

		    	$loginSuccess = false;
		    	if ($loginFieldFilled) {
			        $loginSuccess = WishDB::getInstance()->verify_wisher_credentials($_POST['user'], $_POST['userpassword']);

			        if ($loginSuccess == true){
			            session_start();
			            $_SESSION['user'] = $_POST['user'];
			            header('Location: editWishList.php');
			            exit;
			        } else {
			        	?>
							<div style="color:red">
							    Incorrect username or password entered.
						    </div>
			        	<?php
			        }
			    }
		    }
		?>

    </h2>
</section>

<br>

<!-- SIGN UP -->
<h2 style="margin: 10px;">
    Still don't have a list? <a href="createNewWisher.php" style="margin-left:2em"> Create Now!</a>
</h2>

<?php
    // show the footer
	include("templates/footer.htm");
?>