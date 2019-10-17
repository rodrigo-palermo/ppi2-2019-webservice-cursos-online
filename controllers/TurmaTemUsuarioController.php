<?php

class TurmaTemUsuarioController {

    public function listar($request, $response, $args) {
		$dao = new TurmaTemUsuarioDAO();
		$lista = $dao->listar();
		$response = $response->withJson($lista);
		$response = $response->withHeader("Content-type", "application/json");
        return $response;
    }

    public function buscarPorId($request, $response, $args) {
		$id = (int) $args['id'];
		$dao = new TurmaTemUsuarioDAO();
		$turmatemusuario = $dao->buscarPorId($id);
		$response = $response->withJson($turmatemusuario);
		$response = $response->withHeader('Content-type', 'application/json');    
		return $response;
      }
      
    public function inserir($request, $response, $args) {
		$var = $request->getParsedBody();

		// turma deve ser criada com somente um usuario PROFESSOR na classe Turma
        // se turma existe, banco verifica se ALUNO já está matriculado nesta turma(constrain unique)

		$turmatemusuario = new TurmaTemUsuario(0,
            (int) $var['id_turma'],
            (int) $var['id_usuario']
							);
		$dao = new TurmaTemUsuarioDAO();
		$turmatemusuario = $dao->inserir($turmatemusuario);
		$response = $response->withJson($turmatemusuario);
		$response = $response->withHeader('Content-type', 'application/json');
		$response = $response->withStatus(201);
		return $response;
      }
      
    public function atualizar($request, $response, $args) {
        $id = (int) $args['id'];
        $var = $request->getParsedBody();
				$turmatemusuario = new TurmaTemUsuario($id,
                    (int) $var['id_turma'],
                    (int) $var['id_usuario']
									);
        $dao = new TurmaTemUsuarioDAO;
        $dao->atualizar($turmatemusuario);
        $response = $response->withJson($turmatemusuario);
        $response = $response->withHeader('Content-type', 'application/json');
        return $response;
    }

    public function deletar($request, $response, $args) {
		$id = (int) $args['id'];
		$dao = new TurmaTemUsuarioDAO();
		$turmatemusuario = $dao->buscarPorId($id);
		$dao->deletar($id);
		$response = $response->withJson($turmatemusuario);
		$response = $response->withHeader('Content-type', 'application/json');
		return $response;
	}
}