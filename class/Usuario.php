<?php
    class Usuario
    {
        public $id;
        public $id_perfil;
        public $nome;
        public $email;
        public $senha;
        public $dth_inscricao;
        public $imagem;
        
        function __construct($id, $id_perfil, $nome, $email, $senha, $dth_inscricao, $imagem)
        {
            $this->id = $id;
            $this->id_perfil = $id_perfil;
            $this->nome = $nome;
            $this->email = $email;
            $this->senha = $senha;
            $this->dth_inscricao = $dth_inscricao;
            $this->imagem = $imagem;
        }
    }
?>