<?php
	//require_once "../class/Endereco.php";
	//require_once "../db/PDOFactory.php";

	class EnderecoDAO {

		public function inserir(Endereco $endereco) {
			$query = "INSERT INTO endereco(cep,logradouro,numero,complemento,localidade,bairro,uf)
						 VALUES (:cep,:logradouro,:numero,:complemento,:localidade,:bairro,:uf)";
			$pdo = PDOFactory::getConexao();
			$comando = $pdo->prepare($query);
			$comando->bindParam(":cep", $endereco->cep);
			$comando->bindParam(":logradouro", $endereco->logradouro);
			$comando->bindParam(":numero", $endereco->numero);
			$comando->bindParam(":complemento", $endereco->complemento);
			$comando->bindParam(":localidade", $endereco->localidade);
			$comando->bindParam(":bairro", $endereco->bairro);
			$comando->bindParam(":uf", $endereco->uf);
			$comando->execute();
			$endereco->id = $pdo->lastInsertId();
			return $endereco->id;
		}
		
	}
?>