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
            <h2>Insira sua receita</h2>
        </div>
        <form method="POST" action="<?php echo ROOT ?>/recipeform">
            <div>
                <label>
                    Nome da Receita
                    <input type="text" name="title" required minlength="3" maxlength="50">
                </label>
                <br><br>
                <div id="categories-container">
                    <div class="category-group">
                        <label>
                            Categoria
                            <select name="category_id[]">
                                <?php
                                    if (isset($categories) && is_array($categories) && count($categories) > 0) {
                                        foreach($categories as $category){
                                            echo '<option value="' . $category["category_id"] . '">' . htmlspecialchars($category["category_name"]) . '</option>';  
                                        }
                                    } else {
                                        echo '<option value="">Nenhuma categoria disponível</option>';
                                    }
                                ?>
                            </select>
                        </label>
                    </div>
                </div>
                <button type="button" id="add-category" onclick="addCategory()">Adicionar Categoria</button>
                <br>
                <div id="ingredients-container">
                    <div class="ingredient-group">
                        <label>
                            Ingrediente
                            <select name="ingredient_id[]">
                                <?php
                                    if (isset($ingredients) && is_array($ingredients) && count($ingredients) > 0) {
                                        foreach($ingredients as $ingredient){
                                            echo '<option value="' . $ingredient["ingredient_id"] . '">' . htmlspecialchars($ingredient["ingredient_name"]) . ' - ' . htmlspecialchars($ingredient["unit_measurement"]) . '</option>';  
                                        }
                                    } else {
                                        echo '<option value="">Nenhum ingrediente disponível</option>';
                                    }
                                ?>
                            </select>
                        </label>
                        <label>
                            Quantidade
                            <input type="text" name="quantity[]" required minlength="1" maxlength="10">
                        </label>
                        <span class="unit_measurement"></span>
                    </div>
                </div>
                <button type="button" id="add-ingredient" onclick="addIngredient()">Adicionar Ingrediente</button>
                <br>
                <div>
                    <label>
                        Instruções
                        <textarea name="instructions" rows="5" cols="30" required minlength="50" maxlength="2000"></textarea>
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
                <button type="submit" name="send">Enviar</button>
            </div> 
        </form>
    </main>
    <script src="../js/recipeform.js"></script>
</body>
</html>