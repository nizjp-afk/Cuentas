<?php
error_reporting ( E_ERROR );
    include('../conexion/mysql-var_sigcom.php');
    include('../conexion/mysql_connect.php');  
    include('../conexion/mysql_select_db.php');
    include('../conexion/extras.php');
	
    
    $cuitl = $_GET['cuitl'];
    $ssql = "SELECT * FROM `beneficiarios` WHERE cuitl='$cuitl'";
     if (!($r_beneficiario= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar provincia";
      echo $cuerpo1;
      //.....................................................................
    }    
	 $f_beneficiario= mysql_fetch_array ($r_beneficiario);

	 $ssql = "SELECT * FROM `provincias` WHERE codprovincia='$direccion_provincia'";
     if (!($r_provincia= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar provincia";
      echo $cuerpo1;
      //.....................................................................
    }    
	
	$ssql = "SELECT * FROM `departamentos` WHERE cod_dpto='$direccion_dpto'";
     if (!($r_departamento= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar provincia";
      echo $cuerpo1;
      //.....................................................................
    }  
	
	$ssql = "SELECT * FROM `localidades` WHERE id_localidades='$direccion_localidad'";
     if (!($r_localidad= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar provincia";
      echo $cuerpo1;
      //.....................................................................
    }  
	
	$ssql = "SELECT * FROM tipo_documento WHERE  id_tipo='$documento_tipo'";
     if (!($r_documento= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo documento";
      echo $cuerpo1;
      //.....................................................................
    }        

   $ssql = "SELECT * FROM bancos where id_banco='$banco_nombre'";
     if (!($r_banco= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar banco";
      echo $cuerpo1;
      //.....................................................................
    }        
	
	$ssql = "SELECT * FROM bancos_cuentas where id_ban_cta='$banco_cta_tipo'";
     if (!($r_bcocta= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de cuenta";
      echo $cuerpo1;
      //.....................................................................
    }        


    $ssql = "SELECT * FROM sociedades where id_sociedad='$sociedad_tipo'";
     if (!($r_sociedad= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar sociedad";
      echo $cuerpo1;
      //.....................................................................
    }        


     $ssql = "SELECT * FROM iva where id_iva='$iva_situacion'";
     if (!($r_iva= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de cuenta";
      echo $cuerpo1;
      //.....................................................................
    } 
  $cuitl = $f_beneficiario['cuitl'];
  $apellido= $f_beneficiario['apellido'];
  $nombre = $f_beneficiario['nombre'];   


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
$ma=30;
$y_axis_initial = 25;

// imprime el titulo de la pagina
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',11);
$pdf->SetY($y_axis_initial);
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',6);
$pdf->Image('../img/escudo.jpg',40,8,8);
$pdf->SetFont('Arial','B',4);
$pdf->Cell(0,6,'TESORERIA GENERAL DE LA PROVINCIA',0,'B','L',0);
$pdf->setY(18);
$pdf->Cell(0,6,'CONTADURIA GENERAL DE LA PROVINCIA',0,'B','L',0);

/////////FECHA///////

$pdf->SetFont('Arial','B',6);
//$pdf->setX(150);
// (ancho,alto,texto,borde 0(sin borde):1(con borde),L: izquierda T: superior R: derecha B: inferior,alineacion (L,C,R),
//$pdf->cell(0,0,'FECHA: '.$dia,0,'B','R',0);
// (ancho,alto,texto,borde 0(sin borde):1(con borde),L: izquierda T: superior R: derecha B: inferior,alineacion (L,C,R),

////ENCABEZADO

$pdf->SetFont('Arial','B',7);
$pdf->setY(25);
$pdf->cell(0,0,'FORMULARIO DE AUTORIZACION DE PAGO EN CUENTA BANCARIA',0,'B','C',0);

////////////
$y_axis_initial = 35;
/////////////
$pdf->SetFont('Arial','B',7);
$i=35;
$ma=30;
$pdf->SetY($i);
$pdf->Cell(0,5,'Localidad y fecha:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(55);
$pdf->Cell(8,5,'LA RIOJA,     23 DE JUNIO DE 2008',0,0,'L',1);
$pdf->SetY($i+5);
$pdf->Cell(20,5,'SEÑOR',0,0,'L',1);
$pdf->SetY($i+5);
$pdf->Cell(0,5,'TESORERO GENERAL DE LA PROVINCIA',0,0,'L',1);
$pdf->SetY($i=$i+15);
$pdf->Cell(0,5,'El (los) que suscribe(n), ',0,0,'J',1);
$pdf->SetY($i);
$pdf->SetX(180);
$pdf->Cell(0,7,'en mi ',0,0,'J',1);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell(0,5,':',0,0,'J',1);
$pdf->SetY($i);
$pdf->SetX(40);
$pdf->Cell(0,5,'direccion',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(170);
$pdf->Cell(0,5,'Nº:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(175);
$pdf->Cell(0,5,'numero',0,0,'L',1);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell(0,5,'PISO:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(35);
$pdf->Cell(0,5,'piso',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(50);
$pdf->Cell(0,5,'DPTO Nº:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(65);
$pdf->Cell(0,5,'numero',0,0,'L',1);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell(0,5,'PROVINCIA:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(45);
$pdf->Cell(0,5,'provincia',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(90);
$pdf->Cell(0,5,'LOCALIDAD:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(110);
$pdf->Cell(0,5,'localidad',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(160);
$pdf->Cell(0,5,'CODIGO POSTAL:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(185);
$pdf->Cell(0,5,'codigo',0,0,'L',1);
$pdf->SetY($i=$i+7);
$pdf->SetX(15);
$pdf->Cell(0,5,'OTROS DATOS',1,0,'L',1);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell(0,5,'TELEFONO:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(40);
$pdf->Cell(0,5,'telefono',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(90);
$pdf->Cell(0,5,'DIRECCION E-MAIL:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(120);
$pdf->Cell(0,5,'email@email',0,0,'L',1);
$pdf->SetY($i=$i+7);
$pdf->SetX(15);
$pdf->Cell(0,5,'DATOS ECONOMICOS',1,0,'L',1);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell(0,5,'ACTIVIDAD PRINCIPAL:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(60);
$pdf->Cell(0,5,'actividad',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(130);
$pdf->Cell(0,5,'CODIGO:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(145);
$pdf->Cell(0,5,'codigo',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(160);
$pdf->Cell(0,5,'FECHA DE INICIO:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(185);
$pdf->Cell(0,5,'fecha',0,0,'L',1);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell(0,5,'ACTIVIDAD SECUNDARIA:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(60);
$pdf->Cell(0,5,'actividad',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(130);
$pdf->Cell(0,5,'CODIGO:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(145);
$pdf->Cell(0,5,'codigo',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(160);
$pdf->Cell(0,5,'FECHA DE INICIO:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(185);
$pdf->Cell(0,5,'fecha',0,0,'L',1);
$pdf->SetY($i=$i+7);
$pdf->SetX(15);
$pdf->Cell(0,5,'DATOS COMERCIALES',1,0,'L',1);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell(0,5,'FECHA CONTRATO SOCIAL:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(60);
$pdf->Cell(0,5,'fecha',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(90);
$pdf->Cell(0,5,'TIPO DE SOCIEDAD:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(120);
$pdf->Cell(0,5,'sociedad',0,0,'L',1);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell(0,5,'SITUACION FRENTE AL IVA:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(60);
$pdf->Cell(0,5,'iva',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(100);
$pdf->Cell(0,5,'Nº DE INGRESO BRUTO:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(140);
$pdf->Cell(0,5,'numero ingreso brutos',0,0,'L',1);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell(0,5,'TIPO DE CONVENIO:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(60);
$pdf->Cell(0,5,'convenio',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(100);
$pdf->Cell(0,5,'Nº DE CONVENIO:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(140);
$pdf->Cell(0,5,'numero ',0,0,'L',1);
$pdf->SetY($i=$i+7);
$pdf->SetX(15);
$pdf->Cell(0,5,'DATOS CUENTA BANCARIA ',1,0,'L',1);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell(0,5,'BANCO:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(40);
$pdf->Cell(0,5,'nombre',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(90);
$pdf->Cell(0,5,'SUCURSAL:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(120);
$pdf->Cell(0,5,'nombre',0,0,'L',1);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell(0,5,'TIPO DE CUENTA:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(60);
$pdf->Cell(0,5,'cta',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(90);
$pdf->Cell(0,5,'Nº DE CUENTA:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(110);
$pdf->Cell(0,5,'numero',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(155);
$pdf->Cell(0,5,'Nº DE CBU:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(170);
$pdf->Cell(0,5,'numero',0,0,'L',1);
$pdf->SetY($i=$i+7);
$pdf->SetX(15);
$pdf->Cell(0,5,'COMPONENTES DE LA SOCIEDAD O AUTORIDADES EN EJERCICIO ',1,0,'L',1);
$pdf->SetY($i=$i+8);
$pdf->SetX(25);
$pdf->Cell(0,5,'APELLIDO Y NOMBRE',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(130);
$pdf->Cell(0,5,'DNI',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(160);
$pdf->Cell(0,5,'CARGO',1,0,'L',1);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(0,5,'apellido y nombre',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(130);
$pdf->Cell(0,5,'numero',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(160);
$pdf->Cell(0,5,'nombre',1,0,'L',1);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(0,5,'apellido y nombre',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(130);
$pdf->Cell(0,5,'numero',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(160);
$pdf->Cell(0,5,'nombre',1,0,'L',1);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(0,5,'apellido y nombre',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(130);
$pdf->Cell(0,5,'numero',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(160);
$pdf->Cell(0,5,'nombre',1,0,'L',1);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(0,5,'apellido y nombre',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(130);
$pdf->Cell(0,5,'numero',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(160);
$pdf->Cell(0,5,'nombre',1,0,'L',1);
        
$pdf->SetY($i=$i+20);
$pdf->MultiCell(185,4,'El presente formulario reviste el caracter de declaracion jurada, la documentacion requerida debera ser presentada dentro de las 5 (cinco) dias habiles ...............- ',0,1,'J',1);
        
$pdf->SetY($i=$i+20);
$pdf->Cell(185,4,'Firma Beneficiario',0,0,'R',1);




$y_axis = $y_axis + $row_height;

//initialize counter
$i = 0;
//Set maximum rows per page
$max = 45;
$y_axis=72;
//Set Row Height
$row_height = 6;
   
///////////////////
$pdf->SetY(-15);
//Select Arial italic 8
$pdf->SetFont('Arial','I',8);
 //Print current and total page numbers
$pdf->Cell(0,10,'Pagina '.$pdf->PageNo().'/{nb}',0,0,'C');

$pdf->AliasNbPages();
$pdf->Output();
?> 
