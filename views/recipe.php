<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marmita</title>
</head>
<body>        
    <h1><?php echo $recipes["title"]; ?></h1>
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
                <p>Autor: <?php echo $recipes["user_name"]; ?></p>
                <p>Criada em: <?php echo $recipes["created_at"]; ?></p>
            </div>
        </div>
        <div>
            <p><a href="<?php ROOT ?>/">Voltar para a Home</a></p>
        </div>
    </main>
</body>
</html>



