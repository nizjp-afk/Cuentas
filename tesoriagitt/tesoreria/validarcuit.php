<?php
error_reporting ( E_ERROR ); 
    include('../dgti-mysql-var_dgti-beneficiarios.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');
	$banderacuit=0;
	function verificar_cuit($cuit)
	  {
        $verificador = obtener_digito_verificador($cuit);
        $cuit = str_replace('-', '', $cuit);
        if($cuit[10] == $verificador)
		    {
			   $banderacuit=0;
                return $banderacuit;
            }
            else
            {
                $banderacuit=1;
                return $banderacuit;
            }
       }
	 function obtener_digito_verificador($cuit){
        $cuit = str_replace('-', '', $cuit);
        $cuit = substr($cuit,0,10); 
        if(strlen($cuit)===10){
            $ab = $cuit[0].$cuit[1]; 
            }
            else
            {
            return false;
            }
            if(!($ab == 20 or $ab == 22 or $ab == 23 or $ab == 27 or 
			     $ab == 30 or $ab == 33 or $ab == 34)){
                    return false;
                    }
                    else
                    {
                        $multiplicadores = array(5, 4, 3, 2, 7, 6, 5, 4, 3, 2); 

                        $i=0;
                        while($i<10){
                         $suma += $cuit[$i] * $multiplicadores[$i];
                         $i++;
                        }
                        $verificador = 11 - ($suma % 11);
                        switch(true) {
                        case $verificador == 11:
                            $verificador = 0;
                            break;
                        case $verificador == 10:
                            $verificador = 9;
                            break;
                        case $verificador < 10:
                            $verificador;
                            break;
                        default:
                            return false; 
                        }
                        return $verificador;
                    }
      }  
	$idb=$_POST['id'];   
	$bandera = 0;
	if (isset($_POST['mcuit']))
	   {
	    $cuit1= $_POST['cuitl_1'];
		$patron = "[[:digit:]]{2}";
		if ($bandera == 0 and !(ereg($patron, $cuit1)))
		    {
			 $bandera=1;
			} 
		$cuit2= $_POST['cuitl_2'];
		$patron = "[[:digit:]]{8}";
		if ($bandera == 0 and !(ereg($patron, $cuit2)))
		    {
			 $patron = "[[:digit:]]{7}";
			 if ($bandera == 0 and !(ereg($patron, $cuit2)))
			   {
			   $patron = "[[:digit:]]{6}";
		       if ($bandera == 0 and !(ereg($patron, $cuit2)))
		          {
			       $bandera=1;
			      }
			   else
			      {	
				    $cero='00';  	
			        $cuitl2=$cero.''.$cuit2;
			      }
				}  
			 else
			   {
			   $cero='0';  	
			   $cuitl2=$cero.''.$cuit2;
				}
			 }
			else
			  {
			   $cuitl2=$cuit2;
			  } 	  
		
		$cuit3= $_POST['cuitl_3'];
		$patron = "[[:digit:]]{1}";
		if ($bandera == 0 and !(ereg($patron, $cuit3)))
		    {
			 $bandera=1;
			} 
		
		if (!($bandera==1))
		    {
			$cuitl = $_POST['cuitl_1'].$cuitl2.$_POST['cuitl_3'];
            $ssql = "SELECT * FROM beneficiarios WHERE cuitl ='$cuitl'";
	         if (!($r_beneficiarios = mysql_query($ssql,$conexion_mysql)))
			    {
			     $cuerpo1  = "Error al intentar buscar un beneficiario por CUILT";
			     echo $cuerpo1;
			     exit;
				  //.....................................................................
			    }
		     $cant = mysql_num_rows($r_beneficiarios);
			//echo $cuitl;
			//echo $cant;exit; 
		}	
			
		
		if ($bandera==1)
	  		{
			 header('location: indextesoreria.php?sec=error&valor='.$tipo.'&ban=1');
			}
		elseif ($cant >0)
		    {
			 header('location: indextesoreria.php?sec=error&valor='.$tipo.'&ban=2');
			}
			
		if($bandera==0 and  $cant ==0)
				    {
					$ncuit = $cuitl;
					$validez = verificar_cuit($ncuit);
					if($validez==0)
					  {
            		   echo " va el update";
					  }
					else
					   {
?>
<meta http-equiv='refresh' content='0;url=indextesoreria.php?sec=error&valor=<?php echo $tipo; ?>&ban=3' />	
<?php
				       }  	  
			}		
	}	
	
	if (isset($_POST['validar']))
	   {
	    $cuit1= $_POST['cuitl_1'];
		$patron = "[[:digit:]]{2}";
		if ($bandera == 0 and !(ereg($patron, $cuit1)))
		    {
			 $bandera=1;
			} 
		$cuit2= $_POST['cuitl_2'];
		$patron = "[[:digit:]]{8}";
		if ($bandera == 0 and !(ereg($patron, $cuit2)))
		    {
			 $patron = "[[:digit:]]{7}";
			 if ($bandera == 0 and !(ereg($patron, $cuit2)))
			   {
			   $patron = "[[:digit:]]{6}";
		       if ($bandera == 0 and !(ereg($patron, $cuit2)))
		          {
			       $bandera=1;
			      }
			   else
			      {	
				    $cero='00';  	
			        $cuitl2=$cero.''.$cuit2;
			      }
				}  
			 else
			   {
			   $cero='0';  	
			   $cuitl2=$cero.''.$cuit2;
				}
			 }
			else
			  {
			   $cuitl2=$cuit2;
			  } 	  
		
		$cuit3= $_POST['cuitl_3'];
		$patron = "[[:digit:]]{1}";
		if ($bandera == 0 and !(ereg($patron, $cuit3)))
		    {
			 $bandera=1;
			} 
		
		if (!($bandera==1))
		    {
			$cuitl = $_POST['cuitl_1'].$cuitl2.$_POST['cuitl_3'];
            $ssql = "SELECT * FROM beneficiarios WHERE cuitl ='$cuitl'";
	         if (!($r_beneficiarios = mysql_query($ssql,$conexion_mysql)))
			    {
			     $cuerpo1  = "Error al intentar buscar un beneficiario por CUILT";
			     echo $cuerpo1;
			     exit;
				  //.....................................................................
			    }
		     $cant = mysql_num_rows($r_beneficiarios);
			//echo $cuitl;
			//echo $cant;exit; 
		}	
		 $cuitl_1=base64_encode ($_POST['cuitl_1']);
         $cuitl_2=base64_encode($cuitl2);
	     $cuitl_3=base64_encode($_POST['cuitl_3']);	
		
		if ($bandera==1)
	  		{
			 header('location: ../indextesoreria.php?sec=tesoreria/error&valor='.$tipo.'&ban=1');
			}
		elseif ($cant >0)
		    {
			 header('location: ../indextesoreria.php?sec=tesoreria/error&valor='.$tipo.'&ban=2');
			}
		if($bandera==0 and  $cant ==0)
				    {
					$ncuit = $cuitl;
					$validez = verificar_cuit($ncuit);
					if($validez==0)
					  {
            		   $cuitl_1=base64_encode ($_POST['cuitl_1']);
        	           $cuitl_2=base64_encode($cuitl2);
	                   $cuitl_3=base64_encode($_POST['cuitl_3']);
		     	      ?>						  
					  <meta http-equiv='refresh' content='0;url=                       ../indextesoreria.php?sec=tesoreria/alta_otros&c1=<?php echo $cuitl_1; ?>&c2=<?php echo $cuitl_2; ?>&c3=<?php echo $cuitl_3; ?>'	 />	               
<?php						  
					  }
					else
					   {
?>
<meta http-equiv='refresh' content='0;url=../indextesoreria.php?sec=tesoreria/error&c1=<?php echo $cuitl_1; ?>&c2=<?php echo $cuitl_2; ?>&c3=<?php echo $cuitl_3; ?>&ban=3' />		
<?php
				       }  	  
			}		
	}		
?>


