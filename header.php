<?php

require_once "vendor/autoload.php";
require_once "db/PDOFactory.php";
// require_once "class/Perfil.php";
// require_once "dao/PerfilDAO.php";
// require_once "controllers/PerfilController.php";

// require_once "class/Usuario.php";
// require_once "dao/UsuarioDAO.php";
// require_once "controllers/UsuarioController.php";

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


$config = [ //
    'settings' => [
        'displayErrorDetails' => true,
        'addContentLengthHeader' => false,  //usar em caso de erro desconhecido
    ]

];	