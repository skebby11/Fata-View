<?php
class Episodio
	{
	private $conn;
	private $table_name = "episodi";
	// proprietà di un episodio
	public $id;
	public $stagione;
	public $episodio;
	public $serie;
	public $titolo;
	public $link;
	public $linksv;
	// costruttore
	public function __construct($db)
		{
		$this->conn = $db;
		}
	// READ episodi
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
	// CREARE LIBRO
	// AGGIORNARE LIBRO
	// CANCELLARE LIBRO
	}
?>