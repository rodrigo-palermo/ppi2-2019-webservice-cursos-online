<?php

class PerfilController {

    public function listar($request, $response, $args) {
		$dao = new PerfilDAO();
		$lista = $dao->listar();
		$response = $response->withJson($lista);
		$response = $response->withHeader("Content-type", "application/json");
        return $response;
    }

    public function buscarPorId($request, $response, $args) {
		$id = (int) $args['id'];
		$dao = new PerfilDAO();
		$perfil = $dao->buscarPorId($id);
		$response = $response->withJson($perfil);
		$response = $response->withHeader('Content-type', 'application/json');    
		return $response;
      }
      
    public function inserir($request, $response, $args) {
		$var = $request->getParsedBody();
		$perfil = new Perfil(0,$var['nome']);
		$dao = new PerfilDAO();
		$perfil = $dao->inserir($perfil);
		$response = $response->withJson($perfil);
		$response = $response->withHeader('Content-type', 'application/json');
		$response = $response->withStatus(201);
		return $response;
      }
      
    public function atualizar($request, $response, $args) {
        $id = (int) $args['id'];
        $var = $request->getParsedBody();
        $perfil = new Perfil($id,$var['nome']);
        $dao = new PerfilDAO;
        $dao->atualizar($perfil);
        $response = $response->withJson($perfil);
        $response = $response->withHeader('Content-type', 'application/json');
        return $response;
    }

    public function deletar($request, $response, $args) {
		$id = (int) $args['id'];
		$dao = new PerfilDAO();
		$perfil = $dao->buscarPorId($id);
		$dao->deletar($id);
		$response = $response->withJson($perfil);
		$response = $response->withHeader('Content-type', 'application/json');
		return $response;
	}
}