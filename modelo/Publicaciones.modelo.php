<?php

  require ( 'Conexion.php' );

  class Publicaciones extends Conexion {

    private $id;
    private $usuario;
    private $correo;
    private $clave;

    public function Publicaciones() {
      parent::__construct();
    }

    public function getPublicacion() {
      $resultado = $this->conexion->prepare("SELECT * FROM publicaciones WHERE estado = 1 ORDER BY fecha DESC, id DESC");
      $resultado->execute();
      $publicaciones = $resultado->fetchAll(PDO::FETCH_ASSOC);
      return ( $publicaciones );
    }

    public function getEstadistica($mes) {
      $resultado = $this->conexion->prepare("SELECT (SELECT COUNT(*) FROM contacto WHERE aceptar = 1 AND MONTH(fecha) = :actual) AS actual, (SELECT COUNT(*) FROM contacto WHERE aceptar = 1 AND MONTH(fecha) = :pasado) AS pasado FROM contacto LIMIT 1 ");
      $data = array(':actual' => $mes, ':pasado' => ($mes-1));
      $resultado->execute($data);
      $estadistica = $resultado->fetch(PDO::FETCH_ASSOC);
      return ( $estadistica );
    }

    public function getNotificacion($id) {
      $resultado = $this->conexion->prepare("SELECT COUNT(*) as visto FROM contacto WHERE usuario = :usuario AND visto = 0");
      $data = array(':usuario' => $id);
      $resultado->execute($data);
      $estadistica = $resultado->fetch(PDO::FETCH_ASSOC);
      return ( $estadistica );
    }

    public function getPublicacion1($id) {
      $resultado = $this->conexion->prepare("SELECT * FROM publicaciones WHERE id = :id");
      $resultado->bindParam(':id', $id, PDO::PARAM_STR);
      $resultado->execute();
      $publicacion = $resultado->fetch(PDO::FETCH_ASSOC);
      return ( $publicacion );
    }

    public function getPublicaciones($usuario, $filtro='') {
      $resultado = $this->conexion->prepare("SELECT * FROM publicaciones WHERE usuario = :usuario" . $filtro . " ORDER BY fecha DESC, id DESC");
      $resultado->bindParam(':usuario', $usuario, PDO::PARAM_STR);
      $resultado->execute();
      $publicaciones = $resultado->fetchAll(PDO::FETCH_ASSOC);
      return ( $publicaciones );
    }

    public function getCategoria() {
      $resultado = $this->conexion->prepare("SELECT DISTINCT(categoria) FROM publicaciones");
      $resultado->execute();
      $categoria = $resultado->fetchAll(PDO::FETCH_ASSOC);
      return ( $categoria );
    }

    public function getTotalPublicacion($usuario) {
      $resultado = $this->conexion->prepare("SELECT
        (SELECT COUNT(*) FROM publicaciones WHERE estado='1' AND usuario = :usuario) AS activas,
        (SELECT COUNT(*) FROM publicaciones WHERE estado='0' AND usuario = :usuario) AS inactivas
        FROM publicaciones LIMIT 1 ");
      $resultado->bindParam(':usuario', $usuario, PDO::PARAM_STR);
      $resultado->execute();
      $totalPublicaciones = $resultado->fetch(PDO::FETCH_ASSOC);
      return ( $totalPublicaciones );
    }

    public function getTotalContacto($usuario) {
      $resultado = $this->conexion->prepare("SELECT COUNT(*) AS total FROM contacto WHERE usuario = :usuario AND aceptar = 0");
      $resultado->bindParam(':usuario', $usuario, PDO::PARAM_STR);
      $resultado->execute();
      $totalContacto = $resultado->fetch(PDO::FETCH_ASSOC);
      return ( $totalContacto );
    }

    public function deletePublicacion($id) {
      try {
        $resultado = $this->conexion->prepare("DELETE FROM publicaciones WHERE id = :id");
        $resultado->bindParam(':id', $id, PDO::PARAM_INT);
        $resultado->execute();
      } catch (Exception $e) {
        return "-1;Ha ocurrido un error. " . $e->getMessage();
      }
      return "0;La publicación se ha eliminado correctamente.";
    }

    public function updatePublicacion($id, $valor) {
      try {
        $resultado = $this->conexion->prepare("UPDATE publicaciones SET estado = :valor WHERE id = :id");
        $data = array(':valor' => $valor, ':id' => $id);
        $resultado->execute($data);
      } catch (Exception $e) {
        return "-1;Ha ocurrido un error. " . $e->getMessage();
      }
      return (($valor == 0) ? "0;La publicación se ha desactivado correctamente." : "0;La publicación se ha activado correctamente.");
    }

    public function updatePublicacion1($id, $titulo, $cantidad, $categoria) {
      try {
        $resultado = $this->conexion->prepare("UPDATE publicaciones SET titulo = :titulo, cantidad = :cantidad, categoria = :categoria WHERE id = :id");
        $data = array(':titulo' => $titulo, ':cantidad' => $cantidad, ':categoria' => $categoria, ':id' => $id);
        $resultado->execute($data);
      } catch (Exception $e) {
        return "-1;Ha ocurrido un error. " . $e->getMessage();
      }
      return "0;La publicación se ha actualizado correctamente.";
    }

    public function setPublicacion($titulo, $categoria, $cantidad, $usuario) {
      try {
        $resultado = $this->conexion->prepare("INSERT INTO publicaciones(titulo, categoria, cantidad, usuario, fecha) VALUES (:titulo, :categoria, :cantidad, :usuario, :fecha)");
        $data = array(':titulo' => $titulo, ':categoria' => $categoria, ':cantidad' => $cantidad, ':usuario' => $usuario, ':fecha' => date('Y-m-d'));
        $resultado->execute($data);
      } catch (Exception $e) {
        return "-1;Ha ocurrido un error. " . $e->getMessage();
      }
      return "0;La publicación ha sido publicada.";
    }

  }

  if (!empty($_POST['eliminar']) && isset($_POST['eliminar'])) {
    $eliminarPublicacion = new Publicaciones();
    $resultado = $eliminarPublicacion->deletePublicacion($_POST['eliminar']);
    echo $resultado;
    exit;
  }

  if (!empty($_POST['estado']) && isset($_POST['estado'])) {
    $estado = ($_POST['checked'] == 'true') ? 1 : 0;
    $eliminarPublicacion = new Publicaciones();
    $resultado = $eliminarPublicacion->updatePublicacion($_POST['estado'],$estado);
    echo $resultado;
    exit;
  }

  if (isset($_GET['funcion']) && !empty($_GET['funcion'])) {
    $categoria = new Publicaciones();
    $resultado = $categoria->getCategoria();
    foreach ($resultado as $categoria) {
      $datos[] = array("categoria" => ucfirst($categoria['categoria']));
    }
    header( 'Content-type: application/json' );
    echo json_encode($datos);
  }

  if(!empty($_POST['editar'])) {
    $titulo = strtolower($_POST['nombre']);
    $categoria= strtolower($_POST['categoria']);
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
      $nuevaPublicacion = new Publicaciones();
      $resultado = $nuevaPublicacion->updatePublicacion1($_POST['publicacion'], $titulo, $_POST['cantidad'], $categoria);
      echo $resultado;
    }
    exit;
  }

  if (!empty($_POST)) {
    $titulo = strtolower($_POST['nombre']);
    $categoria= strtolower($_POST['categoria']);
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
      $nuevaPublicacion = new Publicaciones();
      $resultado = $nuevaPublicacion->setPublicacion($titulo, $categoria, $_POST['cantidad'], $_POST['usuario']);
      echo $resultado;
      exit;
    }
  }

?>
