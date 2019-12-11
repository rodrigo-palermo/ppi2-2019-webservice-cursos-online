<?php
    class Curso
    {
        public $id;
        public $id_categoria;
        public $id_usuario_criacao;
        public $nome;
        public $descricao;
        public $dth_criacao;
        public $imagem;
        public $categoria_nome;
        public $usuario_criacao_nome;

        function __construct($id,
                             $id_categoria,
                             $id_usuario_criacao,
                             $nome,
                             $descricao,
                             $dth_criacao,
                             $imagem,
                             //fk relations
                             $categoria_nome = null,
                             $usuario_criacao_nome = null
        )
        {
            $this->id = $id;
            $this->id_categoria = $id_categoria;
            $this->id_usuario_criacao = $id_usuario_criacao;
            $this->nome = $nome;
            $this->descricao = $descricao;
            $this->dth_criacao = $dth_criacao;
            $this->imagem = $imagem;
            $this->categoria_nome = $categoria_nome;
            $this->usuario_criacao_nome = $usuario_criacao_nome;
        }
    }
?>
