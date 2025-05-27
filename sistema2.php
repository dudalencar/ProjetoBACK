 <?php
// Ativa exibição de erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define("DATABASE", "database.sqlite3");

// Conecta ao banco
try {
    $pdo = new PDO('sqlite:' . DATABASE);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro ao conectar com o banco de dados: " . $e->getMessage();
    exit;
}

$mensagem = "";

// EXCLUSÃO
if (isset($_GET['excluir'])) {
    $idExcluir = (int) $_GET['excluir'];
    try {
        $stmt = $pdo->prepare("DELETE FROM users WHERE id_user = :id");
        $stmt->execute([':id' => $idExcluir]);
        $mensagem = "Usuário excluído com sucesso.";
    } catch (PDOException $e) {
        $mensagem = "Erro ao excluir: " . $e->getMessage();
    }
}

// BUSCA
$busca = $_GET['busca'] ?? '';
$query = "SELECT * FROM users WHERE nome LIKE :busca OR email LIKE :busca ORDER BY id_user ASC";
$stmt = $pdo->prepare($query);
$stmt->execute([':busca' => '%' . $busca . '%']);
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Usuários Cadastrados</title>
    <link rel="stylesheet" href="sistema2.css">
</head>
<body>

    <h2>Usuários Cadastrados</h2>

<?php if (!empty($mensagem)) echo "<p><strong>$mensagem</strong></p>"; ?>

<form method="GET" action="">
    <input type="text" name="busca" placeholder="Buscar por nome ou email" value="<?= htmlspecialchars($busca) ?>">
    <button type="submit">Buscar</button>
</form>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>CPF</th>
        <th>Email</th>
        <th>CEP</th>
        <th>Cargo</th>
        <th>Salário</th>
        <th>Data de Admissão</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($usuarios as $usuario): ?>
    <tr>
        <td><?= $usuario['id_user'] ?></td>
        <td><?= htmlspecialchars($usuario['nome']) ?></td>
        <td><?= htmlspecialchars($usuario['cpf']) ?></td>
        <td><?= htmlspecialchars($usuario['email']) ?></td>
        <td><?= htmlspecialchars($usuario['cep']) ?></td>
        <td><?= htmlspecialchars($usuario['cargo']) ?></td>
        <td><?= number_format($usuario['salario'], 2, ',', '.') ?></td>
        <td><?= htmlspecialchars($usuario['data_admissao']) ?></td>
        <td>
            <a href="editar.php?id=<?= $usuario['id_user'] ?>">Editar</a> | 
            <a href="sistema2.php?excluir=<?= $usuario['id_user'] ?>" onclick="return confirm('Deseja excluir este usuário?')">Excluir</a>
        </td>
    </tr>
    <?php endforeach ?>
</table>

<a href="cadastro.php">Cadastrar Novo Usuário</a>

</body>
</html>
