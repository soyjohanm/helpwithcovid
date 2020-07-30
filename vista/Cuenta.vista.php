<div class="row">
  <div class="col l3">
    <?php require ( './vista/Cuenta-Menu.vista.php' ); ?>
  </div>
  <div class="col l9">
    <div class="row" style="width: 99%; margin: auto;">
      <h5>Resumen</h5>
      <hr>
      <div class="col l12 cuenta">
        <div class="row">
          <div class="col l4">
            <div class="row">
              <div class="col l12">
                <div class="card sin-sombra">
                  <div class="card-content">
                    <span class="card-title">Contactos por responder</span>
                  </div>
                  <div class="card-action">
                    <p><a href="./interesados">Preguntas<span class="right"><?php echo $totalContacto['total']; ?></span></a></p>
                  </div>
                </div>
              </div>
              <div class="col l12">
                <div class="card sin-sombra">
                  <div class="card-content">
                    <span class="card-title">Publicaciones</span>
                  </div>
                  <div class="card-action">
                    <p><a href="./publicaciones?filtro=activas">Todas las activas<span class="right"><?php echo $totalPublicaciones['activas']; ?></span></a></p>
                    <p><a href="./publicaciones?filtro=inactivas">Todas las inactivas<span class="right"><?php echo $totalPublicaciones['inactivas']; ?></span></a></p>
                    <p><a href="./publicaciones">Ver publicaciones<span class="right"><?php echo $totalPublicaciones['activas']+$totalPublicaciones['inactivas']; ?></span></a></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col l4">
            <div class="row">
              <div class="col l12">
                <div class="card sin-sombra">
                  <div class="card-content">
                    <span class="card-title">Completa tu perfil</span>
                  </div>
                  <div class="card-action">

                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col l4">
            <div class="row">
              <div class="col l12">
                <div class="card sin-sombra">
                  <div class="card-content">
                    <span class="card-title">Estadísticas</span>
                  </div>
                  <div class="card-action">
                    <p>Este mes<span class="right"><?php echo $totalEstadistica['actual']; ?></span></p>
                    <p>Mes pasado<span class="right"><?php echo $totalEstadistica['pasado']; ?></span></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
