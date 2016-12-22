<?php   
	// show the header
	include("templates/header.htm");   

	// Set the default name 
	$action = 'index'; 
	// Specify some disallowed paths 
	$disallowed_paths = array('header', 'footer'); 
	if (!empty($_GET['action'])) { 
	    $tmp_action = basename($_GET['action']); 
	    // If it's not a disallowed path, and if the file exists, update $action 
	    if (!in_array($tmp_action, $disallowed_paths) && file_exists("templates/{$tmp_action}.htm")) 
	        $action = $tmp_action; 
	} 
	// Include $action (CONTENT)
	include("templates/$action.htm"); 

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

    if ($_SERVER["REQUEST_METHOD"] == "POST") { 
         if (!$logonSuccess)
            echo "Invalid name and/or password";
    }         

    // show the footer
	include("templates/footer.htm");
?>