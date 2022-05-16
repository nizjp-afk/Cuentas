<?php
  error_reporting ( E_ERROR );
  $aplicacion = $_GET['apli'];
  $permisosnecesarios = $_GET['per'];

  include('incluir_siempre.php');
  
    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
  	//$fecha_cons=$_GET['consul'];	
	
	$ssql = "SELECT * FROM control_ti_saf where numero='$nrosaf'";
     if (!($r_cf= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }	
	
	$f_cf=mysql_fetch_array($r_cf);
	$nro =$f_cf['nro_ti'];
	$nro_max=$nro;
 $valor=$_GET['valor']; 
  
?>  
<div class="content">
  
            <h1>Tarjeta Federal</h1>
         

<!-- <div class="descr">Jueves, 22 de Mayo de 2008.</div> -->
<p>

</p>
<p>
</p>
</div>

<div class="sidenav">


 
 
 <!--<h2>Registro</h2>	-->
	
		<!--<ul>
            <li><a href="indextesoreria.php?sec=federal/alta&valor=j">Personas Juridicas</a></li>
	<li><a href="indextesoreria.php?sec=federal/alta&valor=f">Personas Fisica</a></li>
    </ul>-->
 <h2>Consulta</h2> 
 <ul>  
 <!--<li><a href="indextesoreria.php?sec=federal/beneficiarios_consulta_confirmar&apli=orden&per=F">Beneficiarios a Aprobar</a></li>
 
			<li><a href="indextesoreria.php?sec=hacienda/beneficiarios_consulta_aprobado&tgpa&apli=orden&per=F&band=T">Beneficiarios del Gobierno</a></li>-->
		
            
		
 

    <li><a href="federal/padrontxt.php?apli=orden&per=F">Padron de Entidades</a></li>
  
 </ul>
</div>

<div class="clearer"><span></span></div>