/**
 * Autor: Esteban Aqiono
 * Fecha: 30/09/2018
 * Descripcion: Funciones de la pantalla principal
 */
$.ready(inicializaPrincipal());

function inicializaPrincipal() {
    // verificar si tiene session abierta
    validarSesion();
    //cargar_formulario('frm/dashboard');
    //cargar_formulario('frm/dashboard');
    $('#usuario').text(datosUsuario('USUARIO'));
    $('#nombre_usuario').text(datosUsuario('NOMBRE'));
    $('#log_out').on('click',function(){
        sessionStorage.removeItem('token');
        location.href = "home";
    });
}

/*function mostrarInformes(){
    console.log('Mostrar informes');
    console.log($('#modalInformes'));
    $('#modalInformes').on('shown.bs.modal', function () {
        $('#myInput').focus();
    });
}*/

