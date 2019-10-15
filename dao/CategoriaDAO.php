<?php
	//require_once "../class/Categoria.php";
	//require_once "../db/PDOFactory.php";

	class CategoriaDAO {

		public function listar() {
			$query = "SELECT * FROM categoria";
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->execute();
			$categoria = array();
			while($row = $comando->fetch(PDO::FETCH_OBJ)) {
				$categoria[] = new Categoria(
				    $row->id,
                    $row->nome,
                    $row->descricao
                );
			}
			return $categoria;
		}

		public function buscarPorId($id) {
			$query = "SELECT * FROM categoria WHERE id = :id";
			$pdo = PDOFactory::getConexao(); 
			$comando = $pdo->prepare($query);
			$comando->bindParam ("id", $id);
			$comando->execute();
			$resultado = $comando->fetch(PDO::FETCH_OBJ);
			return new Categoria(
			    $resultado->id,
                $resultado->nome,
                $resultado->descricao
            );
		}

		public function inserir(Categoria $categoria) {
			$query = "INSERT INTO categoria(nome, descricao) VALUES (:nome, :descricao)";
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->bindParam(":nome", $categoria->nome);
			$comando->bindParam(":descricao", $categoria->descricao);
			$comando->execute();
			$categoria->id = $pdo->lastInsertId();
			return $categoria;
		}

		public function atualizar(Categoria $categoria) {
			$query = "UPDATE categoria SET nome = :nome, descricao = :descricao WHERE id = :id";
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->bindParam(":nome", $categoria->nome);
			$comando->bindParam(":descricao", $categoria->descricao);
			$comando->bindParam(":id", $categoria->id);
			$comando->execute(); 
		}

		public function deletar($id) {
			$query = "DELETE from categoria WHERE id = :id";
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->bindParam(":id", $id);
			$comando->execute();
		}
	}
?>