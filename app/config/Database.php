<?php

namespace app\config;

define("EMAIL", "YOUR_EMAIL");
define("PASSWORD", "YOUR_EMAIL_PASSWORD");


//using www.reed.co.uk api to fetch jobs
define('APIKEY', 'YOUR_API_REED_KEY');
define('APIPASSWORD', 'YOUR_REED_PASSWORD');




class Database
{
    private $dbhost = "127.0.0.1";
    private $dbuser = "root";
    private $dbpass = "root";
    private $dbname = "job";
    private $port = "8889";
    public $socket = 'localhost:/Applications/MAMP/tmp/mysql/mysql.sock';
    public $pdo = null;

    public function connect()
    {
        try {
            if ($this->pdo === null) {
                $conn = new \PDO("mysql:host=" . $this->dbhost .";port=" . $this->port . ";sock=" .$this->socket . ";dbname=" . $this->dbname, $this->dbuser, $this->dbpass);
                // set the PDO error mode to exception
                $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                $this->pdo = $conn;
            }
        } catch (\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        return $this->pdo;
    }
}
