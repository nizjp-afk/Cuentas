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
  $cuitl = $_POST['cuitl'];
  $id_bene = $_POST['id_bene'];
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
  $fechac=$f_cd.'-'.$f_cm.'-'.$f_ca;
  $fechacb=$f_ca.'-'.$f_cm.'-'.$f_cd;
  
 
  //banco
  
  $banco_nombre = $_POST['banco_nombre'];
  $banco_sucursal = $_POST['banco_sucursal'];
  $banco_cta_tipo = $_POST['banco_cta_tipo'];
  $banco_cta_nro = $_POST['banco_cta_nro'];
  $banco_cbu = $_POST['banco_cbu'];
  

 //datos de alta web 
 
  $fecha_alta_web = date("d/m/Y");
 
  
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


		
  
		
 //cuenta nro
    $patron = "[[:digit:]]{7,11}";
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
 			
   	if($cargo=='')
	   {
	    $bandera=1;
	   }		
 
		if($area=='')
	   {
	    $bandera=1;
	   }	
	   
	  if($saf=='')
	   {
	    $bandera=1;
	   } 		
?>
<div class="content">

<?php
if (!($valormod=='M'))
   {
     if ($bandera == 1) 
	   {
	   
?>	   
      <form action="indextesoreria.php?sec=tesoreria/nuevo_saf" method="post">
<?php
	   }
	 else
	   {
?>	     
<form action="indextesoreria.php?sec=tesoreria/registro_saf" method="post">
<?php 
        }
    }
else
    {
	     if ($bandera == 1) 
	   {
	   
?>	   
      <form action="indextesoreria.php?sec=tesoreria/modificar_o" method="post">
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
<input type="hidden" name="id" value="<?php echo $cuitl; ?>" >

<!--datos identificacion -->

<input type="hidden" value="<?php echo $apellido;?>"  name="apellido">
<input type="hidden" value="<?php echo $nombre;?>" name="nombre" size="30">
<input type="hidden" value="<?php echo $documento_tipo;?>" name="documento_tipo" size="30">
<input type="hidden"  value="<?php echo $documento_nro;?>" name="documento_nro" />
<input type="hidden" value="<?php echo $fecha;?>" name="fecha_nacimiento" /><!--fecha ya concatenada -->
<input type="hidden" value="<?php echo $area;?>" name="area" size="30">
<input type="hidden" value="<?php echo $cargo;?>" name="cargo" size="30">
<input type="hidden"  value="<?php echo $saf;?>" name="saf" />
<input type="hidden" value="<?php echo $fechacb;?>" name="fecha_gestion" />

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


<!-- actividad comercial -->


<!--datos para sistema -->
<input type="hidden" value="<?php echo $fecha_alta_web;?>" name="fecha_alta_web" />


<table border="0" align="center">
	<tr>
		<td colspan="2"><h1>Validacion Saf</h1></td>
	</tr>
	<tr height=10px>
		<td colspan="2"><hr></td>
	</tr>
	   <tr>
		  <td class="subtitle">Nro. CUIL | CUIT</td>
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
			<td colspan="2"><h4>&nbsp;Datos de Identificacion</h4></td>
		</tr>
		<tr height="2px">
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td class="subtitle">Apellido</td>
			<td>
<?php 
                 echo $apellido; 
				   if($apellido=='')
				      {
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000"><?php echo $error1;?></font>
<?php
                       }
					      
 	               else
				       {  
					     if ($bandera_apellido ==1)
		                         { 
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000"><?php echo $error;?></font>
<?php                                }  
                        }  
 ?>		  </td>
		</tr>
		<tr>
			<td class="subtitle">Nombres</td>
			<td>
<?php
                 echo $nombre;  
				    if($nombre=='')
				      {
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000"><?php echo $error1;?></font>
<?php
                       }
					      
 	               else
				       {  
					    if ($bandera_nombre ==1)
		                         { 
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000"><?php echo $error;?>								  </font>
<?php                            
                                 }
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
					   <?php echo $error1;?>					  </font>
<?php                                }  			   
			   
?>     	     </td>
		</tr>
		<tr>
			<td class="subtitle">Nro. de Documento</td>
			<td>
<?php 
              echo $documento_nro; 
			     if($documento_nro=='')
				      {
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000"><?php echo $error1;?></font>
<?php
                       }
					      
 	               else
				       {  
					    if ($bandera_dni ==1)
	                       { 
?>
					  <img  src="../img/ic_advertencia.gif" border="0"></img> 
					  <font color="#FF0000">
					   <?php echo $error;?>					  </font>
<?php       
                            }
					 }		  			   
		
?>          </td>
		</tr>
		<tr>
			<td class="subtitle">Fecha de Nacimiento</td>
			<td><?php echo $fechaa;
			 if($fechaa=='-----------')
				      {
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000"><?php echo $error1;?></font>
<?php
                       }
					      
 	               else
				       { 
			            if ($bandera_fecha == 1)
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
		<td class="subtitle">Area de Gobierno</td>
		<td><?php echo $area; 
		  	    if($area=='')
				      {
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000"><?php echo $error1;?></font>
<?php
                       }
?>					   
					   </td>
	</tr>
	<tr>
		<td class="subtitle">Cargo</td>
		<td><?php echo $cargo; 
		 if($cargo=='')
				      {
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000"><?php echo $error1;?></font>
<?php
                       }
?>				
		  </td>
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
		<td><?php echo $saf;  if($saf=='')
				      {
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000"><?php echo $error1;?></font>
<?php
                       }
?>				</td>
	</tr>
		<tr height=10px>
		<td colspan="2"></td>
	</tr>
	
		
		<tr height=10px>
		<td colspan="2"></td>
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
			<td>
<?php     
       
                   $f_banco = mysql_fetch_array ($r_banco);
                    echo $f_banco['nombre']; 
					if ($banco_nombre =='N')
		          { 
?>
					  <img  src="../img/ic_advertencia.gif" border="0"></img> 
					  <font color="#FF0000">
					  <?php echo $error1;?>					  </font>
<?php                                }  			   
			   
?>		</td>
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
				   $bandera=1;
?>
					  <img  src="../img/ic_advertencia.gif" border="0"></img> 
					  <font color="#FF0000">
					  <?php echo $error1;?>					   </font>
<?php                                }  			   
			   
?>		      </td>
		</tr>
		<tr>
			<td class="subtitle">Nro. de Cuenta</td>
			<td><?php echo $banco_cta_nro;
			 if($banco_cta_nro=='')
				      {
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000"><?php echo $error1;?></font>
<?php
                       }
					      
 	               else
				       {  
			            if ($bandera_cta_nro == 1)
	                    { 
?> 
					  <img  src="../img/ic_advertencia.gif" border="0"></img> 
					  <font color="#FF0000">
					   <?php echo $error;?>					  </font>
<?php       
                        } 
					}	 	
?>				    <td>
		</tr>
		<tr>
			<td class="subtitle">Nro. C.B.U.</td>
			<td><?php echo $banco_cbu;
			      if($banco_cta_nro=='')
				      {
?>
                                  <img  src="../img/ic_advertencia.gif" border="0"></img> 
								  <font color="#FF0000"><?php echo $error1;?></font>
<?php
                       }
					      
 	               else
				       {
			             if ($bandera_cbu == 1)
	                        { 
?>
					  <img  src="../img/ic_advertencia.gif" border="0"></img> 
					  <font color="#FF0000">
					   <?php echo $error;?>					  </font>
<?php       
                            }  
						}			 ?></td>
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
			<input type="submit" value="Modificar" name="modi">			</td>
		</tr>
<?php 		
		}
else
        {
?>						
		<tr  >
		  <td colspan="2" align="center">
			   <input type="submit" name="grabar" value="Siguiente">			
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