<?php include "views/templates/head.php"; ?>
<body>
    <h1>Bem Vindo Marmiteiro!</h1>
    <main>
        <div>
        <h2>Receitas</h2>
        <?php 
            foreach ($recipes as $recipe){
                echo '
                    <li>
                        <h3>
                        <a href="' .ROOT. '/recipe/'
                        .$recipe["recipe_id"]. '">' .$recipe["title"]. '</a>
                        </h3>
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