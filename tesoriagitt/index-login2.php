<?php
  // Cuando el usuario se loguea correctamente, la sesion queda con los
  // siguientes datos:
  //   * $error (siempre en cero)
  //   * $usuario
  //   * $contrasena
  //   * $nombre
  //   * $fechanac
  //   * $tiempo
  session_name('valido');
  session_start();

  echo $tipo = $_POST['tipo'];
  $usuario = $_POST['usuario'];
  $contrasena = md5($_POST['contrasena']);
  if ($_POST['usuario'] == "" or $_POST['contrasena'] == "")
    {
      // usuario y/o clave en blanco
      $_SESSION['vps_error'] = 3;
    }
  else
    {
      // Valida si el usuario existe y si la contrase�a corresponde pasando algunas variables
      echo $usuarioqueintenta = $_SESSION['vps_usuarioqueintenta'];
     echo $equivocacion = $_SESSION['vps_equivocacion'];
    
      include('2-validar_u_c.php');

      $_SESSION['vps_equivocacion'] = $equivocacion;
      $_SESSION['vps_usuarioqueintenta'] = $usuarioqueintenta;
      $_SESSION['vps_error'] = $error;
      if ($error == 0)
        {
          // usuario y clave correctos
          $_SESSION['vps_usuario'] = $usuario;
          $_SESSION['vps_cuil'] = $cuil;
		      $_SESSION['vps_saf'] = $nrosaf;
		      $_SESSION['vps_sub_saf']=$sub_nrosaf;
		      $_SESSION['vps_saf_dir']=$saf_dir;
          $_SESSION['vps_contrasena'] = $contrasena;
          $_SESSION['vps_nombre'] = $nombre;
		      $_SESSION['vps_razon_social'] = $razon;
          $_SESSION['vps_fechanac'] = $fechanac;
          $_SESSION['vps_tiempo'] = time();
        }
      elseif ($error == 1)
        {
          // contraseña incorrecta: NADA POR HACER EN ESTE PUNTO
        }
      elseif ($error == 2)
        {
          // usuario bloqueado
          $_SESSION['vps_equivocacion'] = 0;
          $_SESSION['vps_bloqueofecha'] = $bloqueofecha;
        }
    }
       if ($tipo == 's') {

        header('location:indexctas.php');

       }

       if ($tipo == 'T') {

        header('location:indexctast.php');

       }

       if ($tipo == 'b') {

        header('location:indextesoreria.php');
        
       }
        


        

   

        

     
      

     
      
  
  

    
  
?>