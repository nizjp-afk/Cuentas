<?php

 $fecha_a=$_GET['year'];
$fecha_m=$_GET['mes'];


setlocale(LC_TIME, 'spanish'); 
$fecha=strftime("%A %d de %B del %Y");


$valor="Señor";

$valor=utf8_decode($valor);

$valorc="Carreño";

$valorc=utf8_decode($valorc);


$N="N°";

$N=utf8_decode($N);

$institucion ="Institución";

$institucion=utf8_decode($institucion);


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

$diaa='día';
$diaa=utf8_decode($diaa);

$punto='(. . .)';
$punto=utf8_decode($punto);



$permanecera='permanecerá';
$permanecera=utf8_decode($permanecera);

$situacion='situación';
$situacion=utf8_decode($situacion);

$deberan='deberán';
$deberan=utf8_decode($deberan);

$renovacion='renovación';
$renovacion=utf8_decode($renovacion);

$procedera='procederá';
$procedera=utf8_decode($procedera);

$automaticamente='automáticamente';
$automaticamente=utf8_decode($automaticamente);


$telefono ='Teléfono ';
$telefono=utf8_decode($telefono);

$area ='área ';
$area=utf8_decode($area);






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

 $fechaant = $_POST['firstinput'];

 



$_pagi_sql = "SELECT cuitl,apellido,nombre,razon_social,persona_tipo,
		              id_beneficiario,inhi,estado,sociedad_tipo,apellido1,nombre1,cargo1,duracion1
FROM beneficiarios_aprobados
WHERE (
MONTH( duracion1 ) ='$fecha_m'
OR MONTH( duracion2 ) ='$fecha_m'
OR MONTH( duracion3 ) ='$fecha_m'
OR MONTH( duracion4 ) ='$fecha_m'
)
AND (
YEAR( duracion1 ) ='$fecha_a'
OR YEAR( duracion2 ) ='$fecha_a'
OR YEAR( duracion3 ) ='$fecha_a'
OR YEAR( duracion4 ) ='$fecha_a'
)";
	 
        if (!($nota_g= mysql_query($_pagi_sql, $conexion_mysql)))
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
$InterLigne = 8;

//Disable automatic page break
$pdf->SetAutoPageBreak(false);

//Add first page
while ($f_garantia1 = mysql_fetch_array($nota_g))
        {
$cargo=$f_garantia1['cargo1'];
$apellido1=$f_garantia1['apellido1'];
$nombre1=$f_garantia1['nombre1'];
$duracion1= date('d-m-Y',strtotime($f_garantia1['duracion1']));
$tipo_sociedad=$f_garantia1['persona_tipo'];
$cuenta=$f_garantia1['inhi'];



$pdf->AddPage();


	


	
$y_axis_initial = 17;
// imprime el titulo de la pagina
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($y_axis_initial);
$pdf->setY(10);
$pdf->Image('../img/membrete1.jpg',25,8,0);
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
$pdf->SetX(100);
$pdf->SetY($i=$i+20);
$pdf->Cell(0,4,'NOTIFICACION','0',0,'R',1);
$pdf->SetY($i=$i+8);
$pdf->SetFont('Arial','',9);
//$pdf->Cell(0,4,'Nota: '.$nota,'0',0,'R',1);
$pdf->SetFont('Arial','B',8);

//$pdf->SetY($i=$i+8);

$pdf->Cell(0,6,' LA RIOJA, '.$fecha,0,0,'R');
$pdf->SetFont('Arial','B',11);

$pdf->SetY($i=$i+7);
$pdf->SetX(30);


$pdf->SetFont('Arial','B',11);


$pdf->Cell(0,6,$cargo,0,0,'L');

 if($f_garantia1['razon_social']=='')
			     {
					$dato_nom= $f_garantia1['apellido'].", ".$f_garantia1['nombre'];
				
				 
				 }
			   else
			     {	 
				  $dato_nom= $f_garantia1['razon_social']; 
			

		         

		 }
$tipo_s=$f_garantia1['sociedad_tipo'];

/*if($tipo_s=='23')

{*/
	$dias_t='Transcurridos el plazo legal establecido ';
	$texto2=' se ha producido el vencimiento del mandato de las autoridades de la '.$institucion.' que Usted preside el '.$diaa.' '.$duracion1.' Cabe recordar, de acuerdo a su Estatuto finalizo el mandato de las autoridades de dicha entidad. Por lo que se le solicita , tenga a bien apersonarse por nuestro Registro de Beneficiarios, ubicado en la TESORERIA GENERAL DE LA PROVINCIA, a fin de regularizar dicha '.$situacion. ', para lo cual se adjuntan los requisitos necesarios que '.$deberan. ' ser provistos  por esa entidad, para cumplimentar lo requerido.
	        ';

	/*}


else

{
	
	
	$dias_t='Transcurridos 30 ';
$texto2=' se ha producido el vencimiento del mandato de las autoridades de la '.$institucion.' que Usted preside el '.$diaa.' '.$duracion1.' Cabe recordar, que '.$segun.' la Ley de Sociedades Comerciales '.$N.' 19550 articulo 257- el estatuto precisara el termino por el que es elegido, el que no puede exceder de tres ejercicios '.$punto.' No obstante el director '.$permanecera.' en su cargo hasta ser reemplazado. Por lo que se le solicita , tenga a bien apersonarse por nuestro Registro de Beneficiarios, ubicado en la TESORERIA GENERAL DE LA PROVINCIA, a fin de regularizar dicha '.$situacion. ', para lo cual se adjuntan los requisitos necesarios que '.$deberan. ' ser provistos  por esa entidad, para cumplimentar lo requerido.        ';
}

	*/	
$pdf->SetY($i=$i+5);
 $pdf->SetX(30);
$pdf->Cell(0,6,$dato_nom.'',0,0,'L');				 
$pdf->SetY($i=$i+5);
$pdf->SetX(30);

$pdf->SetFont('Arial','BU',11);
$pdf->Cell(0,6,'AT:'.$apellido1.', '.$nombre1.'',0,0,'L');				 


$pdf->SetY($i=$i+15);
$pdf->SetX(60);

$pdf->SetFont('Arial','',11);
$texto1='Me dirijo a UD. a los efectos de notificarle que '.$segun.' nuestros registros,';

$texto3=$dias_t.'  de la presente y de no haber realizado ';
$texto4='dicha '.$renovacion.' se '.$procedera.' '.$automaticamente. ' a la baja de la Entidad de nuestro SISTEMA DE BENEFICIARIOS. ' ; 										

$InterLigne1=4;
  	$pdf->MultiCell(0,$InterLigne,$texto1,0,'J',0,15);
$pdf->SetX(30);                                                 		
													 
$pdf->MultiCell(0,$InterLigne,$texto2,0,'J',0,15);
$pdf->SetX(60);                                                 		

$pdf->MultiCell(0,$InterLigne1,$texto3,0,'J',0,15);
$pdf->SetX(30);                                                 		

$pdf->MultiCell(0,$InterLigne,$texto4,0,'J',0,15);



$pdf->SetY($i=$i+100);

$pdf->SetFont('Arial','',11);													 
$pdf->SetX(60);
$texto5='																						Sin '.$mas.', Queda UD debidamente notificado.';
$pdf->MultiCell(0,$InterLigne,$texto5,0,'J',0,15);


$InterLigne1=5;
$pdf->SetY($i=$i+20);

$pdf->SetFont('Arial','B',8);													 
$pdf->SetX(30);
$texto6='CONTACTOS: 
REGISTRO DE BENEFICIARIOS
'.$telefono.' 0380-4453164
mail:beneficiario.tgplr@gmail.com  ';
$pdf->MultiCell(0,$InterLigne1,$texto6,0,'J',0,15);

$pdf->SetY($i=$i+30);

$pdf->SetFont('Arial','B',8);													 
$pdf->SetX(30);
$texto7='Tesorero General: Cr.: Mario Zapata

Responsable del '.$area.' : Lic. David Miranda.

Contactos:

Cra. Laura '.$valorc.'.

Lic. Roberto Cisneros.

Sta. Gimena Colombo.                           

';
$pdf->MultiCell(0,$InterLigne1,$texto7,0,'J',0,15);

		}
$pdf->Output();
?> 
