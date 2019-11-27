<?php
use \Firebase\JWT\JWT;

class UsuarioController {

    private static $secretKey = "s3cr3t";

    public function autenticar($req, $resp, $args)
    {
        $var = $req->getParsedBody();

        $dao = new UsuarioDao();
        $usuario = $dao->buscarPorLogin($var['nome']);

        if($usuario == false) {
            return $resp->withStatus(401);
        } else {
            if($usuario->senha == $var['senha']) {
                #carrega (carga) o conteudo do token
                $tokenpayload = array(  #nao usar dados sensíveis. Sendo id e nome únicos no banco, cada token será diferente
                    "usuario_id" => $usuario->id,
                    "usuario_nome" => $usuario->nome,
                );
                $token = JWT::encode($tokenpayload, UsuarioController::$secretKey);

                return $resp->withJson(["token" => $token], 201)
                    ->withHeader("Content-type", "application/json");

            } else {
                return $resp->withStatus(401);
            }

        }
    }

    public function validarToken($req, $resp, $next)
    {
        $token = str_replace("Bearer ", "", $req->getHeader('Authorization')[0]);

        if($token) {
            try {
                #decodificando (conforme o validador online da JWT faz)
                $decoded = JWT::decode($token, UsuarioController::$secretKey, array("HS256"));
                if($decoded)
                    return($next($req, $resp));

            } catch(Exception $error) {
                return $resp->withStatus(401);
            }
        }

        return $resp->withStatus(401);
    }

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