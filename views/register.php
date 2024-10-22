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
            <h2>Crie uma conta</h2>
            <?php
                if( isset($message)){
                    echo '<p role="alert">' .$message. '</p>';
                }
            ?>
            <p>Se já tiver uma conta, <a href="<?php ROOT ?>/login/"> faça o login</a></p>

            <form method="POST" action="<?php ROOT ?>/register/">
                 <div>
                    <label>
                        Name
                        <input type="text" name="name" required minlength="3" maxlength="100">
                    </label>
                </div>
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
                    <label>
                        Confirm Password
                        <input type="password" name="password_confirm" required minlength="8" maxlength="255">
                    </label>
                </div>
                <div>
                    <button type="submit" name="send">Enviar</button>
                </div>           
            </form>
        </div>
        <div>
            <p><a href="<?php ROOT ?>/">Voltar para a Home</a></p>
        </div>
    </main>
</body>
</html>
