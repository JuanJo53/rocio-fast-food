<?php
    class DB{
        private $sever;
        private $user;
        private $password;
        private $db;

        public function __construct(){
            $this->server = 'localhost';
            $this->user = 'root';
            $this->password = '';
            $this->db = 'rocio_fast_food';
        }

        public function connect(){
            $conn = new mysqli($this->server,$this->user,$this->password,$this->db);
            return $conn;
        }
    }
?>