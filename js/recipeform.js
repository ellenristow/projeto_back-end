function addCategory() {
	const categoriesContainer = document.getElementById('categories-container');
	const newCategoryDiv = document.createElement('div');
	newCategoryDiv.classList.add('category-group');
	newCategoryDiv.innerHTML = `
        <label>
            Categoria
            <select name="category_id[]">
                ${categories.map(category => `<option value="${category.category_id}">${category.category_name}</option>`).join('')}
            </select>
        </label>
    `;
	categoriesContainer.appendChild(newCategoryDiv);
}

function deleteCategory() {
	const categoriesContainer = document.getElementById('categories-container');
	const lastCategory = categoriesContainer.querySelector('.category-group:last-child');

	if (lastCategory) {
		lastCategory.remove();
	}
}

function addIngredient() {
	const ingredientsContainer = document.getElementById('ingredients-container');
	const newIngredientDiv = document.createElement('div');
	newIngredientDiv.classList.add('ingredient-group');
	newIngredientDiv.innerHTML = `
        <label>
            Ingrediente
            <select name="ingredient_id[]">
                ${ingredients.map(ingredient => `<option value="${ingredient.ingredient_id}">${ingredient.ingredient_name} - ${ingredient.unit_measurement}</option>`).join('')}
            </select>
        </label>
        <label>
            Quantidade
            <input type="number" name="quantity[]" minlength="1" maxlength="10">
        </label>
        <span class="unit_measurement"></span>
    `;
	ingredientsContainer.appendChild(newIngredientDiv);
}

function deleteIngredient() {
	const ingredientsContainer = document.getElementById('ingredients-container');
	const lastIngredient = ingredientsContainer.querySelector('.ingredient-group:last-child');

	if (lastIngredient) {
		lastIngredient.remove();
	}
}
