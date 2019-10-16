<?php
// conexao com banco de dados
require_once "db/PDOFactory.php";

// classes
//require_once "class/Perfil.php";
//require_once "dao/PerfilDAO.php";
//require_once "controllers/PerfilController.php";
//
//require_once "class/Usuario.php";
//require_once "dao/UsuarioDAO.php";
//require_once "controllers/UsuarioController.php";
//
//require_once "class/Curso.php";
//require_once "dao/CursoDAO.php";
//require_once "controllers/CursoController.php";
//
//require_once "class/Categoria.php";
//require_once "dao/CategoriaDAO.php";
//require_once "controllers/CategoriaController.php";
//
//require_once "class/Turma.php";
//require_once "dao/TurmaDAO.php";
//require_once "controllers/TurmaController.php";
//
//require_once "class/Conteudo.php";
//require_once "dao/ConteudoDAO.php";
//require_once "controllers/ConteudoController.php";
//
//require_once "class/TurmaTemUsuario.php";
//require_once "dao/TurmaTemUsuarioDAO.php";
//require_once "controllers/TurmaTemUsuarioController.php";

//autoload de classes nas pastas class, controller e dao
spl_autoload_register( function($className){
    try {
        if(substr($className,-3) == 'DAO')
            require_once __DIR__.'/dao/'.$className.'.php';
        else if(substr($className,-10) == 'Controller')
            require_once __DIR__.'/controllers/'.$className.'.php';
        else
            require_once __DIR__.'/class/'.$className.'.php';

    } catch (Exception $e) {
        print $e->getMessage();
    }
});

// autoload do Slim
require_once "vendor/autoload.php";

$config = [ //
    'settings' => [
        'displayErrorDetails' => true,
        'addContentLengthHeader' => false,  //usar em caso de erro desconhecido
    ]

];	