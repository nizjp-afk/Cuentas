<?php
error_reporting ( E_ERROR ); 
   include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
  $bandera=0;
  $error1='Esta informacion es necesaria no puede quedar el campo en blanco';
  $error='Los datos fueron mal ingresados';
  $valormod=$_POST['modificar'];
  $cuitl = $_POST['cuitl_1'].$_POST['cuitl_2'].$_POST['cuitl_3'];
  $cuitl_1 = $_POST['cuitl_1'];
  $cuitl_2 =$_POST['cuitl_2'];
  $cuitl_3 = $_POST['cuitl_3'];
  $id_bene = $_POST['id_bene'];
    $t_c = $_POST['t_c'];
	
  //datos de identificacion
  
  $apellido= strtoupper($_POST['apellido']);
  $nombre = ucwords(strtolower($_POST['nombre']));   
  $documento_tipo = $_POST['documento_tipo'];
  $documento_nro = $_POST['documento_nro'];
  $f_nd=$_POST['f_nd'];
  $f_nm=$_POST['f_nm'];
  $f_na=$_POST['f_na'];
  $f_cd=$_POST['f_cd'];
  $f_cm=$_POST['f_cm'];
  $f_ca=$_POST['f_ca'];
  $fecha=$f_na.'-'.$f_nm.'-'.$f_nd;
  $fechaa=$f_nd.'-'.$f_nm.'-'.$f_na;
  $area=$_POST['area'];
  $cargo=$_POST['cargo'];
  $saf=$_POST['saf']; 
  $ministerial=$_POST['ministerial']; 
  $fechac=$f_cd.'-'.$f_cm.'-'.$f_ca;
  $gestion=$f_ca.'-'.$f_cm.'-'.$f_cd;
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
  
  //
  $observacion=$_POST['observacion'];
  

 //datos de alta web 
 
  $fecha_alta_web = date("d/m/Y");
 
  
 if (!($banco_cbu==''))
    {     
   $ssql = "SELECT * FROM `beneficiarios` where id_beneficiario='$id_bene' and cbu='$banco_cbu'";
     if (!($r_cbu= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar beneficiarios y cbu";
      echo $cuerpo1;
      //.....................................................................
    }  
	
	
	  $cant = mysql_num_rows($r_cbu);
	  
	 if ($cant < 1)
		    {
			 $ssql = "SELECT * FROM `beneficiarios` where cbu='$banco_cbu'";
                 if (!($r_cbu= mysql_query($ssql, $conexion_mysql)))
                     {
	
                       //.....................................................................
                       // informa del error producido
                       $cuerpo1  = "al intentar buscar actividad";
                       echo $cuerpo1;
                      //.....................................................................
                     }  
	
	
	        $cant = mysql_num_rows($r_cbu);
			
			$ssql = "SELECT * FROM `beneficiarios_aprobados` where cbu='$banco_cbu'";
     if (!($r_cbuap= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar actividad";
      echo $cuerpo1;
      //.....................................................................
    }  
	
	
	  $cantap = mysql_num_rows($r_cbuap);
	  
	 if ($cantc >0 or $cantap>0)
		    {
			$bande=7;
?>			
			  <meta http-equiv='refresh' content='0;url=indextesoreria.php?sec=tesoreria/error&ban=<?php echo $bande; ?>' />
<?php	
			} 
		}	
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
//verificacion de datos/////
	  			 	if($t_c=='N')
		  {
			$bandera =1; 
			 
		  }		
			
//apellido

    $patron = "^[[:alpha:]]+([[:space:]]?[[:alpha:]])*$"; 
	if (!(ereg($patron, $_POST['apellido'])) )
    	{
		    $bandera =1; 
			$bandera_apellido = 1;
        }
//nombre 
	if (!(ereg($patron, $_POST['nombre'])) )
	    {
		    $bandera =1; 
			$bandera_nombre = 1;
		}

//doc tipo
   if ($documento_tipo =='N')
		          { 
				  $bandera =1;
				  }

//doc numero
		
	$patron = "[[:digit:]]{6,8}";
	if (!(ereg($patron, $_POST['documento_nro'])) )
    	{
			$bandera =1; 
			$bandera_dni = 1;
        }

//fecha nacimiento

    $patron = "([0-9]{2})-([0-9]{2})-([0-9]{4})";
	 
	if (!(ereg($patron, $fechaa)) )
    	{
     		$bandera =1; 
			$bandera_fecha = 1;
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
//mail

/*	$patron = "^[^@ ]+@[^@ ]+.[^@ .]+$";
	if (!(ereg($patron, $email)))
		{
		    $bandera =1; 
			$bandera_email = 1;
    	}	*/		
 //cuenta nro
    $patron = "[[:digit:]]{7,15}";
     if (!(ereg($patron,$banco_cta_nro))) 
    	{
     		$bandera =1; 
			$bandera_cta_nro = 1;
        }
	
					
//cbu
    $patron = "[[:digit:]]{22}";
	if (!(ereg($patron, $banco_cbu)))
		{
		    $bandera =1; 
			$bandera_cbu = 1;
    	}		
 			
   /*	if($cargo=='')
	   {
	    $bandera=1;
	   }		
 
		if($area=='')
	   {
	    $bandera=1;
	   }	*/		
?>
<div class="content">

<?php
if (!($valormod=='M'))
   {
     if ($bandera == 1) 
	   {
	   
?>	   
      <form action="indextesoreria.php?sec=tesoreria/alta_otros&apli=tgpc&per=A" method="post">
<?php
	   }
	 else
	   {
?>	     
<form action="indextesoreria.php?sec=tesoreria/registro_o&apli=tgpc&per=A" method="post">
<?php 
       }
    }
else
    {
	     if ($bandera == 1) 
	   {
	   
?>	   
      <form action="indextesoreria.php?sec=tesoreria/modificar_o&apli=tgp&per=O" method="post">
<?php
	   }
	 else
	   {
?>     
<form action="indextesoreria.php?sec=tesoreria/update_o" method="post">
<?php 
     }
 
}				  
?>		
<input type="hidden" value="<?php echo $cuitl;?>"  name="cuitl" size="2" maxlength="2">
<input type="hidden" value="<?php echo $cuitl_1;?>"  name="cuitl_1" size="2" maxlength="2">
<input type="hidden" value="<?php echo $cuitl_2;?>"  name="cuitl_2" size="2" maxlength="2">
<input type="hidden" value="<?php echo $cuitl_3;?>"  name="cuitl_3" size="2" maxlength="2">
<input type="hidden" name="id_bene" value="<?php echo $id_bene; ?>" >
<input type="hidden" value="<?php echo $t_c;?>"  name="t_c" size="2" maxlength="2">

<!--datos identificacion -->

<input type="hidden" value="<?php echo $apellido;?>"  name="apellido">
<input type="hidden" value="<?php echo $nombre;?>" name="nombre" size="30">
<input type="hidden" value="<?php echo $documento_tipo;?>" name="documento_tipo" size="30">
<input type="hidden"  value="<?php echo $documento_nro;?>" name="documento_nro" />
<input type="hidden" value="<?php echo $fecha;?>" name="fecha_nacimiento" /><!--fecha ya concatenada -->
<input type="hidden" value="<?php echo $area;?>" name="area" size="30">
<input type="hidden" value="<?php echo $cargo;?>" name="cargo" size="30">
<input type="hidden"  value="<?php echo $saf;?>" name="saf" />
<input type="hidden" value="<?php echo $gestion;?>" name="gestion" />
<input type="hidden" value="<?php echo $ministerial;?>" name="ministerial" />

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
<input type="hidden" value="<?php echo $observacion; ?>" name="observacion"  />

<!--datos banco -->

<input type="hidden" value="<?php echo $banco_nombre; ?>" name="banco_nombre" />
<input type="hidden" value="<?php echo $banco_sucursal; ?>" name="banco_sucursal" />
<input type="hidden" value="<?php echo $banco_cta_tipo;?>" name="banco_cta_tipo" />
<input type="hidden" value="<?php echo $banco_cta_nro; ?>" name="banco_cta_nro"  />
<input type="hidden" value="<?php echo $banco_cbu; ?>" name="banco_cbu"  />
<input type="hidden" value="<?php echo $observacion; ?>" name="observacion"  />

<!--datos economicos -->


<!-- actividad comercial -->


<!--datos para sistema -->
<input type="hidden" value="<?php echo $fecha_alta_web;?>" name="fecha_alta_web" />
<table border="0" align="center">
  <?php
 if ($valormod=='M')
   {
?>
  <tr>
    <td colspan="2"><h1>Validacion Modificacion de datos de Otra Personas</h1></td>
  </tr>
  <?php
   }
  else
   {
   ?>
  <tr>
    <td colspan="2"><h1>Validacion de datos de Otra Personas</h1></td>
  </tr>
  <?php
   }
 ?>
 
  <tr height=10px>
    <td colspan="2"><hr /></td>
  </tr>
  <tr>
    <td class="subtitle">Nro. CUIL | CUIT</td>
    <td><?php 
                echo $cuitl;  if ($bandera_cuitl ==1)
		                         { 
?>
        <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"><?php echo $error;?></font>
        <?php
                                 }   
 ?>
    </td>
  </tr>
  <tr>
			<td class="subtitle">Tipo Cuit</td>
			<td>
<?php 
                  if($t_c=='1') {echo 'CUIT';}
				  if($t_c=='2') {echo 'CUIL';}
				   
				   if($t_c=='N')
				      {
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000"><?php echo $error1;?></font>
<?php
                       }
					      
 	              ?>	  </td>
		</tr>
  <tr height=10px>
    <td colspan="2"><hr /></td>
  </tr>
  <tr bgcolor="#EAEAEA">
    <td colspan="2"><h4>&nbsp;Datos de Identificacion</h4></td>
  </tr>
  <tr height="2px">
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td class="subtitle">Apellido</td>
    <td><?php 
                 echo $apellido; 
				   if($apellido=='')
				      {
?>
        <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"><?php echo $error1;?></font>
        <?php
                       }
					      
 	               else
				       {  
					     if ($bandera_apellido ==1)
		                         { 
?>
        <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"><?php echo $error;?></font>
        <?php                                }  
                        }  
 ?>
    </td>
  </tr>
  <tr>
    <td class="subtitle">Nombres</td>
    <td><?php
                 echo $nombre;  
				    if($nombre=='')
				      {
?>
        <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"><?php echo $error1;?></font>
        <?php
                       }
					      
 	               else
				       {  
					    if ($bandera_nombre ==1)
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
    <td class="subtitle">Tipo de Documento</td>
    <td><?php     
               $f_documento = mysql_fetch_array ($r_documento);
               echo $f_documento['descripcion'];
               if ($documento_tipo =='N')
		          { 
?>
        <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"> <?php echo $error1;?> </font>
        <?php                                }  			   
			   
?>
    </td>
  </tr>
  <tr>
    <td class="subtitle">Nro. de Documento</td>
    <td><?php 
              echo $documento_nro; 
			     if($documento_nro=='')
				      {
?>
        <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"><?php echo $error1;?></font>
        <?php
                       }
					      
 	               else
				       {  
					    if ($bandera_dni ==1)
	                       { 
?>
        <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"> <?php echo $error;?> </font>
        <?php       
                            }
					 }		  			   
		
?>
    </td>
  </tr>
  <tr>
    <td class="subtitle">Fecha de Nacimiento</td>
    <td><?php echo $fechaa;
			 if($fechaa=='-----------')
				      {
?> <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"><?php echo $error1;?></font>
        <?php
                       }
					      
 	               else
				       { 
			            if ($bandera_fecha == 1)
	                      { 
?>
        <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"> <?php echo $error;?> </font>
        <?php       
                           } 
				  }  			   
		
?>
    </td>
  </tr>
  <tr>
    <td class="subtitle">Area de Gobierno</td>
    <td><?php echo $area; ?> </td>
  </tr>
  <tr>
    <td class="subtitle">Cargo</td>
    <td><?php echo $cargo; ?> </td>
  </tr>
  <?php 
     //$fechac=split("-",$fecha_cargo);
?>
  <tr>
    <td class="subtitle">Fecha Inicio de Gestion</td>
    <td><?php echo $fechac; ?></td>
  </tr>
  <tr>
    <td class="subtitle">SAF Nº</td>
    <td><?php echo $saf; ?></td>
  </tr>
  <tr height=10px>
    <td colspan="2"></td>
  </tr>
  <tr bgcolor="#EAEAEA">
    <td colspan="2"><h4>&nbsp;Domicilio Fiscal</h4></td>
  </tr>
  <tr height="2px">
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td class="subtitle">Calle</td>
    <td><?php echo $direccion_calle_f;
		         if($direccion_calle_f=='')
				      {
?> <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"><?php echo $error1;?></font>
        <?php
                       }
					      
 	               else
				       {
                       if ($bandera_calle_f == 1)
	                    { 
?>
        <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"> <?php echo $error;?> </font>
        <?php       
                        }
				}		  			   
		
?>
    </td>
  </tr>
  <tr>
    <td class="subtitle">Numero</td>
    <td><?php echo $direccion_nro_f; ?> </td>
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
    <td><?php
			 $f_provincia_f= mysql_fetch_array ($r_provincia_f);
             echo $f_provincia_f['nombre'];  if ($direccion_provincia_f =='N')
		          { 
?>
        <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"> <?php echo $error1;?> </font>
        <?php                                }  			   
			   
?>
    </td>
  </tr>
  <tr>
    <td class="subtitle">Localidad</td>
    <td><?php
			  $f_localidad_f = mysql_fetch_array ($r_localidad_f);
			  echo $f_localidad_f['descripcion'];
                if ($direccion_localidad_f=='S')
		          { 
?>
        <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"> <?php echo $error1;?> </font>
        <?php                                }  			   
			   
?>
    </td>
  </tr>
  <tr>
    <td class="subtitle">Codigo Postal</td>
    <td><?php echo $codigo_postal_f; ?></td>
  </tr>
  <tr height=10px>
    <td colspan="2"></td>
  </tr>
  <tr bgcolor="#EAEAEA">
    <td colspan="2"><h4>&nbsp;Domicilio Real</h4></td>
  </tr>
  <tr height="2px">
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td class="subtitle">Calle</td>
    <td><?php echo $direccion_calle_r;
		          if($direccion_calle_r=='')
				      {
?> <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"><?php echo $error1;?></font>
        <?php
                       }
					      
 	               else
				       {
                       if ($bandera_calle_r == 1)
	                      { 
?>
        <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"> <?php echo $error;?> </font>
        <?php       
                          }  
						}  			   
		
?>
    </td>
  </tr>
  <tr>
    <td class="subtitle">Numero</td>
    <td><?php echo $direccion_nro_r;?> </td>
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
    <td><?php
			 $f_provincia_r= mysql_fetch_array ($r_provincia_r);
             echo $f_provincia_r['nombre'];  if ($direccion_provincia_r =='N')
		          { 
?>
        <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"> <?php echo $error1;?> </font>
        <?php                                }  			   
			   
?>
    </td>
  </tr>
  <tr>
    <td class="subtitle">Localidad</td>
    <td><?php
			  $f_localidad_r= mysql_fetch_array ($r_localidad_r);
			  echo $f_localidad_r['descripcion'];
                if ($direccion_localidad_r =='S')
		          { 
?>
        <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"> <?php echo $error1;?> </font>
        <?php                                }  			   
			   
?>
    </td>
  </tr>
  <tr>
    <td class="subtitle">Codigo Postal</td>
    <td><?php echo $codigo_postal_r; ?></td>
  </tr>
  <tr height=10px>
    <td colspan="2"></td>
  </tr>
  <tr bgcolor="#EAEAEA">
    <td colspan="2"><h4>&nbsp;Otros Datos</h4></td>
  </tr>
  <tr height="2px">
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td class="subtitle">Telefono</td>
    <td><?php echo $telefono; 
			   if($telefono=='-')
				      {
?> <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"><?php echo $error1;?></font>
        <?php
                      }
					      
 	               else
				     {
			            if ($bandera_telefono==1)
	                         { 
?>
        <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"> <?php echo $error;?></font>
        <?php       
                             }
				  }   	 ?></td>
  </tr>
  <tr>
    <td class="subtitle">Direccion E-mail</td>
    <td><?php echo $email; ?> </td>
  </tr>
  <tr height=10px>
    <td colspan="2"></td>
  </tr>
  <tr height="2px">
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr bgcolor="#D6DFE3">
    <td colspan="2"><h4>&nbsp;Datos Cuenta Bancaria Asociada</h4></td>
  </tr>
  <tr height="2px">
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td class="subtitle">Nombre de Banco</td>
    <td><?php     
       
                   $f_banco = mysql_fetch_array ($r_banco);
                    echo $f_banco['nombre']; 
					if ($banco_nombre =='N')
		          { 
?>
        <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"> <?php echo $error1;?> </font>
        <?php                                }  			   
			   
?>
    </td>
  </tr>
  <tr>
    <td class="subtitle">Sucursal</td>
    <td><?php echo $banco_sucursal;?></td>
  </tr>
  <tr>
    <td class="subtitle">Tipo de Cuenta</td>
    <td><?php     
                    $f_bcocta = mysql_fetch_array ($r_bcocta);
	                echo $f_bcocta['nombre'];  if ($banco_cta_tipo =='N')
		          { 
				   $bandera=1;
?>
        <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"> <?php echo $error1;?> </font>
        <?php                                }  			   
			   
?>
    </td>
  </tr>
  <tr>
    <td class="subtitle">Nro. de Cuenta</td>
    <td><?php echo $banco_cta_nro;
			 if($banco_cta_nro=='')
				      {
?> <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"><?php echo $error1;?></font>
        <?php
                       }
					      
 	               else
				       {  
			            if ($bandera_cta_nro == 1)
	                    { 
?>
        <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"> <?php echo $error;?> </font>
        <?php       
                        } 
					}	 	
?>
    </td>
    <td></td>
  </tr>
  <tr>
    <td class="subtitle">Nro. C.B.U.</td>
    <td><?php echo $banco_cbu;
			      if($banco_cbu=='')
				      {
?> <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"><?php echo $error1;?></font>
        <?php
                       }
					      
 	               else
				       {
			             if ($bandera_cbu == 1)
	                        { 
?>
        <img  src="../img/ic_advertencia.gif" border="0" /> <font color="#FF0000"> <?php echo $error;?> </font>
        <?php       
                            }  
						}	
?>
    </td>
  </tr>
  <tr height=20px>
    <td colspan="2"><hr /></td>
  </tr>
  <tr>
    <td>Observacion</td>
    <td><?php echo $observacion;?></td>
  </tr>
  <tr height=20px>
    <td colspan="2"><hr /></td>
  </tr>
  <?php
     if($bandera==1)
	    {
?>
  <tr>
    <td colspan="2" align="center"><input type="submit" value="Modificar" name="modi" />
    </td>
  </tr>
  <?php 		
		}
else
        {
?>
  <tr  >
    <td colspan="2" align="center"><input type="submit" name="grabar" value="Siguiente" />
    </td>
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