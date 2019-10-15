<?php
    class Categoria
    {
        public $id;
        public $nome;

        function __construct($id, $nome, $descricao)
        {
            $this->id = $id;
            $this->nome = $nome;
            $this->descricao = $descricao;
        }
    }
?>
