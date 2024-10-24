<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marmita</title>
</head>
<body>
    <?php require("views/templates/nav.php"); ?>
        <?php
            if (isset($_SESSION["user_id"])) {

                echo '
                       <h1> Bem vindo, ' . $_SESSION["name"] . '</h1>
                ';
            } else {

                echo '
                       <h1>Bem vindo!</h1>
                ';
            } 
        ?>
    <h2>Receitas para inspirar sua marmita diária</h2>
    <main>
        <div>
        <?php
            if (isset($_SESSION["user_id"])) {

                echo '
                    <button><a href="' .ROOT. '/recipeform/">Criar Receita</a></button>
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