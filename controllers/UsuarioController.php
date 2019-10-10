<?php

class UsuarioController {

    public function listar($request, $response, $args) {
		$dao = new UsuarioDAO();
		$lista = $dao->listar();
		$response = $response->withJson($lista);
		$response = $response->withHeader("Content-type", "application/json");
        return $response;
    }

    public function buscarPorId($request, $response, $args) {
		$id = (int) $args['id'];
		$dao = new UsuarioDAO();
		$usuario = $dao->buscarPorId($id);
		$response = $response->withJson($usuario);
		$response = $response->withHeader('Content-type', 'application/json');    
		return $response;
      }
      
    public function inserir($request, $response, $args) {
		$var = $request->getParsedBody();
		$usuario = new Usuario(0,(int) $var['id_perfil'],
														 $var['nome'],
														 $var['email'],
														 $var['senha'],
														 $var['dth_inscricao'],
														 $var['imagem']
													);
		$dao = new UsuarioDAO();
		$usuario = $dao->inserir($usuario);
		$response = $response->withJson($usuario);
		$response = $response->withHeader('Content-type', 'application/json');
		$response = $response->withStatus(201);
		return $response;
      }
      
    public function atualizar($request, $response, $args) {
        $id = (int) $args['id'];
        $var = $request->getParsedBody();
				$usuario = new Usuario($id,
															(int) $var['id_perfil'],
														  $var['nome'],
														  $var['email'],
														  $var['senha'],
														  $var['dth_inscricao'],
														  $var['imagem']
														  );
        $dao = new UsuarioDAO;
        $dao->atualizar($usuario);
        $response = $response->withJson($usuario);
        $response = $response->withHeader('Content-type', 'application/json');
        return $response;
    }

    public function deletar($request, $response, $args) {
		$id = (int) $args['id'];
		$dao = new UsuarioDAO();
		$usuario = $dao->buscarPorId($id);
		$dao->deletar($id);
		$response = $response->withJson($usuario);
		$response = $response->withHeader('Content-type', 'application/json');
		return $response;
	}
}