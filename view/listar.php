<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Funcionários – POO/MVC</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background: #f8f9fa; }
        h1 { color: #2c3e50; }
        .btn { display: inline-block; padding: 8px 15px; margin: 5px 0; text-decoration: none; border-radius: 4px; }
        .btn-primary { background: #007bff; color: white; }
        .btn-warning { background: #ffc107; color: #000; }
        .btn-danger { background: #dc3545; color: white; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; background: white; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f1f3f5; }
        .msg { padding: 12px; margin: 15px 0; border-radius: 5px; }
        .msg-success { background: #d4edda; color: #155724; }
        .bonus { color: #007bff; font-weight: bold; }
        .total { font-weight: bold; color: #28a745; }
    </style>
</head>
<body>

<h1>🧑‍💼 Gerenciamento de Funcionários</h1>

<a href="index.php?acao=criar" class="btn btn-primary">+ Novo Funcionário</a>

<?php
if (isset($_GET['msg'])) {
    $mensagens = [
        'criado' => '✅ Funcionário cadastrado com sucesso!',
        'atualizado' => '✅ Funcionário atualizado com sucesso!',
        'excluido' => '🗑️ Funcionário excluído com sucesso!'
    ];
    if (isset($mensagens[$_GET['msg']])) {
        echo '<div class="msg msg-success">' . $mensagens[$_GET['msg']] . '</div>';
    }
}
?>

<?php if (isset($funcionarios) && count($funcionarios) > 0): ?>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Cargo</th>
                <th>Salário Base</th>
                <th>Bonificação (Polimorfismo)</th>
                <th>Salário Total</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($funcionarios as $f): ?>
            <tr>
                <td><?= htmlspecialchars($f->getNome()) ?></td>
                <td><?= htmlspecialchars(ucfirst($f->tipo)) ?></td>
                <td>R$ <?= number_format($f->getSalario(), 2, ',', '.') ?></td>
                <td class="bonus">R$ <?= number_format($f->getBonificacao(), 2, ',', '.') ?></td>
                <td class="total">R$ <?= number_format($f->getSalarioTotal(), 2, ',', '.') ?></td>
                <td>
                    <a href="index.php?acao=editar&id=<?= $f->id ?>" class="btn btn-warning">Editar</a>
                    <a href="index.php?acao=excluir&id=<?= $f->id ?>" 
                       class="btn btn-danger"
                       onclick="return confirm('Tem certeza?')">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Nenhum funcionário cadastrado ainda.</p>
<?php endif; ?>

</body>
</html>