<?php

  require ( 'Conexion.php' );

  class Contacto extends Conexion {

    public function Contacto() {
      parent::__construct();
    }

    public function getPais() {
      $resultado = $this->conexion->prepare("SELECT DISTINCT(pais) FROM contacto");
      $resultado->execute();
      $pais = $resultado->fetchAll(PDO::FETCH_ASSOC);
      return ( $pais );
    }

    public function getContactos($usuario) {
      $resultado = $this->conexion->prepare("SELECT contacto.id, numero, pais, contacto.fecha, contacto.cantidad, descripcion, aceptar, publicaciones.titulo, usuarios.nombre, usuarios.usuario, usuarios.correo FROM contacto INNER JOIN publicaciones ON contacto.publicacion=publicaciones.id INNER JOIN usuarios ON contacto.usuario=usuarios.id WHERE contacto.usuario = :usuario ORDER BY fecha DESC, aceptar ASC");
      $resultado->bindParam(':usuario', $usuario, PDO::PARAM_STR);
      $resultado->execute();
      $contacto = $resultado->fetchAll(PDO::FETCH_ASSOC);
      return ( $contacto );
    }

    public function setContacto($publicacion, $telefono, $pais, $cantidad, $descripcion, $usuario) {
      $resultado = $this->conexion->prepare("INSERT INTO contacto(publicacion, numero, pais, cantidad, descripcion, usuario, fecha) VALUES (:publicacion, :numero, :pais, :cantidad, :descripcion, :usuario, :fecha)");
      $data = array(':publicacion' => $publicacion, ':numero' => $telefono, ':pais' => $pais, ':cantidad' => $cantidad, ':descripcion' => $descripcion, ':usuario' => $usuario, ':fecha' => date('Y-m-d'));
      if ($resultado->execute($data)) {
        $resultado = $this->conexion->prepare("UPDATE publicaciones SET cantidad = (cantidad - :cantidad) WHERE id = :publicacion");
        $data = array(':publicacion' => $publicacion, ':cantidad' => $cantidad);
        $resultado->execute($data);
        $resultado = $this->conexion->prepare("UPDATE publicaciones SET cantidad = IF(cantidad=0, 0, 1) WHERE id = :id");
        $data = array(':id' => $publicacion);
        $resultado->execute($data);
        return true;
      }
    }

    public function aceptarContacto($id) {
      try {
        $resultado = $this->conexion->prepare("UPDATE contacto SET visto = 1, aceptar = 1 WHERE id = :id");
        $data = array(':id' => $id);
        $resultado->execute($data);
      } catch (Exception $e) {
        return "-1;Ha ocurrido un error. " . $e->getMessage();
        exit;
      }
      return "0;Se ha aceptado la propuesta.";
    }

  }

  if (!empty($_POST['id']) && isset($_POST['id'])) {
    $aceptar = new Contacto();
    $resultado = $aceptar->aceptarContacto($_POST['id']);
    echo $resultado;
    exit;
  }

  if (isset($_GET['funcion']) && !empty($_GET['funcion'])) {
    $pais = new Contacto();
    $resultado = $pais->getPais();
    foreach ($resultado as $pais) {
      $datos[] = array("pais" => ucfirst($pais['pais']));
    }
    header( 'Content-type: application/json' );
    echo json_encode($datos);
  }

  if (!empty($_POST)) {
    $telefono = $_POST['telefono'];
    $pais = strtolower($_POST['pais']);
    $cantidad = $_POST['cantidad'];
    $descripcion = strtolower($_POST['descripcion']);
    $usuario = $_POST['usuario'];
    $publicacion = $_POST['publicacion'];
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
      $existe = new Contacto();
      if ($existe->setContacto($publicacion, $telefono, $pais, $cantidad, $descripcion, $usuario)) {
        echo "0;La solicitud se ha guardado.";
        exit;
      } else {
        echo "-1;Ha ocurrido un error.";
        exit;
      }
    }
  }

?>
