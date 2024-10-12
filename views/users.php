<?php include "views/templates/head.php"; ?>
<body>
    <h1>Bem Vindo Marmiteiro!</h1>
    <main>
        <div>
            <h1>Usuários</h1>
                <ul>
                    <?php 
                    foreach ($users as $user){
                        echo '
                        <li>  ' . $user["user_id"] . ' </li>
                    '; 
                    }
                    ?>
                </ul>
        </div>
    </main>
</body>
</html>