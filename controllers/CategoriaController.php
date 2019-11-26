<?php

class CategoriaController {

    public function listar($request, $response, $args) {
		$dao = new CategoriaDAO();
		$lista = $dao->listar();
		$response = $response->withJson($lista);
		$response = $response->withHeader("Content-type", "application/json");
        return $response;
    }

    public function buscarPorId($request, $response, $args) {
		$id = (int) $args['id'];
		$dao = new CategoriaDAO();
		$categoria = $dao->buscarPorId($id);
		$response = $response->withJson($categoria);
		$response = $response->withHeader('Content-type', 'application/json');    
		return $response;
      }
      
    public function inserir($request, $response, $args) {
		$var = $request->getParsedBody();
		$categoria = new Categoria(
		    0,
            $var['nome'],
            $var['descricao']
        );
		$dao = new CategoriaDAO();
		$categoria = $dao->inserir($categoria);
		$response = $response->withJson($categoria);
		$response = $response->withHeader('Content-type', 'application/json');
		$response = $response->withStatus(201);
		return $response;
      }
      
    public function atualizar($request, $response, $args) {
        $id = (int) $args['id'];
        $var = $request->getParsedBody();
        $categoria = new Categoria(
            $id,
            $var['nome'],
            $var['descricao']
        );
        $dao = new CategoriaDAO;
        $dao->atualizar($categoria);
        $response = $response->withJson($categoria);
        $response = $response->withHeader('Content-type', 'application/json');
        return $response;
    }

    public function deletar($request, $response, $args) {
		$id = (int) $args['id'];
		$dao = new CategoriaDAO();
		$categoria = $dao->buscarPorId($id);
		$dao->deletar($id);
		$response = $response->withJson($categoria);
		$response = $response->withHeader('Content-type', 'application/json');
		return $response;
	}
}