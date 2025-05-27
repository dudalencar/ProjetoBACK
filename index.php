<?php
session_start();
define('DATABASE', 'banco.sqlite');

$erro = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['password'] ?? '';

    try {
        $pdo = new PDO('sqlite:' . DATABASE);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT senha FROM usuarios WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario'] = $email;
            header("Location: sistema.php");
            exit;
        } else {
            $erro = "Email ou senha incorretos.";
        }
    } catch (PDOException $e) {
        $erro = "Erro: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="teladelogin.css">
</head>
<body>
<div class="login-container">
    <div class="login-form">
        <h2>Login</h2>
        <p>Sistema de RH Web Solutions</p>

        <?php if ($erro): ?>
            <p style="color: red;"><strong><?php echo htmlspecialchars($erro); ?></strong></p>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Digite seu email corporativo" required>
            </div>
            <div class="input-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" placeholder="Digite sua senha" required>
            </div>
            <button type="submit">Enviar</button>
        </form>

        <p class="login-footer">Esqueceu a senha? <a href="#">Redefina</a></p>
    </div>
    <div class="login-image">
        <img src="./Imagem/download.png" alt="Logo WS">
    </div>
</div>
</body>
</html>
