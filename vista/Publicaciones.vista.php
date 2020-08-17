<div class="row publicaciones">
  <div class="col l3">
    <?php require ( './vista/Cuenta-Menu.vista.php' ); ?>
    <?php $i = 0; ?>
  </div>
  <div class="col l9">
    <div class="row" style="width: 99%; margin: auto;">
      <h5>Publicaciones<span class="right"><a href="#publicar" class="btn-flat modal-trigger">+ Nueva publicación</a></span></h5>
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
            <li><a id="<?php echo $publicacion['id']; ?>" href="#editar<?php echo $i ?>" class="modal-trigger">Editar</a></li>
            <li class="divider" tabindex="-1"></li>
            <li><a id="<?php echo $publicacion['id']; ?>" class="eliminar">Eliminar</a></li>
          </ul>
          <div id="editar<?php echo $i ?>" class="modal">
            <form method="post" autocomplete="off" role="form" id="formularioEditar" name="formularioEditar">
              <div class="modal-content">
                <h4>Editar publicación</h4>
                <div class="row">
                  <div class="input-field col l6">
                    <input placeholder="Nombre de la publicación" maxlength="60" id="nombre" name="nombre" type="text" required value="<?php echo ucfirst($publicacion['titulo']); ?>">
                  </div>
                  <div class="input-field col l4">
                    <input placeholder="Categoría" id="autocomplete-input" class="autocomplete" name="categoria" maxlength="32" type="text" required value="<?php echo ucfirst($publicacion['categoria']); ?>">
                  </div>
                  <div class="input-field col l2">
                    <input placeholder="Cantidad" id="cantidad" name="cantidad" type="number" min="0" required value="<?php echo $publicacion['cantidad']; ?>">
                  </div>
                  <input type="text" name="publicacion" id="publicacion" value="<?php echo $publicacion['id']; ?>" hidden>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn-flat" id="editar">Editar</button>
              </div>
            </form>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>
<div id="publicar" class="modal">
  <form method="post" autocomplete="off" role="form" action="./modelo/Publicar.modelo.php" name="formularioPublicar" enctype="multipart/form-data">
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
        <div class="file-field input-field col l12">
          <div class="btn">
            <span>Seleccionar</span>
            <input type="file" name="imagen" accept="image/png, .jpeg, .jpg, image/gif">
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text" placeholder="Seleccione una imagen para su publicación.">
          </div>
        </div>
        <input type="text" name="usuario" id="usuario" value="<?php echo $_SESSION['id']; ?>" hidden>
      </div>
    </div>
    <div class="modal-footer">
      <button type="submit" class="btn-flat">Publicar</button>
    </div>
  </form>
</div>
