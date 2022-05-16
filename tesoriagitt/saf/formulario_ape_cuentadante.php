<?php

   $f=strftime("%Y-%m-%d");
   $dia = date("d/m/Y");
   $hora =date("h:i");
         
//echo "paso";exit; 		
define('FPDF_FONTPATH','font/');
require('../fpdf.php');
$InterLigne = 5;

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
$pdf->setY(5);
//$pdf->Image('../img/escudo1.jpg',20,5,0);
$pdf->Image('../img/membrete.jpg',10,5,0);
$pdf->setY(22);
$pdf->SetX(15);
$pdf->SetFont('Arial','B',4);
//$pdf->Cell(0,6,'TESORERIA GENERAL DE LA PROVINCIA',0,'B','L',0);
//$pdf->setY(23);
//$pdf->Cell(0,6,'CONTADURIA GENERAL DE LA PROVINCIA',0,'B','L',0);
//$pdf->Image('../img/cuadro.jpg',170,15,15);
/////////FECHA///////

//$pdf->SetFont('Arial','B',6);
//$pdf->setX(150);
// (ancho,alto,texto,borde 0(sin borde):1(con borde),L: izquierda T: superior R: derecha B: inferior,alineacion (L,C,R),
$pdf->SetFont('Arial','B',10);
$pdf->setY(10);
$pdf->SetX(165);
$pdf->cell(30,10,'FA TGP Nº01 ',1,'B','R',0);
// (ancho,alto,texto,borde 0(sin borde):1(con borde),L: izquierda T: superior R: derecha B: inferior,alineacion (L,C,R),

////ENCABEZADO

$pdf->SetFont('Arial','IB',12);
$pdf->setY(40);
$pdf->cell(0,0,'FORMULARIO DE SOLICITUD DE APERTURA DE CUENTA ',0,'B','C',0);
$pdf->SetFont('Arial','B',10);
$pdf->setY(48);
$pdf->SetX(25);

$pdf->MultiCell(60,7,'SR. MINISTRO DE HACIENDA: ',0,'J',0,15);

$texto1=' 	   																						Por medio de la presente me dirijo al Señor Ministro a efectos de solicitarle la
ratificacion, de la Cuenta que se detalla a continuacion, a fin de encuadrarnos dentro de la 
normativa vigente:';										

$pdf->setY(60);
$pdf->SetX(25);
 $pdf->SetFont('Arial','B',10); 	                                                 		
$pdf->MultiCell(0,$InterLigne,$texto1,0,'J',0,15);

////////////
$y_axis_initial = 60;
/////////////
$pdf->SetFont('Arial','IB',7);
$i=85;
$pdf->SetY($i);
$pdf->SetX(25);

$pdf->SetFillColor(215,215,215);
$pdf->Cell(170,4,'DATOS DEL ORGANISMO SOLICITANTE',1,0,'C',1);
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(170,6,'DENOMINACION: ',1,0,'L',1);

$pdf->SetY($i=$i+6);
$pdf->SetX(25);
$pdf->Cell(85,6,'CUIT Nº :',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(100);
$pdf->Cell(95,6,'I.B Nº :',1,0,'L',1);



$pdf->SetFont('Arial','IB',7);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);

$pdf->SetFillColor(215,215,215);
$pdf->Cell(170,4,'DOMICILIO',1,0,'C',1);
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',8);



$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(135,6,'CALLE: ',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(160);
$pdf->Cell(35,6,'Nº :',1,0,'L',1);

$pdf->SetY($i=$i+6);
$pdf->SetX(25);
$pdf->Cell(135,6,'LOCALIDAD :',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(160);
$pdf->Cell(35,6,'C.P. Nº :',1,0,'L',1);




$pdf->SetFont('Arial','IB',7);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);

$pdf->SetFillColor(215,215,215);
$pdf->Cell(170,4,'DATOS DE LA CUENTA',1,0,'C',1);
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',8);



$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(170,6,'DENOMINACION: ',1,0,'L',1);
$pdf->SetY($i=$i+6);
$pdf->SetX(25);
$pdf->Cell(125,6,'BANCO:',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(120);
$pdf->Cell(75,6,'SUCURSAL :',1,0,'L',1);




$pdf->SetY($i=$i+6);
$pdf->SetX(25);
$pdf->Cell(170,6,'TIPO DE CUENTA :',1,0,'L',1);
$pdf->SetY($i=$i+1);
$pdf->SetFont('Arial','B',6);
$pdf->SetX(70);
$pdf->Cell(5,3,'',1,0,'L',1);
$pdf->SetX(76);
$pdf->Cell(5,4,'CUENTA CORRIENTE',0,0,'L',1);
$pdf->SetX(130);
$pdf->Cell(5,3,'',1,0,'L',1);
$pdf->SetX(136);
$pdf->Cell(5,4,'CAJA DE AHORRO',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(170,6,'Nº DE CUENTA :',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(135);
$pdf->Cell(60,6,'TIPO DE MONEDA :',1,0,'L',1);
$pdf->SetY($i=$i+6);
$pdf->SetX(25);
$pdf->Cell(170,6,'CBU:',1,0,'L',1);
$pdf->SetY($i=$i+1);
$pdf->SetFont('Arial','B',6);
$j=40;
$pdf->SetX($j);
$pdf->Cell(5,4,'',1,0,'L',1);
$pdf->SetX($j=$j+5);
$pdf->Cell(5,4,'',1,0,'L',1);
$pdf->SetX($j=$j+5);
$pdf->Cell(5,4,'',1,0,'L',1);
$pdf->SetX($j=$j+5);
$pdf->Cell(5,4,'',1,0,'L',1);
$pdf->SetX($j=$j+5);
$pdf->Cell(5,4,'',1,0,'L',1);
$pdf->SetX($j=$j+5);
$pdf->Cell(5,4,'',1,0,'L',1);
$pdf->SetX($j=$j+5);
$pdf->Cell(5,4,'',1,0,'L',1);
$pdf->SetX($j=$j+5);
$pdf->Cell(5,4,'',1,0,'L',1);
$pdf->SetX($j=$j+5);
$pdf->Cell(5,4,'',1,0,'L',1);
$pdf->SetX($j=$j+5);
$pdf->Cell(5,4,'',1,0,'L',1);
$pdf->SetX($j=$j+5);
$pdf->Cell(5,4,'',1,0,'L',1);
$pdf->SetX($j=$j+5);
$pdf->Cell(5,4,'',1,0,'L',1);
$pdf->SetX($j=$j+5);
$pdf->Cell(5,4,'',1,0,'L',1);
$pdf->SetX($j=$j+5);
$pdf->Cell(5,4,'',1,0,'L',1);
$pdf->SetX($j=$j+5);
$pdf->Cell(5,4,'',1,0,'L',1);
$pdf->SetX($j=$j+5);
$pdf->Cell(5,4,'',1,0,'L',1);
$pdf->SetX($j=$j+5);
$pdf->Cell(5,4,'',1,0,'L',1);
$pdf->SetX($j=$j+5);
$pdf->Cell(5,4,'',1,0,'L',1);
$pdf->SetX($j=$j+5);
$pdf->Cell(5,4,'',1,0,'L',1);
$pdf->SetX($j=$j+5);
$pdf->Cell(5,4,'',1,0,'L',1);
$pdf->SetX($j=$j+5);
$pdf->Cell(5,4,'',1,0,'L',1);
$pdf->SetX($j=$j+5);
$pdf->Cell(5,4,'',1,0,'L',1);

$pdf->SetFont('Arial','IB',7);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);

$pdf->SetFillColor(215,215,215);
$pdf->Cell(170,4,' DATOS DE LOS RESPONSABLES ',1,0,'C',1);
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',8);



$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(170,6,'NOMBRE Y APELLIDO: ',1,0,'L',1);
$pdf->SetY($i=$i+6);
$pdf->SetX(25);
$pdf->Cell(125,6,'DNI / LC/ LE Nº:',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(120);
$pdf->Cell(75,6,'CUIT Nº :',1,0,'L',1);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(170,6,'FECHA Y LUGAR DE NACIMIENTO: ',1,0,'L',1);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(170,6,'NACIONALIDAD: ',1,0,'L',1);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(85,6,'SEXO :',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(100);
$pdf->Cell(95,6,'ESTADO CIVIL :',1,0,'L',1);

$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(170,6,'DOMICILIO PARTICULAR: ',1,0,'L',1);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(170,6,'LOCALIDAD / PROVINCIA / CP: ',1,0,'L',1);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(170,6,'TELEFONO PARTICULAR: ',1,0,'L',1);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell(170,12,'FIRMA: ',1,0,'L',1);

$pdf->SetY($i=$i+15);
$pdf->SetX(25);
$pdf->Cell(170,6,'NOMBRE Y APELLIDO: ',1,0,'L',1);
$pdf->SetY($i=$i+6);
$pdf->SetX(25);
$pdf->Cell(125,6,'DNI / LC/ LE Nº:',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(120);
$pdf->Cell(75,6,'CUIT Nº :',1,0,'L',1);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(170,6,'FECHA Y LUGAR DE NACIMIENTO: ',1,0,'L',1);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(170,6,'NACIONALIDAD: ',1,0,'L',1);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(85,6,'SEXO :',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(100);
$pdf->Cell(95,6,'ESTADO CIVIL :',1,0,'L',1);

$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(170,6,'DOMICILIO PARTICULAR: ',1,0,'L',1);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(170,6,'LOCALIDAD / PROVINCIA / CP: ',1,0,'L',1);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(170,6,'TELEFONO PARTICULAR: ',1,0,'L',1);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell(170,12,'FIRMA: ',1,0,'L',1);



$pdf->SetY(-15);
//Select Arial italic 8
$pdf->SetFont('Arial','I',8);
 //Print current and total page numbers
$pdf->Cell(0,10,'Pagina '.$pdf->PageNo().'/{nb}',0,0,'C');


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
$pdf->setY(5);
//$pdf->Image('../img/escudo1.jpg',20,5,0);
$pdf->Image('../img/membrete.jpg',10,5,0);
$pdf->setY(22);
$pdf->SetX(15);
$pdf->SetFont('Arial','B',4);
//$pdf->Cell(0,6,'TESORERIA GENERAL DE LA PROVINCIA',0,'B','L',0);
//$pdf->setY(23);
//$pdf->Cell(0,6,'CONTADURIA GENERAL DE LA PROVINCIA',0,'B','L',0);
//$pdf->Image('../img/cuadro.jpg',170,15,15);
/////////FECHA///////

//$pdf->SetFont('Arial','B',6);
//$pdf->setX(150);
// (ancho,alto,texto,borde 0(sin borde):1(con borde),L: izquierda T: superior R: derecha B: inferior,alineacion (L,C,R),
$pdf->SetFont('Arial','B',10);
$pdf->setY(10);
$pdf->SetX(165);
$pdf->cell(30,10,'FA TGP Nº01 ',1,'B','R',0);
// (ancho,alto,texto,borde 0(sin borde):1(con borde),L: izquierda T: superior R: derecha B: inferior,alineacion (L,C,R),


$pdf->SetFont('Arial','IB',12);
$pdf->setY(40);
$pdf->cell(0,0,'FORMULARIO DE SOLICITUD DE APERTURA DE CUENTA ',0,'B','C',0);
$pdf->SetFont('Arial','B',10);
$i=50;


$pdf->SetFont('Arial','IB',7);
$pdf->SetY($i);
$pdf->SetX(25);

$pdf->SetFillColor(215,215,215);
$pdf->Cell(170,4,' DATOS DE LOS RESPONSABLES ',1,0,'C',1);
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',8);

$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(170,6,'NOMBRE Y APELLIDO: ',1,0,'L',1);
$pdf->SetY($i=$i+6);
$pdf->SetX(25);
$pdf->Cell(125,6,'DNI / LC/ LE Nº:',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(120);
$pdf->Cell(75,6,'CUIT Nº :',1,0,'L',1);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(170,6,'FECHA Y LUGAR DE NACIMIENTO: ',1,0,'L',1);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(170,6,'NACIONALIDAD: ',1,0,'L',1);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(85,6,'SEXO :',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(100);
$pdf->Cell(95,6,'ESTADO CIVIL :',1,0,'L',1);

$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(170,6,'DOMICILIO PARTICULAR: ',1,0,'L',1);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(170,6,'LOCALIDAD / PROVINCIA / CP: ',1,0,'L',1);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(170,6,'TELEFONO PARTICULAR: ',1,0,'L',1);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell(170,12,'FIRMA: ',1,0,'L',1);

$pdf->SetY($i=$i+15);
$pdf->SetX(25);
$pdf->Cell(170,6,'NOMBRE Y APELLIDO: ',1,0,'L',1);
$pdf->SetY($i=$i+6);
$pdf->SetX(25);
$pdf->Cell(125,6,'DNI / LC/ LE Nº:',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(120);
$pdf->Cell(75,6,'CUIT Nº :',1,0,'L',1);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(170,6,'FECHA Y LUGAR DE NACIMIENTO: ',1,0,'L',1);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(170,6,'NACIONALIDAD: ',1,0,'L',1);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(85,6,'SEXO :',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(100);
$pdf->Cell(95,6,'ESTADO CIVIL :',1,0,'L',1);

$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(170,6,'DOMICILIO PARTICULAR: ',1,0,'L',1);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(170,6,'LOCALIDAD / PROVINCIA / CP: ',1,0,'L',1);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(170,6,'TELEFONO PARTICULAR: ',1,0,'L',1);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell(170,12,'FIRMA: ',1,0,'L',1);

$pdf->SetY($i=$i+30);
$pdf->SetX(25);
$pdf->Cell(95,6,'DOCUMENTACION QUE SE DEBE ADJUNTAR A LA SOLICITUD',1,0,'L',1);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell(95,25,'',1,0,'L',1);
$pdf->SetX(135);
$pdf->Cell(60,25,'',1,0,'L',1);

$pdf->SetFont('Arial','B',6);
$pdf->SetY($i=$i+1);
$pdf->SetX(26);
$pdf->Cell(70,4,'1-FOTOCOPIA DE DNI / LC / LE DE LOS RESPONSABLES',0,0,'L',1);
$pdf->SetY($i=$i+4);
$pdf->SetX(26);
$pdf->Cell(70,4,'2-FOTOCOPIA DEL ACTO ADMINISTRATIVO DE DESIGNACION DE CADA RESPONSABLE',0,0,'L',1);
$pdf->SetY($i=$i+4);
$pdf->SetX(26);
$pdf->Cell(70,4,'3-FIRMA DEL RESPONSABLE DEL ORGANISMO PETICIONANTE',0,0,'L',1);
$pdf->SetY($i=$i+4);
$pdf->SetX(26);
$pdf->Cell(70,4,'4-FIRMA DEL RESPONSABLE DEL SERVICIO DE ADMINISTRACION FINANCIERA ',0,0,'L',1);
$pdf->SetY($i=$i+4);
$pdf->SetX(28);
$pdf->Cell(70,4,'DEL CUAL DEPENDE',0,0,'L',1);

$pdf->SetX(140);
$pdf->Cell(30,4,'FIRMA DEL RESPONSABLE DEL ORGANISMO',0,0,'L',1);




$pdf->SetY(-15);
//Select Arial italic 8
$pdf->SetFont('Arial','I',8);
 //Print current and total page numbers
$pdf->Cell(0,10,'Pagina '.$pdf->PageNo().'/{nb}',0,0,'C');



$pdf->AliasNbPages();

$pdf->Output();
?> 
