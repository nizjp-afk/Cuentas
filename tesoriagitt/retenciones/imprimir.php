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
	
   
   
    $fechaant = $_GET['firstinput'];
	$fechahoy = $_GET['secondinput'];    
    $id = $_GET['id'];
	    
	
	   
        $ssql = "SELECT b.apellido,b.nombre,b.nombre_f,razon_social,r.codigo, p.cuit,p.orden_pago, p.fecha AS fecha_pago, s.monto AS retnecion,s.id,s.numero_ss,CONCAT(b.direccion_f_calle ,' ',b.direccion_f_nro) as direccion,l.descripcion as localidades,v.nombre as provincia ,b.codigo_f_postal,s.ss_id 
						FROM orden_pago AS p, sicore_ss AS s, anexoss AS r,beneficiarios_aprobados as b,localidades as l ,provincias as v
						WHERE p.orden_pago = s.orden
						AND b.cuitl=p.cuit
						AND p.ejercicio = s.ejercicio
						AND p.saf = s.saf
						AND r.id_ss = s.ss_id
						AND (b.direccion_f_localidad = l.id_localidades)  
						AND (b.direccion_f_provincia = v.codprovincia)
						AND  s.numero_ss='$id'
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
	
	
	
$ssql = "SELECT b.apellido,b.nombre,b.nombre_f,razon_social,r.codigo, p.cuit,p.orden_pago, p.fecha AS fecha_pago, s.monto AS retnecion,s.id,s.numero_ss,CONCAT(b.direccion_f_calle ,' ',b.direccion_f_nro) as direccion,l.descripcion as localidades,v.nombre as provincia ,b.codigo_f_postal,s.ss_id 
						FROM orden_pago_fp AS p, sicore_ss AS s, anexoss AS r,beneficiarios_aprobados as b,localidades as l ,provincias as v
						WHERE p.orden_pago = s.orden
						AND b.cuitl=p.cuit
						AND p.ejercicio = s.ejercicio
						AND p.saf = s.saf
						AND r.id_ss = s.ss_id
						AND (b.direccion_f_localidad = l.id_localidades)  
						AND (b.direccion_f_provincia = v.codprovincia)
						AND p.fecha = s.fecha_io
						AND  s.numero_ss='$id'
						";
         if (!($r_css_fp= mysql_query($ssql, $conexion_mysql)))
           {
	
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar beneficiario";
			  echo $cuerpo1;
			  //.....................................................................
		    }  	
	
	
	/*
	 $ssql = "SELECT b.apellido,b.nombre,b.nombre_f,razon_social,r.codigo, p.cuit,p.orden_pago, p.fecha AS fecha_pago, d.importe AS retnecion,s.id,s.numero_ss,CONCAT(b.direccion_f_calle ,' ',b.direccion_f_nro) as direccion,l.descripcion as localidades,v.nombre as provincia ,b.codigo_f_postal,s.ss_id 
						FROM orden_pago AS p, sicore_ss AS s, anexoss AS r,beneficiarios_aprobados as b,localidades as l ,provincias as v,dd_retenciones as d
						WHERE p.orden_pago = s.orden
						AND b.cuitl=p.cuit
						AND p.ejercicio = s.ejercicio
						AND p.saf = s.saf
						AND r.id_ss = s.ss_id
						AND (b.direccion_f_localidad = l.id_localidades)  
						AND (b.direccion_f_provincia = v.codprovincia)
						AND p.orden_pago = d.orden
AND p.ejercicio = d.ejercicio
AND p.saf = d.saf
						
AND (d.dd_codigo = '1' or d.dd_codigo = '6' or d.dd_codigo = '10' or d.dd_codigo = '11') 			
						AND  s.numero_ss='$id'
						and p.ejercicio > '2014'";
         if (!($r_css= mysql_query($ssql, $conexion_mysql)))
           {
	
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar beneficiario";
			  echo $cuerpo1;
			  //.....................................................................
		    }  	
	
	
	
$ssql = "SELECT b.apellido,b.nombre,b.nombre_f,razon_social,r.codigo, p.cuit,p.orden_pago, p.fecha AS fecha_pago, d.importe AS retnecion,s.id,s.numero_ss,CONCAT(b.direccion_f_calle ,' ',b.direccion_f_nro) as direccion,l.descripcion as localidades,v.nombre as provincia ,b.codigo_f_postal,s.ss_id 
						FROM orden_pago_fp AS p, sicore_ss AS s, anexoss AS r,beneficiarios_aprobados as b,localidades as l ,provincias as v,dd_retenciones as d
						WHERE p.orden_pago = s.orden
						AND b.cuitl=p.cuit
						AND p.ejercicio = s.ejercicio
						AND p.saf = s.saf
						AND r.id_ss = s.ss_id
						AND (b.direccion_f_localidad = l.id_localidades)  
						AND (b.direccion_f_provincia = v.codprovincia)
						AND p.orden_pago = d.orden
AND p.ejercicio = d.ejercicio
AND p.saf = d.saf
						
AND (d.dd_codigo = '1' or d.dd_codigo = '6' or d.dd_codigo = '10' or d.dd_codigo = '11') 			
						AND  s.numero_ss='$id'
						and p.ejercicio > '2014'";
         if (!($r_css_fp= mysql_query($ssql, $conexion_mysql)))
           {
	
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar beneficiario";
			  echo $cuerpo1;
			  //.....................................................................
		    }  	
	
		*/				
	  
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
  
  $numero_ss=$f_beneficiario['numero_ss'];
  
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
$pdf->setY(5);
$pdf->Image('../img/membrete1.jpg',15,0,0);
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
$pdf->cell(0,0,'FECHA: '.$dia,0,'B','R',0);
// (ancho,alto,texto,borde 0(sin borde):1(con borde),L: izquierda T: superior R: derecha B: inferior,alineacion (L,C,R),

////ENCABEZADO

$pdf->SetFont('Arial','IBU',12);
$pdf->setY(35);
if($cod_s=='3' or $cod_s=='1')
  {
$pdf->cell(0,0,'CONSTANCIA DE RETENCION CONTRIBUCIONES PATRONALES R.G 2682 AFIP',0,'B','C',0);

  }
 else
  {
	$pdf->cell(0,0,'CONSTANCIA DE RETENCION CONTRIBUCIONES PATRONALES R.G 1784 AFIP',0,'B','C',0);
  
  }
	
////////////
$y_axis_initial = 42;
/////////////
$pdf->SetFont('Arial','IB',7);
$i=45;

$pdf->SetY($i);
$pdf->SetX(25);
$pdf->SetFillColor(256,256,256);
$pdf->Cell(30,5,'FECHA DE RETENCION',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(65);
$pdf->Cell(20,5,$fecha_pago ,0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(110);
$pdf->Cell(30,5,'Nº COMPROBANTE:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(145);
$pdf->Cell(20,5,$numero_ss,0,0,'L',1);
$pdf->SetFont('Arial','IBU',9);
$pdf->SetY($i=$i+10);
$pdf->SetX(30);

//$pdf->SetFillColor(215,215,215);
$pdf->Cell(0,7,'DATOS AGENTE DE RETENCION',0,0,'L',1);
$pdf->SetFillColor(256,256,256);

$pdf->SetFont('Arial','B',8);
$pdf->SetY($i=$i+10);
$pdf->SetX(25);
$pdf->Cell(20,5,'RAZON SOCIAL: ',0,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(55);
$pdf->Cell(20,5,'GOBIERNO DE LA PROVINCIA DE LA RIOJA',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i=$i+6);
$pdf->SetX(25);
$pdf->Cell(25,5,'DOMICILIO FISCAL: ',0,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(55);
$pdf->Cell(20,5,'SAN NICOLAS DE BARI Nº 625',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i=$i+6);
$pdf->SetX(25);
$pdf->Cell(25,5,'C.U.I.T: ',0,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(55);
$pdf->Cell(20,5,'30-67185353-5',0,0,'L',1);




$pdf->SetFont('Arial','IBU',9);
$pdf->SetY($i=$i+10);
$pdf->SetX(30);
//$pdf->SetFillColor(215,215,215); 
$pdf->Cell(0,7,'DATOS DEL COMPROBANTE ORIGEN DE RETENCION',0,0,'L',1);
//datos domicilio legal ///
$pdf->SetFillColor(256,256,256);
$pdf->SetY($i=$i+10);
$pdf->SetX(25);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(0,5,'TIPO:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(42);
$pdf->SetFont('Arial','',8);
$pdf->Cell(0,5,'ORDEN DE PAGO',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i=$i+6);
$pdf->SetX(25);
$pdf->Cell(20,5,'NUMERO:',0,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(42);
$pdf->Cell(0,5,$orden_pago,0,0,'L',1);

$pdf->SetFont('Arial','IBU',9);
$pdf->SetY($i=$i+10);
$pdf->SetX(30);

//$pdf->SetFillColor(215,215,215); 
$pdf->Cell(0,7,'DATOS DEL SUJETO',0,0,'L',1);
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i=$i+10);
$pdf->SetX(25);
$pdf->Cell(10,5,'C.U.I.T:',0,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(55);
$pdf->Cell(0,5,$cuitl,0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i=$i+6);
$pdf->SetX(25);
$pdf->Cell(0,5,'RAZON SOCIAL:',0,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(55);
$pdf->Cell(0,5,$beneficiario,0,0,'L',1);

$pdf->SetFont('Arial','B',8);
$pdf->SetY($i=$i+6);
$pdf->SetX(25);
$pdf->Cell(0,5,'DOMICILIO FISCAL:',0,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(55);
$pdf->Cell(0,5,$direccion,0,0,'L',1);

$pdf->SetFont('Arial','',8);
$pdf->SetY($i=$i+6);
$pdf->SetX(55);
$pdf->Cell(0,5,$localidades.' PCIA. '.$provincia.' CODIGO POSTAL  '.$codigo_p,0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i=$i+10);
$pdf->SetX(25);
$pdf->Cell(0,5,'IMPORTE RETENIDO:',0,0,'L',1);
$pdf->SetFont('Arial','B',10);
$pdf->SetY($i);
$pdf->SetX(55);
$pdf->Cell(0,5,$monto.'.- ',0,0,'L',1);
$pdf->SetFont('Arial','B',9);
$pdf->SetY($i=$i+10);
$pdf->SetX(55);
$pdf->Cell(0,5,'Son Pesos: '.$letra,0,0,'L',1);



$pdf->SetY($i=$i+30);
$pdf->SetX(130);
$pdf->Cell(50,3,'..................................................',0,0,'R',1);
$pdf->SetY($i=$i+7);
$pdf->SetX(130);
$pdf->Cell(50,3,'Firma Agente de Retencion',0,0,'R',1);

$pdf->Image('../img/new_firma_flores.jpg',135,160,50);

/*
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
$pdf->Image('../img/membrete1.jpg',15,0,0);
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
$pdf->cell(0,0,'FECHA: '.$dia,0,'B','R',0);
// (ancho,alto,texto,borde 0(sin borde):1(con borde),L: izquierda T: superior R: derecha B: inferior,alineacion (L,C,R),

////ENCABEZADO

$pdf->SetFont('Arial','IBU',12);
$pdf->setY(35);
if($cod_s=='3' or $cod_s=='1')
  {
$pdf->cell(0,0,'CONSTANCIA DE RETENCION CONTRIBUCIONES PATRONALES R.G 2682 AFIP',0,'B','C',0);

  }
 else
  {
	$pdf->cell(0,0,'CONSTANCIA DE RETENCION CONTRIBUCIONES PATRONALES R.G 1784 AFIP',0,'B','C',0);
  
  }
	
////////////
$y_axis_initial = 42;
/////////////
$pdf->SetFont('Arial','IB',7);
$i=45;

$pdf->SetY($i);
$pdf->SetX(25);
$pdf->SetFillColor(256,256,256);
$pdf->Cell(30,5,'FECHA DE RETENCION',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(65);
$pdf->Cell(20,5,$fecha_pago ,0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(110);
$pdf->Cell(30,5,'Nº COMPROBANTE:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(145);
$pdf->Cell(20,5,$numero_ss,0,0,'L',1);
$pdf->SetFont('Arial','IBU',9);
$pdf->SetY($i=$i+10);
$pdf->SetX(30);

//$pdf->SetFillColor(215,215,215);
$pdf->Cell(0,7,'DATOS AGENTE DE RETENCION',0,0,'L',1);
$pdf->SetFillColor(256,256,256);

$pdf->SetFont('Arial','B',8);
$pdf->SetY($i=$i+10);
$pdf->SetX(25);
$pdf->Cell(20,5,'RAZON SOCIAL: ',0,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(55);
$pdf->Cell(20,5,'GOBIERNO DE LA PROVINCIA DE LA RIOJA',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i=$i+6);
$pdf->SetX(25);
$pdf->Cell(25,5,'DOMICILIO FISCAL: ',0,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(55);
$pdf->Cell(20,5,'SAN NICOLAS DE BARI Nº 625',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i=$i+6);
$pdf->SetX(25);
$pdf->Cell(25,5,'C.U.I.T: ',0,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(55);
$pdf->Cell(20,5,'30-67185353-5',0,0,'L',1);




$pdf->SetFont('Arial','IBU',9);
$pdf->SetY($i=$i+10);
$pdf->SetX(30);
//$pdf->SetFillColor(215,215,215); 
$pdf->Cell(0,7,'DATOS DEL COMPROBANTE ORIGEN DE RETENCION',0,0,'L',1);
//datos domicilio legal ///
$pdf->SetFillColor(256,256,256);
$pdf->SetY($i=$i+10);
$pdf->SetX(25);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(0,5,'TIPO:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(42);
$pdf->SetFont('Arial','',8);
$pdf->Cell(0,5,'ORDEN DE PAGO',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i=$i+6);
$pdf->SetX(25);
$pdf->Cell(20,5,'NUMERO:',0,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(42);
$pdf->Cell(0,5,$orden_pago,0,0,'L',1);

$pdf->SetFont('Arial','IBU',9);
$pdf->SetY($i=$i+10);
$pdf->SetX(30);

//$pdf->SetFillColor(215,215,215); 
$pdf->Cell(0,7,'DATOS DEL SUJETO',0,0,'L',1);
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i=$i+10);
$pdf->SetX(25);
$pdf->Cell(10,5,'C.U.I.T:',0,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(55);
$pdf->Cell(0,5,$cuitl,0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i=$i+6);
$pdf->SetX(25);
$pdf->Cell(0,5,'RAZON SOCIAL:',0,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(55);
$pdf->Cell(0,5,$beneficiario,0,0,'L',1);

$pdf->SetFont('Arial','B',8);
$pdf->SetY($i=$i+6);
$pdf->SetX(25);
$pdf->Cell(0,5,'DOMICILIO FISCAL:',0,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->SetY($i);
$pdf->SetX(55);
$pdf->Cell(0,5,$direccion,0,0,'L',1);

$pdf->SetFont('Arial','',8);
$pdf->SetY($i=$i+6);
$pdf->SetX(55);
$pdf->Cell(0,5,$localidades.' PCIA. '.$provincia.' CODIGO POSTAL  '.$codigo_p,0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i=$i+10);
$pdf->SetX(25);
$pdf->Cell(0,5,'IMPORTE RETENIDO:',0,0,'L',1);
$pdf->SetFont('Arial','B',10);
$pdf->SetY($i);
$pdf->SetX(55);
$pdf->Cell(0,5,$monto.'.- ',0,0,'L',1);
$pdf->SetFont('Arial','B',9);
$pdf->SetY($i=$i+10);
$pdf->SetX(55);
$pdf->Cell(0,5,'Son Pesos: '.$letra,0,0,'L',1);



$pdf->SetY($i=$i+30);
$pdf->SetX(130);
$pdf->Cell(50,3,'..................................................',0,0,'R',1);
$pdf->SetY($i=$i+7);
$pdf->SetX(130);
$pdf->Cell(50,3,'Firma Agente de Retencion',0,0,'R',1);

$pdf->Image('../img/firma_rosales.jpg',150,150,0);


*/

$pdf->AliasNbPages();
//Launch the print dialog
//$pdf->AutoPrint(true);
$pdf->Output();
?> 
