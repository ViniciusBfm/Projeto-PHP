<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="<?php echo INCLUDE_PATH_FULL?>css/style.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= self::titulo; ?></title>
</head>

<body class="login-container">
    <section class="login">
        <h1>Login</h1>
        <form class="form" action="" method="post">
            <div class="inputs-email-senha">
                <label for="email">Email</label>
                <input id="email" name="email" placeholder="E-mail" type="email" required>
            </div>
            <div class="inputs-email-senha" style="margin: 10px 0;">
                <label for="email">Senha</label>
                <input id="senha" name="senha" placeholder="Senha" type="password" required>
            </div>
            <button type="submit" class="entrar">Entrar</button>
        </form>
        <?php if (!empty($erro_login)): ?>
        <div class="erro">
            <?= htmlspecialchars($erro_login); ?>
        </div>
        <?php endif; ?>
        <div class="links-login">
            <a href="">Esqueceu a senha?</a>
        </div>
    </section>


</body>

</html>