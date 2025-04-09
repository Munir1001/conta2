function CalculoCuotaMensual() {
    var MontoCredito = parseFloat(document.formulariocreditosclientes.valmontocreditoclientes.value) || 0;
    var PlazoCredito = parseInt(document.formulariocreditosclientes.valplazocredito.value) || 0;
    var TipoAmortizacion = document.formulariocreditosclientes.valtipoamortizacion.value;
    var TasaInteres = parseFloat(document.formulariocreditosclientes.interescredito.value) || 0;
    var TipoPago = document.formulariocreditosclientes.valtipopago.value;

    try {
        var TasaInteresMensual = TasaInteres / 100 / 12;
        var SeguroDesgravamen = MontoCredito * 0.00043;
        var AhorroProgramado = MontoCredito * 0.00025;
        var CuotaMensual = 0;
        var MontoFinalEntregar = MontoCredito - SeguroDesgravamen - AhorroProgramado;

        // Cálculo según el tipo de amortización
        if (TipoAmortizacion === "fija") {
            CuotaMensual = (MontoCredito * TasaInteresMensual * Math.pow(1 + TasaInteresMensual, PlazoCredito)) / (Math.pow(1 + TasaInteresMensual, PlazoCredito) - 1);
        } else if (TipoAmortizacion === "variable") {
            var CuotaCapital = MontoCredito / PlazoCredito;
            CuotaMensual = CuotaCapital + (MontoCredito * TasaInteresMensual);
        }

        // Ajustar la cuota según el tipo de pago y añadir el interés
        var CuotaAjustada;
        var InteresCalculado;
        switch(TipoPago) {
            case "semanal":
                CuotaAjustada = (CuotaMensual * 12 / 52); // Ajuste semanal
                InteresCalculado = (TasaInteres / 100) / 52; // Interés semanal
                CuotaAjustada += InteresCalculado; // Sumar interés a la cuota semanal
                break;
            case "quincenal":
                CuotaAjustada = CuotaMensual * 12 / 24; // Ajuste quincenal
                InteresCalculado = (TasaInteres / 100) / 24; // Interés semanal
                CuotaAjustada += InteresCalculado;
                break;
            case "mensual":
            default:
                CuotaAjustada = CuotaMensual;
                break;
        }

        // Mostrar resultados
        document.getElementById('resultado').innerHTML = CuotaAjustada.toFixed(2);
        document.getElementById('monto-credito-solicitado').innerHTML = MontoCredito.toFixed(2);
        document.getElementById('calculodesembolso').innerHTML = MontoFinalEntregar.toFixed(2);
        document.getElementById('tasa-interes-credito').innerHTML = TasaInteres.toFixed(2);
        document.getElementById('plazo-credito').innerHTML = PlazoCredito + " meses";
        document.getElementById('SeguroDesgravamen').innerHTML = SeguroDesgravamen.toFixed(2);
        document.getElementById('ahorroprogramado').innerHTML = AhorroProgramado.toFixed(2);
        
        // Si existe, actualizar el campo oculto de cuota mensual
        var cuotaMensualAsignada = document.getElementById("cuotamensualasignada");
        if (cuotaMensualAsignada) {
            cuotaMensualAsignada.value = CuotaAjustada.toFixed(2);
        }
        
    } catch (e) {
        console.error(e);        
    }
}

function handleTipoPagoChange() {
    CalculoCuotaMensual();
    actualizarTipoCuota();
}

function actualizarTipoCuota() {
    var tipoPago = document.getElementById("valtipopago").value;
    var tipoCuotaTexto = document.getElementById("tipoCuotaTexto");
    
    switch (tipoPago) {
        case "semanal":
            tipoCuotaTexto.textContent = "Semanal Aproximada";
            break;
        case "quincenal":
            tipoCuotaTexto.textContent = "Quincenal Aproximada";
            break;
        case "mensual":
        default:
            tipoCuotaTexto.textContent = "Mensual Aproximada";
            break;
    }
}

function adjustInterestRate(step) {
    var input = document.getElementById('interescredito');
    var value = parseFloat(input.value) || 0;
    value += step;
    if (value >= 0 && value <= 100) {
        input.value = value.toFixed(1);
    }
}

function LimpiezaDatos() {
    // VARIABLES GLOBALES
    CalcularCuotaMensual = 0; TotalDesembolso = 0; CreditoSolicitado = 0; MesesPlazo = 0; SeguroDesgravamen = 0; AhorroProgramado= 0; 
    // FORMULARIO DE CREDITOS
    document.getElementById("ingreso-datos-credito-clientes").reset();
    // SECCION CALCULO CUOTA FINAL
    document.getElementById('resultado').innerHTML = CalcularCuotaMensual.toFixed(2);
    document.getElementById('calculodesembolso').innerHTML = TotalDesembolso.toFixed(2);
    document.getElementById('monto-credito-solicitado').innerHTML = CreditoSolicitado.toFixed(2);
    document.getElementById('plazo-credito').innerHTML = CreditoSolicitado + " meses";
    document.getElementById('SeguroDesgravamen').innerHTML = SeguroDesgravamen.toFixed(2);
    document.getElementById('ahorroprogramado').innerHTML = AhorroProgramado.toFixed(2);
}


