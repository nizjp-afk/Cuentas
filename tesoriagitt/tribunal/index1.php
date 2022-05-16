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
  
  
?>  
<div class="content">
 <?php if($nrosaf =='P'){ ?>
    <h1>Presupuesto</h1>

 <?php
 }
 if($nrosaf =='C'){ ?>
    <h1>Contaduria</h1>

 <?php
 }
 if($nrosaf =='TC' or $nrosaf =='TCL')
  {
	  ?>
    <h1>Tribunal de Cuentas</h1>

 <?php
  }
 ?> 
<!-- <div class="descr">Jueves, 22 de Mayo de 2008.</div> -->
<p>

</p>
<p>
</p>
</div>

<div class="sidenav">


 <?php if($nrosaf =='P'){ ?>
 
  <h2>Consulta</h2>	
	
		<ul>
            
			<li><li><a href="contaduria/excel_p.php?apli=tgpa&per=O">Beneficiarios del Gobierno</a></li>
			
			
 	</ul>
 <h2>Cuentas</h2>	
<ul>
 
  
  <li><a href="indextesoreria.php?sec=consolidada/periodo_fp&dato=E&apli=tgpa&per=E&saf=<?php //echo $nrosaf;?>&sub_saf=<?php //echo $sub_nrosaf;?>" >Escritural  </a> </li>
  
   <li><a href="indextesoreria.php?sec=contaduria/periodo&apli=tgpa&per=E&ban=E">Exportacion Escritural</a></li>
    <li><a href="indextesoreria.php?sec=consolidada/periodo_fp&dato=ER&apli=tgpa&per=E">Consulta Cuenta Recaudadora</a></li>

</ul>
<?php
 }
 elseif($nrosaf =='C'){ ?>
 
 <h2>Consulta</h2>	
	
		<ul>
            
			<li><a href="indextesoreria.php?sec=hacienda/beneficiarios_consulta_aprobado&tgpa&apli=s&per=C&band=T">Beneficiarios del Gobierno</a></li>
			<li><a href="indextesoreria.php?sec=tesoreria/consulta_orden&apli=tgpa&per=T&band=C">Orden de Pago Recurso de Tesoro</a></li>
			<li><a href="indextesoreria.php?sec=tesoreria/consulta_orden_fp&apli=tgpa&per=P&band=C">Orden de Pago Recurso Propios</a></li>
            
            
		</ul>
   <h2>Cuentas</h2>	
<ul>
 
  
  <li><a href="indextesoreria.php?sec=consolidada/periodo_fp&dato=E&apli=tgpa&per=E&saf=<?php //echo $nrosaf;?>&sub_saf=<?php //echo $sub_nrosaf;?>" >Escritural  </a> </li>
            <li><a href="indextesoreria.php?sec=contaduria/periodo&apli=tgpa&per=E&ban=E">Exportacion Escritural</a></li>
   <li><a href="indextesoreria.php?sec=consolidada/periodo_fp&dato=ER&apli=tgpa&per=E">Consulta Cuenta Recaudadora</a></li>
  <li><a href="indextesoreria.php?sec=consolidada/periodo_fp&dato=R&apli=tgpa&per=E">Resumen Consolidado</a></li>

</ul>     
  <?php 
   }     
 if($nrosaf =='TC')
  {
	 ?> 
<h2>Consultas</h2>	
<ul>   
   	<li><a href="indextesoreria.php?sec=saf/beneficiarios_consulta_aprobado&apli=s&per=C">Beneficiarios </a></li>
    <li><a href="saf/listado.php?&apli=s&per=C" target="_blank">Listado de Beneficiarios</a></li>
</ul>  
    
<h2>Recursos del Tesoro </h2>	
		 
     
     <li><a href="indextesoreria.php?sec=tribunal/periodo&apli=tgpa&per=T&tipo=P">Ordenes Pagadas . PDF</a> </li>
     
     <li><a href="indextesoreria.php?sec=tribunal/periodo&apli=tgpa&per=T&tipo=E">Ordenes Pagadas .EXCEL </a> </li>
    
 
</ul>
<h2>Recursos Propios</h2>	
<ul>
 <li><a href="indextesoreria.php?sec=tribunal/periodo_fp&apli=tgpa&per=T&tipo=P">Ordenes Pagadas . PDF</a> </li>
     
     <li><a href="indextesoreria.php?sec=tribunal/periodo_fp&apli=tgpa&per=T&tipo=E">Ordenes Pagadas .EXCEL </a> </li> 
</ul>

<h2>Cuentas</h2>	
<ul>
 
  
  <li><a href="indextesoreria.php?sec=consolidada/periodo_fp&dato=E&apli=tgpa&per=E&saf=<?php //echo $nrosaf;?>&sub_saf=<?php //echo $sub_nrosaf;?>" >Escritural  </a> </li>

</ul>

<?php
 }
 if($nrosaf =='TCL'){ ?>
  
<h2>Consultas</h2>	
<ul>   
   	<li><a href="indextesoreria.php?sec=tribunal/consulta_orden_ed&apli=tgpa&per=L">Consulta de Ordenes Fondos Propios</a></li>
    	<li><a href="indextesoreria.php?sec=tribunal/consulta_orden_ed_fp&apli=tgpa&per=L">Consulta de Ordenes Fondos de Tesoro </a></li>
  
</ul> 
<?php
 }
 ?> 
</div>

<div class="clearer"><span></span></div>