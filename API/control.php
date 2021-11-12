<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../style.css">
    <title>Document</title>
</head>
<body>
    <div class="table-container">
        <table border="1" >
            <thead class="tableHead">
                <th>Fecha</th>
                <th>Temperatura</th>
                <th>Humedad</th>   
            </thead>
          
            <tbody id="table">

            </tbody>
           <template id="tableTpl">
               <tr class="tableRow">
                    <th class='date'></th>
                    <th class='temperature'></th>
                    <th class='humidity'></th>
                </tr>
            </template>
        </table>
    </div>
    <script>
        
document.addEventListener('DOMContentLoaded', () => {
    refreshDatos(10);
    const refreshData = setInterval(() => {
        deleteRow();
        refreshDatos();  
    }, 10000);
});

function refreshDatos(amount){
    const currentUrl = window.location.href;
	const urlVariables = currentUrl.substring(currentUrl.lastIndexOf('?')+1);
	// Leemos los datos del JSON
	loadJson(`estaciones.php?${urlVariables}`,amount).then((filas) => fillTemplate(filas));
    // location.reload(true);
}

async function loadJson(url,limit=1) {
	const response = await fetch(url+"&limit="+limit);
	const data = await response.json();
	return data;
}

function deleteRow(){
    const container = document.querySelector('#table');
    const rowToDelete = container.querySelector("tr");
    container.removeChild(rowToDelete);
    // container.remove();
}


function fillTemplate(filas) {
	const container = document.querySelector('#table');
	const tpl = document.querySelector('#tableTpl').content;
	const fragment = document.createDocumentFragment();
	filas.forEach((fila, index) => {
		// container.innerHTML += fila.apodo;
		tpl.querySelector('.date').innerHTML = fila.fecha;
		tpl.querySelector('.temperature').innerHTML = fila.temperatura +"°C" ;
		tpl.querySelector(".humidity").innerHTML= fila.humedad  +" %";
		const clon = tpl.cloneNode(true);
		fragment.appendChild(clon);
	});
	container.appendChild(fragment);
    
}
    </script>
</body>
</html>