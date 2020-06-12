<?php

namespace app\config;

define("EMAIL", "YOUR_EMAIL");
define("PASSWORD", "YOUR_EMAIL_PASSWORD");


//using www.reed.co.uk api to fetch jobs
define('APIKEY', 'YOUR_API_REED_KEY');
define('APIPASSWORD', 'YOUR_REED_PASSWORD');


class Database
{
	private $dbhost = "localhost";
	private $dbuser = "root";
	private $dbpass = "root";
	private $dbname = "job";
	public $pdo;






	public function __construct()
	{
		try {
			$conn = new \PDO("mysql:host=" . $this->dbhost . ";dbname=" . $this->dbname, $this->dbuser, $this->dbpass);
			// set the PDO error mode to exception
			$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			$this->pdo = $conn;
		} catch (\PDOException $e) {
			echo "Connection failed: " . $e->getMessage();
		}
		return $this->pdo;
		//echo "connection succesfully";


	}


	public function insert_query($table, $fields = array())
	{
		// $sql = "INSERT INTO User ( firstname, lastname, dob, username, password, roleid ) VALUES ( :firstname, :lastname, :dob, :username, :password, :roleid )";
		$sql = "INSERT INTO" . $table . "(";
		$i = 1;

		foreach ($fields as $field) {
			$sql .=  $field;
			if ($i < count($fields)) {
				$sql .= ",";
			}
			$i++;
		}
		$sql .= ")" . " VALUES" . "(";

		$j = 1;
		foreach ($fields as $field) {
			$sql .=  ':' .  $field;

			if ($j < count($fields)) {
				$sql .= ",";
			}
			$j++;
		}
		$sql .= ")";

		echo $sql;
	}


	public function select_query($table, $operator, $fields = array(), $where, $whereid)
	{

		if ($operator === '*') {

			$sql = "SELECT " . $operator . " FROM" . $table;
		} else {

			$i = 1;
			$sql = "SELECT ";

			foreach ($fields as $field) {
				$sql .=   $field;
				if ($i < count($fields)) {
					$sql .= ",";
				}
				$i++;
			}
			$sql .= " FORM" . $table;
		}
		if ($where === 'WHERE') {

			$sql .= $where . $whereid;
		}

		echo $sql;
	}

	public function update_query()
	{
	}
}
