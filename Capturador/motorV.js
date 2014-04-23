function Cod_QC(nI)
{  
   var  _interseccionData, _reproduccion = {};
   var _i = {actual:1, bancoActual:0};  
    
   //primero obtener los datos de el estudio creado en archivo json
   //si estos ya na sido codificados antes
$.getJSON('getInterseccion.php', {nombreInterseccion: nI}, function(json, textStatus) {
    /* inicializar datos */
 
        _interseccionData = json;
        //set Video en el reproductor
        //_reproduccion.video_nombre     = json.video.nombre;
        _reproduccion.video_direccion  = MediaURL+json.video.direccion.slice(2);
console.log(_reproduccion.video_direccion);
        _reproduccion.horaInicioConteo = json.horaInicioConteo;
        _reproduccion.horasConteo      = json.horasConteo;
        _reproduccion.segInicioConteo  = json.segInicioConteo;
        _reproduccion.tiempoInicioVideo  = separadorTiempo(json.tiempoInicioVideo);
        _reproduccion.segFinalConteo = json.segFinalConteo;
        _reproduccion.segInicioVideo = json.segInicioVideo;
        _reproduccion.intervaloConteo = json.intervaloConteo;

        _i.datos = json.intervalos;
        _i.cantidadIntervalos = getCantIntervalos(json.intervalos);
 
        /*
         *   INCIAMOS EL PROGRAMA
        */
     var pasosInicio = $.Deferred( setVideo(), // set el video
                                   setInfoInterseccion(json), // set informacion de da linterseccion
                                   reimprimirMovimientosEnPantalla(1) // inicializamos los movimientos en pantalla con el primer intervalo
                                 );
         pasosInicio.done();
         pasosInicio.resolve( );
         
   });

   this.getBancoActual = function(){
    return _i.bancoActual
   }
   this.setBancoActual = function(numero){
     _i.bancoActual=numero;
   } 
   this.getCurrentTime = function(option){
    var currentTime = $("#video").get(0).currentTime,
        value;

    switch(option){
        case "segundos":
           value = currentTime;
        break;
        case "formato":
            value = horaToText(currentTime+_reproduccion.segInicioVideo);
        break;
    }   
    return value;

   }

   this.getIdTiempo = function(){
    return new Date().getTime();
   }
   
   //obtieene el valor de el intervalo
   this.intervalos = function(o){
    
     if(typeof o == "string")
     {//GETTER devuelve cualquier opcion
       return _i[o];
     }
     else if(typeof o == "object")
     {//SETTER 
       
       if(o.guardar !== undefined){
        //guardar en las variables de el navegador y hacer  guardado de base de datos
         _i.datos[o.guardar.intervalo][o.guardar.banco][o.guardar.direccion].conteo ++;
         _i.datos[o.guardar.intervalo][o.guardar.banco][o.guardar.direccion].eventos.push({idTiempo : o.guardar.idTiempo, segVideo : o.guardar.segVideo});
        console.log(_i.datos); 
        $("#"+o.guardar.banco+o.guardar.direccion).html(_i.datos[o.guardar.intervalo][o.guardar.banco][o.guardar.direccion].conteo)
           

        var dfd = $.Deferred();
     
         dfd.done(function( ) {
           $("#tbl"+o.guardar.banco).animate({backgroundColor: "#00ADEF"}, 20 );
         })
         .done(function( ) {
           $("#tbl"+o.guardar.banco).animate({backgroundColor: "#FFFFFF"}, 20 );
         });
         dfd.resolve( );

        // devolver el banco a el valor por default
         _i.bancoActual=0;  
       }
            

     }
   }
   
       



   function getCantIntervalos(i){
    // i = intervalos en formato de base de datos
    var cantInt = 0;
    for (key in _i.datos) {
       cantInt++;
    }
    return cantInt;
   };
   
   //separador de formato de tiempo  en horas minutos y segundos
   //separadorTiempo("00:00:00")
    function separadorTiempo(tiempoStr){
        var tiempoArray = tiempoStr.split(":"); 
        var TIV = {};
                    TIV.horas = parseInt(tiempoArray[0]),
                    TIV.minutos = parseInt(tiempoArray[1]),
                    TIV.segundos = parseInt(tiempoArray[2])
         return TIV;
             
    }
//REGRESA EL FORMATO DE HIORA INTRODUCIDO EN SEGUNDOS
    function horaToText(s){
            hora = Math.floor(s/3400);
            minuto = Math.floor(((s/3600)-hora)*60);
            segundo = ((((s/3600)-hora)*60)-minuto)*60;
            segundo = Math.floor(segundo);
            if(hora<10){hora='0'+hora}
            if(minuto<10){minuto='0'+minuto}
            if(segundo<10){segundo='0'+segundo}

            return hora+":"+minuto+":"+segundo;
            //return hora+":"+minuto;
        }; 
    // SET LA INFORMACION DE INTERSECCION
    var setInfoInterseccion = function(d){
        var nombreDeInteseccion = d.nombreInterseccion,
            nombreDeCodificador = d.codificador,
            revisado = d.revisado,
            entregado = d.entregado;
        //imprimir informacion de la interseccion en el apartado    
        $('#datosInterseccion')
          .append(
            '<span class="col-lg-2"><small><b>Interseccion: </b><i>'+nombreDeInteseccion+'</i></small></span>'
           +'<span class="col-lg-2"><small><b>Codificador: </b><i>'+nombreDeCodificador+'</i></small></span>'
           // +'<span class="col-lg-2"><small><b>Revisado : </b><i>'+revisado+'</i></small></span>'
           // +'<span class="col-lg-2"><small><b>Entregado : </b><i>'+entregado+'</i></small></span>'
           +'<span class="col-lg-2"><small><b>Inicio de Conteo: </b><i>'+d.horaInicioConteo+'</i></small></span>'
           +'<span class="col-lg-2"><small><b>Horas de Conteo: </b><i>'+d.horasConteo+'</i></small></span>'
           +'<span class="col-lg-2"><small><b>Intervalo (Min): </b><i>'+d.intervaloConteo+'</i></small></span>'
                 );
        //imprimir informacion de  intervalo actual
        $('#actualIntervalo').html(1);
        // imprimir informacion de numero de intervalos 
        $('#cantidadIntervalos').html(_i.cantidadIntervalos);
    }

    //funcion que agrega la ruta de el video al reproductor
    var setVideo = function(){
        var src,v;
        v = $("#video");
        //Set fuente de el video 
        //src = rep.video_direccion+rep.video_nombre;
        src = _reproduccion.video_direccion;
        v.attr({src: src});
        v.on('canplay', iniciartodo());

        //agregar los controles a el elemento video
          function iniciartodo(){
            setTimeout(function(){
             $("#video").get(0).currentTime = _reproduccion.segInicioConteo;
             
            },500);
            
            
            setControles(v);
            setLineaDeReproduccion(v);

        } 
    }

    var setLineaDeReproduccion = function(v){
         
         
            //a agregamos el slider y sus bounds de reproduccion
            var sliderRango = $('<div id="sliderRango" class="col-lg-12"></div>')
                .insertAfter("video").slider({ 
                    min: _reproduccion.segInicioConteo, 
                    max:_reproduccion.segFinalConteo, 
                    animate: "fast",
                    slide: refreshVideo});
                
        //leer la posicion actual al momento de moverse el video
        setTimeUpdateEvent(v);
        
        //set rango bounds
                     $('#intervaloDesde').html(_i.datos[_i.actual].tiempo.TiempoDe);
                     $('#intervaloHasta').html(_i.datos[_i.actual].tiempo.TiempoA);
    }
    
    // actualizar posicion de Slider sugun la reproduccion de el video
    var setSliderPosition = function(currentTime){
        $( "#sliderRango" ).slider( "option", "value", currentTime );
    }
    // actualizar posicion de  video segun slider
    function refreshVideo() {
    var valorSlider = $( "#sliderRango" ).slider( "value" );
    $("#video").get(0).currentTime = valorSlider;
    console.log(valorSlider);

    }
    
    //Agregar la un un evento que ejecute los stats de el video
    //al momento de cambio en el current time
    var setTimeUpdateEvent = function(v){
        v.on('timeupdate', function () {
          //  s =  tiempoactual de reproduccion  
          s = $(this).get(0).currentTime;
          
          // verificamos que el video se esta reproduciendo dentro de los rangos establecidos 
          if(s < _reproduccion.segInicioConteo){ // si esta por de bajo de el rango
            //ajustar la linea de reproduccion al la hora minima de estudio
            $(this).get(0).currentTime = _reproduccion.segInicioConteo; 
            // enviar aviso de que se ha cometido un error en el sistema
            console.log("estamos por debajo de el limite inferior de la captura");}
          else if(s > _reproduccion.segFinalConteo){// si esta por arriba de el rango
            //establecer como tiempo actual de reproduccion el ultimo minuto de el rango  poner en pausa
            $(this).get(0).pause();
            $(this).get(0).currentTime = _reproduccion.segFinalConteo;
            //enviar aviso de tiempo de captura terminado
            //console.log("estamos por arriba de el limite superiro");
          }
          else{//estamos reproduciendo dentro de los rangos 
               // si el tiempo de reproduccion actual esta por fuera de el rango de el intervalo actual
               // actualizar intervalo actual si estamos fuera de el intervalo
                  //actualizamos la hora de captura actual en pantalla
                  $("#TiempoActual").html(horaToText(s+_reproduccion.segInicioVideo));
                 
                  if(!dentroDeIntervaloActual(s)){
                  console.log("estamos fuera de el primer rango se necesista cambiar de intervalo de captura"); 
                  // actualizar intervalo actual segun tiempo de reproduccion
                  var result = actualizarIntervaloActual(s);
                  if(!result.error){ 
                    // De no haver ningun error
                    // actualizamos el nuevo intervalo  
                     _i.actual =  result.nuevo;
                     $('#actualIntervalo').html(_i.actual);
                     //actualizar bounds de intervalo
                     $('#intervaloDesde').html(_i.datos[_i.actual].tiempo.TiempoDe);
                     $('#intervaloHasta').html(_i.datos[_i.actual].tiempo.TiempoA);
                     // REIMMPRIMIR DATOS DE MOVIMIENTO EN INTERVALO ACTUAL 
                     // EN  BANCOS DE PANTALLA
                     reimprimirMovimientosEnPantalla(_i.actual);

                  }else
                  {
                    //imprimir el error
                    console.log(result.errorMsg);  
                  }
               }
           
           }
          
          //actualizar la poscion de el slider
          setSliderPosition(s);
           
           //convertir a tiempo
     
        });       
    }
    
    
    var reimprimirMovimientosEnPantalla = function(intervalo){
       var bancos = ["banco0","banco1","banco2"]; 
                // borrar todos los datos de pantalla
                $(".movimientos").html("");
       for (var i = bancos.length - 1; i >= 0; i--) {           
                 
            for (key in _i.datos[intervalo][bancos[i]]) { // Recorremos el banco 0 del intervalo enviado 
                //imprimir la cantidad de movimientos por banco segun el intervalo a la vista en pantalla 
                $("#"+bancos[i]+key).html(_i.datos[intervalo][bancos[i]][key].conteo);
            };
            $("#test").append("<br>");
        };

    }
 

    var dentroDeIntervaloActual = function(seg){
         
         var de = _i.datos[_i.actual].tiempo.DeSeg,
              a = _i.datos[_i.actual].tiempo.ASeg,
              status;
         if(seg >= de && seg < a ){ status = true }// El tiempo de reproduccion esta dentro de los limites del intervalo actual
                              else{ status = false}// El tiempo de reproduccion esta fuera de los limetes del intervalo actual
         return status;                            
    } 

    var actualizarIntervaloActual = function(seg){
        //Comparamos el segundo de reproduccion con los limites de tiempo de intervalo
        var status;
        for (key in _i.datos) {
            if(seg >= _i.datos[key].tiempo.DeSeg && seg < _i.datos[key].tiempo.ASeg )
                { 
                status = {//encontrado 
                          nuevo : key,
                          anterior : _i.actual,
                          error: false  
                          }        
                break;
                }
            else{ 
                status = { error: true,
                           errorMsg: "este intervalo no se encuentra dentro del rengo de captura"
                         } //// no encontrado
                // no hacemos cambios
            }            
        };          
        return status; 
    }

     //BORRAR UN CAPTURA POR ID
      this.eliminarCaptura= function (idTiempo){
        console.log(_i.datos);
      }  


      //GUARDAR INFORMACION CAPTURADA EN LA BASE DE DATOS
      var guardarBD = function(){
        var json;
        //guardar los datos modificados
        _interseccionData.intervalos = _i.datos;
        json = JSON.stringify(_interseccionData);

        $.post('setInterseccion.php', {interseccion: json}, function(data, textStatus, xhr) {
          /*optional stuff to do after success */
          
          $('#PHPinfo').html(data);
        });

      };
    
    
    //agregar los controles a el video
    var setControles = function(v){        
        //set boton play - pause    
        $('#play').click(function(event) {
           //si esta en pause
           if(v.get(0).paused){
              //darle play  
              v.get(0).play();
              //cambiar etiqueta a pause
              $(this).children("span").addClass('glyphicon-pause');
           }
           else{
              //darle pause
              v.get(0).pause();
              //cambiar etiqueta a play
              $(this).children("span").removeClass('glyphicon-pause');
           }        
        });

     

        //set boton stop
         $('#stop').click(function(event) {
           v.get(0).pause();
           v.get(0).currentTime=_reproduccion.segInicioConteo;
           //cambiar etiqueta a play
             $('#play span').removeClass('glyphicon-pause');
          });

        //set boton atrasar
         $('#atrasar').click(function(event) {
           tiempoActual = v.get(0).currentTime;
           v.get(0).currentTime = tiempoActual-5;          
          });

        //set boton adelantar
         $('#adelantar').click(function(event) {
           tiempoActual = v.get(0).currentTime;
           v.get(0).currentTime = tiempoActual+5;
          });

         //set boton acelerar
         $('#acelerar').click(function(event) {
           v.get(0).playbackRate = 4.5;
          });
         
         //set boton desacelerrar
         $('#desacelerar').click(function(event) {
           v.get(0).playbackRate = 1;
          });

         //set boton Guardar
         $('#guardar').click(function(event) {
            //guaraar en base de datos
            guardarBD();
          });
    }
    
    



}