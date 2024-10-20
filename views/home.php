<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marmita</title>
</head>
<body>
    <?php
        if (isset($_SESSION["user_id"])) {
            echo '
                <h1 id="' . $user["user_id"] . '">Bem Vindo, ' . $user["name"] . '</h1>
            ';
        } else {
            echo '
                <h1>Bem Vindo, Mamiteiro</h1>
            ';
        }
    ?>
    <main>
        <div>
        <h2>Receitas para inspirar sua marmita diária</h2>
        <h3><a href="<?php ROOT ?>/login/"> Login</a></h3>
        <h3><a href="<?php ROOT ?>/register/"> Registre-se</a></h3>
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