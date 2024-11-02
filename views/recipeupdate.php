<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marmita</title>
</head>
<body>
    <script>
        const categories = <?php echo json_encode($categories); ?>;
        const ingredients = <?php echo json_encode($ingredients); ?>;
    </script>
    <?php require("views/templates/nav.php"); ?>
    <main>
        <div>
            <h2>Atualize a sua receita</h2>
        </div>
        <form method="POST" action="<?php echo ROOT ?>/recipeupdate/<?php echo $recipe['recipe_id']; ?>" enctype="multipart/form-data">
            <div>
                <label>
                    Nome da Receita
                    <input type="text" name="title" value="<?php echo htmlspecialchars($recipe['title']); ?>" required minlength="3" maxlength="50">
                </label>
                <br><br>
                <div id="categories-container">
                    <?php
                    foreach($categoriesByRecipe as $categoryRecipe){
                    ?>
                        <div class="category-group">
                            <label>
                                Categorias
                                <select name="category_id[]">
                                    <?php
                                    foreach($categories as $category){
                                        $selected = $categoryRecipe["category_id"] == $category["category_id"] ? "selected" : "";
                                        echo '<option value="' . $category["category_id"] . '" ' . $selected . '>' . htmlspecialchars($category["category_name"]) . '</option>';  
                                    }
                                    ?>
                                </select>
                                    <input type="hidden" name="recipe_category_id[]" value="<?= $categoryRecipe['recipe_category_id'] ?>">
                    <?php
                    }
                    ?>
                            </label>
                        </div>
                </div>
                <button type="button" id="add-category" onclick="addCategory()">Adicionar Categoria</button>
                <button type="button" id="delete-category" onclick="deleteCategory()">Deletar Categoria</button>
                <br><br>
                <div id="ingredients-container">
                    <?php
                    foreach($ingredientsByRecipe as $ingredientRecipe) {
                    ?>
                        <div class="ingredient-group">
                            <label>
                                Ingredientes
                                <select name="ingredient_id[]">
                                    <?php
                                    foreach($ingredients as $ingredient) {
                                        $selectedIngredient = $ingredientRecipe["ingredient_id"] == $ingredient["ingredient_id"] ? "selected" : "";
                                        echo '<option value="' . $ingredient["ingredient_id"] . '" ' . $selectedIngredient . '>' . htmlspecialchars($ingredient["ingredient_name"]) . ' - ' . htmlspecialchars($ingredient["unit_measurement"]) . '</option>'; 
                                    }
                                    ?>
                                </select>
                            </label>
                            
                            <label>
                                Quantidade
                                <input type="number" name="quantity[]" value="<?php echo htmlspecialchars($ingredientRecipe['quantity']); ?>" minlength="1" maxlength="10">
                            </label>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                    <button type="button" id="add-ingredient" onclick="addIngredient()">Adicionar Ingrediente</button>
                    <button type="button" id="delete-ingredient" onclick="deleteIngredient()">Deletar Ingrediente</button>
                <br><br>
                <div>
                    <label>
                        Instruções
                        <textarea name="instructions" rows="5" cols="30" required minlength="50" maxlength="2000"><?php echo htmlspecialchars($recipe['instructions'] ?? ''); ?></textarea>
                    </label>
                </div>
                <br>
                <label>
                    Imagem (opcional)
                    <input type="file" name="image"> 
                </label>
            </div>
            <br>
            <div>
                <button type="submit" name="send">Atualizar</button>          
            </div> 
        </form>
    </main>
    <script src="../js/recipeupdate.js"></script>
</body>
</html>

