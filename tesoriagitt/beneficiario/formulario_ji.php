<?php
error_reporting ( E_ERROR ); 
    include('../dgti-mysql-var_dgti-beneficiarios.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');
    //include('conexion/extras.php');
    
	/*
	
	 include('../dgti-mysql-var_dgti-beneficiarios.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');
	*/
	
    $cuitl = $_GET['cuitl'];
	$id = $_GET['id'];
    $ssql = "SELECT * FROM `beneficiarios_aprobados` WHERE cuitl='$cuitl' or id_beneficiario='$id'";
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
  $razon_social = $f_beneficiario['razon_social'];  
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
  $banco_denominacion=$f_beneficiario['banco_denominacion'];
   
  $ingreso_bruto=$f_beneficiario['ingreso_bruto'];
  $iva_situacion=$f_beneficiario['iva_situacion'];
 
 
   $ganancia = $f_beneficiario['ganancia'];
   $alicuota = $f_beneficiario['alicuota'];
   $ingreso = $f_beneficiario['ingreso'];
   $regimen = $f_beneficiario['regimen'];
   $seguridad = $f_beneficiario['seguridad'];
   $ingreso_bruto_ac=$f_beneficiario['ingreso_bruto_ac'];
 
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
    $observacion= $f_beneficiario['observacion'];

   $fecha_inicio1 = $f_beneficiario['fecha_inicio1'];    
   $fecha_inicio2 = $f_beneficiario['fecha_inicio2'];    
   $fecha_inicio3 = $f_beneficiario['fecha_inicio3'];    
   $fecha_inicio4 = $f_beneficiario['fecha_inicio4'];    
   
   $duracion1 = $f_beneficiario['duracion1'];    
   $duracion2 = $f_beneficiario['duracion2'];    
   $duracion3 = $f_beneficiario['duracion3'];    
   $duracion4 = $f_beneficiario['duracion4'];   
  	

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
	
	 $ssql = "SELECT * FROM `sociedades` where id_sociedad='$sociedad_tipo'";
     if (!($r_sociedad= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar sociedad";
      echo $cuerpo1;
      //.....................................................................
    }  
	
	$f_sociedad= mysql_fetch_array ($r_sociedad);
	$sociedad_tipo=$f_sociedad['nombre']; 
	
	
	
	$ssql = "SELECT * FROM ganancias where id_ganancia='$ganancia'  order by nombre";
     if (!($r_ganancia= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de iva";
      echo $cuerpo1;
      //.....................................................................
    }      
    $f_ganancia= mysql_fetch_array ($r_ganancia);
	$ganancia=$f_ganancia['nombre']; 	  

  $ssql = "SELECT * FROM ingreso_bruto  where id_ingreso='$ingreso' order by nombre ";
     if (!($r_ingreso= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de iva";
      echo $cuerpo1;
      //.....................................................................
    }  
	
	 $f_ingreso= mysql_fetch_array ($r_ingreso);
	 $ingreso=$f_ingreso['nombre']; 	  
	
	$ssql = "SELECT * FROM regimen where id_regimen='$regimen' order by nombre ";
     if (!($r_regimen= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de iva";
      echo $cuerpo1;
      //.....................................................................
    }   
	
	 $f_regimen= mysql_fetch_array ($r_regimen);
	 $regimen=$f_regimen['nombre']; 	  
	
	$ssql = "SELECT * FROM alicuota where id_alicuota='$alicuota'  order by nombre";
     if (!($r_alicuota= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de iva";
      echo $cuerpo1;
      //.....................................................................
    } 
	 $f_alicuota= mysql_fetch_array ($r_alicuota);
	$alicuota=$f_alicuota['nombre']; 	  
	
	$ssql = "SELECT * FROM seguridad_social where id_seguridad='$seguridad'  order by nombre ";
     if (!($r_seguridad= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de iva";
      echo $cuerpo1;
      //.....................................................................
    }          
     $f_seguridad= mysql_fetch_array ($r_seguridad);
	 $seguridad=$f_seguridad['nombre']; 	  

	
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
$pdf->SetFont('Arial','',7);
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
$pdf->SetFont('Arial','',7);
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
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell(0,7,'NUMERO DE CUENTA',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(100);
$pdf->Cell(0,7,$banco_cta_nro,1,0,'L',1);
$pdf->SetY($i=$i+7);
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


///// f2


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
$pdf->cell(0,0,'FORMULARIO DE REQUERIMIENTO ',0,'B','C',0);
$pdf->setY(48);
$pdf->cell(0,0,'DE CLAVE PERSONAL - CONSULTAS DE PAGOS ON LINE',0,'B','C',0);
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
$pdf->SetFont('Arial','',9);
$pdf->MultiCell(0,7,' 
El (los) que suscribe(n)…………………………………………………………………………………………………………en
mi carácter de……………………………………………………………………………………………………………………
Solicita tenga a bien otorgar “CLAVE PERSONAL” para acceder al servicio de consultas “ON LINE” en el Sistema de Beneficiarios. Asimismo, asumo el compromiso de una vez recibida la clave de acceso por UNICA VEZ proceder al cambio de la misma dentro de las 24 horas de concluido el presente tramite, haciéndome responsable de la utilización de la misma.


   ',0,'T','J',1);

   $pdf->SetFont('Arial','',10);
$pdf->SetY($i=$i+75);
$pdf->SetX(25);
$pdf->Cell(0,10,'DATOS  ',1,0,'L',1);
$pdf->SetFont('Arial','',12);
$pdf->SetY($i=$i+8);
$pdf->SetX(25);
$pdf->Cell(0,15,'APELLIDO Y NOMBRE',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(100);
$pdf->Cell(0,15,'',1,0,'L',1);
$pdf->SetY($i=$i+15);
$pdf->SetX(25);
$pdf->Cell(0,15,'DNI',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(100);
$pdf->Cell(0,15,'',1,0,'L',1);
$pdf->SetY($i=$i+15);
$pdf->SetX(25);
$pdf->Cell(0,15,'CUIT',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(100);
$pdf->Cell(0,15,'',1,0,'L',1);
$pdf->SetY($i=$i+15);
$pdf->SetX(25);
//$pdf->SetY($i=$i+35);
//$pdf->Cell(0,5,'Desde ya queda Ud. debidamente notificado.',0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+50);
$pdf->SetX(25);
$pdf->SetY($i);
$pdf->Cell(50,3,'-----------------------------------------------',0,0,'R',1);
$pdf->SetY($i);
$pdf->SetX(130);
$pdf->Cell(50,3,'-----------------------------------------------',0,0,'R',1);
$pdf->SetY($i=$i+5);
$pdf->SetX(35);
$pdf->Cell(50,3,'Firma ',0,0,'L',1);
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
$pdf->Cell(0,10,'Pagina '.$pdf->PageNo().'/{nb}',0,0,'C');


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
$pdf->cell(0,0,'FORMULARIO DE REQUERIMIENTO ',0,'B','C',0);
$pdf->setY(48);
$pdf->cell(0,0,'DE CLAVE PERSONAL - CONSULTAS DE PAGOS ON LINE',0,'B','C',0);
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
$pdf->SetFont('Arial','',9);
$pdf->MultiCell(0,7,' 
El (los) que suscribe(n)…………………………………………………………………………………………………………en
mi carácter de……………………………………………………………………………………………………………………
Solicita tenga a bien otorgar “CLAVE PERSONAL” para acceder al servicio de consultas “ON LINE” en el Sistema de Beneficiarios. Asimismo, asumo el compromiso de una vez recibida la clave de acceso por UNICA VEZ proceder al cambio de la misma dentro de las 24 horas de concluido el presente tramite, haciéndome responsable de la utilización de la misma.


   ',0,'T','J',1);

   $pdf->SetFont('Arial','',10);
$pdf->SetY($i=$i+75);
$pdf->SetX(25);
$pdf->Cell(0,10,'DATOS  ',1,0,'L',1);
$pdf->SetFont('Arial','',12);
$pdf->SetY($i=$i+8);
$pdf->SetX(25);
$pdf->Cell(0,15,'APELLIDO Y NOMBRE',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(100);
$pdf->Cell(0,15,'',1,0,'L',1);
$pdf->SetY($i=$i+15);
$pdf->SetX(25);
$pdf->Cell(0,15,'DNI',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(100);
$pdf->Cell(0,15,'',1,0,'L',1);
$pdf->SetY($i=$i+15);
$pdf->SetX(25);
$pdf->Cell(0,15,'CUIT',1,0,'L',1);
$pdf->SetY($i);
$pdf->SetX(100);
$pdf->Cell(0,15,'',1,0,'L',1);
$pdf->SetY($i=$i+15);
$pdf->SetX(25);
//$pdf->SetY($i=$i+35);
//$pdf->Cell(0,5,'Desde ya queda Ud. debidamente notificado.',0,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+50);
$pdf->SetX(25);
$pdf->SetY($i);
$pdf->Cell(50,3,'-----------------------------------------------',0,0,'R',1);
$pdf->SetY($i);
$pdf->SetX(130);
$pdf->Cell(50,3,'-----------------------------------------------',0,0,'R',1);
$pdf->SetY($i=$i+5);
$pdf->SetX(35);
$pdf->Cell(50,3,'Firma ',0,0,'L',1);
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
$pdf->Cell(0,10,'Pagina '.$pdf->PageNo().'/{nb}',0,0,'C');




$pdf->AliasNbPages();
//Launch the print dialog
//$pdf->AutoPrint(true);
$pdf->Output();
?> 
