<?php
define('FPDF_FONTPATH','../font/');
require('../fpdf.php');
setlocale(LC_ALL,"es_ES");
$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

//Connect to your database
/////////////////CONEXION DB//////////////////
include('../mysql-var_vialidad.php');
include('../mysql_connect.php');  // devuelve $conexion_mysql
include('../mysql_select_db.php');
//////////////////////////////////////////////


$mas='más';
$mas=utf8_decode($mas);
$valor="Señor";

$valor=utf8_decode($valor);



/*! 
  @function num2letras () 
  @abstract Dado un n?mero lo devuelve escrito. 
  @param $num number - N?mero a convertir. 
  @param $fem bool - Forma femenina (true) o no (false). 
  @param $dec bool - Con decimales (true) o no (false). 
  @result string - Devuelve el n?mero escrito en letra. 

*/ 
function num2letras($num, $fem = true, $dec = true) { 
//if (strlen($num) > 14) die("El n?mero introducido es demasiado grande"); 
   $matuni[2]  = "dos"; 
   $matuni[3]  = "tres"; 
   $matuni[4]  = "cuatro"; 
   $matuni[5]  = "cinco"; 
   $matuni[6]  = "seis"; 
   $matuni[7]  = "siete"; 
   $matuni[8]  = "ocho"; 
   $matuni[9]  = "nueve"; 
   $matuni[10] = "diez"; 
   $matuni[11] = "once"; 
   $matuni[12] = "doce"; 
   $matuni[13] = "trece"; 
   $matuni[14] = "catorce"; 
   $matuni[15] = "quince"; 
   $matuni[16] = "dieciseis"; 
   $matuni[17] = "diecisiete"; 
   $matuni[18] = "dieciocho"; 
   $matuni[19] = "diecinueve"; 
   $matuni[20] = "veinte"; 
   $matunisub[2] = "dos"; 
   $matunisub[3] = "tres"; 
   $matunisub[4] = "cuatro"; 
   $matunisub[5] = "quin"; 
   $matunisub[6] = "seis"; 
   $matunisub[7] = "sete"; 
   $matunisub[8] = "ocho"; 
   $matunisub[9] = "nove"; 

   $matdec[2] = "veint"; 
   $matdec[3] = "treinta"; 
   $matdec[4] = "cuarenta"; 
   $matdec[5] = "cincuenta"; 
   $matdec[6] = "sesenta"; 
   $matdec[7] = "setenta"; 
   $matdec[8] = "ochenta"; 
   $matdec[9] = "noventa"; 
   $matsub[3]  = 'mill'; 
   $matsub[5]  = 'bill'; 
   $matsub[7]  = 'mill'; 
   $matsub[9]  = 'trill'; 
   $matsub[11] = 'mill'; 
   $matsub[13] = 'bill'; 
   $matsub[15] = 'mill'; 
   $matmil[4]  = 'millones'; 
   $matmil[6]  = 'billones'; 
   $matmil[7]  = 'de billones'; 
   $matmil[8]  = 'millones de billones'; 
   $matmil[10] = 'trillones'; 
   $matmil[11] = 'de trillones'; 
   $matmil[12] = 'millones de trillones'; 
   $matmil[13] = 'de trillones'; 
   $matmil[14] = 'billones de trillones'; 
   $matmil[15] = 'de billones de trillones'; 
   $matmil[16] = 'millones de billones de trillones'; 

   $num = trim((string)@$num); 
   if ($num[0] == '-') { 
      $neg = 'menos '; 
      $num = substr($num, 1); 
   }else 
      $neg = ''; 
   while ($num[0] == '0') $num = substr($num, 1); 
   if ($num[0] < '1' or $num[0] > 9) $num = '0' . $num; 
   $zeros = true; 
   $punt = false; 
   $ent = ''; 
   $fra = ''; 
   for ($c = 0; $c < strlen($num); $c++) { 
      $n = $num[$c]; 
      if (! (strpos(".,'''", $n) === false)) { 
         if ($punt) break; 
         else{ 
            $punt = true; 
            continue; 
         } 

      }elseif (! (strpos('0123456789', $n) === false)) { 
         if ($punt) { 
            if ($n != '0') $zeros = false; 
            $fra .= $n; 
         }else 

            $ent .= $n; 
      }else 

         break; 

   } 
   $ent = '     ' . $ent; 
   if ($dec and $fra and ! $zeros) { 
      $fin = ' coma'; 
      for ($n = 0; $n < strlen($fra); $n++) { 
         if (($s = $fra[$n]) == '0') 
            $fin .= ' cero'; 
         elseif ($s == '1') 
            $fin .= $fem ? ' una' : ' un'; 
         else 
            $fin .= ' ' . $matuni[$s]; 
      } 
   }else 
      $fin = ''; 
   if ((int)$ent === 0) return 'Cero ' . $fin; 
   $tex = ''; 
   $sub = 0; 
   $mils = 0; 
   $neutro = false; 
   while ( ($num = substr($ent, -3)) != '   ') { 
      $ent = substr($ent, 0, -3); 
      if (++$sub < 3 and $fem) { 
         $matuni[1] = 'una'; 
         $subcent = 'os'; 
      }else{ 
         $matuni[1] = $neutro ? 'un' : 'uno'; 
         $subcent = 'os'; 
      } 
      $t = ''; 
      $n2 = substr($num, 1); 
      if ($n2 == '00') { 
      }elseif ($n2 < 21) 
         $t = ' ' . $matuni[(int)$n2]; 
      elseif ($n2 < 30) { 
         $n3 = $num[2]; 
         if ($n3 != 0) $t = 'i' . $matuni[$n3]; 
         $n2 = $num[1]; 
         $t = ' ' . $matdec[$n2] . $t; 
      }else{ 
         $n3 = $num[2]; 
         if ($n3 != 0) $t = ' y ' . $matuni[$n3]; 
         $n2 = $num[1]; 
         $t = ' ' . $matdec[$n2] . $t; 
      } 
      $n = $num[0]; 
      if ($n == 1) { 
         $t = ' ciento' . $t; 
      }elseif ($n == 5){ 
         $t = ' ' . $matunisub[$n] . 'ient' . $subcent . $t; 
      }elseif ($n != 0){ 
         $t = ' ' . $matunisub[$n] . 'cient' . $subcent . $t; 
      } 
      if ($sub == 1) { 
      }elseif (! isset($matsub[$sub])) { 
         if ($num == 1) { 
            $t = ' mil'; 
         }elseif ($num > 1){ 
            $t .= ' mil'; 
         } 
      }elseif ($num == 1) { 
         $t .= ' ' . $matsub[$sub] . '?n'; 
      }elseif ($num > 1){ 
         $t .= ' ' . $matsub[$sub] . 'ones'; 
      }   
      if ($num == '000') $mils ++; 
      elseif ($mils != 0) { 
         if (isset($matmil[$sub])) $t .= ' ' . $matmil[$sub]; 
         $mils = 0; 
      } 
      $neutro = true; 
      $tex = $t . $tex; 
   } 
   $tex = $neg . substr($tex, 1) . $fin; 
   return ucfirst($tex); 
} 


  
    
 //$f=strftime("%Y-%m-%d");
// $dia = date("Y-m-d");

  $id = $_GET['id']; // id nota

  $tipo = $_GET['tipo'];
  
 $fecha_pago = $_GET['fec'];
  
  

  if($tipo=='NC'){ $titulo='DIVISION CONTABILIDAD PRESUPUESTARIA';}
  if($tipo=='NDC'){ $titulo='DIVISION CONTRATACIONES';}

$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

 $f_g=split("-",$fecha_pago); 
$fecha_g=$f_g[2].'-'.$f_g[1].'-'.$f_g[0];
	
 
$fecha= $dias[($f_g[2])]." ".$f_g[2]."  de  ".$meses[($f_g[1])-1]. " del ".($f_g[0]);


$ssql =  "SELECT *
FROM notas where id='$id'";
 if (!($result = mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar articulo";
     
      //.....................................................................
    }
	
	
 $nota = mysql_fetch_array ($result);
 
				  $importe=$nota['monto'];
				  
				   $letra=num2letras($importe);
				   
				   $texto2=$importe.', '.$letra;
				   
				   	 

 $ssql = "SELECT *
FROM pedidos p, areas a
WHERE  p.areasoli_id = a.id and p.estado ='A'  and nota ='$id'";
 if (!($pedido = mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar articulo";
     
      //.....................................................................
    }	
			$p=0;
			
      


	
//date_default_timezone_set('America/Argentina/Buenos_Aires');
//setlocale(LC_TIME, 'spanish'); 
//$fecha=strftime("%A %d de %B del %Y");				
//$fecha = date('d-m-Y');   
	
//setlocale(LC_ALL,"es_ES");
//$fecha = strftime("%A %d de %B del %Y");

//Connect to your database
//Create new pdf file
$pdf=new FPDF();
//$pdf=new PDF_AutoPrint();
$pdf=new FPDF('P','mm','A4');
//Open file
$pdf->Open();
$cp=0;
$i=0;
$max=40;
$InterLigne = 15;

//Disable automatic page break
$pdf->SetAutoPageBreak(false);

//Add first page
$pdf->AddPage();

$y_axis_initial = 17;
// imprime el titulo de la pagina
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($y_axis_initial);
$pdf->Image('../img/log_m.jpg',35,6,25);

$pdf->SetFont('Arial','B',6);
//$pdf->setX(150);
// (ancho,alto,texto,borde 0(sin borde):1(con borde),L: izquierda T: superior R: derecha B: inferior,alineacion (L,C,R),
//$pdf->setY(25);
$pdf->SetY(15);



//set initial y axis position per page
$y_axis_initial = 20;
$i=$y_axis_initial;
$pdf->SetY($y_axis_initial);

$pdf->SetFont('Arial','B',14);
$pdf->SetX(30);
$pdf->SetY($i=$i+15);
$pdf->Cell(0,4,'','0',0,'C',1);
$pdf->SetY($i=$i+8);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(0,4,'Nota: '.$id,'0',0,'R',1);
$pdf->SetFont('Arial','B',8);

$pdf->SetY($i=$i+8);

$pdf->Cell(0,6,' LA RIOJA, '.$fecha,0,0,'R');

$pdf->SetY($i=$i+5);
$pdf->SetX(30);


$pdf->SetFont('Arial','B',12);


$pdf->MultiCell(0,7,'
  	                                                
AL '.$valor.' 
'.$titulo.':'

													 
,0,'J',0,15);
$pdf->SetX(30);
$pdf->SetFont('Arial','BU',11);
$pdf->MultiCell(0,7,'SU DESPACHO:'

													 
,0,'J',0,15);

$pdf->SetY($i=$i+60);
$pdf->SetX(40);

$pdf->SetFont('Arial','',12);
$texto1='															 	    		Se remite pedido para su tramite.';

										


  	                                                 		
$pdf->MultiCell(0,$InterLigne,$texto1,0,'J',0,15);
$pdf->SetX(30);
if ($tipo=='NC')
{
$pdf->MultiCell(0,$InterLigne,'Con un costo aproximado de $'.$texto2,0,'J',0,15);
$i=$i+25;
}
else
{
	$i=$i+20;
	}
$pdf->SetFillColor(215,215,215);

$pdf->SetFont('courier','B',10);
$pdf->SetY($i=$i+6);
$pdf->SetX(30);
$pdf->Cell(175,6,'Detalle',1,0,'L',1);
$pdf->SetFillColor(256,256,256);
  $pdf->SetFont('courier','B',8);
		    $pdf->SetY($i=$i+6);
		    $pdf->SetX(30);
			$pdf->Cell(20,6,'PEDIDO',1,0,'C',1);
			$pdf->Cell(50,6,'AREA',1,0,'C',1);
           //  $pdf->Cell(55,6,'DETALLE',1,0,'C',1);

			$pdf->Cell(105,6,'OBSERVACION',1,0,'C',1);
			
		
 while($fila=mysql_fetch_array($pedido))
			 {
                $j=$i;  #AFD8EB
         $i=$i+1;#336699
			  $aux='0';
	    $aux1='0';
		$empleado_id=$fila ['empleado_id'];
				 $numero=$fila ['numero'];
		$estado=$fila [11];
			 $prioridad=$fila ['prioridad'];
				  $automotor_id=$fila['automotor_id'];
				 $comentario=$fila['comentario'];
			 
			 if($prioridad=='E'){$prioridad_d='CON EXISTENCIA'; }
if($prioridad=='M'){$prioridad_d='MUY URGENTE'; }
if($prioridad=='U'){$prioridad_d='URGENTE'; }
		
		if($estado=='I'){$estado_d='Iniciado'; }
		if($estado=='A'){$estado_d='Autorizado'; }
		if($estado=='E'){$estado_d='Entregado'; }
		if($estado=='P'){$estado_d='Entrega Parcial'; }

			 if($estado=='X'){$estado_d='Anulado'; }
	  
	   if($fila['areasoli_id']!='N'){ 
	  
			 $ini1=$fila['areasoli_id'];
			 $ssql = "SELECT *
FROM `areas` 
WHERE id = '$ini1'";
 if (!($pase = mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar articulo";
     
      //.....................................................................
    }	
			 $f_pase=mysql_fetch_array($pase);
			  $lugar1=$f_pase['descripcion'];
			 
		 }
		  
    
    
    if($fila['subarea_id']>'0'){ 
	  
			 $ini2=$fila['subarea_id'];
		      $aux='1';
			 $ssql = "SELECT *
FROM `subareas` 
WHERE id = '$ini2'";
 if (!($pase = mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar articulo";
     
      //.....................................................................
    }	
			 $f_pase=mysql_fetch_array($pase);
			 $lugar2=$f_pase['descripcion'];
			 
		 }
	if($fila['subarea1_id']>'0'){ 
	  
			 $ini3=$fila['subarea1_id'];
		      $aux1='1';
			 $ssql = "SELECT *
FROM `campamento_seccion` 
WHERE id = '$ini3'";
 if (!($pase = mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar articulo";
     
      //.....................................................................
    }	
			 $f_pase=mysql_fetch_array($pase);
			 $lugar3=$f_pase['descripcion'];
			 
		 }		 
		  
		if(($aux=='1') and ($aux1=='0')){$lugar=$lugar2;}	 
		if(($aux=='1') and ($aux1=='1')){$lugar=$lugar3;}	
			 if(($aux=='0') and ($aux1=='0')){$lugar=$lugar1;}	
			 //if($ini1=='6') {$lugar=$lugar.', '.$fila['particular'];}
		  
	  
	

$ssql = "SELECT * FROM `automotor`   WHERE id = '$automotor_id'";
 if (!($pase = mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar articulo";
     
      //.....................................................................
    }	
			 $f_pase=mysql_fetch_array($pase);
               $leg=$f_pase['legajo'];
              $tipo=$f_pase['tipo'];
 $marca=$f_pase['marca'];
$modelo=$f_pase['modelo'];
$nro_motor=$f_pase['nro_motor'];
$chasis=$f_pase['chasis'];
$anio_fabrica=$f_pase['anio_fabrica'];

			 $datos_automotor=utf8_decode('LEGAJO:'.$leg.' '.$tipo.' MARCA:'.$marca.' MODELO:'.$modelo.' ('.$anio_fabrica .') '.' MOTOR:'.$nro_motor.' CHASIS:'.$chasis );
			  
			  
		    $pdf->SetFont('courier','',10);
		    $pdf->SetY($i=$i+6);
		    $pdf->SetX(30);
			
			$pdf->Cell(20,6,$numero,1,0,'L',1);
			if($razon_s=='')
			  {
			$pdf->Cell(50,6,$lugar ,1,0,'L',1);
			  }
			 else
			  {
				  $pdf->Cell(50,6,$lugar,1,0,'L',1);
			  }
			
				 if($automotor_id=='0')
				 {
					  $pdf->SetFont('courier','',8);
					 $pdf->MultiCell(0,5,$comentario."\n",1,'L',1);
				 }
				 else
				 {
					 $pdf->SetFont('courier','',8);
			$pdf->MultiCell(0,5,$datos_automotor."\n",1,'L',1);
				 }
		
			
			
			
		}
													 



$pdf->SetY($i=$i+20);

$pdf->SetFont('Arial','',11);													 
$pdf->SetX(40);
$texto3='																						Sin '.$mas.', le saludo atentamente.
DEPARTAMENTO DE ADMINISTRACION';
$pdf->MultiCell(0,$InterLigne,$texto3,0,'J',0,15);

$pdf->Output();
?> 
