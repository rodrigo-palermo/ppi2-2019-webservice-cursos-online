<?php
    class Turma
    {
        public $id;
        public $id_curso;
        public $nome;
        public $descricao;
        public $dth_criacao;
        public $imagem;
        
        function __construct($id,
                             $id_curso,
                             $nome,
                             $descricao,
                             $dth_criacao,
                             $imagem,
                             //fk relations
                             $curso_nome = null

        )
        {
            $this->id = $id;
            $this->id_curso = $id_curso;
            $this->nome = $nome;
            $this->descricao = $descricao;
            $this->dth_criacao = $dth_criacao;
            $this->imagem = $imagem;
            $this->curso_nome = $curso_nome;
        }
    }
?>
