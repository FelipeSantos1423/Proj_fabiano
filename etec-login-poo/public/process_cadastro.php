<?php
require_once __DIR__ . '/../models/UsuarioDAO.php';
require_once __DIR__ . '/../utils/Sanitizacao.php';

// Sanitiza entradas
$email = Sanitizacao::sanitizar($_POST['email']);
$senha = Sanitizacao::sanitizar($_POST['senha']);

$usuarioDAO = new UsuarioDAO();
$sucesso = $usuarioDAO->cadastrar($email, $senha);

if ($sucesso) {
    echo "Usuário cadastrado com sucesso!";
} else {
    echo "Erro: e-mail já cadastrado ou falha ao inserir no banco.";
}
?>
