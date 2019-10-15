<?php

class CursoController {

    public function listar($request, $response, $args) {
		$dao = new CursoDAO();
		$lista = $dao->listar();
		$response = $response->withJson($lista);
		$response = $response->withHeader("Content-type", "application/json");
        return $response;
    }

    public function buscarPorId($request, $response, $args) {
		$id = (int) $args['id'];
		$dao = new CursoDAO();
		$curso = $dao->buscarPorId($id);
		$response = $response->withJson($curso);
		$response = $response->withHeader('Content-type', 'application/json');    
		return $response;
      }
      
    public function inserir($request, $response, $args) {
		$var = $request->getParsedBody();
		$curso = new Curso(0,
                            (int) $var['id_categoria'],
                            $var['id_usuario_criacao'],
							$var['nome'],
							$var['descricao'],
							$var['dth_criacao'],
							$var['imagem']
							);
		$dao = new CursoDAO();
		$curso = $dao->inserir($curso);
		$response = $response->withJson($curso);
		$response = $response->withHeader('Content-type', 'application/json');
		$response = $response->withStatus(201);
		return $response;
      }
      
    public function atualizar($request, $response, $args) {
        $id = (int) $args['id'];
        $var = $request->getParsedBody();
				$curso = new Curso( $id,
									(int) $var['id_categoria'],
                                    (int) $var['id_usuario_criacao'],
									$var['nome'],
									$var['descricao'],
									$var['dth_criacao'],
									$var['imagem']
									);
        $dao = new CursoDAO;
        $dao->atualizar($curso);
        $response = $response->withJson($curso);
        $response = $response->withHeader('Content-type', 'application/json');
        return $response;
    }

    public function deletar($request, $response, $args) {
		$id = (int) $args['id'];
		$dao = new CursoDAO();
		$curso = $dao->buscarPorId($id);
		$dao->deletar($id);
		$response = $response->withJson($curso);
		$response = $response->withHeader('Content-type', 'application/json');
		return $response;
	}
}