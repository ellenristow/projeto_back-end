/* document.querySelectorAll('.delete-category').forEach(button => {
	button.addEventListener('click', function () {
		const recipeCategoryId = this.getAttribute('data-id');

		if (!confirm('Deseja apagar esta categoria?')) return;

		fetch('controllers/requests.php', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json',
			},
			body: JSON.stringify({ action: 'delete_category', recipe_category_id: recipeCategoryId }),
		})
			.then(response => response.json())
			.then(data => {
				if (data.success) {
					this.closest('.category-group').remove();
				} else {
					alert('Erro ao apagar a categoria. Tente novamente.');
				}
			})
			.catch(error => console.error('Erro na requisição:', error));
	});
}); */

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
            <input type="text" name="quantity[]" required minlength="1" maxlength="10">
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
