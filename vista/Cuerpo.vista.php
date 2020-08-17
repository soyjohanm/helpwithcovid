<div class="row cuerpo">
  <div class="col l3">
    <h5>Filtros</h5>
    <hr>
  </div>
  <div class="col l9">
    <div class="row">
      <?php foreach ($publicaciones as $publicacion): ?>
        <div class="col l3">
        <div class="card">
          <div class="card-image">
            <img src=<?php echo "'data:image/png;base64," . base64_encode($publicacion['archivo']) . "'"; ?>>
            <span class="card-title"><?php echo ucfirst($publicacion['titulo']); ?></span>
          </div>
          <div class="card-content">
            <span><b>Publicación</b> #<?php echo $publicacion['id']; ?>.</span><br>
            <span><b>Categoría</b> <?php echo ucfirst($publicacion['categoria']); ?>.</span><br>
            <span><b>Cantidad disponible</b>: <?php echo $publicacion['cantidad']; ?>.</span>
          </div>
          <div class="card-action">
            <a href="./interesados?publicacion=<?php echo $publicacion['id']; ?>">Contactar</a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
