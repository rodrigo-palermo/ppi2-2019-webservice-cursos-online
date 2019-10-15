<?php

class ConteudoController {

    public function listar($request, $response, $args) {
		$dao = new ConteudoDAO();
		$lista = $dao->listar();
		$response = $response->withJson($lista);
		$response = $response->withHeader("Content-type", "application/json");
        return $response;
    }

    public function buscarPorId($request, $response, $args) {
		$id = (int) $args['id'];
		$dao = new ConteudoDAO();
		$conteudo = $dao->buscarPorId($id);
		$response = $response->withJson($conteudo);
		$response = $response->withHeader('Content-type', 'application/json');    
		return $response;
      }
      
    public function inserir($request, $response, $args) {
		$var = $request->getParsedBody();
		$conteudo = new Conteudo(0,
                            (int) $var['id_curso'],
							$var['nome'],
							$var['descricao'],
							$var['dth_criacao'],
							$var['imagem']
							);
		$dao = new ConteudoDAO();
		$conteudo = $dao->inserir($conteudo);
		$response = $response->withJson($conteudo);
		$response = $response->withHeader('Content-type', 'application/json');
		$response = $response->withStatus(201);
		return $response;
      }
      
    public function atualizar($request, $response, $args) {
        $id = (int) $args['id'];
        $var = $request->getParsedBody();
				$conteudo = new Conteudo( $id,
									(int) $var['id_curso'],
									$var['nome'],
									$var['descricao'],
									$var['dth_criacao'],
									$var['imagem']
									);
        $dao = new ConteudoDAO;
        $dao->atualizar($conteudo);
        $response = $response->withJson($conteudo);
        $response = $response->withHeader('Content-type', 'application/json');
        return $response;
    }

    public function deletar($request, $response, $args) {
		$id = (int) $args['id'];
		$dao = new ConteudoDAO();
		$conteudo = $dao->buscarPorId($id);
		$dao->deletar($id);
		$response = $response->withJson($conteudo);
		$response = $response->withHeader('Content-type', 'application/json');
		return $response;
	}
}