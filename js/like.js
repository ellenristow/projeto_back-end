function recipeLike(recipeId) {
	const likeBtn = document.getElementById('like-btn');
	const likeCount = document.getElementById(`like-count-${recipeId}`);

	let countLikes = parseInt(likeCount.innerText);

	likeBtn.addEventListener('click', function () {
		countLikes += 1;

		likeCount.innerText = countLikes;
	});
}

recipeLike();
