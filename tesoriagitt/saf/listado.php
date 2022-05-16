<?php

    include('../dgti-mysql-var_dgti-beneficiarios.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');
    //include('conexion/extras.php');
	
    
   $cuitl = $_GET['cuitl'];
	$id = $_GET['id'];
    $ssql = "SELECT cuitl,LTRIM(CONCAT(`beneficiarios_aprobados`.`apellido` ,' ', `beneficiarios_aprobados`.`nombre` , `beneficiarios_aprobados`.`razon_social`)) as Denominacion,CONCAT(`direccion_f_calle`,' ',`direccion_f_nro`)Domicilio,`provincias`.`nombre` as Provincia,`localidades`.`descripcion` as Localidades,`beneficiarios_aprobados`.`telefono`,`beneficiarios_aprobados`.`email` 
FROM `beneficiarios_aprobados`,`localidades` , `provincias`
WHERE (
 ( `beneficiarios_aprobados`.`direccion_f_localidad` = localidades.id_localidades ) 
AND ( `beneficiarios_aprobados`.`direccion_f_provincia` = provincias.codprovincia ))
Order By denominacion";
     if (!($r_beneficiario= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar beneficiario";
      echo $cuerpo1;
      //.....................................................................
    }    
	
  
	
	
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
$pdf=new FPDF('L','mm','A4');
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
$pdf->setY(10);
//$pdf->Image('../img/escudo.jpg',15,8,0);
//$pdf->SetX(105);
/*$pdf->SetFont('Arial','B',8);
$pdf->Cell(0,6,'TESORERIA GENERAL DE LA PROVINCIA',0,'B','C',0);
$pdf->setY(18);
$pdf->Cell(0,6,'CONTADURIA GENERAL DE LA PROVINCIA',0,'B','C',0);
//$pdf->Image('../img/cuadro.jpg',170,15,15);
/////////FECHA///////
*/
$pdf->SetFont('Arial','B',6);
//$pdf->setX(150);
// (ancho,alto,texto,borde 0(sin borde):1(con borde),L: izquierda T: superior R: derecha B: inferior,alineacion (L,C,R),
//$pdf->setY(25);
$pdf->cell(0,0,'FECHA: '.$dia,0,'B','R',0);
// (ancho,alto,texto,borde 0(sin borde):1(con borde),L: izquierda T: superior R: derecha B: inferior,alineacion (L,C,R),

////ENCABEZADO

$pdf->SetFont('Arial','IB',7);
$pdf->setY(15);
$pdf->cell(0,0,'LISTADOS DE BENEFICIARIOS',0,'B','C',0);
//$pdf->setY();
//$pdf->cell(0,0,'SISTEMA BENEFICIARIO',0,'B','C',0);

////////////
$y_axis_initial = 25;
$tr=21;
/////////////
$i=25;
$pdf->SetFont('Arial','IB',7);
$pdf->SetFillColor(215,215,215);
$pdf->SetY($i);
$pdf->SetX(15);
$pdf->Cell(0,5,'Nº',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(25);
$pdf->Cell(0,5,'CUIT',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(45);
$pdf->Cell(0,5,'DENOMINACION',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(100);
$pdf->Cell(0,5,'DOMICILIO',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(150);
$pdf->Cell(0,5,'LOCALIDAD',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(200);
$pdf->Cell(0,5,'TELEFONO',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(230);
$pdf->Cell(0,5,'MAIL',1,0,'L',1);
$n=0;
$t=0;
 while ($f_beneficiario= mysql_fetch_array ($r_beneficiario))
     {
	  
	 if ($t == $tr)
		{
		$t=0;
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
		$pdf->setY(10);
		//$pdf->Image('../img/escudo.jpg',25,8,0);
		//$pdf->SetX(105);
		/*$pdf->SetFont('Arial','B',8);
		$pdf->Cell(0,6,'TESORERIA GENERAL DE LA PROVINCIA',0,'B','C',0);
		$pdf->setY(18);
		$pdf->Cell(0,6,'CONTADURIA GENERAL DE LA PROVINCIA',0,'B','C',0);
		//$pdf->Image('../img/cuadro.jpg',170,15,15);
		/////////FECHA///////*/
		
		$pdf->SetFont('Arial','B',6);
		//$pdf->setX(150);
		// (ancho,alto,texto,borde 0(sin borde):1(con borde),L: izquierda T: superior R: derecha B: inferior,alineacion (L,C,R),
		//$pdf->setY(25);
		$pdf->cell(0,0,'FECHA: '.$dia,0,'B','R',0);
		// (ancho,alto,texto,borde 0(sin borde):1(con borde),L: izquierda T: superior R: derecha B: inferior,alineacion (L,C,R),
		
		////ENCABEZADO
		
		$pdf->SetFont('Arial','IB',7);
		$pdf->setY(15);
		$pdf->cell(0,0,'LISTADOS DE BENEFICIARIOS',0,'B','C',0);
//		$pdf->setY(48);
		//$pdf->cell(0,0,'SISTEMA BENEFICIARIO',0,'B','C',0);
		
		////////////
		$y_axis_initial = 25;
		$tr=21;
		/////////////
		$i=25;
		$pdf->SetFont('Arial','IB',7);
		$pdf->SetFillColor(215,215,215);
		$pdf->SetY($i);
		$pdf->SetX(15);
		$pdf->Cell(0,5,'Nº',1,0,'L',1);
		$pdf->SetY($i);
		$pdf->SetX(25);
		$pdf->Cell(0,5,'CUIT',1,0,'L',1);
		$pdf->SetY($i);
		$pdf->SetX(45);
		$pdf->Cell(0,5,'DENOMINACION',1,0,'L',1);
		$pdf->SetY($i);
		$pdf->SetX(100);
		$pdf->Cell(0,5,'DOMICILIO',1,0,'L',1);
		$pdf->SetY($i);
		$pdf->SetX(150);
		$pdf->Cell(0,5,'LOCALIDAD',1,0,'L',1);
		$pdf->SetY($i);
		$pdf->SetX(200);
		$pdf->Cell(0,5,'TELEFONO',1,0,'L',1);
		$pdf->SetY($i);
		$pdf->SetX(230);
		$pdf->Cell(0,5,'MAIL',1,0,'L',1);
		
	   }
  	  $n=$n+1;
	  $cuitl = $f_beneficiario['cuitl'];
	  $denominacion= $f_beneficiario['Denominacion'];
	  $domicilio= $f_beneficiario['Domicilio'];
	  $provincia =$f_beneficiario['Provincia'];
	  $localidad =$f_beneficiario['Localidades'];
	  $telefono=$f_beneficiario['telefono'];
	  $email=$f_beneficiario['email'];
 
	    $pdf->SetFont('Arial','B',7);
		$pdf->SetY($i=$i+7);
		$pdf->SetX(15);
		$pdf->Cell(0,5,$n,0,0,'L',1);
		$pdf->SetY($i);
		$pdf->SetX(25);
		$pdf->Cell(0,5,$cuitl,0,0,'L',1);
		$pdf->SetY($i);
		$pdf->SetX(45);
		$pdf->Cell(0,5,$denominacion,0,0,'L',1);
		$pdf->SetY($i);
		$pdf->SetX(100);
		$pdf->Cell(0,5,$domicilio,0,0,'L',1);
		$pdf->SetY($i);
		$pdf->SetX(150);
		$pdf->Cell(0,5,$localidad,0,0,'L',1);
		$pdf->SetY($i);
		$pdf->SetX(200);
		$pdf->Cell(0,5,$telefono,0,0,'L',1);
		$pdf->SetY($i);
		$pdf->SetX(230);
		$pdf->Cell(0,5,$email,0,0,'L',1);
        $t=$t+1;
	
	if($t==21)
	  {
	  
		//Select Arial italic 8
		$pdf->SetY($i=$i+5);
		$pdf->SetFont('Arial','I',8);
		 //Print current and total page numbers
		$pdf->Cell(0,10,'Pagina '.$pdf->PageNo().'/{nb}',0,0,'C');
	  }		

	} 
 
$pdf->SetY(-15);
//Select Arial italic 8
$pdf->SetFont('Arial','I',8);
 //Print current and total page numbers
$pdf->Cell(0,10,'Pagina '.$pdf->PageNo().'/{nb}',0,0,'C');
$pdf->AliasNbPages();


//////// fin Formacion ACademica
$pdf->Output();
