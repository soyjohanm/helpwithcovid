<?php
  require_once ( 'Constantes.php' );
  class Conexion {
    protected $conexion;
    public function Conexion() {
      try {
        $this->conexion = new PDO("".BD_CONTROLADOR.":host=".BD_HOST."; dbname=".BD_NOMBRE."", BD_USUARIO, BD_CLAVE);
        $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->conexion->exec("SET CHARACTER SET " . BD_CHARSET);
      } catch (PDOException $e) {
        die("Error. " . $e->getMessage());
        echo "Línea del error: " . $e->getLine();
      }
			return( $this->conexion );
    }
  }
?>
