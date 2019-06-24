<?php
class Serie
	{
	private $conn;
	private $table_name = "serie";
	// propriety of an episode 
	public $id;
	public $nome;
	public $descr;
	public $poster;
	public $stagioni;
	// constructor
	public function __construct($db)
		{
		$this->conn = $db;
		}
	// READ episodes
	function read()
		{
		// select all
		$query = "SELECT
                        a.id, a.nome, a.descr, a.poster, a.stagioni
                    FROM
                   " . $this->table_name . " a ";
		$stmt = $this->conn->prepare($query);
		// execute query
		$stmt->execute();
		return $stmt;
		}
	// CREARE EPISODIO
	// AGGIORNARE EPISODIO
	// CANCELLARE EPISODIO
	}
?>