function ConsultarRequisitosPrestamosPersonales() {
    var sueldo = parseFloat(document.getElementById("valsalariocliente").value);
    var monto = parseFloat(document.getElementById("valmontocreditoclientes").value);
    var plazo = parseInt(document.getElementById("valplazocredito").value);
    var mensajeError = "";

    // Validación del monto
    if (monto < 500 || monto > 5000) {
        mensajeError += "El monto de financiamiento debe ser entre $500 y $5,000 USD.<br>";
    }

    // Validación del plazo
    var plazoEnMeses = plazo;
    if (plazoEnMeses < 4 || plazoEnMeses > 24) {
        mensajeError += "El plazo debe ser entre 4 y 24 meses.<br>";
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