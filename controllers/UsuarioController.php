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
                $perfil = UsuarioDAO::buscarPerfilPorLogin($usuario->nome);
                return $resp->withJson(["id"=> $usuario->id,
                                        "nome"=> $usuario->nome,
                                        "perfil" => $perfil,
                                        "token" => $token], 201)
                    ->withHeader("Content-type", "application/json");

            } else {
                return $resp->withJson(['errorMessage'=>'Usuário e/ou Senha incorretos'])
                            ->withStatus(401);
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

    public function registrar($req, $resp, $args)
    {
        $var = $req->getParsedBody();

        $usuarioDao = new UsuarioDao();
        $usuario = $usuarioDao->buscarPorLogin($var['nome']);

        if($usuario == true) {
            // Nome de usuario existente
            return $resp->withStatus(401);
        } else {
            $endereco = new Endereco(0,
                (int) $var['cep'],
                $var['logradouro'],
                (int) $var['numero'],
                $var['complemento'],
                $var['localidade'],
                $var['bairro'],
                $var['uf']
            );
            $enderecoDao = new EnderecoDao();
            $endereco_id_last_inserted = $enderecoDao->inserir($endereco);
//            $pdo = PDOFactory::getConexao();
//            $id_endereco = $pdo->lastInsertId();



            $usuario = new Usuario(0,
                (int) $var['id_perfil'],
                $var['nome'],
                $var['email'],
                $var['senha'],
                $var['dth_inscricao'],
                $var['imagem'],
                $endereco_id_last_inserted
            );
            $usuarioDao->inserir($usuario);

            $resp = $resp->withHeader('Content-type', 'application/json');
            $resp = $resp->withStatus(201);
            return $resp;
        }
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

//    public function buscarPerfilPorIdUsuario($request, $response, $args) {
//		$id = (int) $args['id'];
//		$dao = new UsuarioDAO();
//		$usuario = $dao->buscarPorId($id);
//		$id_perfil = $usuario->id_perfil;
//		$daoPerfil = new PerfilDAO();
//		$perfil = $daoPerfil->buscarPorId($id_perfil);
//		$perfilNome = $perfil->nome;
//		$response = $response->withJson($perfilNome);
//		$response = $response->withHeader('Content-type', 'application/json');
//		return $response;
//      }

    public function inserir($request, $response, $args) {
		$var = $request->getParsedBody();
		$usuario = new Usuario(0,(int) $var['id_perfil'],
														 $var['nome'],
														 $var['email'],
														 $var['senha'],
														 $var['dth_inscricao'],
														 $var['imagem'],
														 $var['id_endereco']
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
        try {
            $id = (int)$args['id'];
            $dao = new UsuarioDAO();
            $usuario = $dao->buscarPorId($id);
            $dao->deletar($id);
            $response = $response->withJson($usuario);
        } catch (Exception $e) {
            $response = $response->withStatus(412);
            $response = $response->withJson($e->getMessage());
        }
        $response = $response->withHeader('Content-type', 'application/json');
		return $response;
	}

    public function buscarPorPerfil($request, $response, $args) {
        $perfil = $args['perfil'];
        $dao = new UsuarioDAO();
        $lista = $dao->buscarPorPerfil($perfil);
        $response = $response->withJson($lista);
        $response = $response->withHeader("Content-type", "application/json");
        return $response;
    }
}