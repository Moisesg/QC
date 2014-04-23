<?php


//echo json_encode($_GET['nombreInterseccion']);

$conectar = new MongoClient("mongodb://JAYROSERVER-PC:27017");
$db = $conectar->QualityCounts;
$collection = $db->intersecciones;

$consulta = array("nombreInterseccion" => $_GET['nombreInterseccion']);


$resultado = $collection->findOne($consulta);

$error = $db->lastError();

if($error['err']==null){
echo json_encode($resultado); 
}
else {
   echo $error['err'];
}

$conectar->close();
?>