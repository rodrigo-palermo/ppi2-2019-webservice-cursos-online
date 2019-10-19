<?php


//namespace exceptions;
//use \Psr\Http\Message\ServerRequestInterface as Request;
//use \Psr\Http\Message\ResponseInterface as Response;

class WsException extends \Exception
{
    public $http_status;
    public $response;
    public $arrCodeMessage = [
        404 => 'Não existem dados para o id informado.',
        500 => 'teste'
    ];

    public function __construct($code = 0, $response, $message = null, Exception $previous = null) {

        parent::__construct($message, $code, $previous);

        $this->http_status = $code;

        $response = $response->withJson([
            'error' => WsException::class,
            'status' => $this->http_status,
//            'code' => $this->getCode(),
            'userMessage' => $this->getWsMessage($code)
        ], $this->http_status);
        $this->response = $response;
    }

    private function getWsMessage($code)
    {
        return $this->arrCodeMessage[$code];
    }

//    public function __toString() {
//
//        return
//}




}