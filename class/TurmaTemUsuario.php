<?php
    class TurmaTemUsuario
    {
        public $id;
        public $id_turma;
        public $id_usuario;
        public $turma_nome;
        public $usuario_nome;
        public $usuario_perfil_id;
        public $usuario_perfil_nome;
        public $curso_id;
        public $curso_nome;

        function __construct($id,
                             $id_turma,
                             $id_usuario,
                             //fk relations
                             $turma_nome = null,
                             $usuario_nome = null,
                             $usuario_perfil_id = null,
                             $usuario_perfil_nome = null,
                             $curso_id = null,
                             $curso_nome = null
        )
        {
            $this->id = $id;
            $this->id_turma = $id_turma;
            $this->id_usuario = $id_usuario;
            $this->turma_nome = $turma_nome;
            $this->usuario_nome = $usuario_nome;
            $this->usuario_perfil_id = usuario_perfil_id;
            $this->usuario_perfil_nome = $usuario_perfil_nome;
            $this->curso_id = $curso_id;
            $this->curso_nome = $curso_nome;

        }
    }
?>
