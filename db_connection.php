<?php
	
	class Database{
		private $dbhost = "localhost";
		private $dbuser = "root";
		private $dbpass = "";
		private $dbname = "job";
		public $pdo;
		

		public function __construct(){
			try {
					$conn= new PDO("mysql:host=".$this->dbhost.";dbname=".$this->dbname, $this->dbuser, $this->dbpass);
				   	// set the PDO error mode to exception
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$this->pdo = $conn;
				}
				catch(PDOException $e)
					{
						echo "Connection failed: " . $e->getMessage();
					}
					return $this->pdo;
				//echo "connection succesfully";

			
		}


	
		

	}


?>
	