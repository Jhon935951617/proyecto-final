<?php
$link = 'receta';
include('header.php');
include('./bd.php');

?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 style="width: fit-content;" class="h2">¡Receta Aleatoria!</h1>
	<a href="receta.php" class="btn btn-success btn-sm"><i class="fa-solid fa-utensils"></i> Mostrar una nueva receta</a>
</div>

<div class="container">
	<div class="titulo" id="titulo" style="font-size: 1.5rem; font-weight: 600;"></div>
	<div class="imagen">
		<img src="" alt="" id="imagen">
		<a style="display: block; width: fit-content;" target="_blank" href="" title="Mas información" id="masinfo">Mas información</a>
	</div>
	<div class="titulo" id="titulo">Ingredients</div>
	<ul class="ingredientes" id="ingredientes"></ul>
	<div class="titulo" id="titulo">Preparation</div>
	<ol class="preparacion" id="preparacion"></ol>
</div>
<script>
	const getReceta = async ()=>{
		const res = await fetch('api.php', {
			method: 'post',
		});
		if(res.ok){
			const resJson = await res.json();
			if(resJson){
				const receta = resJson.recipes[0];
				const nombre = receta.title;
				const imagen = receta.image;
				document.getElementById("titulo").textContent = nombre;
				document.getElementById("imagen").src = imagen;
				document.getElementById("masinfo").href = receta.sourceUrl;
				const baseUrl = "https://spoonacular.com/cdn/ingredients_100x100/";
				receta.extendedIngredients.forEach(element => {
					const li = document.createElement("li");
					li.innerHTML = `
						${element.original}
						<img src="${baseUrl}${element.image}" alt="${element.original}">
					`;
					document.getElementById("ingredientes").appendChild(li);
				});
				receta.analyzedInstructions[0].steps.forEach(element => {
					const li = document.createElement("li");
					li.innerHTML = `
						${element.step}
					`;
					document.getElementById("preparacion").appendChild(li);
				});
			}
		}
	}
	getReceta();
</script>
<?php
include('footer.php');
?>