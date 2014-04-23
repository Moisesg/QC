<?php 
$interseccion = json_decode($_POST['interseccion'], true);
$interseccion['_id'] = new MongoId($interseccion['_id']['$id']);
//var_dump($interseccion);

$conectar = new MongoClient("mongodb://JAYROSERVER-PC:27017");
$db = $conectar->QualityCounts;
$collection = $db->intersecciones;


$resultado = $collection->save($interseccion);

$error = $db->lastError();

if($error['err']==null){
echo(json_encode($resultado)); 
}
else {
   echo $error['err'];
}

$conectar->close();
?>
