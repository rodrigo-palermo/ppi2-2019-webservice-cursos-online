<?php
class PDOFactory {

    private static $pdo;

    // método estático para criação de conexão
    public static function getConexao() {

        #heroku
        if (getenv('DATABASE_URL')) {
            $database_url = getenv('DATABASE_URL');
        } else {
            # work develop database config 20191010
            $database_url = 'postgres://postgres:admin@localhost:5432/ci_cursos';
            # class develop database config 20191010
            //$database_url = 'postgres://postgres:postgresql@localhost:5432/ci_cursos';
        }
        $url = parse_url($database_url);
        $url["path"] = ltrim($url["path"], "/");

        $hostname = $url["host"];
	    $port = $url["port"];
	    $username = $url["user"];
	    $password = $url["pass"];
	    $database = $url["path"];

        if(!isset($pdo)) {
            /* usando o construtor do PDO devemos sempre adicionar a string
            relativa ao Sistema Gerenciador de Banco de Dados (SGBD) a ser utilizado */
            //              banco:host=nomehost;dbname=nomedobanco  usuário senha
            #$pdo = new PDO("mysql:host=localhost;dbname=ci_cursos","root", "");
            # class develop database config 20191010
            //$pdo = new PDO('pgsql:host=localhost;port=5432;dbname=ci_cursos', 'postgres', 'postgresql');
            # work develop database config 20191010
            //$pdo = new PDO('pgsql:host=localhost;port=5432;dbname=ci_cursos', 'postgres', 'admin');

            $pdo = new PDO('pgsql:host='.$hostname.';port='.$port.';dbname='.$database, $username, $password);
            // indicação de atributos de inicialização da conexão com o SGBD
            // reportar erros relativos ao controle de exceção
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // indicação do modo padrão de retorno dos dados
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            // conversão de valores numéricos para strings no retorno 
            $pdo->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
            // emulação do "prepared statements"
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }
        return $pdo;
    }
}
?>