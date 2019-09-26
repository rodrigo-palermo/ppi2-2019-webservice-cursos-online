<?php
	//require_once "../class/Perfil.php";
	//require_once "../db/PDOFactory.php";

	class PerfilDAO {

		public function listar() {
			$query = "SELECT * FROM perfil";
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->execute();
			$perfil = array();	
			while($row = $comando->fetch(PDO::FETCH_OBJ)) {
				$perfil[] = new Perfil($row->id,$row->nome);
			}
			return $perfil;
		}

		public function buscarPorId($id) {
			$query = "SELECT * FROM perfil WHERE id = :id";		
			$pdo = PDOFactory::getConexao(); 
			$comando = $pdo->prepare($query);
			$comando->bindParam ("id", $id);
			$comando->execute();
			$resultado = $comando->fetch(PDO::FETCH_OBJ);
			return new Perfil($resultado->id, $resultado->nome);           
		}

		public function inserir(Perfil $perfil) {
			$query = "INSERT INTO perfil(nome) VALUES (:nome)";            
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->bindParam(":nome", $perfil->nome);
			$comando->execute();
			$perfil->id = $pdo->lastInsertId();
			return $perfil;
		}

		public function atualizar(Perfil $perfil) {
			$query = "UPDATE perfil SET nome = :nome WHERE id = :id";            
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->bindParam(":nome", $perfil->nome);
			$comando->bindParam(":id", $perfil->id);
			$comando->execute(); 
		}

		public function deletar($id) {
			$query = "DELETE from perfil WHERE id = :id";            
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->bindParam(":id", $id);
			$comando->execute();
		}
	}
?>