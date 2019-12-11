<?php
	//require_once "../class/Turmatemusuario.php";
	//require_once "../db/PDOFactory.php";

	class TurmaTemUsuarioDAO {

		public function listar() {
			$query = "SELECT ttu.*,
                             t.nome as turma_nome,
                             u.nome as usuario_nome,
                             u.id_perfil as usuario_perfil_id,
                             p.nome as usuario_perfil_nome,
                             c.id as curso_id,
                             c.nome as curso_nome
                        FROM turma_tem_usuario ttu
                        LEFT JOIN turma t ON ttu.id_turma = t.id
                        LEFT JOIN usuario u ON ttu.id_usuario = u.id
                        LEFT JOIN perfil p ON u.id_perfil = p.id
                        LEFT JOIN curso c on t.id_curso = c.id";
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->execute();
			$turmatemusuario = array();
			while($row = $comando->fetch(PDO::FETCH_OBJ)) {
				$turmatemusuario[] = new Turmatemusuario(
				    $row->id,
				    $row->id_turma,
                    $row->id_usuario,
                    $row->turma_nome,
                    $row->usuario_perfil_id,
                    $row->usuario_perfil_nome,
                    $row->curso_id,
                    $row->curso_nome
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

		public function buscarPorTurmaId($id_turma) {
			$query = "SELECT * FROM turma_tem_usuario WHERE id_turma = :id_turma";
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->bindParam ("id_turma",$id_turma);
			$comando->execute();
            $usuariosPorTurma = $comando->fetchAll(PDO::FETCH_ASSOC);

            return $usuariosPorTurma;

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