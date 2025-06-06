<?php

class Usuario {
    private $id;
    private $email;
    private $senha_hash;
    private $created_at;

    // Getters e Setters
    public function getId() { return $this->id; }
    public function getEmail() { return $this->email; }
    public function getSenhaHash() { return $this->senha_hash; }
    public function getCreatedAt() { return $this->created_at; }

    public function setEmail($email) { $this->email = $email; }
    public function setSenhaHash($senha_hash) { $this->senha_hash = $senha_hash; }
}