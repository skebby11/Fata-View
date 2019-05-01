<?php
class Episodio
	{
	private $conn;
	private $table_name = "episodi";
	// propriety of an episode 
	public $id;
	public $stagione;
	public $episodio;
	public $serie;
	public $titolo;
	public $link;
	public $linksv;
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
                        a.id, a.stagione, a.episodio, a.serie, a.titolo, a.link, a.linksv
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