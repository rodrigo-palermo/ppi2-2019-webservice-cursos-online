<?php
    class Endereco
    {
        public $id;
        public $cep;
        public $logradouro;
        public $numero;
        public $complemento;
        public $localidade;
        public $bairro;
        public $uf;

        function __construct($id,
                             $cep,
                             $logradouro,
                             $numero,
                             $complemento,
                             $localidade,
                             $bairro,
                             $uf
        )
        {
            $this->id = $id;
            $this->cep = $cep;
            $this->logradouro = $logradouro;
            $this->numero = $numero;
            $this->complemento = $complemento;
            $this->localidade = $localidade;
            $this->bairro = $bairro;
            $this->uf = $uf;
        }
    }
?>
