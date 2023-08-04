<?php
//namespace Logic\DataAccess;

class DBConnect{
	private $servername = "localhost";
	private $username = "root";
	private $password = "";
	private $database = "dilmasystem";
	private $conn;
	public $name = "dilmaSystem";
	private static $_instance;
	
	function __construct(){
		$this->conn = new \mysqli($this->servername,$this->username,$this->password,$this->database);		
	}

	function executeQuery($sql){
		$result = null;
		if ($this->conn->connect_error) {
			die("Connection failure: ". $this->conn->connect_error);
		}
		if ($result = $this->conn->query($sql)) {
			// show bootstrap alert
			return $result;
		} else {
			echo "Error: " . $this->conn->error;
			return null;
        
		}
		//return $result;
	}

	function closeConn(){
		$this->conn->close();
	}

	function prepare($sql){
		return $this->conn->prepare($sql);
	}

	function getName(){
		return $this->name;
	}

	function getConnection(){
		return $this->conn;
	}
}

$dbConn = new DBConnect();
?>