$(document).ready(() => inicializarForma());

var cliente = {};

function inicializarForma() {
    cargarClientes();

    $("#botonNuevo").on('click', function () {
        cargarModalClientes();
    });
}
;

function cargarModalClientes() {

    cargarModal('frm/clientes/modalDatosCliente.html', 'nombreModal', '',
            function () {
                $('#btnGuardar').on('click', function () {
                    //console.log('Guardar');
                    guardar();
                });
                $('#btnBorrar').on('click', function () {
                    //console.log('Borrar');
                    estaSeguroBorrar();
                });
            });

    setTimeout(function () {
        $('#nombreModal').focus();
        $('#btnBorrar').attr('disabled','disabled');
    }, 100);

}
;



/*****  CARGAR LISTADO DE CLIENTES ********/
function cargarClientes() {
    //console.log("api/clientes");
    var pUrl = "api/clientes";
    var pBeforeSend = "";
    var pSucces = "cargarClientesAjaxSuccess(json)";
    var pError = "ajax_error()";
    var pComplete = "";
    ajaxGet(pUrl, pBeforeSend, pSucces, pError, pComplete);
}

function cargarClientesAjaxSuccess(json) {
    var row = "";
    var datos = json["datos"];
    $.each(datos, function (key, value) {
        //console.log(value);
        row += "<tr class='manito' onclick='seleccionar_cliente($(this))'>";
        row += "<th scope='row'>" + value.ID + "</th>";
        row += "<td>" + value.NOMBRE + "</td>";
        row += "<td>" + value.TELEFONO1 + "</td>";
        row += "<td>" + value.DIRECCION1 + "</td>";
        row += "<td>" + value.CI + "</td>";
        row += "<td>" + value.RUC + "</td>";
        row += "</tr>";
    });
    CargaDatatables('dtClientes', row);
}

function seleccionar_cliente($this) {
    //console.log($this.find('th').eq(0).text());
    var ID = $this.find('th').eq(0).text();
    if (!empty(ID)) {
        cargarModalClientes();

        setTimeout(function () {
            $("#idClienteModal").val(ID);
            $("#nombreModal").focus();
            $("#btnBorrar").removeAttr('disabled');
            // Buscar cliente
            cargarCliente(ID);
        }, 100);
    }

}

/***** /CARGAR LISTADO DE CLIENTES ********/


/*************  EDITAR ***********************/
function cargarCliente(pId) {
    //console.log(pDatosFormulario);
    var pUrl = "api/clientes/" + pId;
    var pBeforeSend = "";
    var pSucces = "cargarClienteAjaxSuccess(json)";
    var pError = "ajax_error()";
    var pComplete = "";
    ajaxGet(pUrl, pBeforeSend, pSucces, pError, pComplete);
}

function cargarClienteAjaxSuccess(json) {
    var datos = json["datos"];
    $("#idClienteModal").val(datos[0].ID);
    $("#nombreModal").val(datos[0].NOMBRE);
    $("#telefono1Modal").val(datos[0].TELEFONO1);
    $("#telefono2Modal").val(datos[0].TELEFONO2);
    $("#direccion1Modal").val(datos[0].DIRECCION1);
    $("#direccion2Modal").val(datos[0].DIRECCION2);
    $("#ciModal").val(datos[0].CI);
    $("#rucModal").val(datos[0].RUC);
    $("#porc_descuentoModal").val(datos[0].PORC_DESCUENTO);
    $('#nombreModal').focus();

}
/************* /EDITAR************************/


/***************  GUARDAR ********************/
function guardar() {
    actualizaCliente();

    if (empty($("#idClienteModal").val())) {
        // nuevo
        guardarNuevo();
    } else {
        // actualizar
        guardarModificar();
    }
}

function guardarNuevo() {
    swalCargando('Guardando');
    var pDatosFormulario = JSON.stringify(cliente);
    //console.log(pDatosFormulario);
    var pUrl = "api/clientes";
    var pBeforeSend = "";
    var pSucces = "guardarNuevoAjaxSuccess(json)";
    var pError = "ajax_error()";
    var pComplete = "";
    ajax(pDatosFormulario, pUrl, pBeforeSend, pSucces, pError, pComplete);
}

function guardarNuevoAjaxSuccess(json) {
    swalCerrar();
    var datos = json["datos"];
    //console.log(json.datos);
    if (!empty(json.datos)) {
        swalCorrecto('Guarddo', 'Id:' + json.datos.id);
        $('#cerrarModal').click();

        cargarClientes();

    }
}

function guardarModificar() {
    //console.log('Actualizando');
    swalCargando('Actualizando');
    var pDatosFormulario = JSON.stringify(cliente);
    var pUrl = "api/clientes/" + cliente['ID'];
    var pBeforeSend = "";
    var pSucces = "guardarModificarAjaxSuccess(json)";
    var pError = "ajax_error()";
    var pComplete = "";
    ajaxPut(pDatosFormulario, pUrl, pBeforeSend, pSucces, pError, pComplete);
}

function guardarModificarAjaxSuccess(json) {
    swalCerrar();
    var datos = json["datos"];
    //console.log(json);
    if (!empty(json.datos)) {
        swalCorrecto('Actualizado', 'Id:' + json.datos.id);
        $('#cerrarModal').click();

        setTimeout(function () {
            cargarClientes();
        }, 200);
    }
}

/***************  /GUARDAR *******************/
function estaSeguroBorrar() {
    actualizaCliente();
    estaSeguroSwal('Esta seguro que desea borral el cliente: '+cliente['ID'], 'eliminar()' , '');
}
function eliminar() {
    //console.log('Actualizando');
    
    swalCargando('Eliminando');
    var pDatosFormulario = "";
    var pUrl = "api/clientes/" + cliente['ID'];
    var pBeforeSend = "";
    var pSucces = "eliminarAjaxSuccess(json)";
    var pError = "ajax_error()";
    var pComplete = "";
    ajaxDel(pDatosFormulario, pUrl, pBeforeSend, pSucces, pError, pComplete);
}

function eliminarAjaxSuccess(json) {
    swalCerrar();
    var datos = json["datos"];
    console.log(json);
    if (!empty(json.datos)) {
        swalCorrecto('Borrado', 'Id:' + json.datos.id);
        $('#cerrarModal').click();

        setTimeout(function () {
            cargarClientes();
        }, 200);
    }
}
/***************  BORRAR *******************/

/***************  /BORRAR *******************/

function actualizaCliente() {
    cliente = {};
    cliente['ID'] = $("#idClienteModal").val();
    cliente['NOMBRE'] = $("#nombreModal").val();
    cliente['TELEFONO1'] = $("#telefono1Modal").val();
    cliente['TELEFONO2'] = $("#telefono2Modal").val();
    cliente['DIRECCION1'] = $("#direccion1Modal").val();
    cliente['DIRECCION2'] = $("#direccion2Modal").val();
    cliente['CI'] = $("#ciModal").val();
    cliente['RUC'] = $("#rucModal").val();
    cliente['PORC_DESCUENTO'] = $("#porc_descuentoModal").val();
    return cliente;
}
