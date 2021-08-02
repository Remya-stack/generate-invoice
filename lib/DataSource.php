<?php
/**
 * This class is for database connection establishment and to access db 
 */
class DataSource
{
	public $conn;
	function __construct()
	{
		$this->conn = $this->getConnection();
	}

	public function getConnection() {
		$servername = "localhost";
		$dbName 	= "invoice";
		$username 	= "root";
		$password	= "";

		try {
		  $conn = new PDO("mysql:host=$servername;dbname=invoice", $username, $password);
		  // set the PDO error mode to exception
		  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		  return $conn;
		  //echo "Connected successfully";
		} catch(PDOException $e) {
		  echo "Connection failed: " . $e->getMessage();
		  exit();
		}
	}

	public function select($query){
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
	}

	public function insert($query) {
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$lastInsertId = $this->conn->lastInsertId(); 
		return $lastInsertId;
	}

	public function update($query) {
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$rowCount = $stmt->rowCount(); 
		return $rowCount;
	}
}
?>