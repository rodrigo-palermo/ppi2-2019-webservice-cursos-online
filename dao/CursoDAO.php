<?php
	//require_once "../class/Curso.php";
	//require_once "../db/PDOFactory.php";

	class CursoDAO {

		public function listar() {
			$query = "SELECT cur.*, cat.nome as categoria_nome 
                        FROM curso cur 
                        LEFT JOIN categoria cat 
                        ON cur.id_categoria = cat.id";
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->execute();
			$curso = array();
			while($row = $comando->fetch(PDO::FETCH_OBJ)) {
				$curso[] = new Curso($row->id,
										 $row->id_categoria,
										 $row->id_usuario_criacao,
										 $row->nome,
										 $row->descricao,
										 $row->dth_criacao,
										 $row->imagem,
                                         $row->categoria_nome
										 );
			}
			return $curso;
		}

		public function buscarPorId($id) {
			$query = "SELECT * FROM curso WHERE id = :id";
			$pdo = PDOFactory::getConexao(); 
			$comando = $pdo->prepare($query);
			$comando->bindParam ("id",$id);
			$comando->execute();
			$resultado = $comando->fetch(PDO::FETCH_OBJ);
			return new Curso($resultado->id,
							   $resultado->id_categoria,
							   $resultado->id_usuario_criacao,
							   $resultado->nome,
							   $resultado->descricao,
							   $resultado->dth_criacao,
							   $resultado->imagem
							   );
		}

		public function buscarPorIdUsuarioCriacao($id_usuario_criacao) {
		    $query = "SELECT * FROM curso WHERE id_usuario_criacao = :id_usuario_criacao";
		    $pdo = PDOFactory::getConexao();
		    $comando = $pdo->prepare($query);
		    $comando->bindParam("id_usuario_criacao",$id_usuario_criacao);
		    $comando->execute();
            $curso = array();
            while($row = $comando->fetch(PDO::FETCH_OBJ)) {
                $curso[] = new Curso($row->id,
                    $row->id_categoria,
                    $row->id_usuario_criacao,
                    $row->nome,
                    $row->descricao,
                    $row->dth_criacao,
                    $row->imagem
                );
            }
            return $curso;
        }

		public function inserir(Curso $curso) {
			$query = "INSERT INTO curso(id_categoria, id_usuario_criacao,nome,descricao,dth_criacao,imagem)
						 VALUES (:id_categoria,:id_usuario_criacao,:nome,:descricao,:dth_criacao,:imagem)";
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->bindParam(":id_categoria", $curso->id_categoria);
			$comando->bindParam(":id_usuario_criacao", $curso->id_usuario_criacao);
			$comando->bindParam(":nome", $curso->nome);
			$comando->bindParam(":descricao", $curso->descricao);
			$comando->bindParam(":dth_criacao", $curso->dth_criacao);
			$comando->bindParam(":imagem", $curso->imagem);
			$comando->execute();
			$curso->id = $pdo->lastInsertId();
			return $curso;
		}

		public function atualizar(Curso $curso) {
			$query = "UPDATE curso SET id_categoria=:id_categoria,id_usuario_criacao=:id_usuario_criacao,nome=:nome,descricao=:descricao,dth_criacao=:dth_criacao,imagem=:imagem WHERE id = :id";
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->bindParam(":id", $curso->id);
			$comando->bindParam(":id_categoria", $curso->id_categoria);
			$comando->bindParam(":id_usuario_criacao", $curso->id_usuario_criacao);
			$comando->bindParam(":nome", $curso->nome);
			$comando->bindParam(":descricao", $curso->descricao);
			$comando->bindParam(":dth_criacao", $curso->dth_criacao);
			$comando->bindParam(":imagem", $curso->imagem);
			$comando->execute(); 
		}

		public function deletar($id) {
			$query = "DELETE from curso WHERE id = :id";
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->bindParam(":id", $id);
			$comando->execute();
		}
	}
?>