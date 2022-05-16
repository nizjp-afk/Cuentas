<?php

error_reporting ( E_ERROR ); 
    include('../dgti-mysql-var_dgti-beneficiarios.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');
 $aplicacion = $_GET['apli'];
  $permisosnecesarios = $_GET['per'];

    include('../incluir_siempre.php');

    //include('conexion/extras.php');
    
	/*
	
	 include('../dgti-mysql-var_dgti-beneficiarios.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');
	*/
	
    $cuitl = $_GET['cuitl'];
	$id = $_GET['id'];
	//$tipo = $_GET['tipo'];
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
   $f_s=split("-",$f_beneficiario['fecha_aprobacion']);
$f_a=$f_s[2].'-'.$f_s[1].'-'.$f_s[0];
  $razon_social = $f_beneficiario['razon_social'];  
  $ape = $f_beneficiario['apellido'];  
  $nom = $f_beneficiario['nombre'];  
  $esidif = $f_beneficiario['codigo_esidif'];  
  
  $tipo = $f_beneficiario['persona_tipo'];  
   
  
  $inhi=$f_beneficiario['inhi'];
 
 if($inhi=='Inhibido'){$situacion='INHIBIDO';}
 if($inhi=='Otro'){$situacion='INHIBIDO';}
 if($inhi==''){$situacion='HABILITADO';}
 
 if($inhi=='Cta Cerrada'){$situacion='CUENTA CERRADA';}
 if($inhi=='Notificado'){$situacion='NOTIFICADO';}
 
   $motivo = $f_beneficiario['motivo'];
   
 
  		
	
	

	
//////////////fin de consulta en base///////////

   $f=strftime("%Y-%m-%d");
   $dia = date("d/m/Y");
   $hora =date("h:i");
         
//echo "paso";exit; 		
define('FPDF_FONTPATH','font/');
require('../fpdf.php');

//Connect to your database
//Create new pdf file
$pdf=new FPDF('P','mm','A4');
//Open file
$pdf->Open();
//Primera página
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->SetFillColor(256,256,256);
$pdf->Cell(40,20);
//$pdf->Write(5,'A continuación mostramos una imagen ');
$pdf->Image('../img/limp.jpg' , 5 ,5, 200 , 180,'JPG');
$pdf->SetFont('Arial','',10);
$pdf->setY(10);
//$pdf->cell(0,0,'Fecha de Emision: '.$dia,0,'B','R',0);
$i=75;
$j=12;
$pdf->SetY($i-8);


$pdf->cell(0,0,'Fecha de Emision: '.$dia,0,'B','R',0);
$pdf->SetY($i);

$pdf->SetX(25);
$pdf->Cell(1,5,'Nº E-SIDIF:',0,0,'L',1);
$pdf->SetX(50);
$pdf->Cell(0,5,$esidif,0,0,'L');


$pdf->SetY($i=$i+$j);
$pdf->SetX(25);
$pdf->Cell(1,5,'CUIT /CUIL: ',0,0,'L',1);
$pdf->SetX(50);
$pdf->Cell(0,5,$cuitl,0,0,'L');

if ($tipo=='j')
{
$pdf->SetY($i=$i+$j);
$pdf->SetX(25);
$pdf->Cell(1,5,'RAZON SOCIAL:',0,0,'L',1);
$pdf->SetX(60);
$pdf->Cell(0,5,$razon_social,0,0,'L');

}

else
{
$pdf->SetY($i=$i+$j);
$pdf->SetX(25);
$pdf->Cell(1,5,'APELLIDO:',0,0,'L',1);
$pdf->SetX(60);
$pdf->Cell(0,5,$ape,0,0,'L');
$pdf->SetY($i=$i+$j);
$pdf->SetX(25);
$pdf->Cell(1,5,'NOMBRE:',0,0,'L',1);
$pdf->SetX(60);
$pdf->Cell(0,5,$nom,0,0,'L');

}
$pdf->SetY($i=$i+$j);
$pdf->SetX(25);
$pdf->Cell(1,5,'FECHA DE INSCRIPCION:',0,0,'L',1);
$pdf->SetX(75);
$pdf->Cell(0,5,$f_a,0,0,'L');

$pdf->SetY($i=$i+$j);
$pdf->SetX(25);
$pdf->Cell(1,5,'SITUACION:',0,0,'L',1);
$pdf->SetX(55);
$pdf->Cell(0,5,$situacion,0,0,'L');

$pdf->SetY($i=$i+$j);
$pdf->SetX(25);
$pdf->Cell(1,5,'OBSERVACIONES:',0,0,'L',1);
$pdf->SetX(75);
$pdf->Cell(0,5,$motivo,0,0,'L');



////tesoreria



$pdf->AliasNbPages();
//Launch the print dialog
//$pdf->AutoPrint(true);
$pdf->Output();
?> 
