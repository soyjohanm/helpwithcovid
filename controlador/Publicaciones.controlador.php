<?php

  if (isset($_SESSION['id'])) {
    require_once ( './modelo/Publicaciones.modelo.php' );

    $filtro = '';
    if (!empty($_GET['filtro']) && isset($_GET['filtro'])) {
      if ($_GET['filtro'] == 'activas') { $filtro = " AND estado='1'"; }
      else { $filtro = " AND estado='0'"; }
    }

    $existe = new Publicaciones();
    $publicaciones = $existe->getPublicaciones($_SESSION['id'], $filtro);

    require_once ( './vista/Cabecera.vista.php' );
    require_once ( './vista/Publicaciones.vista.php' );
    require_once ( './vista/Pie.vista.php' );
  } else {
    header('location: ./');
  }

?>
