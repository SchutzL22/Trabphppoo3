<?php
require_once 'model/Produto.php';

class ProdutoController {
    private $produto;

    public function __construct($db) {
        $this->produto = new Produto($db);
    }

    public function listar() {
        $produtos = $this->produto->listar();
        include 'view/listar.php';
    }

    public function criar() {
        if ($_POST) {
            $this->produto->nome = $_POST['nome'];
            $this->produto->descricao = $_POST['descricao'];
            $this->produto->preco = $_POST['preco'];
            if ($this->produto->criar()) {
                header("Location: index.php?msg=criado");
                exit;
            } else {
                $erro = "Erro ao salvar.";
            }
        }
        include 'view/criar.php';
    }

    public function editar() {
        $this->produto->id = $_GET['id'] ?? null;
        if (!$this->produto->id || !$this->produto->buscarPorId()) {
            die("Produto não encontrado.");
        }

        if ($_POST) {
            $this->produto->nome = $_POST['nome'];
            $this->produto->descricao = $_POST['descricao'];
            $this->produto->preco = $_POST['preco'];
            $this->produto->id = $_POST['id'];
            if ($this->produto->atualizar()) {
                header("Location: index.php?msg=atualizado");
                exit;
            } else {
                $erro = "Erro ao atualizar.";
            }
        }
        include 'view/editar.php';
    }

    public function excluir() {
        $this->produto->id = $_GET['id'] ?? null;
        if ($this->produto->id && $this->produto->excluir()) {
            header("Location: index.php?msg=excluido");
        } else {
            header("Location: index.php?erro=excluir");
        }
        exit;
    }
}
?>