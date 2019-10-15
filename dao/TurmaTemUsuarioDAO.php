<?php
	//require_once "../class/Turmatemusuario.php";
	//require_once "../db/PDOFactory.php";

	class TurmaTemUsuarioDAO {

		public function listar() {
			$query = "SELECT * FROM turma_tem_usuario";
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->execute();
			$turmatemusuario = array();
			while($row = $comando->fetch(PDO::FETCH_OBJ)) {
				$turmatemusuario[] = new Turmatemusuario(
				    $row->id,
				    $row->id_turma,
                    $row->id_usuario
				);
			}
			return $turmatemusuario;
		}

		public function buscarPorId($id) {
			$query = "SELECT * FROM turma_tem_usuario WHERE id = :id";
			$pdo = PDOFactory::getConexao(); 
			$comando = $pdo->prepare($query);
			$comando->bindParam ("id",$id);
			$comando->execute();
			$resultado = $comando->fetch(PDO::FETCH_OBJ);
			return new Turmatemusuario(
			    $resultado->id,
			    $resultado->id_turma,
                $resultado->id_usuario
            );
		}

		public function inserir(Turmatemusuario $turmatemusuario) {
			$query = "INSERT INTO turma_tem_usuario(id_turma, id_usuario)
						 VALUES (:id_turma, :id_usuario)";
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->bindParam(":id_turma", $turmatemusuario->id_turma);
			$comando->bindParam(":id_usuario", $turmatemusuario->id_usuario);
			$comando->execute();
			$turmatemusuario->id = $pdo->lastInsertId();
			return $turmatemusuario;
		}

		public function atualizar(Turmatemusuario $turmatemusuario) {
			$query = "UPDATE turma_tem_usuario SET id_turma=:id_turma, id_usuario=:id_usuario WHERE id = :id";
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->bindParam(":id", $turmatemusuario->id);
			$comando->bindParam(":id_turma", $turmatemusuario->id_turma);
			$comando->bindParam(":id_usuario", $turmatemusuario->id_usuario);
			$comando->execute();
		}

		public function deletar($id) {
			$query = "DELETE from turma_tem_usuario WHERE id = :id";
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->bindParam(":id", $id);
			$comando->execute();
		}
	}
?>