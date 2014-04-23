<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Count y Statistics</title>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../bootstrap-3.1.1\css\bootstrap.css">


</head>
<body>
<?php
$nombreInterseccion=$_GET['nombreInterseccion'];
$conectar = new MongoClient("mongodb://JAYROSERVER-PC:27017");
$db = $conectar->QualityCounts;
$colIntersecciones = $db->intersecciones;

//$consulta=array();

$elemento=array('nombreInterseccion'=> $nombreInterseccion);

//db.intersecciones.find({nombreInterseccion:"p1"}).pretty()
$intersecciones=$colIntersecciones->find($elemento);

      foreach ($intersecciones as $interseccion){
  ?>

    <div class="container">
      <h1>Count &amp; Statistics</h1>
      <hr>
      <span>Here are the final reports of the count is previewed or if you prefer you can download</span>
      <div class="row col-md-6 col-lg-6"  style="float:right;">
        <div class="col-md-12 col-lg-12" id="btnGeneraExcel">
          <a id="statistics" href="" >
            <button id="btnGeneraExcelStatistics" type="button" class="btn btn-success btn-md">
            <span class="glyphicon glyphicon-download"></span> Excel statistics </button>
          </a>
          <a id="counts" href="" >
            <button id="btnGeneraExcelCounts" type="button" class="btn btn-success btn-md">
            <span class="glyphicon glyphicon-download"></span> Excel counts</button>
          </a>
      </div>
    </div>


<div class="row">
     <div class="col-xs-12 col-md-12">
    <!--tabla Statistics -->
      <table class="table table-condensed"  border="0" cellpadding="0" cellspacing="1">
        <tr>
          <th align="left" width="25%" class="warning">Jon number</th>
          <td width="25%" class="warning" ><b><?php echo $interseccion['nombreInterseccion'] ;?> </b> </td>
          <th align="left" width="25%">Employee </th>
          <td width="25%"><?php echo $interseccion['codificador'] ;?>  </td>
        </tr>
        <tr>
          <th align="left" width="25%">Time Used (seconds) </th>
          <td width="25%"><?php echo $interseccion['tiempoUsadoSeg'] ;?>  </td>
          <th align="left" width="25%">Time Used (hh:mm:ss) </th>
          <td width="25%"><?php echo $interseccion['tiempoUsadoHora'] ;?>  </td>
        </tr>
        <tr>
          <th align="left" width="25%">Total number of cars </th>
          <td width="25%">
          <?php 
     $cantidadDeIntervalos =  sizeof($interseccion['intervalos']);

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

          echo $totalAutos = array_sum($numTotalAutos); ?>  </td>
          <th align="left" width="25%">Cars per hour  </th>
          <td width="25%"> <?php echo $carrosporHora= $totalAutos / $interseccion['horasConteo'] ; ?></td>
        </tr>
        <tr>
          <th align="left" width="25%">First interval  </th>
          <td width="25%"><?php echo $interseccion['horaInicioConteo'] ;?>  </td>
          <th align="left" width="25%">Last interval  </th>
          <td width="25%"><?php echo $interseccion['horaFinalConteo'] ; }
          ?>  </td>
        </tr> 


      </table><!--fin tabla-->  
      <div class="clearfix">&nbsp;</div>        
      <table class="table table-condensed" border="0"><!--inicio Counts-->  
        <tbody align="center">
          <tr class="active" style="font-size:12px;" >
            <th width="2%">Time</th>

            <th width="1%">SB Right</th>
            <th width="1%">SB Thru</th>
            <th width="1%">SB Left</th>
            <th width="1%">SB Ped</th>

            <th width="1%">WB Right</th>      
            <th width="1%">WB Thru</th>
            <th width="1%">WB Left</th>
            <th width="1%">WB Ped</th>    

            <th width="1%">NB Right</th>      
            <th width="1%">NB Thru</th>
            <th width="1%">NB Left</th>
            <th width="1%">NB Ped</th>  

            <th width="1%">EB Right</th>      
            <th width="1%">EB Thru</th>
            <th width="1%">EB Left</th>
            <th width="1%">EB Ped</th>  

          </tr>
          <tr>
            <th>Bank number</th>
            <td>0</td>
            <td colspan="15"></td>
          </tr>
          <?php
            for ($i=1; $i <= $cantidadDeIntervalos; $i++) { 
              $datosObtenidosbanco0 = $interseccion['intervalos'][$i]['banco0'];
              $horaIntervalo = $interseccion['intervalos'][$i]['tiempo']['TiempoDe'];
                   
                    echo "<tr><th>".$horaIntervalo."</th>";
                   
                    echo "<td width='1%'>".$datosObtenidosbanco0['NO']['conteo']."</td>";
                    echo "<td width='1%'>".$datosObtenidosbanco0['NS']['conteo']."</td>";
                    echo "<td width='1%'>".$datosObtenidosbanco0['NE']['conteo']."</td>";
                    echo "<td width='1%'>".$datosObtenidosbanco0['NP']['conteo']."</td>";

                    echo "<td width='1%'>".$datosObtenidosbanco0['EN']['conteo']."</td>";
                    echo "<td width='1%'>".$datosObtenidosbanco0['EO']['conteo']."</td>";
                    echo "<td width='1%'>".$datosObtenidosbanco0['ES']['conteo']."</td>";
                    echo "<td width='1%'>".$datosObtenidosbanco0['EP']['conteo']."</td>";

                    echo "<td width='1%'>".$datosObtenidosbanco0['SE']['conteo']."</td>";
                    echo "<td width='1%'>".$datosObtenidosbanco0['SN']['conteo']."</td>";
                    echo "<td width='1%'>".$datosObtenidosbanco0['SO']['conteo']."</td>";
                    echo "<td width='1%'>".$datosObtenidosbanco0['SP']['conteo']."</td>";

                    echo "<td width='1%'>".$datosObtenidosbanco0['OS']['conteo']."</td>";
                    echo "<td width='1%'>".$datosObtenidosbanco0['OE']['conteo']."</td>";
                    echo "<td width='1%'>".$datosObtenidosbanco0['ON']['conteo']."</td>";
                    echo "<td width='1%'>".$datosObtenidosbanco0['OP']['conteo']."</td>";

                      echo "</tr>";
            }

        ?>

          <tr>
            <th>Bank number</th>
            <td>1</td>
            <td colspan="15"></td>
          </tr>
        <?php
            for ($i=1; $i <= $cantidadDeIntervalos; $i++) { 
              $datosObtenidosbanco1 = $interseccion['intervalos'][$i]['banco1'];
              $horaIntervalo = $interseccion['intervalos'][$i]['tiempo']['TiempoDe'];     

                    echo "<tr><th>".$horaIntervalo."</th>";
              
                    echo "<td>".$datosObtenidosbanco1['NO']['conteo']."</td>";
                    echo "<td>".$datosObtenidosbanco1['NS']['conteo']."</td>";
                    echo "<td>".$datosObtenidosbanco1['NE']['conteo']."</td>";
                    echo "<td>".$datosObtenidosbanco1['NP']['conteo']."</td>";

                    echo "<td>".$datosObtenidosbanco1['EN']['conteo']."</td>";
                    echo "<td>".$datosObtenidosbanco1['EO']['conteo']."</td>";
                    echo "<td>".$datosObtenidosbanco1['ES']['conteo']."</td>";
                    echo "<td>".$datosObtenidosbanco1['EP']['conteo']."</td>";

                    echo "<td>".$datosObtenidosbanco1['SE']['conteo']."</td>";
                    echo "<td>".$datosObtenidosbanco1['SN']['conteo']."</td>";
                    echo "<td>".$datosObtenidosbanco1['SO']['conteo']."</td>";
                    echo "<td>".$datosObtenidosbanco1['SP']['conteo']."</td>";

                    echo "<td>".$datosObtenidosbanco1['OS']['conteo']."</td>";
                    echo "<td>".$datosObtenidosbanco1['OE']['conteo']."</td>";
                    echo "<td>".$datosObtenidosbanco1['ON']['conteo']."</td>";
                    echo "<td>".$datosObtenidosbanco1['OP']['conteo']."</td>";
                    echo "</tr>";
            }
        ?>

        <tr>
            <th>Bank number</th>
            <td>2</td>
            <td colspan="15"></td>
          </tr>
           
        <?php
            for ($i=1; $i <= $cantidadDeIntervalos; $i++) { 
              $datosObtenidosbanco2 = $interseccion['intervalos'][$i]['banco2'];
              $horaIntervalo = $interseccion['intervalos'][$i]['tiempo']['TiempoDe'];
                   
                    echo "<tr><th>".$horaIntervalo."</th>";
                   
                    echo "<td>".$datosObtenidosbanco2['NO']['conteo']."</td>";
                    echo "<td>".$datosObtenidosbanco2['NS']['conteo']."</td>";
                    echo "<td>".$datosObtenidosbanco2['NE']['conteo']."</td>";
                    echo "<td>".$datosObtenidosbanco2['NP']['conteo']."</td>";

                    echo "<td>".$datosObtenidosbanco2['EN']['conteo']."</td>";
                    echo "<td>".$datosObtenidosbanco2['EO']['conteo']."</td>";
                    echo "<td>".$datosObtenidosbanco2['ES']['conteo']."</td>";
                    echo "<td>".$datosObtenidosbanco2['EP']['conteo']."</td>";

                    echo "<td>".$datosObtenidosbanco2['SE']['conteo']."</td>";
                    echo "<td>".$datosObtenidosbanco2['SN']['conteo']."</td>";
                    echo "<td>".$datosObtenidosbanco2['SO']['conteo']."</td>";
                    echo "<td>".$datosObtenidosbanco2['SP']['conteo']."</td>";

                    echo "<td>".$datosObtenidosbanco2['OS']['conteo']."</td>";
                    echo "<td>".$datosObtenidosbanco2['OE']['conteo']."</td>";
                    echo "<td>".$datosObtenidosbanco2['ON']['conteo']."</td>";
                    echo "<td>".$datosObtenidosbanco2['OP']['conteo']."</td>";
                    echo "</tr>";
                }
              
            ?>
 
  <tr class="count info">
          <th align="left" width="8%">Counts </th>
          <td width="5%">
            <?php 
               for ($i=1; $i <= $cantidadDeIntervalos; $i++) {   // la forma en que se recorreria el for
                   $conteoNO[] =$interseccion['intervalos'][$i]['banco0']['NO']['conteo'];
                   $conteoNO[] =$interseccion['intervalos'][$i]['banco1']['NO']['conteo'];
                   $conteoNO[] =$interseccion['intervalos'][$i]['banco2']['NO']['conteo'];

                  }
                  echo array_sum($conteoNO); 
            ?>
            </td>
            <td width="5%">
           <?php 
               for ($i=1; $i <= $cantidadDeIntervalos; $i++) {   // la forma en que se recorreria el for
                   $conteoNS[] =$interseccion['intervalos'][$i]['banco0']['NS']['conteo'];
                   $conteoNS[] =$interseccion['intervalos'][$i]['banco1']['NS']['conteo'];
                   $conteoNS[] =$interseccion['intervalos'][$i]['banco2']['NS']['conteo'];

                  }
                  echo array_sum($conteoNS); 
            ?>
            </td>
            <td width="5%">
             <?php 
               for ($i=1; $i <= $cantidadDeIntervalos; $i++) {   // la forma en que se recorreria el for
                   $conteoNE[] =$interseccion['intervalos'][$i]['banco0']['NE']['conteo'];
                   $conteoNE[] =$interseccion['intervalos'][$i]['banco1']['NE']['conteo'];
                   $conteoNE[] =$interseccion['intervalos'][$i]['banco2']['NE']['conteo'];

                  }
                  echo array_sum($conteoNE); 
            ?>


            </td>
            <td width="5%">
              <?php 
               for ($i=1; $i <= $cantidadDeIntervalos; $i++) {   // la forma en que se recorreria el for
                   $conteoNP[] =$interseccion['intervalos'][$i]['banco0']['NP']['conteo'];
                   $conteoNP[] =$interseccion['intervalos'][$i]['banco1']['NP']['conteo'];
                   $conteoNP[] =$interseccion['intervalos'][$i]['banco2']['NP']['conteo'];

                  }
                  echo array_sum($conteoNP); 
            ?>

            </td>

            <td width="5%">
           <?php 
               for ($i=1; $i <= $cantidadDeIntervalos; $i++) {   // la forma en que se recorreria el for
                   $conteoEN[] =$interseccion['intervalos'][$i]['banco0']['EN']['conteo'];
                   $conteoEN[] =$interseccion['intervalos'][$i]['banco1']['EN']['conteo'];
                   $conteoEN[] =$interseccion['intervalos'][$i]['banco2']['EN']['conteo'];
                  }
                  echo array_sum($conteoEN); 
            ?>        


            </td>      
            <td width="5%">
            <?php 
               for ($i=1; $i <= $cantidadDeIntervalos; $i++) {   // la forma en que se recorreria el for
                   $conteoEO[] =$interseccion['intervalos'][$i]['banco0']['EO']['conteo'];
                   $conteoEO[] =$interseccion['intervalos'][$i]['banco1']['EO']['conteo'];
                   $conteoEO[] =$interseccion['intervalos'][$i]['banco2']['EO']['conteo'];
                  }
                  echo array_sum($conteoEO); 
            ?>    
            </td>
            <td width="5%">
            <?php 
               for ($i=1; $i <= $cantidadDeIntervalos; $i++) {   // la forma en que se recorreria el for
                   $conteoES[] =$interseccion['intervalos'][$i]['banco0']['ES']['conteo'];
                   $conteoES[] =$interseccion['intervalos'][$i]['banco1']['ES']['conteo'];
                   $conteoES[] =$interseccion['intervalos'][$i]['banco2']['ES']['conteo'];
                  }
                  echo array_sum($conteoES); 
            ?>          
            </td>
            <td width="5%">
            <?php 
               for ($i=1; $i <= $cantidadDeIntervalos; $i++) {   // la forma en que se recorreria el for
                   $conteoEP[] =$interseccion['intervalos'][$i]['banco0']['EP']['conteo'];
                   $conteoEP[] =$interseccion['intervalos'][$i]['banco1']['EP']['conteo'];
                   $conteoEP[] =$interseccion['intervalos'][$i]['banco2']['EP']['conteo'];
                  }
                  echo array_sum($conteoEP); 
            ?>           


            </td>    

            <td width="5%">
            <?php 
               for ($i=1; $i <= $cantidadDeIntervalos; $i++) {   // la forma en que se recorreria el for
                   $conteoSE[] =$interseccion['intervalos'][$i]['banco0']['SE']['conteo'];
                   $conteoSE[] =$interseccion['intervalos'][$i]['banco1']['SE']['conteo'];
                   $conteoSE[] =$interseccion['intervalos'][$i]['banco2']['SE']['conteo'];
                  }
                  echo array_sum($conteoSE); 
            ?>           
            </td>      
            <td width="5%">
            <?php 
               for ($i=1; $i <= $cantidadDeIntervalos; $i++) {   // la forma en que se recorreria el for
                   $conteoSN[] =$interseccion['intervalos'][$i]['banco0']['SN']['conteo'];
                   $conteoSN[] =$interseccion['intervalos'][$i]['banco1']['SN']['conteo'];
                   $conteoSN[] =$interseccion['intervalos'][$i]['banco2']['SN']['conteo'];
                  }
                  echo array_sum($conteoSN); 
            ?>              

            </td>
            <td width="5%">
            <?php 
               for ($i=1; $i <= $cantidadDeIntervalos; $i++) {   // la forma en que se recorreria el for
                   $conteoSO[] =$interseccion['intervalos'][$i]['banco0']['SO']['conteo'];
                   $conteoSO[] =$interseccion['intervalos'][$i]['banco1']['SO']['conteo'];
                   $conteoSO[] =$interseccion['intervalos'][$i]['banco2']['SO']['conteo'];
                  }
                  echo array_sum($conteoSO); 
            ?>            
            </td>
            <td width="5%">
            <?php 
               for ($i=1; $i <= $cantidadDeIntervalos; $i++) {   // la forma en que se recorreria el for
                   $conteoSP[] =$interseccion['intervalos'][$i]['banco0']['SP']['conteo'];
                   $conteoSP[] =$interseccion['intervalos'][$i]['banco1']['SP']['conteo'];
                   $conteoSP[] =$interseccion['intervalos'][$i]['banco2']['SP']['conteo'];
                  }
                  echo array_sum($conteoSP); 
            ?>          
            </td>  

          <td width="5%">
              <?php 
                 for ($i=1; $i <= $cantidadDeIntervalos; $i++) {   // la forma en que se recorreria el for
                     $conteoOS[] =$interseccion['intervalos'][$i]['banco0']['OS']['conteo'];
                     $conteoOS[] =$interseccion['intervalos'][$i]['banco1']['OS']['conteo'];
                     $conteoOS[] =$interseccion['intervalos'][$i]['banco2']['OS']['conteo'];
                    }
                    echo array_sum($conteoOS); 
              ?>           
              </td>      
              <td width="5%">
              <?php 
                 for ($i=1; $i <= $cantidadDeIntervalos; $i++) {   // la forma en que se recorreria el for
                     $conteoOE[] =$interseccion['intervalos'][$i]['banco0']['OE']['conteo'];
                     $conteoOE[] =$interseccion['intervalos'][$i]['banco1']['OE']['conteo'];
                     $conteoOE[] =$interseccion['intervalos'][$i]['banco2']['OE']['conteo'];
                    }
                    echo array_sum($conteoOE); 
              ?>              

              </td>
              <td width="5%">
              <?php 
                 for ($i=1; $i <= $cantidadDeIntervalos; $i++) {   // la forma en que se recorreria el for
                     $conteoON[] =$interseccion['intervalos'][$i]['banco0']['ON']['conteo'];
                     $conteoON[] =$interseccion['intervalos'][$i]['banco1']['ON']['conteo'];
                     $conteoON[] =$interseccion['intervalos'][$i]['banco2']['ON']['conteo'];
                    }
                    echo array_sum($conteoON); 
              ?>            
              </td>
              <td width="5%">
              <?php 
                 for ($i=1; $i <= $cantidadDeIntervalos; $i++) {   // la forma en que se recorreria el for
                     $conteoOP[] =$interseccion['intervalos'][$i]['banco0']['OP']['conteo'];
                     $conteoOP[] =$interseccion['intervalos'][$i]['banco1']['OP']['conteo'];
                     $conteoOP[] =$interseccion['intervalos'][$i]['banco2']['OP']['conteo'];
                    }
                    echo array_sum($conteoOP); 
              ?>          
              </td>  
        </tr>

            </tbody>
          </table>  
    </div>
  </div>
</div>

      <div id="footer">
        <div class="container">
          <p class="text-muted">QC software</p>
        </div>
      </div>

    </div>
<script src="//code.jquery.com/jquery-1.9.1.js"></script>    
<script>
$("#counts").attr("href", "generaExcelCount.php?nombreInterseccion=<?php echo $interseccion['nombreInterseccion'] ;?>");
$("#statistics").attr("href", "generaExcelStatistics.php?nombreInterseccion=<?php echo $interseccion['nombreInterseccion'] ;?>");

</script>
  </body>
</html>
