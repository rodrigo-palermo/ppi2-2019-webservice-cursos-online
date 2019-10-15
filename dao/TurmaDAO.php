<?php
	//require_once "../class/Turma.php";
	//require_once "../db/PDOFactory.php";

	class TurmaDAO {

		public function listar() {
			$query = "SELECT * FROM turma";
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->execute();
			$turma = array();
			while($row = $comando->fetch(PDO::FETCH_OBJ)) {
				$turma[] = new Turma($row->id,
										 $row->id_curso,
										 $row->nome,
										 $row->descricao,
										 $row->dth_criacao,
										 $row->imagem
										 );
			}
			return $turma;
		}

		public function buscarPorId($id) {
			$query = "SELECT * FROM turma WHERE id = :id";
			$pdo = PDOFactory::getConexao(); 
			$comando = $pdo->prepare($query);
			$comando->bindParam ("id",$id);
			$comando->execute();
			$resultado = $comando->fetch(PDO::FETCH_OBJ);
			return new Turma($resultado->id,
							   $resultado->id_curso,
							   $resultado->nome,
							   $resultado->descricao,
							   $resultado->dth_criacao,
							   $resultado->imagem
							   );
		}

		public function inserir(Turma $turma) {
			$query = "INSERT INTO turma(id_curso, nome,descricao,dth_criacao,imagem)
						 VALUES (:id_curso,:nome,:descricao,:dth_criacao,:imagem)";
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->bindParam(":id_curso", $turma->id_curso);
			$comando->bindParam(":nome", $turma->nome);
			$comando->bindParam(":descricao", $turma->descricao);
			$comando->bindParam(":dth_criacao", $turma->dth_criacao);
			$comando->bindParam(":imagem", $turma->imagem);
			$comando->execute();
			$turma->id = $pdo->lastInsertId();
			return $turma;
		}

		public function atualizar(Turma $turma) {
			$query = "UPDATE turma SET id_curso=:id_curso,nome=:nome,descricao=:descricao,dth_criacao=:dth_criacao,imagem=:imagem WHERE id = :id";
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->bindParam(":id", $turma->id);
			$comando->bindParam(":id_curso", $turma->id_curso);
			$comando->bindParam(":nome", $turma->nome);
			$comando->bindParam(":descricao", $turma->descricao);
			$comando->bindParam(":dth_criacao", $turma->dth_criacao);
			$comando->bindParam(":imagem", $turma->imagem);
			$comando->execute(); 
		}

		public function deletar($id) {
			$query = "DELETE from turma WHERE id = :id";
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->bindParam(":id", $id);
			$comando->execute();
		}
	}
?>