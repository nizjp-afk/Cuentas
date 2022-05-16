<?php

   error_reporting ( E_ERROR );
   setlocale(LC_TIME, 'spanish'); 
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
      $fin = ' con'; 
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
         $subcent = 'as'; 
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
 include('../dgti-mysql-var_dgti-beneficiarios.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');
	
   
   
    $fechaant = $_GET['firstinput'];
	$fechahoy = $_GET['secondinput'];    
    $id = $_GET['id'];
	    
	
	   
        $ssql = "SELECT b.apellido, b.nombre, b.nombre_f, razon_social, p.cuit, p.orden_pago, p.fecha AS fecha_pago, s.monto AS retnecion, s.id, s.numero, CONCAT( b.direccion_f_calle, ' ', b.direccion_f_nro ) AS direccion, l.descripcion AS localidades, v.nombre AS provincia, b.codigo_f_postal,b.ingreso_bruto as ingreso,r.nombre as reg,s.alicuota,s.bruto AS IMPORTE, s.neto AS BASE_IMPONIBLE
FROM orden_pago AS p, sicore_ib AS s, beneficiarios_aprobados AS b, localidades AS l, provincias AS v, regimen as r
WHERE p.orden_pago = s.orden
AND b.cuitl = p.cuit
AND p.ejercicio = s.ejercicio
AND p.saf = s.saf
AND (
b.direccion_f_localidad = l.id_localidades
)
AND (
b.direccion_f_provincia = v.codprovincia
)
AND r.id_regimen = b.regimen
AND  s.numero='$id'
AND p.fecha = s.fecha_io
";
         if (!($r_css= mysql_query($ssql, $conexion_mysql)))
           {
	
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar beneficiario";
			  echo $cuerpo1;
			  //.....................................................................
		    }  	
	
	
	
$ssql = "SELECT b.apellido, b.nombre, b.nombre_f, razon_social, p.cuit, p.orden_pago, p.fecha AS fecha_pago, s.monto AS retnecion, s.id, s.numero, CONCAT( b.direccion_f_calle, ' ', b.direccion_f_nro ) AS direccion, l.descripcion AS localidades, v.nombre AS provincia, b.codigo_f_postal,b.ingreso_bruto as ingreso,r.nombre as reg,s.alicuota,s.bruto AS IMPORTE, s.neto AS BASE_IMPONIBLE
FROM orden_pago_fp AS p, sicore_ib AS s, beneficiarios_aprobados AS b, localidades AS l, provincias AS v, regimen as r
WHERE p.orden_pago = s.orden
AND b.cuitl = p.cuit
AND p.ejercicio = s.ejercicio
AND p.saf = s.saf
AND (
b.direccion_f_localidad = l.id_localidades
)
AND (
b.direccion_f_provincia = v.codprovincia
)

AND r.id_regimen = b.regimen
AND p.fecha = s.fecha_io

AND  s.numero='$id'
";
         if (!($r_css_fp= mysql_query($ssql, $conexion_mysql)))
           {
	
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar beneficiario1";
			  echo $cuerpo1;
			  //.....................................................................
		    }  	
						
	 
 	
//$can=mysql_num_rows($r_tcss);

$can1=mysql_num_rows($r_css);
$can=mysql_num_rows($r_css_fp);


if ($can1 > 0)
    {	
      $f_beneficiario= mysql_fetch_array ($r_css); 
	  
	}
	
if ($can > 0)
    {	
      $f_beneficiario= mysql_fetch_array ($r_css_fp); 
	  
	}	
 
 
  $cod_s = $f_beneficiario['ss_id'];
  $cuitl = $f_beneficiario['cuit'];
  
    $cuitl1=substr($cuitl,0,-9);
    $cuitl2=substr($cuitl,2,-1);
    $cuitl3=substr($cuitl,-1);
  $cuitl=$cuitl1.'-'.$cuitl2.'-'.$cuitl3;
  $apellido= $f_beneficiario['apellido'];
  $nombre = $f_beneficiario['nombre'];
   $razon_social= $f_beneficiario['razon_social'];
  $direccion=$f_beneficiario['direccion'];
  $provincia=$f_beneficiario['provincia'];
  $localidades=$f_beneficiario['localidades'];
  $codigo_p=$f_beneficiario['codigo_f_postal'];
  
  $fecha_pago=$f_beneficiario['fecha_pago'];

  
  $fecha=split("-",$fecha_pago);
  $fecha_pago=$fecha[2].'-'.$fecha[1].'-'.$fecha[0]; 
  
  $orden_pago=$f_beneficiario['orden_pago'];
  $monto=$f_beneficiario['retnecion'];
  
  $numero_ss=$f_beneficiario['numero'];
    $reg=$f_beneficiario['reg'];
	  $alicuota=$f_beneficiario['alicuota'];
    $ingreso=$f_beneficiario['ingreso'];
   $observacion=substr ($f_beneficiario['observacion'],0,60);
   $neto=$f_beneficiario['BASE_IMPONIBLE'];
    $importe=$f_beneficiario['IMPORTE'];
  
  
				
				
  
  //$fe=strftime("%A %d de %B del %Y",mktime(0,0,0,$fecha_pago[1], $fecha_pago[2], $fecha_pago[0]));
  
  //$fe=strftime("%A %d de %B del %Y",$fecha);

   $fe=strftime('%d',strtotime($fecha_pago)).' de '.strftime('%B',strtotime($fecha_pago)).' de '.strftime('%Y',strtotime($fecha_pago));
   
   //$fe2=strftime('%Y',strtotime($fecha[0]));
	//$fe3=strftime('%Y',strtotime($fecha[0]));
  
  
   $letra=num2letras($monto);
  
  if($f_beneficiario['razon_social']=='')
			     {
					
				   $beneficiario=$f_beneficiario['apellido'].", ".$f_beneficiario['nombre'];
				  }
				
			   else
			     {	  
		           $beneficiario=$f_beneficiario['razon_social'];
				 }
  
// }
  
//////////////fin de consulta en base///////////

	
	
   $f=strftime("%Y-%m-%d");
   $dia = date("d/m/Y");
   $hora =date("h:i");
         
//echo "paso";exit; 		
define('FPDF_FONTPATH','font/');
require('../fpdf.php');

//Connect to your database
//Create new pdf file
$pdf=new FPDF();
//$pdf=new PDF_AutoPrint();
$pdf=new FPDF('P','mm','A4');
//Open file
$pdf->Open();

//Disable automatic page break
$pdf->SetAutoPageBreak(false);

//Add first page
$pdf->AddPage();

//$pdf->SetTopMargin(25);

$y_axis_initial = 25;

// imprime el titulo de la pagina
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',11);
$pdf->SetY($y_axis_initial);
//$pdf->SetY(20);
$pdf->SetFillColor(256,256,256);
//$pdf->SetFont('Arial','I',6);
$pdf->SetY(5);

$pdf->Cell(0,100,'',1,'B','L',1);

$pdf->setY(5);

$pdf->Image('../img/logo_new_dgip.jpg',15,7,0);
//$pdf->SetX(105);
$pdf->SetFont('Arial','B',4);
//$pdf->Cell(0,6,'TESORERIA GENERAL DE LA PROVINCIA',0,'B','L',0);
//$pdf->setY(23);
//$pdf->Cell(0,6,'CONTADURIA GENERAL DE LA PROVINCIA',0,'B','L',0);
//$pdf->Image('../img/cuadro.jpg',170,15,15);
/////////FECHA///////

$pdf->SetFont('Arial','B',6);
//$pdf->setX(150);
// (ancho,alto,texto,borde 0(sin borde):1(con borde),L: izquierda T: superior R: derecha B: inferior,alineacion (L,C,R),
//$pdf->setY(25);
//$pdf->cell(0,0,'FECHA: '.$dia,0,'B','R',0);
// (ancho,alto,texto,borde 0(sin borde):1(con borde),L: izquierda T: superior R: derecha B: inferior,alineacion (L,C,R),

////ENCABEZADO

$pdf->SetFont('Arial','IB',16);
  
 
	
////////////
$y_axis_initial = 42;
/////////////
$pdf->SetFont('Arial','IB',10);
$i=10;

$pdf->SetY($i);
$pdf->SetX(130);
$pdf->SetFillColor(256,256,256);
$pdf->Cell(25,5,'Certificado Nº:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(155);
$pdf->Cell(30,5,$numero_ss,0,0,'L',1);
$pdf->SetY($i=$i+13);
$pdf->SetX(25);
$pdf->SetFont('Arial','IBU',10);

$pdf->Cell(150,5,'CERTIFICADO DE RETENCION DEL IMPUESTO SOBRE LOS INGRESOS BRUTOS',0,0,'C',1);


$pdf->SetFont('Arial','IBU',12);
$pdf->SetX(15);

//$pdf->SetFillColor(215,215,215);
$pdf->SetX(15);
$pdf->SetY($i=$i+5);

$pdf->Cell(0,20,'',1,'B','L',1);
$pdf->SetFont('Arial','',8);
$pdf->SetY($i=$i+2);

$pdf->SetX(15);
$pdf->Cell(20,5,'Agente de Retención: ',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(50);
$pdf->Cell(100,5,'TESORERIA GRAL. DE LA PROVINCIA DE LA RIOJA',0,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(145);
$pdf->Cell(20,5,'C.U.I.T Nº: ',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(170);
$pdf->Cell(15,5,'30-67185353-5',0,0,'L',1);

$pdf->SetFont('Arial','',8);
$pdf->SetY($i=$i+6);
$pdf->SetX(15);
$pdf->Cell(20,5,'Domicilio : ',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(50);
$pdf->Cell(20,5,'SAN NICOLAS DE BARI Nº 625',0,0,'L',1);

$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(145);
$pdf->Cell(20,5,'Nº Ag. Retencion: ',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(170);
$pdf->Cell(10,5,'000-010220-0',0,0,'L',1);



$pdf->SetFont('Arial','',8);
$pdf->SetY($i=$i+6);
$pdf->SetX(15);
$pdf->Cell(30,5,'Codigo de Sucursal : ',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(50);
$pdf->Cell(20,5,'000',0,0,'L',1);

$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(65);
$pdf->Cell(30,5,'Nombre Sucursal: ',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(90);
$pdf->Cell(20,5,'Casa Matriz',0,0,'L',1);
$pdf->SetX(15);
$pdf->SetY($i=$i+7);

$pdf->Cell(0,15,'',1,'B','L',1);
$pdf->SetFont('Arial','',8);
$pdf->SetY($i=$i+2);

$pdf->SetX(15);
$pdf->Cell(20,5,'Sujeto Retenido: ',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(50);
$pdf->Cell(100,5,$beneficiario,0,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(145);
$pdf->Cell(20,5,'C.U.I.T Nº: ',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(170);
$pdf->Cell(15,5,$cuitl,0,0,'L',1);

$pdf->SetFont('Arial','',8);
$pdf->SetY($i=$i+6);
$pdf->SetX(15);
$pdf->Cell(20,5,'Domicilio : ',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(50);
$pdf->Cell(20,5,$direccion,0,0,'L',1);

$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(145);
$pdf->Cell(20,5,'Nº Ingresos Brutos: ',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(170);
$pdf->Cell(10,5,$ingreso,0,0,'L',1);
$pdf->SetY($i=$i+8);
$pdf->SetFont('Arial','B',7);

$pdf->SetX(10);
$pdf->Cell(0,5,'Comprobante de la Operacion: '.$orden_pago,1,'B','L',1);
$pdf->SetY($i);

$pdf->SetX(90);
$pdf->Cell(0,5,'(Retencion Normal)',1,'B','L',1);
$pdf->SetFont('Arial','B',7);

$pdf->SetY($i=$i+6);

$pdf->SetX(10);
$pdf->Cell(0,5,'Importe Total Pagado Sujeto a Retención: '.$importe,1,'B','L',1);
$pdf->SetY($i);
$pdf->SetFont('Arial','B',7);

$pdf->SetX(90);
$pdf->Cell(0,5,$reg,1,'B','L',1);

$pdf->SetY($i=$i+6);

$pdf->SetX(10);
$pdf->Cell(0,5,'Base Imponible:'.$neto,1,'B','L',1);
$pdf->SetY($i);

$pdf->SetX(70);
$pdf->Cell(0,5,'Alicuota:'.$alicuota,1,'B','L',1);
$pdf->SetY($i);

$pdf->SetX(125);
$pdf->Cell(0,5,'Importe Retenido:'.$monto,1,'B','L',1);





$pdf->SetY($i=$i+8);
$pdf->SetX(10);

$pdf->MultiCell(0,4,'Declaro  bajo juramento que los datos consignados en la presente constancia son fiel expresion de la verdad.  ',0,'J',0,15);

$pdf->SetY($i=$i+8);
$pdf->SetX(10);


$pdf->Cell(50,4,'En la Rioja, '.$fe,0,'J',1);
$pdf->SetY($i);
$pdf->SetX(150);

$pdf->Cell(50,4,'CUIT: 30-67185353-5',0,'J',1);

$pdf->SetY($i=$i+8);
$pdf->SetX(10);

$pdf->Cell(50,4,'Copia para la D.G.I.P',0,'J',1);
$pdf->SetY($i);
$pdf->SetX(185);

$pdf->Cell(50,4,'Original',0,'J',1);
$pdf->Image('../img/new_firma_flores.jpg',140,85,18);





$y_axis_initial = 50;

// imprime el titulo de la pagina
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',11);
$pdf->SetY($y_axis_initial);
//$pdf->SetY(20);
$pdf->SetFillColor(256,256,256);
//$pdf->SetFont('Arial','I',6);
$pdf->SetY(120);

$pdf->Cell(0,100,'',1,'B','L',1);

$pdf->setY(120);

$pdf->Image('../img/logo_new_dgip.jpg',15,122,0);
//$pdf->SetX(105);
$pdf->SetFont('Arial','B',4);
//$pdf->Cell(0,6,'TESORERIA GENERAL DE LA PROVINCIA',0,'B','L',0);
//$pdf->setY(23);
//$pdf->Cell(0,6,'CONTADURIA GENERAL DE LA PROVINCIA',0,'B','L',0);
//$pdf->Image('../img/cuadro.jpg',170,15,15);
/////////FECHA///////

$pdf->SetFont('Arial','B',6);
//$pdf->setX(150);
// (ancho,alto,texto,borde 0(sin borde):1(con borde),L: izquierda T: superior R: derecha B: inferior,alineacion (L,C,R),
//$pdf->setY(25);
//$pdf->cell(0,0,'FECHA: '.$dia,0,'B','R',0);
// (ancho,alto,texto,borde 0(sin borde):1(con borde),L: izquierda T: superior R: derecha B: inferior,alineacion (L,C,R),

////ENCABEZADO

$pdf->SetFont('Arial','IB',16);
  
 
	
////////////
$y_axis_initial = 50 + 18;
/////////////
$pdf->SetFont('Arial','IB',10);
$i=125;

$pdf->SetY($i);
$pdf->SetX(130);
$pdf->SetFillColor(256,256,256);
$pdf->Cell(25,5,'Certificado Nº:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(155);
$pdf->Cell(30,5,$numero_ss,0,0,'L',1);
$pdf->SetY($i=$i+13);
$pdf->SetX(25);
$pdf->SetFont('Arial','IBU',10);

$pdf->Cell(150,5,'CERTIFICADO DE RETENCION DEL IMPUESTO SOBRE LOS INGRESOS BRUTOS',0,0,'C',1);


$pdf->SetFont('Arial','IBU',12);
$pdf->SetX(15);

//$pdf->SetFillColor(215,215,215);
$pdf->SetX(15);
$pdf->SetY($i=$i+5);

$pdf->Cell(0,20,'',1,'B','L',1);
$pdf->SetFont('Arial','',8);
$pdf->SetY($i=$i+2);

$pdf->SetX(15);
$pdf->Cell(20,5,'Agente de Retención: ',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(50);
$pdf->Cell(100,5,'TESORERIA GRAL. DE LA PROVINCIA DE LA RIOJA',0,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(145);
$pdf->Cell(20,5,'C.U.I.T Nº: ',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(170);
$pdf->Cell(15,5,'30-67185353-5',0,0,'L',1);

$pdf->SetFont('Arial','',8);
$pdf->SetY($i=$i+6);
$pdf->SetX(15);
$pdf->Cell(20,5,'Domicilio : ',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(50);
$pdf->Cell(20,5,'SAN NICOLAS DE BARI Nº 625',0,0,'L',1);

$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(145);
$pdf->Cell(20,5,'Nº Ag. Retencion: ',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(170);
$pdf->Cell(10,5,'000-010220-0',0,0,'L',1);



$pdf->SetFont('Arial','',8);
$pdf->SetY($i=$i+6);
$pdf->SetX(15);
$pdf->Cell(30,5,'Codigo de Sucursal : ',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(50);
$pdf->Cell(20,5,'000',0,0,'L',1);

$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(65);
$pdf->Cell(30,5,'Nombre Sucursal: ',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(90);
$pdf->Cell(20,5,'Casa Matriz',0,0,'L',1);
$pdf->SetX(15);
$pdf->SetY($i=$i+7);

$pdf->Cell(0,15,'',1,'B','L',1);
$pdf->SetFont('Arial','',8);
$pdf->SetY($i=$i+2);

$pdf->SetX(15);
$pdf->Cell(20,5,'Sujeto Retenido: ',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(50);
$pdf->Cell(100,5,$beneficiario,0,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(145);
$pdf->Cell(20,5,'C.U.I.T Nº: ',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(170);
$pdf->Cell(15,5,$cuitl,0,0,'L',1);

$pdf->SetFont('Arial','',8);
$pdf->SetY($i=$i+6);
$pdf->SetX(15);
$pdf->Cell(20,5,'Domicilio : ',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(50);
$pdf->Cell(20,5,$direccion,0,0,'L',1);

$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(145);
$pdf->Cell(20,5,'Nº Ingresos Brutos: ',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(170);
$pdf->Cell(10,5,$ingreso,0,0,'L',1);
$pdf->SetY($i=$i+8);
$pdf->SetFont('Arial','B',7);

$pdf->SetX(10);
$pdf->Cell(0,5,'Comprobante de la Operacion: '.$orden_pago,1,'B','L',1);
$pdf->SetY($i);

$pdf->SetX(90);
$pdf->Cell(0,5,'(Retencion Normal)',1,'B','L',1);
$pdf->SetFont('Arial','B',7);

$pdf->SetY($i=$i+6);

$pdf->SetX(10);
$pdf->Cell(0,5,'Importe Total Pagado Sujeto a Retención: '.$importe,1,'B','L',1);
$pdf->SetY($i);
$pdf->SetFont('Arial','B',7);

$pdf->SetX(90);
$pdf->Cell(0,5,$reg,1,'B','L',1);

$pdf->SetY($i=$i+6);

$pdf->SetX(10);
$pdf->Cell(0,5,'Base Imponible:'.$neto,1,'B','L',1);
$pdf->SetY($i);

$pdf->SetX(70);
$pdf->Cell(0,5,'Alicuota:'.$alicuota,1,'B','L',1);
$pdf->SetY($i);

$pdf->SetX(125);
$pdf->Cell(0,5,'Importe Retenido:'.$monto,1,'B','L',1);





$pdf->SetY($i=$i+8);
$pdf->SetX(10);

$pdf->MultiCell(0,4,'Declaro  bajo juramento que los datos consignados en la presente constancia son fiel expresion de la verdad.  ',0,'J',0,15);

$pdf->SetY($i=$i+8);
$pdf->SetX(10);

$pdf->Cell(50,4,'En la Rioja, '.$fe,0,'J',1);
$pdf->SetY($i);
$pdf->SetX(150);

$pdf->Cell(50,4,'CUIT: 30-67185353-5',0,'J',1);

$pdf->SetY($i=$i+8);
$pdf->SetX(10);

$pdf->Cell(50,4,'Copia para el Contribuyente',0,'J',1);
$pdf->SetY($i);
$pdf->SetX(185);

$pdf->Cell(50,4,'Original',0,'J',1);

$pdf->Image('../img/new_firma_flores.jpg',140,200,18);




$pdf->AliasNbPages();
//Launch the print dialog
//$pdf->AutoPrint(true);
$pdf->Output();
?> 
