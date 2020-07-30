<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta http-equiv="Cache-Control" content="max-age=31563000">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="HandheldFriendly" content="true">
    <meta name="description" content="Help with Covid">
    <link rel="shortcut icon" href="./favicon.ico">
    <link rel="canonical" href=""> <!-- DIRECCION WEB HTPPS -->
    <title>Help with Covid
      <?php
        echo
          (basename($_SERVER['SCRIPT_NAME']) == 'login.php') ? "| Iniciar sesión" :
          ((basename($_SERVER['SCRIPT_NAME']) == 'registrarse.php') ? "| Registrarse" :
          ((basename($_SERVER['SCRIPT_NAME']) == 'cuenta.php') ? "| Mi cuenta" :
          ((basename($_SERVER['SCRIPT_NAME']) == 'publicaciones.php') ? "| Publicaciones" : "")));
      ?>
    </title>
    <link rel="stylesheet" href="./css/materialize.css">
    <link rel="stylesheet" href="./css/index.css">
  </head>
  <body>
    <header>
      <nav>
        <div class="nav-wrapper">
          <a href="./" class="brand-logo"><svg style="width: 20rem; height: 5rem; margin: -3% 0 0 -10%;"><use href="./css/iconos.svg#logo"/></svg></a>
          <ul id="#nav-mobile" class="right hide-on-med-and-down">
            <?php if (!isset($_SESSION['id'])): ?>
              <li class=<?php echo (basename($_SERVER['SCRIPT_NAME']) == 'registrarse.php') ? "'active'" : "''"; ?>><a href="./registrarse">Registrarse</a></li>
              <li class=<?php echo (basename($_SERVER['SCRIPT_NAME']) == 'login.php') ? "'active'" : "''"; ?>><a href="./login">Iniciar sesión</a></li>
            <?php else: ?>
              <li><a href="./cuenta">Mi cuenta</a></li>
              <li><a href="./salir">Salir</a></li>
            <?php endif; ?>
          </ul>
        </div>
      </nav>
    </header>
    <main class="<?php echo (basename($_SERVER['SCRIPT_NAME']) == 'login.php' || basename($_SERVER['SCRIPT_NAME']) == 'registrarse.php' || basename($_SERVER['SCRIPT_NAME']) == 'olvido.php') ? "valign-wrapper" : ""; ?>">
