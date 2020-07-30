<?php

  if (!isset($_SESSION['id'])) {
    require_once ( './vista/Cabecera.vista.php' );
    require_once ( './vista/Login.vista.php' );
    require_once ( './vista/Pie.vista.php' );
  } else {
    header('location: cuenta');
  }

?>
