<?php
	include('templates/header.htm');
	require_once('Includes/db.php');
?>

<?php
	session_start();
	include_once("Includes/db.php");
	$wisher_id = WishDB::getInstance()->get_wisher_id_by_name($_SESSION['user']);

	if (!array_key_exists("user", $_SESSION)) {
	    header('Location: index.php');
	    exit;
	}

	$wishDescriptionIsEmpty = false;

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	    if (array_key_exists("back", $_POST)) {
           header('Location: editWishList.php'); 
           exit;
        } else
        
        if ($_POST['wish'] == "") {
            $wishDescriptionIsEmpty =  true;
        } else {
        	WishDB::getInstance()->insert_wish($wisher_id, $_POST["wish"], $_POST["dueDate"]);
        	header('Location: editWishList.php' );
       		exit;
        }

	    $wish = array("description" => $_POST["wish"], "due_date" => $_POST["dueDate"]);
	}
	else
	    $wish = array("description" => "", "due_date" => "");
?> 

<!-- Edit  wish -->
	<?php
	  if ($wishDescriptionIsEmpty) echo "Please enter description<br/>";
	?>

    <form name="editWish" action="editWish.php" method="POST">            
        Describe your wish: <input type="text" name="wish"  value="<?php echo $wish['description'];?>" /><br/>
		When do you want to get it? <input type="text" name="dueDate" value="<?php echo $wish['due_date']; ?>"/><br/>

        <input type="submit" name="saveWish" value="Save Changes"/>
        <input type="submit" name="back" value="Back to the List"/>
    </form>

<?php
	include('templates/footer.htm');
?>