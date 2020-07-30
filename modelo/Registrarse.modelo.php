<?php

  require ( './Usuarios.modelo.php' );
  if (!empty($_POST)) {
    $correo = strtolower($_POST['correo']);
    $nombre = $_POST['nombre'];
    $usuario = strtolower($_POST['usuario']);
    $clave = $_POST['clave'];
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
      $existe = new Usuarios();
      if (!$existe->getUsuario($correo) && !$existe->getUsuario($usuario)) {
        $hash = password_hash($clave, PASSWORD_DEFAULT);
        if ($existe->setUsuario($correo, $nombre, $usuario, $hash)) {
          echo "0;Usted ha sido registrado exitosamente.<br>Será redirigido a la página de inicio de sesión.";
          exit;
        }
      } else {
        echo "-1;El nombre de usuario o correo electrónico ya se encuentra en uso.<br>Verifique e intente de nuevo.";
        exit;
      }
    }
  }

?>
