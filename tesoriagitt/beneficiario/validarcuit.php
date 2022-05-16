<?php
error_reporting ( E_ERROR );
public static function verificar_cuit($cuit){
        $verificador = obtener_digito_verificador($cuit);
            $cuit = str_replace('-', '', $cuit);
        if($cuit[10] == $verificador){
                return true;
            }
            else
            {
                return false;
            }
    }
 public static function obtener_digito_verificador($cuit){
        $cuit = str_replace('-', '', $cuit);
        $cuit = substr($cuit,0,10); 
        if(strlen($cuit)===10){
            $ab = $cuit[0].$cuit[1]; 
            }
            else
            {
            return false;
            }
            if(!($ab == 20 or $ab == 22 or $ab == 27 or $ab == 30 or $ab == 33)){
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
?> 