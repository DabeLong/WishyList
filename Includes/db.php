<?php
class WishDB extends PDO{
	private static $instance = null;

	private $dbName = "localhost";
    private $dbHost = "localhost";
	private $user="phpuser";
	private $pass="phpuserpw";

	public function __construct(){
		try {
			$dsn = "mysql:host=" . $this->dbHost . ".;dbname=". $this->dbName .";charset=utf8";
			$opt = array(
			    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
			);
			parent::__construct($dsn, $this->user, $this->pass, $opt);
		} catch (PDOException $e) {
		    exit( 'Connection failed: ' . $e->getMessage() );
		}
	}

	//This method must be static, and must return an instance of the object if the object
	 //does not already exist.
	 public static function getInstance() {
	   if (!self::$instance instanceof self) {
	     self::$instance = new self;
	   }
	   return self::$instance;
	 }

	 // The clone and wakeup methods prevents external instantiation of copies of the Singleton class,
	 // thus eliminating the possibility of duplicate objects.
	 public function __clone() {
	   trigger_error('Clone is not allowed.', E_USER_ERROR);
	 }
	 // public function __wakeup() {
	 //   trigger_error('Deserializing is not allowed.', E_USER_ERROR);
	 // }

	 public function get_wisher_id_by_name($name){
	 	$stmt = $this->prepare("SELECT id from wishers where name = :name");
	 	$stmt->execute(array(':name' => $name));
	 	if ($stmt->rowCount() > 0) {
	 		$id = $stmt->fetch();
	 		return $id['id'];
	 	} else
      	return null;
	 }

	 public function get_wishes_by_wisher_id($wisher_id){
	 	$stmt = $this->prepare("SELECT id, description, due_date from wishes where wisher_id = :wisher_id");
	 	$stmt->execute(array(':wisher_id' => $wisher_id));
	 	return $stmt->fetchAll(); 
	 }

	 public function create_wisher($name, $password){
	 	$stmt = $this->prepare("INSERT INTO wishers (name, password) VALUES(?, ?)");
	 	$stmt->bindParam(1, $name);
	 	$stmt->bindParam(2, $password);
	 	$stmt->execute();
	 	return $stmt;
	 }

	 public function verify_wisher_credentials($user, $userpassword){
	 	$stmt = $this->prepare("SELECT 1 FROM wishers WHERE user = ? AND password = ?");
	 	$stmt->bindParam(1, $name);
	 	$stmt->bindParam(2, $userpassword);
	    $stmt->execute();
	 	return $stmt->fetchColumn();
	 }
}
?>