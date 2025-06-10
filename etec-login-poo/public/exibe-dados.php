<?php
session_start();
require_once __DIR__ . '/../models/Usuario.php';

if (!isset($_SESSION['logado']) || !isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

$usuario = unserialize($_SESSION['usuario']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dados do Usuário</title>
</head>
<body>
    <h2>Email: <?= htmlspecialchars($usuario->getEmail()); ?></h2>
    <a href="excluir-usuario.php" onclick="return confirm('Tem certeza que deseja excluir sua conta?');">Excluir minha conta</a>
     <a href="editar-usuario.php">Editar minha conta</a>

</body>
</html>
