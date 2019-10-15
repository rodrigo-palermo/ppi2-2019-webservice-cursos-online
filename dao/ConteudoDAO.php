<?php
	//require_once "../class/Conteudo.php";
	//require_once "../db/PDOFactory.php";

	class ConteudoDAO {

		public function listar() {
			$query = "SELECT * FROM conteudo";
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->execute();
			$conteudo = array();
			while($row = $comando->fetch(PDO::FETCH_OBJ)) {
				$conteudo[] = new Conteudo($row->id,
										 $row->id_curso,
										 $row->nome,
										 $row->descricao,
										 $row->dth_criacao,
										 $row->imagem
										 );
			}
			return $conteudo;
		}

		public function buscarPorId($id) {
			$query = "SELECT * FROM conteudo WHERE id = :id";
			$pdo = PDOFactory::getConexao(); 
			$comando = $pdo->prepare($query);
			$comando->bindParam ("id",$id);
			$comando->execute();
			$resultado = $comando->fetch(PDO::FETCH_OBJ);
			return new Conteudo($resultado->id,
							   $resultado->id_curso,
							   $resultado->nome,
							   $resultado->descricao,
							   $resultado->dth_criacao,
							   $resultado->imagem
							   );
		}

		public function inserir(Conteudo $conteudo) {
			$query = "INSERT INTO conteudo(id_curso, nome,descricao,dth_criacao,imagem)
						 VALUES (:id_curso,:nome,:descricao,:dth_criacao,:imagem)";
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->bindParam(":id_curso", $conteudo->id_curso);
			$comando->bindParam(":nome", $conteudo->nome);
			$comando->bindParam(":descricao", $conteudo->descricao);
			$comando->bindParam(":dth_criacao", $conteudo->dth_criacao);
			$comando->bindParam(":imagem", $conteudo->imagem);
			$comando->execute();
			$conteudo->id = $pdo->lastInsertId();
			return $conteudo;
		}

		public function atualizar(Conteudo $conteudo) {
			$query = "UPDATE conteudo SET id_curso=:id_curso,nome=:nome,descricao=:descricao,dth_criacao=:dth_criacao,imagem=:imagem WHERE id = :id";
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->bindParam(":id", $conteudo->id);
			$comando->bindParam(":id_curso", $conteudo->id_curso);
			$comando->bindParam(":nome", $conteudo->nome);
			$comando->bindParam(":descricao", $conteudo->descricao);
			$comando->bindParam(":dth_criacao", $conteudo->dth_criacao);
			$comando->bindParam(":imagem", $conteudo->imagem);
			$comando->execute(); 
		}

		public function deletar($id) {
			$query = "DELETE from conteudo WHERE id = :id";
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->bindParam(":id", $id);
			$comando->execute();
		}
	}
?>