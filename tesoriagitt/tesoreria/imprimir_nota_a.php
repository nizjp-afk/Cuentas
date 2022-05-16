<?php
error_reporting ( E_ERROR );
setlocale(LC_TIME, 'spanish'); 
$fecha=strftime("%A %d de %B del %Y");


$valor="Señor";

$valor=utf8_decode($valor);

$Codigo='Código';

$Codigo=utf8_decode($Codigo);

$tesoreria='Tesorería';
$tesoreria=utf8_decode($tesoreria);

$cancelacion='cancelación';
$cancelacion=utf8_decode($cancelacion);

$pagare='Pagaré';
$pagare=utf8_decode($pagare);


$garantia='garantía';
$garantia=utf8_decode($garantia);

$prestamo='préstamo';
$prestamo=utf8_decode($prestamo);

$segun='según';
$segun=utf8_decode($segun);

$mas='más';
$mas=utf8_decode($mas);








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


    include('../dgti-mysql-var_dgti-beneficiarios.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');
    
 $f=strftime("%Y-%m-%d");
 $dia = date("Y-m-d");

 $nota =$_POST['nota'];
 $usuario =$_POST['usuario'];
 $t_nota='A';

 if($nota=='')
	
	  {
		  ?>
                   <center><h1>Error!</h1></center>
                        <meta http-equiv='refresh' content='80;url=javascript:window.history.back()'>
                        <center><img src="img/messagebox_critical.png" width="128" height="128" />
                        <p>Se ha detectado un error.
                        Ud. no  Ingreso   <b> Numero de Nota.</code>
                        <code>Espere unos segundos el Sistema se redirigir&aacute; automaticamente.
                        O haga click <a href='javascript:window.history.back()'>aqu&iacute;</a>.</code>	  
                
				<?php  
				exit;  
		  
	  }


$_pagi_sql = "SELECT cuitl,apellido,nombre,nombre_f,razon_social,persona_tipo,
		              id_beneficiario,inhi,estado
					  FROM beneficiarios_aprobados 
					  where valor_e ='A'
					  ORDER BY id_beneficiario";
	 
        if (!($estado= mysql_query($_pagi_sql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }
  
	  	  
 

	 // while ($f_garantia = mysql_fetch_array($r_garantia))
	  //{ 
	  
	

setlocale(LC_TIME, 'spanish'); 
$fecha=strftime("%A %d de %B del %Y");				
    
	
//$campo_tabla='valor';
define('FPDF_FONTPATH','font/');
require('../fpdf.php');

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
$pdf->Image('../img/tgp_01.jpg',30,6,25);

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
$pdf->SetY($i=$i+8);
$pdf->Cell(0,4,'PEDIDOS DE ALTA','0',0,'C',1);
$pdf->SetY($i=$i+8);
$pdf->SetFont('Arial','',9);
$pdf->Cell(0,4,'Nota: '.$nota,'0',0,'R',1);
$pdf->SetFont('Arial','B',8);

$pdf->SetY($i=$i+8);

$pdf->Cell(0,6,' LA RIOJA, '.$fecha,0,0,'R');

$pdf->SetY($i=$i+5);
$pdf->SetX(30);


$pdf->SetFont('Arial','B',11);


$pdf->MultiCell(0,7,'
  	                                                
AL '.$valor.' 
CONTADOR GENERAL DE LA PROVINCIA
CRA. GASPANELLO CECILIA:'

													 
,0,'J',0,15);
$pdf->SetX(30);
$pdf->SetFont('Arial','BU',11);
$pdf->MultiCell(0,7,'SU DESPACHO:'

													 
,0,'J',0,15);

$pdf->SetY($i=$i+60);
$pdf->SetX(40);

$pdf->SetFont('Arial','',11);
$texto1='															 	    		Por medio de la presente me dirijo a UD a los fines de solicitarle, tenga  ';

$texto2='a bien dar el alta en el SIPAF a la/s entidad/des que a continuacion se detalla/n:,' ; 										


  	                                                 		
$pdf->MultiCell(0,$InterLigne,$texto1,0,'J',0,15);
$pdf->SetX(30);

$pdf->MultiCell(0,$InterLigne,$texto2,0,'J',0,15);


$i=$i+40;	
$pdf->SetFillColor(215,215,215);

$pdf->SetFont('courier','B',8);
$pdf->SetY($i=$i+6);
$pdf->SetX(30);
$pdf->Cell(175,6,'Detalle',1,0,'L',1);
$pdf->SetFillColor(256,256,256);
  $pdf->SetFont('courier','B',8);
		    $pdf->SetY($i=$i+6);
		    $pdf->SetX(30);
			$pdf->Cell(20,6,'CGP_NRO',1,0,'C',1);
			$pdf->Cell(105,6,'Apellido y Nombre / Razon Social',1,0,'C',1);
			$pdf->Cell(50,6,'CUIT',1,0,'C',1);
			
		
while ($f_garantia = mysql_fetch_array($estado))
        {
              
			   
			$id = $f_garantia['id_beneficiario'];	   
			
			$ssql = "UPDATE beneficiarios_aprobados SET 
					nro_nota='$nota',
					estado='A'
					WHERE id_beneficiario='$id'";
				 if (!($r_beneficiarios = mysql_query($ssql,$conexion_mysql)))
				 {
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar dar de alta un beneficiario update";
					  echo $cuerpo1;
						   exit;
					  //.....................................................................
				 }
   
   
           $ssql = "UPDATE beneficiarios_aprobados SET 
					valor_e='N'
					WHERE id_beneficiario='$id'";
				 if (!($r_beneficiarios = mysql_query($ssql,$conexion_mysql)))
				 {
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar dar de alta un beneficiario update";
					  echo $cuerpo1;
						   exit;
					  //.....................................................................
				 }
   
   	 
	$ssql = "SELECT * FROM `beneficiarios_aprobados` WHERE id_beneficiario = '$id'";
     if (!($r_beneficiario= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar provincia";
      echo $cuerpo1;
      //.....................................................................
    }    
	 $f_beneficiario= mysql_fetch_array ($r_beneficiario);
	 

    $cuitl = $f_beneficiario['cuitl'];
  $ape = $f_beneficiario['apellido'];  
  $nom = $f_beneficiario['nombre'];  
  $razon_s = $f_beneficiario['razon_social'];  
  $documento_tipo =$f_beneficiario['documento_tipo'];
  $documento_nro =$f_beneficiario['documento_nro'];
  $fecha_nacimiento=$f_beneficiario['fecha_nacimiento'];
  $fecha=split("-",$fecha_nacimiento);
  $fecha_nacimiento=$fecha[2].'-'.$fecha[1].'-'.$fecha[0]; 
  $direccion_calle_f=$f_beneficiario['direccion_f_calle'];
  $direccion_nro_f=$f_beneficiario['direccion_f_nro'];
  $direccion_piso_f=$f_beneficiario['direccion_f_piso'];
  $direccion_dpto_nro_f=$f_beneficiario['direccion_f_dpto_nro'];
  $direccion_localidad_f=$f_beneficiario['direccion_f_localidad'];
  $direccion_provincia_f=$f_beneficiario['direccion_f_provincia'];
  $codigo_postal_f=$f_beneficiario['codigo_f_postal'];
  $direccion_calle_r=$f_beneficiario['direccion_r_calle'];
  $direccion_nro_r=$f_beneficiario['direccion_r_nro'];
  $direccion_piso_r=$f_beneficiario['direccion_r_piso'];
  $direccion_dpto_nro_r=$f_beneficiario['direccion_r_dpto_nro'];
  $direccion_provincia_r=$f_beneficiario['direccion_r_provincia'];
  $direccion_localidad_r=$f_beneficiario['direccion_r_localidad'];
  $codigo_postal_r=$f_beneficiario['codigo_r_postal']; 
  $telefono=$f_beneficiario['telefono'];
  $email=$f_beneficiario['email'];
  $ingreso_bruto=$f_beneficiario['ingreso_bruto'];
  $iva_situacion=$f_beneficiario['iva_situacion'];
  $actividad_p=$f_beneficiario['actividad_p'];
  $fecha_p=$f_beneficiario['fecha_p'];
  $actividad_s=$f_beneficiario['actividad_s'];
  $fecha_s=$f_beneficiario['fecha_s'];
   $fechac_s = $f_beneficiario['fecha_contrato'];
   $sociedad_tipo = $f_beneficiario['sociedad_tipo'];
   $ingreso_bruto = $f_beneficiario['ingreso_bruto'];
   $iva_situacion = $f_beneficiario['iva_situacion'];
   $convenio_tipo = $f_beneficiario['convenio_tipo'];
   $convenio_nro = $f_beneficiario['convenio_nro'];
   $apellido1 = $f_beneficiario['apellido1'];
   $apellido2 = $f_beneficiario['apellido2'];
   $apellido3 = $f_beneficiario['apellido3'];
   $apellido4 = $f_beneficiario['apellido4']; 
   $nombre1 = $f_beneficiario['nombre1'];
   $nombre2 = $f_beneficiario['nombre2'];
   $nombre3 = $f_beneficiario['nombre3'];
   $nombre4 = $f_beneficiario['nombre4'];
   $dni1  = $f_beneficiario['dni1'];
   $dni2 = $f_beneficiario['dni2'];
   $dni3 = $f_beneficiario['dni3'];
   $dni4 = $f_beneficiario['dni4'];
   $cargo1 = $f_beneficiario['cargo1'];
   $cargo2 = $f_beneficiario['cargo2'];
   $cargo3= $f_beneficiario['cargo3'];
   $cargo4= $f_beneficiario['cargo4'];
   $persona_tipo=$f_beneficiario['persona_tipo'];
   $cargo=$f_beneficiario['cargo'];
   $saf=$f_beneficiario['saf'];
   $area=$f_beneficiario['area'];
   $ministerial=$f_beneficiario['ministerial'];
   $fecha_c=$f_beneficiario['fecha_gestion'];
   $observacion=$f_beneficiario['observacion'];
   $inhi=$f_beneficiario['inhi'];
   $fecha_alta = date("Y/m/d");
  // $usuario_alta = $f_beneficiario['usuario_alta']; 
  
  
   //$fecha_alta = $f_beneficiario['fecha_alta'];
	 
   $ssql = "INSERT INTO beneficiarios_historial
                (cuitl,razon_social,apellido,nombre,documento_tipo,
				documento_nro,fecha_nacimiento,direccion_f_calle,direccion_f_nro,
				direccion_f_piso,direccion_f_dpto_nro,direccion_f_localidad,
				direccion_f_provincia,codigo_f_postal,direccion_r_calle,direccion_r_nro,
				direccion_r_piso,direccion_r_dpto_nro,direccion_r_localidad,
				direccion_r_provincia,codigo_r_postal,telefono,email,banco_nombre,
				banco_sucursal,banco_cta_tipo,banco_cta_nro,cbu_entidad,
				cbu_sucursal,verificador1,cbu_tipo_cta,cbu_cta,verificador2,cbu,
				fecha_contrato,sociedad_tipo,convenio_tipo,convenio_nro,
				persona_tipo,ingreso_bruto,iva_situacion,actividad_p,fecha_p,actividad_s,
				fecha_s,apellido1,apellido2,apellido3,apellido4,nombre1,nombre2,nombre3,
				nombre4,dni1,dni2,dni3,dni4,cargo1,cargo2,cargo3,cargo4,
			    area,cargo,fecha_gestion,saf,usuario_aprobo,
				fecha_aprobacion,nro_nota,tipo_nota)
				VALUES ('$cuitl','$razon_s','$ape','$nom','$documento_tipo',
				'$documento_nro','$fecha_nacimiento','$direccion_calle_f','$direccion_nro_f',
				'$direccion_piso_f','$direccion_dpto_nro_f','$direccion_localidad_f',
				'$direccion_provincia_f','$codigo_postal_f','$direccion_calle_r',
				'$direccion_nro_r','$direccion_piso_r','$direccion_dpto_nro_r',
			    '$direccion_localidad_r','$direccion_provincia_r','$codigo_postal_r',
				'$telefono','$email','$banco_nombre','$banco_sucursal',
			    '$banco_cta_tipo','$banco_cta_nro','$cbucont1','$cbucont2',
				'$cbucont3','$cbucont4','$cbucont5','$cbucont6',
				'$banco_cbu','$fechac_s','$sociedad_tipo','$convenio_tipo',
				'$convenio_nro','$persona_tipo','$ingreso_bruto','$iva_situacion',
				'$actividad_p','$fecha_p','$actividad_s','$fecha_s',
				'$apellido1','$apellido2','$apellido3','$apellido4','$nombre1',
				'$nombre2','$nombre3','$nombre4','$dni1','$dni2',
				'$dni3','$dni4','$cargo1','$cargo2','$cargo3','$cargo4',
			    '$area','$cargo','$fecha_c','$saf','$usuario',
			    '$fecha_alta','$nota','$t_nota')";
					
					if (!($r_beneficiarios = mysql_query($ssql,$conexion_mysql)))
					 {
						  //.....................................................................
						  // informa del error producido
						  $cuerpo1  = "al intentar dar de alta un beneficiario";
						  echo $cuerpo1;
							   exit;
						  //.....................................................................
					 }			 		 
				
				
					
		  $accion='Reincorporacion Sistema de Beneficiarios';
		  $tabla='beneficiarios_aprobados';
		  include('../agrego_movi.php');                                       //
   	     
			  
		    $pdf->SetFont('courier','',8);
		    $pdf->SetY($i=$i+6);
		    $pdf->SetX(30);
			
			$pdf->Cell(20,6,$id,1,0,'L',1);
			if($razon_s=='')
			  {
			$pdf->Cell(105,6,$ape.' ,'.$nom ,1,0,'L',1);
			  }
			 else
			  {
				  $pdf->Cell(105,6,$razon_s,1,0,'L',1);
			  }
			
			$pdf->Cell(50,6,$cuitl,1,0,'L',1);
			
		
			
			
			
		}
													 



$pdf->SetY($i=$i+10);

$pdf->SetFont('Arial','',11);													 
$pdf->SetX(40);
$texto3='																						Sin '.$mas.', le saludo atentamente.';
$pdf->MultiCell(0,$InterLigne,$texto3,0,'J',0,15);

$pdf->Output();
?> 
