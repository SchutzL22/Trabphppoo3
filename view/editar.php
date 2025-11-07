<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Funcionário</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        h1 { color: #ffc107; }
        form { max-width: 600px; background: #fff8e1; padding: 20px; border-radius: 8px; }
        label { display: block; margin-top: 15px; font-weight: bold; }
        input, select, textarea { width: 100%; padding: 10px; margin-top: 5px; box-sizing: border-box; }
        button { margin-top: 20px; padding: 10px 20px; background: #ffc107; color: #000; border: none; cursor: pointer; }
    </style>
</head>
<body>

<h1>✏️ Editar Funcionário</h1>

<form method="POST">
    <input type="hidden" name="id" value="<?= $funcionario->id ?>">

    <label>Nome:</label>
    <input type="text" name="nome" value="<?= htmlspecialchars($funcionario->nome) ?>" required>

    <label>Salário Base (R$):</label>
    <input type="number" name="salario" step="0.01" min="0" 
           value="<?= $funcionario->salario ?>" required>
           
    <label>Tipo:</label>
    <select name="tipo" required>
        <option value="gerente" <?= ($funcionario->tipo == 'gerente') ? 'selected' : '' ?>>Gerente</option>
        <option value="desenvolvedor" <?= ($funcionario->tipo == 'desenvolvedor') ? 'selected' : '' ?>>Desenvolvedor</option>
    </select>

    <button type="submit">Atualizar Funcionário</button>
    <a href="index.php">← Voltar</a>
</form>

<?php if (isset($erro)): ?>
    <p style="color:red; margin-top:15px;"><?= $erro ?></p>
<?php endif; ?>

</body>
</html>