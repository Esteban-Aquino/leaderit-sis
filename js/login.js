/**
 * Autor: Esteban Aqiono
 * Fecha: 15/11/2019
 * Descripcion: Funciones del Login
 */
/********* INDEX LOGGIN *********/
function inicializaLogin() {
    // verificar si tiene session abierta
    var token = sessionStorage.getItem("token");
    //console.log(token);
    if (token !== null && token !== "") {
        //console.log("home");
        location.href = "home";
    }
    //cerrarSessionAjax();
    $("#usuario").focus(); 
    siguienteCampo('#usuario', '#clave', false);
    siguienteCampo('#clave', '#btn-ingresar button', false);
}

function validarLoggin() {
    //console.log('validarLoggin');
    var vusuario = $("#usuario").val();
    var vclave = $("#clave").val();
    if (vusuario.trim() === '') {
        swalError('Ingrese usuario', 'Credenciales invalidas', '#usuario');
        $("#usuario_usuario").focus();
    } else if (vclave.trim() === '') {
        swalError('Ingrese Contraseña', 'Credenciales invalidas', '#clave');
        $("#clave_usuario").focus();
    } else {
        swalCargando("Por favor espere");
        validarAccesoAjax();
        //location.href = "menu.html";
    }
    ;
}

function validarAccesoAjax() {
    var pDatosFormulario = JSON.stringify(getFormData($('#formAcceso')));//$('#formAcceso');
    //console.log(pDatosFormulario);
    var pUrl = 'api/validar';
    var pBeforeSend = "";
    var pSucces = "ValidarAccesoAjaxSuccess(json)";
    var pError = "ValidarAccesoAjaxError()";
    var pComplete = "";
    
    ajaxValidarSession(pDatosFormulario, pUrl, pBeforeSend, pSucces, pError, pComplete);
}

function ValidarAccesoAjaxSuccess(json) {
    //console.log(json);
    if (json.acceso) {
        //console.log('OK');
        // guardar en storage
        sessionStorage.setItem("token", json.token);
        location.href = "home";
        //console.log(datosUsuario());
    } else {
        sessionStorage.setItem("token", "");
        console.log("Fail");
        swalCerrar();
        swalError("Error de autenticacion", "Credenciales invalidas");
        //mensaje('Credenciales Invalidas', 'Aceptar', '#usuario_usuario');
    }
    ;
}

function ValidarAccesoAjaxError() {
    sessionStorage.setItem("token", "");
    console.log("Fail. ");
    swalCerrar();
    swalError("Error de seridor", "Error al ingresar, comuniquese con soporte");
}