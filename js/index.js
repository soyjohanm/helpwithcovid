$(document).ready(function(){
  M.AutoInit();
  $(function() {
    /*var directorio = <?php echo "(basename($_SERVER['SCRIPT_NAME']))"; ?>;
    console.log(directorio);*/
    $.ajax({
      type: "GET",
      url: "./modelo/Publicaciones.modelo.php",
      data: { funcion: 'datos' },
      success: function(response) {
        var categoriaArray = response;
        var datosCategoria = {};
        for (var i = 0; i < categoriaArray.length; i++) {
          datosCategoria[categoriaArray[i].categoria] = categoriaArray[i].flag;
        }
        $('input.autocomplete').autocomplete({
          data: datosCategoria
        });
      }
    });
  });
});

$('#formularioInicio').submit(function(event) {
  var parametros = $(this).serialize();
  $.ajax({
    type: "POST",
    url: "./modelo/Login.modelo.php",
    data: parametros,
    success: function(data) {
      var datos = data.split(";");
      if (datos[0] != 0) { M.toast({html: datos[1], classes: 'red darken-2'}); }
      else {
        M.toast({html: datos[1], classes: 'green darken-2'});
        setTimeout(function(){ window.location="./cuenta" }, 1000);
      }
    }
  });
  event.preventDefault();
});

$('#formularioRegistrarse').submit(function(event) {
  var parametros = $(this).serialize();
  $.ajax({
    type: "POST",
    url: "./modelo/Registrarse.modelo.php",
    data: parametros,
    success: function(data) {
      var datos = data.split(";");
      if (datos[0] != 0) { M.toast({html: datos[1], classes: 'red darken-2'}); }
      else {
        M.toast({html: datos[1], classes: 'green darken-2'});
        setTimeout(function(){ window.location="./login" }, 1000);
      }
    }
  });
  event.preventDefault();
});

$('#formularioContacto').submit(function(event) {
  var parametros = $(this).serialize();
  $.ajax({
    type: "POST",
    url: "./modelo/Interesados.modelo.php",
    data: parametros,
    success: function(data) {
      var datos = data.split(";");
      if (datos[0] != 0) { M.toast({html: datos[1], classes: 'red darken-2'}); }
      else {
        M.toast({html: datos[1], classes: 'green darken-2'});
        setTimeout(function(){ window.location="./interesados" }, 1000);
      }
    }
  });
  event.preventDefault();
});

$('#formularioPublicar').submit(function(event) {
  var parametros = $(this).serialize();
  $.ajax({
    type: "POST",
    url: "./modelo/Publicaciones.modelo.php",
    data: parametros,
    success: function(data) {
      var datos = data.split(";");
      if (datos[0] != 0) { M.toast({html: datos[1], classes: 'red darken-2'}); }
      else {
        M.toast({html: datos[1], classes: 'green darken-2'});
        setTimeout(function(){ window.location="./publicaciones" }, 1000);
      }
    }
  });
  event.preventDefault();
});

$('#formularioEditar').submit(function(event) {
  var parametros = $(this).serialize() + '&editar=editar';
  $.ajax({
    type: "POST",
    url: "./modelo/Publicaciones.modelo.php",
    data: parametros,
    success: function(data) {
      var datos = data.split(";");
      if (datos[0] != 0) { M.toast({html: datos[1], classes: 'red darken-2'}); }
      else {
        M.toast({html: datos[1], classes: 'green darken-2'});
        setTimeout(function(){ window.location="./publicaciones" }, 1000);
      }
    }
  });
  event.preventDefault();
});

$('.eliminar').click(function(){
  var confirmar=confirm("¿Realmente deseas eliminar esta publicación?");
  if(confirmar) {
    let eliminar = this.id;
    $.ajax({
      type: 'POST',
      url: "./modelo/Publicaciones.modelo.php",
      data: { 'eliminar' : eliminar },
      success:function(data){
        var datos = data.split(";");
        console.log(datos);
        if (datos[0] != 0) { M.toast({html: datos[1], classes: 'red darken-2'}); }
        else {
          M.toast({html: datos[1], classes: 'green darken-2'});
          setTimeout(function(){ window.location=document.referrer }, 1000);
        }
      }
    });
  } else { return false; }
});

$(document).on('click', '#aceptar', function() {
  $.ajax({
    type: 'POST',
    url: "./modelo/Interesados.modelo.php",
    data: { id: $(this).attr('data-id') },
    success:function(data){
      var datos = data.split(";");
      console.log(datos);
      if (datos[0] != 0) { M.toast({html: datos[1], classes: 'red darken-2'}); }
      else {
        M.toast({html: datos[1], classes: 'green darken-2'});
        setTimeout(function(){ window.location='./interesados' }, 1000);
      }
    }
  });
});

$(".switch").find("input[type=checkbox]").on("change",function() {
  let checked = $(this).prop('checked');
  let estado = $(this).data('id');
  $.ajax({
    url: "./modelo/Publicaciones.modelo.php",
    type: "POST",
    data: { 'estado': estado, 'checked' : checked },
    success: function(data) {
      var datos = data.split(";");
      console.log(data);
      if (datos[0] != 0) { M.toast({html: datos[1], classes: 'red darken-2'}); }
      else { M.toast({html: datos[1], classes: 'green darken-2'}); }
    }
  });
});
