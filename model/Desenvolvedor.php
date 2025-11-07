<?php
require_once 'Funcionario.php';

class Desenvolvedor extends Funcionario {

    public function __construct($db) {
        parent::__construct($db);
        $this->tipo = 'desenvolvedor';
    }
    
    public function getBonificacao() {
        return $this->getSalario() * 0.10;
    }
}
?>