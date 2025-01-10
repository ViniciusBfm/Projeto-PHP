<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link href="<?php echo INCLUDE_PATH_FULL?>css/style.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= self::titulo; ?></title>
</head>

<body style="background-color: #e5eaee;">
    <header>
        <div class="header-info">
            <a href="<?= INCLUDE_PATH;?>home"><img class="logo" src="<?= INCLUDE_IMAGES; ?>/logo.png"
                    alt="ProjectPhp"></a>
            <img class="menu-button" src="<?= INCLUDE_IMAGES; ?>/menu.png" alt="menu">
            <div class="nav-mobile">
                <ul>
                    <li><a href="<?= INCLUDE_PATH;?>home">Funcionários cadastrados</a< /li>
                    <li><a href="<?= INCLUDE_PATH;?>cadastrarfuncionarios">Cadastrar funcionários</a></li>
                    <li><a href="<?= INCLUDE_PATH;?>empresascadastros">Cadastrar empresa</a></li>
                </ul>
            </div>
        </div>
        <div class="header-perfil">
            <p><?=$_SESSION['usuario_email'];?></p>
            <form style="cursor: pointer;" action="<?= INCLUDE_PATH; ?>logout" method="post">
                <button type="submit" class="logout-button"><img src="<?= INCLUDE_IMAGES; ?>/sair.png" alt=""></button>
            </form>
        </div>
    </header>
    <script>
    // Obtém o botão e o menu móvel
    const menuButton = document.querySelector('.menu-button');
    const navMobile = document.querySelector('.nav-mobile');

    // Adiciona um evento de clique no botão
    menuButton.addEventListener('click', () => {
        // Alterna a classe 'active' no menu
        navMobile.classList.toggle('active');
    });

    // Opcional: Fecha o menu ao clicar fora dele
    document.addEventListener('click', (event) => {
        if (!menuButton.contains(event.target) && !navMobile.contains(event.target)) {
            navMobile.classList.remove('active');
        }
    });
    </script>


</body>