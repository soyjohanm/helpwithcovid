<?php

  require_once ( './modelo/Publicaciones.modelo.php' );

  $existe = new Publicaciones();
  $publicaciones = $existe->getPublicacion();

  require_once ( './vista/Cabecera.vista.php' );
  require_once ( './vista/Cuerpo.vista.php' );
  require_once ( './vista/Pie.vista.php' );

?>
