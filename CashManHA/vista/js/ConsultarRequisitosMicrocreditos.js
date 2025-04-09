function ConsultarRequisitosMicrocreditos() {
    var sueldo = parseFloat(document.getElementById("valsalariocliente").value);
    var monto = parseFloat(document.getElementById("valmontocreditoclientes").value);
    var plazo = parseInt(document.getElementById("valplazocredito").value);
    var tipoMicrocredito = document.getElementById("tipomicrocredito").value;
    var mensajeError = "";

    // Validación del monto y plazo según el tipo de microcrédito seleccionado
    if (tipoMicrocredito === "200-1000") {
        if (monto < 200 || monto > 1000) {
            mensajeError += "El monto de financiamiento debe ser entre $200 y $1,000 USD para microcrédito minorista.<br>";
        }
        if (plazo < 1 || plazo > 24) {
            mensajeError += "El plazo debe ser entre 1 y 24 meses para microcrédito minorista.<br>";
        }
    } else if (tipoMicrocredito === "1001-10000") {
        if (monto < 1001 || monto > 10000) {
            mensajeError += "El monto de financiamiento debe ser entre $1,001 y $10,000 USD para microcrédito ampliada simple.<br>";
        }
        if (plazo < 1 || plazo > 36) {
            mensajeError += "El plazo debe ser entre 1 y 36 meses para microcrédito ampliada simple.<br>";
        }
    } else if (tipoMicrocredito === "10001-100000") {
        if (monto < 10001 || monto > 100000) {
            mensajeError += "El monto de financiamiento debe ser entre $10,001 y $100,000 USD para microcrédito ampliada.<br>";
        }
        if (plazo < 1 || plazo > 72) {
            mensajeError += "El plazo debe ser entre 1 y 72 meses para microcrédito ampliada.<br>";
        }
    } else {
        mensajeError += "Debe seleccionar un tipo de microcrédito.<br>";
    }

    // Validación del sueldo (califica el 50% del ingreso)
    var montoMaximoCalificado = sueldo * 0.5;
    if (monto > montoMaximoCalificado) {
        mensajeError += "El monto solicitado excede el 50% de su ingreso.<br>";
    }

    // Mostrar mensaje de error o habilitar el botón de envío
    if (mensajeError !== "") {
        var alertaError = '<div class="col-xl-12"><div class="alert alert-danger left-icon-big alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button><div class="media"><div class="alert-left-icon-big"><span><i class="mdi mdi-alert"></i></span></div><div class="media-body"><h5 class="mt-1 mb-2">No Cumple Requisitos!</h5><p class="mb-0">' + mensajeError + '</p></div></div></div></div>';
        document.getElementById('consultarequisitos').innerHTML = alertaError;
        $('#enviar-datos-creditos').prop('disabled', true);
    } else {
        document.getElementById('consultarequisitos').innerHTML = "";
        $('#enviar-datos-creditos').prop('disabled', false);
    }
}
