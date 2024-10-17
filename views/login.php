<?php include "views/templates/head.php"; ?>

<body>
    <h1>Bem Vindo Marmiteiro!</h1>
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
    </main>
</body>
</html>
