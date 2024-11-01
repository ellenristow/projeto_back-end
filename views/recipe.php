<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marmita</title>
</head>
<body>
    <?php require("views/templates/nav.php"); ?>        
    <h1><?php echo $recipes["title"]; ?></h1>
    <main>
        <div>
            <div>
                <?php
                if (!empty($recipes["image"]) && isset($recipes["recipe_id"])) {
                    echo '<img src="' . ROOT . '/images/' . $recipes['image'] . '" alt="Imagem da receita ' . $recipes["recipe_id"] . '" />';
                } 
                ?>
            </div> 
            <div>
                <h2>Ingredientes</h2>
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
            <?php
                if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] === $recipes["user_id"]) {

                    echo '
                        <button><a href="' .ROOT. '/recipeupdate/'.$recipes["recipe_id"].'">Editar Receita</a></button>
                    ';
                } 
            ?>
            <?php
                if(isset($_SESSION["user_id"]) && $_SESSION["user_id"] === $recipes["user_id"]){

                    echo '
                        <form method="POST" action="' . ROOT . '/recipe/'. $recipes["recipe_id"].'" onsubmit="return confirmDelete()">
                            <input type="hidden" name="recipe_id" value="'.$recipes['recipe_id']. '">
                            <button type="submit" name="delete">Deletar Receita</button>
                        </form>
                    ';    
                }
            ?>        
        </div>
    </main>
    <script src="../js/confirm-delete.js"></script>
</body>
</html>



