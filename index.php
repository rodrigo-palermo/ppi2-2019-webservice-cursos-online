<?php
	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;

	require_once "vendor/autoload.php";
	require_once "db/PDOFactory.php";
	require_once "class/Perfil.php";
	require_once "dao/PerfilDAO.php";
	require_once "controllers/PerfilController.php";

	$config = [ //
		'settings' => [
			'displayErrorDetails' => true,
			'addContentLengthHeader' => false,  //usar em caso de erro desconhecido
		]
	
	];

	$app = new \Slim\App($config);

	//chamadas individuais
	//Controllers e rotas para o webservice
	/*$app->get("/perfil",  "PerfilController::listar");
  	$app->get('/perfil/{id}', "PerfilController::buscarPorId");
  	$app->post('/perfil', "PerfilController::inserir");
  	$app->put('/perfil/{id}', "PerfilController::atualizar");
	$app->delete('/perfil/{id}', "PerfilController::deletar");*/

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

	$app->run();
?>