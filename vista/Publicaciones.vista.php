<div class="row publicaciones">
  <div class="col l3">
    <?php require ( './vista/Cuenta-Menu.vista.php' ); ?>
    <?php $i = 0; ?>
  </div>
  <div class="col l9">
    <div class="row" style="width: 99%; margin: auto;">
      <h5>Publicaciones<span class="right"><a href="#modal1" class="btn-flat modal-trigger">+ Nueva publicación</a></span></h5>
      <hr>
      <div class="col l12">
        <?php foreach ($publicaciones as $publicacion): ?>
          <?php $i++; ?>
          <div class="card-panel sin-sombra">
            <div class="row valign-wrapper">
              <div class="col l2">

              </div>
              <div class="col l5">
                <h6>
                  <span><?php echo "#" . $publicacion['id']; ?></span><br>
                  <?php echo ucfirst($publicacion['titulo']); ?><br>
                  <span><?php echo ucfirst($publicacion['categoria']); ?></span>
                </h6>
              </div>
              <div class="col l1">
                <?php echo $publicacion['cantidad'] . " u."; ?>
              </div>
              <div class="col l3">
                <div class="switch">
                    <label>
                      <span>Inactiva</span>
                      <input type="checkbox" <?php echo ($publicacion['estado'] == 0) ? "" : "checked"; ?> data-id="<?php echo $publicacion['id']; ?>">
                      <span class="lever"></span>
                      <span>Activa</span>
                    </label>
                  </div>
              </div>
              <div class="col l1">
                <a class='dropdown-trigger' href='#' data-target='dropdown<?php echo $i ?>'><svg style="width: 2rem; height: 2rem;"><use href="./css/iconos.svg#mas"/></svg></a>
              </div>
            </div>
          </div>
          <ul id='dropdown<?php echo $i ?>' class='dropdown-content'>
            <li><a>Editar</a></li>
            <li class="divider" tabindex="-1"></li>
            <li><a id="<?php echo $publicacion['id']; ?>" class="eliminar">Eliminar</a></li>
          </ul>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>
<div id="modal1" class="modal">
  <form method="post" autocomplete="off" role="form" id="formularioPublicar" name="formularioPublicar">
    <div class="modal-content">
      <h4>Nueva publicación</h4>
      <div class="row">
        <div class="input-field col l6">
          <input placeholder="Nombre de la publicación" maxlength="60" id="nombre" name="nombre" type="text" required>
        </div>
        <div class="input-field col l4">
          <input placeholder="Categoría" id="autocomplete-input" class="autocomplete" name="categoria" maxlength="32" type="text" required>
        </div>
        <div class="input-field col l2">
          <input placeholder="Cantidad" id="cantidad" name="cantidad" type="number" min="0" required>
        </div>
        <input type="text" name="usuario" id="usuario" value="<?php echo $_SESSION['id']; ?>" hidden>
      </div>
    </div>
    <div class="modal-footer">
      <button type="submit" class="btn-flat">Publicar</button>
    </div>
  </form>
</div>
