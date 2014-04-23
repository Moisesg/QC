<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
set_include_path(get_include_path() . PATH_SEPARATOR . '../Classes/');

require_once '../Classes/PHPExcel.php';
require_once '../Classes/PHPExcel/IOFactory.php';

$nombreInterseccion=$_GET['nombreInterseccion'];
$conectar = new MongoClient("mongodb://JAYROSERVER-PC:27017");
$db = $conectar->QualityCounts;
$colIntersecciones = $db->intersecciones;

$elemento=array('nombreInterseccion'=> $nombreInterseccion);

//db.intersecciones.find({nombreInterseccion:"p1"}).pretty()
$intersecciones=$colIntersecciones->find($elemento);

foreach ($intersecciones as $interseccion){

$cantidadDeIntervalos = sizeof($interseccion['intervalos']);
	
 for ($i=1; $i <= $cantidadDeIntervalos; $i++) {   
         for ($b=0; $b <=2; $b++) { 
              $numTotalAutos[] =$interseccion['intervalos'][$i]['banco'.$b]['NO']['conteo'];
              $numTotalAutos[] =$interseccion['intervalos'][$i]['banco'.$b]['NS']['conteo'];
              $numTotalAutos[] =$interseccion['intervalos'][$i]['banco'.$b]['NE']['conteo'];
              $numTotalAutos[] =$interseccion['intervalos'][$i]['banco'.$b]['NP']['conteo'];

              $numTotalAutos[] =$interseccion['intervalos'][$i]['banco'.$b]['EN']['conteo'];
              $numTotalAutos[] =$interseccion['intervalos'][$i]['banco'.$b]['EO']['conteo'];
              $numTotalAutos[] =$interseccion['intervalos'][$i]['banco'.$b]['ES']['conteo'];
              $numTotalAutos[] =$interseccion['intervalos'][$i]['banco'.$b]['EP']['conteo'];

              $numTotalAutos[] =$interseccion['intervalos'][$i]['banco'.$b]['SE']['conteo'];
              $numTotalAutos[] =$interseccion['intervalos'][$i]['banco'.$b]['SN']['conteo'];
              $numTotalAutos[] =$interseccion['intervalos'][$i]['banco'.$b]['SO']['conteo'];
              $numTotalAutos[] =$interseccion['intervalos'][$i]['banco'.$b]['SP']['conteo'];

              $numTotalAutos[] =$interseccion['intervalos'][$i]['banco'.$b]['OS']['conteo'];
              $numTotalAutos[] =$interseccion['intervalos'][$i]['banco'.$b]['OE']['conteo'];
              $numTotalAutos[] =$interseccion['intervalos'][$i]['banco'.$b]['ON']['conteo'];
              $numTotalAutos[] =$interseccion['intervalos'][$i]['banco'.$b]['OP']['conteo'];
            }

          }

 $totalAutos = array_sum($numTotalAutos);

	   for ($i=1; $i <= $cantidadDeIntervalos; $i++) {  
         $conteoNO[] =$interseccion['intervalos'][$i]['banco0']['NO']['conteo'];
         $conteoNO[] =$interseccion['intervalos'][$i]['banco1']['NO']['conteo'];
         $conteoNO[] =$interseccion['intervalos'][$i]['banco2']['NO']['conteo'];
       }

        for ($i=1; $i <= $cantidadDeIntervalos; $i++) {  
         $conteoNS[] =$interseccion['intervalos'][$i]['banco0']['NS']['conteo'];
         $conteoNS[] =$interseccion['intervalos'][$i]['banco1']['NS']['conteo'];
         $conteoNS[] =$interseccion['intervalos'][$i]['banco2']['NS']['conteo'];
       }
                 
	  for ($i=1; $i <= $cantidadDeIntervalos; $i++) {  
         $conteoNE[] =$interseccion['intervalos'][$i]['banco0']['NE']['conteo'];
         $conteoNE[] =$interseccion['intervalos'][$i]['banco1']['NE']['conteo'];
         $conteoNE[] =$interseccion['intervalos'][$i]['banco2']['NE']['conteo'];
       }

       for ($i=1; $i <= $cantidadDeIntervalos; $i++) {  
         $conteoNP[] =$interseccion['intervalos'][$i]['banco0']['NP']['conteo'];
         $conteoNP[] =$interseccion['intervalos'][$i]['banco1']['NP']['conteo'];
         $conteoNP[] =$interseccion['intervalos'][$i]['banco2']['NP']['conteo'];
       } 

       for ($i=1; $i <= $cantidadDeIntervalos; $i++) {  
         $conteoEN[] =$interseccion['intervalos'][$i]['banco0']['EN']['conteo'];
         $conteoEN[] =$interseccion['intervalos'][$i]['banco1']['EN']['conteo'];
         $conteoEN[] =$interseccion['intervalos'][$i]['banco2']['EN']['conteo'];
       }  

		for ($i=1; $i <= $cantidadDeIntervalos; $i++) {  
         $conteoEO[] =$interseccion['intervalos'][$i]['banco0']['EO']['conteo'];
         $conteoEO[] =$interseccion['intervalos'][$i]['banco1']['EO']['conteo'];
         $conteoEO[] =$interseccion['intervalos'][$i]['banco2']['EO']['conteo'];
       }
                 
       for ($i=1; $i <= $cantidadDeIntervalos; $i++) {  
         $conteoES[] =$interseccion['intervalos'][$i]['banco0']['ES']['conteo'];
         $conteoES[] =$interseccion['intervalos'][$i]['banco1']['ES']['conteo'];
         $conteoES[] =$interseccion['intervalos'][$i]['banco2']['ES']['conteo'];
       }
                 
       for ($i=1; $i <= $cantidadDeIntervalos; $i++) {  
         $conteoEP[] =$interseccion['intervalos'][$i]['banco0']['EP']['conteo'];
         $conteoEP[] =$interseccion['intervalos'][$i]['banco1']['EP']['conteo'];
         $conteoEP[] =$interseccion['intervalos'][$i]['banco2']['EP']['conteo'];
       }
                 
		for ($i=1; $i <= $cantidadDeIntervalos; $i++) {  
         $conteoSE[] =$interseccion['intervalos'][$i]['banco0']['SE']['conteo'];
         $conteoSE[] =$interseccion['intervalos'][$i]['banco1']['SE']['conteo'];
         $conteoSE[] =$interseccion['intervalos'][$i]['banco2']['SE']['conteo'];
       }
                 
   		for ($i=1; $i <= $cantidadDeIntervalos; $i++) {  
         $conteoSN[] =$interseccion['intervalos'][$i]['banco0']['SN']['conteo'];
         $conteoSN[] =$interseccion['intervalos'][$i]['banco1']['SN']['conteo'];
         $conteoSN[] =$interseccion['intervalos'][$i]['banco2']['SN']['conteo'];
       }
                 
		for ($i=1; $i <= $cantidadDeIntervalos; $i++) {  
         $conteoSO[] =$interseccion['intervalos'][$i]['banco0']['SO']['conteo'];
         $conteoSO[] =$interseccion['intervalos'][$i]['banco1']['SO']['conteo'];
         $conteoSO[] =$interseccion['intervalos'][$i]['banco2']['SO']['conteo'];
       }
                 
		for ($i=1; $i <= $cantidadDeIntervalos; $i++) {  
         $conteoSP[] =$interseccion['intervalos'][$i]['banco0']['SP']['conteo'];
         $conteoSP[] =$interseccion['intervalos'][$i]['banco1']['SP']['conteo'];
         $conteoSP[] =$interseccion['intervalos'][$i]['banco2']['SP']['conteo'];
       }
                 
 		for ($i=1; $i <= $cantidadDeIntervalos; $i++) {  
           $conteoOS[] =$interseccion['intervalos'][$i]['banco0']['OS']['conteo'];
           $conteoOS[] =$interseccion['intervalos'][$i]['banco1']['OS']['conteo'];
           $conteoOS[] =$interseccion['intervalos'][$i]['banco2']['OS']['conteo'];
         }
                   
 		for ($i=1; $i <= $cantidadDeIntervalos; $i++) {  
           $conteoOE[] =$interseccion['intervalos'][$i]['banco0']['OE']['conteo'];
           $conteoOE[] =$interseccion['intervalos'][$i]['banco1']['OE']['conteo'];
           $conteoOE[] =$interseccion['intervalos'][$i]['banco2']['OE']['conteo'];
         }
                   
 		for ($i=1; $i <= $cantidadDeIntervalos; $i++) {  
           $conteoON[] =$interseccion['intervalos'][$i]['banco0']['ON']['conteo'];
           $conteoON[] =$interseccion['intervalos'][$i]['banco1']['ON']['conteo'];
           $conteoON[] =$interseccion['intervalos'][$i]['banco2']['ON']['conteo'];
         }
                   
 		for ($i=1; $i <= $cantidadDeIntervalos; $i++) {  
           $conteoOP[] =$interseccion['intervalos'][$i]['banco0']['OP']['conteo'];
           $conteoOP[] =$interseccion['intervalos'][$i]['banco1']['OP']['conteo'];
           $conteoOP[] =$interseccion['intervalos'][$i]['banco2']['OP']['conteo'];
         }
                   
$objPHPExcel = new PHPExcel();	
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
//->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP); ;
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', 'Job number')				    		
	  ->setCellValue('B1', $interseccion['nombreInterseccion'])	
    ->setCellValue('A3', 'Job number')				    						    		
	  ->setCellValue('B3', $interseccion['codificador'])

    ->setCellValue('A5', 'Time Used (seconds)')				    		
	  ->setCellValue('B5', $interseccion['tiempoUsadoSeg'])	
    ->setCellValue('A7', 'Total number of cars')				    						    		
	  ->setCellValue('B7', $totalAutos)

    ->setCellValue('A9', 'Time Used (hh:mm:ss)')				    		
	  ->setCellValue('B9', $interseccion['tiempoUsadoHora'])	
    ->setCellValue('A11', 'Cars per hour')				    						    		
	  ->setCellValue('B11', $carrosporHora = $totalAutos / $interseccion['horasConteo'] )
    ->setCellValue('A13', 'First interval')				    		
	  ->setCellValue('B13', $interseccion['horaInicioConteo'])	
    ->setCellValue('A15', 'Last interval')				    						    		
	  ->setCellValue('B15', $interseccion['horaFinalConteo'])
    ->setCellValue('A17', 'Counts')	
  	->setCellValue('B17', array_sum($conteoNO) )
  	->setCellValue('C17', array_sum($conteoNS) )
  	->setCellValue('D17', array_sum($conteoNE) )
  	->setCellValue('E17', array_sum($conteoNP) )
  	->setCellValue('F17', array_sum($conteoEN) )
  	->setCellValue('G17', array_sum($conteoEO) )
  	->setCellValue('H17', array_sum($conteoES) )
  	->setCellValue('I17', array_sum($conteoEP) )
  	->setCellValue('J17', array_sum($conteoSE) )
  	->setCellValue('K17', array_sum($conteoSN) )
  	->setCellValue('L17', array_sum($conteoSO) )
  	->setCellValue('M17', array_sum($conteoSP) )
  	->setCellValue('N17', array_sum($conteoOS) )
  	->setCellValue('O17', array_sum($conteoOE) )
  	->setCellValue('P17', array_sum($conteoON) )
  	->setCellValue('Q17', array_sum($conteoOP) );

}
														
$objPHPExcel->getActiveSheet()->setTitle('Count ');
$objPHPExcel->setActiveSheetIndex(0);

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$nombreInterseccion.'_Statistics.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>