<?php
class Database
	{
	// top secret db credentials
	private $host = "localhost";
	private $db_name = "my_fatastreaming2";
	private $username = "fatastreaming2";
	private $password = "";
	public $conn;
	// DB connection
	public function getConnection()
		{
		$this->conn = null;
		try
			{
			$this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
			$this->conn->exec("set names utf8");
			}
		catch(PDOException $exception)
			{
			echo "Errore di connessione: " . $exception->getMessage();
			}
		return $this->conn;
		}
	}
?>