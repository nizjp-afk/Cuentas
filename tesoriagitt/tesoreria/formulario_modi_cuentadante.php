<?php

   $f=strftime("%Y-%m-%d");
   $dia = date("d/m/Y");
   $hora =date("h:i");
         
//echo "paso";exit; 		
define('FPDF_FONTPATH','font/');
require('../fpdf.php');

//Connect to your database
//Create new pdf file
$pdf=new FPDF();
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
$pdf->SetFont('Arial','B',6);
$pdf->setY(10);
$pdf->Image('../img/membrete1.jpg',25,8,0);
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

$pdf->SetFont('Arial','IB',7);
$pdf->setY(40);
$pdf->cell(0,0,'CONSTANCIA DE CARGA ',0,'B','C',0);
$pdf->setY(45);
$pdf->cell(0,0,'SISTEMA DE BENEFICIARIO',0,'B','C',0);

////////////
$y_axis_initial = 48;
/////////////
$pdf->SetFont('Arial','IB',8);
$i=48;
$pdf->SetY($i);
$pdf->SetFillColor(215,215,215);
$pdf->Cell(0,5,'DATOS DE IDENTIFICACION',1,0,'L',1);
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell(9,5,'CUIT /CUIL: ',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(41);
$pdf->Cell(20,5,$cuitl,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i);
$pdf->SetX(81);
$pdf->Cell(50,5,'Denominacion de la Entidad:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(130);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(60,5,$razon_social,0,0,'L',1);
$pdf->SetFont('Arial','IB',8);
$pdf->SetY($i=$i+7);
$pdf->SetFillColor(215,215,215);
$pdf->Cell(0,5,'DOMICILIO FISCAL',1,0,'L',1);
//datos domicilio fiscal ///
$pdf->SetFillColor(256,256,256);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->SetFont('Arial','',7);
$pdf->Cell(0,5,'CALLE:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(40);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(0,5,$direccion_f_calle,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(5,5,'Nº:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(32);
$pdf->Cell(0,5,$direccion_f_nro,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i);
$pdf->SetX(50);
$pdf->Cell(10,5,'PISO:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(60);
$pdf->Cell(0,5,$direccion_f_piso,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i);
$pdf->SetX(90);
$pdf->Cell(0,5,'DPTO Nº:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(100);
$pdf->Cell(0,5,$direccion_f_dpto_nro,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(0,5,'PROVINCIA:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(45);
$pdf->Cell(0,5,$direccion_f_provincia,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i);
$pdf->SetX(90);
$pdf->Cell(0,5,'LOCALIDAD:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(110);
$pdf->Cell(0,5,$direccion_f_localidad,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i);
$pdf->SetX(148);
$pdf->Cell(0,5,'CODIGO POSTAL:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(172);
$pdf->Cell(0,5,$codigo_f_postal,0,0,'L',1);
$pdf->SetFont('Arial','IB',8);
$pdf->SetY($i=$i+7);
$pdf->SetFillColor(215,215,215); 
$pdf->Cell(0,5,'DOMICILIO LEGAL',1,0,'L',1);
//datos domicilio legal ///
$pdf->SetFillColor(256,256,256);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->SetFont('Arial','',7);
$pdf->Cell(0,5,'CALLE:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(40);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(0,5,$direccion_r_calle,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(5,5,'Nº:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(32);
$pdf->Cell(0,5,$direccion_r_nro,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i);
$pdf->SetX(50);
$pdf->Cell(10,5,'PISO:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(60);
$pdf->Cell(0,5,$direccion_r_piso,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i);
$pdf->SetX(90);
$pdf->Cell(0,5,'DPTO Nº:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(100);
$pdf->Cell(0,5,$direccion_r_dpto_nro,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(0,5,'PROVINCIA:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(45);
$pdf->Cell(0,5,$direccion_r_provincia,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i);
$pdf->SetX(90);
$pdf->Cell(0,5,'LOCALIDAD:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(110);
$pdf->Cell(0,5,$direccion_r_localidad,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i);
$pdf->SetX(148);
$pdf->Cell(0,5,'CODIGO POSTAL:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(172);
$pdf->Cell(0,5,$codigo_r_postal,0,0,'L',1);
 
$pdf->SetFont('Arial','IB',8);
$pdf->SetY($i=$i+7);
$pdf->SetFillColor(215,215,215); 
$pdf->Cell(0,5,'OTROS DATOS',1,0,'L',1);
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell(0,5,'TELEFONO:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(51);
$pdf->Cell(0,5,$telefono,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i);
$pdf->SetX(90);
$pdf->Cell(0,5,'DIRECCION E-MAIL:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(120);
$pdf->Cell(0,5,$email,0,0,'L',1);
$pdf->SetFont('Arial','IB',8);
$pdf->SetY($i=$i+7);
$pdf->SetFillColor(215,215,215); 
$pdf->Cell(0,5,'DATOS ECONOMICOS',1,0,'L',1);
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell(0,5,'ACTIVIDAD PRINCIPAL:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(55);
$pdf->Cell(0,5,$actividad_p_n,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(10,5,'CODIGO:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(40);
$pdf->Cell(0,5,$actividad_p,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i);
$pdf->SetX(80);
$pdf->Cell(10,5,'FECHA DE INICIO:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(120);
$pdf->Cell(0,5,$fecha_p,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(0,5,'ACTIVIDAD SECUNDARIA:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(59);
$pdf->Cell(0,5,$actividad_s_n,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(10,5,'CODIGO:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(40);
if($actividad_s=='N')
  {
$pdf->Cell(0,5,' ',0,0,'L',1);
  }
else   
  {
  $pdf->Cell(0,5,$actividad_s,0,0,'L',1);
  }
$pdf->SetFont('Arial','',7);
$pdf->SetY($i);
$pdf->SetX(80);
$pdf->Cell(10,5,'FECHA DE INICIO:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(120);

if($actividad_s=='N')
  {
$pdf->Cell(0,5,' ',0,0,'L',1);
  }
else   
  {
  $pdf->Cell(0,5,$fecha_s,0,0,'L',1);
  } 
$pdf->SetFont('Arial','IB',8);
$pdf->SetY($i=$i+7);
$pdf->SetFillColor(215,215,215); 
$pdf->Cell(0,5,'DATOS COMERCIALES',1,0,'L',1);
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell(0,5,'Fecha de Contrato Social:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(71);
$pdf->Cell(0,5,$fechac_s,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i);
$pdf->SetX(100);
$pdf->Cell(0,5,'Tipo de Sociedad:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(140);
$pdf->Cell(0,5,$sociedad_tipo,0,0,'L',1);
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(0,5,'SITUACION FRENTE AL IVA:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(71);
$pdf->Cell(0,5,$iva_situacion,0,0,'L',1);
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(0,5,'GANANCIA:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(70);
$pdf->Cell(0,5,$ganancia,0,0,'L',1);
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','',7);
/*$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(0,5,'ALICUOTA:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(70);
$pdf->Cell(0,5,$alicuota,0,0,'L',1);*/
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(0,5,'INGRESO BRUTO:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(71);
$pdf->Cell(0,5,$ingreso,0,0,'L',1);
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(0,5,'NRO. INSCRIPCION INGRESO BRUTO:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(73);
$pdf->Cell(0,5,$ingreso_bruto,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i);
$pdf->SetX(93);
$pdf->Cell(0,5,'Nº NRO. INSCRIPCION DE INGRESO BRUTO ADM CENTRAL:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(167);
$pdf->Cell(0,5,$ingreso_bruto_ac,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(0,5,'REGIMEN DE CONVENIO:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(71);
$pdf->Cell(0,5,$regimen,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(0,5,'SEGURIDAD SOCIAL:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(71);
$pdf->Cell(0,5,$seguridad,0,0,'L',1);

$pdf->SetY($i=$i+7);
$pdf->SetFillColor(215,215,215); 
$pdf->Cell(0,5,'COMPONENTES DE LA SOCIEDAD O AUTORIDADES EN EJERCICIO ',1,0,'L',1);
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+8);
$pdf->SetX(25);
$pdf->Cell(0,5,'APELLIDO Y NOMBRE',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(90);
$pdf->Cell(0,5,'DNI',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(120);
$pdf->Cell(0,5,'CARGO',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(145);
$pdf->Cell(0,5,'FECHA INICIO',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(165);
$pdf->Cell(0,5,'FECHA FIN',1,0,'L',1);
$pdf->SetFont('Arial','B',7);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(0,5,$apellido1.', '.$nombre1,1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(90);
$pdf->Cell(0,5,$dni1,1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(120);
$pdf->Cell(0,5,$cargo1,1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(145);
$pdf->Cell(0,5,$fecha_inicio1,1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(165);
$pdf->Cell(0,5,$duracion1,1,0,'L',1);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
if ($apellido2=='')
  {
 $pdf->Cell(0,5,' ',1,0,'L',1);
   }
else
  {
 $pdf->Cell(0,5,$apellido2.', '.$nombre2,1,0,'L',1); 
  }   
$pdf->SetY($i);
$pdf->SetX(90);
$pdf->Cell(0,5,$dni2,1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(120);
$pdf->Cell(0,5,$cargo2,1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(145);
$pdf->Cell(0,5,$fecha_inicio2,1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(165);
$pdf->Cell(0,5,$duracion2,1,0,'L',1);

$pdf->SetY($i=$i+5);
$pdf->SetX(25);
if ($apellido3=='')
  {
 $pdf->Cell(0,5,' ',1,0,'L',1);
   }
else
  {
 $pdf->Cell(0,5,$apellido3.', '.$nombre3,1,0,'L',1); 
  }   
$pdf->SetY($i);
$pdf->SetX(90);
$pdf->Cell(0,5,$dni3,1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(120);
$pdf->Cell(0,5,$cargo3,1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(145);
$pdf->Cell(0,5,$fecha_inicio3,1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(165);
$pdf->Cell(0,5,$duracion3,1,0,'L',1);

$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell(0,5,'Observacion:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(45);
$pdf->Cell(0,5,$observacion,0,0,'L',1);
$pdf->SetY($i=$i+5);
$pdf->SetFont('Arial','',8);
$pdf->MultiCell(0,4,' 
  El que suscribe .................................................................................................................... en su carácter de ........................
 
  .............................................. afirma que los datos declarados son correctos y completos y que no se ha omitido dato
  
alguno.
   ',0,'T','J',1);
$pdf->SetY($i=$i+28);
$pdf->SetX(25);
$pdf->SetY($i);
$pdf->Cell(50,3,'-----------------------------------------------',0,0,'R',1);
$pdf->SetY($i);
$pdf->SetX(130);
$pdf->Cell(50,3,'-----------------------------------------------',0,0,'R',1);
$pdf->SetY($i=$i+5);
$pdf->SetX(35);
$pdf->Cell(50,3,'Firma de Beneficiario',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(148);
$pdf->Cell(50,3,'Aclaracion',0,0,'L',1);

$pdf->SetY(-16);
//Select Arial italic 8
$pdf->SetFont('Arial','',10);
 //Print current and total page numbers
//$pdf->SetX(25);
$pdf->Cell(60,10,'Intervino',1,0,'L');
//$pdf->SetX(70);
$pdf->Cell(60,10,'Aprobó',1,0,'L');
//$pdf->SetX(150);
$pdf->Cell(50,10,'Tesorero',1,0,'L');

$pdf->SetY(-6);
//Select Arial italic 8
$pdf->SetFont('Arial','I',8);
 //Print current and total page numbers
$pdf->Cell(0,6,'Original',0,0,'C');
$pdf->SetFont('Arial','I',6);
$pdf->Cell(0,10,'Pagina '.$pdf->PageNo().'/{nb}',0,0,'C');


////duplicado

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
$pdf->SetFont('Arial','B',6);
$pdf->setY(10);
$pdf->Image('../img/membrete.jpg',25,8,0);
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

$pdf->SetFont('Arial','IB',7);
$pdf->setY(45);

$pdf->SetFont('Arial','IB',7);
$pdf->setY(40);
$pdf->cell(0,0,'CONSTANCIA DE CARGA ',0,'B','C',0);
$pdf->setY(45);
$pdf->cell(0,0,'SISTEMA DE BENEFICIARIO',0,'B','C',0);

////////////
$y_axis_initial = 48;
/////////////
$pdf->SetFont('Arial','IB',8);
$i=48;
$pdf->SetY($i);
$pdf->SetFillColor(215,215,215);
$pdf->Cell(0,5,'DATOS DE IDENTIFICACION',1,0,'L',1);
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell(9,5,'CUIT /CUIL: ',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(41);
$pdf->Cell(20,5,$cuitl,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i);
$pdf->SetX(81);
$pdf->Cell(0,5,'Denominacion de la Entidad:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(130);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(0,5,$razon_social,0,0,'L',1);
$pdf->SetFont('Arial','IB',8);
$pdf->SetY($i=$i+7);
$pdf->SetFillColor(215,215,215);
$pdf->Cell(0,5,'DOMICILIO FISCAL',1,0,'L',1);
//datos domicilio fiscal ///
$pdf->SetFillColor(256,256,256);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->SetFont('Arial','',7);
$pdf->Cell(0,5,'CALLE:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(40);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(0,5,$direccion_f_calle,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(5,5,'Nº:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(32);
$pdf->Cell(0,5,$direccion_f_nro,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i);
$pdf->SetX(50);
$pdf->Cell(10,5,'PISO:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(60);
$pdf->Cell(0,5,$direccion_f_piso,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i);
$pdf->SetX(90);
$pdf->Cell(0,5,'DPTO Nº:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(100);
$pdf->Cell(0,5,$direccion_f_dpto_nro,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(0,5,'PROVINCIA:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(45);
$pdf->Cell(0,5,$direccion_f_provincia,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i);
$pdf->SetX(90);
$pdf->Cell(0,5,'LOCALIDAD:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(110);
$pdf->Cell(0,5,$direccion_f_localidad,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i);
$pdf->SetX(148);
$pdf->Cell(0,5,'CODIGO POSTAL:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(172);
$pdf->Cell(0,5,$codigo_f_postal,0,0,'L',1);
$pdf->SetFont('Arial','IB',8);
$pdf->SetY($i=$i+7);
$pdf->SetFillColor(215,215,215); 
$pdf->Cell(0,5,'DOMICILIO LEGAL',1,0,'L',1);
//datos domicilio legal ///
$pdf->SetFillColor(256,256,256);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->SetFont('Arial','',7);
$pdf->Cell(0,5,'CALLE:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(40);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(0,5,$direccion_r_calle,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(5,5,'Nº:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(32);
$pdf->Cell(0,5,$direccion_r_nro,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i);
$pdf->SetX(50);
$pdf->Cell(10,5,'PISO:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(60);
$pdf->Cell(0,5,$direccion_r_piso,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i);
$pdf->SetX(90);
$pdf->Cell(0,5,'DPTO Nº:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(100);
$pdf->Cell(0,5,$direccion_r_dpto_nro,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(0,5,'PROVINCIA:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(45);
$pdf->Cell(0,5,$direccion_r_provincia,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i);
$pdf->SetX(90);
$pdf->Cell(0,5,'LOCALIDAD:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(110);
$pdf->Cell(0,5,$direccion_r_localidad,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i);
$pdf->SetX(148);
$pdf->Cell(0,5,'CODIGO POSTAL:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(172);
$pdf->Cell(0,5,$codigo_r_postal,0,0,'L',1);
 
$pdf->SetFont('Arial','IB',8);
$pdf->SetY($i=$i+7);
$pdf->SetFillColor(215,215,215); 
$pdf->Cell(0,5,'OTROS DATOS',1,0,'L',1);
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell(0,5,'TELEFONO:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(51);
$pdf->Cell(0,5,$telefono,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i);
$pdf->SetX(90);
$pdf->Cell(0,5,'DIRECCION E-MAIL:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(120);
$pdf->Cell(0,5,$email,0,0,'L',1);
$pdf->SetFont('Arial','IB',8);
$pdf->SetY($i=$i+7);
$pdf->SetFillColor(215,215,215); 
$pdf->Cell(0,5,'DATOS ECONOMICOS',1,0,'L',1);
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell(0,5,'ACTIVIDAD PRINCIPAL:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(55);
$pdf->Cell(0,5,$actividad_p_n,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(10,5,'CODIGO:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(40);
$pdf->Cell(0,5,$actividad_p,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i);
$pdf->SetX(80);
$pdf->Cell(10,5,'FECHA DE INICIO:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(120);
$pdf->Cell(0,5,$fecha_p,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(0,5,'ACTIVIDAD SECUNDARIA:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(59);
$pdf->Cell(0,5,$actividad_s_n,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(10,5,'CODIGO:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(40);
if($actividad_s=='N')
  {
$pdf->Cell(0,5,' ',0,0,'L',1);
  }
else   
  {
  $pdf->Cell(0,5,$actividad_s,0,0,'L',1);
  }
$pdf->SetFont('Arial','',7);
$pdf->SetY($i);
$pdf->SetX(80);
$pdf->Cell(10,5,'FECHA DE INICIO:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(120);

if($actividad_s=='N')
  {
$pdf->Cell(0,5,' ',0,0,'L',1);
  }
else   
  {
  $pdf->Cell(0,5,$fecha_s,0,0,'L',1);
  } 
$pdf->SetFont('Arial','IB',8);
$pdf->SetY($i=$i+7);
$pdf->SetFillColor(215,215,215); 
$pdf->Cell(0,5,'DATOS COMERCIALES',1,0,'L',1);
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell(0,5,'Fecha de Contrato Social:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(71);
$pdf->Cell(0,5,$fechac_s,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i);
$pdf->SetX(100);
$pdf->Cell(0,5,'Tipo de Sociedad:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(140);
$pdf->Cell(0,5,$sociedad_tipo,0,0,'L',1);
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(0,5,'SITUACION FRENTE AL IVA:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(71);
$pdf->Cell(0,5,$iva_situacion,0,0,'L',1);
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(0,5,'GANANCIA:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(71);
$pdf->Cell(0,5,$ganancia,0,0,'L',1);
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','',7);
/*$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(0,5,'ALICUOTA:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(71);
$pdf->Cell(0,5,$alicuota,0,0,'L',1);*/
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(0,5,'INGRESO BRUTO:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(71);
$pdf->Cell(0,5,$ingreso,0,0,'L',1);
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(0,5,'NRO. INSCRIPCION INGRESO BRUTO:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(73);
$pdf->Cell(0,5,$ingreso_bruto,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i);
$pdf->SetX(93);
$pdf->Cell(0,5,'Nº NRO. INSCRIPCION DE INGRESO BRUTO ADM CENTRAL:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(167);
$pdf->Cell(0,5,$ingreso_bruto_ac,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(0,5,'REGIMEN DE CONVENIO:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(71);
$pdf->Cell(0,5,$regimen,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(0,5,'SEGURIDAD SOCIAL:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(71);
$pdf->Cell(0,5,$seguridad,0,0,'L',1);

$pdf->SetY($i=$i+7);
$pdf->SetFillColor(215,215,215); 
$pdf->Cell(0,5,'COMPONENTES DE LA SOCIEDAD O AUTORIDADES EN EJERCICIO ',1,0,'L',1);
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+8);
$pdf->SetX(25);
$pdf->Cell(0,5,'APELLIDO Y NOMBRE',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(90);
$pdf->Cell(0,5,'DNI',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(120);
$pdf->Cell(0,5,'CARGO',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(145);
$pdf->Cell(0,5,'FECHA INICIO',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(165);
$pdf->Cell(0,5,'FECHA FIN',1,0,'L',1);
$pdf->SetFont('Arial','B',7);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(0,5,$apellido1.', '.$nombre1,1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(90);
$pdf->Cell(0,5,$dni1,1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(120);
$pdf->Cell(0,5,$cargo1,1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(145);
$pdf->Cell(0,5,$fecha_inicio1,1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(165);
$pdf->Cell(0,5,$duracion1,1,0,'L',1);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
if ($apellido2=='')
  {
 $pdf->Cell(0,5,' ',1,0,'L',1);
   }
else
  {
 $pdf->Cell(0,5,$apellido2.', '.$nombre2,1,0,'L',1); 
  }   
$pdf->SetY($i);
$pdf->SetX(90);
$pdf->Cell(0,5,$dni2,1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(120);
$pdf->Cell(0,5,$cargo2,1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(145);
$pdf->Cell(0,5,$fecha_inicio2,1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(165);
$pdf->Cell(0,5,$duracion2,1,0,'L',1);

$pdf->SetY($i=$i+5);
$pdf->SetX(25);
if ($apellido3=='')
  {
 $pdf->Cell(0,5,' ',1,0,'L',1);
   }
else
  {
 $pdf->Cell(0,5,$apellido3.', '.$nombre3,1,0,'L',1); 
  }   
$pdf->SetY($i);
$pdf->SetX(90);
$pdf->Cell(0,5,$dni3,1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(120);
$pdf->Cell(0,5,$cargo3,1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(145);
$pdf->Cell(0,5,$fecha_inicio3,1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(165);
$pdf->Cell(0,5,$duracion3,1,0,'L',1);

$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell(0,5,'Observacion:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(45);
$pdf->Cell(0,5,$observacion,0,0,'L',1);
 $pdf->SetY($i=$i+7);
$pdf->SetFont('Arial','',8);
$pdf->MultiCell(0,4,' 
  El que suscribe .................................................................................................................... en su carácter de ........................
 
  .............................................. afirma que los datos declarados son correctos y completos y que no se ha omitido dato
  
alguno.
   ',0,'T','J',1);
$pdf->SetY($i=$i+30);
$pdf->SetX(25);
$pdf->SetY($i);
$pdf->Cell(50,3,'-----------------------------------------------',0,0,'R',1);
$pdf->SetY($i);
$pdf->SetX(130);
$pdf->Cell(50,3,'-----------------------------------------------',0,0,'R',1);
$pdf->SetY($i=$i+5);
$pdf->SetX(35);
$pdf->Cell(50,3,'Firma de Beneficiario',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(148);
$pdf->Cell(50,3,'Aclaracion',0,0,'L',1);

$pdf->SetY(-16);
//Select Arial italic 8
$pdf->SetFont('Arial','',10);
 //Print current and total page numbers
//$pdf->SetX(25);
$pdf->Cell(60,10,'Intervino',1,0,'L');
//$pdf->SetX(70);
$pdf->Cell(60,10,'Aprobó',1,0,'L');
//$pdf->SetX(150);
$pdf->Cell(50,10,'Tesorero',1,0,'L');

$pdf->SetY(-6);
//Select Arial italic 8
$pdf->SetFont('Arial','I',8);
 //Print current and total page numbers


$pdf->Cell(0,6,'Duplicado',0,0,'C');
$pdf->SetFont('Arial','I',6);
$pdf->Cell(0,10,'Pagina '.$pdf->PageNo().'/{nb}',0,0,'C');



////tesoreria


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
$pdf->setY(10);
$pdf->Image('../img/membrete.jpg',25,8,0);
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

$pdf->SetFont('Arial','IB',7);
$pdf->setY(45);
$pdf->cell(0,0,'FORMULARIO DE AUTORIZACION DE ACREDITACION DE PAGOS ',0,'B','C',0);
$pdf->setY(48);
$pdf->cell(0,0,'DEL TESORO PROVINCIAL EN CUENTA BANCARIA',0,'B','C',0);
////////////
$y_axis_initial = 58;
/////////////
$pdf->SetFont('Arial','IB',8);
$i=58;
$pdf->SetY($i);
$pdf->SetFillColor(256,256,256);
$pdf->Cell(9,5,'SEÑOR',0,0,'L',1);
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(9,5,'TESORERO GENERAL DE LA PROVINCIA: ',0,0,'L',1);
$pdf->SetY($i=$i+10);
$pdf->SetFont('Arial','',8);
$pdf->MultiCell(0,7,' 
El (los) que suscribe(n)……………………………………………………………………………………………………………en
mi carácter de………………………………………….; de ……………………………………………………CUIT–CUIL Nº………………………………………….., con domicilio legal en la calle ……………………………………………………
………………………………………………………………………………………………………….…Nº………………….de la
localidad………………………………………………………………….de la Provincia de……………………………..
……………………………………, autoriza(mos) a que todo pago que deba realizar la TESORERIA GENERAL DE LA PROVINCIA, en cancelación de deudas a mi (nuestro) favor por cualquier concepto de los Organismos de la Provincia de la Rioja, sea efectuado en la cuenta bancaria que a continuación se detalla.


   ',0,'T','J',1);

   
$pdf->SetY($i=$i+80);
$pdf->Cell(0,5,'DATOS DE LA CUENTA BANCARIA ',1,0,'L',1);
$pdf->SetFont('Arial','',10);
$pdf->SetY($i=$i+8);
$pdf->SetX(25);
$pdf->Cell(0,5,'BANCO',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(100);
$pdf->Cell(0,5,$banco_nombre,1,0,'L',1);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(0,5,'SUCURSAL',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(100);
$pdf->Cell(0,5,$banco_sucursal,1,0,'L',1);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(0,5,'TIPO DE CUENTA',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(100);
$pdf->Cell(0,5,$banco_cta_tipo,1,0,'L',1);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(0,5,'NUMERO DE CUENTA',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(100);
$pdf->Cell(0,5,$banco_cta_nro,1,0,'L',1);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(0,7,'CBU',1,0,'L',1);
$pdf->SetFont('Arial','B',14);
$pdf->SetY($i);
$pdf->SetX(100);
$pdf->Cell(0,7,$cbu,1,0,'L',1);
$pdf->SetFont('Arial','',10);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell(0,5,'DENOMINACION DE CTA',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(100);
$pdf->Cell(0,5,$banco_denominacion,1,0,'L',1);

$pdf->SetY($i=$i+10);
$pdf->SetFont('Arial','U',8);
$pdf->Cell(0,5,'NOTA:',0,0,'L',1);
$pdf->SetY($i=$i+2);
$pdf->SetFont('Arial','',8);
$pdf->MultiCell(0,7,'
  	      Se informa  que  en  caso  de  cualquier  modificacion que se produzca en el Estatuto y/o Contrato Social, Acta de Designacion de autoridades, Cuenta Bancaria, Domicilio Fiscal y/o Legal, etc; debera notificarse al Area de Registro de Beneficiarios dependientes del Ministerio de Hacienda de la Provincia de la Rioja dentro del plazo de CINCO (5) dias de quedar en firme. 
	      Quedando bajo exclusiva responsabilidad del/los Beneficiarios las consecuencias que se pudieren derivar de tal situacion.
',0,'T','J',1);

//$pdf->SetY($i=$i+35);
//$pdf->Cell(0,5,'Desde ya queda Ud. debidamente notificado.',0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+60);
$pdf->SetX(25);
$pdf->SetY($i);
$pdf->Cell(50,3,'-----------------------------------------------',0,0,'R',1);
$pdf->SetY($i);
$pdf->SetX(130);
$pdf->Cell(50,3,'-----------------------------------------------',0,0,'R',1);
$pdf->SetY($i=$i+5);
$pdf->SetX(35);
$pdf->Cell(50,3,'Firma de Beneficiario',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(148);
$pdf->Cell(50,3,'Aclaracion',0,0,'L',1);
$pdf->SetY(-16);
//Select Arial italic 8
$pdf->SetFont('Arial','',10);
 //Print current and total page numbers
//$pdf->SetX(25);
$pdf->Cell(60,10,'Intervino',1,0,'L');
//$pdf->SetX(70);
$pdf->Cell(60,10,'Aprobó',1,0,'L');
//$pdf->SetX(150);
$pdf->Cell(50,10,'Tesorero',1,0,'L');

$pdf->SetY(-6);
//Select Arial italic 8
$pdf->SetFont('Arial','I',8);
 //Print current and total page numbers
$pdf->Cell(0,6,'Original',0,0,'C');
$pdf->SetFont('Arial','I',6);
$pdf->Cell(0,10,'Pagina '.$pdf->PageNo().'/{nb}',0,0,'C');

//DUPLICADO TESORERIA


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
$pdf->setY(10);
$pdf->Image('../img/membrete.jpg',25,8,0);
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

$pdf->SetFont('Arial','IB',7);
$pdf->setY(45);
$pdf->cell(0,0,'FORMULARIO DE AUTORIZACION DE ACREDITACION DE PAGOS ',0,'B','C',0);
$pdf->setY(48);
$pdf->cell(0,0,'DEL TESORO PROVINCIAL EN CUENTA BANCARIA',0,'B','C',0);
////////////
$y_axis_initial = 58;
/////////////
$pdf->SetFont('Arial','IB',8);
$i=58;
$pdf->SetY($i);
$pdf->SetFillColor(256,256,256);
$pdf->Cell(9,5,'SEÑOR',0,0,'L',1);
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(9,5,'TESORERO GENERAL DE LA PROVINCIA: ',0,0,'L',1);
$pdf->SetY($i=$i+10);
$pdf->SetFont('Arial','',8);
$pdf->MultiCell(0,7,' 
El (los) que suscribe(n)……………………………………………………………………………………………………………en
mi carácter de………………………………………….; de ……………………………………………………CUIT–CUIL Nº………………………………………….., con domicilio legal en la calle ……………………………………………………
………………………………………………………………………………………………………….…Nº………………….de la
localidad………………………………………………………………….de la Provincia de……………………………..
……………………………………, autoriza(mos) a que todo pago que deba realizar la TESORERIA GENERAL DE LA PROVINCIA, en cancelación de deudas a mi (nuestro) favor por cualquier concepto de los Organismos de la Provincia de la Rioja, sea efectuado en la cuenta bancaria que a continuación se detalla.


   ',0,'T','J',1);

   
$pdf->SetY($i=$i+80);
$pdf->Cell(0,5,'DATOS DE LA CUENTA BANCARIA ',1,0,'L',1);
$pdf->SetFont('Arial','',10);
$pdf->SetY($i=$i+8);
$pdf->SetX(25);
$pdf->Cell(0,5,'BANCO',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(100);
$pdf->Cell(0,5,$banco_nombre,1,0,'L',1);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(0,5,'SUCURSAL',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(100);
$pdf->Cell(0,5,$banco_sucursal,1,0,'L',1);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(0,5,'TIPO DE CUENTA',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(100);
$pdf->Cell(0,5,$banco_cta_tipo,1,0,'L',1);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(0,5,'NUMERO DE CUENTA',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(100);
$pdf->Cell(0,5,$banco_cta_nro,1,0,'L',1);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(0,7,'CBU',1,0,'L',1);
$pdf->SetFont('Arial','B',14);
$pdf->SetY($i);
$pdf->SetX(100);
$pdf->Cell(0,7,$cbu,1,0,'L',1);
$pdf->SetFont('Arial','',10);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell(0,5,'DENOMINACION DE CTA',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(100);
$pdf->Cell(0,5,$banco_denominacion,1,0,'L',1);

$pdf->SetY($i=$i+10);
$pdf->SetFont('Arial','U',8);
$pdf->Cell(0,5,'NOTA:',0,0,'L',1);
$pdf->SetY($i=$i+2);
$pdf->SetFont('Arial','',8);
$pdf->MultiCell(0,7,'
  	      Se informa  que  en  caso  de  cualquier  modificacion que se produzca en el Estatuto y/o Contrato Social, Acta de Designacion de autoridades, Cuenta Bancaria, Domicilio Fiscal y/o Legal, etc; debera notificarse al Area de Registro de Beneficiarios dependientes del Ministerio de Hacienda de la Provincia de la Rioja dentro del plazo de CINCO (5) dias de quedar en firme. 
	      Quedando bajo exclusiva responsabilidad del/los Beneficiarios las consecuencias que se pudieren derivar de tal situacion.
',0,'T','J',1);

//$pdf->SetY($i=$i+35);
//$pdf->Cell(0,5,'Desde ya queda Ud. debidamente notificado.',0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+60);
$pdf->SetX(25);
$pdf->SetY($i);
$pdf->Cell(50,3,'-----------------------------------------------',0,0,'R',1);
$pdf->SetY($i);
$pdf->SetX(130);
$pdf->Cell(50,3,'-----------------------------------------------',0,0,'R',1);
$pdf->SetY($i=$i+5);
$pdf->SetX(35);
$pdf->Cell(50,3,'Firma de Beneficiario',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(148);
$pdf->Cell(50,3,'Aclaracion',0,0,'L',1);
$pdf->SetY(-16);
//Select Arial italic 8
$pdf->SetFont('Arial','',10);
 //Print current and total page numbers
//$pdf->SetX(25);
$pdf->Cell(60,10,'Intervino',1,0,'L');
//$pdf->SetX(70);
$pdf->Cell(60,10,'Aprobó',1,0,'L');
//$pdf->SetX(150);
$pdf->Cell(50,10,'Tesorero',1,0,'L');

$pdf->SetY(-6);
//Select Arial italic 8
$pdf->SetFont('Arial','I',8);
 //Print current and total page numbers
$pdf->Cell(0,6,'Duplicado',0,0,'C');
$pdf->SetFont('Arial','I',6);
$pdf->Cell(0,10,'Pagina '.$pdf->PageNo().'/{nb}',0,0,'C');

$pdf->AliasNbPages();
//Launch the print dialog
//$pdf->AutoPrint(true);
$pdf->Output();
?> 
