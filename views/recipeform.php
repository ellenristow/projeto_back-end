<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marmita</title>
</head>
<body>
    <main>
        <div>
            <h2>Insira sua receita</h2>
        </div>
        <form method="POST" action="<?php ROOT ?>/recipeform">
            <div>
                <label>
                    Nome da Receita
                    <input type="text" name="title" required minlength="3" maxlength="50">
                </label>
                <br>
                <br>
                <label>
                    Category
                    <select name="category" id="categories">
                        <?php
                            foreach($categories as $category){
                                echo '
                                    <option value="' .$category["category_id"]. '"> ' .$category["category_name"]. '</option>
                            
                                ';  
                        }
                    ?>
                    </select>
                    </label>
                    <br>
                        <button id="add">Adicionar Categoria</button> 
                    <br>
                <br>
                <br>
                <div>
                    <label>
                        Ingrediente
                    <select name="ingredient" id="ingredients">
                        <?php
                            foreach($ingredients as $ingredient){
                                echo '
                                    <option value="' .$ingredient["ingredient_id"]. '"> ' .$ingredient["ingredient_name"]. ' - ' .$ingredient["unit_measurement"]. '</option>
                            
                                ';
                            }
                        ?>
                    </select>
                    </label>
                        <label>
                        Quantidade
                        <input type="text" name="quantity" required minlength="1" maxlength="10">
                    </label>
                    <span id="unit_measurement">ml</span>
                </div>
                <br>
                <button id="add">Adicionar Ingrediente</button> 
                <br>
                <br>
                <label>
                    Instruções
                    <textarea name="instructions" rows="5" cols="30" required minlength="50" maxlength="2000"></textarea>
                </label>
                <br>
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
        <div>
            <p><a href="<?php ROOT ?>/">Voltar para a Home</a></p>
        </div>
    </main>
</body>