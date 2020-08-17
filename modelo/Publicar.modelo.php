<?php

  require ( 'Publicaciones.modelo.php' );

  if (!empty($_POST)) {
    $titulo = strtolower($_POST['nombre']);
    $categoria= strtolower($_POST['categoria']);

    $nombre_imagen = $_FILES['imagen']['name'];
    $tipo_imagen = $_FILES['imagen']['type'];
    $tamano_imagen = $_FILES['imagen']['size'];

    if ($tamano_imagen < 16777215) {
      if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $carpeta = '../imagenes/';
        move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta.$nombre_imagen);
        $imagen = fopen($carpeta.$nombre_imagen, "r");
        $contenido = fread($imagen, $tamano_imagen);
        $contenido = addslashes($contenido);
        fclose($imagen);
        $nuevaPublicacion = new Publicaciones();
        $publicacion = $nuevaPublicacion->setPublicacion($titulo, $categoria, $_POST['cantidad'], $_POST['usuario']);
        $resultado = $nuevaPublicacion->setImagen($nombre_imagen, $tipo_imagen, $publicacion, $contenido);
        echo $resultado;
        header('location: ../publicaciones');
      }
    } else {
      echo "-1;La imagen es demasiado grande.";
      exit;
    }
  }

?>
