<?php

//ESTO GENERA LOS REGISTROS AL AZAR

	include('includes/conectar.php');

	$sql=$conexion->query("SELECT * FROM topicos ORDER BY RAND() LIMIT 5");

	while($valores = mysqli_fetch_array($sql)){

		echo $valores['titulo'];
		echo "<br>";

	}


?>