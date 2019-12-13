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

    public function listarAlunosDaTurma($request, $response, $args) {
        $id = (int) $args['id'];
        $dao = new TurmaTemUsuarioDAO();
        $lista = $dao->listarAlunosDaTurma($id);
        $response = $response->withJson($lista);
        $response = $response->withHeader("Content-type", "application/json");
        return $response;
    }

    public function listarAlunosHabilitadosParaTurma($request, $response, $args) {
        $id = (int) $args['id'];
        $dao = new TurmaTemUsuarioDAO();
        $lista = $dao->listarAlunosHabilitadosParaTurma($id);
        $response = $response->withJson($lista);
        $response = $response->withHeader("Content-type", "application/json");
        return $response;
    }

    public function buscarPorTurmaId($request, $response, $args) {
		$id_turma = (int) $args['id_turma'];
		$dao = new TurmaTemUsuarioDAO();
		$turmatemusuario = $dao->buscarPorTurmaId($id_turma);
//        $alunosPorTurma = [];
//		foreach ($turmatemusuario as $turma){
//            $alunosPorTurma[] = $turma->id_aluno;
//        }
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

//    public function deletar($request, $response, $args) {
//        try{
//            $id = (int) $args['id'];
//            $dao = new TurmaTemUsuarioDAO();
//            $turmatemusuario = $dao->buscarPorId($id);
//            $dao->deletar($id);
//            $response = $response->withJson($turmatemusuario);
//        } catch (Exception $e) {
//            $response = $response->withStatus(412);
//            $response = $response->withJson($e->getMessage());
//        }
//        $response = $response->withHeader('Content-type', 'application/json');
//        return $response;
//    }

    public function deletar($request, $response, $args) {
        $var = $request->getParsedBody();

        // turma deve ser criada com somente um usuario PROFESSOR na classe Turma
        // se turma existe, banco verifica se ALUNO já está matriculado nesta turma(constrain unique)

        $turmatemusuario = new TurmaTemUsuario(0,
            (int) $var['id_turma'],
            (int) $var['id_usuario']
        );
        $dao = new TurmaTemUsuarioDAO();
        $turmatemusuario = $dao->deletar($turmatemusuario);
        $response = $response->withJson($turmatemusuario);
        $response = $response->withHeader('Content-type', 'application/json');
        $response = $response->withStatus(201);
        return $response;
    }
}