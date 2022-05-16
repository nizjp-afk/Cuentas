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

	   
    $id                =   $_GET['id'];
//	echo $clave                =   $_GET['clave'];
   
      $fecha=date('Y-m-d');

	
	 $ssql = "update  op_bloqueadas  set estado='P' WHERE clave='$id'";
     if (!($r_bloqueo = mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de op bloqueadas";
      echo $cuerpo1;
	  exit;      
      //.....................................................................
    }
	
	 
     $ssql = "SELECT * FROM op_bloqueadas WHERE clave='$id'";
     if (!($r_bloqueo = mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de op bloqueadas";
      echo $cuerpo1;
	  exit;      
      //.....................................................................
    }
	
    $f_orden=mysql_fetch_array($r_bloqueo);
    
    $ejercicio=$f_orden['ejercicio'];
		   $saf=$f_orden['saf'];
		   $nro_esidif=$f_orden['nro_esidif'];
		   $nom_op='PRE'.$nro_esidif;
 
	 	 
	 
    $dato_h=$fecha.': Orden Desbloqueada ';
	
///////////////////antecedente
   $sql="SELECT * FROM historial_orden
			            where numero_op='$nom_op'
						and ejercicio='$ejercicio'
						and saf='$saf'";

       if (!($r_obser = mysql_query($sql, $conexion_mysql)))
         {
            //.....................................................................
            // INFORMA  DE ERROR PRODUCIDO//
            $cuerpo1  = "al intentar insertar select";
            $cuerpo2  = "Base de datos                 = ".$mysql_basededatos.$emaillinea;
            $cuerpo2 .= "Sentencia sql                 = ".$ssql.$emaillinea;
           echo $cuerpo1;
            exit;
            //.....................................................................
         }  
  
$cant= mysql_num_rows($r_obser);
if ($cant >0)
   {
	    $f_obser=mysql_fetch_array($r_obser);
		$obser_1=$f_obser['observacion'];
		
     $dato=$obser_1.'\r\n'.$dato_h;
     
     $sql="UPDATE historial_orden SET observacion ='$dato'  where numero_op='$nom_op'
						and ejercicio='$ejercicio'
						and saf='$saf'";

       if (!($r_ef = mysql_query($sql, $conexion_mysql)))
         {
            //.....................................................................
            // INFORMA  DE ERROR PRODUCIDO//
            $cuerpo1  = "al intentar insertar update";
            $cuerpo2  = "Base de datos                 = ".$mysql_basededatos.$emaillinea;
            $cuerpo2 .= "Sentencia sql                 = ".$ssql.$emaillinea;
           echo $cuerpo1;
            exit;
            //.....................................................................
         }  
 }
    
	
		 
      echo "<h2>La Orden ".$nro_esidif." fue Desbloqueada Correctamente</h2>";
	 
	 
	 
	 
	  
	  ?>
	  <center><h1>Guardando</h1></center>
	
	<center><img src="img/loader_guardando.gif" width="100" height="100" />
	<p>Sus Datos Fueron Grabados con Exito.</p></center>
<code>Haga click <a href='indextesoreria.php?sec=retenciones/consulta_opbloqueadas&apli=cr&per=D&band=S'>aqu&iacute;</a> para regresar.</code>
		  
</div>

<div class="sidenav">
</div>

<div class="clearer"><span></span></div>
	
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