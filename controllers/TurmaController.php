<?php

class TurmaController {

    public function listar($request, $response, $args) {
		$dao = new TurmaDAO();
		$lista = $dao->listar();
		$response = $response->withJson($lista);
		$response = $response->withHeader("Content-type", "application/json");
        return $response;
    }

    public function buscarPorId($request, $response, $args) {
		$id = (int) $args['id'];
		$dao = new TurmaDAO();
		$turma = $dao->buscarPorId($id);
		$response = $response->withJson($turma);
		$response = $response->withHeader('Content-type', 'application/json');    
		return $response;
    }

    public function buscarPorIdCurso($request, $response, $args) {
        $id_curso = (int) $args['id_curso'];
        $dao = new TurmaDAO();
        $turma = $dao->buscarPorIdCurso($id_curso);
        $response = $response->withJson($turma);
        $response = $response->withHeader('Content-type', 'application/json');
        return $response;
    }
      
    public function inserir($request, $response, $args) {
		$var = $request->getParsedBody();

		// Ao inserir Turma, deve inserir PROFESSOR que criou a Turma na tabela TurmaTemUsuario

		$turma = new Turma(0,
                            (int) $var['id_curso'],
							$var['nome'],
							$var['descricao'],
							$var['dth_criacao'],
							$var['imagem']
							);
		$dao = new TurmaDAO();
		$turma = $dao->inserir($turma);
		$response = $response->withJson($turma);
		$response = $response->withHeader('Content-type', 'application/json');
		$response = $response->withStatus(201);
		return $response;
      }
      
    public function atualizar($request, $response, $args) {
        $id = (int) $args['id'];
        $var = $request->getParsedBody();
				$turma = new Turma( $id,
									(int) $var['id_curso'],
									$var['nome'],
									$var['descricao'],
									$var['dth_criacao'],
									$var['imagem']
									);
        $dao = new TurmaDAO;
        $dao->atualizar($turma);
        $response = $response->withJson($turma);
        $response = $response->withHeader('Content-type', 'application/json');
        return $response;
    }

    public function deletar($request, $response, $args) {
        try {
            $id = (int) $args['id'];
            $dao = new TurmaDAO();
            $turma = $dao->buscarPorId($id);
            $dao->deletar($id);
            $response = $response->withJson($turma);
        } catch (Exception $e) {
            $response = $response->withStatus(412);
            $response = $response->withJson($e->getMessage());
        }
        $response = $response->withHeader('Content-type', 'application/json');
        return $response;
    }
}