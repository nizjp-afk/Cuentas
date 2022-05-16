<?php
  error_reporting ( E_ERROR ); 

  $aplicacion = $_GET['apli'];
  $permisosnecesarios = $_GET['per'];

   $accion='Consulta Ordenes Pendientes';
   $tabla='op_pendiente';
   include('agrego_movi.php'); 
   include('incluir_siempre.php');
  
   include('dgti-mysql-var_dgti-beneficiarios.php');
   include('dgti-intranet-mysql_connect.php');  
   include('dgti-intranet-mysql_select_db.php');


   	
  $ssql = "SELECT *  FROM `nro_saf` where saf_id='$saf_dir' order by numero";
     if (!($r_saf= mysql_query($ssql, $conexion_mysql)))
    {
      
	  //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
   }
  
?>  
<div class="glossymenu">
<a class="menuitem submenuheader" href="#">2011</a>
<div class="submenu">
	
<ul> 

<?php     
       
                    while ($f_saf = mysql_fetch_array ($r_saf))
                           {
                      
?>
   <li><a href="indextesoreria.php?sec=saf/cargar_orden_pendientes_saf&amp;apli=tgpa&fecha_cons=2011&n_saf=<?php echo $f_saf['numero'] ?>&per=A&band=T">Ordenes Pendientes de Pago <?php echo $f_saf['numero'] ?></a></li>
   <?php
						   }
?>
</ul>
</div>
<a class="menuitem submenuheader" href="#">2012 </a>	
<div class="submenu">
<ul>
<?php  
 mysql_data_seek($r_saf,0);   
       
                    while ($f_saf = mysql_fetch_array ($r_saf))
                           {
                      
?> 
   <li><a href="indextesoreria.php?sec=saf/cargar_orden_pendientes_saf&amp;apli=tgpa&n_saf=<?php echo $f_saf['numero'] ?>&fecha_cons=2012&amp;per=A&band=T">Ordenes Pendientes de Pago <?php echo $f_saf['numero'] ?></a></li>
   <?php
						   }
?>
</ul>
</div>
<a class="menuitem submenuheader" href="#">2013 </a>	
<div class="submenu">
<ul>
<?php  
 mysql_data_seek($r_saf,0);   
       
                    while ($f_saf = mysql_fetch_array ($r_saf))
                           {
                      
?> 
   <li><a href="indextesoreria.php?sec=saf/cargar_orden_pendientes_saf&amp;apli=tgpa&n_saf=<?php echo $f_saf['numero'] ?>&fecha_cons=2013&amp;per=A&band=T">Ordenes Pendientes de Pago <?php echo $f_saf['numero'] ?></a></li>
   <?php
						   }
?>
</ul>
</div>

</div>