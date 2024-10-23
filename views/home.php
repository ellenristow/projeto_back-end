<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marmita</title>
</head>
<body>
    <h1>Receitas para inspirar sua marmita diária</h1>
    <main>
    <?php
        if (isset($_SESSION["user_id"])) {
            echo '
                <h2 id="' . $user["user_id"] . '">Bem Vindo, ' . $user["name"] . '</h2>
                <button><a href="' .ROOT. '/recipeform/">Criar Receita</a></button>
            ';
        } else {
            echo '
                <h2>Bem Vindo, Mamiteiro</h2>
            ';
        }
    ?>
        <div>
            <?php 
                if(isset($_SESSION["user_id"])){
                    echo '<h4><a href="<?php ROOT ?>/logout/">Logout</a></h4>
                    ';
                } else {
                    echo '
                    <h4><a href="<?php ROOT ?>/login/"> Login</a></h4>
                    <h4><a href="<?php ROOT ?>/register/"> Registre-se</a></h4>
                    ';
                }
            ?>
        </div>
        <div>
        <h2>Receitas</h2>
        <?php 
            foreach ($recipes as $recipe){
                echo '
                    <li>
                        <h3>
                        <a href="' .ROOT. '/recipe/'
                        .$recipe["recipe_id"]. '">' .$recipe["title"]. '</a>
                        </h3> ';
                        if(!empty($recipe["image"])){
                            echo ' <img src="' . $recipe['image'] . '" alt="Imagem da receita"/> ';
                        }
                    echo '    
                        <h4>Categoria: ' .$recipe["category"]. '</h4>
                        <button>&#9825;</button><p> ' .$recipe["like_count"]. '</p>
                    </li>
                ';
            }
        ?>
        </div>
    </main>
</body>
</html>