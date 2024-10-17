<?php include "views/templates/head.php"; ?>

<body>
    <h1>Bem Vindo Marmiteiro!</h1>
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
    </main>
</body>
</html>
