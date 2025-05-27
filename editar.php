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

 // Verifica se o ID foi passado para edição
 if (isset($_GET['id'])) {
     $idEditar = (int) $_GET['id'];

     // Buscar os dados do usuário para preencher o formulário
     $stmt = $pdo->prepare("SELECT * FROM users WHERE id_user = :id");
     $stmt->execute([':id' => $idEditar]);
     $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

     if (!$usuario) {
         die("Usuário não encontrado.");
     }

     // EDIÇÃO - Atualizar os dados do usuário
     if ($_SERVER["REQUEST_METHOD"] === "POST") {
         $nome = $_POST['nome'];
         $cpf = $_POST['cpf'];
         $email = $_POST['email'];
         $cep = $_POST['cep'];
         $cargo = $_POST['cargo'];
         $salario = $_POST['salario'];
         $data_admissao = $_POST['data_admissao'];

         // Verifica se todos os campos foram preenchidos
         if (empty($nome) || empty($cpf) || empty($email) || empty($cep) || empty($cargo) || empty($salario) || empty($data_admissao)) {
             $mensagem = "Por favor, preencha todos os campos.";
         } else {
             // Atualiza os dados no banco
             try {
                 $stmt = $pdo->prepare("UPDATE users SET nome = :nome, cpf = :cpf, email = :email, cep = :cep, cargo = :cargo, salario = :salario, data_admissao = :data_admissao WHERE id_user = :id");
                 $stmt->execute([
                     ':nome' => $nome,
                     ':cpf' => $cpf,
                     ':email' => $email,
                     ':cep' => $cep,
                     ':cargo' => $cargo,
                     ':salario' => $salario,
                     ':data_admissao' => $data_admissao,
                     ':id' => $idEditar
                 ]);
                 $mensagem = "Usuário atualizado com sucesso!";
             } catch (PDOException $e) {
                 $mensagem = "Erro ao atualizar o usuário: " . $e->getMessage();
             }
         }
     }
 } else {
     die("ID do usuário não fornecido.");
 }
 ?>

 <!DOCTYPE html>
 <html lang="pt-br">
 <head>
     <meta charset="UTF-8">
     <title>Editar Usuário</title>
     <link rel="stylesheet" href="cadastro.css">
     <div class="main-content">
     <div class="form-container">
 </head>
 <body>

         <h2>Olá Maria!</br> Edite o usuário que deseja.</h2>

 <?php if (!empty($mensagem)) echo "<p><strong>$mensagem</strong></p>"; ?>

 <form method="POST">
     <input type="hidden" name="id_user" value="<?= $usuario['id_user'] ?>">

     <label>Nome:</label><br>
     <input type="text" name="nome" value="<?= htmlspecialchars($usuario['nome']) ?>" required><br><br>

     <label>CPF:</label><br>
     <input type="text" name="cpf" value="<?= htmlspecialchars($usuario['cpf']) ?>" required><br><br>

     <label>Email:</label><br>
     <input type="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required><br><br>

     <label>Cep:</label><br>
     <input type="text" name="cep" value="<?= htmlspecialchars($usuario['cep']) ?>" required><br><br>

     <label>Cargo:</label><br>
     <input type="text" name="cargo" value="<?= htmlspecialchars($usuario['cargo']) ?>" required><br><br>

     <label>Salário:</label><br>
     <input type="number" name="salario" value="<?= htmlspecialchars($usuario['salario']) ?>" step="0.01" required><br><br>

     <label>Data de Admissão:</label><br>
     <input type="date" name="data_admissao" value="<?= htmlspecialchars($usuario['data_admissao']) ?>" required><br><br>

     <button type="submit">Atualizar</button>
 </form>

 <a href="sistema2.php">Voltar para a lista de usuários</a>

 </body>
 </html>
