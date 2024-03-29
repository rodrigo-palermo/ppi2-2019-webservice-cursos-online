<?php
//	use \Psr\Http\Message\ServerRequestInterface as Request;
//	use \Psr\Http\Message\ResponseInterface as Response;
//use \controllers\ExceptionController;

require_once "header.php";

$app = new \Slim\App($config);


// criação de rota de autenticação para geração de token
// {...}  (somente gerar o token)
$app->post("/auth", "UsuarioController::autenticar");

// register
$app->post("/register", "UsuarioController::registrar");

// listar cursos existentes
$app->get("/cursosfree", "CursoController::listar");

// listar categorias existentes
$app->get("/categoriasfree", "CategoriaController::listar");

// grupo para validar token
$app->group('', function() use ($app) {

    //Perfil
    $app->group("/perfil",
        function () {
            $this->get("", "PerfilController::listar");
            $this->get("/{id:[0-9]+}", "PerfilController::buscarPorId");
            $this->post("", "PerfilController::inserir");
            $this->put("/{id:[0-9]+}", "PerfilController::atualizar");
            $this->delete("/{id:[0-9]+}", "PerfilController::deletar");
        }
    );
    //Usuario
    $app->group("/usuario",
        function () {
            $this->get("", "UsuarioController::listar");
            $this->get("/{id:[0-9]+}", "UsuarioController::buscarPorId");
            $this->post("", "UsuarioController::inserir");
            $this->put("/{id:[0-9]+}", "UsuarioController::atualizar");
            $this->delete("/{id:[0-9]+}", "UsuarioController::deletar");
        }
    );
    //Categoria
    $app->group("/categoria",
        function () {
            $this->get("", "CategoriaController::listar");
            $this->get("/{id:[0-9]+}", "CategoriaController::buscarPorId");
            $this->post("", "CategoriaController::inserir");
            $this->put("/{id:[0-9]+}", "CategoriaController::atualizar");
            $this->delete("/{id:[0-9]+}", "CategoriaController::deletar");
        }
    );
    //Curso
    $app->group("/curso",
        function () {
            $this->get("", "CursoController::listar");
            $this->get("/{id:[0-9]+}", "CursoController::buscarPorId");
            $this->post("", "CursoController::inserir");
            $this->put("/{id:[0-9]+}", "CursoController::atualizar");
            $this->delete("/{id:[0-9]+}", "CursoController::deletar");
        }
    );

    //Conteudo
    $app->group("/conteudo",
        function () {
            $this->get("", "ConteudoController::listar");
            $this->get("/{id:[0-9]+}", "ConteudoController::buscarPorId");
            $this->post("", "ConteudoController::inserir");
            $this->put("/{id:[0-9]+}", "ConteudoController::atualizar");
            $this->delete("/{id:[0-9]+}", "ConteudoController::deletar");
        }
    );
    //Turma
    $app->group("/turma",
        function () {
            $this->get("", "TurmaController::listar");
            $this->get("/{id:[0-9]+}", "TurmaController::buscarPorId");
            $this->post("", "TurmaController::inserir");
            $this->put("/{id:[0-9]+}", "TurmaController::atualizar");
            $this->delete("/{id:[0-9]+}", "TurmaController::deletar");
        }
    );
    //TurmaTemUsuario
    $app->group("/turmatemusuario",
        function () {
            $this->get("", "TurmaTemUsuarioController::listar");
            $this->get("/{id:[0-9]+}", "TurmaTemUsuarioController::buscarPorId");
            $this->get("/turma/{id_turma:[0-9]+}", "TurmaTemUsuarioController::buscarPorTurmaId");
            $this->post("", "TurmaTemUsuarioController::inserir");
            $this->put("/{id:[0-9]+}", "TurmaTemUsuarioController::atualizar");
            $this->delete("/{id:[0-9]+}", "TurmaTemUsuarioController::deletar");
        }
    );
    //UsuarioPerfil
    $app->group("/usuarioperfil",
        function () {
            $this->get("/{id:[0-9]+}", "UsuarioController::buscarPerfilPorIdUsuario");
        }
    );

    //CursosDoProfessor
    $app->group("/cursosdoprofessor",
        function () {
            $this->get("/{id_usuario_criacao:[0-9]+}", "CursoController::buscarPorIdUsuarioCriacao");
        }
    );

    //TurmasDoCurso
    $app->group("/turmasdocurso",
        function () {
            $this->get("/{id_curso:[0-9]+}", "TurmaController::buscarPorIdCurso");
        }
    );

    //UsuariosPorPefil
    $app->group("/usuariosporperfil",
        function () {
            $this->get("/{perfil:[a-zA-Z0-9]+}", "UsuarioController::buscarPorPerfil");
        }
    );

    //com validacao de token
})->add("UsuarioController::validarToken");
    //ou sem validacao para testes
// });
	$app->run();

?>