<?php
error_reporting ( E_ERROR ); 
   include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
	
  $error1='Esta informacion es necesaria';
  $error='Los  datos fueron mal ingresados';
     
  $apli = $_POST['apli'];
  $per = $_POST['per'];
   

  $persona_tipo='j';
  $cuitl = $_POST['cuitl_1'].$_POST['cuitl_2'].$_POST['cuitl_3'];
  $cuitl_1 = $_POST['cuitl_1'];
  $cuitl_2 =$_POST['cuitl_2'];
  $cuitl_3 = $_POST['cuitl_3'];
  $id_bene = $_POST['id_bene'];
  //datos de identificacion
  
  $razon_social = ucwords(strtolower($_POST['razon_social']));   
  
  //direccion fisica
  
  $direccion_calle_f = $_POST['direccion_calle_f'];
  $direccion_nro_f = $_POST['direccion_nro_f'];
  $direccion_piso_f = $_POST['direccion_piso_f'];
  $direccion_dpto_nro_f = $_POST['direccion_dpto_nro_f'];
  $direccion_localidad_f = $_POST['direccion_localidad_f'];
  $direccion_provincia_f = $_POST['direccion_provincia_f'];
  $codigo_postal_f = $_POST['codigo_postal_f'];
  
  //direccion real
  
  $direccion_calle_r = $_POST['direccion_calle_r'];
  $direccion_nro_r = $_POST['direccion_nro_r'];
  $direccion_piso_r = $_POST['direccion_piso_r'];
  $direccion_dpto_nro_r = $_POST['direccion_dpto_nro_r'];
  $direccion_localidad_r = $_POST['direccion_localidad_r'];
  $direccion_provincia_r = $_POST['direccion_provincia_r'];
  $codigo_postal_r = $_POST['codigo_postal_r'];
  
  //otros datos
  
 $telefono = $_POST['telefono1'].'-'.$_POST['telefono2'];
  $email = $_POST['email'];
  
  //banco
  
  $banco_nombre = $_POST['banco_nombre'];
  $banco_sucursal = $_POST['banco_sucursal'];
  $banco_cta_tipo = $_POST['banco_cta_tipo'];
  $banco_cta_nro = $_POST['banco_cta_nro'];
  $banco_cbu = $_POST['banco_cbu'];
  
 //datos economicos 
  $actividad_p=$_POST['actividad_p'];
  $actividad_s=$_POST['actividad_s'];
  $f_id_p=$_POST['f_id_p'];
  $f_im_p=$_POST['f_im_p'];
  $f_ia_p=$_POST['f_ia_p'];
  $fechai_p=$f_ia_p.'-'.$f_im_p.'-'.$f_id_p;
  $fechaia_p=$f_id_p.'-'.$f_im_p.'-'.$f_ia_p;
  $f_id_s=$_POST['f_id_s'];
  $f_im_s=$_POST['f_im_s'];
  $f_ia_s=$_POST['f_ia_s'];
  $fechai_s=$f_ia_s.'-'.$f_im_s.'-'.$f_id_s;
  $fechaia_s=$f_id_s.'-'.$f_im_s.'-'.$f_ia_s;
  
   if ($actividad_p == $actividad_s)
    {
	 $bandera =1; 
	}
  //datos comercial
 
  $f_ic=$_POST['f_dc'];
  $f_mc=$_POST['f_mc'];
  $f_ac=$_POST['f_ac'];
  $fechac_s=$f_ac.'-'.$f_mc.'-'.$f_ic;
  $fecha_contrato_s=$f_ic.'-'.$f_mc.'-'.$f_ac;
  $sociedad_tipo = $_POST['sociedad_tipo'];
  $ingreso_bruto = $_POST['ingreso_bruto_1'].$_POST['ingreso_bruto_2'].$_POST['ingreso_bruto_3'];
  $iva_situacion = $_POST['iva_situacion'];
  $ganancia = $_POST['ganancia'];
 // $alicuota = $_POST['alicuota'];
  $ingreso = $_POST['ingreso'];
  $regimen = $_POST['regimen'];
  $seguridad = $_POST['seguridad'];
$ingreso_bruto_ac = $_POST['ingreso_brutoc_1'].$_POST['ingreso_brutoc_2'].$_POST['ingreso_brutoc_3'];
  
  
  
  //componente de la sociedad
  
  $apellido1=$_POST['apellido1'];
  $nombre1=$_POST['nombre1'];
  $dni1=$_POST['dni1'];
  $cargo1=$_POST['cargo1'];

 
  $apellido2=$_POST['apellido2'];
  $nombre2=$_POST['nombre2'];
  $dni2=$_POST['dni2'];
  $cargo2=$_POST['cargo2'];
 
  $apellido3=$_POST['apellido3'];
  $nombre3=$_POST['nombre3'];
  $dni3=$_POST['dni3'];
  $cargo3=$_POST['cargo3'];
  
  $apellido4=$_POST['apellido4'];
  $nombre4=$_POST['nombre4'];
  $dni4=$_POST['dni4'];
  $cargo4=$_POST['cargo4'];
  
  $fecha_inicio_d1=$_POST['f_inicio_d1'];
  $fecha_inicio_m1=$_POST['f_inicio_m1'];
  $fecha_inicio_a1=$_POST['f_inicio_a1'];

  $fecha_inicio1=$fecha_inicio_a1.'-'.$fecha_inicio_m1.'-'.$fecha_inicio_d1;
  
  $fecha_inicio_d2=$_POST['f_inicio_d2'];
  $fecha_inicio_m2=$_POST['f_inicio_m2'];
  $fecha_inicio_a2=$_POST['f_inicio_a2'];
  
  $fecha_inicio2=$fecha_inicio_a2.'-'.$fecha_inicio_m2.'-'.$fecha_inicio_d2;
  
  $fecha_inicio_d3=$_POST['f_inicio_d3'];
  $fecha_inicio_m3=$_POST['f_inicio_m3'];
  $fecha_inicio_a3=$_POST['f_inicio_a3'];
  
  $fecha_inicio3=$fecha_inicio_a3.'-'.$fecha_inicio_m3.'-'.$fecha_inicio_d3;
  
  $fecha_inicio_d4=$_POST['f_inicio_d4'];
  $fecha_inicio_m4=$_POST['f_inicio_m4'];
  $fecha_inicio_a4=$_POST['f_inicio_a4'];
  
  $fecha_inicio4=$fecha_inicio_a4.'-'.$fecha_inicio_m4.'-'.$fecha_inicio_d4;
  
  $fecha_fin_d1=$_POST['f_fin_d1'];
  $fecha_fin_m1=$_POST['f_fin_m1'];
  $fecha_fin_a1=$_POST['f_fin_a1'];
  
 
  $duracion1=$fecha_fin_a1.'-'.$fecha_fin_m1.'-'.$fecha_fin_d1;
  
  $fecha_fin_d2=$_POST['f_fin_d2'];
  $fecha_fin_m2=$_POST['f_fin_m2'];
  $fecha_fin_a2=$_POST['f_fin_a2'];
  
 
  $duracion2=$fecha_fin_a2.'-'.$fecha_fin_m2.'-'.$fecha_fin_d2;
  

  $fecha_fin_d3=$_POST['f_fin_d3'];
  $fecha_fin_m3=$_POST['f_fin_m3'];
  $fecha_fin_a3=$_POST['f_fin_a3'];
  
 
  $duracion3=$fecha_fin_a3.'-'.$fecha_fin_m3.'-'.$fecha_fin_d3;  
  
  $fecha_fin_d4=$_POST['f_fin_d4'];
  $fecha_fin_m4=$_POST['f_fin_m4'];
  $fecha_fin_a4=$_POST['f_fin_a4'];
  
 
  $duracion4=$fecha_fin_a4.'-'.$fecha_fin_m4.'-'.$fecha_fin_d4;

 $observacion = $_POST['observacion'];
  
 //datos de alta web 
 
  $fecha_alta_web = date("d/m/Y");
 
 
 ////componente ute
  
  
    $cuit1_u = $_POST['cuit1_u'];
    $cuit2_u = $_POST['cuit2_u'];
    $cuit3_u = $_POST['cuit3_u'];
    $cuit4_u = $_POST['cuit4_u'];
	$cuit5_u = $_POST['cuit5_u'];
    $cuit6_u = $_POST['cuit6_u']; 
	
	
	$razon1_u = $_POST['razon1_u'];
    $razon2_u = $_POST['razon2_u'];
    $razon3_u = $_POST['razon3_u'];
    $razon4_u = $_POST['razon4_u'];
	$razon5_u = $_POST['razon5_u'];
    $razon6_u = $_POST['razon6_u']; 
	
	$dom1_u = $_POST['dom1_u'];
    $dom2_u = $_POST['dom2_u'];
    $dom3_u = $_POST['dom3_u'];
    $dom4_u = $_POST['dom4_u'];
	$dom5_u = $_POST['dom5_u'];
    $dom6_u = $_POST['dom6_u'];
	
	$por1_u = $_POST['por1_u'];
    $por2_u = $_POST['por2_u'];
    $por3_u = $_POST['por3_u'];
    $por4_u = $_POST['por4_u'];
	$por5_u = $_POST['por5_u'];
    $por6_u = $_POST['por6_u']; 
	
  $fecha_alta_web = date("d/m/Y");
 
	
   $ssql = "SELECT * FROM `actividad` where id_actividad='$actividad_p'";
     if (!($r_actividad_p= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar actividad";
      echo $cuerpo1;
      //.....................................................................
    }  
	
	 $ssql = "SELECT * FROM `actividad` where id_actividad='$actividad_s'";
     if (!($r_actividad_s= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar actividad";
      echo $cuerpo1;
      //.....................................................................
    }  
   
	 $ssql = "SELECT * FROM `provincias` WHERE codprovincia='$direccion_provincia_f'";
     if (!($r_provincia_f= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar provincia";
      echo $cuerpo1;
      //.....................................................................
    }    
	
	//
	
	$ssql = "SELECT * FROM `provincias` WHERE codprovincia='$direccion_provincia_r'";
     if (!($r_provincia_r= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar provincia";
      echo $cuerpo1;
      //.....................................................................
    }  
	
		
	$ssql = "SELECT * FROM `localidades` WHERE id_localidades='$direccion_localidad_r'";
     if (!($r_localidad_r= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar provincia";
      echo $cuerpo1;
      //.....................................................................
    } 
	
	$ssql = "SELECT * FROM `localidades` WHERE id_localidades='$direccion_localidad_f'";
     if (!($r_localidad_f= mysql_query($ssql, $conexion_mysql)))
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
	
	
	$ssql = "SELECT * FROM ganancias where id_ganancia='$ganancia'  order by nombre";
     if (!($r_ganancia= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de iva";
      echo $cuerpo1;
      //.....................................................................
    }        

  $ssql = "SELECT * FROM ingreso_bruto  where id_ingreso='$ingreso' order by nombre ";
     if (!($r_ingreso= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de iva";
      echo $cuerpo1;
      //.....................................................................
    }  
	
	$ssql = "SELECT * FROM regimen where id_regimen='$regimen' order by nombre ";
     if (!($r_regimen= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de iva";
      echo $cuerpo1;
      //.....................................................................
    }   
	
	$ssql = "SELECT * FROM alicuota where id_alicuota='$alicuota'  order by nombre";
     if (!($r_alicuota= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de iva";
      echo $cuerpo1;
      //.....................................................................
    } 
	
	$ssql = "SELECT * FROM seguridad_social where id_seguridad='$seguridad'  order by nombre ";
     if (!($r_seguridad= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de iva";
      echo $cuerpo1;
      //.....................................................................
    }          
    
//verificacion de datos/////
	
   	  	
//ingreso_bruto
	$patron = "[[:digit:]]{10}";
	if (!(ereg($patron, $ingreso_bruto)))
		{
		
		    $bandera =1; 
			$bandera_ingreso_bruto = 1;
    	}		

//razon social
    $patron = "^[[:alpha:]]+([[:space:]]?[[:alpha:]])*$"; 
	if (!(ereg($patron, $_POST['razon_social'])) )
	    {
		
		    $bandera =1; 
			$bandera_razonsocial = 1;
		}



//direccion calle 

   if ($direccion_calle_f =="" )
    	{
		
     		$bandera =1; 
			$bandera_calle_f = 1;
        }
		
 
		
	 if ($direccion_calle_r =="" )
    	{
		
     		$bandera =1; 
			$bandera_calle_r = 1;
        }
		
   
		
	if ($direccion_provincia_f =='N')
	     {
		 
		  $bandera=1;
		 }
	if ($direccion_provincia_r =='N')
	     {
		
		  $bandera=1;
		 }
	if ($direccion_localidad_f =='S')
	     {
		 
		 		  $bandera=1;
		 }
	if ($direccion_localidad_r =='S')
	     {
		
		  $bandera=1;
		 }	 
		 	
   $patron = "[[:digit:]]";
	if (!(ereg($patron, $telefono)))
		{
		
		    $bandera =1; 
			$bandera_telefono = 1;
    	}				
//telefono

    if ($telefono=='-')
	   {
	  
	     $bandera=1;
		}
	else
	   {	 
	$patron = "[[:digit:]]{3,5}";
	if (!(ereg($patron, $_POST['telefono1'])))
		{
		
		    $bandera=1; 
			$bandera_telefono=1;
    	}	
	$patron = "[[:digit:]]{6,9}";
	if (!(ereg($patron, $_POST['telefono2'])))
		{
		
		    $bandera=1; 
			$bandera_telefono=1;
    	}			
      } 


 //fecha actividad 1
   $patron = "([0-9]{2})-([0-9]{2})-([0-9]{4})";
	 
	$patron = "([0-9]{2})-([0-9]{2})-([0-9]{4})";
	 
	if (!(ereg($patron, $fechaia_p)) )
    	{
		echo 'paso8';
     		$bandera =1; 
			$bandera_fecha_p = 1;
        }				
   			
   //fecha actividad 2
   $patron = "([0-9]{2})-([0-9]{2})-([0-9]{4})";
	 
	if (!(ereg($patron, $fechaia_s)) )
    	{
     	 $bandera_fecha_s = 1;
        }
			
   //fecha contrato social
   
     $patron = "([0-9]{2})-([0-9]{2})-([0-9]{4})";
	 
	if (!(ereg($patron, $fecha_contrato_s)) )
    	{
		echo 'paso7';
     		$bandera =1; 
			$bandera_fecha_contrato = 1;
        } 


//nro de convenio 

	$patron = "[[:digit:]]";
	if(!($convenio_nro==''))
	  {
	if (!(ereg($patron, $convenio_nro)))
		{
		   $bandera_convenio_nro = 1;
    	}
	   }					
		
//apellido

    $patron = "^[[:alpha:]]+([[:space:]]?[[:alpha:]])*$"; 
	if (!(ereg($patron, $_POST['apellido1'])) )
    	{
		    $bandera=1;
			$bandera_apellido1 = 1;
        }
	
  if (!($_POST['apellido2']==''))	
	   {
	if (!(ereg($patron, $_POST['apellido2'])) )
    	{
		    $bandera_apellido2 = 1;
        }
	   }
	   
 if (!($_POST['apellido3']==''))	
	   {	   	
	if (!(ereg($patron, $_POST['apellido3'])) )
    	{

			$bandera_apellido3 = 1;
        }
	  }
	 
if (!($_POST['apellido4']==''))	
	   {	  			
   if (!(ereg($patron, $_POST['apellido4'])) )
    	{
		    $bandera_apellido4 = 1;
        }
       }
	   
//nombre

    $patron = "^[[:alpha:]]+([[:space:]]?[[:alpha:]])*$"; 
	if (!(ereg($patron, $_POST['nombre1'])) )
    	{
		    $bandera=1;
			$bandera_nombre1 = 1;
        }
		
if (!($_POST['nombre2']==''))	
	   {
	if (!(ereg($patron, $_POST['nombre2'])) )
    	{
		    $bandera_nombre2 = 1;
        }
	   }	
		
 if (!($_POST['nombre3']==''))	
	   {    
	 if (!(ereg($patron, $_POST['nombre3'])) )
    	{
		   $bandera_nombre3 = 1;
        }
	   }	
		
  if (!($_POST['nombre4']==''))	
	   {		
     if (!(ereg($patron, $_POST['nombre4'])) )
    	{
		   $bandera_nombre4 = 1;
        }
	   }	
	
//cargo

    $patron = "^[[:alpha:]]+([[:space:]]?[[:alpha:]])*$"; 
	if (!(ereg($patron, $_POST['cargo1'])) )
    	{
		    $bandera=1;
			$bandera_cargo1 = 1;
        }
		
if (!($_POST['cargo2']==''))	
	   {
	if (!(ereg($patron, $_POST['cargo2'])) )
    	{
		    $bandera_cargo2 = 1;
        }
	   }	
		
 if (!($_POST['cargo3']==''))	
	   {    
	 if (!(ereg($patron, $_POST['cargo3'])) )
    	{
		   $bandera_cargo3 = 1;
        }
	   }	
		
  if (!($_POST['cargo4']==''))	
	   {		
     if (!(ereg($patron, $_POST['cargo4'])) )
    	{
		   $bandera_cargo4 = 1;
        }
	   }	


//doc numero
		
	$patron = "[[:digit:]]{6,8}";
	 if (!($_POST['dni1']==''))	
	   {		
	if (!(ereg($patron, $_POST['dni1'])) )
    	{
		echo 'paso6';
     		$bandera=1;
			$bandera_dni1 = 1;
        }
	   }	
		
	if (!($_POST['dni2']==''))
	   {			
	if (!(ereg($patron, $_POST['dni2'])) )
    	{
     		
			$bandera_dni2 = 1;
        }
	 }	
	
	if (!($_POST['dni3']==''))	
	   {
	if (!(ereg($patron, $_POST['dni3'])) )
    	{
     		
			$bandera_dni3 = 1;
        }
	 }	
	
	if (!($_POST['dni4']==''))	
	   {
	 if (!(ereg($patron, $_POST['dni4'])) )
    	{
     		
			$bandera_dni4 = 1;
        }			
       }
		
	if($fechac_s > $fechai_p )
       { 
	   echo 'paso5';
	   $bandera=1;	
	   }
	
	if ($banco_cta_tipo =='N')
	    {
		echo 'paso4';
		$bandera=1;
		}
			
	if ($banco_nombre=='N')
	    {
		echo 'paso3';
		$bandera=1;
		}
		
	 
			
	if ($iva_situacion =='N')
	   {
	   echo 'paso3';
	     $bandera=1;	
	   }	
	  
   if ($sociedad_tipo =='N')
       {
	   echo 'paso2';
	   $bandera=1;
	   }
	   
	 if ($actividad_p =='N')
	   {
	   echo 'paso1';
	   $bandera=1;
	   }  
  

////ute

if($sociedad_tipo=='16')
  {
		
	$patron = "[[:digit:]]{11}";
	 if (!($_POST['cuit1_u']==''))	
	   {		
	if (!(ereg($patron, $_POST['cuit1_u'])) )
    	{
     		$bandera=1;
			$bandera_cuit1_u = 1;
        }
	   }
	   
	   
	 
	 if (!($_POST['cuit2_u']==''))	
	   {		
	if (!(ereg($patron, $_POST['cuit2_u'])) )
    	{
     		$bandera=1;
			$bandera_cuit2_u = 1;
        }
	   
	   }	
	   
	    if (!($_POST['cuit3_u']==''))	
	   {		
	if (!(ereg($patron, $_POST['cuit3_u'])) )
    	{
     		$bandera=1;
			$bandera_cuit3_u = 1;
        }
	   
	   }	
	   
	    if (!($_POST['cuit4_u']==''))	
	   {		
	if (!(ereg($patron, $_POST['cuit4_u'])) )
    	{
     		$bandera=1;
			$bandera_cuit4_u = 1;
        }
	   
	   }
	   
	    if (!($_POST['cuit5_u']==''))	
	   {		
	if (!(ereg($patron, $_POST['cuit5_u'])) )
    	{
     		$bandera=1;
			$bandera_cuit5_u = 1;
        }
	   
	   }
	   
	    if (!($_POST['cuit6_u']==''))	
	   {		
	if (!(ereg($patron, $_POST['cuit6_u'])) )
    	{
     		$bandera=1;
			$bandera_cuit6_u = 1;
        }
	   
	   }	
		
	/*
  
	 if (!($_POST['razon1_u']==''))	
	   {
	
	
		    $bandera=1;
			$bandera_razon1_u = 1;
        }	
	   
	   
	   if (!($_POST['razon2_u']==''))	
	   {
		if (!(ereg($patron, $_POST['razon2_u'])) )
    	{
		    $bandera=1;
			$bandera_razon2_u = 1;
        }
		
	   }
	   
	    if (!($_POST['razon3_u']==''))	
	   {
		if (!(ereg($patron, $_POST['razon3_u'])) )
    	{
		    $bandera=1;
			$bandera_razon3_u = 1;
        }
		
	   }
	   
	    if (!($_POST['razon4_u']==''))	
	   {
		if (!(ereg($patron, $_POST['razon4_u'])) )
    	{
		    $bandera=1;
			$bandera_razon4_u = 1;
        }
		
	   }
	   
	    if (!($_POST['razon5_u']==''))	
	   {
		if (!(ereg($patron, $_POST['razon5_u'])) )
    	{
		    $bandera=1;
			$bandera_razon5_u = 1;
        }
		
	   }
	   
	   if (!($_POST['razon6_u']==''))	
	   {
		if (!(ereg($patron, $_POST['razon6_u'])) )
    	{
		    $bandera=1;
			$bandera_razon6_u = 1;
        }
		
	   } 
	   
	    if (!($_POST['dom1_u']==''))	
	   {
		if (!(ereg($patron, $_POST['dom1_u'])) )
    	{
		    $bandera=1;
			$bandera_dom1_u = 1;
        }
		
	   } 
	    if (!($_POST['dom2_u']==''))	
	   {
		if (!(ereg($patron, $_POST['dom2_u'])) )
    	{
		    $bandera=1;
			$bandera_dom2_u = 1;
        }
		
	   } 
	    if (!($_POST['dom3_u']==''))	
	   {
		if (!(ereg($patron, $_POST['dom3_u'])) )
    	{
		    $bandera=1;
			$bandera_dom3_u = 1;
        }
		
	   } 
	   
	    if (!($_POST['dom4_u']==''))	
	   {
		if (!(ereg($patron, $_POST['dom4_u'])) )
    	{
		    $bandera=1;
			$bandera_dom4_u = 1;
        }
		
	   } 
	   
	    if (!($_POST['dom5_u']==''))	
	   {
		if (!(ereg($patron, $_POST['dom5_u'])) )
    	{
		    $bandera=1;
			$bandera_dom5_u = 1;
        }
		
	   } 
	   
	    if (!($_POST['dom6_u']==''))	
	   {
		if (!(ereg($patron, $_POST['dom6_u'])) )
    	{
		    $bandera=1;
			$bandera_dom6_u = 1;
        }
		
	   }*/
	   
	   $patron = "[[:digit:]]{2,3}";
	    if (!($_POST['por1_u']==''))	
	   {
		if (!(ereg($patron, $_POST['por1_u'])) )
    	{
		    $bandera=1;
			$bandera_por1_u= 1;
        }
		
	   } 
	   
	    if (!($_POST['por2_u']==''))	
	   {
		if (!(ereg($patron, $_POST['por2_u'])) )
    	{
		    $bandera=1;
			$bandera_por2_u = 1;
        }
		
	   } 
	   
	    if (!($_POST['por3_u']==''))	
	   {
		if (!(ereg($patron, $_POST['por3_u'])) )
    	{
		    $bandera=1;
			$bandera_por3_u = 1;
        }
		
	   } 
	   
	    if (!($_POST['por4_u']==''))	
	   {
		if (!(ereg($patron, $_POST['por4_u'])) )
    	{
		    $bandera=1;
			$bandera_por4_u = 1;
        }
		
	   } 
	   
	    if (!($_POST['por5_u']==''))	
	   {
		if (!(ereg($patron, $_POST['por5_u'])) )
    	{
		    $bandera=1;
			$bandera_por5_u = 1;
        }
		
	   } 
	   
	    if (!($_POST['por6_u']==''))	
	   {
		if (!(ereg($patron, $_POST['por6_u'])) )
    	{
		    $bandera=1;
			$bandera_por6_u = 1;
        }
		
	   } 
	   
  }
?>


<div class="content">

<?php
     if ($bandera ==1)
	   {
?>	   
       <form action="indextesoreria.php?sec=contaduria/modificar_j&apli=<?php echo $apli; ?>&per=<?php echo $per; ?>" method="post">
<?php
	   }
	 else
	   {
?>	     
<form action="indextesoreria.php?sec=contaduria/update_j" method="post">
<?php 
        }
?>	
<input type="hidden" value="<?php echo $id_bene;?>"  name="id_bene" >

<input type="hidden" value="<?php echo $cuitl;?>"  name="cuitl" size="2" maxlength="2">
<input type="hidden" value="<?php echo $cuitl_1;?>"  name="cuitl_1" size="2" maxlength="2">
<input type="hidden" value="<?php echo $cuitl_2;?>"  name="cuitl_2" size="2" maxlength="2">
<input type="hidden" value="<?php echo $cuitl_3;?>"  name="cuitl_3" size="2" maxlength="2">
<input type="hidden" name="id_bene" value="<?php echo $id_bene; ?>" >

<!--datos identificacion -->
<input type="hidden" value="<?php echo $razon_social;?>"  name="razon_social">

<!--domicilio fiscal -->
<input type="hidden"  value="<?php echo $direccion_calle_f;?>" name="direccion_calle_f" size="30">
<input type="hidden" value="<?php echo  $direccion_nro_f;?>" name="direccion_nro_f" size="5">
<input type="hidden"  value="<?php echo $direccion_piso_f ;?>" name="direccion_piso_f" size="5">
<input type="hidden" value="<?php echo $direccion_dpto_nro_f;?>" name="direccion_dpto_nro_f" />
<input type="hidden" value="<?php echo $direccion_localidad_f ;?>" name="direccion_localidad_f" />
<input type="hidden" value="<?php echo $direccion_provincia_f; ?>" name="direccion_provincia_f" />
<input type="hidden" value="<?php echo $codigo_postal_f; ?>" name="codigo_postal_f" />

<!--domicilio real -->
<input type="hidden"  value="<?php echo $direccion_calle_r;?>" name="direccion_calle_r" size="30">
<input type="hidden" value="<?php echo  $direccion_nro_r;?>" name="direccion_nro_r" size="5">
<input type="hidden"  value="<?php echo $direccion_piso_r ;?>" name="direccion_piso_r" size="5">
<input type="hidden" value="<?php echo $direccion_dpto_nro_r;?>" name="direccion_dpto_nro_r" />
<input type="hidden" value="<?php echo $direccion_localidad_r ;?>" name="direccion_localidad_r" />
<input type="hidden" value="<?php echo $direccion_provincia_r; ?>" name="direccion_provincia_r" />
<input type="hidden" value="<?php echo $codigo_postal_r; ?>" name="codigo_postal_r" />

<!--otros datos -->
<input type="hidden" value="<?php echo $telefono; ?>" name="telefono" />
<input type="hidden" value="<?php echo $email; ?>" name="email"  />

<!--datos banco -->
<input type="hidden" value="<?php echo $banco_nombre; ?>" name="banco_nombre" />
<input type="hidden" value="<?php echo $banco_sucursal; ?>" name="banco_sucursal" />
<input type="hidden" value="<?php echo $banco_cta_tipo;?>" name="banco_cta_tipo" />
<input type="hidden" value="<?php echo $banco_cta_nro; ?>" name="banco_cta_nro"  />
<input type="hidden" value="<?php echo $banco_cbu; ?>" name="banco_cbu"  />

<!--datos economicos -->
<input type="hidden" value="<?php echo $actividad_p; ?>" name="actividad_p" />
<input type="hidden" value="<?php echo $actividad_s; ?>" name="actividad_s" />
<input type="hidden" value="<?php echo $fechai_p; ?>" name="fechai_p" />
<input type="hidden" value="<?php echo $fechai_s; ?>" name="fechai_s" />

<!-- actividad comercial -->
<input type="hidden" value="<?php echo $fechac_s; ?>" name="fechac_s" />
<input type="hidden" value="<?php echo $sociedad_tipo; ?>" name="sociedad_tipo" />
<input type="hidden" value="<?php echo $persona_tipo; ?>" name="persona_tipo" />
<input type="hidden" value="<?php echo $ingreso_bruto; ?>" name="ingreso_bruto"  />
<input type="hidden" value="<?php echo $iva_situacion; ?>" name="iva_situacion" />
<input type="hidden" value="<?php echo $ganancia; ?>" name="ganancia" />

<!--<input type="hidden" value="<?php //echo $alicuota; ?>" name="alicuota" />
 -->
<input type="hidden" value="<?php echo $ingreso; ?>" name="ingreso" />
<input type="hidden" value="<?php echo $regimen; ?>" name="regimen" />
<input type="hidden" value="<?php echo $seguridad; ?>" name="seguridad" />
<input type="hidden" value="<?php echo $ingreso_bruto_ac; ?>" name="ingreso_bruto_ac" />

<!--componentes de la sociedad -->
<input type="hidden" value="<?php echo $apellido1; ?>" name="apellido1" />
<input type="hidden" value="<?php echo $apellido2; ?>" name="apellido2" />
<input type="hidden" value="<?php echo $apellido3; ?>" name="apellido3" />
<input type="hidden" value="<?php echo $apellido4; ?>" name="apellido4" />

<input type="hidden" value="<?php echo $nombre1; ?>" name="nombre1" />
<input type="hidden" value="<?php echo $nombre2; ?>" name="nombre2" />
<input type="hidden" value="<?php echo $nombre3; ?>" name="nombre3" />
<input type="hidden" value="<?php echo $nombre4; ?>" name="nombre4" />

<input type="hidden" value="<?php echo $dni1; ?>" name="dni1" />
<input type="hidden" value="<?php echo $dni2; ?>" name="dni2" />
<input type="hidden" value="<?php echo $dni3; ?>" name="dni3" />
<input type="hidden" value="<?php echo $dni4; ?>" name="dni4" />

<input type="hidden" value="<?php echo $cargo1; ?>" name="cargo1" />
<input type="hidden" value="<?php echo $cargo2; ?>" name="cargo2" />
<input type="hidden" value="<?php echo $cargo3; ?>" name="cargo3" />
<input type="hidden" value="<?php echo $cargo4; ?>" name="cargo4" />

<input type="hidden" value="<?php echo $fecha_inicio1; ?>" name="fecha_inicio1" />
<input type="hidden" value="<?php echo $fecha_inicio2; ?>" name="fecha_inicio2" />
<input type="hidden" value="<?php echo $fecha_inicio3; ?>" name="fecha_inicio3" />
<input type="hidden" value="<?php echo $fecha_inicio4; ?>" name="fecha_inicio4" />

<input type="hidden" value="<?php echo $duracion1; ?>" name="duracion1" />
<input type="hidden" value="<?php echo $duracion2; ?>" name="duracion2" />
<input type="hidden" value="<?php echo $duracion3; ?>" name="duracion3" />
<input type="hidden" value="<?php echo $duracion4; ?>" name="duracion4" />

<input type="hidden" value="<?php echo $observacion; ?>" name="observacion" />

<!--datos para sistema -->
<input type="hidden" value="<?php echo $fecha_alta_web;?>" name="fecha_alta_web" />

<!--datos para ute -->
<input type="hidden" value="<?php echo $cuit1_u; ?>" name="cuit1_u" />
<input type="hidden" value="<?php echo $cuit2_u; ?>" name="cuit2_u" />
<input type="hidden" value="<?php echo $cuit3_u; ?>" name="cuit3_u" />
<input type="hidden" value="<?php echo $cuit4_u; ?>" name="cuit4_u" />
<input type="hidden" value="<?php echo $cuit5_u; ?>" name="cuit5_u" />
<input type="hidden" value="<?php echo $cuit6_u; ?>" name="cuit6_u" />

<input type="hidden" value="<?php echo $razon1_u; ?>" name="razon1_u" />
<input type="hidden" value="<?php echo $razon2_u; ?>" name="razon2_u" />
<input type="hidden" value="<?php echo $razon3_u; ?>" name="razon3_u" />
<input type="hidden" value="<?php echo $razon4_u; ?>" name="razon4_u" />
<input type="hidden" value="<?php echo $razon5_u; ?>" name="razon5_u" />
<input type="hidden" value="<?php echo $razon6_u; ?>" name="razon6_u" />

<input type="hidden" value="<?php echo $dom1_u; ?>" name="dom1_u" />
<input type="hidden" value="<?php echo $dom2_u; ?>" name="dom2_u" />
<input type="hidden" value="<?php echo $dom3_u; ?>" name="dom3_u" />
<input type="hidden" value="<?php echo $dom4_u; ?>" name="dom4_u" />
<input type="hidden" value="<?php echo $dom5_u; ?>" name="dom5_u" />
<input type="hidden" value="<?php echo $dom6_u; ?>" name="dom6_u" />

<input type="hidden" value="<?php echo $por1_u; ?>" name="por1_u" />
<input type="hidden" value="<?php echo $por2_u; ?>" name="por2_u" />
<input type="hidden" value="<?php echo $por3_u; ?>" name="por3_u" />
<input type="hidden" value="<?php echo $por4_u; ?>" name="por4_u" />
<input type="hidden" value="<?php echo $por5_u; ?>" name="por5_u" />
<input type="hidden" value="<?php echo $por6_u; ?>" name="por6_u" />






<table border="0" align="center">
    <tr>
		<td colspan="2"><h1> Validacion Modificacion de Persona Juridica</h1></td>
	</tr>
	<tr height=10px>
			<td colspan="2"><hr></td>
		</tr>
	<tr>
		<td class="subtitle">Nro. CUIL | CUIT</td>
		<input type="hidden" name="cuitl" value="<?php echo $cuitl;?>">
		<td>
<?php 
                echo $cuitl;  if ($bandera_cuitl ==1)
		                         { 
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000"><?php echo $error;?></font>
<?php
                                 }   
 ?>		  </td>
		</tr>
		<tr height=10px>
			<td colspan="2"><hr></td>
		</tr>
		<tr bgcolor="#EAEAEA">
			<td colspan="2"><h3>Datos de Identificacion</h3></td>
		</tr>
		<tr height=10px>
			<td colspan="2"></td>
		</tr>
		<tr>
			<td class="subtitle">Denominacion de la Entidad</td>
			<td>
<?php
                    echo $razon_social; 
				    if($razon_social=='')
				      {
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000"><?php echo $error1;?></font>
<?php
                       }
					      
 	               else
				       {  
					    if ($bandera_razonsocial==1)
		                         { 
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000"><?php echo $error;?>								  </font>
<?php                            
                                 }
						}		 
?>             </td>
		</tr>
		
		<tr height=10px>
			<td colspan="2"></td>
		</tr>
		<tr bgcolor="#EAEAEA">
			<td colspan="2"><h3>Domicilio Fiscal</h3></td>
		</tr>
		<tr height=20px>
			<td colspan="2"></td>
		</tr>
		<tr>
		  <td class="subtitle">Calle</td>
		  <td><?php echo $direccion_calle_f;
		         if($direccion_calle_f=='')
				      {
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000"><?php echo $error1;?></font>
<?php
                       }
					      
 	               else
				       {
                       if ($bandera_calle_f == 1)
	                    { 
?>
					  <img  src="../img/ic_advertencia.gif" border="0"></img> 
					  <font color="#FF0000">
					   <?php echo $error;?>					  </font>
<?php       
                        }
				}		  			   
		
?>		   </td>
		</tr>
		<tr>
	     <td class="subtitle">Numero</td>
		 <td><?php echo $direccion_nro_f; ?>  </td>
		</tr>
		<tr>
		 <td class="subtitle">Piso</td>
	     <td><?php echo $direccion_piso_f;?></td>
		</tr>
		<tr>
	 	  <td class="subtitle">Departamento Nro.</td>
		  <td><?php echo $direccion_dpto_nro_f;?></td>
		</tr>
		<tr>
			<td class="subtitle">Provincia</td>
			<td>
<?php
			 $f_provincia_f= mysql_fetch_array ($r_provincia_f);
             echo $f_provincia_f['nombre'];  if ($direccion_provincia_f =='N')
		          { 
?>
					  <img  src="../img/ic_advertencia.gif" border="0"></img> 
					  <font color="#FF0000">
					 <?php echo $error1;?>					  </font>
<?php                                }  			   
			   
?>   		    </td>
		</tr>
		
		<tr>
			<td class="subtitle">Localidad</td>
			<td>
<?php
			  $f_localidad_f = mysql_fetch_array ($r_localidad_f);
			  echo $f_localidad_f['descripcion'];
                if ($direccion_localidad_f=='S')
		          { 
?>
					  <img  src="../img/ic_advertencia.gif" border="0"></img> 
					  <font color="#FF0000">
					   <?php echo $error1;?>					  </font>
<?php                                }  			   
			   
?>   					</td>
		</tr>
		
		<tr>
			<td class="subtitle">Codigo Postal</td>
			<td><?php echo $codigo_postal_f; ?></td>
		</tr>
		<tr height=10px>
			<td colspan="2"></td>
		</tr>
		<tr bgcolor="#EAEAEA">
			<td colspan="2"><h3>Domicilio Real</h3></td>
		</tr>
		<tr height=20px>
			<td colspan="2"></td>
		</tr>
		<tr>
		  <td class="subtitle">Calle</td>
		  <td><?php echo $direccion_calle_r;
		          if($direccion_calle_r=='')
				      {
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000"><?php echo $error1;?></font>
<?php
                       }
					      
 	               else
				       {
                       if ($bandera_calle_r == 1)
	                      { 
?>
					  <img  src="../img/ic_advertencia.gif" border="0"></img> 
					  <font color="#FF0000">
					   <?php echo $error;?>					  </font>
<?php       
                          }  
						}  			   
		
?>		   </td>
		</tr>
		<tr>
	     <td class="subtitle">Numero</td>
		 <td><?php echo $direccion_nro_r;?>      </td>
		</tr>
		<tr>
		 <td class="subtitle">Piso</td>
	     <td><?php echo $direccion_piso_r;?></td>
		</tr>
		<tr>
	 	  <td class="subtitle">Departamento Nro.</td>
		  <td><?php echo $direccion_dpto_nro_r;?></td>
		</tr>
		<tr>
			<td class="subtitle">Provincia</td>
			<td>
<?php
			 $f_provincia_r= mysql_fetch_array ($r_provincia_r);
             echo $f_provincia_r['nombre'];  if ($direccion_provincia_r =='N')
		          { 
?>
					  <img  src="../img/ic_advertencia.gif" border="0"></img> 
					  <font color="#FF0000">
					 <?php echo $error1;?>					  </font>
<?php                                }  			   
			   
?>   		    </td>
		</tr>
		
		<tr>
			<td class="subtitle">Localidad</td>
			<td>
<?php
			  $f_localidad_r= mysql_fetch_array ($r_localidad_r);
			  echo $f_localidad_r['descripcion'];
                if ($direccion_localidad_r =='S')
		          { 
?>
					  <img  src="../img/ic_advertencia.gif" border="0"></img> 
					  <font color="#FF0000">
					   <?php echo $error1;?>					  </font>
<?php                                }  			   
			   
?>   					</td>
		</tr>
		
		<tr>
			<td class="subtitle">Codigo Postal</td>
			<td><?php echo $codigo_postal_r; ?></td>
		</tr>
		
		<tr height=10px>
			<td colspan="2"></td>
		</tr>
		<tr bgcolor="#EAEAEA">
			<td colspan="2"><h3>Otros Datos</h3></td>
		</tr>
		<tr height=20px>
			<td colspan="2"></td>
		</tr>
		<tr>
			<td class="subtitle">Telefono</td>
			<td><?php echo $telefono;
			   if($telefono=='-')
				      {
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000"><?php echo $error1;?></font>
<?php
                       }
					      
 	               else
				       {
			if ($bandera_telefono == 1)
	               { 
?>
					  <img  src="../img/ic_advertencia.gif" border="0"></img> 
					  <font color="#FF0000">
					   <?php echo $error;?>					  </font>
<?php       
                   }
				  }   	 ?></td>
		</tr>
		<tr>
			<td class="subtitle">Direccion E-mail</td>
			<td><?php echo $email; ?>  </td>
		</tr>
		<tr height=10px>
			<td colspan="2"></td>
		</tr>
		<tr bgcolor="#EAEAEA">
			<td colspan="2"><h3>Datos Economicos</h3></td>
		</tr>
		<tr height=20px>
			<td colspan="2"></td>
		</tr>
		<tr>
			<td class="subtitle">Actividad Principal</td>
			<td>
		  <?php     
       
                   $f_actividad_p = mysql_fetch_array ($r_actividad_p);
                    echo $f_actividad_p['nombre_actividad']; 
					if ($actividad_p =='N')
		          { 
?>
					  <img  src="../img/ic_advertencia.gif" border="0"></img> 
					  <font color="#FF0000">
					  <?php echo $error1;?>					  </font>
<?php                                }  			   
			   
?>   	    </td>
		</tr>
		
		<tr>
			<td class="subtitle">Fecha Inicio de Actividad 1º </td>
			<td><?php echo $fechaia_p; 
			 if($fechaia_p=='-----------')
				      {
					    $bandera=1;
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000"><?php echo $error1;?></font>
<?php
                       }
					      
 	               else
				       { 
					   if ($bandera_fecha_p == 1)
	                     { 
?>
					  <img  src="../img/ic_advertencia.gif" border="0"></img> 
					  <font color="#FF0000">
					   <?php echo $error;?>					  </font>
<?php       
                         }
					}	   			   
		
?>			</td>
		</tr>
        <tr>
     		<td class="subtitle">Actividad Secundaria</td>
			<td>
<?php     
              $f_actividad_s = mysql_fetch_array ($r_actividad_s);
			  echo $f_actividad_s['nombre_actividad']; 
			  if (!($actividad_p=='N'))
			     {     
              if ( $f_actividad_s['nombre_actividad']== $f_actividad_p['nombre_actividad'])
				  {
?>
                              <img  src="../img/ic_advertencia.gif" border="0"></img> 
						      <font color="#FF0000"><?php echo 'Selecciono igual actividad que la Actividad Primaria';
							   $bandera=1;?></font>
<?php				  
				  }
				  
                }								   
			                 
?>   	    </td>
		</tr>
		
		<tr>
			<td class="subtitle">Fecha Inicio de Actividad 2º</td>
			<td> <?php  echo $fechaia_s;
			            if (!($actividad_s=='N'))
		                 	{ 
			                 if($fechaia_s=='-----------')
				                {
						          $bandera=1;
?>
                              <img  src="../img/ic_advertencia.gif" border="0"></img> 
						      <font color="#FF0000"><?php echo $error1;?></font>
<?php
                                }
						     else
						        { 
					            if ($bandera_fecha_s == 1)
	                               { 
?>
					  <img  src="../img/ic_advertencia.gif" border="0"></img> 
					  <font color="#FF0000">
					   <?php echo $error;?>					  </font>
<?php       
                                   }
								} 
							if (!($bandera_fecha_s==1) and ($bandera==1)) 	  
							   {
							     if (($fechai_s == $fechai_p))
								  {
								  if ($fechai_s < $fechai_p)
								   {
?>
					  <img  src="../img/ic_advertencia.gif" border="0"></img> 
					  <font color="#FF0000">
					   <?php echo 'La fecha de la actividad Secundaria no puede ser Inferiror a la fecha de actividad Primaria';?>					  </font>
<?php  								   
								   }
							    }
							   }
							 
						   	 }		   
		                   else
							 { 
					          if(!($fechaia_s=='-----------'))
							   {
							    if ($bandera_fecha_s == 1)
								  {
?>
					  <img  src="../img/ic_advertencia.gif" border="0"></img> 
					  <font color="#FF0000">
					   <?php echo $error;?><br /> <?php echo 'No puede Seleccionar fecha sin seleccionar la actividad' ;?> 					  </font>
<?php       
						     	  }
							  else 
							      {
?>
					  <img  src="../img/ic_advertencia.gif" border="0"></img> 
					  <font color="#FF0000">
					   <?php echo 'Selecciono fecha sin seleccionar la actividad 2º';?>					  </font>
<?php       
                                  }									
							    }
							  }		
?>			</td>
		</tr>
        <tr height=10px>
			<td colspan="2"></td>
		</tr>
		<tr bgcolor="#EAEAEA">
			<td colspan="2"><h3>Datos Comerciales</h3></td>
		</tr>
		<tr height=20px>
			<td colspan="2"></td>
		</tr>
		<tr>
			<td class="subtitle">Fecha Contrato Social</td>
			<td><?php echo $fecha_contrato_s;
			 if($fecha_contrato_social_s=='-----------')
				      {
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000"><?php echo $error1;?></font>
<?php
                       }
					      
 	               else
				       { 
			            if ($bandera_fecha_contrato == 1)
	                      { 
?>
					  <img  src="../img/ic_advertencia.gif" border="0"></img> 
					  <font color="#FF0000">
					   <?php echo $error;?>					  </font>
<?php       
                           } 
						 else
						   {
						   if(!($fechac_s == $fechai_p ))
						     {
							if(!($fechaia_p=='-----------'))
							  {
							if($fechac_s > $fechai_p )
						     { 
							 $bandera=1;
?>
					  <img  src="../img/ic_advertencia.gif" border="0"></img> 
					  <font color="#FF0000">
					   <?php echo 'La fecha de contrato no Puede ser Superior a la Fecha de inicio de actividad primaria';    ?>					  </font>
<?php       
                             }
							 }
							}  
						   }   
				  }  			   
		
?>			</td>
		</tr>
		
		<tr>
			<td class="subtitle">Tipo de Sociedad</td>
			<td>
<?php
			    $f_sociedad = mysql_fetch_array ($r_sociedad);
                echo $f_sociedad['nombre']; if ($sociedad_tipo =='N')
		          { 
					   echo 'Sin Especificar';
                  }  			   
			   
?>			</td>
		</tr>
        
        <?php
  if($sociedad_tipo=='16')
    {
?>
<tr bgcolor="#EAEAEA">
			<td colspan="2"><h4>&nbsp;Empresas que Integran la U.T.E </h4></td>
		</tr>
		<tr height="2px">
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
		    <td colspan="2">
			    <table>
				     <tr bgcolor="#EAEAEA">
					    <td><span class="Estilo6">1-</span></td>
						<td width="21">&nbsp;  </td>
						<td><span class="Estilo6">2-</span></td>
                        <td width="21">&nbsp;  </td>
						<td><span class="Estilo6">3-</span></td>  
						
					</tr>
       <tr>	
					    <td width="353" height="28" >CUIT:<?php echo $cuit1_u; ?> <?php  if($cuit1_u=='')
				      {
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000"><?php echo $error1;?></font>
<?php
                       }
					      
 	               else
				       { 
					   if ($bandera_cuit1_u==1)
		                         { 
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000">
								  <?php echo $error;?>								 </font>
<?php
                                 }  
						}		  
 ?>		 	</td>
					 <td>&nbsp;  </td>
					 <td width="354" >CUIT:
				   <?php echo $cuit2_u; ?>  <?php  if($cuit2_u=='')
				      {
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000"><?php echo $error1;?></font>
<?php
                       }
					      
 	               else
				       { 
					   if ($bandera_cuit2_u==1)
		                         { 
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000">
								  <?php echo $error;?>								 </font>
<?php
                                 }  
						}		  
 ?>		 	</td>
                   <td>&nbsp;  </td>
                   <td width="354" >CUIT:
				   <?php echo $cuit3_u; ?>	<?php
					   if ($bandera_cuit3_u==1)
		                         { 
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000">
								  <?php echo $error;?>								 </font>
<?php
                                 }  
								  
 ?>		 		</td>		  </tr>
					 <tr>
					 <td width="353" height="28" >Razon Social:
					  <?php echo $razon1_u; ?>  <?php  if($razon1_u=='')
				      {
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000"><?php echo $error1;?></font>
<?php
                       }
					      
 	               else
				       { 
					   if ($bandera_razon1_u==1)
		                         { 
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000">
								  <?php echo $error;?>								 </font>
<?php
                                 }  
						}		  
 ?>		  </td>
					 <td>&nbsp;  </td>
					 <td width="353" height="28" >Razon Social:
					  <?php echo $razon2_u; ?>   <?php  if($razon2_u=='')
				      {
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000"><?php echo $error1;?></font>
<?php
                       }
					      
 	               else
				       { 
					   if ($bandera_razon2_u==1)
		                         { 
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000">
								  <?php echo $error;?>								 </font>
<?php
                                 }  
						}		  
 ?>	 </td>
                      <td>&nbsp;  </td>
					 <td width="353" height="28" >Razon Social:
					<?php echo $razon3_u; ?> <?php if ($bandera_razon3_u==1)
		                         { 
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000">
								  <?php echo $error;?>								 </font>
<?php
                                 } ?> </td>
					 </tr>
					 <tr>
					    <td width="353" height="28" >Domicilio:  &nbsp;&nbsp;&nbsp;&nbsp;
				       <?php echo $dom1_u; ?>  <?php  if($dom1_u=='')
				      {
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000"><?php echo $error1;?></font>
<?php
                       }
					      
 	               else
				       { 
					   if ($bandera_dom1_u==1)
		                         { 
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000">
								  <?php echo $error;?>								 </font>
<?php
                                 }  
						}		  
 ?>	</td>
					   <td>&nbsp;  </td>
						 <td width="353" height="28" >Domicilio:  &nbsp;&nbsp;&nbsp;&nbsp;
				       <?php echo $dom2_u; ?>  <?php  if($dom2_u=='')
				      {
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000"><?php echo $error1;?></font>
<?php
                       }
					      
 	               else
				       { 
					   if ($bandera_dom2_u==1)
		                         { 
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000">
								  <?php echo $error;?>								 </font>
<?php
                                 }  
						}		  
 ?>	</td>
					   <td>&nbsp;  </td>
                        <td width="353" height="28" >Domicilio:  &nbsp;&nbsp;&nbsp;&nbsp;
				      <?php echo $dom3_u; ?>  <?php if ($bandera_dom3_u==1)
		                         { 
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000">
								  <?php echo $error;?>								 </font>
<?php
                                 } ?> </td>
					   </tr>
				<tr>
				 <td width="353" height="28" >Porcentaje:	 &nbsp;&nbsp;&nbsp;
				  <?php echo $por1_u; ?></td>
				 <td>&nbsp;  </td>
				  <td width="353" height="28" >Porcentaje:	 &nbsp;&nbsp;&nbsp;
				  <?php echo $por2_u; ?></td>
				 <td>&nbsp;  </td>
				  <td width="353" height="28" >Porcentaje:	 &nbsp;&nbsp;&nbsp;
				 <?php echo $por3_u; ?>  <?php if ($bandera_dom3_u==1)
		                         { 
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000">
								  <?php echo $error;?>								 </font>
<?php
                                 } ?></td>
				
                  </tr>
				
                               
				
                        
 
                        
                       </td>
				  </tr> 
                    <tr bgcolor="#EAEAEA">
					    <td><span class="Estilo6">4-</span></td>
						<td width="21">&nbsp;  </td>
						<td><span class="Estilo6">5-</span></td>
                        <td width="21">&nbsp;  </td>
						<td><span class="Estilo6">6-</span></td>  
						
					</tr>
       <tr>	
					    <td width="353" height="28" >CUIT:
					  <?php echo $cuit4_u; ?> <?php  
					   if ($bandera_cuit4_u==1)
		                         { 
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000">
								  <?php echo $error;?>								 </font>
<?php
                                 }  
								  
 ?>		 </td>
					 <td>&nbsp;  </td>
					 <td width="354" >CUIT:
				   <?php echo $cuit5_u; ?>   <?php  
					   if ($bandera_cuit5_u==1)
		                         { 
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000">
								  <?php echo $error;?>								 </font>
<?php
                                 }  
								  
 ?>		 	</td>
                   <td>&nbsp;  </td>
                   <td width="354" >CUIT:
				  <?php echo $cuit6_u; ?>  <?php 
					   if ($bandera_cuit6_u==1)
		                         { 
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000">
								  <?php echo $error;?>								 </font>
<?php
                                 }  
								  
 ?>		 			</td>		  </tr>
					 <tr>
					 <td width="353" height="28" >Razon Social:
					<?php echo $razon4_u; ?>  <?php if ($bandera_razon4_u==1)
		                         { 
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000">
								  <?php echo $error;?>								 </font>
<?php
                                 } ?></td>
					 <td>&nbsp;  </td>
					 <td width="353" height="28" >Razon Social:
					 <?php echo $razon5_u; ?>  <?php if ($bandera_razon5_u==1)
		                         { 
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000">
								  <?php echo $error;?>								 </font>
<?php
                                 } ?></td>
                      <td>&nbsp;  </td>
					 <td width="353" height="28" >Razon Social:
					  <?php echo $razon6_u; ?>  <?php if ($bandera_razon6_u==1)
		                         { 
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000">
								  <?php echo $error;?>								 </font>
<?php
                                 } ?></td>
					 </tr>
					 <tr>
					    <td width="353" height="28" >Domicilio:  &nbsp;&nbsp;&nbsp;&nbsp;
				      <?php echo $dom4_u; ?>  <?php if ($bandera_dom4_u==1)
		                         { 
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000">
								  <?php echo $error;?>								 </font>
<?php
                                 } ?></td>
					   <td>&nbsp;  </td>
						 <td width="353" height="28" >Domicilio:  &nbsp;&nbsp;&nbsp;&nbsp;
				      <?php echo $dom5_u; ?>  <?php if ($bandera_dom5_u==1)
		                         { 
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000">
								  <?php echo $error;?>								 </font>
<?php
                                 } ?></td>
					   <td>&nbsp;  </td>
                        <td width="353" height="28" >Domicilio:  &nbsp;&nbsp;&nbsp;&nbsp;
				      <?php echo $dom6_u; ?>  <?php if ($bandera_dom6_u==1)
		                         { 
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000">
								  <?php echo $error;?>								 </font>
<?php
                                 } ?></td>
					   </tr>
				<tr>
				 <td width="353" height="28" >Porcentaje:	 &nbsp;&nbsp;&nbsp;
				 <?php echo $por4_u; ?>  <?php if ($bandera_por4_u==1)
		                         { 
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000">
								  <?php echo $error;?>								 </font>
<?php
                                 } ?></td>
				 <td>&nbsp;  </td>
				  <td width="353" height="28" >Porcentaje:	 &nbsp;&nbsp;&nbsp;
				 <?php echo $por5_u; ?>  <?php if ($bandera_por5_u==1)
		                         { 
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000">
								  <?php echo $error;?>								 </font>
<?php
                                 } ?></td>
				 <td>&nbsp;  </td>
				  <td width="353" height="28" >Porcentaje:	 &nbsp;&nbsp;&nbsp;
				 <?php echo $por6_u; ?>  <?php if ($bandera_por6_u==1)
		                         { 
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000">
								  <?php echo $error;?>								 </font>
<?php
                                 } ?></td>
				
                  </tr>
				
                               
				
                        
 
                        
                       </td>
				  </tr> 
                </table>  
       
       </td>



<?php  

	}
?>	

	 </tr>
       <tr bgcolor="#EAEAEA">
			<td colspan="2"><h4>&nbsp;</h4></td>
		</tr>
       </tr>	  
  

		<tr>
			<td class="subtitle">Situacion frente I.V.A.</td>
			<td>
<?php
             	$f_iva = mysql_fetch_array ($r_iva);
                echo $f_iva['nombre'];  if ($iva_situacion =='N')
		          { 
?>
					  <img  src="../img/ic_advertencia.gif" border="0"></img> 
					  <font color="#FF0000">
					  <?php echo $error1;?>					  </font>
<?php                                }  			   
			   
?>				  	</td>
		</tr>
		
		<tr>
			<td class="subtitle">Ganancia</td>
		  <td>
<?php
             	$f_ganancia = mysql_fetch_array ($r_ganancia);
                echo $f_ganancia['nombre'];  if ($ganancia =='N')
		          { 
?>
					  <img  src="../img/ic_advertencia.gif" border="0"></img> 
					  <font color="#FF0000">
					  <?php echo $error1;?>					  </font>
<?php                                }  			   
			   
?>				  	</td>
		</tr>
	<!--	<tr>
			<td class="subtitle">Alicuota</td>
			<td>
<?php
         /*    	$f_alicuota = mysql_fetch_array ($r_alicuota);
                echo $f_alicuota['nombre'];  if ($alicuota =='N')
		          { 
?>
					  <img  src="../img/ic_advertencia.gif" border="0"></img> 
					  <font color="#FF0000">
					  <?php echo $error1;?>					  </font>
<?php                                }  			   
*/			   
?>				  	</td>
		</tr> -->
		<tr>
			<td class="subtitle">Ingreso Bruto</td>
			<td>
<?php
             	$f_ingreso = mysql_fetch_array ($r_ingreso);
                echo $f_ingreso['nombre'];  if ($ingreso =='N')
		          { 
?>
					  <img  src="../img/ic_advertencia.gif" border="0"></img> 
					  <font color="#FF0000">
					  <?php echo $error1;?>					  </font>
<?php                                }  			   
			   
?>				  	</td>	  	
		</tr>
		
		
		
		<tr>
			<td class="subtitle" colspan="2" >Nro. Inscripcion Ingreso Bruto(Jurisdiccion la Rioja) 			
				<?php echo $ingreso_bruto;
			 if($ingreso_bruto=='')
				      {
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000"><?php echo $error1;?></font>
<?php
                       }
					      
 	               else
				       { 
					   if ($bandera_ingreso_bruto==1)
		                         { 
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000">
								  <?php echo $error;?>								 </font>
<?php
                                 }  
						}		  
 ?>		 			</td>
		</tr>

        <tr>
			<td class="subtitle" colspan="2" >Nro. Inscripcion Ingreso Bruto (Adm. Central)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  <?php echo $ingreso_bruto_ac;
			 if(!($ingreso_bruto_ac==''))
  		       {

               	   if ($bandera_ingreso_bruto_ac==1)
		                         { 
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000">
								  <?php echo $error;?>								 </font>
<?php
                                 }  
			}		  
 ?>		 			</td>
		</tr>

		<tr>
			<td class="subtitle">Regimen de Convenio  </td>
			<td>
<?php
             	$f_regimen = mysql_fetch_array ($r_regimen);
                echo $f_regimen['nombre'];  if ($regimen =='N')
		          { 
?>
					  <img  src="../img/ic_advertencia.gif" border="0"></img> 
					  <font color="#FF0000">
					  <?php echo $error1;?>					  </font>
<?php                                }  			   
			   
?>				  	</td>
		</tr>
		<tr>
			<td class="subtitle">Seguridad Social</td>
			<td>
<?php
             	$f_seguridad = mysql_fetch_array ($r_seguridad);
                echo $f_seguridad['nombre'];  if ($seguridad =='N')
		          { 
?>
					  <img  src="../img/ic_advertencia.gif" border="0"></img> 
					  <font color="#FF0000">
					  <?php echo $error1;?>					  </font>
<?php                                }  			   
			   
?>				  	</td>
		</tr>
		<tr height=20px>
			<td colspan="2"></td>
		</tr>
		<tr bgcolor="#EAEAEA">
			<td colspan="2"><h3>Componentes de la Sociedad o Autoridades en Ejercicio </h3></td>
		</tr>
		<tr height=20px>
			<td colspan="2"></td>
		</tr>
		<tr>
		    <td colspan="2">
			    <table>
      <tr bgcolor="#EAEAEA">
        <td><span class="Estilo6">1-</span></td>
        <td width="21">&nbsp;</td>
        <td><span class="Estilo6">2-</span></td>
      </tr>
      <tr>
        <td width="353" height="28" >Apellido:
          <?php
                    echo $apellido1; 
				    if($apellido1=='')
				      {
					     $bandera =1;
?>
              <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"><?php echo $error1;?></font>
              <?php
                       }
					      
 	               else
				       {  
					    if ($bandera_apellido1==1)
		                         { 
?>
              <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"><?php echo $error;?> </font>
              <?php                            
                                 }
						}
?>
        </td>
        <td>&nbsp;</td>
        <td width="354" >Apellido:
          <?php
                    echo $apellido2; 
					    if (!($apellido2 ==''))
						   {
				          if ($bandera_apellido2==1)
		                      { 
?>
              <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"><?php echo $error;?> </font>
              <?php                            
                                 }
							}	 
						
?>
        </td>
      </tr>
      <tr>
        <td width="353" height="28" >Nombre:
          <?php
                    echo $nombre1; 
				    if($nombre1=='')
				      {
					   $bandera =1;
?>
              <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"><?php echo $error1;?></font>
              <?php
                       }
					      
 	               else
				       {  
					    if ($bandera_nombre1==1)
		                         { 
?>
              <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"><?php echo $error;?></font>
              <?php                            
                                 }
						}
?>
        </td>
        <td>&nbsp;</td>
        <td width="354" >Nombre:
          <?php
                    echo $nombre2;
			if (!($nombre2 ==''))
				   {		 
				    if ($bandera_nombre2==1)
		                     { 
?>
              <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"><?php echo $error;?></font>
              <?php                            
                             }
					}		 
				
?>
        </td>
      </tr>
      <tr>
        <td width="353" height="28" >D.N.I:
          <?php
                    echo $dni1; 
				    if($dni1=='')
				      {
					   $bandera =1;
?>
              <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"><?php echo $error1;?></font>
              <?php
                       }
					      
 	               else
				       {  
					    if ($bandera_dni1==1)
		                         { 
?>
              <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"><?php echo $error;?></font>
              <?php                            
                                 }
						}
?>
        </td>
        <td>&nbsp;</td>
        <td width="354" >D.N.I:
          <?php
                    echo $dni2; 
					if (!($dni2 ==''))
				   {		 
				    if ($bandera_dni2==1)
		                         { 
?>
              <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"><?php echo $error;?></font>
              <?php                            
                                 }
					}
?>
        </td>
      </tr>
      <tr>
        <td width="353" height="28" >Cargo:
          <?php
                    echo $cargo1; 
				    if($cargo1=='')
				      {
					   $bandera =1;
?>
              <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"><?php echo $error1;?></font>
              <?php
                       }
					      
 	               else
				       {  
					    if ($bandera_cargo1==1)
		                         { 
?>
              <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"><?php echo $error;?></font>
              <?php                            
                                 }
						}
?>
        </td>
        <td>&nbsp;</td>
        <td width="354" >Cargo:
          <?php
                    echo $cargo2;
			if (!($cargo2 ==''))
				   {		 
				    if ($bandera_cargo2==1)
		                     { 
?>
              <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"><?php echo $error;?></font>
              <?php                            
                             }
					}		 
				
?>
        </td>
      </tr>
      <tr>
        <td width="353" height="28" >Fecha Inicio:
          <?php
                    echo $fecha_inicio1; 
				    if($fecha_inicio1=='-----------')
				      {
					   $bandera =1;
?>
              <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"><?php echo $error1;?></font>
              <?php
                       }
					      
 	               else
				       {  
					    if ($bandera_fecha_inicio1==1)
		                         { 
?>
              <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"><?php echo $error;?></font>
              <?php                            
                                 }
						}
?>
        </td>
        <td>&nbsp;</td>
        <td width="354" >Fecha Inicio:
          <?php
                    echo $fecha_inicio2;
			if (!($fecha_inicio2 =='-----------'))
				   {		 
				    if ($bandera_fecha_inicio2==1)
		                     { 
?>
              <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"><?php echo $error;?></font>
              <?php                            
                             }
					}		 
				
?>
        </td>
      </tr>
      <tr>
        <td width="353" height="28" >Fecha Fin:
          <?php
                    echo $duracion1; 
				    if($duracion1=='-----------')
				      {
					   $bandera =1;
?>
              <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"><?php echo $error1;?></font>
              <?php
                       }
					      
 	               else
				       {  
					    if ($bandera_duracion1==1)
		                         { 
?>
              <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"><?php echo $error;?></font>
              <?php                            
                                 }
						}
?>
        </td>
        <td>&nbsp;</td>
        <td width="354" >Fecha Fin:
          <?php
                    echo $duracion2;
			if (!($duracion2 =='-----------'))
				   {		 
				    if ($bandera_duracion2==1)
		                     { 
?>
              <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"><?php echo $error;?></font>
              <?php                            
                             }
					}		 
				
?>
        </td>
      </tr>
      <tr>
        <td colspan="3"></td>
      </tr>
      <tr bgcolor="#EAEAEA">
        <td><span class="Estilo6">3-</span></td>
        <td>&nbsp;</td>
        <td><span class="Estilo6">4-</span></td>
      </tr>
      <td width="353" height="28">Apellido:
        <?php
                    echo $apellido3; 
				   if (!($apellido3 ==''))
				   {
				    if ($bandera_apellido3==1)
		                         { 
?>
                <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"><?php echo $error;?> </font>
                <?php                            
                                 }
					}			 
						
?>
      </td>
            <td>&nbsp;</td>
        <td width="354" >Apellido:
          <?php
                    echo $apellido4; 
					if (!($apellido4 ==''))
				   {
				    if ($bandera_apellido4==1)
		                         { 
?>
                <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"><?php echo $error;?> </font>
                <?php                            
                                 }
					}			 
					
?>
            </td>
      </tr>
      <tr>
        <td width="353" height="28">Nombre:
          <?php
                    echo $nombre3; 
				if (!($nombre3 ==''))
				   {	
				    if ($bandera_nombre3==1)
		                         { 
?>
              <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"><?php echo $error;?></font>
              <?php                            
                                 }
					}			 
						
?>
        </td>
        <td>&nbsp;</td>
        <td width="354" >Nombre:
          <?php
                    echo $nombre4; 
				    if (!($nombre4 ==''))
				   {	
				    if ($bandera_nombre4==1)
		                         { 
?>
              <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"><?php echo $error;?></font>
              <?php                            
                                 }
                   }
						
?>
        </td>
      </tr>
      <tr>
        <td width="353" height="28">D.N.I:
          <?php
                    echo $dni3; 
				if (!($dni3 ==''))
				   {	
				    if ($bandera_dni3==1)
		                         { 
?>
              <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"><?php echo $error;?></font>
              <?php                            
                                 }
					}			 
						
?>
        </td>
        <td>&nbsp;</td>
        <td width="354" >D.N.I:
          <?php
                    echo $dni4; 
					if (!($dni4 ==''))
				   {
				    if ($bandera_dni4==1)
		                         { 
?>
              <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"><?php echo $error;?></font>
              <?php                            
                                 }
						}		 
						
?>
        </td>
      </tr>
      <tr>
        <td width="353" height="28">Cargo:
          <?php
                    echo $cargo3;
			if (!($cargo3 ==''))
				   {		 
				    if ($bandera_cargo3==1)
		                     { 
?>
              <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"><?php echo $error;?></font>
              <?php                            
                             }
					}		 
				
?>
        </td>
        <td>&nbsp;</td>
        <td width="354" >Cargo:
          <?php
                    echo $cargo4;
			if (!($cargo4 ==''))
				   {		 
				    if ($bandera_cargo4==1)
		                     { 
?>
              <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"><?php echo $error;?></font>
              <?php                            
                             }
					}		 
				
?>
        </td>
      </tr>
      <tr>
        <td width="353" height="28" >Fecha Inicio:
          <?php
                    echo $fecha_inicio3; 
				    if($fecha_inicio3=='-----------')
				      {
					 
					    if ($bandera_fecha_inicio3==1)
		                         { 
?>
              <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"><?php echo $error;?></font>
              <?php                            
                                 }
						}
?>
        </td>
        <td>&nbsp;</td>
        <td width="354" >Fecha Inicio:
          <?php
                    echo $fecha_inicio4;
			if (!($fecha_inicio4 =='-----------'))
				   {		 
				    if ($bandera_fecha_inicio4==1)
		                     { 
?>
              <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"><?php echo $error;?></font>
              <?php                            
                             }
					}		 
				
?>
        </td>
      </tr>
      <tr>
        <td width="353" height="28" >Fecha Fin:
          <?php
                    echo $duracion3; 
				    if($duracion3=='')
				      {
					    
					    if ($bandera_duracion3==1)
		                         { 
?>
              <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"><?php echo $error;?></font>
              <?php                            
                                 }
						}
?>
        </td>
        <td>&nbsp;</td>
        <td width="354" >Fecha Fin:
          <?php
                    echo $duracion4;
			if (!($duracion4 =='-----------'))
				   {		 
				    if ($bandera_duracion4==1)
		                     { 
?>
              <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"><?php echo $error;?></font>
              <?php                            
                             }
					}		 
				
?>
        </td>
      </tr>
    </table>		</td>
		</tr>

		<tr height=10px>
			<td colspan="2"></td>
		</tr>
		
				<tr>
		  <td>Observacion
		  <td><?php echo $observacion; ?></td>
		</tr>
		<tr height=20px>
			<td colspan="2"><hr></td>
		</tr>
		</tr>		
				<tr height=20px>
			<td colspan="2"><hr></td>
		</tr>
<?php
     if($bandera==1)
	    {
?>
        <tr>
			<td colspan="2" align="center"><input type="submit" value="Modificar" name="modi" /></td>
		</tr>
<?php 		
		}
else
        {
?>						
		<tr  >
		  <td colspan="2" align="center">
			   <input type="submit" name="grabar" value="Siguiente">			</td>
		</tr>
<?php
        }
?>				
	  </table>
  </form> 
</div>

<div class="sidenav">
</div>

<div class="clearer"><span></span></div>