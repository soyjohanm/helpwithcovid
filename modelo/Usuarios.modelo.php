<?php

  require ( 'Conexion.php' );

  class Usuarios extends Conexion {

    private $id;
    private $usuario;
    private $correo;
    private $clave;

    public function Usuarios() {
      parent::__construct();
    }

    public function getUsuario($usuario) {
      $resultado = $this->conexion->prepare("SELECT * FROM usuarios WHERE usuario = :usuario || correo = :usuario");
      $resultado->bindParam(':usuario', $usuario, PDO::PARAM_STR);
      $resultado->execute();
      $usuario = $resultado->fetch();
      return ( $usuario );
    }

    public function setUsuario($correo, $nombre, $usuario, $clave) {
      $resultado = $this->conexion->prepare("INSERT INTO usuarios(usuario, nombre, correo, clave) VALUES (:usuario, :nombre, :correo, :clave)");
      $data = array(':usuario' => $usuario, ':nombre' => $nombre, ':correo' => $correo, ':clave' => $clave);
      if ($resultado->execute($data)) {
        return true;
      }
    }

  }

?>
