<?php
	//require_once "../class/Usuario.php";
	//require_once "../db/PDOFactory.php";

	class UsuarioDAO {

		public function listar() {
			$query = "SELECT * FROM usuario";
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->execute();
			$usuario = array();	
			while($row = $comando->fetch(PDO::FETCH_OBJ)) {
				$usuario[] = new Usuario($row->id,$row->nome);
			}
			return $usuario;
		}

		public function buscarPorId($id) {
			$query = "SELECT * FROM usuario WHERE id = :id";		
			$pdo = PDOFactory::getConexao(); 
			$comando = $pdo->prepare($query);
			$comando->bindParam ("id", $id);
			$comando->execute();
			$resultado = $comando->fetch(PDO::FETCH_OBJ);
			return new Usuario($resultado->id, $resultado->nome);           
		}

		public function inserir(Usuario $usuario) {
			$query = "INSERT INTO usuario(nome) VALUES (:nome)";            
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->bindParam(":nome", $usuario->nome);
			$comando->execute();
			$usuario->id = $pdo->lastInsertId();
			return $usuario;
		}

		public function atualizar(Usuario $usuario) {
			$query = "UPDATE usuario SET nome = :nome WHERE id = :id";            
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->bindParam(":nome", $usuario->nome);
			$comando->bindParam(":id", $usuario->id);
			$comando->execute(); 
		}

		public function deletar($id) {
			$query = "DELETE from usuario WHERE id = :id";            
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->bindParam(":id", $id);
			$comando->execute();
		}
	}
?>