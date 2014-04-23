<?php 
include('../config.php');
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Quality Counts</title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="..\bootstrap-3.1.1\css\bootstrap.css">
<style>
html, body{
	height: 100%;
}
hr{
color: #000;
background-color: #000;
height: 1px;
}

.altoCompleto{
	height: 100%;
}
.alto10{
	height: 10%;
}
.alto15{
	height: 15%;
}
.alto85{
	height: 85%;
}
.alto80{
	height: 80%;
}
.alto45{
	height: 45%;
}
.alto65{
	height: 65%;
}
.alto50{
	height: 50%;
}
.alto75{
	height: 75%;
}
.alto20{
	height: 20%;
}
.alto30{
	height: 30%;
}
.scroll{
	overflow-x:hidden;
}
.capturaEvt{
 margin-top:1px;
}
#TiempoActual{
	font-size: 20px;
}
 
.table-extraCondensed > thead > tr > th,
.table-extraCondensed > tbody > tr > th,
.table-extraCondensed > tfoot > tr > th,
.table-extraCondensed > thead > tr > td,
.table-extraCondensed > tbody > tr > td > p,
.table-extraCondensed > tbody > tr > td,
.table-extraCondensed > tfoot > tr > td {
	margin: 0px;
	padding: 0px;
	font-size: 13px;
}
td{
	width:15%;
}
</style>
</head>
<body class="container-fluid">
<head class="container"> <!-- barra de opciones -->
	 <div id="PHPinfo">
     
   </div>
</head>





<div class="row altoCompleto">


<div id="datosInterseccion" class="container-fluid"> <!-- Informacion de la interseccion -->
</div>


<div class="col-lg-3 altoCompleto">
<!-- INICIO datos de el intervalo -->
<div id="datosIntervalo" class="col-lg-12 bg-success alto30" > 
  <div class="row">
    <button id="guardar" class="btn col-lg-12">Guardar</button>
  </div>
  <div id="currentInfo" class="row">
    <span class="col-lg-12"> <h3># Intervalo <span id="actualIntervalo"></span> De <span id="cantidadIntervalos"></span></h3><span>
    <!-- Estado de intervalos -->
    <p class="col-lg-12"> <strong>Tiempo Actual </strong><span id="TiempoActual" class="label label-default"></span></p>
    <span class="col-lg-6"><h5>Desde <span id="intervaloDesde" class="label label-warning"></span></h5></span>
    <span class="col-lg-6"><h5>Hasta <span id="intervaloHasta" class="label label-warning"></span></h5></span>
  </div>
<!-- Reproductor de video -->
<div class="row">
  <div class="col-lg-10 btn-group btn-group-justified">
    <div class="btn-group">
      <button class="btn btn-primary" id="atrasar"><span class="glyphicon glyphicon-step-backward"></span></button>
    </div>
  <div class="btn-group">
    <button class="btn btn-primary" id="play"><span class="glyphicon glyphicon-play "></span></button>
  </div>
  <div class="btn-group">
    <button class="btn btn-primary" id="stop"><span class="glyphicon glyphicon-stop"></span></button>
  </div>
  <div class="btn-group">
    <button class="btn btn-primary" id="adelantar"><span class="glyphicon glyphicon-step-forward"></span></button>
  </div>
  <div class="btn-group">
    <button class="btn btn-primary" id="acelerar"><span class="glyphicon glyphicon-plus-sign"></span></button>
  </div>
  <div class="btn-group">
    <button class="btn btn-primary" id="desacelerar"><span class="glyphicon glyphicon-minus-sign"></span></button>
  </div>
</div>

</div>
</div><!--FIN datos de el intervalo -->
<!-- datos de Eventos -->
<div class="col-lg-12 bg-info alto65" id="regEvtcontainer"> 

<div class="alto10">
<h3>Eventos</h3>
<hr>
</div>

<div id="registroDeEventos" class="scroll alto80">
<div id="rde"></div>	
</div>
</div><!-- fIN datos de Eventos -->
</div>



<div class="col-lg-7">
<div class="row">
<video id="video" style="width:100%;" ></video>
</div>
</div>

<div class="col-lg-2 altoCompleto">

<div class="row-fluid alto30">

<!-- Bancos De Datos -->

<div class="row">
<!-- Banco 0 -->
<div class="col-lg-12">
<h4>Banco 0</h4>
<table id="tblbanco0" class="table table-extraCondensed table-bordered">

        <tr>
          <th colspan="3">Norte</th>
          <th colspan="2">Ped.</th>
          <th colspan="1"><span id="banco0NP" class=" movimientos label label-info ">0</span></th>
        </tr>

        <tr>
          <td>
          Este
          </td>
          <td> 
          <span id="banco0NE" class=" movimientos label label-success ">0</span>
          </td>
          <td>
          Sur
          </td>
          <td> 
          <span id="banco0NS" class=" movimientos label label-success ">0</span>
          </td>
          <td>
          Oeste
          </td>
          <td> 
          <span id="banco0NO" class=" movimientos label label-success ">0</span>
          </td>
        </tr>

        <tr>
          <th colspan="3">Oeste</th>
          <th colspan="2">Ped.</th>
          <th colspan="1"><span id="banco0OP" class=" movimientos label label-info ">0</span></th>
        </tr>

        <tr>
          <td>
          Este
          </td>
          <td> 
          <span id="banco0OE" class=" movimientos label label-primary ">0</span>
          </td>
          <td>
          Sur 
          </td>
          <td>
          <span id="banco0OS" class=" movimientos label label-primary ">0</span>
          </td>
          <td>
          Norte 
          </td>
          <td>
          <span id="banco0ON" class=" movimientos label label-primary ">0</span>
          </td>
        </tr>

        <tr>
          <th colspan="3">Sur</th>
          <th colspan="2">Ped.</th>
          <th colspan="1"><span id="banco0SP" class=" movimientos label label-info ">0</span></th>
        </tr>

        <tr>
          <td>
          Este
          </td>
          <td>
          <span id="banco0SE" class=" movimientos label label-warning ">0</span>
          </td>
          <td>
          Norte 
          </td>
          <td>
          <span id="banco0SN" class=" movimientos label label-warning ">0</span>
          </td>
          <td>
          Oeste 
          </td>
          <td>
          <span id="banco0SO" class=" movimientos label label-warning ">0</span>
          </td>
        </tr>

        <tr>
          <th colspan="3">Este</th>
          <th colspan="2">Ped.</th>
          <th colspan="1"><span id="banco0EP" class=" movimientos label label-info ">0</span></th>
        </tr>

        <tr>
          <td>
          Norte
          </td>
          <td>
          <span id="banco0EN" class=" movimientos label label-danger ">0</span>
          </td>
          <td>
          Sur
          </td>
          <td> 
          <span id="banco0ES" class=" movimientos label label-danger ">0</span>
          </td>
          <td>
          Oeste
          </td>
          <td> 
          <span id="banco0EO" class=" movimientos label label-danger ">0</span>
          </td>
        </tr>

      
    </table>

</div>
<!-- Banco 1 -->
<div class="col-lg-12">
<h4>Banco 1</h4>
<table id="tblbanco1" class="table table-extraCondensed table-bordered">

        <tr>
          <th colspan="3">Norte</th>
          <th colspan="2">RTRL</th>
          <th colspan="1"><span id="banco1NP" class=" movimientos label label-info ">0</span></th>
        </tr>

        <tr>
          <td>
          Este
          </td>
          <td>
           <span id="banco1NE" class=" movimientos label label-success ">0</span>
          </td>
          <td>
          Sur
          </td>
          <td> 
          <span id="banco1NS" class=" movimientos label label-success ">0</span>
          </td>
          <td>
          Oeste
          </td>
          <td> 
          <span id="banco1NO" class=" movimientos label label-success ">0</span>
          </td>
        </tr>

        <tr>
          <th colspan="3">Oeste</th>
          <th colspan="2">RTRL</th>
          <th colspan="1"><span id="banco1OP" class=" movimientos label label-info ">0</span></th>
        </tr>

        <tr>
          <td>
          Este 
          </td>
          <td>
          <span id="banco1OE" class=" movimientos label label-primary ">0</span>
          </td>
          <td>
          Sur
          </td>
          <td> 
          <span id="banco1OS" class=" movimientos label label-primary ">0</span>
          </td>
          <td>
          Norte
          </td>
          <td> 
          <span id="banco1ON" class=" movimientos label label-primary ">0</span>
          </td>
        </tr>

        <tr>
          <th colspan="3">Sur</th>
          <th colspan="2">RTRL</th>
          <th colspan="1"><span id="banco1SP" class=" movimientos label label-info ">0</span></th>
        </tr>

        <tr>
          <td>
          Este 
          </td>
          <td>
          <span id="banco1SE" class=" movimientos label label-warning ">0</span>
          </td>
          <td>
          Norte 
          </td>
          <td>
          <span id="banco1SN" class=" movimientos label label-warning ">0</span>
          </td>
          <td>
          Oeste 
          </td>
          <td>
          <span id="banco1SO" class=" movimientos label label-warning ">0</span>
          </td>
        </tr>

        <tr>
          <th colspan="3">Este</th>
          <th colspan="2">RTRL</th>
          <th colspan="1"><span id="banco1EP" class=" movimientos label label-info ">0</span></th>
        </tr>

        <tr>
          <td>
          Norte 
          </td>
          <td>
          <span id="banco1EN" class=" movimientos label label-danger ">0</span>
          </td>
          <td>
          Sur 
          </td>
          <td>
          <span id="banco1ES" class=" movimientos label label-danger ">0</span>
          </td>
          <td>
          Oeste 
          </td>
          <td>
          <span id="banco1EO" class=" movimientos label label-danger ">0</span>
          </td>
        </tr>

      
    </table>

</div>

<!-- Banco 2 -->
<div class="col-lg-12">
<h4>Banco 2</h4>
<table id="tblbanco2" class="table table-extraCondensed table-bordered">

        <tr>
          <th colspan="3">Norte</th>
          <th colspan="2">U Turn</th>
          <th colspan="1"><span id="banco2NP" class=" movimientos label label-info ">0</span></th>
        </tr>

        <tr>
          <td>
          Este 
          </td>
          <td>
          <span id="banco2NE" class=" movimientos label label-success ">0</span>
          </td>
          <td>
          Sur 
          </td>
          <td>
          <span id="banco2NS" class=" movimientos label label-success ">0</span>
          </td>
          <td>
          Oeste 
          </td>
          <td>
          <span id="banco2NO" class=" movimientos label label-success ">0</span>
          </td>
        </tr>

        <tr>
          <th colspan="3">Oeste</th>
          <th colspan="2">U Turn</th>
          <th colspan="1"><span id="banco2OP" class=" movimientos label label-info ">0</span></th>
        </tr>

        <tr>
          <td>
          Este 
          </td>
          <td>
          <span id="banco2OE" class=" movimientos label label-primary ">0</span>
          </td>
          <td>
          Sur 
          </td>
          <td>
          <span id="banco2OS" class=" movimientos label label-primary ">0</span>
          </td>
          <td>
          Norte 
          </td>
          <td>
          <span id="banco2ON" class=" movimientos label label-primary ">0</span>
          </td>
        </tr>

        <tr>
          <th colspan="3">Sur</th>
          <th colspan="2">U Turn</th>
          <th colspan="1"><span id="banco2SP" class=" movimientos label label-info ">0</span></th>
        </tr>

        <tr>
          <td>
          Este 
          </td>
          <td>
          <span id="banco2SE" class=" movimientos label label-warning ">0</span>
          </td>
          <td>
          Norte 
          </td>
          <td>
          <span id="banco2SN" class=" movimientos label label-warning ">0</span>
          </td>
          <td>
          Oeste 
          </td>
          <td>
          <span id="banco2SO" class=" movimientos label label-warning ">0</span>
          </td>
        </tr>

        <tr>
          <th colspan="3">Este</th>
          <th colspan="2">U Turn</th>
          <th colspan="1"><span id="banco2EP" class=" movimientos label label-info ">0</span></th>
        </tr>

        <tr>
          <td>
          Norte 
          </td>
          <td>
          <span id="banco2EN" class=" movimientos label label-danger ">0</span>
          </td>
          <td>
          Sur 
          </td>
          <td>
          <span id="banco2ES" class=" movimientos label label-danger ">0</span>
          </td>
          <td>
          Oeste 
          </td>
          <td>
          <span id="banco2EO" class=" movimientos label label-danger ">0</span>
          </td>
        </tr>

      
    </table>

</div>

</div>


</div>
</div>

</div>

<div class="container" id="test">
	
</div>


<footer class="container"> <!-- barra de estado -->  
	
</footer>
<script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script type="text/javascript" src="motorV.js"></script>
<script type="text/javascript" src="controlQC.js"></script>

<script type="text/javascript">
//insatancia he inicio
var QC,nombreInterseccion,MediaURL;
MediaURL = '<?php echo MEDIA;?>';
nombreInterseccion = '<?php echo $_GET['nombreInterseccion'];?>';
QC = new Cod_QC(nombreInterseccion);

/*$.getJSON('getInterseccion.php', {nombreInterseccion: 'prueba1'}, function(data, textStatus) {
    

    console.log(data);

    

});*/

/*
* CLAVE DE TECLAS DE EL TECLADO QUALITY COUNTS
* La captura de reqgistros se toma segun la  vista el reporte es otra situacion
* -----NORTE
* Norte a Sur = 114 (R) ; Norte a Este = 102 (F); Norte a Oeste = 52 (4);
* -----SUR
* Sur a Norte = 89 (Y); Sur a Oeste = 54(6); Sur a Este = 72(H);
* -----OESTE
* Oeste a Este = 84 (T); Oeste a Norte = 53 (5); Oeste a Sur = 71 (G);
* -----ESTE
* Este a Oeste = 77 (U); Este a Norte = 74 (J); Este a Sur = 55 (7);
* 
* ----------CRUCE DE PEATONES POR
* Norte = 86 (V);
* Sur = 78 (N);
* Oeste = 66 (B);
* Este = 77 (M);
*
* ----------ACTIVACION DE BANCOS
* Banco 0 = default (K);
* Banco 1 = (I);
* Banco 2 = (O);
*
*
*
*/

//inicio de controles

//Dar enfoque a la la pantalla para poder leer el teclado
$( document ).focus();
// otorgamos la funcion key press a el documento
$(document).keypress(function( event ) {
 event.preventDefault();
 evaluarTecla(event.which);
}); 

//evaluacion de la tecla seleccionada
var evaluarTecla = function(key){
    e={};
    e.evtMsg="sin movimientos";
   //tomar acciones sobre la tecla se leccionada
   switch(key){
   	// -----NORTE
    // Norte a Sur = 114 (R) ; 
   	case 114:
   	case 82:
   	e.evtMsg = "Norte a Sur | Banco: ";
   	e.movimiento = "NS";
   	regisroDeEventos(e);
   	break;
   	// Norte a Este = 102 (F);
   	case 102:
   	case 70:
   	e.evtMsg = "Norte a Este | Banco: ";
   	e.movimiento = "NE";
   	regisroDeEventos(e);
   	break;
   	// Norte a Oeste = 52 (4);
   	case 52:
   	e.evtMsg = "Norte a Oeste | Banco: ";
   	e.movimiento = "NO";
   	regisroDeEventos(e);
   	break;

	//-----SUR
	// Sur a Norte = 89 (Y);
	case 89:
	case 121:
   	e.evtMsg = "Sur a Norte| Banco:";
   	e.movimiento = "SN";
   	regisroDeEventos(e);
   	break;
   	// Sur a Oeste = 54(6);
   	case 54:
   	e.evtMsg = "Sur a Oeste | Banco: ";
   	e.movimiento = "SO";
   	regisroDeEventos(e);
   	break;
   	// Sur a Este = 72(H);
   	case 72:
   	case 104:
   	e.evtMsg = "Sur a Este | Banco: ";
   	e.movimiento = "SE";
   	regisroDeEventos(e);
   	break;

	// -----OESTE
	// Oeste a Este = 84 (T);
	case 84:
	case 116:
   	e.evtMsg = "Oeste a Este | Banco: ";
   	e.movimiento = "OE";
   	regisroDeEventos(e);
   	break;
   	// Oeste a Norte = 53 (5);
   	case 53:
   	e.evtMsg = "Oeste a Norte | Banco: ";
   	e.movimiento = "ON";
   	regisroDeEventos(e);
   	break;
   	// Oeste a Sur = 71 (G);
   	case 71:
   	case 103:
   	e.evtMsg = "Oeste a Sur | Banco: ";
   	e.movimiento = "OS";
   	regisroDeEventos(e);
   	break;
	// -----ESTE
	//Este a Oeste = 77 (U); 
    case 117:
    case 85:
   	e.evtMsg = "Este a Oeste | Banco: ";
   	e.movimiento = "EO";
   	regisroDeEventos(e);
   	break;
   	//Este a Norte = 74 (J);
   	case 74:
   	case 106:
   	e.evtMsg = "Este a Norte | Banco: ";
   	e.movimiento = "EN";
   	regisroDeEventos(e);
   	break;
   	//Este a Sur = 55 (7);
   	case 55:
   	e.evtMsg = "Este a Sur | Banco: ";
   	e.movimiento = "ES";
   	regisroDeEventos(e);
   	break;
    //----------CRUCE DE PEATONES POR
	// Norte = 86 (V);
	case 86:
	case 118:
	e.evtMsg = "Peaton por Norte | Banco: ";
   	e.movimiento = "NP";
   	regisroDeEventos(e);
   	console.log("Evento x rama Norte (peatones) = "+key);
   	break;
	// Sur = 78 (N);
	case 78:
	case 110:
	e.evtMsg = "Peaton por Sur | Banco: ";
   	e.movimiento = "SP";
   	regisroDeEventos(e);	
   	console.log("Evento x rama Sur (peatones) = "+key);
   	break;
	// Oeste = 66 (B);
	case 66:
	case 98:
	e.evtMsg = "Peaton por Oeste | Banco: ";
   	e.movimiento = "OP";
   	regisroDeEventos(e);	
   	console.log("Evento x rama Oeste (peatones) = "+key);
   	break;
	// Este = 77 (M);
	case 77:
	case 109:
	e.evtMsg = "Peaton por Este | Banco: ";
   	e.movimiento = "EP";
   	regisroDeEventos(e);	
   	console.log("Evento x rama Este (peatones) = "+key);
   	break;

   	// Banco 1;
	case 73:
	case 105:
	QC.setBancoActual(1);
   	console.log("Cambiamos a banco 1");
   	break;

   	// Banco 2;
	case 79:
	case 111:
	QC.setBancoActual(2);
   	console.log("Cambiamos a banco 2");
   	break;

    //CUALQUIER OTRA TECLA
   	default:
   	console.log("Tecla Sin actividad: "+key);
   	break;
   }
 


}  

var non = true;
var regisroDeEventos = function(evento){
//imprimimos en pantalla en la lista de eventos
var options,
	intervaloActual = QC.intervalos("actual"),
	bancoActual = QC.getBancoActual(),idTiempo = QC.getIdTiempo(), segVideo = QC.getCurrentTime("segundos");


if(non){
      options={
               backgroundColor: "#024C68",
               color: "#fff"
              };
       non=false;
}else{
	  options={
               backgroundColor: "#226078",
               color: "#fff"
              };
       non=true;       
}
  	
 var capturaEvt = $("<div name='"+idTiempo+"' class='capturaEvt '><small>"+evento.evtMsg+bancoActual+" </small><br><small>T: "+QC.getCurrentTime("formato")+" | Intervalo: "+intervaloActual+"</small></div>").insertAfter('#rde').animate(options, 1000 );

// guardar evento en banco

      var datosEvento = {intervalo: intervaloActual,
	           			banco:"banco"+bancoActual,
	           			direccion:evento.movimiento,
                  idTiempo : idTiempo,
                  segVideo : segVideo
	       				}
     console.log(datosEvento);


QC.intervalos({guardar:datosEvento});





 capturaEvt.dblclick(function(event) {
 	/* Act on the event */
 	event.preventDefault();
 	QC.eliminarCaptura($(this).attr("name"));
 });


}




</script>
</body>
</html>