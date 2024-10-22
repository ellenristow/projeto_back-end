<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marmita</title>
</head>
<body>
    <h1><a href="<?php ROOT ?>/">Bem Vindo Marmiteiro!</a></h1>
    <main>
        <div>
            <h2>Login</h2>
            <?php
                if(isset($message)){
                    echo '<p role="alert">' .$message. '</p>';
                }
            ?>
            <form method="POST" action="<?php ROOT ?>/login">
                <div>
                    <label>
                        Email
                        <input type="email" name="email" required>
                    </label>
                </div>
                <div>
                    <label>
                        Password
                        <input type="password" name="password" required minlength="8" maxlength="255">
                    </label>
                </div>
                <div>
                    <button type="submit" name="send">Entrar</button>
                </div>
                <p>Ainda não tem uma conta?
                    <a href="<?php ROOT ?>/register/"> Crie sua conta aqui!</a>
                </p>
            </form>
        </div>
        <div>
            <p><a href="<?php ROOT ?>/">Voltar para a Home</a></p>
        </div>
    </main>
</body>
</html>
