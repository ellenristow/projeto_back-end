<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marmita</title>
</head>
<body>
    <?php require("views/templates/nav.php"); ?>
    <main>
        <div>
            <h1>Sua Conta</h1>
            <?php
            echo '
                <h3>Nome: ' . htmlspecialchars($user["name"]) . '</h3>
                <p>Email: ' . htmlspecialchars($user["email"]) . '</p>
            ';
            ?>
            <div>
                <form method="POST" action="<?php echo ROOT ?>/profile/<?php echo $_SESSION['user_id']; ?>" onsubmit="return confirmDelete()">
                    <button type="submit" name="delete">Deletar Conta</button>
                </form>
            </div>
        </div>
    </main>
    <script src="../js/confirm-delete.js"></script>
</body>
</html>