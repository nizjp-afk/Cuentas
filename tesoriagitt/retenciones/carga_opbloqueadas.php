<?php
//conexion
error_reporting (E_ERROR); 
$aplicacion = $_GET['apli'];
$permisosnecesarios = $_GET['per'];
include('incluir_siempre.php');
include('dgti-mysql-var_dgti-beneficiarios.php');
include('dgti-intranet-mysql_connect.php');  
include('dgti-intranet-mysql_select_db.php');
include('conexion/extras.php');

 $fecha=date('Y-m-d');

$ssql = "SELECT * FROM tipo_op_bloqueadas";
     if (!($r_tipo_opbloqueadas = mysqli_query($conexion_mysql,$ssql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de op bloqueadas";
      echo $cuerpo1;
      //.....................................................................
    }
    
 $ssql = "SELECT * FROM beneficiarios_aprobados order by cuitl  ";
     if (!($r_bene = mysqli_query($conexion_mysql,$ssql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar listar beneficiarios";
      echo $cuerpo1;
      //.....................................................................
    }  
	  
if (!(isset($_POST['aceptar'])))
{
?>
<div class="content">

<form action="indextesoreria.php?sec=retenciones/carga_opbloqueadas&apli=cr&per=C" method="post" name="bloqueo" >	
<table border="0" cellpadding="0" align="center" width="80%">
	<tr>
		<td colspan="3"><h1>Cargar Bloqueo de OP</h1></td>
	</tr>
	<tr height="10px">
		<td colspan="3"><hr></td>
	</tr>
        <tr>
            <td>
                Ejercicio
            </td>
            <td>
            <select name="ejercicio" required >
                      <option  value="">A&ntilde;o</option>
                      <?php
                        $fechaactual=strtotime('now');
                        $anioactual=substr(date('d/m/Y',$fechaactual),6,4);
                       // $anioactual=$anioactual-1;
						for ($i=1;$i<3;$i++)
                        {
                        echo "<option value='$anioactual'";
                       
                        echo ">".$anioactual."</option>";
                        $anioactual=$anioactual-1;
                        }
                        
                        
						
?>
                     </select> 
            
            
                
            </td>
        </tr>
        <tr>
            <td>
               Saf
            </td>
            <td>
                <input type="text" name="saf" id="safopb" maxlength="3" required>
            </td>
        </tr>
        <tr>
            <td>
                Numero Esidif
            </td>
            <td>
                <input type="text" id="nroesi" name="nro_esidif" required>
            </td>
        </tr>
        <tr>
            <td>Cuit Beneficiario</td>
            
            <td>
                    <select name="cuit"  onChange="bene()" required>
                    <option value="">Seleccionar</option>
                        <?php
                                          
                        while ($fila =  mysqli_fetch_array($r_bene))
                            {
								if ($fila['razon_social']=='')
	                                   {
										$bene=$fila['apellido'].', '.$fila['nombre']; 
													
										}
									else 
									   {
										$bene= $fila['razon_social']; }
								
								
                                    echo '<option value="'.$fila['cuitl'].'">'.$fila['cuitl'].' '.substr($bene,0,45).'</option>';
                            }
                        ?>
                    </select>                        
            </td>
        </tr>
        
        <tr>
            <td>Tipo Bloqueo</td>
            
            <td>
                    <select name="tipo_bloqueo" required>
                     <option value="" >Seleccionar</option>
                        <?php
                                              
                        while ($fila =  mysqli_fetch_array($r_tipo_opbloqueadas))
                            {
                                    echo '<option value="'.$fila['id'].'">'.$fila['nro_motivo'].'-'.$fila['cod_descripcion'].'-'.$fila['descripcion'].'</option>';
                            }
                        ?>
                    </select>                       
            </td>
        </tr>
          
        <tr>
            <td>Observaciones Bloqueo</td>
            <td>
                <textarea name="observaciones" rows="4" cols="50"></textarea>
            </td>
            
        </tr>    
        
    <tr>
        <td><input type="submit" name="aceptar" value="Aceptar" />
	</td>               
	</tr>
	<tr height=10px>
		<td colspan="3"><hr></td>
	</tr>
</table>
</form>
<?php
}
else
   {
	   
    $saf                =    $_POST['saf'];
    $tipo_bloqueo_id    =    $_POST['tipo_bloqueo'];
    $nro_esidif         =    $_POST['nro_esidif'];
    //$razon_social       =    $_POST['razon_social'];
    $cuit               =    $_POST['cuit'];
    $observaciones      =    $_POST['observaciones'];
    $ejercicio          =    $_POST['ejercicio'];
    
    $clave=$ejercicio.''.$saf.'PRE'.$nro_esidif;
	
	$ve='B';
	
	$orden='PRE'.$nro_esidif;
	
	 $ssql = "SELECT * FROM op_bloqueadas WHERE clave='$clave' and estado='B'";
     if (!($r_bloqueo = mysqli_query($conexion_mysql,$ssql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de op bloqueadas";
      echo $cuerpo1;
	  exit;      
      //.....................................................................
    }
	
	 $can1=mysqli_num_rows($r_bloqueo);
			
			 				  
if($can1 == 0)
  {
	
 echo $ssql='INSERT INTO `op_bloqueadas`(`ejercicio`,`clave`,
                                      `saf`,
                                      `nro_esidif`,
                                      `cuit_beneficiario`,
                                      `id_tipo_op_bloqueada`,
                                      `observaciones`,`estado`,`fecha`)
           VALUES ("'.$ejercicio.'",
		           "'.$clave.'", 
                   "'.$saf.'",
                   "'.$nro_esidif.'",
                   "'.$cuit.'",
                   "'.$tipo_bloqueo_id.'",
                   "'.$observaciones.'",
				   "'.$ve.'",
				   "'.$fecha.'");';
    
    
    
    
    if (!($r_tipo_opbloqueadas = mysqli_query($conexion_mysql,$ssql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar insertar tipo de op bloqueadas";
      echo $cuerpo1;
      //.....................................................................
    }
	else
	 {
		 
	 
    $dato_h=$fecha.': Orden Visada -'.$observaciones;
	
///////////////////antecedente
   $sql="INSERT INTO historial_orden (ejercicio,numero_op,saf,observacion,usuario)
        VALUES('$ejercicio','$orden','$saf','$dato_h','$usuario')";

       if (!($r_ef = mysqli_query($conexion_mysql,$sql)))
         {
            //.....................................................................
            // INFORMA  DE ERROR PRODUCIDO//
            $cuerpo1  = "al intentar insertar historial";
            $cuerpo2  = "Base de datos                 = ".$mysql_basededatos.$emaillinea;
            $cuerpo2 .= "Sentencia sql                 = ".$ssql.$emaillinea;
           echo $cuerpo1;
            exit;
            //.....................................................................
         }  

    
	
		 
      echo "<h2>La Orden ".$nro_esidif." fue Bloqueada Correctamente</h2>";
	 
	 
	 
	 
	  
	  ?>
	  <center><h1>Guardando</h1></center>
	
	<center><img src="img/loader_guardando.gif" width="100" height="100" />
	<p>Sus Datos Fueron Grabados con Exito.</p></center>
<code>Haga click <a href='indextesoreria.php?sec=retenciones/carga_opbloqueadas&apli=cr&per=D&band=S'>aqu&iacute;</a> para regresar.</code>
		  
</div>

<div class="sidenav">
</div>

<div class="clearer"><span></span></div>
	 <?php
     }
   }
  else
     {
?>		 
	 <center><h1>Error!</h1></center>
<meta http-equiv='refresh' content='10;url=javascript:window.history.back()'>
<center><img src="../img/messagebox_critical.png" width="128" height="128" />
<p>Se ha detectado un error.
Ud. ingreso ORDEN DE PAGO YA BLOQUEADA. <b>  <ul>

</li>
</ul></p></center>

<code>Espere unos segundos el Sistema se redirigir&aacute; automaticamente.
O haga click <a href='javascript:window.history.back()'>aqu&iacute;</a>.</code>		  
</div>

<div class="sidenav">
</div>

<div class="clearer"><span></span></div>
     
	  <?php
      exit;       
	  
	  } 



   }
                          ?>	
<br />
<br />
      
		
</div>

<div class="sidenav">
<h2></h2>
<ul>
 
      <li><a href="indextesoreria.php?sec=tesoreria/index1&apli=tgp&per=C">Regresar Menu</a></li>
	
	<!-- <li><a href="indextesoreria.php?sec=tesoreria/saf_consulta&apli=tgpc&per=A">Beneficiarios - SAF</a> </li>-->
</ul>
</div>
<div class="clearer"><span></span></div>