<?php
	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;

	include 'header.php';

	$app = new \Slim\App($config);

	// criação de rota de autenticação para geração de token
	// {...}  (somente gerar o token)
	#$app->post("/auth", "UsuarioController:autenticar");

	//chamada agrupada
	$app->group("/perfil",
	function() {
		$this->get("", "PerfilController::listar");
  		$this->get("/{id:[0-9]+}", "PerfilController::buscarPorId");
  		$this->post("", "PerfilController::inserir");
  		$this->put("/{id:[0-9]+}", "PerfilController::atualizar");
		$this->delete("/{id:[0-9]+}", "PerfilController::deletar");
		}
	);

	$app->group("/usuario",
	function() {
		$this->get("", "UsuarioController::listar");
  		$this->get("/{id:[0-9]+}", "UsuarioController::buscarPorId");
  		$this->post("", "UsuarioController::inserir");
  		$this->put("/{id:[0-9]+}", "UsuarioController::atualizar");
		$this->delete("/{id:[0-9]+}", "UsuarioController::deletar");
		}
	);

	$app->run();
?>