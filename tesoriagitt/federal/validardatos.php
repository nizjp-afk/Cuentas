<?php
error_reporting ( E_ERROR );
    include('conexion/mysql-var_sigcom.php');
    include('conexion/mysql_connect.php');  
    include('conexion/mysql_select_db.php');
    include('conexion/extras.php');
	
  $error='Esta informacion es necesaria';
     
  $cuitl = $_POST['cuitl_1'].$_POST['cuitl_2'].$_POST['cuitl_3'];
  $apellido= strtoupper($_POST['apellido']);
  $nombre = ucwords(strtolower($_POST['nombre']));   
  $documento_tipo = $_POST['documento_tipo'];
  $documento_nro = $_POST['documento_nro'];
  $f_nd=$_POST['f_nd'];
  $f_nm=$_POST['f_nm'];
  $f_na=$_POST['f_na'];
  $fecha=$f_na.'-'.$f_nm.'-'.$f_nd;
  $fechaa=$f_nd.'-'.$f_nm.'-'.$f_na;
  $f_id=$_POST['f_id'];
  $f_im=$_POST['f_im'];
  $f_ia=$_POST['f_ia'];
  $fechai=$f_ia.'-'.$f_im.'-'.$f_id;
  $fechaia=$f_id.'-'.$f_im.'-'.$f_ia;
  $direccion_calle = $_POST['direccion_calle'];
  $direccion_nro = $_POST['direccion_nro'];
  $direccion_piso = $_POST['direccion_piso'];
  $direccion_dpto_nro = $_POST['direccion_dpto_nro'];
  $direccion_localidad = $_POST['direccion_localidad'];
  $direccion_dpto = $_POST['direccion_dpto'];
  $direccion_provincia = $_POST['direccion_provincia'];
  $codigo_postal = $_POST['codigo_postal'];
  $telefono = $_POST['telefono'];
  $celular = $_POST['celular'];
  $banco_nombre = $_POST['banco_nombre'];
  $banco_sucursal = $_POST['banco_sucursal'];
  $banco_cta_tipo = $_POST['banco_cta_tipo'];
  $banco_cta_nro = $_POST['banco_cta_nro'];
  $razon_social = $_POST['razon_social']; 
  $sociedad_tipo = $_POST['sociedad_tipo'];
  $convenio_tipo = $_POST['convenio_tipo'];
  $convenio_nro = $_POST['convenio_nro'];
  $persona_tipo = $_POST['persona_tipo'];
  $ingreso_bruto = $_POST['ingreso_bruto_1'].$_POST['ingreso_bruto_2'].$_POST['ingreso_bruto_3'];
  $iva_situacion = $_POST['iva_situacion'];
  $fecha_alta_web = date("d/m/Y");
  $email = $_POST['email'];
  $bandera=0;
   
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
//verificacion de datos/////
	
	$patron_cuitl = "[[:digit:]]{10,11}";
	if (!(ereg($patron_cuitl, $cuitl)))
		{
		    $bandera =1; 
			$bandera_cuitl = 1;
    	}
	$patron = "[[:digit:]]{10}";
	if (!(ereg($patron_cuitl, $ingreso_bruto)))
		{
		    $bandera =1; 
			$bandera_ingreso_bruto = 1;
    	}		
    $patron = "^[[:alpha:]]+([[:space:]]?[[:alpha:]])*$"; 
	if (!(ereg($patron, $_POST['apellido'])) )
    	{
		    $bandera =1; 
			$bandera_apellido = 1;
        }
	if (!(ereg($patron, $_POST['nombre'])) )
	    {
		    $bandera =1; 
			$bandera_nombre = 1;
		}
	$patron = "[[:digit:]]{6,8}";
	if (!(ereg($patron, $_POST['documento_nro'])) )
    	{
     		$bandera =1; 
			$bandera_dni = 1;
        }
    $patron = "([0-9]{2})-([0-9]{2})-([0-9]{4})";
	 
	if (!(ereg($patron, $fechaa)) )
    	{
     		$bandera =1; 
			$bandera_fecha = 1;
        }

   if ($direccion_calle =="" )
    	{
     		$bandera =1; 
			$bandera_calle = 1;
        }
		
   if ($direccion_nro =="" )
    	{
     		$bandera =1; 
			$bandera_numero = 1;
        }	
   if ($banco_cta_nro =="" )
    	{
     		$bandera =1; 
			$bandera_cta_nro = 1;
        }	
	
   $patron = "([0-9]{2})-([0-9]{2})-([0-9]{4})";
	 
	if (!(ereg($patron, $fechaia)) )
    	{
     		$bandera =1; 
			$bandera_fechai = 1;
        }				
   			
    if ($banco_cta_nro =="" )
    	{
     		$bandera =1; 
			$bandera_cta_nro = 1;
        }
	 if ($razon_social =="" )
    	{
     		$bandera =1; 
			$bandera_razon = 1;
        }		
?>

<div class="content">
<h1>Registro de Beneficiarios</h1>

<form action="registro.php" method="post">
<input type="hidden" value="<?php echo $cuitl;?>"  name="cuitl" size="2" maxlength="2">
<input type="hidden" value="<?php echo $apellido;?>"  name="apellido">
<input type="hidden" value="<?php echo $nombre;?>" name="nombre" size="30">
<input type="hidden" value="<?php echo $documento_tipo;?>" name="documento_tipo" size="30">
<input type="hidden"  value="<?php echo $documento_nro;?>" name="documento_nro" />
<input type="hidden" value="<?php echo $fecha;?>" name="fecha" /><!--fecha ya concatenada -->
<input type="hidden" value="<?php echo $fechaa;?>" name="fechai" /><!--fecha ya concatenada -->
<input type="hidden"  value="<?php echo $direccion_dpto_nro;?>" name="direccion_calle" size="30">
<input type="hidden" value="<?php echo $direccion_dpto_nro;?>" name="direccion_nro" size="5">
<input type="hidden"  value="<?php echo $direccion_dpto_nro;?>" name="direccion_piso" size="5">
<input type="hidden" value="<?php echo $direccion_dpto_nro;?>" name="direccion_dpto_nro" />
<input type="hidden" value="<?php echo $direccion_localidad;?>" name="direccion_localidad" />
<input type="hidden" value="<?php echo $direccion_dpto;?>" name="direccion_dpto" />
<input type="hidden" value="<?php echo $direccion_provincia; ?>" name="direccion_provincia" />
<input type="hidden" value="<?php echo $codigo_postal; ?>" name="codigo_postal" />
<input type="hidden" value="<?php echo $telefono; ?>" name="telefono" />
<input type="hidden" value="<?php echo $celular; ?>" name="celular"  />
<input type="hidden" value="<?php echo $banco_nombre; ?>" name="banco_nombre" />
<input type="hidden" value="<?php echo $banco_sucursal; ?>" name="banco_sucursal" />
<input type="hidden" value="<?php echo $banco_cta_tipo;?>" name="banco_cta_tipo" />
<input type="hidden" value="<?php echo $banco_cta_nro; ?>" name="banco_cta_nro"  />
<input type="hidden" value="<?php echo $razon_social; ?>" name="razon_social" /> 
<input type="hidden" value="<?php echo $sociedad_tipo;?>" name="sociedad_tipo" />
<input type="hidden" value="<?php echo $convenio_tipo; ?>" name="convenio_tipo" />
<input type="hidden" value="<?php echo $convenio_nro; ?>" name="convenio_nro" />
<input type="hidden" value="<?php echo $persona_tipo; ?>" name="persona_tipo" />
<input type="hidden" value="<?php echo $ingreso_bruto; ?>" name="ingreso_bruto"  />
<input type="hidden" value="<?php echo $iva_situacion; ?>" name="iva_situacion" />
<input type="hidden" value="<?php echo $fecha_alta_web;?>" name="fecha_alta_web" />
<input type="hidden" value="<?php echo $email; ?>" name="email" />

	<table border="0" align="center">
	<!--	<tr height=20px>
			<td colspan="2"><hr></td> 
		</tr>
	<tr>
			<td class="subtitle">ID Usuario</td>
			<td><input type="text" name="id_beneficiario" size="30"></td>
		</tr>
-->
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
		<tr>
			<td class="subtitle">Apellido</td>
			<td>
<?php 
                 echo $apellido;  if ($bandera_apellido ==1)
		                         { 
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000"><?php echo $error;?></font>
<?php                                }   
 ?>		  </td>
		</tr>
		<tr>
			<td class="subtitle">Nombres</td>
			<td>
<?php
                 echo $nombre;   if ($bandera_nombre ==1)
		                         { 
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000"><?php echo $error;?>
								  </font>
<?php                            
                                 }
?>             </td>
		</tr>
		<tr>
			<td class="subtitle">Tipo de Documento</td>
			<td>
<?php     
               $f_documento = mysql_fetch_array ($r_documento);
               echo $f_documento['descripcion'];
               if ($documento_tipo =='N')
		          { 
?>
					  <img  src="../img/ic_advertencia.gif" border="0"></img> 
					  <font color="#FF0000">
					   <?php echo $error;?>
					  </font>
<?php                                }  			   
			   
?>     	     </td>
		</tr>
		<tr>
			<td class="subtitle">Nro. de Documento</td>
			<td>
<?php 
              echo $documento_nro;  if ($bandera_dni ==1)
	               { 
?>
					  <img  src="../img/ic_advertencia.gif" border="0"></img> 
					  <font color="#FF0000">
					   <?php echo $error;?>
					  </font>
<?php       
                   }  			   
		
?>          </td>
		</tr>
		<tr>
			<td class="subtitle">Fecha de Nacimiento</td>
			<td><?php echo $fechaa; if ($bandera_fecha == 1)
	               { 
?>
					  <img  src="../img/ic_advertencia.gif" border="0"></img> 
					  <font color="#FF0000">
					   <?php echo $error;?> 
					  </font>
<?php       
                   }  			   
		
?>			</td>
		</tr>

		<tr height=20px>
			<td colspan="2"><hr></td>
		</tr>
		<tr>
		  <td class="subtitle">Calle</td>
		  <td><?php echo $direccion_calle;
                       if ($bandera_calle == 1)
	               { 
?>
					  <img  src="../img/ic_advertencia.gif" border="0"></img> 
					  <font color="#FF0000">
					   <?php echo $error;?>
					  </font>
<?php       
                   }  			   
		
?>		   </td>
		</tr>
		<tr>
	     <td class="subtitle">Numero</td>
		 <td><?php echo $direccion_nro; if ($bandera_numero == 1)
	               { 
?>
					  <img  src="../img/ic_advertencia.gif" border="0"></img> 
					  <font color="#FF0000">
					  <?php echo $error;?>
					  </font>
<?php       
                   }  			   
		
?>      </td>
		</tr>
		<tr>
		 <td class="subtitle">Piso</td>
	     <td><?php echo $direccion_piso;?></td>
		</tr>
		<tr>
	 	  <td class="subtitle">Departamento Nro.</td>
		  <td><?php echo $direccion_dpto_nro;?></td>
		</tr>
		<tr>
			<td class="subtitle">Provincia</td>
			<td>
<?php
			 $f_provincia= mysql_fetch_array ($r_provincia);
             echo $f_provincia['nombre'];  if ($direccion_provincia =='N')
		          { 
?>
					  <img  src="../img/ic_advertencia.gif" border="0"></img> 
					  <font color="#FF0000">
					 <?php echo $error;?>
					  </font>
<?php                                }  			   
			   
?>   		    </td>
		</tr>
		<tr>
			<td class="subtitle">Departamento</td>
			<td><?php
			  $f_departamento= mysql_fetch_array ($r_departamento);
			  echo $f_departamento['nombre']; if ($direccion_dpto =='N')
		          { 
?>
					  <img  src="../img/ic_advertencia.gif" border="0"></img> 
					  <font color="#FF0000">
					   <?php echo $error;?>
					  </font>
<?php                                }  			   
			   
?>   		
           </td>
		</tr>
		<tr>
			<td class="subtitle">Localidad</td>
			<td>
<?php
			  $f_localidad= mysql_fetch_array ($r_localidad);
			  echo $f_localidad['descripcion'];
                if ($direccion_localidad =='S')
		          { 
?>
					  <img  src="../img/ic_advertencia.gif" border="0"></img> 
					  <font color="#FF0000">
					   <?php echo $error;?>
					  </font>
<?php                                }  			   
			   
?>   					</td>
		</tr>
		
		<tr>
			<td class="subtitle">Codigo Postal</td>
			<td><?php echo $codigo_postal; ?></td>
		</tr>
		<tr height=20px>
			<td colspan="2"><hr></td>
		</tr>
		<tr>
			<td class="subtitle">Razon Social</td>
			<td><?php echo $razon_social; if ($bandera_razon == 1)
	               { 
?>
					  <img  src="../img/ic_advertencia.gif" border="0"></img> 
					  <font color="#FF0000">
					  <?php echo $error;?>
					 </font>
<?php       
                   } 
?>
		   </td>
		</tr>
		<tr>
			<td class="subtitle">Tipo de Persona</td>
			<td><?php if ($persona_tipo=='S')
			               {
						   $tipo='Sin Especificar';
						   }
					   if ($persona_tipo=='F')
			               {
						   $tipo='Fisica';
						   }	    
					    if ($persona_tipo=='J')
			               {
						   $tipo='Juridica';
						   }	
					    if ($persona_tipo=='E')
			               {
						   $tipo='Juridica Especial';
						   }	
					echo $tipo;  
					 if ($persona_tipo =='S')
		                   { 
?>
					  <img  src="../img/ic_advertencia.gif" border="0"></img> 
					  <font color="#FF0000">
					   <?php echo $error;?>
					  </font>
<?php                                }  			   
			   
?>   			
		</td>
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
					  <?php echo $error;?>
					  </font>
<?php                                }  			   
			   
?>   			
				  	</td>
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
			   
?>   			
			</td>
		</tr>
		<tr>
			<td class="subtitle">Nro. de Ingreso Bruto</td>
			<td><?php echo $ingreso_bruto; if ($bandera_ingreso_bruto ==1)
		                         { 
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000">
								  <?php echo $error;?>
								 </font>
<?php
                                 }   
 ?>		 			</td>
		</tr>

		<tr>
			<td class="subtitle">Fecha Inicio de Actividad</td>
			<td><?php echo $f_id.'-'.$f_im.'-'.$f_ia; if ($bandera_fechai == 1)
	               { 
?>
					  <img  src="../img/ic_advertencia.gif" border="0"></img> 
					  <font color="#FF0000">
					   <?php echo $error;?>
					  </font>
<?php       
                   }  			   
		
?>	                    </td>
		</tr>
		<tr>
			<td class="subtitle">Tipo de Convenio</td>
			<td>
<?php
            if ($convenio_tipo=='S')
			    {
				  $convenio='Sin Especificar';
				}
			if ($convenio_tipo=='M')
			    {
				  $convenio='Multilateral';
				}	
			if ($convenio_tipo=='B')
			    {
				  $convenio='Bilateral';
				}		
				echo $convenio;
?>			</td>
		</tr>
		<tr>
			<td class="subtitle">Nro. de Convenio</td>
			<td><?php echo $convenio_nro; ?></td>
		</tr>

		<tr height=20px>
			<td colspan="2"><hr></td>
		</tr>

		<tr>
			<td class="subtitle">Nombre de Banco</td>
			<td>
<?php     
       
                   $f_banco = mysql_fetch_array ($r_banco);
                    echo $f_banco['nombre']; 
					if ($banco_nombre =='N')
		          { 
?>
					  <img  src="../img/ic_advertencia.gif" border="0"></img> 
					  <font color="#FF0000">
					  <?php echo $error;?>
					  </font>
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
			<td>
<?php     
                    $f_bcocta = mysql_fetch_array ($r_bcocta);
	                echo $f_bcocta['nombre'];  if ($banco_cta_tipo =='N')
		          { 
?>
					  <img  src="../img/ic_advertencia.gif" border="0"></img> 
					  <font color="#FF0000">
					  <?php echo $error;?>
					   </font>
<?php                                }  			   
			   
?>   		
                     
		      </td>
		</tr>
		<tr>
			<td class="subtitle">Nro. de Cuenta</td>
			<td><?php echo $banco_cta_nro;  if ($bandera_cta_nro == 1)
	               { 
?>
					  <img  src="../img/ic_advertencia.gif" border="0"></img> 
					  <font color="#FF0000">
					   <?php echo $error;?>  
					  </font>
<?php       
                   }  	
?>				    <td>
		</tr>
		<tr height=20px>
			<td colspan="2"><hr></td>
		</tr>
<?php
     if($bandera==1)
	    {
?>
        <tr>
			<td colspan="2" align="center">
			<a href='javascript:window.history.back()'><input type="button" value="Modificar"></a>			</td>
		</tr>
<?php 		
		}
else
        {
?>						
		<tr>
			<td colspan="2" align="center">
			    <a href='javascript:window.history.back()'><input type="button" value="Modificar"></a>
				<input type="submit" name="grabar" value="Grabar Datos">			</td>
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