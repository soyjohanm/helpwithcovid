<ul class="collapsible sin-sombra">
  <li>
    <a href="./cuenta"><div class="collapsible-header">Mi cuenta</div></a>
  </li>
  <li>
    <a href="./publicaciones"><div class="collapsible-header">Publicaciones</div></a>
  </li>
  <li>
    <a href="./interesados"><div class="collapsible-header">Interesados
      <?php if ($totalNotificacion['visto']!=0): ?>
        <span class="new badge azul" data-badge-caption="<?php echo ($totalNotificacion['visto']>1) ? 'Notificaciones' : 'Notificación'; ?>"><?php echo $totalNotificacion['visto']; ?></span>
      <?php endif; ?></div>
    </a>
  </li>
  <li>
    <a href="./configuracion"><div class="collapsible-header">Configuración</div></a>
  </li>
  <li>
    <a href="./salir"><div class="collapsible-header">Salir</div></a>
  </li>
</ul>
