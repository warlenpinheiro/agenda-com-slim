<?php
	/**
	 * 
	 */
	class Lista
	{
		private $db;
		
		function __construct($db)
		{
			$this->db = $db;
		}


		public function getLista(){
			$array = array();
			$sql = $this->db->query("SELECT * FROM contatos");
			if ($sql->rowCount() > 0) {
				$array = $sql->fetchAll();
			}

			return $array;
		}

		public function add($data){
			$sql = $this->db->prepare("INSERT INTO contatos SET nome=:nome, telefone=:telefone");
			$sql->bindValue(":nome", $data['nome']);
			$sql->bindValue(":telefone", $data['telefone']);
			$sql->execute();
		}

		public function getContato($id){
			$array = array();
			$sql = $this->db->prepare("SELECT * FROM contatos WHERE id = :id");
			$sql->bindValue(":id", $id);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				$array = $sql->fetch();
			}

			return $array;
		}

		public function update($data, $id){
			$sql = $this->db->prepare("UPDATE contatos SET nome=:nome, telefone=:telefone WHERE id = :id");
			$sql->bindValue(":nome", $data['nome']);
			$sql->bindValue(":telefone", $data['telefone']);
			$sql->bindValue(":id", $id);
			$sql->execute();
		}

		public function delete($id){
			$sql = $this->db->prepare("DELETE FROM contatos WHERE id = :id");
			$sql->bindValue(":id", $id);
			$sql->execute();
		}
	}