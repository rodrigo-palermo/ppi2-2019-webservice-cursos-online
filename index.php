<?php
//	use \Psr\Http\Message\ServerRequestInterface as Request;
//	use \Psr\Http\Message\ResponseInterface as Response;
//use \controllers\ExceptionController;

require_once "header.php";

$app = new \Slim\App($config);


// criação de rota de autenticação para geração de token
// {...}  (somente gerar o token)
$app->post("/auth", "UsuarioController::autenticar");

// grupo para validar token
$app->group('', function() use ($app) {

    //Perfil
    $app->group("/perfil",
        function() {
            $this->get("", "PerfilController::listar");
            $this->get("/{id:[0-9]+}", "PerfilController::buscarPorId");
            $this->post("", "PerfilController::inserir");
            $this->put("/{id:[0-9]+}", "PerfilController::atualizar");
            $this->delete("/{id:[0-9]+}", "PerfilController::deletar");
        }
    );
    //Usuario
    $app->group("/usuario",
        function() {
            $this->get("", "UsuarioController::listar");
            $this->get("/{id:[0-9]+}", "UsuarioController::buscarPorId");
            $this->post("", "UsuarioController::inserir");
            $this->put("/{id:[0-9]+}", "UsuarioController::atualizar");
            $this->delete("/{id:[0-9]+}", "UsuarioController::deletar");
        }
    );
    //Categoria
    $app->group("/categoria",
        function() {
            $this->get("", "CategoriaController::listar");
            $this->get("/{id:[0-9]+}", "CategoriaController::buscarPorId");
            $this->post("", "CategoriaController::inserir");
            $this->put("/{id:[0-9]+}", "CategoriaController::atualizar");
            $this->delete("/{id:[0-9]+}", "CategoriaController::deletar");
        }
    );
    //Curso
    $app->group("/curso",
        function() {
            $this->get("", "CursoController::listar");
            $this->get("/{id:[0-9]+}", "CursoController::buscarPorId");
            $this->post("", "CursoController::inserir");
            $this->put("/{id:[0-9]+}", "CursoController::atualizar");
            $this->delete("/{id:[0-9]+}", "CursoController::deletar");
        }
    );

    //Conteudo
    $app->group("/conteudo",
        function() {
            $this->get("", "ConteudoController::listar");
            $this->get("/{id:[0-9]+}", "ConteudoController::buscarPorId");
            $this->post("", "ConteudoController::inserir");
            $this->put("/{id:[0-9]+}", "ConteudoController::atualizar");
            $this->delete("/{id:[0-9]+}", "ConteudoController::deletar");
        }
    );
    //Turma
    $app->group("/turma",
        function() {
            $this->get("", "TurmaController::listar");
            $this->get("/{id:[0-9]+}", "TurmaController::buscarPorId");
            $this->post("", "TurmaController::inserir");
            $this->put("/{id:[0-9]+}", "TurmaController::atualizar");
            $this->delete("/{id:[0-9]+}", "TurmaController::deletar");
        }
    );
    //TurmaTemUsuario
    $app->group("/turmatemusuario",
        function() {
            $this->get("", "TurmaTemUsuarioController::listar");
            $this->get("/{id:[0-9]+}", "TurmaTemUsuarioController::buscarPorId");
            $this->get("/turma/{id_turma:[0-9]+}", "TurmaTemUsuarioController::buscarPorTurmaId");
            $this->post("", "TurmaTemUsuarioController::inserir");
            $this->put("/{id:[0-9]+}", "TurmaTemUsuarioController::atualizar");
            $this->delete("/{id:[0-9]+}", "TurmaTemUsuarioController::deletar");
        }
    );

})->add("UsuarioController::validarToken");

	$app->run();

?>