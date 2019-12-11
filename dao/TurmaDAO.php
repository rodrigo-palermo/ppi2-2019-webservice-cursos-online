<?php
	//require_once "../class/Turma.php";
	//require_once "../db/PDOFactory.php";

	class TurmaDAO {

		public function listar() {
			$query = "SELECT t.*,
                        c.nome as curso_nome,
                        u.nome as professor_nome
                         FROM turma t
                        LEFT JOIN curso c ON t.id_curso = c.id
                        LEFT JOIN usuario u ON c.id_usuario_criacao = u.id";
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
										 $row->imagem,
										 $row->curso_nome,
										 $row->professor_nome
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

        public function buscarPorIdCurso($id_curso) {
            $query = "SELECT t.*,
                        c.nome as curso_nome,
                        u.nome as professor_nome
                         FROM turma t
                        LEFT JOIN curso c ON t.id_curso = c.id
                        LEFT JOIN usuario u ON c.id_usuario_criacao = u.id
                         WHERE id_curso = :id_curso";
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($query);
            $comando->bindParam("id_curso",$id_curso);
            $comando->execute();
            $turma = array();
            while($row = $comando->fetch(PDO::FETCH_OBJ)) {
                $turma[] = new Turma($row->id,
                    $row->id_curso,
                    $row->nome,
                    $row->descricao,
                    $row->dth_criacao,
                    $row->imagem,
                    $row->curso_nome,
                    $row->professor_nome
                );
            }
            return $turma;
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