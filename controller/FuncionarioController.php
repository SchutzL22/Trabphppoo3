<?php
require_once 'model/Gerente.php';
require_once 'model/Desenvolvedor.php';

class FuncionarioController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function listar() {
        $funcionarios = Funcionario::listarTodos($this->db);
        include 'view/listar.php';
    }

    public function criar() {
        if ($_POST) {
            $tipo = $_POST['tipo'] ?? '';
            $funcionario = null;

            if ($tipo == 'gerente') {
                $funcionario = new Gerente($this->db);
            } else if ($tipo == 'desenvolvedor') {
                $funcionario = new Desenvolvedor($this->db);
            }

            if ($funcionario) {
                $funcionario->nome = $_POST['nome'];
                $funcionario->salario = $_POST['salario'];
                
                if ($funcionario->salvar()) {
                    header("Location: index.php?msg=criado");
                    exit;
                } else {
                    $erro = "Erro ao salvar.";
                }
            } else {
                $erro = "Tipo de funcionário inválido.";
            }
        }
        include 'view/criar.php';
    }

    public function editar() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            die("ID não fornecido.");
        }

        $funcionario = Funcionario::buscarPorId($this->db, $id);
        if (!$funcionario) {
            die("Funcionário não encontrado.");
        }

        if ($_POST) {
            $tipo = $_POST['tipo'];
            $funcionarioAtualizado = null;

            if ($tipo == 'gerente') {
                $funcionarioAtualizado = new Gerente($this->db);
            } else if ($tipo == 'desenvolvedor') {
                $funcionarioAtualizado = new Desenvolvedor($this->db);
            }

            if ($funcionarioAtualizado) {
                $funcionarioAtualizado->id = $_POST['id'];
                $funcionarioAtualizado->nome = $_POST['nome'];
                $funcionarioAtualizado->salario = $_POST['salario'];

                if ($funcionarioAtualizado->atualizar()) {
                    header("Location: index.php?msg=atualizado");
                    exit;
                } else {
                    $erro = "Erro ao atualizar.";
                }
            } else {
                 $erro = "Tipo inválido ao atualizar.";
            }
        }
        
        include 'view/editar.php';
    }

    public function excluir() {
        $id = $_GET['id'] ?? null;
        if ($id && Funcionario::excluir($this->db, $id)) {
            header("Location: index.php?msg=excluido");
        } else {
            header("Location: index.php?erro=excluir");
        }
        exit;
    }
}
?>