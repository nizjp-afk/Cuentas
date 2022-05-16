<?php 
	/////////////////CONEXION DB///////////////////
	$mysqli= new mysqli("localhost", "root", "", "cuentas");
			if ($mysqli->connect_errno) {
				echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
				}
				$mysqli->host_info . "\n";
	//////////////////////////////////////////////////
	error_reporting(E_ALL ^ E_NOTICE);
	
	//  hora tomada del servidor
	$hora = date("H:i:s",(time()-1*3600));
	$yy=date("Y");	
	$year=date("Y");
	$año=date("Y");

 	//$aplicacion = $_GET['apli'];
 	//$permisosnecesarios = $_GET['per'];
	//////////////////////////////////////	 
	// https://es.stackoverflow.com/questions/55527/c%C3%B3mo-puedo-insertar-datos-en-tablas-relacionadas
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
			$denominacion= $_POST['denominacion'];
			$cuit_solicitante=$_POST['cuit'];
			//$denominacion_titular=$_POST['nombre']
			$cuit_titular=$_POST['cuit_titular'];
			$direccion= $_POST['direccion'];
			$localidad= $_POST['localidad'];	
			$codigo_postal= $_POST['codigo_postal'];
			$banco_id= $_POST['banco_id'];
			$tipo_cta_id= $_POST['tipo_cta_id'];
			$nro_cuenta= $_POST['nro_cuenta'];
			$tipo_moneda= $_POST['tipo_moneda_id'];
			$cbu = $_POST['cbu'];
			$fuente_id= $_POST['fuente_id'];
			$resolucion= $_POST['resolucion'];
			$clasificacion_cta= $_POST['clasificacion_cta'];
			$responsable_id= $_POST['responsable_id'];
			$organismo_id= $_POST['organismo_id'];
			$nombre_completo = array($_POST['nombre_completo1'] , $_POST['nombre_completo2'] , $_POST['nombre_completo3'] , $_POST['nombre_completo4']);
			$dni = array($_POST['dni1'] , $_POST['dni2'] , $_POST['dni3'] , $_POST['dni4']);
			$cargo = array($_POST['cargo1'] , $_POST['cargo2'] , $_POST['cargo3'] , $_POST['cargo4']);
			

			$query = "SELECT * FROM saf where cuit = $cuit_solicitante order by id_saf";
			$result = mysqli_query($mysqli, $query);
			$value = mysqli_fetch_array($result);
			
			$id_firm= $_POST['responsable_id'];
			$cuenta_id = $_POST['id'];   
			$saf_id= $value['id_saf'];
			$codigo = $value['cod_ser'];
			$resp_id = $value['id'];


			echo $sql = "INSERT INTO `r_cuentas` (`denominacion` , `cuit` , `direccion` , `localidad` , `codigo_postal` , `banco_id` , `tipo_cta_id` , `nro_cuenta` , `tipo_moneda_id` , `cbu` , `fuente_id` , `resolucion` , `clasificacion_cta` , `responsable_id` , `saf_id` , `organismo_id`)
			VALUE ('$denominacion','$cuit_solicitante','$direccion','$localidad','$codigo_postal','$banco_id','$tipo_cta_id','$nro_cuenta','$tipo_moneda','$cbu', '$fuente_id','$resolucion','$clasificacion_cta','$responsable_id','$saf_id','$organismo_id')"; 
			mysqli_query ($mysqli, $sql);

			 $r_cuentas_id=mysqli_insert_id($mysqli);

			//$query = "SELECT * FROM r_responsable where dni= $dni[$i] ORDER BY id";
			//$resultado=mysqli_query($mysqli,$query) or die (mysqli_error($mysqli));

			for ($i=0;$i<count($dni);$i++)
			{
			 echo "<br>" . $i . ": " . $dni[$i];
			 echo "<br>" . $i . ": " . $nombre_completo[$i];
			 echo "<br>" . $i . ": " . $cargo[$i];
			
			 $query_r = "SELECT * FROM r_responsable where dni= $dni[$i] order by id";
			 $resultado=mysqli_query($mysqli,$query_r) or die (mysqli_error($mysqli));
			  	
             if (mysqli_num_rows($resultado)>0 === TRUE) {

					  echo "Datos:";
				
			 	 }else {
						echo $sql = "INSERT INTO r_responsable (r_cuentas_id,nombre_completo, dni, cargo)
						VALUES('$r_cuentas_id','$nombre_completo[$i]', '$dni[$i]', '$cargo[$i]')";
						$mysqli->query($sql);
					}
				//exit();
				  		
			} 

			//////insertar nuevo registro tabla cuentas//////

					foreach($_FILES["file"]['tmp_name'] as $key => $tmp_name)
			{
				//Validamos que el archivo exista
				if($_FILES["file"]["name"][$key]) {
					$filename = $_FILES["file"]["name"][$key]; //Obtenemos el nombre original del archivo
					$source = $_FILES["file"]["tmp_name"][$key]; //Obtenemos un nombre temporal del archivo
					
					$directorio = 'documentos/'; //Declaramos un  variable con la ruta donde guardaremos los archivos
					
				$dir=opendir($directorio); //Abrimos el directorio de destino
					$target_path = $directorio.'/'.$filename; //Indicamos la ruta de destino, así como el nombre del archivo
					
					//Movemos y validamos que el archivo se haya cargado correctamente
					//El primer campo es el origen y el segundo el destino
					if(move_uploaded_file($source, $target_path)) {	
						echo "El archivo $filename se ha almacenado en forma exitosa.<br>";


					$ssql = "INSERT INTO r_archivos (r_cuentas_id,nombre_archivo)
										VALUES ('$r_cuentas_id','$filename')";
								if (!($r_foto = mysqli_query($mysqli,$ssql)))
									{
									
									//.....................................................................
									// informa del error producido
									$cuerpo1  = "al intentar dar de alta documentos";
									$cuerpo2  = "Base de datos                 = ".$mysql_basededatos.$emaillinea;
									$cuerpo2 .= "Sentencia sql                 = ".$ssql.$emaillinea;
									$asunto   = "[Error 3]";
									echo $cuerpo1;
										exit;
									//.....................................................................
									}

					
						} else {	
						echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
					}
					closedir($dir); //Cerramos el directorio de destino
				}
			}
			
		
		$accion='Alta Ingreso';
		$tabla='datos_ingresos';
		include('agrego_movi.php'); 
	
	}
	else
	{
?>
<meta http-equiv='refresh' content='20;url=indexctas.php?sec=cuentas_cta/grillalista'>
<?php
	}

	?>
<table width="505" border="0" align="center">
    <tr>
        <td width="499" align="center">
            <!-- <p class="Estilo2 style1 Estilo1"><img src="img/loader_guardando.gif" width="100" height="100" /></p>  -->
            <p class="Estilo2 style1">
                <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Espere unos segundos el Sistema se
                    Redirigir&aacute; autom&aacute;ticamente
                    <br>
                    <br>
                    Gracias
                </font>
            </p>
        </td>
    </tr>
</table>
</meta>