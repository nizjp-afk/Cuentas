<?php 
/*
	//Como el elemento es un arreglos utilizamos foreach para extraer todos los valores
	foreach($_FILES["archivo"]['tmp_name'] as $key => $tmp_name)
	{
		//Validamos que el archivo exista
		if($_FILES["archivo"]["name"][$key]) {
			$filename = $_FILES["archivo"]["name"][$key]; //Obtenemos el nombre original del archivo
			$source = $_FILES["archivo"]["tmp_name"][$key]; //Obtenemos un nombre temporal del archivo
			
			$directorio = 'docs/'; //Declaramos un  variable con la ruta donde guardaremos los archivos
			
			//Validamos si la ruta de destino existe, en caso de no existir la creamos
			if(!file_exists($directorio)){
				mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");	
			}
			
			$dir=opendir($directorio); //Abrimos el directorio de destino
			$target_path = $directorio.'/'.$filename; //Indicamos la ruta de destino, así como el nombre del archivo
			
			//Movemos y validamos que el archivo se haya cargado correctamente
			//El primer campo es el origen y el segundo el destino
			if(move_uploaded_file($source, $target_path)) {	
				echo "El archivo $filename se ha almacenado en forma exitosa.<br>";
				} else {	
				echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
			}
			closedir($dir); //Cerramos el directorio de destino
		}
	}
?>*/
  $aplicacion = $_GET['apli'];
  $permisosnecesarios = $_GET['per'];
 include('../incluir_siempre.php');

//estable la conexion  

    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
 
         
//variables recibidas

 $id=$_POST['id'];

 
		 foreach($_FILES["archivo"]['tmp_name'] as $key => $tmp_name)
	{
		//Validamos que el archivo exista
		if($_FILES["archivo"]["name"][$key]) {
			$filename = $_FILES["archivo"]["name"][$key]; //Obtenemos el nombre original del archivo
			$source = $_FILES["archivo"]["tmp_name"][$key]; //Obtenemos un nombre temporal del archivo
			
			$directorio = 'documentos/'; //Declaramos un  variable con la ruta donde guardaremos los archivos
			
	    $dir=opendir($directorio); //Abrimos el directorio de destino
			$target_path = $directorio.'/'.$filename; //Indicamos la ruta de destino, así como el nombre del archivo
			
			//Movemos y validamos que el archivo se haya cargado correctamente
			//El primer campo es el origen y el segundo el destino
			if(move_uploaded_file($source, $target_path)) {	
				echo "El archivo $filename se ha almacenado en forma exitosa.<br>";

               $ssql = "INSERT INTO pdf_beneficiario (nombre_pdf,beneficiario_id)
								  VALUES ('$filename','$id')";
		  
						 if (!($r_foto = mysql_query($ssql,$conexion_mysql)))
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
      


			   
?>
 <meta http-equiv='refresh' content='1;url=indextesoreria.php?sec=tesoreria/beneficiarios_consulta_aprobado&apli=tgp&per=C'> 
        <p class="Estilo2 style1"><font size="3" face="Verdana, Arial, Helvetica, sans-serif"><strong> </strong></font></p>
    <table width="505" border="0" align="center">
     <tr>
     <td width="499" align="center">
         <p class="Estilo2 style1 Estilo1"><img src="img/loader_guardando.gif" width="100" height="100" /></p>
      <p class="Estilo2 style1">
          <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Espere unos segundos el Sistema se Redirigir&aacute; automaticamente
          <br><br>
      Gracias
          </font>
          </p>
          </td>
     </tr>
   </table>
