<?php
error_reporting ( E_ERROR ); 
  include('dgti-mysql-var_dgti-beneficiarios.php');
  include('dgti-intranet-mysql_connect.php');  
  include('dgti-intranet-mysql_select_db.php');
  include('conexion/extras.php');
  
  $bandera=0;
  $error1='Esta informacion es necesaria no puede quedar el campo en blanco';
  $error='Los datos fueron mal ingresados';
  
  $aplicacion = $_GET['apli'];
  $permisosnecesarios = $_GET['per'];
  include('incluir_siempre.php');   
  
  $valormod=$_POST['modificar'];
  $cuitl = $_POST['cuitl_1'].$_POST['cuitl_2'].$_POST['cuitl_3'];
  $cuitl_1 = $_POST['cuitl_1'];
  $cuitl_2 =$_POST['cuitl_2'];
  $cuitl_3 = $_POST['cuitl_3'];
  $id_bene = $_POST['id_bene'];
  
  $apellido= strtoupper($_POST['apellido']);
  $nombre = ucwords(strtolower($_POST['nombre']));   
  $documento_tipo = $_POST['documento_tipo'];
  $documento_nro = $_POST['documento_nro'];
  $razon_social= strtoupper($_POST['razon_social']);
  $tipo=$_POST['tipo'];

  //banco
  
  $banco_nombre = $_POST['banco_nombre'];
  $banco_sucursal = $_POST['banco_sucursal'];
  $banco_cta_tipo = $_POST['banco_cta_tipo'];
  $banco_cta_nro = $_POST['banco_cta_nro'];
  $banco_cbu = $_POST['banco_cbu'];
  
  
  $fecha_modi_web = date("d/m/Y");
  $usuario_aprobo=$nombre; 
      
 
 $ssql = "SELECT * FROM `beneficiarios_aprobados` where id_beneficiario='$id_bene' and cbu='$banco_cbu'";
     if (!($r_cbu= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar actividad";
      echo $cuerpo1;
      //.....................................................................
    }  
	

$cant = mysql_num_rows($r_cbu); 
	  
	 if ($cant == 0)
		    {
			 $ssql = "SELECT * FROM `beneficiarios_aprobados` where cbu='$banco_cbu'";
                 if (!($r_cbu= mysql_query($ssql, $conexion_mysql)))
                     {
	
                       //.....................................................................
                       // informa del error producido
                       $cuerpo1  = "al intentar buscar actividad";
                       echo $cuerpo1;
                      //.....................................................................
                     }  
	
	
	        $cantc = mysql_num_rows($r_cbu);
			
			 if ($cantc > 0)
		    {
			$bande=7;
?>			
			  <meta http-equiv='refresh' content='0;url=indextesoreria.php?sec=tesoreria/error&ban=<?php echo $bande; ?>' />
<?php	
			} 
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
 			
   		
?>
<div class="content">

<?php
if ($bandera == 1) 
	   {
	   
?>	   
      <form action="indextesoreria.php?sec=contaduria/modificarcta_f&apli=tgpa&per=M" method="post">
<?php
	   }
	 else
	   {
?>	     
<form action="indextesoreria.php?sec=contaduria/updatecta_f&apli=tgpa&per=M" method="post">
<?php 
        }
			  
			  
?>		


<input type="hidden" value="<?php echo $cuitl;?>"  name="cuitl" size="2" maxlength="2">
<input type="hidden" value="<?php echo $cuitl_1;?>"  name="cuitl_1" size="2" maxlength="2">
<input type="hidden" value="<?php echo $cuitl_2;?>"  name="cuitl_2" size="2" maxlength="2">
<input type="hidden" value="<?php echo $cuitl_3;?>"  name="cuitl_3" size="2" maxlength="2">
<input type="hidden" name="id_bene" value="<?php echo $id_bene; ?>" >

<!--datos identificacion -->

<!--datos identificacion -->
<input type="hidden" value="<?php echo $razon_social;?>"  name="razon_social">
<input type="hidden" value="<?php echo $apellido;?>"  name="apellido">
<input type="hidden" value="<?php echo $nombre;?>" name="nombre" size="30">
<input type="hidden" value="<?php echo $documento_tipo;?>" name="documento_tipo" size="30">
<input type="hidden"  value="<?php echo $documento_nro;?>" name="documento_nro" />
<input type="hidden" value="<?php echo $fecha;?>" name="fecha_nacimiento" /><!--fecha ya concatenada -->
<input type="hidden" value="<?php echo $area;?>" name="area" size="30">
<input type="hidden" value="<?php echo $cargo;?>" name="cargo" size="30">
<input type="hidden"  value="<?php echo $saf;?>" name="saf" />
<input type="hidden" value="<?php echo $fechacb;?>" name="fecha_gestion" />


<!--datos banco -->

<input type="hidden" value="<?php echo $banco_nombre; ?>" name="banco_nombre" />
<input type="hidden" value="<?php echo $banco_sucursal; ?>" name="banco_sucursal" />
<input type="hidden" value="<?php echo $banco_cta_tipo;?>" name="banco_cta_tipo" />
<input type="hidden" value="<?php echo $banco_cta_nro; ?>" name="banco_cta_nro"  />
<input type="hidden" value="<?php echo $banco_cbu; ?>" name="banco_cbu"  />



<table border="0" align="center">
	<tr>
		<td colspan="2"><h1>Validacion </h1></td>
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
<?php
           if($tipo=='j')
		     {
?>			 		
		<tr>
			<td class="subtitle">Denominacion de la Entidad: </td>
			<td>
<?php
                      echo $razon_social; 
             }
			else
			 { 
?>            </td>
		</tr>						
		
		
		<tr>
			<td class="subtitle">Apellido</td>
			<td><?php  echo $apellido; ?> </td>
		</tr>
		<tr>
			<td class="subtitle">Nombres</td>
			<td><?php echo $nombre;  ?>	        </td>
		</tr>
		<tr>
			<td class="subtitle">Tipo de Documento</td>
			<td>
<?php     
               $f_documento = mysql_fetch_array ($r_documento);
               echo $f_documento['descripcion']; ?>   </td>
		</tr>
		<tr>
			<td class="subtitle">Nro. de Documento</td>
			<td>
<?php 
              echo $documento_nro; ?>			</td>
		</tr>
		
<?php
   }
?>   		
		<tr height=10px>
		<td colspan="2"></td>
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
			<td><?php     
                    $f_bcocta = mysql_fetch_array ($r_bcocta);
	                echo $f_bcocta['nombre'];  if ($banco_cta_tipo =='N')
		          { 
				   $bandera=1;
?>			  <img  src="../img/ic_advertencia.gif" border="0"></img> 
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
		      <a href="indextesoreria.php?sec=tesoreria/beneficiarios_aprobado_modi&apli=tgpa&per=A"><img src="img/cancelar.jpg" width="60" height="20" border="0"/></a>
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