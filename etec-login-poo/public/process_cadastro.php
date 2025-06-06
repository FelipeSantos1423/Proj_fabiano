<?php
require_once '../config/Database.php'; // ajuste o caminho se necessário

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    // Validação básica
    if (empty($email) || empty($senha)) {
        echo "Por favor, preencha todos os campos.";
        exit;
    }

    // Hash da senha
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    try {
        $db = new Database();
        $conn = $db->getConnection();

        // Verificar se o email já está cadastrado
        $check = $conn->prepare("SELECT id FROM usuario WHERE email = :email");
        $check->bindParam(":email", $email);
        $check->execute();

        if ($check->rowCount() > 0) {
            echo "E-mail já cadastrado.";
            exit;
        }

        // Inserir novo usuário
        $stmt = $conn->prepare("INSERT INTO usuario (email, senha_hash) VALUES (:email, :senha_hash)");
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":senha_hash", $senhaHash);

        if ($stmt->execute()) {
            echo "Cadastro realizado com sucesso!";
        } else {
            echo "Erro ao cadastrar.";
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>
