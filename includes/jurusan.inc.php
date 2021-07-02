<?php
class jurusan{
	
	private $conn;
	private $table_name = "jurusan";
	
	public $id;
	public $nm;
	public $bb;
	
	public function __construct($db){
		$this->conn = $db;
	}
	
	
	function readAll(){

		$query = "SELECT * FROM ".$this->table_name." ORDER BY id ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt;
	}
	function countAll(){

		$query = "SELECT * FROM ".$this->table_name." ORDER BY id ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt->rowCount();
	}
	
	function readOne(){
		
		$query = "SELECT * FROM " . $this->table_name . " WHERE id=? LIMIT 0,1";

		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->id);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->id = $row['id_kriteria'];
		$this->nm = $row['nama_kriteria'];
		$this->bb = $row['bobot_kriteria'];
	}
	function readSatu($a){
		
		$query = "SELECT * FROM " . $this->table_name . " WHERE id='$a' LIMIT 0,1";

		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}
}
?>