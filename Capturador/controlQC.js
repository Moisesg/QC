function ControlQC () {
   
//inicio de controles

//Dar enfoque a la la pantalla para poder leer el teclado
$( document ).focus();
// otorgamos la funcion key press a el documento
$(document).keypress(function( event ) {
 event.preventDefault();
 evaluarTecla(event.which);
}); 

var evaluarTecla = function(key){
   alert(key);
}  


}