<?php include "views/templates/head.php"; ?>
<body>
    <h1><a href="<?php ROOT ?>/">Bem Vindo Marmiteiro!</a></h1>
    <main>
        <div>
        <h2>Receitas para inspirar sua marmita diária</h2>
        <h3><a href="<?php ROOT ?>/login/"> Login</h3>
        <h3><a href="<?php ROOT ?>/register/"> Registre-se</h3>
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