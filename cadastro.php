<?php

session_start();

// Se não estiver logado, redireciona para o login
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

// Ativa exibição de erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define("DATABASE", "database.sqlite3");

// Conecta ou cria o banco
try {
    $pdo = new PDO('sqlite:' . DATABASE);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Cria a tabela se não existir
    $pdo->exec("CREATE TABLE IF NOT EXISTS users (
        id_user INTEGER PRIMARY KEY AUTOINCREMENT,
        nome TEXT NOT NULL,
        cpf TEXT NOT NULL UNIQUE,
        email TEXT NOT NULL UNIQUE,
        cep TEXT NOT NULL,
        cargo TEXT NOT NULL,
        salario REAL NOT NULL,
        data_admissao DATE NOT NULL
    )");
} catch (PDOException $e) {
    echo "Erro ao conectar com o banco de dados: " . $e->getMessage();
    exit;
}

$mensagem = "";

// CADASTRO
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'] ?? '';
    $cpf = $_POST['cpf'] ?? '';
    $email = $_POST['email'] ?? '';
    $cep = $_POST['cep'] ?? '';
    $cargo = $_POST['cargo'] ?? '';
    $salario = $_POST['salario'] ?? '';
    $data_admissao = $_POST['data_admissao'] ?? '';

    if (empty($nome) || empty($cpf) || empty($email) || empty($cep) || empty($cargo) || empty($salario) || empty($data_admissao)) {
        $mensagem = "Por favor, preencha todos os campos.";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO users (nome, cpf, email, cep, cargo, salario, data_admissao) VALUES (:nome, :cpf, :email, :cep, :cargo, :salario, :data_admissao)");
            $stmt->execute([
                ':nome' => $nome,
                ':cpf' => $cpf,
                ':email' => $email,
                ':cep' => $cep,
                ':cargo' => $cargo,
                ':salario' => $salario,
                ':data_admissao' => $data_admissao
            ]);
            $mensagem = "Usuário cadastrado com sucesso!";
        } catch (PDOException $e) {
            $mensagem = "Erro ao cadastrar usuário: " . $e->getMessage();
        }
    }
}

?>

    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Cadastro de Usuário</title>
        <link rel="stylesheet" href="cadastro.css">
    </head>
    <body>
        
            <div class="logo-container">
                <img src="./Imagem/logo-Photoroom (1).png" alt="Logo Web Solutions">
            </div>
    
            <div class="main-content">
    
            <div class="form-container">
                <h2>Bem Vinda Maria!</br> Faça o cadastro de usuários</h2>
    
                <?php if (!empty($mensagem)) echo "<p><strong>$mensagem</strong></p>"; ?>

                <form method="POST">
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" id="nome" required>

                    <label for="cpf">CPF:</label>
                    <input type="text" name="cpf" id="cpf" required>

                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" required>

                    <label for="cep">CEP:</label>
                    <input type="text" name="cep" id="cep" required>

                    <label for="cargo">Cargo:</label>
                    <input type="text" name="cargo" id="cargo" required>

                    <label for="salario">Salário:</label>
                    <input type="number" name="salario" id="salario" step="0.01" required>

                    <label for="data_admissao">Data de Admissão:</label>
                    <input type="date" name="data_admissao" id="data_admissao" required>

                    <button type="submit">Cadastrar</button>
                </form>

                <a href="sistema2.php">Ver Usuários Cadastrados</a>
            </div>
        </div>
    </body>
    </html>
