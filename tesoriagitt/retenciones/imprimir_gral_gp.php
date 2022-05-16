<?php

   error_reporting ( E_ERROR );
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
	
   
   
   $fechahoy = $_GET['firstinput'];
   $fechaant = $_GET['secondinput'];    
    $id = $_GET['id'];
	    
	
	   
        $ssql = "SELECT b.apellido, b.nombre, b.nombre_f, razon_social, r.codigo, p.cuit, p.orden_pago, p.fecha AS fecha_pago, s.neto, s.monto AS retnecion, s.id, s.numero, s.id, CONCAT( b.direccion_f_calle, ' ', b.direccion_f_nro ) AS direccion, l.descripcion AS localidades, v.nombre AS provincia, b.codigo_f_postal, r.observacion
FROM orden_pago_fp AS p, sicore AS s, anexorg830 AS r, beneficiarios_aprobados AS b, localidades AS l, provincias AS v
WHERE p.orden_pago = s.orden
AND b.cuitl = p.cuit
AND p.ejercicio = s.ejercicio
AND p.saf = s.saf
AND r.id_rg = s.regimen830_id
AND (
b.direccion_f_localidad = l.id_localidades
)
AND (
b.direccion_f_provincia = v.codprovincia
)


AND s.numero != ''		
AND (p.fecha >='$fechaant' and p.fecha <= '$fechahoy')";
         if (!($r_css= mysql_query($ssql, $conexion_mysql)))
           {
	
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar beneficiario";
			  echo $cuerpo1;
			  //.....................................................................
		    }  	
	
	
	
		
	  
//$can=mysql_num_rows($r_tcss);


 $can1=mysql_num_rows($r_css);



    
	  
		
 
 
 
  
// }
  
//////////////fin de consulta en base///////////
if($can1>0)
 {
	
	
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

while  ($f_beneficiario= mysql_fetch_array ($r_css))
  {
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
   $observacion=substr ($f_beneficiario['observacion'],0,-60);
     $neto=$f_beneficiario['neto'];
  
   $letra=num2letras($monto);
  
  if($f_beneficiario['razon_social']=='')
			     {
					
				   $beneficiario=$f_beneficiario['apellido'].", ".$f_beneficiario['nombre'];
				  }
				
			   else
			     {	  
		           $beneficiario=$f_beneficiario['razon_social'];
				 }

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
$pdf->setY(5);
$pdf->Image('../img/afip.jpg',15,0,0);
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
$pdf->setY(17);
$pdf->SetX(100);

	$pdf->cell(0,0,'SI.CO.RE - Sistema de Control',0,'B','C',0);
$pdf->setY(27);
$pdf->SetX(100);

	$pdf->cell(0,0,'de Retenciones',0,'B','C',0);
  
 
	
////////////
$y_axis_initial = 42;
/////////////
$pdf->SetFont('Arial','IB',10);
$i=40;

$pdf->SetY($i);
$pdf->SetX(100);
$pdf->SetFillColor(256,256,256);
$pdf->Cell(0,5,'Certificado Nº:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(130);
$pdf->Cell(0,5,$numero_ss,0,0,'L',1);
$pdf->SetY($i=$i+10);
$pdf->SetX(100);
$pdf->Cell(0,5,'Fecha:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(130);
$pdf->Cell(0,5,$fecha_pago ,0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(110);

$pdf->SetFont('Arial','IBU',12);
$pdf->SetY($i=$i+10);
$pdf->SetX(15);

//$pdf->SetFillColor(215,215,215);
$pdf->Cell(0,7,'A.- DATOS AGENTE DE RETENCION',0,0,'L',1);
$pdf->SetFillColor(256,256,256);

$pdf->SetFont('Arial','B',10);
$pdf->SetY($i=$i+10);
$pdf->SetX(25);
$pdf->Cell(0,5,'Apellido y Nombre o Denominacion: ',0,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(90);
$pdf->Cell(0,5,'GOBIERNO DE LA PROVINCIA DE LA RIOJA',0,0,'L',1);
$pdf->SetFont('Arial','B',10);
$pdf->SetY($i=$i+6);
$pdf->SetX(25);
$pdf->Cell(0,5,'C.U.I.T Nº: ',0,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(60);
$pdf->Cell(20,5,'30-67185353-5',0,0,'L',1);

$pdf->SetFont('Arial','B',10);
$pdf->SetY($i=$i+6);
$pdf->SetX(25);
$pdf->Cell(0,5,'DOMICILIO : ',0,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(60);
$pdf->Cell(20,5,'SAN NICOLAS DE BARI Nº 625',0,0,'L',1);

$pdf->SetFont('Arial','IBU',12);




$pdf->SetFont('Arial','IBU',12);
$pdf->SetY($i=$i+10);
$pdf->SetX(15);

$pdf->Cell(0,7,'B.- DATOS DEL SUJETO',0,0,'L',1);
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',10);
$pdf->SetFont('Arial','B',10);
$pdf->SetY($i=$i+10);
$pdf->SetX(25);
$pdf->Cell(0,5,'Apellido y Nombre o Denominacion:',0,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(90);
$pdf->Cell(0,5,$beneficiario,0,0,'L',1);
$pdf->SetFont('Arial','B',10);

$pdf->SetY($i=$i+6);
$pdf->SetX(25);
$pdf->Cell(10,5,'C.U.I.T Nº:',0,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(75);
$pdf->Cell(0,5,$cuitl,0,0,'L',1);

$pdf->SetFont('Arial','B',10);
$pdf->SetY($i=$i+6);
$pdf->SetX(25);
$pdf->Cell(0,5,'DOMICILIO:',0,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(75);
$pdf->Cell(0,5,$direccion,0,0,'L',1);

$pdf->SetFont('Arial','',8);
$pdf->SetY($i=$i+6);
$pdf->SetX(75);
$pdf->Cell(0,5,$localidades.' PCIA. '.$provincia.' CODIGO POSTAL  '.$codigo_p,0,0,'L',1);

$pdf->SetFont('Arial','IBU',12);
$pdf->SetY($i=$i+10);
$pdf->SetX(15);

//$pdf->SetFillColor(215,215,215); 
$pdf->Cell(0,7,'C.- DATOS DE LA RETENCION PRACTICADA',0,0,'L',1);
//datos domicilio legal ///
$pdf->SetFillColor(256,256,256);
$pdf->SetY($i=$i+10);
$pdf->SetX(25);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,5,'Impuesto:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(105);
$pdf->SetFont('Arial','',8);
$pdf->Cell(0,5,'Impuesto a las Ganancias',0,0,'L',1);
$pdf->SetFont('Arial','B',10);
$pdf->SetY($i=$i+6);
$pdf->SetX(25);
$pdf->Cell(20,5,'Regimen:',0,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(105);
$pdf->Cell(0,5,$observacion,0,0,'L',1);
$pdf->SetFont('Arial','B',10);
$pdf->SetY($i=$i+6);
$pdf->SetX(25);
$pdf->Cell(20,5,'Comprobante que origina la Retencion:',0,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(105);
$pdf->Cell(0,5,'Orden de Pago Nro '.$orden_pago,0,0,'L',1);
$pdf->SetFont('Arial','B',10);
$pdf->SetY($i=$i+6);
$pdf->SetX(25);
$pdf->Cell(0,5,'Monto Comprobante que origina la Retencion:',0,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(105);
$pdf->Cell(0,5,'$ '.$neto,0,0,'L',1);
$pdf->SetFont('Arial','B',10);
$pdf->SetY($i=$i+6);
$pdf->SetX(25);
$pdf->Cell(0,5,'Monto de la Retencion:',0,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(105);
$pdf->Cell(0,5,'$ '.$monto,0,0,'L',1);
$pdf->SetFont('Arial','B',10);
$pdf->SetY($i=$i+6);
$pdf->SetX(25);
$pdf->Cell(20,5,'Imposibilidad de Retencion:',0,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(105);
$pdf->Cell(0,5,'NO',0,0,'L',1);





$pdf->SetY($i=$i+45);
$pdf->SetX(130);
$pdf->Cell(50,3,'..................................................',0,0,'R',1);
$pdf->SetY($i=$i+7);
$pdf->SetX(130);
$pdf->Cell(50,3,'Firma Agente de Retencion',0,0,'R',1);
$pdf->SetY($i=$i+5);
$pdf->SetX(120);
$pdf->Cell(50,3,'Aclaracion',0,0,'R',1);
$pdf->SetY($i=$i+5);
$pdf->SetX(115);
$pdf->Cell(50,3,'Cargo',0,0,'R',1);


$pdf->Image('../img/new_firma_flores.jpg',145,189,40);

$pdf->SetY($i=$i+20);
$pdf->SetX(15);

$pdf->MultiCell(0,4,'Declaro que los datos en este Formulario son correctos y completos y que he confeccionado la presente utilizando la aplicacion (software) entregada y aprobada por la AFIP sin omitir ni falsear dato alguno que deba contener siendo fiel expresion de la verdad.  ',1,'J',0,15);


/*
////////////////////////
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
$pdf->setY(5);
$pdf->Image('../img/afip.jpg',15,0,0);
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
$pdf->setY(17);
$pdf->SetX(100);

	$pdf->cell(0,0,'SI.CO.RE - Sistema de Control',0,'B','C',0);
$pdf->setY(27);
$pdf->SetX(100);

	$pdf->cell(0,0,'de Retenciones',0,'B','C',0);
  
 
	
////////////
$y_axis_initial = 42;
/////////////
$pdf->SetFont('Arial','IB',10);
$i=40;

$pdf->SetY($i);
$pdf->SetX(100);
$pdf->SetFillColor(256,256,256);
$pdf->Cell(0,5,'Certificado Nº:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(130);
$pdf->Cell(0,5,$numero_ss,0,0,'L',1);
$pdf->SetY($i=$i+10);
$pdf->SetX(100);
$pdf->Cell(0,5,'Fecha:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(130);
$pdf->Cell(0,5,$fecha_pago ,0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(110);

$pdf->SetFont('Arial','IBU',12);
$pdf->SetY($i=$i+10);
$pdf->SetX(15);

//$pdf->SetFillColor(215,215,215);
$pdf->Cell(0,7,'A.- DATOS AGENTE DE RETENCION',0,0,'L',1);
$pdf->SetFillColor(256,256,256);

$pdf->SetFont('Arial','B',10);
$pdf->SetY($i=$i+10);
$pdf->SetX(25);
$pdf->Cell(0,5,'Apellido y Nombre o Denominacion: ',0,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(90);
$pdf->Cell(0,5,'GOBIERNO DE LA PROVINCIA DE LA RIOJA',0,0,'L',1);
$pdf->SetFont('Arial','B',10);
$pdf->SetY($i=$i+6);
$pdf->SetX(25);
$pdf->Cell(0,5,'C.U.I.T Nº: ',0,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(60);
$pdf->Cell(20,5,'30-67185353-5',0,0,'L',1);

$pdf->SetFont('Arial','B',10);
$pdf->SetY($i=$i+6);
$pdf->SetX(25);
$pdf->Cell(0,5,'DOMICILIO : ',0,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(60);
$pdf->Cell(20,5,'SAN NICOLAS DE BARI Nº 625',0,0,'L',1);

$pdf->SetFont('Arial','IBU',12);




$pdf->SetFont('Arial','IBU',12);
$pdf->SetY($i=$i+10);
$pdf->SetX(15);

$pdf->Cell(0,7,'B.- DATOS DEL SUJETO',0,0,'L',1);
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',10);
$pdf->SetFont('Arial','B',10);
$pdf->SetY($i=$i+10);
$pdf->SetX(25);
$pdf->Cell(0,5,'Apellido y Nombre o Denominacion:',0,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(90);
$pdf->Cell(0,5,$beneficiario,0,0,'L',1);
$pdf->SetFont('Arial','B',10);

$pdf->SetY($i=$i+6);
$pdf->SetX(25);
$pdf->Cell(10,5,'C.U.I.T Nº:',0,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(75);
$pdf->Cell(0,5,$cuitl,0,0,'L',1);

$pdf->SetFont('Arial','B',10);
$pdf->SetY($i=$i+6);
$pdf->SetX(25);
$pdf->Cell(0,5,'DOMICILIO:',0,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(75);
$pdf->Cell(0,5,$direccion,0,0,'L',1);

$pdf->SetFont('Arial','',8);
$pdf->SetY($i=$i+6);
$pdf->SetX(75);
$pdf->Cell(0,5,$localidades.' PCIA. '.$provincia.' CODIGO POSTAL  '.$codigo_p,0,0,'L',1);

$pdf->SetFont('Arial','IBU',12);
$pdf->SetY($i=$i+10);
$pdf->SetX(15);

//$pdf->SetFillColor(215,215,215); 
$pdf->Cell(0,7,'C.- DATOS DE LA RETENCION PRACTICADA',0,0,'L',1);
//datos domicilio legal ///
$pdf->SetFillColor(256,256,256);
$pdf->SetY($i=$i+10);
$pdf->SetX(25);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,5,'Impuesto:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(105);
$pdf->SetFont('Arial','',8);
$pdf->Cell(0,5,'Impuesto a las Ganancias',0,0,'L',1);
$pdf->SetFont('Arial','B',10);
$pdf->SetY($i=$i+6);
$pdf->SetX(25);
$pdf->Cell(20,5,'Regimen:',0,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(105);
$pdf->Cell(0,5,$observacion,0,0,'L',1);
$pdf->SetFont('Arial','B',10);
$pdf->SetY($i=$i+6);
$pdf->SetX(25);
$pdf->Cell(20,5,'Comprobante que origina la Retencion:',0,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(105);
$pdf->Cell(0,5,'Orden de Pago Nro '.$orden_pago,0,0,'L',1);
$pdf->SetFont('Arial','B',10);
$pdf->SetY($i=$i+6);
$pdf->SetX(25);
$pdf->Cell(0,5,'Monto Comprobante que origina la Retencion:',0,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(105);
$pdf->Cell(0,5,'$ '.$neto,0,0,'L',1);
$pdf->SetFont('Arial','B',10);
$pdf->SetY($i=$i+6);
$pdf->SetX(25);
$pdf->Cell(0,5,'Monto de la Retencion:',0,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(105);
$pdf->Cell(0,5,'$ '.$monto,0,0,'L',1);
$pdf->SetFont('Arial','B',10);
$pdf->SetY($i=$i+6);
$pdf->SetX(25);
$pdf->Cell(20,5,'Imposibilidad de Retencion:',0,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(105);
$pdf->Cell(0,5,'NO',0,0,'L',1);





$pdf->SetY($i=$i+45);
$pdf->SetX(130);
$pdf->Cell(50,3,'..................................................',0,0,'R',1);
$pdf->SetY($i=$i+7);
$pdf->SetX(130);
$pdf->Cell(50,3,'Firma Agente de Retencion',0,0,'R',1);
$pdf->SetY($i=$i+5);
$pdf->SetX(120);
$pdf->Cell(50,3,'Aclaracion',0,0,'R',1);
$pdf->SetY($i=$i+5);
$pdf->SetX(115);
$pdf->Cell(50,3,'Cargo',0,0,'R',1);


$pdf->Image('../img/firma_rosales.jpg',150,172,0);

$pdf->SetY($i=$i+20);
$pdf->SetX(15);

$pdf->MultiCell(0,4,'Declaro que los datos en este Formulario son correctos y completos y que he confeccionado la presente utilizando la aplicacion (software) entregada y aprobada por la AFIP sin omitir ni falsear dato alguno que deba contener siendo fiel expresion de la verdad.  ',1,'J',0,15);

*/
  }

$pdf->AliasNbPages();
 
//Launch the print dialog
//$pdf->AutoPrint(true);
$pdf->Output();
 }
?> 
