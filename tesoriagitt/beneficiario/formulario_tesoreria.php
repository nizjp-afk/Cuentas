<?php
error_reporting ( E_ERROR );
    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
	
    
    $cuitl = $_GET['cuitl'];
    $ssql = "SELECT * FROM `beneficiarios`,tipo_documento WHERE cuitl='$cuitl'";
     if (!($r_beneficiario= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar beneficiario";
      echo $cuerpo1;
      //.....................................................................
    }    
	 $f_beneficiario= mysql_fetch_array ($r_beneficiario);

	
  $cuitl = $f_beneficiario['cuitl'];
  $apellido= $f_beneficiario['apellido'];
  $nombre = $f_beneficiario['nombre'];
  $documento_tipo =$f_beneficiario['documento_tipo'];
  $documento_nro =$f_beneficiario['documento_nro'];
  $fecha_nacimiento=$f_beneficiario['fecha_nacimiento'];
  $fecha=split("-",$fecha_nacimiento);
  $fecha_nacimiento=$fecha[2].'-'.$fecha[1].'-'.$fecha[0]; 
  $direccion_f_calle=$f_beneficiario['direccion_f_calle'];
  $direccion_f_nro=$f_beneficiario['direccion_f_nro'];
  $direccion_f_piso=$f_beneficiario['direccion_f_piso'];
  $direccion_f_dpto_nro=$f_beneficiario['direccion_f_dpto_nro'];
  $direccion_f_localidad=$f_beneficiario['direccion_f_localidad'];
  $direccion_f_provincia=$f_beneficiario['direccion_f_provincia'];
  $codigo_f_postal=$f_beneficiario['codigo_f_postal'];
  $direccion_r_calle=$f_beneficiario['direccion_r_calle'];
  $direccion_r_nro=$f_beneficiario['direccion_r_nro'];
  $direccion_r_piso=$f_beneficiario['direccion_r_piso'];
  $direccion_r_dpto_nro=$f_beneficiario['direccion_r_dpto_nro'];
  $direccion_r_provincia=$f_beneficiario['direccion_r_provincia'];
  $direccion_r_localidad=$f_beneficiario['direccion_r_localidad'];
  $codigo_r_postal=$f_beneficiario['codigo_r_postal'];
  $telefono=$f_beneficiario['telefono'];
  $email=$f_beneficiario['email'];
  $banco_nombre=$f_beneficiario['banco_nombre'];
  $banco_sucursal=$f_beneficiario['banco_sucursal'];
  $banco_cta_tipo=$f_beneficiario['banco_cta_tipo'];
  $banco_cta_nro=$f_beneficiario['banco_cta_nro'];
  $cbu=$f_beneficiario['cbu'];
  $ingreso_bruto=$f_beneficiario['ingreso_bruto'];
  $iva_situacion=$f_beneficiario['iva_situacion'];
  $actividad_p=$f_beneficiario['actividad_p'];
  $fecha_p=$f_beneficiario['fecha_p'];
  $actividad_s=$f_beneficiario['actividad_s'];
  $fecha_s=$f_beneficiario['fecha_s'];

    
	$ssql = "SELECT * FROM tipo_documento WHERE  id_tipo='$documento_tipo'";
     if (!($r_documento= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo documento";
      echo $cuerpo1;
      //.....................................................................
    }   
// tipo de documento
    $f_documento= mysql_fetch_array ($r_documento);
	$documento_tipo=$f_documento['descripcion']; 	

//provincia

 $ssql = "SELECT * FROM `provincias` WHERE codprovincia='$direccion_f_provincia'";
     if (!($r_provincia= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar provincia";
      echo $cuerpo1;
      //.....................................................................
    }    
	 $f_prov= mysql_fetch_array ($r_provincia);
	 $direccion_f_provincia=$f_prov['nombre']; 

//localidad
	
	$ssql = "SELECT * FROM `localidades` WHERE id_localidades='$direccion_f_localidad'";
     if (!($r_localidad= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar provincia";
      echo $cuerpo1;
      //.....................................................................
    }

    $f_localidad= mysql_fetch_array ($r_localidad);
	$direccion_f_localidad=$f_localidad['descripcion']; 	  

//provincia

 $ssql = "SELECT * FROM `provincias` WHERE codprovincia='$direccion_r_provincia'";
     if (!($r_provincia= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar provincia";
      echo $cuerpo1;
      //.....................................................................
    }    
	 $f_prov= mysql_fetch_array ($r_provincia);
	 $direccion_r_provincia=$f_prov['nombre']; 

//localidad
	
	$ssql = "SELECT * FROM `localidades` WHERE id_localidades='$direccion_r_localidad'";
     if (!($r_localidad= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar provincia";
      echo $cuerpo1;
      //.....................................................................
    }

    $f_localidad= mysql_fetch_array ($r_localidad);
	$direccion_r_localidad=$f_localidad['descripcion']; 	  


//banco

   $ssql = "SELECT * FROM bancos where id_banco='$banco_nombre'";
     if (!($r_banco= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar banco";
      echo $cuerpo1;
      //.....................................................................
    }  
	
	 $f_banco= mysql_fetch_array ($r_banco);
	$banco_nombre=$f_banco['nombre']; 	        
	
//tipo cta

	$ssql = "SELECT * FROM bancos_cuentas where id_ban_cta='$banco_cta_tipo'";
     if (!($r_bcocta= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de cuenta";
      echo $cuerpo1;
      //.....................................................................
    }        

    $f_bcocta= mysql_fetch_array ($r_bcocta);
	$banco_cta_tipo=$f_bcocta['nombre']; 
	
//iva  
	
     $ssql = "SELECT * FROM iva where id_iva='$iva_situacion'";
     if (!($r_iva= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de cuenta";
      echo $cuerpo1;
      //.....................................................................
    } 
	
	$f_iva= mysql_fetch_array ($r_iva);
	$iva_situacion=$f_iva['nombre']; 
	
	
//actividad

 $ssql = "SELECT * FROM `actividad` where id_actividad='$actividad_p'";
     if (!($r_actividad_p= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar actividad";
      echo $cuerpo1;
      //.....................................................................
    }  
	
	$f_actividad_p= mysql_fetch_array ($r_actividad_p);
	$actividad_p_n=$f_actividad_p['nombre_actividad']; 
	
	 $ssql = "SELECT * FROM `actividad` where id_actividad='$actividad_s'";
     if (!($r_actividad_s= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar actividad";
      echo $cuerpo1;
      //.....................................................................
    }  
	
	$f_actividad_s= mysql_fetch_array ($r_actividad_s);
	$actividad_s_n=$f_actividad_s['nombre_actividad']; 
	
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
$pdf->Cell(0,5,'SEÑOR',1,0,'L',0);
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell(9,5,'TESORERO GENERAL DE LA PROVINCIA: ',0,0,'L',1);
$pdf->SetY($i=$i+20);
$pdf->SetFont('Arial','',8);
$pdf->MultiCell(0,4,' 
  El (los) que suscribe(n) .................................................................................................................... en mi (nuestro) carácter de ........................de ...............................................CUIT.-CUIL- Nº '$cuitl', con domicilio legal en la calle '$direccion_f_calle' Nº autoriza(mos) a que todo pago que deba realizar la TESORERIA GENERAL DE LA PROVINCIA, en cancelacion de deudas a mi (nuestro) favor por cualquier concepto 
   ',0,'T','J',1);
$pdf->SetY($i=$i+50);
$pdf->SetX(25);
//$pdf->Cell(50,3,'--------------------------------------------------------',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(130);
$pdf->Cell(50,3,'-----------------------------------------------',0,0,'R',1);
$pdf->SetY($i=$i+3);
$pdf->SetX(35);
//$pdf->Cell(50,3,'Firma y Sello de Recepcion',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(140);
$pdf->Cell(50,3,'Firma de Beneficiario',0,0,'L',1);
$pdf->SetY($i=$i+15);
$pdf->SetX(130);
$pdf->Cell(50,3,'-----------------------------------------------',0,0,'R',1);
$pdf->SetY($i=$i+3);
$pdf->SetX(148);
$pdf->Cell(50,3,'Aclaracion',0,0,'L',1);

$pdf->SetY(-15);
//Select Arial italic 8
$pdf->SetFont('Arial','I',10);
 //Print current and total page numbers
$pdf->Cell(0,10,'Original',0,0,'C');

////duplicado

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
$pdf->cell(0,0,'FORMULARIO DE ALTA Y MODIFICACION DE DATOS DE BENEFICIARIOS ',0,'B','C',0);
$pdf->setY(48);
$pdf->cell(0,0,'EN EL SISTEMA PROVINCIAL DE ADMINISTRACION FINANCIERA',0,'B','C',0);

////////////
$y_axis_initial = 58;
/////////////
$pdf->SetFont('Arial','IB',8);
$i=58;
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
$pdf->Cell(0,5,'APELLIDO Y NOMBRE:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(110);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(0,5,$apellido.', '.$nombre,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell(15,5,'TIPO DE DOCUMENTO: ',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(55);
$pdf->Cell(20,5,$documento_tipo,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i);
$pdf->SetX(80);
$pdf->Cell(5,5,'Nº:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(87);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(15,5,$documento_nro,0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(110);
$pdf->SetFont('Arial','',7);
$pdf->Cell(100,5,'FECHA NACIMIENTO:',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(141);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(15,5,$fecha_nacimiento,0,0,'L',1);
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
$pdf->SetY($i=$i+7);
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
$pdf->SetY($i=$i+7);
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
$pdf->SetY($i=$i+7);
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
$pdf->SetY($i=$i+7);
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
$pdf->SetY($i);
$pdf->SetX(117);
$pdf->Cell(10,5,'CODIGO:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(130);
$pdf->Cell(0,5,$actividad_p,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i);
$pdf->SetX(143);
$pdf->Cell(10,5,'FECHA DE INICIO:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(168);
$pdf->Cell(0,5,$fecha_p,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell(0,5,'ACTIVIDAD SECUNDARIA:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(59);
$pdf->Cell(0,5,$actividad_s_n,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i);
$pdf->SetX(117);
$pdf->Cell(0,5,'CODIGO:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(130);
$pdf->Cell(0,5,$actividad_s,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i);
$pdf->SetX(143);
$pdf->Cell(0,5,'FECHA DE INICIO:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(168);
$pdf->Cell(0,5,$fecha_s,0,0,'L',1);
$pdf->SetFont('Arial','IB',8);
$pdf->SetY($i=$i+7);
$pdf->SetFillColor(215,215,215); 
$pdf->Cell(0,5,'DATOS COMERCIALES',1,0,'L',1);

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell(0,5,'SITUACION FRENTE AL IVA:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(71);
$pdf->Cell(0,5,$iva_situacion,0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i);
$pdf->SetX(100);
$pdf->Cell(0,5,'Nº DE INGRESO BRUTO:',0,0,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($i);
$pdf->SetX(140);
$pdf->Cell(0,5,$ingreso_bruto,0,0,'L',1);
$pdf->SetFont('Arial','IB',8);
$pdf->SetY($i=$i+7);
$pdf->SetFillColor(215,215,215); 

$pdf->SetFillColor(256,256,256);

$pdf->SetY($i=$i+20);
$pdf->SetFont('Arial','',8);
$pdf->MultiCell(0,4,' 
 El que suscribe .................................................................................................................... en su carácter de ........................
 
  .............................................. afirma que los datos declarados son correctos y completos y que no se ha omitido dato
  
alguno.
 ',0,'T','J',1);
$pdf->SetY($i=$i+50);
$pdf->SetX(25);
//$pdf->Cell(50,3,'--------------------------------------------------------',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(130);
$pdf->Cell(50,3,'-----------------------------------------------',0,0,'R',1);
$pdf->SetY($i=$i+3);
$pdf->SetX(35);
//$pdf->Cell(50,3,'Firma y Sello de Recepcion',0,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(140);
$pdf->Cell(50,3,'Firma de Beneficiario',0,0,'L',1);
$pdf->SetY($i=$i+15);
$pdf->SetX(130);
$pdf->Cell(50,3,'-----------------------------------------------',0,0,'R',1);
$pdf->SetY($i=$i+3);
$pdf->SetX(148);
$pdf->Cell(50,3,'Aclaracion',0,0,'L',1);

$pdf->SetY(-15);
//Select Arial italic 8
$pdf->SetFont('Arial','I',10);
 //Print current and total page numbers
$pdf->Cell(0,10,'Duplicado',0,0,'C');

$pdf->AliasNbPages();
//Launch the print dialog
//$pdf->AutoPrint(true);
$pdf->Output();
?> 
