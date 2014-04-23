<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Lista Intersecciones</title>
<link rel="stylesheet" type="text/css" href="bootstrap-3.1.1\css\bootstrap.css">
</head>
<body>
<div class="container">
<div class="row">
<h1>Lista Intersecciones</h1>

<table class="table">
<tr>
	<th>Nombre intervalo</th>
	<th>Hora inicio conteo</th>
	<th>Hora Final conteo</th>
	<th>Codificador</th>
	<th>Ruta</th>
	<th>Fecha codificación</th>
	<th>-</th>
	<th>-</th>
	<th>-</th>
	<th>-</th>
</tr>

<?php
include('config.php');

$conectar = new MongoClient(BD);
$db = $conectar->QualityCounts;
$colIntersecciones = $db->intersecciones;

$consulta=array();
$elementos=array('nombreInterseccion'=> 1, 'horaInicioConteo'=> 1,'horaFinalConteo'=>1,'codificador'=> 1,'fechaCodificacion'=> 1,'video.direccion'=>1);
$intersecciones= $colIntersecciones ->find($consulta,$elementos);

$conectar->close();
foreach ($intersecciones as $interseccion){
        echo "<tr>";
			if (array_key_exists("nombreInterseccion",$interseccion) ){
			        echo "<td>".$interseccion['nombreInterseccion']."</td>";
			        echo "<td>".$interseccion['horaInicioConteo']."</td>";
			        echo "<td>".$interseccion['horaFinalConteo']."</td>";
			        echo "<td>".$interseccion['codificador']."</td>";
					echo "<td>".$interseccion['video']['direccion']."</td>";
					if (array_key_exists("fechaCodificacion",$interseccion) ){
					    echo "<td>".$interseccion['fechaCodificacion']."</td>";
					   }
					else{
					    echo "<td>&nbsp;</td>";
						}
			   		//echo $interseccion['_id']."<br/>". $interseccion['nombreInterseccion'];
			  		echo "<td><a href=./Capturador/index.php?nombreInterseccion=".$interseccion['nombreInterseccion'].">Captura</a></td>";
			        echo "<td><a href=./Reportes/index.php?nombreInterseccion=".$interseccion['nombreInterseccion'].">Reporte</a></td>";
			        echo "<td><a href=captura.php?editarInterseccion=".$interseccion['nombreInterseccion'].">Editar</a></td>";
			        echo "<td><a href=eliminarInterseccion.php?nombreInterseccion=".$interseccion['nombreInterseccion'].">Eliminar </a></td>";
			        echo "</tr>";
			   }
			else{
			    echo "";
			}
        }


?>

</table>

</div>

</div>

	
<script src="//code.jquery.com/jquery-1.9.1.js"></script>
</body>
</html>