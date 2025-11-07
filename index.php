<?php
require_once 'config/Database.php';
require_once 'controller/FuncionarioController.php';

$database = new Database();
$db = $database->getConnection();
$controller = new FuncionarioController($db);

$acao = $_GET['acao'] ?? 'listar';

switch ($acao) {
    case 'criar':
        $controller->criar();
        break;
    case 'editar':
        $controller->editar();
        break;
    case 'excluir':
        $controller->excluir();
        break;
    case 'listar':
    default:
        $controller->listar();
        break;
}
?>