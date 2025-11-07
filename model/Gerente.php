<?php
require_once 'Funcionario.php';

class Gerente extends Funcionario {
    
    public function __construct($db) {
        parent::__construct($db);
        $this->tipo = 'gerente';
    }

    public function getBonificacao() {
        return $this->getSalario() * 0.20;
    }
}
?>