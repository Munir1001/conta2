$(document).ready(function () {
    load(1);
});

$(document).on('click', '#registro-nuevos-codigos-transferencias-clientes', function (event) {
    event.preventDefault();
    var $resultados = $("#resultados_ajax");
    var $boton = $(this);

    // Mostrar carga inicial
    $resultados.html('<div class="alert alert-light solid alert-dismissible fade show">' +
        '<img style="width: 50px;" class="img-fluid" src="/CashManHA/vista/images/Hourglass.gif">' +
        '<strong>¡Generando Código de Seguridad!</strong> Procesando solicitud...</div>');

    // Deshabilitar botón para evitar múltiples clics
    $boton.prop('disabled', true);

    // Ejecutar petición con tiempo mínimo de espera
    $.ajax({
        type: "POST",
        url: "/CashManHA/controlador/cGestionesCashman.php?cashmanhagestion=generador-codigos-transferencias-clientes",
        data: $("#formulario-id").serialize(),
        dataType: "json"
    }).then(function (datos) {
        return new Promise(resolve => {
            setTimeout(() => resolve(datos), 3000);
        });
    }).done(function (datos) {
        if (datos.status === "success") {
            $resultados.html('<div class="alert alert-success solid alert-dismissible fade show">' +
                '<img style="width: 50px;" class="img-fluid" src="/CashManHA/vista/images/success.jpg">' +
                '<strong>¡Código Generado!</strong> Revise su correo electrónico dentro de Spam o Principales.</div>');

            AlertaUsuarioToastr_RegistroExitoso("Código generado exitosamente", "Éxito");
            $("#mensaje-codigo-usuarios").hide();
        } else {
            $resultados.html('<div class="alert alert-danger solid alert-dismissible fade show">' +
                '<img style="width: 50px;" class="img-fluid" src="/CashManHA/vista/images/errortransferencia.jpg">' +
                `<strong>¡Error!</strong> ${datos.message}</div>`);
        }
    }).fail(function (xhr) {
        var mensaje = (xhr.status === 400) ? 'Error en el servicio de correo' : 'Error en el servidor';

        $resultados.html('<div class="alert alert-danger solid alert-dismissible fade show">' +
            '<img style="width: 50px;" class="img-fluid" src="/CashManHA/vista/images/errortransferencia.jpg">' +
            `<strong>¡Error!</strong> ${mensaje}</div>`);
    }).always(function () {
        $boton.prop('disabled', false);
        load(1);
    });
});

function load(page) {
}

$(document).ready(function () {
    load(1);
});
function AlertaUsuarioToastr_ErrorRegistro(titulo, descripcion) {
    toastr.error(titulo, descripcion, {
        positionClass: "toast-top-right",
        timeOut: 5000,
        closeButton: true,
        debug: false,
        newestOnTop: true,
        progressBar: true,
        preventDuplicates: true,
        showDuration: "300",
        hideDuration: "600",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
        tapToDismiss: false
    });
}

function AlertaUsuarioToastr_RegistroExitoso(titulo, descripcion) {
    toastr.success(titulo, descripcion, {
        positionClass: "toast-top-right",
        timeOut: 5000,
        closeButton: true,
        debug: false,
        newestOnTop: true,
        progressBar: true,
        preventDuplicates: true,
        showDuration: "300",
        hideDuration: "600",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
        tapToDismiss: false
    });
}
