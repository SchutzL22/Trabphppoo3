<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Novo Funcionário</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        h1 { color: #28a745; }
        form { max-width: 600px; background: #f8f9fa; padding: 20px; border-radius: 8px; }
        label { display: block; margin-top: 15px; font-weight: bold; }
        input, select, textarea { width: 100%; padding: 10px; margin-top: 5px; box-sizing: border-box; }
        button { margin-top: 20px; padding: 10px 20px; background: #28a745; color: white; border: none; cursor: pointer; }
        .error { color: red; margin-top: 10px; }
    </style>
</head>
<body>

<h1>➕ Cadastrar Novo Funcionário</h1>

<form method="POST">
    <label>Nome:</label>
    <input type="text" name="nome" required>

    <label>Salário Base (R$):</label>
    <input type="number" name="salario" step="0.01" min="0" required>

    <label>Tipo:</label>
    <select name="tipo" required>
        <option value="">Selecione o tipo</option>
        <option value="gerente">Gerente</option>
        <option value="desenvolvedor">Desenvolvedor</option>
    </select>

    <button type="submit">Salvar Funcionário</button>
    <a href="index.php">← Voltar</a>
</form>

<?php if (isset($erro)): ?>
    <p class="error"><?= $erro ?></p>
<?php endif; ?>

</body>
</html>