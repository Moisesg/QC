<?php
require "readerDirectory.php";

// VARIABLES DEL SISTEMA
 $directorioMedia = "../Media";
 $rutaAuxiliar = "";
// instancia de classe LeerCarpeta
    $carpeta = new LeerCarpeta($directorioMedia);
    $res = $carpeta -> AbrirCarpeta();// abrir carpeta default
    $dir = json_encode($res,true);   

?>
<!DOCTYPE html>
<html>
<head>
	<title>Registro de Interseccion</title>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="..\bootstrap-3.1.1\css\bootstrap.css">
</head>
<body class="container">
 <header></header>
 <div class="row">
  <div class="jumbotron">
    <h1><strong>Registro de Intersecciones</strong></h1> 
  </div>
  
 	<div class=" col-lg-6">
  <div class="row">
    <div class="col-lg-12">
      <h3>Introduzca los datos de la interseccion</h3>
      <!-- nombre interseccion -->
      <div class="row">
        <div class="col-lg-12">
          <label for="nombre">Nombre Interseccion:</label>
          <input name="nombre" type="text" class="form-control" placeholder="Nombre de Interseccion ( Job Number )">
        </div>
      </div>
      <!-- Codificador -->
      <div class="row">
        <div class="col-lg-12">
          <label for="codificador">Codificador:</label>
          <input name="codificador" type="text" class="form-control" placeholder="Codificador">
        </div>
      </div>
      <!-- Ruta -->
      <div class="row">
        <div class="col-lg-12"> 
          <label for="RutaV">Ruta Video :</label>
          <input name="RutaV" type="text" class="form-control" placeholder="Seleccionar...">
          <button class="btn" id="verVideo">ver</button>
          <div class="row">
            <div class="col-lg-12 datosReproduccion">
            <!-- "tiempoInicioVideo" : "06:00:00", -->
            <!-- "segInicioVideo": 21600, -->
              <input name="hInicioVideo" type="text" class="form-control" value="06:00:00" placeholder="Hora de incio de VIDEO ( 23:59:59 )"> 
            <!-- "horaInicioConteo" : "07:00:00", -->
            <!-- "segInicioConteo" : 3600, -->
              <input name="hInicioConteo" type="text" class="form-control" value="07:00:00" placeholder="Hora de inicio de CONTEO ( 00:00:00 )">
            <!-- "horasConteo" : 0.5, -->
              <input name="hConteo" type="text" class="form-control" value="1" placeholder="Tiempo de conteo ( 0.00 )">
            <!-- "horaFinalConteo" : "07:30:00", -->                  
            <!-- "segFinalConteo" : 5400,  --> 
            <!-- "intervaloConteo" : 5, -->
              <input name="iConteo" type="text" class="form-control" value="5" placeholder="Minutos por intervalo">
            <button name="btnRevisar" class="btn btn-info col-lg-5">Revisar</button>      
            <button name="btnRegistrar" class="btn btn-primary col-lg-7" disabled="disabled">Registrar</button>
              
            </div>
            
          
          </div>        
        </div>
        <!-- datos de reproduccion -->
        <div class="col-lg-5 datosReproduccion">
          <video controls width = "500"></video>
        </div>
      
      </div>
    </div>
    </div>
 	</div>
  <hr> 
  <div class="col-lg-4">
  <div class="row">
    <!-- CONTENEDOR DE dIRECTORIO DE ARCHIVOS --> 
    <h2>Directorio de Archivos</h2>
    <h5>Selecciona un video</h5>
    <hr> 
    <h5><strong>Videos: Media\...</strong></h5>
    <div id="directorios" class="col-lg-12"></div>
    </div>
  </div>
 </div>
 <footer></footer>
<script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script type="text/javascript" src="bancos.js"></script>
<script type="text/javascript">
 
 var directorios, bancosJson,
 RutaV = $('[name=RutaV]'), btnRegistrar = $('[name = btnRegistrar]'),
 datosGuardar = {"video":{"nombre":"","direccion":""},"intervalos" :{}, tiempoUsadoSeg:0, tiempoUsadoHora:"00:00:00", fechaCodifiacion: null}; 
 directorios = <?= $dir;?>;
 
  //escinder datos de reproduccion
  $('.datosReproduccion').hide();

  

 // inspeccionar cada objeto 
    var imprimirElementos = function(obj,container,nomCarp){
      var lista = $("<ul name='"+nomCarp+"'></ul>");
      lista.appendTo(container);
      imprimir(obj,lista);
    }

    var imprimir = function(obj,lista){
      var elemento;
      $.each(obj, function(index, val) {
         /* iterar sobre un objeto o un array */
         elemento = $("<li name ='"+index+"'>"+index+"</li>");
         elemento.appendTo(lista);
         elemento.on("click",function(event) {
            event.stopPropagation();
            /* Abrir lista */
            $(this).children("ul").toggle();
          });
         elemento.on("dblclick",function(event) {
            event.stopPropagation();
            /* Listar carpetas */
            var carpetasContenedoras, ruta =$(this).attr("name");
            carpetasContenedoras = $(this).parents("ul");
            $(carpetasContenedoras).each(function(index, val) {
                /* iterate through array or object */
                var dir;
                dir = $(val).attr("name");
                //si el elemento no es la raiz
                if(dir !== 'raiz'){ruta = dir+"/"+ruta;}
             }); 
             RutaV.val(ruta);
          });

         if(typeof val === "object" && val !== null){
          imprimirElementos(val, elemento, index);
         }

         elemento.children().hide();
      });
    }

  if (directorios != undefined){
    //imprimir directorios
    imprimirElementos(directorios,"#directorios","raiz");
  }

  $('#verVideo').on('click', function(event) {
    event.preventDefault();
    var reproductor, rutaVideo;
    reproductor = $('video');
    rutaVideo = "../media/"+RutaV.val();

    /* asignar direccion a video */
    reproductor.attr({ src: "../media/"+RutaV.val() });
    
    //verifica si la direccion de el video es correcta
    reproductor.on("canplay",function(){
      //mostrar los datos de reproduccion
      $('.datosReproduccion').show('slow/400/fast', function() {
      // asignar variable glovales de direccion de el video
      datosGuardar.video.direccion = rutaVideo;

      });
    });

    // verifica si hay algun error en la inicializacion de el video
    reproductor.on("error",function(){
      //mostrar los datos de reproduccion
      alert('Error: Es posible que la ubicacion de el video sea incorrecta intente escogiendo una ruta valida');
    });         

  });

  $(".datosReproduccion").find("[name=btnRevisar]").on('click', function(event) {
      event.preventDefault();
      /* calcular datos de reproduccion */
      var hInicioVideo = $("[name = hInicioVideo]").val().trim(),
      hInicioConteo = $("[name = hInicioConteo]").val().trim(),
      hConteo = $("[name = hConteo]").val().trim(),
      iConteo = $("[name = iConteo]").val().trim(),
      valido = false, error = [], mensaje ="";

      //validar datos de horas de Conteo
      valido = validadorDecimal(hConteo);
      if(!valido)
      error.push("El tiempo de conteo estar en formato 0.00 horas"); 
      //validar hora de inicio de video
      valido = (valido && validatorTimeFormat(hInicioVideo))? true : false;
      if(!valido)
      error.push("La hora de incio de VIDEO deven de estar estar en formato 00:00:00");
      //validar hora de inicio de conteo
      valido = (valido && validatorTimeFormat(hInicioConteo))? true : false;
      if(!valido)
      error.push("La hora de incio de CONTEO deven de estar estar en formato 00:00:00");   
      //validar minutos de intervalo
      valido = (valido && validatorNumerico(iConteo))? true : false;
      if(!valido)
      error.push("El tiempo de intervalo deve estar en formato 00");

      function validatorNumerico (o){
        var re = /^\d+$/;
        return re.test(o);
      }
      function validadorDecimal (o){
        var re = /^\d+(\.\d{1,2})?$/;
        return re.test(o);
      }
      function validatorTimeFormat(o){
        var re = /^([0-9]{2})\:([0-9]{2})\:([0-9]{2})$/;
        return re.test(o);
      }      

      if(valido){
        /* Calcular los datos nescesarios */
        //"segInicioVideo": 21600, Con respecto al dia
        datosGuardar.segInicioVideo = Set_segInicioVideo(hInicioVideo);
        // "segInicioConteo" : 3600 
        datosGuardar.segInicioConteo = Set_segInicioVideo(hInicioConteo) - datosGuardar.segInicioVideo;
        // segFinalConteo" : 5400
        datosGuardar.segFinalConteo = datosGuardar.segInicioConteo + (parseFloat(hConteo) * 3600);     
        // horaFinalConteo" : "07:30:00"
        //en segundos x dia
        datosGuardar.horaFinalConteo = datosGuardar.segInicioVideo + datosGuardar.segFinalConteo;
        //en formato de hora
        datosGuardar.horaFinalConteo = Set_segToFormato(datosGuardar.horaFinalConteo);
        datosGuardar.horaInicioConteo = hInicioConteo;
        datosGuardar.tiempoInicioVideo = hInicioVideo;
        datosGuardar.horasConteo = parseFloat(hConteo);
        datosGuardar.intervaloConteo = parseInt(iConteo);  

        datosGuardar.nombreInterseccion = $("[name = nombre]").val().trim();
        datosGuardar.codificador = $("[name = codificador]").val().trim();
        

        if(validarDatosVideo()){
          
          //GENERAR INTERVALOS
          generarIntervalos();

        }      
        
      }else{
          mensaje = "Errores: "+ error.length +"\n";
          $.each(error, function(index, val) {
             /* Escribor los mensajes */
             mensaje += val+"\n";
          });
          alert(mensaje);  
      }

    });

  // SETTERS
  var Set_segInicioVideo = function(hora){
    var tiempo, segundos;
    tiempo = separadorTiempo(hora);
    //segundos por hora
    segundos = parseInt(tiempo.horas)*3600;
    //segundos por minuto
    segundos += parseInt(tiempo.minutos) * 60;
    segundos += parseInt(tiempo.segundos);
    return segundos;
  }; 
  
  function separadorTiempo(tiempoStr){
        /*Separador de tiempo.. en h m s*/
    var tiempoArray = tiempoStr.split(":"), TIV = {};
    TIV.horas = parseInt(tiempoArray[0]),
    TIV.minutos = parseInt(tiempoArray[1]),
    TIV.segundos = parseInt(tiempoArray[2])
    return TIV;             
  }

  function Set_segToFormato(s){
    /*Regresa  el tiempo en sefundos en formato 00:00:00*/
    var hora, minuto, segundo;
    hora = Math.floor(s/3600); 
    minuto =  Math.round(((s/3600) - hora)*60);
    segundo = Math.round(((((s/3600) - hora)*60) - minuto) * 60);
    
    if(hora<10){hora='0'+hora}
    if(minuto<10){minuto='0'+minuto}
    if(segundo<10){segundo='0'+segundo}
    return hora+":"+minuto+":"+segundo;
  };

  var validarDatosVideo = function(){
    /*validar los datos de video antes de guardarlos*/
    var error = [], mensaje="", valido = true;
    // siempre tiene que ser mayor el tiempo final que el tiempo inicial
    if(datosGuardar.segInicioConteo <= 0)
    { error.push(" Verifique que el tiempo de captura se encuentre en un rango valido ") } 
    
    if(error.length > 0){
      mensaje = "Errores: "+ error.length +"\n";
      $.each(error, function(index, val) {
        /* Escribor los mensajes */
        mensaje += val+"\n";
      });
      valido = false;
    alert(mensaje);  
    }
    return valido;
  } 

  var generarIntervalos = function(){
    var minutosConteo, cantIntervalos, segDelDia,segConteo;
    minutosConteo = datosGuardar.horasConteo * 60;
    cantIntervalos = minutosConteo / datosGuardar.intervaloConteo;
    
    
    segConteo = datosGuardar.segInicioConteo;
    segDelDia = datosGuardar.segInicioVideo + datosGuardar.segInicioConteo;

    for (var i = 1; i <= cantIntervalos; i++) {

      datosGuardar.intervalos[i] = new bancos().getBancos;
      datosGuardar.intervalos[i].tiempo.posicion = i;
      datosGuardar.intervalos[i].tiempo.ASeg = segConteo+300;
      datosGuardar.intervalos[i].tiempo.DeSeg = segConteo; 
      datosGuardar.intervalos[i].tiempo.TiempoA = Set_segToFormato(segDelDia);
      datosGuardar.intervalos[i].tiempo.TiempoDe = Set_segToFormato(segDelDia+(datosGuardar.intervaloConteo*60)); 
      
      console.log(segDelDia);
      console.log(datosGuardar.intervalos);
      segDelDia += 300;
      segConteo += 300;

    };
  
    btnRegistrar.prop('disabled', false);

  }

  


  btnRegistrar.on('click', function(event) {
    event.preventDefault();
    /* Guardar en setinterseccion */
    var inter = JSON.stringify(datosGuardar);
     $.post( "setinterseccion.php", {interseccion : inter}, function( data ) {
         console.log(data);
         if(data.err == null){
          alert("La interseccion se Guardo con exito");
         }else{
          alert("Ha ocurrido un problema al guardar en la base de datos: /n Error:"+ data.err);
         }
                  
         setDefault();
     });
    
  });

  // volver al estado inicial

  var setDefault = function(){
   // volver a desactivar el boton gardar
   btnRegistrar.prop('disabled', true);

   // poner en blanco los inputs nescesarios
   $('input').val("");

   //set default to variables
   datosGuardar = {"video":{"nombre":"","direccion":""},"intervalos" :{}, tiempoUsadoSeg:0, tiempoUsadoHora:"00:00:00", fechaCodifiacion: null};
    
   //ocultar datos del video 
    $('.datosReproduccion').hide('fast');

  }

</script>
</body>
</html>