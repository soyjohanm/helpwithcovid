<?php

  require ( './Usuarios.modelo.php' );
  if (isset($_POST['usuario']) && !empty($_POST['usuario'])) {
    $usuario = strtolower($_POST['usuario']);
    $clave = $_POST['clave'];
    $existe = new Usuarios();
    if ($user = $existe->getUsuario($usuario)) {
      if (password_verify($clave, $user['clave'])) {
        session_start();
        $_SESSION['id'] = $user['id'];
        $_SESSION['usuario'] = strtoupper($user['usuario']);
        $_SESSION['nombre'] = $user['nombre'];
        $_SESSION['tipo'] = $user['tipo'];
        echo "0;Bienvenido " . $_SESSION['usuario'] . ".<br>Será redirigido a su cuenta.";
      } else {
        echo "-1;La contraseña ingresada es incorrecta, intente de nuevo.";
        exit;
      }
    } else {
      echo "-1;El nombre de usuario o correo electrónico no se encuentra en nuestra base de datos.";
      exit;
    }
  }

?>
