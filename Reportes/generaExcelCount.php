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

$intersecciones=$colIntersecciones->find($elemento);

	foreach ($intersecciones as $interseccion){

	$cantidadDeIntervalos =  sizeof($interseccion['intervalos']);
		
	$objPHPExcel = new PHPExcel();	
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
	$objPHPExcel->setActiveSheetIndex(0)

	    ->setCellValue('A1', 'Job number')				    		
		->setCellValue('A2', 'Employee')
		->setCellValue('A3', 'Time')
		->setCellValue('A4', 'Bank number')

		->setCellValue('B1', $interseccion['nombreInterseccion'])				    		
		->setCellValue('B2', $interseccion['codificador'])

		->setCellValue('B3', 'SB Right')
		->setCellValue('C3', 'SB Thru')
		->setCellValue('D3', 'SB Left')
		->setCellValue('E3', 'SB Ped')

		->setCellValue('F3', 'WB Right')
		->setCellValue('G3', 'WB Thru')
		->setCellValue('H3', 'WB Left')
		->setCellValue('I3', 'WB Ped')

		->setCellValue('J3', 'NB right')
		->setCellValue('K3', 'NB Thru:' )
		->setCellValue('L3', 'NB Left')
		->setCellValue('M3', 'NB Ped')

		->setCellValue('N3', 'EB Right')
		->setCellValue('O3', 'EB Thru')
		->setCellValue('P3', 'EB Left')
		->setCellValue('Q3', 'EB Ped')
		->setCellValue('B4','0');	

		$posBanco0 = $cantidadDeIntervalos-1;

	    for ($i=1; $i <= $cantidadDeIntervalos; $i++) { 
	    	$datosObtenidosbanco0 = $interseccion['intervalos'][$i]['banco0'];
	    	$horaIntervalo = $interseccion['intervalos'][$i]['tiempo']['TiempoDe'];

	    	$objPHPExcel->setActiveSheetIndex(0)
	           	->setCellValue('A'.$posBanco0, $horaIntervalo)		
				->setCellValue('B'.$posBanco0, $datosObtenidosbanco0['NO']['conteo'])					       
				->setCellValue('C'.$posBanco0, $datosObtenidosbanco0['NS']['conteo'])
		        ->setCellValue('D'.$posBanco0, $datosObtenidosbanco0['NE']['conteo'])
		        ->setCellValue('E'.$posBanco0, $datosObtenidosbanco0['NP']['conteo'])

		        ->setCellValue('F'.$posBanco0, $datosObtenidosbanco0['EN']['conteo'])
		        ->setCellValue('G'.$posBanco0, $datosObtenidosbanco0['EO']['conteo'])
		        ->setCellValue('H'.$posBanco0, $datosObtenidosbanco0['ES']['conteo'])
		        ->setCellValue('I'.$posBanco0, $datosObtenidosbanco0['EP']['conteo'])

		        ->setCellValue('J'.$posBanco0, $datosObtenidosbanco0['SE']['conteo'])
		        ->setCellValue('K'.$posBanco0, $datosObtenidosbanco0['SN']['conteo'])
		        ->setCellValue('L'.$posBanco0, $datosObtenidosbanco0['SO']['conteo'])
		        ->setCellValue('M'.$posBanco0, $datosObtenidosbanco0['SP']['conteo'])

		        ->setCellValue('N'.$posBanco0, $datosObtenidosbanco0['OS']['conteo'])
		        ->setCellValue('O'.$posBanco0, $datosObtenidosbanco0['OE']['conteo'])
		        ->setCellValue('P'.$posBanco0, $datosObtenidosbanco0['ON']['conteo'])
		        ->setCellValue('Q'.$posBanco0, $datosObtenidosbanco0['OP']['conteo']);

				$posBanco0++;
	    }
	   
	   $posBanco1= $posBanco0+1;
	    $objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A'.$posBanco0, 'Bank number')
		->setCellValue('B'.$posBanco0, '1');

	      for ($i=1; $i <= $cantidadDeIntervalos; $i++) { 
	    	$datosObtenidosbanco1 = $interseccion['intervalos'][$i]['banco1'];
	    	$horaIntervalo = $interseccion['intervalos'][$i]['tiempo']['TiempoDe'];

	    	$objPHPExcel->setActiveSheetIndex(0)
	           	->setCellValue('A'.$posBanco1, $horaIntervalo)		
				->setCellValue('B'.$posBanco1, $datosObtenidosbanco1['NO']['conteo'])					       
				->setCellValue('C'.$posBanco1, $datosObtenidosbanco1['NS']['conteo'])
		        ->setCellValue('D'.$posBanco1, $datosObtenidosbanco1['NE']['conteo'])
		        ->setCellValue('E'.$posBanco1, $datosObtenidosbanco1['NP']['conteo'])

		        ->setCellValue('F'.$posBanco1, $datosObtenidosbanco1['EN']['conteo'])
		        ->setCellValue('G'.$posBanco1, $datosObtenidosbanco1['EO']['conteo'])
		        ->setCellValue('H'.$posBanco1, $datosObtenidosbanco1['ES']['conteo'])
		        ->setCellValue('I'.$posBanco1, $datosObtenidosbanco1['EP']['conteo'])

		        ->setCellValue('J'.$posBanco1, $datosObtenidosbanco1['SE']['conteo'])
		        ->setCellValue('K'.$posBanco1, $datosObtenidosbanco1['SN']['conteo'])
		        ->setCellValue('L'.$posBanco1, $datosObtenidosbanco1['SO']['conteo'])
		        ->setCellValue('M'.$posBanco1, $datosObtenidosbanco1['SP']['conteo'])

		        ->setCellValue('N'.$posBanco1, $datosObtenidosbanco1['OS']['conteo'])
		        ->setCellValue('O'.$posBanco1, $datosObtenidosbanco1['OE']['conteo'])
		        ->setCellValue('P'.$posBanco1, $datosObtenidosbanco1['ON']['conteo'])
		        ->setCellValue('Q'.$posBanco1, $datosObtenidosbanco1['OP']['conteo']);

				$posBanco1++;
	    }

	    $posBanco2= $posBanco1+1;
	    $objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A'.$posBanco1, 'Bank number')
		->setCellValue('B'.$posBanco1, '2');

		 for ($i=1; $i <= $cantidadDeIntervalos; $i++) { 
			    	$datosObtenidosbanco2 = $interseccion['intervalos'][$i]['banco2'];
			    	$horaIntervalo = $interseccion['intervalos'][$i]['tiempo']['TiempoDe'];

			    	$objPHPExcel->setActiveSheetIndex(0)
			           	->setCellValue('A'.$posBanco2, $horaIntervalo)		
						->setCellValue('B'.$posBanco2, $datosObtenidosbanco2['NO']['conteo'])					       
						->setCellValue('C'.$posBanco2, $datosObtenidosbanco2['NS']['conteo'])
				        ->setCellValue('D'.$posBanco2, $datosObtenidosbanco2['NE']['conteo'])
				        ->setCellValue('E'.$posBanco2, $datosObtenidosbanco2['NP']['conteo'])

				        ->setCellValue('F'.$posBanco2, $datosObtenidosbanco2['EN']['conteo'])
				        ->setCellValue('G'.$posBanco2, $datosObtenidosbanco2['EO']['conteo'])
				        ->setCellValue('H'.$posBanco2, $datosObtenidosbanco2['ES']['conteo'])
				        ->setCellValue('I'.$posBanco2, $datosObtenidosbanco2['EP']['conteo'])

				        ->setCellValue('J'.$posBanco2, $datosObtenidosbanco2['SE']['conteo'])
				        ->setCellValue('K'.$posBanco2, $datosObtenidosbanco2['SN']['conteo'])
				        ->setCellValue('L'.$posBanco2, $datosObtenidosbanco2['SO']['conteo'])
				        ->setCellValue('M'.$posBanco2, $datosObtenidosbanco2['SP']['conteo'])

				        ->setCellValue('N'.$posBanco2, $datosObtenidosbanco2['OS']['conteo'])
				        ->setCellValue('O'.$posBanco2, $datosObtenidosbanco2['OE']['conteo'])
				        ->setCellValue('P'.$posBanco2, $datosObtenidosbanco2['ON']['conteo'])
				        ->setCellValue('Q'.$posBanco2, $datosObtenidosbanco2['OP']['conteo']);

						$posBanco2++;
			    }
	 }
														
$objPHPExcel->getActiveSheet()->setTitle('Count ');
$objPHPExcel->setActiveSheetIndex(0);

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$nombreInterseccion.'_Counts.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;

?>