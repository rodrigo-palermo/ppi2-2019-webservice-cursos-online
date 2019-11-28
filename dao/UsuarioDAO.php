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
				$usuario[] = new Usuario($row->id,
										 $row->id_perfil,
										 $row->nome,
										 $row->email,
										 $row->senha,
										 $row->dth_inscricao,
										 $row->imagem
										 );
			}
			return $usuario;
		}

		public function buscarPorId($id) {
			$query = "SELECT * FROM usuario WHERE id = :id";		
			$pdo = PDOFactory::getConexao(); 
			$comando = $pdo->prepare($query);
			$comando->bindParam ("id",$id);
			$comando->execute();
			$resultado = $comando->fetch(PDO::FETCH_OBJ);
			return new Usuario($resultado->id,
							   $resultado->id_perfil,
							   $resultado->nome,
							   $resultado->email,
							   $resultado->senha,
							   $resultado->dth_inscricao,
							   $resultado->imagem
							   );
		}

		public function inserir(Usuario $usuario) {
			$query = "INSERT INTO usuario(id_perfil,nome,email,senha,dth_inscricao,imagem)
						 VALUES (:id_perfil,:nome,:email,:senha,:dth_inscricao,:imagem)";            
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->bindParam(":id_perfil", $usuario->id_perfil);
			$comando->bindParam(":nome", $usuario->nome);
			$comando->bindParam(":email", $usuario->email);
			$comando->bindParam(":senha", $usuario->senha);
			$comando->bindParam(":dth_inscricao", $usuario->dth_inscricao);
			$comando->bindParam(":imagem", $usuario->imagem);
			$comando->execute();
			$usuario->id = $pdo->lastInsertId();
			return $usuario;
		}

		public function atualizar(Usuario $usuario) {
			$query = "UPDATE usuario SET id_perfil=:id_perfil,nome=:nome,email=:email,senha=:senha,dth_inscricao=:dth_inscricao,imagem=:imagem WHERE id = :id";            
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->bindParam(":id", $usuario->id);
			$comando->bindParam(":id_perfil", $usuario->id_perfil);
			$comando->bindParam(":nome", $usuario->nome);
			$comando->bindParam(":email", $usuario->email);
			$comando->bindParam(":senha", $usuario->senha);
			$comando->bindParam(":dth_inscricao", $usuario->dth_inscricao);
			$comando->bindParam(":imagem", $usuario->imagem);
			$comando->execute(); 
		}

		public function deletar($id) {
			$query = "DELETE from usuario WHERE id = :id";            
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->bindParam(":id", $id);
			$comando->execute();
		}

        public function buscarPorLogin($nome) {
            $query = "SELECT * FROM usuario WHERE nome = :nome";
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($query);
            $comando->bindParam ("nome",$nome);
            $comando->execute();
            $resultado = $comando->fetch(PDO::FETCH_OBJ);
            if(!empty($resultado)) {
                return new Usuario($resultado->id,
                    $resultado->id_perfil,
                    $resultado->nome,
                    $resultado->email,
                    $resultado->senha,
                    $resultado->dth_inscricao,
                    $resultado->imagem
                );
            } else {
                return false;
            }
        }

        public static function buscarPerfilPorLogin($nome) {
            $query = "SELECT nome FROM perfil WHERE id IN (
                                SELECT id_perfil FROM usuario WHERE nome = :nome)";
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($query);
            $comando->bindParam ("nome",$nome);
            $comando->execute();
            $resultado = $comando->fetch(PDO::FETCH_OBJ);
            if(!empty($resultado)) {
                return $resultado->nome;
            } else {
                return false;
            }
        }
	}
?>