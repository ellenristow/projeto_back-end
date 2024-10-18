<?php include "views/templates/head.php"; ?>
<body>        
    <h1>
        <h1><a href="<?php ROOT ?>/">Bem Vindo Marmiteiro!</a></h1>
    </h1>
    <main>
        <div>
            <h2><?php echo $recipes["title"]; ?></h2>
        </div>
        <div>
            <h3>Ingredientes</h3>
            <div>
                <ul>
                    <?php 
                    foreach ($ingredients as $ingredient){
                        echo '
                            <li>
                                <p>' .$ingredient["ingredient_name"]. ' - ' .$ingredient["quantity"]. ' ' .$ingredient["unit_measurement"]. '</p>
                            </li>
                        ';
                    }
                    ?>
                </ul>
            </div>
            <div>
                <h3>Modo de Preparo</h3>
                <p><?php echo $recipes["instructions"]; ?></p>
            </div>
            <div>
                <p>Autor: <?php echo $recipes["user_name"]; ?></p>
                <p>Criada em: <?php echo $recipes["created_at"]; ?></p>
            </div>
        </div>
    </main>
</body>
</html>



