<?php
abstract class Funcionario {
    protected $conn;
    private static $table = 'funcionarios';

    public $id;
    public $nome;
    public $salario;
    public $tipo;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getSalario() {
        return $this->salario;
    }

    abstract public function getBonificacao();

    public function getSalarioTotal() {
        return $this->getSalario() + $this->getBonificacao();
    }

    public static function listarTodos($db) {
        $query = "SELECT id, nome, salario, tipo FROM " . self::$table . " ORDER BY nome";
        $stmt = $db->prepare($query);
        $stmt->execute();
        
        $funcionarios = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $funcionario = null;
            if ($row['tipo'] == 'gerente') {
                $funcionario = new Gerente($db);
            } else if ($row['tipo'] == 'desenvolvedor') {
                $funcionario = new Desenvolvedor($db);
            }

            if ($funcionario) {
                $funcionario->id = $row['id'];
                $funcionario->nome = $row['nome'];
                $funcionario->salario = $row['salario'];
                $funcionario->tipo = $row['tipo'];
                $funcionarios[] = $funcionario;
            }
        }
        return $funcionarios;
    }

    public function salvar() {
        $query = "INSERT INTO " . self::$table . " (nome, salario, tipo) VALUES (:nome, :salario, :tipo)";
        $stmt = $this->conn->prepare($query);

        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->salario = htmlspecialchars(strip_tags($this->salario));
        $this->tipo = htmlspecialchars(strip_tags($this->tipo));

        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':salario', $this->salario);
        $stmt->bindParam(':tipo', $this->tipo);

        return $stmt->execute();
    }

    public static function buscarPorId($db, $id) {
        $query = "SELECT id, nome, salario, tipo FROM " . self::$table . " WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $funcionario = null;
            if ($row['tipo'] == 'gerente') {
                $funcionario = new Gerente($db);
            } else if ($row['tipo'] == 'desenvolvedor') {
                $funcionario = new Desenvolvedor($db);
            }
            
            if ($funcionario) {
                $funcionario->id = $row['id'];
                $funcionario->nome = $row['nome'];
                $funcionario->salario = $row['salario'];
                $funcionario->tipo = $row['tipo'];
                return $funcionario;
            }
        }
        return null;
    }

    public function atualizar() {
        $query = "UPDATE " . self::$table . " SET nome=:nome, salario=:salario, tipo=:tipo WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->salario = htmlspecialchars(strip_tags($this->salario));
        $this->tipo = htmlspecialchars(strip_tags($this->tipo));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':salario', $this->salario);
        $stmt->bindParam(':tipo', $this->tipo);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

    public static function excluir($db, $id) {
        $query = "DELETE FROM " . self::$table . " WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>