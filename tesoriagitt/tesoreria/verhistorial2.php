<?php
error_reporting ( E_ERROR );  
    include('../dgti-mysql-var_dgti-beneficiarios.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');
/*
	include('../dgti-mysql-var_dgti-beneficiarios.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');
    //include('../conexion/extras.php');  	*/
	
    
    $cuitl=$_GET['id'];  
    
	$ssql = "SELECT * FROM `beneficiarios_historial` WHERE `cuitl`='$cuitl' order by id_beneficiario";
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
  $cant= mysql_num_rows($r_beneficiario);
  
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
$pdf->Image('../img/membrete1.jpg',20,5,0);
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
$pdf->setY(25);
$pdf->cell(0,0,'FECHA: '.$dia,0,'B','R',0);
// (ancho,alto,texto,borde 0(sin borde):1(con borde),L: izquierda T: superior R: derecha B: inferior,alineacion (L,C,R),

////ENCABEZADO

$pdf->SetFont('Arial','IB',7);
$pdf->setY(25);
$pdf->cell(0,0,'HISTORIAL',0,'B','C',0);

///primera fila

$bandera=0;
$banc=0;
while($f_beneficiario= mysql_fetch_array ($r_beneficiario))
   {
     if($bandera < 3)
	   {      
	   $banc=$banc+1; 
	  $cuitl = $f_beneficiario['cuitl'];
	  $apellido= $f_beneficiario['apellido'];
	  $nombre = $f_beneficiario['nombre'];
	  $razon_social = $f_beneficiario['razon_social'];  
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
  
  
	  $cbu1=$f_beneficiario['banco_cta_nro'];
	  $cbu2=$f_beneficiario['cbu_entidad'];
	  $cbu3=$f_beneficiario['cbu_sucursal'];
	  $cbu4=$f_beneficiario['verificador1'];
	  $cbu5=$f_beneficiario['cbu_tipo_cta'];
	  $cbu6=$f_beneficiario['cbu_cta'];
	  $cbu7=$f_beneficiario['verificador2'];
	
  	  //$cbu=$cbu2.''.$cbu3.''.$cbu4.''.$cbu5.''.$cbu6.''.$cbu7;
      $cbu=$f_beneficiario['cbu'];
      
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

////////////
$y_axis_initial = 40;
/////////////
$pdf->SetFont('Arial','IB',8);
$bandera=$bandera+1;
$i=40;
$j=5;
$x=40;
$xx=$x+25;
$xj=$x+$xx+25;
$xy=$xj+$xx;
$pdf->SetY($i);
$pdf->SetFillColor(215,215,215);
$pdf->Cell(236,5,'DATOS DE IDENTIFICACION',1,0,'L',1);
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell($x,$j,'CUIT /CUIL: ',1,0,'L',1);
if ($bandera==1)
  {
   $pdf->SetY($i);
   $pdf->SetX($xx);
   $pdf->Cell($xx,$j,$cuitl,1,0,'L',1);
  }
if ($bandera==2)
  {
   $pdf->SetY($i);
   $pdf->SetX($xj);
   $pdf->Cell($xx,$j,$cuitl,1,0,'L',1);
  } 
if ($bandera==3)
  {
   $pdf->SetY($i);
   $pdf->SetX($xy);
   $pdf->Cell($xx,$j,$cuitl,1,0,'L',1);
  }   
  
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'DENOMINACION:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$apellido.' '.$nombre.''.$razon_social,1,0,'L',1);
   }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$apellido.' '.$nombre.''.$razon_social,1,0,'L',1);
   }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$apellido.' '.$nombre.''.$razon_social,1,0,'L',1);
   }


$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'TIPO DE DOCUMENTO: ',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$documento_tipo,1,0,'L',1);
 }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$documento_tipo,1,0,'L',1);
 }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$documento_tipo,1,0,'L',1);
 }
 
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'Nº:',1,0,'L',1);

if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$documento_nro,1,0,'L',1);
  }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$documento_nro,1,0,'L',1);
  }
 if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$documento_nro,1,0,'L',1);
  }   
  
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,5,'FECHA NACIMIENTO:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$fecha_nacimiento,1,0,'L',1);
  }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$fecha_nacimiento,1,0,'L',1);
  }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$fecha_nacimiento,1,0,'L',1);
  }


$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'AREA:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$area,1,0,'L',1);
  }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$area,1,0,'L',1);
  }

if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$area,1,0,'L',1);
  }


$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'CARGO:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$cargo,1,0,'L',1);
  }

if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$cargo,1,0,'L',1);
  }

if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$cargo,1,0,'L',1);
  }
  

$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'FECHA INICIO DE GESTION:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$fecha_c,1,0,'L',1);
   }
   
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$fecha_c,1,0,'L',1);
   }
   
 if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$fecha_c,1,0,'L',1);
   }
        
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'SAF:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$saf,1,0,'L',1);
 }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$saf,1,0,'L',1);
 }

if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$saf,1,0,'L',1);
 }

 
$pdf->SetFillColor(215,215,215);
$pdf->SetFont('Arial','IB',8);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell(236,5,'DOMICILIO FISCAL',1,0,'L',1);
//datos domicilio fiscal ///

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell($x,$j,'CALLE:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$direccion_f_calle,1,0,'L',1);
  }

if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$direccion_f_calle,1,0,'L',1);
  }

if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$direccion_f_calle,1,0,'L',1);
  }

$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'Nº:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$direccion_f_nro,1,0,'L',1);
  }
  
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$direccion_f_nro,1,0,'L',1);
  }
  
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$direccion_f_nro,1,0,'L',1);
  }    
  
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'PISO:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$direccion_f_piso,1,0,'L',1);
}
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$direccion_f_piso,1,0,'L',1);
}
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$direccion_f_piso,1,0,'L',1);
}

$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'DPTO Nº:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$direccion_f_nro,1,0,'L',1);
   }
   
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$direccion_f_nro,1,0,'L',1);
   }
   
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$direccion_f_nro,1,0,'L',1);
   }
         
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'PROVINCIA:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$direccion_f_provincia,1,0,'L',1);
   }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$direccion_f_provincia,1,0,'L',1);
   }
 if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$direccion_f_provincia,1,0,'L',1);
   }
        
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'LOCALIDAD:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$direccion_f_localidad,1,0,'L',1);
   }

if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$direccion_f_localidad,1,0,'L',1);
   }

if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$direccion_f_localidad,1,0,'L',1);
   }


$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'CODIGO POSTAL:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$codigo_f_postal,1,0,'L',1);
  }
  
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$codigo_f_postal,1,0,'L',1);
  }
  
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$codigo_f_postal,1,0,'L',1);
  }    

$pdf->SetFillColor(215,215,215); 
$pdf->SetFont('Arial','IB',8);
$pdf->SetY($i=$i+7);
$pdf->SetFillColor(215,215,215); 
$pdf->Cell(236,5,'OTROS DATOS',1,0,'L',1);
$pdf->SetFillColor(256,256,256);

$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell($x,$j,'TELEFONO:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$telefono,1,0,'L',1);
   } 
   
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$telefono,1,0,'L',1);
   } 
   
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$telefono,1,0,'L',1);
   } 
         
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'DIRECCION E-MAIL:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$email,1,0,'L',1);
   }
   
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$email,1,0,'L',1);
   }
   
 if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$email,1,0,'L',1);
   }
        
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'OBSERVACION:',1,0,'L',1);
 if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$observacion,1,0,'L',1);
  }

 if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$observacion,1,0,'L',1);
  }
  
 if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$observacion,1,0,'L',1);
  }    
  
$pdf->SetFont('Arial','IB',8);
$pdf->SetY($i=$i+7);
$pdf->SetFillColor(215,215,215); 
$pdf->Cell(236,5,'DATOS ECONOMICOS',1,0,'L',1);
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell($x,$j,'ACTIVIDAD PRINCIPAL:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$actividad_p,1,0,'L',1);
   }

if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$actividad_p,1,0,'L',1);
   }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$actividad_p,1,0,'L',1);
   }
         
   
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'CODIGO:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$actividad_p_n,1,0,'L',1);
   }
   
 if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$actividad_p_n,1,0,'L',1);
   }
 
 if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$actividad_p_n,1,0,'L',1);
   }
   
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'FECHA DE INICIO:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$fecha_p,1,0,'L',1);
   }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$fecha_p,1,0,'L',1);
   }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$fecha_p,1,0,'L',1);
   }      
   
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'ACTIVIDAD SECUNDARIA:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$actividad_s,1,0,'L',1);
  }
  
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$actividad_s,1,0,'L',1);
  }
  
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$actividad_s,1,0,'L',1);
  }
      
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'CODIGO:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$actividad_s_n,1,0,'L',1);
  }

if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$actividad_s_n,1,0,'L',1);
  }
  
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$actividad_s_n,1,0,'L',1);
  }
    
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'FECHA DE INICIO:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$fecha_s,1,0,'L',1);
  }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$fecha_s,1,0,'L',1);
  }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$fecha_s,1,0,'L',1);
  }
}
}
$pdf->SetY($i=$i+10);
$pdf->SetFillColor(215,215,215); 
$pdf->SetY(-13);
//Select Arial italic 8
$pdf->SetFont('Arial','I',8);
 //Print current and total page numbers
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
$pdf->Image('../img/membrete1.jpg',20,5,0);
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
$pdf->setY(25);
$pdf->cell(0,0,'FECHA: '.$dia,0,'B','R',0);
// (ancho,alto,texto,borde 0(sin borde):1(con borde),L: izquierda T: superior R: derecha B: inferior,alineacion (L,C,R),

////ENCABEZADO

$pdf->SetFont('Arial','IB',7);
$pdf->setY(25);
$pdf->cell(0,0,'HISTORIAL',0,'B','C',0);

///primera fila

$bandera=0;
mysql_data_seek($r_beneficiario,0);
while($f_beneficiario= mysql_fetch_array ($r_beneficiario))
   {
     if($bandera < 3)
	   {       
	  $banco_nombre=$f_beneficiario['banco_nombre'];
	  $banco_sucursal=$f_beneficiario['banco_sucursal'];
	  $banco_cta_tipo=$f_beneficiario['banco_cta_tipo'];
	  $banco_cta_nro=$f_beneficiario['banco_cta_nro'];
	  
    $cbu1=$f_beneficiario['banco_cta_nro'];
	$cbu2=$f_beneficiario['cbu_entidad'];
	$cbu3=$f_beneficiario['cbu_sucursal'];
	$cbu4=$f_beneficiario['verificador1'];
	$cbu5=$f_beneficiario['cbu_tipo_cta'];
	$cbu6=$f_beneficiario['cbu_cta'];
	$cbu7=$f_beneficiario['verificador2'];
	
 // $cbu=$cbu1.''.$cbu2.''.$cbu3.''.$cbu4.''.$cbu5.''.$cbu6.''.$cbu7;
    $cbu=$f_beneficiario['cbu'];
	  $ingreso_bruto=$f_beneficiario['ingreso_bruto'];
	  $actividad_p=$f_beneficiario['actividad_p'];
      $sociedad_tipo = $f_beneficiario['sociedad_tipo'];
	  
	  
	  $iva_situacion = $f_beneficiario['iva_situacion'];
	  $ganancia = $f_beneficiario['ganancia'];
	  $ganancia = $f_beneficiario['ingreso'];
	  $ganancia = $f_beneficiario['seguridad']; 
	  $ganancia = $f_beneficiario['regimen'];
	  $ingreso_bruto_ac = $f_beneficiario['ingreso_bruto_ac'];
	  
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
	   $fecha1 = $f_beneficiario['fecha_inicio1'];
	   $fecha2 = $f_beneficiario['fecha_inicio2'];
	   $fecha3 = $f_beneficiario['fecha_inicio3'];
	   $fecha4 = $f_beneficiario['fecha_inicio4'];
	   $fin1 = $f_beneficiario['duracion1'];
	   $fin2 = $f_beneficiario['duracion2'];
	   $fin3 = $f_beneficiario['duracion3'];
	   $fin4 = $f_beneficiario['duracion4'];
	   $usuario_alta=$f_beneficiario['usuario_alta'];
	   $usuario_aprobo=$f_beneficiario['usuario_aprobo'];
	   $fecha_aprobacion=$f_beneficiario['fecha_aprobacion'];
	   $usuario_modifico=$f_beneficiario['usuario_modifico'];
	   $fecha_modi=$f_beneficiario['fecha_modi'];
	   $fecha_alta_new = $f_beneficiario['fecha_alta_new'];
	   $usuario_alta_new = $f_beneficiario['usuario_alta_new'];
	   $fecha_baja = $f_beneficiario['fecha_baja'];
       $usuario_baja = $f_beneficiario['usuario_baja'];
	   $nro_nota = $f_beneficiario['nro_nota'];
	  
	  
	 
	$ssql = "SELECT * FROM ganancias WHERE  id_ganancia='$ganancia'";
     if (!($r_ganancia= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo documento";
      echo $cuerpo1;
      //.....................................................................
    }   
// ganancia
    $f_ganancia= mysql_fetch_array ($r_ganancia);
	$ganancia=$f_ganancia['nombre']; 	
		
		
	$ssql = "SELECT * FROM ingreso_bruto WHERE  id_ingreso='$ingreso'";
     if (!($r_ingreso= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo documento";
      echo $cuerpo1;
      //.....................................................................
    }   
// ingreso
    $f_ingreso= mysql_fetch_array ($r_ingreso);
	$ingreso=$f_ingreso['nombre']; 		
	
	$ssql = "SELECT * FROM regimen WHERE  id_regimen='$regimen'";
     if (!($r_regimen= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo documento";
      echo $cuerpo1;
      //.....................................................................
    }   
// regimen
    $f_regimen= mysql_fetch_array ($r_regimen);
	$ingreso=$f_regimen['nombre'];
	
		$ssql = "SELECT * FROM seguridad_social WHERE  id_seguridad='$seguridad'";
     if (!($r_seguridad= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo documento";
      echo $cuerpo1;
      //.....................................................................
    }   
// seguridad
    $f_seguridad= mysql_fetch_array ($r_seguridad);
	$seguridad=$f_seguridad['nombre'];
	
	$ssql = "SELECT * FROM sociedades WHERE  id_sociedad='$sociedad_tipo'";
     if (!($r_sociedad= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo documento";
      echo $cuerpo1;
      //.....................................................................
    }   
// tipo de documento
    $f_sociedad= mysql_fetch_array ($r_sociedad);
	$sociedad_tipo=$f_sociedad['nombre']; 	

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

	
//////////////fin de consulta en base///////////




////////////
$y_axis_initial = 40;
/////////////
$pdf->SetFont('Arial','IB',8);
$i=37;
$j=5;
$x=40;
$xx=$x+25;
$xj=$x+$xx+25;
$xy=$xj+$xx;
$bandera=$bandera+1;
$pdf->SetY($i);
$pdf->SetFillColor(215,215,215);
$pdf->Cell(236,5,'DATOS COMERCIALES',1,0,'L',1);
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell($x,$j,'FECHA CONTRATO SOCIAL:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$fechac_s,1,0,'L',1);
  }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$fechac_s,1,0,'L',1);
  }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$fechac_s,1,0,'L',1);
  }    
  
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'SOCIEDAD:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$sociedad_tipo,1,0,'L',1);
  }
  
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$sociedad_tipo,1,0,'L',1);
  }
  
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$sociedad_tipo,1,0,'L',1);
  }
      
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'SIT FRENTE AL IVA:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$iva_situacion,1,0,'L',1);
   }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$iva_situacion,1,0,'L',1);
   }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$iva_situacion,1,0,'L',1);
   }
         
   
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'GANANCIA:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$ganancia,1,0,'L',1);
  }
  
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$ganancia,1,0,'L',1);
  }
  
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$ganancia,1,0,'L',1);
  }    
  
  
  
  
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'INGRESO BRUTO:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$ingreso,1,0,'L',1);
  }
  
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$ingreso,1,0,'L',1);
  }
  
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$ingreso,1,0,'L',1);
  }      
  
  
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'Nº INGRESO BRUTO:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$ingreso_bruto,1,0,'L',1);
  }
  
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$ingreso_bruto,1,0,'L',1);
  }
  
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$ingreso_bruto,1,0,'L',1);
  } 
  
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'Nº INGRESO BRUTO ADM CENT:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$ingreso_bruto_ac,1,0,'L',1);
  }
  
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$ingreso_bruto_ac,1,0,'L',1);
  }
  
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$ingreso_bruto_ac ,1,0,'L',1);
  } 

  
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'REGIMEN DE CONVENIO:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$regimen,1,0,'L',1);
  }
  
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$regimen,1,0,'L',1);
  }
  
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$regimen,1,0,'L',1);
  }      


$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'SEGURIDAD SOCIAL:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$seguridad,1,0,'L',1);
  }
  
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$seguridad,1,0,'L',1);
  }
  
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$seguridad,1,0,'L',1);
  }      

  
$pdf->SetY($i=$i+7);
$pdf->SetFillColor(215,215,215); 
$pdf->SetFont('Arial','IB',8);
$pdf->Cell(236,5,'COMPONENTES DE LA SOCIEDAD O AUTORIDADES EN EJERCICIO ',1,0,'L',1);
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell($x,$j,'APELLIDO Y NOMBRE',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$apellido1.', '.$nombre1,1,0,'L',1);
  }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$apellido1.', '.$nombre1,1,0,'L',1);
  }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$apellido1.', '.$nombre1,1,0,'L',1);
  }
      
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'DNI',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$dni1,1,0,'L',1);
   }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$dni1,1,0,'L',1);
   }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$dni1,1,0,'L',1);
   }
   

$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'CARGO',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$cargo1,1,0,'L',1);
   }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$cargo1,1,0,'L',1);
   }
   
 if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$cargo1,1,0,'L',1);
   }     
   
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'FECHA INICIO',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$fecha1,1,0,'L',1);
   }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$fecha1,1,0,'L',1);
   }
   
 if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$fecha1,1,0,'L',1);
   }     
   
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'FECHA FIN',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$fin1,1,0,'L',1);
   }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$fin1,1,0,'L',1);
   }
   
 if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$fin1,1,0,'L',1);
   }     
   
   
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'APELLIDO Y NOMBRE',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$apellido2.', '.$nombre2,1,0,'L',1);
  }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$apellido2.', '.$nombre2,1,0,'L',1);
  }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$apellido2.', '.$nombre2,1,0,'L',1);
  }

$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'DNI',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$dni2,1,0,'L',1);
   }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$dni2,1,0,'L',1);
   }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$dni2,1,0,'L',1);
   }

$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'CARGO',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$cargo2,1,0,'L',1);
   }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$cargo2,1,0,'L',1);
   }
   
 if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$cargo2,1,0,'L',1);
   }     

$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'FECHA INICIO',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$fecha2,1,0,'L',1);
   }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$fecha2,1,0,'L',1);
   }
   
 if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$fecha2,1,0,'L',1);
   }     
   
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'FECHA FIN',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$fin2,1,0,'L',1);
   }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$fin2,1,0,'L',1);
   }
   
 if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$fin2,1,0,'L',1);
   }     

   
 
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'APELLIDO Y NOMBRE',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$apellido3.', '.$nombre3,1,0,'L',1);
  }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$apellido3.', '.$nombre3,1,0,'L',1);
  }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$apellido3.', '.$nombre3,1,0,'L',1);
  }

$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'DNI',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$dni3,1,0,'L',1);
   }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$dni3,1,0,'L',1);
   }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$dni3,1,0,'L',1);
   }


$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'CARGO',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$cargo3,1,0,'L',1);
   }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$cargo3,1,0,'L',1);
   }
   
 if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$cargo3,1,0,'L',1);
   }     
 
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'FECHA INICIO',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$fecha3,1,0,'L',1);
   }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$fecha3,1,0,'L',1);
   }
   
 if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$fecha3,1,0,'L',1);
   }     
   
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'FECHA FIN',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$fin3,1,0,'L',1);
   }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$fin3,1,0,'L',1);
   }
   
 if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$fin3,1,0,'L',1);
   }     
 

  
 
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'APELLIDO Y NOMBRE',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$apellido4.', '.$nombre4,1,0,'L',1);
  }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$apellido4.', '.$nombre4,1,0,'L',1);
  }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$apellido4.', '.$nombre4,1,0,'L',1);
  }

$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'DNI',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$dni4,1,0,'L',1);
   }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$dni4,1,0,'L',1);
   }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$dni4,1,0,'L',1);
   }


$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'CARGO',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$cargo4,1,0,'L',1);
   }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$cargo4,1,0,'L',1);
   }
   
 if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$cargo4,1,0,'L',1);
   }     
 
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'FECHA INICIO',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$fecha4,1,0,'L',1);
   }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$fecha4,1,0,'L',1);
   }
   
 if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$fecha4,1,0,'L',1);
   }     
   
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'FECHA FIN',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$fin4,1,0,'L',1);
   }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$fin4,1,0,'L',1);
   }
   
 if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$fin4,1,0,'L',1);
   }     
 

$pdf->SetY(-15);
//Select Arial italic 8
$pdf->SetFont('Arial','I',8);
 //Print current and total page numbers
$pdf->Cell(0,10,'Pagina '.$pdf->PageNo().'/{nb}',0,0,'C');
    }
  }

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
$pdf->Image('../img/membrete1.jpg',20,5,0);
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
$pdf->setY(25);
$pdf->cell(0,0,'FECHA: '.$dia,0,'B','R',0);
// (ancho,alto,texto,borde 0(sin borde):1(con borde),L: izquierda T: superior R: derecha B: inferior,alineacion (L,C,R),

////ENCABEZADO

$pdf->SetFont('Arial','IB',7);
$pdf->setY(25);
$pdf->cell(0,0,'HISTORIAL',0,'B','C',0);

///primera fila

$bandera=0;
mysql_data_seek($r_beneficiario,0);
while($f_beneficiario= mysql_fetch_array ($r_beneficiario))
   {
     if($bandera < 3)
	   {       
	  $banco_nombre=$f_beneficiario['banco_nombre'];
	  $banco_sucursal=$f_beneficiario['banco_sucursal'];
	  $banco_cta_tipo=$f_beneficiario['banco_cta_tipo'];
	  $banco_cta_nro=$f_beneficiario['banco_cta_nro'];
	  
    $cbu1=$f_beneficiario['banco_cta_nro'];
	$cbu2=$f_beneficiario['cbu_entidad'];
	$cbu3=$f_beneficiario['cbu_sucursal'];
	$cbu4=$f_beneficiario['verificador1'];
	$cbu5=$f_beneficiario['cbu_tipo_cta'];
	$cbu6=$f_beneficiario['cbu_cta'];
	$cbu7=$f_beneficiario['verificador2'];
	
  //$cbu=$cbu1.''.$cbu2.''.$cbu3.''.$cbu4.''.$cbu5.''.$cbu6.''.$cbu7;
   $cbu=$f_beneficiario['cbu'];
  
	  $ingreso_bruto=$f_beneficiario['ingreso_bruto'];
	  $actividad_p=$f_beneficiario['actividad_p'];
      $sociedad_tipo = $f_beneficiario['sociedad_tipo'];
	  
	  
	  $iva_situacion = $f_beneficiario['iva_situacion'];
	  $ganancia = $f_beneficiario['ganancia'];
	  $ganancia = $f_beneficiario['ingreso'];
	  $ganancia = $f_beneficiario['seguridad']; 
	  $ganancia = $f_beneficiario['regimen'];
	  $ingreso_bruto_ac = $f_beneficiario['ingreso_bruto_ac'];
	  
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
	   $fecha1 = $f_beneficiario['fecha_inicio1'];
	   $fecha2 = $f_beneficiario['fecha_inicio2'];
	   $fecha3 = $f_beneficiario['fecha_inicio3'];
	   $fecha4 = $f_beneficiario['fecha_inicio4'];
	   $fin1 = $f_beneficiario['duracion1'];
	   $fin2 = $f_beneficiario['duracion2'];
	   $fin3 = $f_beneficiario['duracion3'];
	   $fin4 = $f_beneficiario['duracion4'];
	   $usuario_alta=$f_beneficiario['usuario_alta'];
	   $usuario_aprobo=$f_beneficiario['usuario_aprobo'];
	   $fecha_aprobacion=$f_beneficiario['fecha_aprobacion'];
	   $usuario_modifico=$f_beneficiario['usuario_modifico'];
	   $fecha_modi=$f_beneficiario['fecha_modi'];
	   $fecha_alta_new = $f_beneficiario['fecha_alta_new'];
	   $usuario_alta_new = $f_beneficiario['usuario_alta_new'];
	   $fecha_baja = $f_beneficiario['fecha_baja'];
       $usuario_baja = $f_beneficiario['usuario_baja'];
	   $nro_nota = $f_beneficiario['nro_nota'];
		
	
	$ssql = "SELECT * FROM ganancias WHERE  id_ganancia='$ganancia'";
     if (!($r_ganancia= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo documento";
      echo $cuerpo1;
      //.....................................................................
    }   
// ganancia
    $f_ganancia= mysql_fetch_array ($r_ganancia);
	$ganancia=$f_ganancia['nombre']; 	
		
		
	$ssql = "SELECT * FROM ingreso_bruto WHERE  id_ingreso='$ingreso'";
     if (!($r_ingreso= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo documento";
      echo $cuerpo1;
      //.....................................................................
    }   
// ingreso
    $f_ingreso= mysql_fetch_array ($r_ingreso);
	$ingreso=$f_ingreso['nombre']; 		
	
	$ssql = "SELECT * FROM regimen WHERE  id_regimen='$regimen'";
     if (!($r_regimen= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo documento";
      echo $cuerpo1;
      //.....................................................................
    }   
// regimen
    $f_regimen= mysql_fetch_array ($r_regimen);
	$ingreso=$f_regimen['nombre'];
	
		$ssql = "SELECT * FROM seguridad_social WHERE  id_seguridad='$seguridad'";
     if (!($r_seguridad= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo documento";
      echo $cuerpo1;
      //.....................................................................
    }   
// seguridad
    $f_seguridad= mysql_fetch_array ($r_seguridad);
	$seguridad=$f_seguridad['nombre'];
	
	$ssql = "SELECT * FROM sociedades WHERE  id_sociedad='$sociedad_tipo'";
     if (!($r_sociedad= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo documento";
      echo $cuerpo1;
      //.....................................................................
    }   
// tipo de documento
    $f_sociedad= mysql_fetch_array ($r_sociedad);
	$sociedad_tipo=$f_sociedad['nombre']; 	

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

	
//////////////fin de consulta en base///////////




////////////
$y_axis_initial = 40;
/////////////
$pdf->SetFont('Arial','IB',8);
$i=40;
$j=5;
$x=40;
$xx=$x+25;
$xj=$x+$xx+25;
$xy=$xj+$xx;
$bandera=$bandera+1;
$pdf->SetY($i);
$pdf->SetFillColor(215,215,215);
$pdf->SetFont('Arial','IB',8);
$pdf->Cell(236,5,'DATOS DE LA CUENTA BANCARIA ',1,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetFillColor(256,256,256);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell($x,$j,'BANCO',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$banco_nombre,1,0,'L',1);
   }

if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$banco_nombre,1,0,'L',1);
   }

if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$banco_nombre,1,0,'L',1);
   }

$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'SUCURSAL',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$banco_sucursal,1,0,'L',1);
   }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$banco_sucursal,1,0,'L',1);
   }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$banco_sucursal,1,0,'L',1);
   }      
   
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'TIPO DE CUENTA',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$banco_cta_tipo,1,0,'L',1);
  }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$banco_cta_tipo,1,0,'L',1);
  }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$banco_cta_tipo,1,0,'L',1);
  }    
  
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'NUMERO DE CUENTA',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$banco_cta_nro,1,0,'L',1);
  }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$banco_cta_nro,1,0,'L',1);
  }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$banco_cta_nro,1,0,'L',1);
  }
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'CBU',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$cbu,1,0,'L',1);
}

if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$cbu,1,0,'L',1);
}

if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$cbu,1,0,'L',1);
}

$pdf->SetY($i=$i+7);
$pdf->SetFillColor(215,215,215); 
$pdf->SetFont('Arial','IB',8);
$pdf->Cell(236,5,'DATOS DE SITEMA ',1,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetFillColor(256,256,256);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell($x,$j,'USUARIO ALTA',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$usuario_alta,1,0,'L',1);
  }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$usuario_alta,1,0,'L',1);
  }  
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$usuario_alta,1,0,'L',1);
  }  
  
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'USUARIO APROBO',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$usuario_aprobo,1,0,'L',1);
  }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$usuario_aprobo,1,0,'L',1);
  }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$usuario_aprobo,1,0,'L',1);
  }

  
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'FECHA APROBACION',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$fecha_aprobacion,1,0,'L',1);
  }
  
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$fecha_aprobacion,1,0,'L',1);
  }

if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$fecha_aprobacion,1,0,'L',1);
  }

$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'USUARIO MODIFICO',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$usuario_modifico,1,0,'L',1);
  }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$usuario_modifico,1,0,'L',1);
  }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$usuario_modifico,1,0,'L',1);
  }

  
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'FECHA MODIFICACION',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$fecha_modi,1,0,'L',1);
  }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$fecha_modi,1,0,'L',1);
  }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$fecha_modi,1,0,'L',1);
  }

$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'FECHA BAJA',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,'',1,0,'L',1);
  }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$fecha_baja,1,0,'L',1);
  }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$fecha_baja,1,0,'L',1);
  }

$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'NRO DE NOTA',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,'',1,0,'L',1);
  }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$nro_nota,1,0,'L',1);
  }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$nro_nota,1,0,'L',1);
  }

$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'USUARIO BAJA',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,'',1,0,'L',1);
  }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$usuario_baja,1,0,'L',1);
  }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$usuario_baja,1,0,'L',1);
  }

$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'FECHA DE REINCORPORACION',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,'',1,0,'L',1);
  }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$fecha_alta_new,1,0,'L',1);
  }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$fecha_alta_new,1,0,'L',1);
  }
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'USUARIO REINCORPORO',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,'',1,0,'L',1);
  }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$usuario_alta_new,1,0,'L',1);
  }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$usuario_alta_new,1,0,'L',1);
  }  

$pdf->SetY(-15);
//Select Arial italic 8
$pdf->SetFont('Arial','I',8);
 //Print current and total page numbers
$pdf->Cell(0,10,'Pagina '.$pdf->PageNo().'/{nb}',0,0,'C');
    }
}
while ($cant > $banc)
  {
 $pdf->AddPage();
 $y_axis_initial = 25;

// imprime el titulo de la pagina
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','B',11);
$pdf->SetY($y_axis_initial);
//$pdf->SetY(20);
$pdf->SetFillColor(256,256,256);
//$pdf->SetFont('Arial','I',6);
$pdf->setY(10);
$pdf->Image('../img/membrete1.jpg',20,5,0);
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
$pdf->setY(25);
$pdf->cell(0,0,'FECHA: '.$dia,0,'B','R',0);
// (ancho,alto,texto,borde 0(sin borde):1(con borde),L: izquierda T: superior R: derecha B: inferior,alineacion (L,C,R),

////ENCABEZADO

$pdf->SetFont('Arial','IB',7);
$pdf->setY(25);
$pdf->cell(0,0,'HISTORIAL',0,'B','C',0);

///primera fila
 
$bandera=0;
$vbanc=$banc;
mysql_data_seek($r_beneficiario,$vbanc) ;
while($f_beneficiario= mysql_fetch_array ($r_beneficiario))
   {
    if($bandera < 3)
	   {
	  $banc=$banc+1;        
	  $cuitl = $f_beneficiario['cuitl'];
	  $apellido= $f_beneficiario['apellido'];
	  $nombre = $f_beneficiario['nombre'];
	  $razon_social = $f_beneficiario['razon_social'];  
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
	  
    $cbu1=$f_beneficiario['banco_cta_nro'];
	$cbu2=$f_beneficiario['cbu_entidad'];
	$cbu3=$f_beneficiario['cbu_sucursal'];
	$cbu4=$f_beneficiario['verificador1'];
	$cbu5=$f_beneficiario['cbu_tipo_cta'];
	$cbu6=$f_beneficiario['cbu_cta'];
	$cbu7=$f_beneficiario['verificador2'];
	
  //$cbu=$cbu1.''.$cbu2.''.$cbu3.''.$cbu4.''.$cbu5.''.$cbu6.''.$cbu7;
    $cbu=$f_beneficiario['cbu'];
	
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
	   $usuario_alta=$f_beneficiario['usuario_alta'];
	   $usuario_aprobo=$f_beneficiario['usuario_aprobo'];
	   $fecha_aprobacion=$f_beneficiario['fecha_aprobacion'];
	   $usuario_modifico=$f_beneficiario['usuario_modifico'];
	   $fecha_modi=$f_beneficiario['fecha_modi'];
		
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

////////////
$y_axis_initial = 40;
/////////////
$pdf->SetFont('Arial','IB',8);
$bandera=$bandera+1;
$i=40;
$j=5;
$x=40;
$xx=$x+25;
$xj=$x+$xx+25;
$xy=$xj+$xx;
$pdf->SetY($i);
$pdf->SetFillColor(215,215,215);
$pdf->Cell(236,5,'DATOS DE IDENTIFICACION',1,0,'L',1);
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell($x,$j,'CUIT /CUIL: ',1,0,'L',1);
if ($bandera==1)
  {
   $pdf->SetY($i);
   $pdf->SetX($xx);
   $pdf->Cell($xx,$j,$cuitl,1,0,'L',1);
  }
if ($bandera==2)
  {
   $pdf->SetY($i);
   $pdf->SetX($xj);
   $pdf->Cell($xx,$j,$cuitl,1,0,'L',1);
  } 
if ($bandera==3)
  {
   $pdf->SetY($i);
   $pdf->SetX($xy);
   $pdf->Cell($xx,$j,$cuitl,1,0,'L',1);
  }   
  
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'DENOMINACION:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$apellido.' '.$nombre.''.$razon_social,1,0,'L',1);
   }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$apellido.' '.$nombre.''.$razon_social,1,0,'L',1);
   }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$apellido.' '.$nombre.''.$razon_social,1,0,'L',1);
   }


$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'TIPO DE DOCUMENTO: ',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$documento_tipo,1,0,'L',1);
 }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$documento_tipo,1,0,'L',1);
 }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$documento_tipo,1,0,'L',1);
 }
 
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'Nº:',1,0,'L',1);

if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$documento_nro,1,0,'L',1);
  }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$documento_nro,1,0,'L',1);
  }
 if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$documento_nro,1,0,'L',1);
  }   
  
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,5,'FECHA NACIMIENTO:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$fecha_nacimiento,1,0,'L',1);
  }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$fecha_nacimiento,1,0,'L',1);
  }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$fecha_nacimiento,1,0,'L',1);
  }


$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'AREA:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$area,1,0,'L',1);
  }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$area,1,0,'L',1);
  }

if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$area,1,0,'L',1);
  }


$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'CARGO:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$cargo,1,0,'L',1);
  }

if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$cargo,1,0,'L',1);
  }

if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$cargo,1,0,'L',1);
  }
  

$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'FECHA INICIO DE GESTION:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$fecha_c,1,0,'L',1);
   }
   
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$fecha_c,1,0,'L',1);
   }
   
 if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$fecha_c,1,0,'L',1);
   }
        
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'SAF:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$saf,1,0,'L',1);
 }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$saf,1,0,'L',1);
 }

if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$saf,1,0,'L',1);
 }

 
$pdf->SetFillColor(215,215,215);
$pdf->SetFont('Arial','IB',8);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell(236,5,'DOMICILIO FISCAL',1,0,'L',1);
//datos domicilio fiscal ///

$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell($x,$j,'CALLE:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$direccion_f_calle,1,0,'L',1);
  }

if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$direccion_f_calle,1,0,'L',1);
  }

if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$direccion_f_calle,1,0,'L',1);
  }

$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'Nº:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$direccion_f_nro,1,0,'L',1);
  }
  
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$direccion_f_nro,1,0,'L',1);
  }
  
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$direccion_f_nro,1,0,'L',1);
  }    
  
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'PISO:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$direccion_f_piso,1,0,'L',1);
}
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$direccion_f_piso,1,0,'L',1);
}
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$direccion_f_piso,1,0,'L',1);
}

$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'DPTO Nº:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$direccion_f_nro,1,0,'L',1);
   }
   
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$direccion_f_nro,1,0,'L',1);
   }
   
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$direccion_f_nro,1,0,'L',1);
   }
         
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'PROVINCIA:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$direccion_f_provincia,1,0,'L',1);
   }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$direccion_f_provincia,1,0,'L',1);
   }
 if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$direccion_f_provincia,1,0,'L',1);
   }
        
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'LOCALIDAD:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$direccion_f_localidad,1,0,'L',1);
   }

if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$direccion_f_localidad,1,0,'L',1);
   }

if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$direccion_f_localidad,1,0,'L',1);
   }


$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'CODIGO POSTAL:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$codigo_f_postal,1,0,'L',1);
  }
  
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$codigo_f_postal,1,0,'L',1);
  }
  
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$codigo_f_postal,1,0,'L',1);
  }    

$pdf->SetFillColor(215,215,215); 
$pdf->SetFont('Arial','IB',8);
$pdf->SetY($i=$i+7);
$pdf->SetFillColor(215,215,215); 
$pdf->Cell(236,5,'OTROS DATOS',1,0,'L',1);
$pdf->SetFillColor(256,256,256);

$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell($x,$j,'TELEFONO:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$telefono,1,0,'L',1);
   } 
   
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$telefono,1,0,'L',1);
   } 
   
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$telefono,1,0,'L',1);
   } 
         
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'DIRECCION E-MAIL:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$email,1,0,'L',1);
   }
   
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$email,1,0,'L',1);
   }
   
 if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$email,1,0,'L',1);
   }
        
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'OBSERVACION:',1,0,'L',1);
 if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$observacion,1,0,'L',1);
  }

 if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$observacion,1,0,'L',1);
  }
  
 if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$observacion,1,0,'L',1);
  }    
  
$pdf->SetFont('Arial','IB',8);
$pdf->SetY($i=$i+7);
$pdf->SetFillColor(215,215,215); 
$pdf->Cell(236,5,'DATOS ECONOMICOS',1,0,'L',1);
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell($x,$j,'ACTIVIDAD PRINCIPAL:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$actividad_p,1,0,'L',1);
   }

if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$actividad_p,1,0,'L',1);
   }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$actividad_p,1,0,'L',1);
   }
         
   
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'CODIGO:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$actividad_p_n,1,0,'L',1);
   }
   
 if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$actividad_p_n,1,0,'L',1);
   }
 
 if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$actividad_p_n,1,0,'L',1);
   }
   
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'FECHA DE INICIO:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$fecha_p,1,0,'L',1);
   }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$fecha_p,1,0,'L',1);
   }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$fecha_p,1,0,'L',1);
   }      
   
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'ACTIVIDAD SECUNDARIA:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$actividad_s,1,0,'L',1);
  }
  
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$actividad_s,1,0,'L',1);
  }
  
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$actividad_s,1,0,'L',1);
  }
      
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'CODIGO:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$actividad_s_n,1,0,'L',1);
  }

if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$actividad_s_n,1,0,'L',1);
  }
  
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$actividad_s_n,1,0,'L',1);
  }
    
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'FECHA DE INICIO:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$fecha_s,1,0,'L',1);
  }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$fecha_s,1,0,'L',1);
  }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$fecha_s,1,0,'L',1);
  }
 } //if bandera mayor
}//while
$pdf->SetY($i=$i+10);
$pdf->SetFillColor(215,215,215); 
$pdf->SetY(-13);
//Select Arial italic 8
$pdf->SetFont('Arial','I',8);
 //Print current and total page numbers
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
$pdf->Image('../img/membrete1.jpg',20,5,0);
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
$pdf->setY(25);
$pdf->cell(0,0,'FECHA: '.$dia,0,'B','R',0);
// (ancho,alto,texto,borde 0(sin borde):1(con borde),L: izquierda T: superior R: derecha B: inferior,alineacion (L,C,R),

////ENCABEZADO

$pdf->SetFont('Arial','IB',7);
$pdf->setY(25);
$pdf->cell(0,0,'HISTORIAL',0,'B','C',0);

///primera fila

$bandera=0;
mysql_data_seek($r_beneficiario,$vbanc);
while($f_beneficiario= mysql_fetch_array ($r_beneficiario))
   {
     if($bandera < 3)
	   {       
	  $banco_nombre=$f_beneficiario['banco_nombre'];
	  $banco_sucursal=$f_beneficiario['banco_sucursal'];
	  $banco_cta_tipo=$f_beneficiario['banco_cta_tipo'];
	  $banco_cta_nro=$f_beneficiario['banco_cta_nro'];
	  
    $cbu1=$f_beneficiario['banco_cta_nro'];
	$cbu2=$f_beneficiario['cbu_entidad'];
	$cbu3=$f_beneficiario['cbu_sucursal'];
	$cbu4=$f_beneficiario['verificador1'];
	$cbu5=$f_beneficiario['cbu_tipo_cta'];
	$cbu6=$f_beneficiario['cbu_cta'];
	$cbu7=$f_beneficiario['verificador2'];
	
  //$cbu=$cbu1.''.$cbu2.''.$cbu3.''.$cbu4.''.$cbu5.''.$cbu6.''.$cbu7;
  $cbu=$f_beneficiario['cbu'];
	  $ingreso_bruto=$f_beneficiario['ingreso_bruto'];
	  $actividad_p=$f_beneficiario['actividad_p'];
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
	    $fecha1 = $f_beneficiario['fecha_inicio1'];
	   $fecha2 = $f_beneficiario['fecha_inicio2'];
	   $fecha3 = $f_beneficiario['fecha_inicio3'];
	   $fecha4 = $f_beneficiario['fecha_inicio4'];
	   $fin1 = $f_beneficiario['duracion1'];
	   $fin2 = $f_beneficiario['duracion2'];
	   $fin3 = $f_beneficiario['duracion3'];
	   $fin4 = $f_beneficiario['duracion4'];
	   
	   $usuario_alta=$f_beneficiario['usuario_alta'];
	   $usuario_aprobo=$f_beneficiario['usuario_aprobo'];
	   $fecha_aprobacion=$f_beneficiario['fecha_aprobacion'];
	   $usuario_modifico=$f_beneficiario['usuario_modifico'];
	   $fecha_modi=$f_beneficiario['fecha_modi'];
		
	$ssql = "SELECT * FROM sociedades WHERE  id_sociedad='$sociedad_tipo'";
     if (!($r_sociedad= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo documento";
      echo $cuerpo1;
      //.....................................................................
    }   
// tipo de documento
    $f_sociedad= mysql_fetch_array ($r_sociedad);
	$sociedad_tipo=$f_sociedad['nombre']; 	

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

	
//////////////fin de consulta en base///////////




////////////
$y_axis_initial = 40;
/////////////
$pdf->SetFont('Arial','IB',8);
$i=40;
$j=5;
$x=40;
$xx=$x+25;
$xj=$x+$xx+25;
$xy=$xj+$xx;
$bandera=$bandera+1;
$pdf->SetY($i);
$pdf->SetFillColor(215,215,215);
$pdf->Cell(236,5,'DATOS COMERCIALES',1,0,'L',1);
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell($x,$j,'FECHA CONTRATO SOCIAL:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$fechac_s,1,0,'L',1);
  }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$fechac_s,1,0,'L',1);
  }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$fechac_s,1,0,'L',1);
  }    
  
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'SOCIEDAD:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$sociedad_tipo,1,0,'L',1);
  }
  
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$sociedad_tipo,1,0,'L',1);
  }
  
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$sociedad_tipo,1,0,'L',1);
  }
      
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'SIT FRENTE AL IVA:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$iva_situacion,1,0,'L',1);
   }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$iva_situacion,1,0,'L',1);
   }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$iva_situacion,1,0,'L',1);
   }
         
   
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'GANANCIA:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$ganancia,1,0,'L',1);
  }
  
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$ganancia,1,0,'L',1);
  }
  
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$ganancia,1,0,'L',1);
  }    
  
  
  
  
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'INGRESO BRUTO:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$ingreso,1,0,'L',1);
  }
  
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$ingreso,1,0,'L',1);
  }
  
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$ingreso,1,0,'L',1);
  }      
  
  
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'Nº INGRESO BRUTO:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$ingreso_bruto,1,0,'L',1);
  }
  
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$ingreso_bruto,1,0,'L',1);
  }
  
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$ingreso_bruto,1,0,'L',1);
  } 
  
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'Nº INGRESO BRUTO ADM CENT:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$ingreso_bruto_ac,1,0,'L',1);
  }
  
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$ingreso_bruto_ac,1,0,'L',1);
  }
  
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$ingreso_bruto_ac ,1,0,'L',1);
  } 

  
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'REGIMEN DE CONVENIO:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$regimen,1,0,'L',1);
  }
  
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$regimen,1,0,'L',1);
  }
  
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$regimen,1,0,'L',1);
  }      


$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'SEGURIDAD SOCIAL:',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$seguridad,1,0,'L',1);
  }
  
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$seguridad,1,0,'L',1);
  }
  
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$seguridad,1,0,'L',1);
  }      

  
$pdf->SetY($i=$i+7);
$pdf->SetFillColor(215,215,215); 
$pdf->SetFont('Arial','IB',8);
$pdf->Cell(236,5,'COMPONENTES DE LA SOCIEDAD O AUTORIDADES EN EJERCICIO ',1,0,'L',1);
$pdf->SetFillColor(256,256,256);
$pdf->SetFont('Arial','',7);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell($x,$j,'APELLIDO Y NOMBRE',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$apellido1.', '.$nombre1,1,0,'L',1);
  }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$apellido1.', '.$nombre1,1,0,'L',1);
  }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$apellido1.', '.$nombre1,1,0,'L',1);
  }
      
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'DNI',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$dni1,1,0,'L',1);
   }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$dni1,1,0,'L',1);
   }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$dni1,1,0,'L',1);
   }
   

$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'CARGO',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$cargo1,1,0,'L',1);
   }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$cargo1,1,0,'L',1);
   }
   
 if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$cargo1,1,0,'L',1);
   }     
   
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'FECHA INICIO',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$fecha1,1,0,'L',1);
   }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$fecha1,1,0,'L',1);
   }
   
 if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$fecha1,1,0,'L',1);
   }     
   
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'FECHA FIN',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$fin1,1,0,'L',1);
   }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$fin1,1,0,'L',1);
   }
   
 if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$fin1,1,0,'L',1);
   }     
   
   
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'APELLIDO Y NOMBRE',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$apellido2.', '.$nombre2,1,0,'L',1);
  }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$apellido2.', '.$nombre2,1,0,'L',1);
  }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$apellido2.', '.$nombre2,1,0,'L',1);
  }

$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'DNI',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$dni2,1,0,'L',1);
   }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$dni2,1,0,'L',1);
   }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$dni2,1,0,'L',1);
   }

$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'CARGO',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$cargo2,1,0,'L',1);
   }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$cargo2,1,0,'L',1);
   }
   
 if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$cargo2,1,0,'L',1);
   }     

$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'FECHA INICIO',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$fecha2,1,0,'L',1);
   }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$fecha2,1,0,'L',1);
   }
   
 if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$fecha2,1,0,'L',1);
   }     
   
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'FECHA FIN',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$fin2,1,0,'L',1);
   }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$fin2,1,0,'L',1);
   }
   
 if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$fin2,1,0,'L',1);
   }     

   
 
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'APELLIDO Y NOMBRE',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$apellido3.', '.$nombre3,1,0,'L',1);
  }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$apellido3.', '.$nombre3,1,0,'L',1);
  }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$apellido3.', '.$nombre3,1,0,'L',1);
  }

$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'DNI',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$dni3,1,0,'L',1);
   }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$dni3,1,0,'L',1);
   }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$dni3,1,0,'L',1);
   }


$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'CARGO',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$cargo3,1,0,'L',1);
   }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$cargo3,1,0,'L',1);
   }
   
 if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$cargo3,1,0,'L',1);
   }     
 
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'FECHA INICIO',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$fecha3,1,0,'L',1);
   }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$fecha3,1,0,'L',1);
   }
   
 if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$fecha3,1,0,'L',1);
   }     
   
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'FECHA FIN',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$fin3,1,0,'L',1);
   }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$fin3,1,0,'L',1);
   }
   
 if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$fin3,1,0,'L',1);
   }     
 

  
 
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'APELLIDO Y NOMBRE',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$apellido4.', '.$nombre4,1,0,'L',1);
  }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$apellido4.', '.$nombre4,1,0,'L',1);
  }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$apellido4.', '.$nombre4,1,0,'L',1);
  }

$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'DNI',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$dni4,1,0,'L',1);
   }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$dni4,1,0,'L',1);
   }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$dni4,1,0,'L',1);
   }


$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'CARGO',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$cargo4,1,0,'L',1);
   }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$cargo4,1,0,'L',1);
   }
   
 if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$cargo4,1,0,'L',1);
   }     
 
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'FECHA INICIO',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$fecha4,1,0,'L',1);
   }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$fecha4,1,0,'L',1);
   }
   
 if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$fecha4,1,0,'L',1);
   }     
   
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'FECHA FIN',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$fin4,1,0,'L',1);
   }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$fin4,1,0,'L',1);
   }
   
 if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$fin4,1,0,'L',1);
   }     
 

$pdf->SetY(-15);
//Select Arial italic 8
$pdf->SetFont('Arial','I',8);
 //Print current and total page numbers
$pdf->Cell(0,10,'Pagina '.$pdf->PageNo().'/{nb}',0,0,'C');
    }
  }

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
$pdf->Image('../img/membrete1.jpg',20,5,0);
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
$pdf->setY(25);
$pdf->cell(0,0,'FECHA: '.$dia,0,'B','R',0);
// (ancho,alto,texto,borde 0(sin borde):1(con borde),L: izquierda T: superior R: derecha B: inferior,alineacion (L,C,R),

////ENCABEZADO

$pdf->SetFont('Arial','IB',7);
$pdf->setY(25);
$pdf->cell(0,0,'HISTORIAL',0,'B','C',0);

///primera fila

$bandera=0;
mysql_data_seek($r_beneficiario,$vbanc);
while($f_beneficiario= mysql_fetch_array ($r_beneficiario))
   {
     if($bandera < 3)
	   {       
	  $banco_nombre=$f_beneficiario['banco_nombre'];
	  $banco_sucursal=$f_beneficiario['banco_sucursal'];
	  $banco_cta_tipo=$f_beneficiario['banco_cta_tipo'];
	  $banco_cta_nro=$f_beneficiario['banco_cta_nro'];
	  
    $cbu1=$f_beneficiario['banco_cta_nro'];
	$cbu2=$f_beneficiario['cbu_entidad'];
	$cbu3=$f_beneficiario['cbu_sucursal'];
	$cbu4=$f_beneficiario['verificador1'];
	$cbu5=$f_beneficiario['cbu_tipo_cta'];
	$cbu6=$f_beneficiario['cbu_cta'];
	$cbu7=$f_beneficiario['verificador2'];
	
  //$cbu=$cbu1.''.$cbu2.''.$cbu3.''.$cbu4.''.$cbu5.''.$cbu6.''.$cbu7;
  
  $cbu=$f_beneficiario['cbu'];
  
	  $ingreso_bruto=$f_beneficiario['ingreso_bruto'];
	  $actividad_p=$f_beneficiario['actividad_p'];
      $sociedad_tipo = $f_beneficiario['sociedad_tipo'];
	  
	  
	  $iva_situacion = $f_beneficiario['iva_situacion'];
	  $ganancia = $f_beneficiario['ganancia'];
	  $ganancia = $f_beneficiario['ingreso'];
	  $ganancia = $f_beneficiario['seguridad']; 
	  $ganancia = $f_beneficiario['regimen'];
	  $ingreso_bruto_ac = $f_beneficiario['ingreso_bruto_ac'];
	  
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
	   $fecha1 = $f_beneficiario['fecha_inicio1'];
	   $fecha2 = $f_beneficiario['fecha_inicio2'];
	   $fecha3 = $f_beneficiario['fecha_inicio3'];
	   $fecha4 = $f_beneficiario['fecha_inicio4'];
	   $fin1 = $f_beneficiario['duracion1'];
	   $fin2 = $f_beneficiario['duracion2'];
	   $fin3 = $f_beneficiario['duracion3'];
	   $fin4 = $f_beneficiario['duracion4'];
	  
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
	   $fecha1 = $f_beneficiario['fecha_inicio1'];
	   $fecha2 = $f_beneficiario['fecha_inicio2'];
	   $fecha3 = $f_beneficiario['fecha_inicio3'];
	   $fecha4 = $f_beneficiario['fecha_inicio4'];
	   $fin1 = $f_beneficiario['duracion1'];
	   $fin2 = $f_beneficiario['duracion2'];
	   $fin3 = $f_beneficiario['duracion3'];
	   $fin4 = $f_beneficiario['duracion4'];
	   $usuario_alta=$f_beneficiario['usuario_alta'];
	   $usuario_aprobo=$f_beneficiario['usuario_aprobo'];
	   $fecha_aprobacion=$f_beneficiario['fecha_aprobacion'];
	   $usuario_modifico=$f_beneficiario['usuario_modifico'];
	   $fecha_modi=$f_beneficiario['fecha_modi'];
	   $fecha_alta_new = $f_beneficiario['fecha_alta_new'];
	   $usuario_alta_new = $f_beneficiario['usuario_alta_new'];
	   $fecha_baja = $f_beneficiario['fecha_baja'];
       $usuario_baja = $f_beneficiario['usuario_baja'];
	   $nro_nota = $f_beneficiario['nro_nota'];
	  
		
	
	$ssql = "SELECT * FROM ganancias WHERE  id_ganancia='$ganancia'";
     if (!($r_ganancia= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo documento";
      echo $cuerpo1;
      //.....................................................................
    }   
// ganancia
    $f_ganancia= mysql_fetch_array ($r_ganancia);
	$ganancia=$f_ganancia['nombre']; 	
		
		
	$ssql = "SELECT * FROM ingreso_bruto WHERE  id_ingreso='$ingreso'";
     if (!($r_ingreso= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo documento";
      echo $cuerpo1;
      //.....................................................................
    }   
// ingreso
    $f_ingreso= mysql_fetch_array ($r_ingreso);
	$ingreso=$f_ingreso['nombre']; 		
	
	$ssql = "SELECT * FROM regimen WHERE  id_regimen='$regimen'";
     if (!($r_regimen= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo documento";
      echo $cuerpo1;
      //.....................................................................
    }   
// regimen
    $f_regimen= mysql_fetch_array ($r_regimen);
	$ingreso=$f_regimen['nombre'];
	
		$ssql = "SELECT * FROM seguridad_social WHERE  id_seguridad='$seguridad'";
     if (!($r_seguridad= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo documento";
      echo $cuerpo1;
      //.....................................................................
    }   
// seguridad
    $f_seguridad= mysql_fetch_array ($r_seguridad);
	$seguridad=$f_seguridad['nombre'];
	
	$ssql = "SELECT * FROM sociedades WHERE  id_sociedad='$sociedad_tipo'";
     if (!($r_sociedad= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo documento";
      echo $cuerpo1;
      //.....................................................................
    }   
// tipo de documento
    $f_sociedad= mysql_fetch_array ($r_sociedad);
	$sociedad_tipo=$f_sociedad['nombre']; 	

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

	
//////////////fin de consulta en base///////////




////////////
$y_axis_initial = 40;
/////////////
$pdf->SetFont('Arial','IB',8);
$i=40;
$j=5;
$x=40;
$xx=$x+25;
$xj=$x+$xx+25;
$xy=$xj+$xx;
$bandera=$bandera+1;
$pdf->SetY($i);
$pdf->SetFillColor(215,215,215);
$pdf->SetFont('Arial','IB',8);
$pdf->Cell(236,5,'DATOS DE LA CUENTA BANCARIA ',1,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetFillColor(256,256,256);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell($x,$j,'BANCO',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$banco_nombre,1,0,'L',1);
   }

if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$banco_nombre,1,0,'L',1);
   }

if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$banco_nombre,1,0,'L',1);
   }

$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'SUCURSAL',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$banco_sucursal,1,0,'L',1);
   }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$banco_sucursal,1,0,'L',1);
   }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$banco_sucursal,1,0,'L',1);
   }      
   
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'TIPO DE CUENTA',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$banco_cta_tipo,1,0,'L',1);
  }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$banco_cta_tipo,1,0,'L',1);
  }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$banco_cta_tipo,1,0,'L',1);
  }    
  
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'NUMERO DE CUENTA',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$banco_cta_nro,1,0,'L',1);
  }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$banco_cta_nro,1,0,'L',1);
  }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$banco_cta_nro,1,0,'L',1);
  }
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'CBU',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$cbu,1,0,'L',1);
}

if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$cbu,1,0,'L',1);
}

if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$cbu,1,0,'L',1);
}

$pdf->SetY($i=$i+7);
$pdf->SetFillColor(215,215,215); 
$pdf->SetFont('Arial','IB',8);
$pdf->Cell(236,5,'DATOS DE SITEMA ',1,0,'L',1);
$pdf->SetFont('Arial','',7);
$pdf->SetFillColor(256,256,256);
$pdf->SetY($i=$i+7);
$pdf->SetX(25);
$pdf->Cell($x,$j,'USUARIO ALTA',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$usuario_alta,1,0,'L',1);
  }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$usuario_alta,1,0,'L',1);
  }  
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$usuario_alta,1,0,'L',1);
  }  
  
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'USUARIO APROBO',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$usuario_aprobo,1,0,'L',1);
  }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$usuario_aprobo,1,0,'L',1);
  }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$usuario_aprobo,1,0,'L',1);
  }

  
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'FECHA APROBACION',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$fecha_aprobacion,1,0,'L',1);
  }
  
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$fecha_aprobacion,1,0,'L',1);
  }

if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$fecha_aprobacion,1,0,'L',1);
  }

$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'USUARIO MODIFICO',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$usuario_modifico,1,0,'L',1);
  }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$usuario_modifico,1,0,'L',1);
  }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$usuario_modifico,1,0,'L',1);
  }

  
$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'FECHA MODIFICACION',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$fecha_modi,1,0,'L',1);
  }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$fecha_modi,1,0,'L',1);
  }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$fecha_modi,1,0,'L',1);
  }

$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'FECHA BAJA',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,'',1,0,'L',1);
  }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$fecha_baja,1,0,'L',1);
  }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$fecha_baja,1,0,'L',1);
  }

$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'NRO DE NOTA',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,'',1,0,'L',1);
  }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$nro_nota,1,0,'L',1);
  }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$nro_nota,1,0,'L',1);
  }

$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'USUARIO BAJA',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,'',1,0,'L',1);
  }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$usuario_baja,1,0,'L',1);
  }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$usuario_baja,1,0,'L',1);
  }

$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'FECHA REINCORPORACION',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,'',1,0,'L',1);
  }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$fecha_alta_new,1,0,'L',1);
  }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$fecha_alta_new,1,0,'L',1);
  }

$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'NRO DE NOTA',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$nro_nota,1,0,'L',1);
  }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$nro_nota,1,0,'L',1);
  }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$nro_nota,1,0,'L',1);
  }

$pdf->SetY($i=$i+5);
$pdf->SetX(25);
$pdf->Cell($x,$j,'USUARIO REINCORPORO',1,0,'L',1);
if ($bandera==1)
  {
$pdf->SetY($i);
$pdf->SetX($xx);
$pdf->Cell($xx,$j,$usuario_alta_new,1,0,'L',1);
  }
if ($bandera==2)
  {
$pdf->SetY($i);
$pdf->SetX($xj);
$pdf->Cell($xx,$j,$usuario_alta_new,1,0,'L',1);
  }
if ($bandera==3)
  {
$pdf->SetY($i);
$pdf->SetX($xy);
$pdf->Cell($xx,$j,$usuario_alta_new,1,0,'L',1);
  }



  }//if bandera
 }//while beneficiarios
} //while cantidad
$pdf->SetY(-15);
//Select Arial italic 8
$pdf->SetFont('Arial','I',8);
 //Print current and total page numbers
$pdf->Cell(0,10,'Pagina '.$pdf->PageNo().'/{nb}',0,0,'C');
  

$pdf->AliasNbPages();
//Launch the print dialog
//$pdf->AutoPrint(true);
$pdf->Output();
?> 
