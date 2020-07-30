<div class="row publicaciones">
  <div class="col l3">
    <?php require ( './vista/Cuenta-Menu.vista.php' ); ?>
    <?php $i = 0; ?>
  </div>
  <div class="col l9">
    <?php if (!empty($_GET['publicacion']) && isset($_GET['publicacion'])): ?>
      <div class="row">
        <div class="col s12">
          <form method="post" autocomplete="off" role="form" id="formularioContacto" name="formularioContacto">
            <div class="card sin-sombra">
              <div class="card-content">
              <span class="card-title">Contactar por <b><?php echo strtolower($publicacion['titulo']); ?></b></span>
              <div class="row">
                <div class="input-field col l6">
                  <input type="tel" class="validate" name="telefono" required placeholder="Número de teléfono">
                </div>
                <div class="input-field col l4">
                  <input type="text" class="validate" name="pais" id="autocomplete-input" class="autocomplete" required placeholder="País">
                </div>
                <div class="input-field col l2">
                  <input type="number" class="validate" name="cantidad" required max="<?php echo $publicacion['cantidad']; ?>" placeholder="Cantidad requerida" min="0" value="<?php echo $publicacion['cantidad']; ?>">
                </div>
                <div class="input-field col l12">
                  <textarea class="materialize-textarea" name="descripcion" required placeholder="Escribe un pequeño mensaje describiendo tu situación y el por qué necesitas este insumo." maxlength="300"></textarea>
                </div>
                <input type="number" name="usuario" value="<?php echo $_SESSION['id']; ?>" hidden>
                <input type="number" name="publicacion" value="<?php echo $_GET['publicacion']; ?>" hidden>
              </div>
            </div>
            <div class="card-action">
              <button type="submit" class="btn-flat">Enviar solicitud</button>
            </div>
            </div>
          </form>
        </div>
      </div>
    <?php else: ?>
      <div class="row" style="width: 99%; margin: auto;">
        <h5>Interesados</h5>
        <hr>
        <?php foreach ($contactos as $contacto): ?>
          <div class="col l12">
            <div class="card sin-sombra">
              <div class="card-content">
                <span class="card-title">#<?php echo $contacto['id']; ?> <?php echo $contacto['nombre']; ?> de <?php echo ucfirst($contacto['pais']); ?></span>
                <span>Requiere <?php echo $contacto['cantidad']; ?> <?php echo $contacto['titulo']; ?></span>
                <p><?php echo ucfirst($contacto['descripcion']); ?></p>
              </div>
              <div class="card-action">
                <?php if ($contacto['aceptar'] == 0): ?>
                  <button type="button" id="aceptar" data-id="<?php echo $contacto['id']; ?>" class="btn-flat">Al presionar aquí, se mostrarán los datos de contacto</button>
                <?php else: ?>
                  <span><?php echo strtoupper($contacto['usuario']); ?> | <?php echo $contacto['numero']; ?> | <?php echo $contacto['correo']; ?></span>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</div>
