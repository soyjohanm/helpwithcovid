<?php

  if (isset($_SESSION['id'])) {
    require_once ( './modelo/Publicaciones.modelo.php' );

    $existe = new Publicaciones();
    $totalPublicaciones = $existe->getTotalPublicacion($_SESSION['id']);
    $totalContacto = $existe->getTotalContacto($_SESSION['id']);
    $totalEstadistica = $existe->getEstadistica(date('m'));
    $totalNotificacion = $existe->getNotificacion($_SESSION['id']);

    require_once ( './vista/Cabecera.vista.php' );
    require_once ( './vista/Cuenta.vista.php' );
    require_once ( './vista/Pie.vista.php' );
  } else {
    header('location: ./login');
  }

?>
