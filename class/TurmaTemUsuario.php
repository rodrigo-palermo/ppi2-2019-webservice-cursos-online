<?php
    class TurmaTemUsuario
    {
        public $id;
        public $id_turma;
        public $id_usuario;
        
        function __construct($id, $id_turma, $id_usuario)
        {
            $this->id = $id;
            $this->id_turma = $id_turma;
            $this->id_usuario = $id_usuario;

        }
    }
?>
