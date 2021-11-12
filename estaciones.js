async function loadJson() {
	const response = await fetch('API/estaciones.php');
	// const response = await fetch('API/estaciones.php?id=3099812');
	// const response = await fetch('API/estaciones.php?id=3099812&limit=3');
	const data = await response.json();
	return data;
}

document.addEventListener('DOMContentLoaded', () => {
	loadJson().then((filas) => fillCard(filas));
});

function fillCard(filas) {
	const container = document.querySelector('.container');
	const tpl = document.querySelector('#cardTpl').content;
	const fragment = document.createDocumentFragment();
	let i = 0;
	filas.forEach((fila, index) => {
		// container.innerHTML += fila.apodo;
		tpl.querySelector('.card__number').innerHTML = "#" + i;
		tpl.querySelector('.nickname').innerHTML = fila.apodo;
		tpl.querySelector('.location').innerHTML = fila.ubicacion;
		tpl.querySelector('.link--table').href = `API/control.php?id=${fila.chipId}`;
		tpl.querySelector('.link--graphics').href = `graphics.html?id=${fila.chipId}`;
		const clon = tpl.cloneNode(true);
		fragment.appendChild(clon);
		i++;
	});
	container.appendChild(fragment);
}