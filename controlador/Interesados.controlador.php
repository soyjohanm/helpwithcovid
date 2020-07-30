<?php

  if (isset($_SESSION['id'])) {

    if (!empty($_GET['publicacion']) && isset($_GET['publicacion'])) {
      require_once ( './modelo/Publicaciones.modelo.php' );
      $existe = new Publicaciones();
      $publicacion = $existe->getPublicacion1($_GET['publicacion']);
    } else {
      require_once ( './modelo/Interesados.modelo.php' );
      $existe = new Contacto();
      $contactos = $existe->getContactos($_SESSION['id']);
    }

    require_once ( './vista/Cabecera.vista.php' );
    require_once ( './vista/Interesados.vista.php' );
    require_once ( './vista/Pie.vista.php' );
  } else {
    header('location: ./login');
  }

?>
