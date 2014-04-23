<?php
$interseccionJSON = json_decode($_POST['interseccion'], true);
//var_dump($interseccionJSON);

$conectar = new MongoClient("mongodb://JAYROSERVER-PC:27017");
$db = $conectar->QualityCounts;
$collection = $db->intersecciones;


$resultado = $collection->save($interseccionJSON);

$error = $db->lastError();

if($error['err']==null){
echo(json_encode($resultado)); 
}
else {
   echo $error['err'];
}

$conectar->close();
?>