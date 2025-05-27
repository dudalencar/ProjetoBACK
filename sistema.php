<?php
session_start();

// Se não estiver logado, redireciona para o login
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistema RH</title>
    <link rel="stylesheet" href="sistema.css" />
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="logo">
                <img src="./Imagem/logo-Photoroom (1).png" alt="Logo" />
            </div>
            <div class="search-container">
                <input type="text" placeholder="Pesquisar..." class="search-bar" />
            </div>
        </div>

        <nav>
            <ul>
                <li class="menu-item">
                    <span><i class="fas fa-home"></i> Início</span>
                </li>
                <li class="menu-item has-submenu">
                    <span class="menu-title">
                        <i class="fas fa-users"></i> Gestão de Pessoas
                        <span class="arrow">&#9662;</span>
                    </span>
                    <ul class="submenu">
                        <li>Cadastro de colaboradores</li>
                        <li>Plano de carreira</li>
                        <li>Avaliações de desempenho</li>
                        <li>Demissões</li>
                    </ul>
                </li>
                <li class="menu-item has-submenu">
                    <span class="menu-title">
                        <i class="fas fa-clock"></i> Pontos e Jornada
                        <span class="arrow">&#9662;</span>
                    </span>
                    <ul class="submenu">
                        <li>Registro de ponto eletrônico</li>
                        <li>Controle de banco de horas</li>
                        <li>Solicitação e aprovação de horas extras</li>
                    </ul>
                </li>
                <li class="menu-item has-submenu">
                    <span class="menu-title">
                        <i class="fas fa-file-invoice-dollar"></i> Folha de Pagamento
                        <span class="arrow">&#9662;</span>
                    </span>
                    <ul class="submenu">
                        <li>Cálculo automático de salários</li>
                        <li>Geração de holerites</li>
                        <li>Integração com eSocial</li>
                        <li>Emissão de DARFs, FGTS, INSS</li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>

    <div class="main-content">
        <h1>Olá, MARIA</h1>
        <input type="text" placeholder="Buscar Colaborador" class="search-bar-colaborador" />
        <h2>Mais acessados</h2>
        <div class="cards">
            <div class="card"><a href="cadastro.php">Cadastro de Colaboradores</a> </div> 
            <div class="card">Demissões</div>
            <div class="card">Atualização Cadastral </div>

        </div>
    </div>

    <script>
        document.querySelectorAll('.has-submenu').forEach(item => {
            item.addEventListener('click', function () {
                this.classList.toggle('active');
            });
        });
    </script>

</body>

</html>
