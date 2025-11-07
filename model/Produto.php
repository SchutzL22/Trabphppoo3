<?php
class Produto {
    private $conn;
    private $table = 'produtos';

    public $id;
    public $nome;
    public $descricao;
    public $preco;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function listar() {
        $query = "SELECT id, nome, descricao, preco FROM {$this->table} ORDER BY nome";
        return $this->conn->prepare($query)->execute() ? $this->conn->query($query) : false;
    }

    public function criar() {
        $query = "INSERT INTO {$this->table} (nome, descricao, preco) VALUES (:nome, :descricao, :preco)";
        $stmt = $this->conn->prepare($query);
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->descricao = htmlspecialchars(strip_tags($this->descricao));
        $this->preco = htmlspecialchars(strip_tags($this->preco));
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':descricao', $this->descricao);
        $stmt->bindParam(':preco', $this->preco);
        return $stmt->execute();
    }

    public function buscarPorId() {
        $query = "SELECT nome, descricao, preco FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $this->nome = $row['nome'];
            $this->descricao = $row['descricao'];
            $this->preco = $row['preco'];
            return true;
        }
        return false;
    }

    public function atualizar() {
        $query = "UPDATE {$this->table} SET nome=:nome, descricao=:descricao, preco=:preco WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->descricao = htmlspecialchars(strip_tags($this->descricao));
        $this->preco = htmlspecialchars(strip_tags($this->preco));
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':descricao', $this->descricao);
        $stmt->bindParam(':preco', $this->preco);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }

    public function excluir() {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }
}
?>