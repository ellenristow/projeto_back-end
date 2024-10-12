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
                        <h4>
                        <a href="' .ROOT. '/recipe/'
                        .$recipe["recipe_id"]. '">' .$recipe["title"]. '</a>
                        </h4>
                        <p>Likes:' .$recipe['like_count']. '</p>
                        <button>&#9825;</button>
                    </li>
                ';
            }
        ?>
        </div>
        <div>
        <h3>Categorias</h3>
        </div>
    </main>
</body>
</html>