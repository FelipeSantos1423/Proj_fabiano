<?php
require_once 'Usuario.php';
require_once '../config/Database.php';

class UsuarioDAO {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Busca um usuário pelo email
    public function buscarPorEmail($email) {
        $query = "SELECT * FROM usuario WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Valida o login
    public function validarLogin($email, $senha) {
        $usuario = $this->buscarPorEmail($email);
        if ($usuario && password_verify($senha, $usuario['senha_hash'])) {
            return new Usuario($usuario); // Cria objeto Usuario
        }
        return null;
    }

    public function cadastrar($email, $senha) {
    // Verifica se já existe um usuário com esse e-mail
    if ($this->buscarPorEmail($email)) {
        return false; // E-mail já cadastrado
    }

    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Insere o usuário no banco
    $query = "INSERT INTO usuario (email, senha_hash) VALUES (:email, :senha_hash)";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha_hash', $senha_hash);

    return $stmt->execute(); // true se cadastrou, false se erro
}
}