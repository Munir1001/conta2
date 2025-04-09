// Separate validation functions for each form
function comprobarNumeroCuentaAhorroCliente() {
    $("#loaderIcon").show();
    jQuery.ajax({
        url: "../modelo/consulta-validacion-numero-cuentas-clientes.php",
        data: {
            'val-numerocuentaahorro': $("#val-numerocuentaahorro").val()
        },
        type: "POST",
        success: function(data) {
            $("#estadonumerocuenta").html(data);
            $("#loaderIcon").hide();
        }
    });
}

function comprobarNumeroCuentaAhorroProgramado() {
    $("#loaderIcon-programado").show();
    jQuery.ajax({
        url: "../modelo/consulta-validacion-numero-cuentas-clientes.php",
        data: {
            'val-numerocuentaahorro-programado': $("#val-numerocuentaahorro-programado").val()
        },
        type: "POST",
        success: function(data) {
            $("#resultado-validacion").html(data);
            $("#loaderIcon-programado").hide();
        }
    });
}