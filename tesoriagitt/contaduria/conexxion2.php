<?php
error_reporting ( E_ERROR ); 
if ($conn_access = odbc_connect ( "retencion", "", "")){
    echo "Conectado correctamente";
    $ssql = "select * from [ORDEN DE PAGO]";
    if($rs_access = odbc_exec ($conn_access, $ssql))
	 {
       echo "La sentencia se ejecutó correctamente";
       while ($fila = odbc_fetch_object($rs_access))
	   {
	     $clave=$fila->CLAVE_UNICA;
          echo $clave."<br>"; 
       }
	   
     }
	else
	{
       echo "Error al ejecutar la sentencia SQL";
    }
 }
else
{
    echo "Error en la conexión con la base de datos";
}
 
?>