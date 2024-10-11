<?php include "views/templates/head.php"; ?>
<body>        
    <h1>
        <?php echo $recipes["title"]; ?>
    </h1>

    <main>
        <div>
            <h2>Ingredientes</h2>
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
                <h2>Modo de Preparo</h2>
                <p><?php echo $recipes["instructions"]; ?></p>
            </div>
            <div>
                <p>criado por: </p>
            </div>
        </div>
    </main>
</body>
</html>



