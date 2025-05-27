<?php
define('DATABASE', 'banco.sqlite');

try {
    $pdo = new PDO('sqlite:' . DATABASE);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec("CREATE TABLE IF NOT EXISTS usuarios (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        email TEXT UNIQUE,
        senha TEXT
    )");

    $email = 'mariaeduarda@websol.com';
    $senha = '123456';

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE email = :email");
    $stmt->execute([':email' => $email]);

    if (!$stmt->fetchColumn()) {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO usuarios (email, senha) VALUES (:email, :senha)");
        $stmt->execute([':email' => $email, ':senha' => $senhaHash]);
        echo "Usuário inserido.";
    } else {
        echo "Usuário já existe.";
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
