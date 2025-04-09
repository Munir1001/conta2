//JavaScript para filtrado y paginación [MIS TRANSACCIONES]
$(document).ready(function () {
    // 1. Almacenar todas las transacciones al cargar la página
    const allTransactions = $('.transaction-item').clone();
    let currentFilteredTransactions = [];

    document.querySelector('.btn-limpiar').addEventListener('click', function (e) {
        e.preventDefault();
        // Carga la URL sin parámetros vía AJAX
        fetch(this.href)
            .then(response => response.text())
            .then(html => {
                document.getElementById('resultados').innerHTML = html;
                // Opcional: resetear los campos del formulario
                document.getElementById('filtro-transacciones').reset();
            });
    });

    // 3. Manejar cambios en los filtros
    $('#fecha-inicio, #fecha-fin, #tipo-transaccion, #items-per-page').on('change keyup', function () {
        aplicarFiltros();
    });

    // 4. Función principal de filtrado
    function aplicarFiltros() {
        const fechaInicio = $('#fecha-inicio').val();
        const fechaFin = $('#fecha-fin').val();
        const tipo = $('#tipo-transaccion').val();
        const porPagina = parseInt($('#items-per-page').val());

        // Limpiar contenedor
        $('#transactions-container').empty();

        // Filtrar transacciones
        currentFilteredTransactions = allTransactions.filter(function () {
            const $this = $(this);
            const fechaTrans = $this.data('fecha');
            const tipoTrans = $this.data('tipo');

            // Validar fecha
            const cumpleFecha = (!fechaInicio || fechaTrans >= fechaInicio) &&
                (!fechaFin || fechaTrans <= fechaFin);

            // Validar tipo
            const cumpleTipo = tipo === 'all' || tipoTrans === tipo;

            return cumpleFecha && cumpleTipo;
        });

        // Si no hay resultados
        if (currentFilteredTransactions.length === 0) {
            $('#transactions-container').html('<div class="text-center p-4 text-muted">No se encontraron transacciones con los filtros seleccionados</div>');
            actualizarContadores(0, porPagina);
            return;
        }

        // Agrupar por fecha
        const groupedByDate = {};
        currentFilteredTransactions.each(function () {
            const $this = $(this);
            const fecha = $this.data('fecha');
            if (!groupedByDate[fecha]) {
                groupedByDate[fecha] = [];
            }
            groupedByDate[fecha].push($this);
        });

        // Generar HTML agrupado
        let html = '';
        Object.keys(groupedByDate).sort().reverse().forEach(fecha => {
            // Formatear fecha para mostrar (usando la misma lógica que en PHP)
            let displayDate = formatDisplayDate(fecha);

            html += `<div class="transaction-group mb-0">
                    <div class="transaction-date-header bg-light p-2 px-3 border-bottom">
                        <h6 class="mb-0 font-weight-bold small">${displayDate}</h6>
                    </div>`;

            groupedByDate[fecha].forEach($trans => {
                html += $trans[0].outerHTML;
            });

            html += '</div>';
        });

        $('#transactions-container').html(html);

        // Actualizar paginación
        actualizarPaginacionCliente(porPagina);
    }

    function modificarAplicarFiltros() {
        const originalFunction = aplicarFiltros;
        aplicarFiltros = function () {
            const result = originalFunction.apply(this, arguments);
            // Exponer las transacciones filtradas globalmente
            window.currentFilteredTransactions = currentFilteredTransactions;
            return result;
        };
    }

    // Ejecutar la modificación cuando se cargue la página
    document.addEventListener('DOMContentLoaded', function () {
        // Modificar aplicarFiltros si existe
        if (typeof aplicarFiltros === 'function') {
            modificarAplicarFiltros();
        }

        // Hacer una llamada inicial para asegurar que tenemos datos
        if (typeof aplicarFiltros === 'function') {
            aplicarFiltros();
        }
    });

    // 5. Función para formatear fechas (igual que en PHP)
    function formatDisplayDate(dateStr) {
        // Ajustar para manejar la zona horaria local
        const adjustForTimezone = (dateString) => {
            const date = new Date(dateString);
            // Compensar por la diferencia de zona horaria
            date.setMinutes(date.getMinutes() + date.getTimezoneOffset());
            return date;
        };
    
        // Fechas de referencia (hoy y ayer) en formato local
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        
        const yesterday = new Date(today);
        yesterday.setDate(yesterday.getDate() - 1);
        
        // Fecha a comparar (ajustada a zona horaria)
        const inputDate = adjustForTimezone(dateStr);
        inputDate.setHours(0, 0, 0, 0);
        
        // Comparar fechas (sin hora)
        if (inputDate.getTime() === today.getTime()) return 'Hoy';
        if (inputDate.getTime() === yesterday.getTime()) return 'Ayer';
    
        // Formatear fecha completa
        const options = {
            weekday: 'long',
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        };
        
        let dateFormatted = inputDate.toLocaleDateString('es-ES', options);
        dateFormatted = dateFormatted.charAt(0).toUpperCase() + dateFormatted.slice(1);
    
        // Traducir días y meses
        const translations = {
            'Monday': 'Lunes',
            'Tuesday': 'Martes',
            'Wednesday': 'Miércoles',
            'Thursday': 'Jueves',
            'Friday': 'Viernes',
            'Saturday': 'Sábado',
            'Sunday': 'Domingo',
            'January': 'Enero',
            'February': 'Febrero',
            'March': 'Marzo',
            'April': 'Abril',
            'May': 'Mayo',
            'June': 'Junio',
            'July': 'Julio',
            'August': 'Agosto',
            'September': 'Septiembre',
            'October': 'Octubre',
            'November': 'Noviembre',
            'December': 'Diciembre'
        };
    
        for (const [en, es] of Object.entries(translations)) {
            dateFormatted = dateFormatted.replace(new RegExp(en, 'g'), es);
        }
    
        return dateFormatted;
    }

    // 6. Actualizar paginación
    function actualizarPaginacionCliente(porPagina) {
        const total = currentFilteredTransactions.length;
        const totalPaginas = Math.ceil(total / porPagina);

        // Mostrar primera página
        mostrarPagina(1, porPagina);

        // Actualizar contadores
        actualizarContadores(total, porPagina);

        // Actualizar controles de paginación
        actualizarControlesPaginacion(totalPaginas);
    }

    // 7. Mostrar página específica
    function mostrarPagina(pagina, porPagina) {
        const inicio = (pagina - 1) * porPagina;
        const fin = inicio + porPagina;

        // Ocultar todas las transacciones primero
        $('.transaction-item').hide();

        // Mostrar solo las de la página actual
        currentFilteredTransactions.slice(inicio, fin).show();

        // Actualizar página actual
        $('#current-page').text(pagina);
        $('#showing-from').text(inicio + 1);
        $('#showing-to').text(Math.min(fin, currentFilteredTransactions.length));
    }

    // 8. Actualizar contadores
    function actualizarContadores(total, porPagina) {
        $('#total-records').text(total);
        $('#total-pages').text(Math.ceil(total / porPagina));
    }

    // 9. Actualizar controles de paginación
    function actualizarControlesPaginacion(totalPaginas) {
        const paginaActual = parseInt($('#current-page').text()) || 1;
        const paginationControls = $('#pagination-controls');
        paginationControls.empty();

        // Botón Anterior
        paginationControls.append(
            `<li class="page-item ${paginaActual <= 1 ? 'disabled' : ''}">
                <a class="page-link" href="#" data-page="${paginaActual - 1}">
                    <i class="fas fa-angle-left"></i>
                </a>
            </li>`
        );

        // Mostrar páginas cercanas
        let startPage = Math.max(1, paginaActual - 2);
        let endPage = Math.min(totalPaginas, paginaActual + 2);

        // Ajustar cuando estamos cerca de los extremos
        if (paginaActual <= 3) endPage = Math.min(5, totalPaginas);
        if (paginaActual >= totalPaginas - 2) startPage = Math.max(totalPaginas - 4, 1);

        // Primera página
        if (startPage > 1) {
            paginationControls.append(
                `<li class="page-item">
                    <a class="page-link" href="#" data-page="1">1</a>
                </li>`
            );
            if (startPage > 2) {
                paginationControls.append('<li class="page-item disabled"><span class="page-link">...</span></li>');
            }
        }

        // Páginas intermedias
        for (let i = startPage; i <= endPage; i++) {
            paginationControls.append(
                `<li class="page-item ${i === paginaActual ? 'active' : ''}">
                    <a class="page-link" href="#" data-page="${i}">${i}</a>
                </li>`
            );
        }

        // Última página
        if (endPage < totalPaginas) {
            if (endPage < totalPaginas - 1) {
                paginationControls.append('<li class="page-item disabled"><span class="page-link">...</span></li>');
            }
            paginationControls.append(
                `<li class="page-item">
                    <a class="page-link" href="#" data-page="${totalPaginas}">${totalPaginas}</a>
                </li>`
            );
        }

        // Botón Siguiente
        paginationControls.append(
            `<li class="page-item ${paginaActual >= totalPaginas ? 'disabled' : ''}">
                <a class="page-link" href="#" data-page="${paginaActual + 1}">
                    <i class="fas fa-angle-right"></i>
                </a>
            </li>`
        );

        // Manejar clic en páginas
        paginationControls.off('click').on('click', '.page-link', function (e) {
            e.preventDefault();
            const nuevaPagina = $(this).data('page');
            if (nuevaPagina) {
                const porPagina = parseInt($('#items-per-page').val());
                mostrarPagina(nuevaPagina, porPagina);
            }
        });
    }

    // 10. Inicializar al cargar la página
    currentFilteredTransactions = allTransactions;
    const porPaginaInicial = parseInt($('#items-per-page').val());
    actualizarPaginacionCliente(porPaginaInicial);
});

// Configuración global para el PDF
const configPDF = {
    logoUrl: 'https://raw.githubusercontent.com/Munir1001/images/main/logo-negro.png',
    colorPrimario: '#6c312e', // Marrón oscuro
    colorSecundario: '#f1e9e8', // Beige claro
    colorExito: '#000000', // Negro (antes rojo suave)
    colorPeligro: '#000000', // Negro (antes rojo oscuro)
    colorTexto: '#000000', // Negro (antes gris oscuro)
    colorBorde: '#9f9d9d', // Gris medio
    fuentePrincipal: 'Helvetica',
    fuenteNegrita: 'Helvetica-Bold',
    margenPagina: 20
};


async function generarPDFProfesional() {
    try {
        // Mostrar indicador de carga
        const loadingElement = crearLoadingElement();
        document.body.appendChild(loadingElement);

        // Crear instancia de jsPDF
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF({
            orientation: 'portrait',
            unit: 'mm',
            format: 'a4'
        });

        // 1. ENCABEZADO PROFESIONAL
        await agregarEncabezado(doc);

        // 2. INFORMACIÓN DE LA CUENTA Y FILTROS
        const startY = agregarInformacionCuenta(doc);

        // 3. OBTENER Y PROCESAR TRANSACCIONES
        const { transaccionesAgrupadas, totales } = procesarTransacciones();

        // 4. TABLA DE TRANSACCIONES
        let currentY = startY;
        if (transaccionesAgrupadas.length > 0) {
            currentY = agregarTablaTransacciones(doc, transaccionesAgrupadas, currentY);
            currentY = agregarTotales(doc, totales, currentY);
        } else {
            currentY = agregarMensajeSinResultados(doc, currentY);
        }

        // 5. PIE DE PÁGINA PROFESIONAL
        agregarPiePagina(doc);

        // Guardar el PDF
        doc.save(`Reporte_Transacciones_${new Date().toISOString().split('T')[0]}.pdf`);

        // Eliminar indicador de carga
        document.body.removeChild(loadingElement);

    } catch (error) {
        console.error('Error al generar PDF:', error);
        alert('Error al generar el PDF: ' + error.message);
        if (document.querySelector('.loading-pdf')) {
            document.body.removeChild(document.querySelector('.loading-pdf'));
        }
    }
}

// ================= FUNCIONES AUXILIARES MEJORADAS ================= //

function crearLoadingElement() {
    const loadingElement = document.createElement('div');
    loadingElement.className = 'loading-pdf';
    loadingElement.innerHTML = `
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Generando PDF...</span>
        </div>
        <p class="mt-2">Generando reporte...</p>
    `;
    loadingElement.style.cssText = `
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: rgba(255,255,255,0.9);
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 0 20px rgba(0,0,0,0.2);
        z-index: 9999;
        text-align: center;
    `;
    return loadingElement;
}

async function agregarEncabezado(doc) {
    // Ajustar posición del logo para que no se superponga con el título
    try {
        const logoResponse = await fetch(configPDF.logoUrl);
        const logoBlob = await logoResponse.blob();
        const logoData = await new Promise((resolve) => {
            const reader = new FileReader();
            reader.onload = () => resolve(reader.result);
            reader.readAsDataURL(logoBlob);
        });

        // Colocar el logo antes del título y centrado
        doc.addImage(logoData, 'PNG', (210 - 40) / 2, 10, 40, 15);
    } catch (e) {
        console.warn('No se pudo cargar el logo:', e);
    }

    // Título principal - moverlo más abajo para que esté debajo del logo
    doc.setFont(configPDF.fuenteNegrita, 'bold');
    doc.setFontSize(16);
    doc.setTextColor(...configPDF.colorPrimario);
    doc.text('REPORTE DE TRANSACCIONES BANCARIAS', 105, 35, { align: 'center' });

    // Información corporativa
    doc.setFont(configPDF.fuentePrincipal, 'normal');
    doc.setFontSize(9);
    doc.setTextColor(...configPDF.colorTexto);
    doc.text('Sistema de Gestión Financiera', configPDF.margenPagina, 40);
    doc.text(new Date().toLocaleDateString('es-ES', {
        weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
    }), 105, 40, { align: 'center' });
    doc.text('Página 1 de 1', 190 - configPDF.margenPagina, 40, { align: 'right' });

    // Línea decorativa
    doc.setDrawColor(...configPDF.colorPrimario);
    doc.setLineWidth(0.3);
    doc.line(configPDF.margenPagina, 45, 210 - configPDF.margenPagina, 45);
}

function agregarInformacionCuenta(doc) {
    const startY = 50; // Posición inicial después del encabezado
    const lineHeight = 6; // Misma altura de línea que agregarTotales
    const boxWidth = 170; // Ancho del recuadro (igual que en agregarTotales)
    const leftMargin = (210 - boxWidth) / 2; // Margen izquierdo para centrar

    // Obtener datos del cliente
    const cuentaInfo = document.querySelector('.alert-info')?.textContent.match(/cuenta\s+([^\s]+)/);
    const numeroCuenta = cuentaInfo ? cuentaInfo[1] : 'N/A';

    // Obtener filtros
    const filtros = {
        fechaInicio: document.getElementById('fecha-inicio')?.value || '',
        fechaFin: document.getElementById('fecha-fin')?.value || '',
        tipo: document.getElementById('tipo-transaccion')?.value || 'all'
    };

    // Si no hay fechas seleccionadas, usar el rango automático
    if (!filtros.fechaInicio || !filtros.fechaFin) {
        const rangoAutomatico = obtenerRangoFechasTransacciones();
        // Solo reemplazar los valores vacíos
        if (!filtros.fechaInicio) filtros.fechaInicio = rangoAutomatico.fechaInicio;
        if (!filtros.fechaFin) filtros.fechaFin = rangoAutomatico.fechaFin;
    }

    // Título centrado (estilo similar a RESUMEN FINANCIERO)
    doc.setFont(configPDF.fuenteNegrita, 'bold');
    doc.setFontSize(12);
    doc.setTextColor(...configPDF.colorTexto);
    doc.text('INFORMACIÓN DEL REPORTE', 105, startY, { align: 'center' });

    // Configuración común para el contenido
    doc.setFontSize(11);
    let currentLine = startY + 10;

    // Llamar a la función para obtener el nombre del cliente
    var nombreCliente = obtenerNombreCliente();

    // Línea 1: Nombre del cliente
    doc.setFont(configPDF.fuentePrincipal, 'normal');
    doc.text('Nombre del cliente:', leftMargin + 10, currentLine);
    doc.setFont(configPDF.fuenteNegrita, 'bold');
    doc.text(nombreCliente, leftMargin + boxWidth - 10, currentLine, { align: 'right' });
    currentLine += lineHeight;

    // Línea 2: Número de cuenta
    doc.setFont(configPDF.fuentePrincipal, 'normal');
    doc.text('Número de cuenta:', leftMargin + 10, currentLine);
    doc.setFont(configPDF.fuenteNegrita, 'bold');
    doc.text(numeroCuenta, leftMargin + boxWidth - 10, currentLine, { align: 'right' });
    currentLine += lineHeight;


    // Línea 2: Período
    doc.setFont(configPDF.fuentePrincipal, 'normal');
    doc.text('Período:', leftMargin + 10, currentLine);
    let periodoTexto;
    if (!document.getElementById('fecha-inicio')?.value && !document.getElementById('fecha-fin')?.value) {
        periodoTexto = `${formatearFechaPDF(filtros.fechaInicio) || 'No disponible'} - ${formatearFechaPDF(filtros.fechaFin) || 'No disponible'} (Completo)`;
    } else {
        periodoTexto = `${formatearFechaPDF(filtros.fechaInicio) || 'No especificado'} - ${formatearFechaPDF(filtros.fechaFin) || 'No especificado'}`;
    }

    doc.text(periodoTexto, leftMargin + boxWidth - 10, currentLine, { align: 'right' });
    currentLine += lineHeight;

    // Línea 3: Tipo
    doc.setFont(configPDF.fuentePrincipal, 'normal');
    doc.text('Tipo:', leftMargin + 10, currentLine);
    doc.setFont(configPDF.fuenteNegrita, 'bold');
    doc.text(obtenerNombreTipo(filtros.tipo), leftMargin + boxWidth - 10, currentLine, { align: 'right' });
    currentLine += lineHeight;

    // Línea divisoria (similar a agregarTotales)
    doc.setDrawColor(...configPDF.colorPrimario);
    doc.setLineWidth(0.3);
    doc.line(leftMargin, currentLine, leftMargin + boxWidth, currentLine);

    return currentLine + 10; // Espacio adicional después de la línea
}


function procesarTransacciones() {
    const transacciones = [];
    let totalIngresos = 0;
    let totalEgresos = 0;

    // Obtener transacciones del DOM
    const grupos = document.querySelectorAll('.transaction-group');
    grupos.forEach(grupo => {
        const fechaHeader = grupo.querySelector('.transaction-date-header h6')?.textContent || '';
        const fechaReal = convertirFechaHeader(fechaHeader);

        grupo.querySelectorAll('.transaction-item').forEach(item => {
            const montoElement = item.querySelector('h5');
            const montoTexto = montoElement?.textContent.trim() || '0';
            const montoNum = parseFloat(montoTexto.replace(/[^\d.-]/g, '')) || 0;
            const esPositivo = montoElement?.classList.contains('text-success') || montoTexto.includes('+');

            if (esPositivo) {
                totalIngresos += montoNum;
            } else {
                totalEgresos += montoNum;
            }

            // Modificación aquí para capturar correctamente el tipo
            const tipoElement = item.querySelector('.badge.badge-light.border.text-muted.small');
            const tipo = tipoElement ? tipoElement.textContent.trim() : '';

            transacciones.push({
                fecha: fechaReal,
                referencia: item.querySelector('h6')?.textContent.replace('#', '').trim() || '',
                hora: item.querySelector('small.text-muted')?.textContent.trim() || '',
                tipo: tipo,
                estado: item.querySelector('.badge-light.text-danger, .badge-light.text-success, .badge-light.text-secondary')?.textContent.trim() || '',
                monto: montoTexto,
                esPositivo
            });
        });
    });

    // Agrupar por fecha
    const transaccionesPorFecha = {};
    transacciones.forEach(trans => {
        if (!transaccionesPorFecha[trans.fecha]) {
            transaccionesPorFecha[trans.fecha] = [];
        }
        transaccionesPorFecha[trans.fecha].push(trans);
    });

    // Ordenar por fecha (más reciente primero)
    const fechasOrdenadas = Object.keys(transaccionesPorFecha).sort((a, b) => new Date(b) - new Date(a));

    // Preparar datos para la tabla
    const transaccionesAgrupadas = fechasOrdenadas.map(fecha => {
        return {
            fecha: fecha,
            transacciones: transaccionesPorFecha[fecha].sort((a, b) => b.hora.localeCompare(a.hora))
        };
    });

    return {
        transaccionesAgrupadas,
        totales: {
            ingresos: totalIngresos,
            egresos: totalEgresos,
            balance: totalIngresos - totalEgresos
        }
    };
}

function agregarTablaTransacciones(doc, transaccionesAgrupadas, startY) {
    let currentY = startY;

    transaccionesAgrupadas.forEach(grupo => {
        // Verificar espacio en página
        if (currentY > 250) {
            doc.addPage();
            agregarEncabezadoPagina(doc, doc.internal.getNumberOfPages());
            currentY = configPDF.margenPagina + 30;
        }
        // Encabezado de fecha - usar color negro en lugar de primario
        doc.setFont(configPDF.fuenteNegrita, 'bold');
        doc.setFontSize(11);
        doc.setTextColor(...configPDF.colorTexto); // Color negro para las fechas
        doc.text(formatearFechaPDF(grupo.fecha), configPDF.margenPagina, currentY);
        currentY += 5;



        const columnStyles = {
            0: { cellWidth: 18, halign: 'center' },  // Hora
            1: { cellWidth: 45, halign: 'left' },    // Referencia
            2: { cellWidth: 35, halign: 'center' },  // Tipo
            3: { cellWidth: 35, halign: 'center' },  // Estado
            4: { cellWidth: 25, halign: 'right' }    // Monto
        };

        const pageWidth = doc.internal.pageSize.getWidth();
        const tableWidth = calculateTableWidth(columnStyles);
        const leftMargin = (pageWidth - tableWidth) / 2;

        function calculateTableWidth(columnStyles) {
            let totalWidth = 0;
            for (const key in columnStyles) {
                if (columnStyles.hasOwnProperty(key) && columnStyles[key].cellWidth) {
                    totalWidth += columnStyles[key].cellWidth;
                }
            }
            return totalWidth;
        }

        // Preparar datos para la tabla sin colores en los montos
        const body = grupo.transacciones.map(trans => [
            trans.hora,
            trans.referencia,
            obtenerTipoTransaccion(trans.tipo),  // Llamamos a la nueva función para obtener el nombre del tipo de transacción
            trans.estado,
            trans.monto // Sin colores especiales, usará el color predeterminado negro
        ]);

        // Generar tabla
        doc.autoTable({
            startY: currentY,
            head: [['HORA', 'REFERENCIA', 'TIPO', 'ESTADO', 'MONTO']],
            body: body,
            headStyles: {
                fillColor: configPDF.colorPrimario,
                textColor: [255, 255, 255],
                fontStyle: 'bold',
                halign: 'center'
            },
            columnStyles: columnStyles,
            styles: {
                fontSize: 9,
                cellPadding: 3,
                overflow: 'linebreak',
                valign: 'middle',
                textColor: [0, 0, 0] // Asegurar que todo el texto sea negro
            },
            margin: { left: leftMargin },
            theme: 'grid',
            didDrawPage: (data) => {
                currentY = data.cursor.y + 7;
            }
        });
    });

    return currentY;
}

function agregarTotales(doc, { ingresos, egresos, balance }, startY) {
    // Verificar espacio en página
    if (startY > 240) {
        doc.addPage();
        // Agregar encabezado de página
        agregarEncabezadoPagina(doc, doc.internal.getNumberOfPages());
        // Iniciar más abajo para dejar espacio para el encabezado de página
        startY = configPDF.margenPagina + 30; // Ajustar este valor según el tamaño de tu encabezado
    }

    doc.setFont(configPDF.fuenteNegrita, 'bold');
    doc.setFontSize(12);
    doc.setTextColor(...configPDF.colorTexto);
    doc.text('RESUMEN FINANCIERO', configPDF.margenPagina, startY);
    startY += 5;

    // Marco de totales - centrado
    const resumenWidth = 170; // Ancho del resumen
    const leftMargin = (210 - resumenWidth) / 2; // Margen izquierdo para centrarlo



    doc.setFontSize(11);
    const lineHeight = 6;
    let currentLine = startY + 7;

    // Ingresos - todo en negro
    doc.setFont(configPDF.fuentePrincipal, 'normal');
    doc.setTextColor(...configPDF.colorTexto);
    doc.text('Total Ingresos:', leftMargin + 10, currentLine);
    doc.setFont(configPDF.fuenteNegrita, 'bold');
    doc.text(`+ $${ingresos.toFixed(2)}`, leftMargin + resumenWidth - 10, currentLine, { align: 'right' });
    currentLine += lineHeight;

    // Egresos - todo en negro
    doc.setFont(configPDF.fuentePrincipal, 'normal');
    doc.text('Total Egresos:', leftMargin + 10, currentLine);
    doc.setFont(configPDF.fuenteNegrita, 'bold');
    doc.text(`$ ${egresos.toFixed(2)}`, leftMargin + resumenWidth - 10, currentLine, { align: 'right' });
    currentLine += lineHeight;

    // Balance - todo en negro
    doc.setFont(configPDF.fuentePrincipal, 'normal');
    doc.text('Balance Neto:', leftMargin + 10, currentLine);
    doc.setFont(configPDF.fuenteNegrita, 'bold');
    doc.text(`${balance >= 0 ? '+' : '-'} $${Math.abs(balance).toFixed(2)}`, leftMargin + resumenWidth - 10, currentLine, { align: 'right' });

    return currentLine + 10;
}

function agregarMensajeSinResultados(doc, startY) {
    doc.setFont(configPDF.fuentePrincipal, 'italic');
    doc.setFontSize(12);
    doc.setTextColor(...configPDF.colorTexto);
    doc.text('No se encontraron transacciones con los filtros seleccionados',
        105, startY + 20, { align: 'center' });
    return startY + 30;
}

function agregarPiePagina(doc) {
    const pageCount = doc.internal.getNumberOfPages();

    for (let i = 1; i <= pageCount; i++) {
        doc.setPage(i);

        // Línea separadora
        doc.setDrawColor(...configPDF.colorBorde);
        doc.line(configPDF.margenPagina, 285, 210 - configPDF.margenPagina, 285);

        // Texto del pie
        doc.setFont(configPDF.fuentePrincipal, 'normal');
        doc.setFontSize(8);
        doc.setTextColor(...configPDF.colorTexto);

        // Izquierda
        doc.text(`Documento confidencial`, configPDF.margenPagina, 290);

        // Centro
        doc.text(`Página ${i} de ${pageCount}`, 105, 290, { align: 'center' });

        // Derecha
        doc.text('Generado el: ' + new Date().toLocaleDateString('es-ES'), 210 - configPDF.margenPagina, 290, { align: 'right' });
    }
}

function agregarEncabezadoPagina(doc, pageNumber) {
    // Logo en páginas adicionales - centrado
    try {
        // Colocar el logo antes del título y centrado (versión simplificada para páginas adicionales)
        doc.addImage(configPDF.logoUrl, 'PNG', (210 - 40) / 2, 10, 40, 15);
    } catch (e) {
        console.warn('No se pudo cargar el logo en página adicional:', e);
    }

    // Número de página
    doc.setFont(configPDF.fuentePrincipal, 'normal');
    doc.setFontSize(9);
    doc.setTextColor(...configPDF.colorTexto);
    doc.text(`Página ${pageNumber}`, 190 - configPDF.margenPagina, 40, { align: 'right' });

    // Línea decorativa
    doc.setDrawColor(...configPDF.colorPrimario);
    doc.setLineWidth(0.3);
    doc.line(configPDF.margenPagina, 45, 210 - configPDF.margenPagina, 45);
}

// ================= FUNCIONES DE UTILIDAD ================= //

function obtenerNombreCliente() {
    // Obtener el texto del nombre completo del cliente desde el HTML
    var nombreCliente = document.getElementById('nombreCliente').textContent.trim();

    // Retornar el nombre completo
    return nombreCliente;
}


function obtenerNombreTipo(tipo) {
    const tipos = {
        'all': 'Todos los tipos',
        'Entrada': 'Depósitos',
        'Salida': 'Retiros',
        'Transferencia': 'Transferencias'
    };
    return tipos[tipo] || tipo;
}

function obtenerTipoTransaccion(tipo) {
    switch (tipo) {
        case 'Depósito':
            return 'Depósito';
        case 'Retiro':
            return 'Retiro';
        case 'Transferencia':
            return 'Transferencia';
        case 'Entrada':
            return 'Depósito';
        case 'Salida':
            return 'Retiro';
        case 'EnvioTransferencia':
        case 'DepositoTransferencia':
            return 'Transferencia';
        default:
            return tipo || 'Desconocido';
    }
}


function obtenerRangoFechasTransacciones() {
    let fechaInicio = null;
    let fechaFin = null;

    // Obtener todas las transacciones visibles
    const items = document.querySelectorAll('.transaction-item');

    if (items.length > 0) {
        items.forEach(item => {
            const fecha = item.dataset.fecha;
            if (fecha) {
                if (!fechaInicio || fecha < fechaInicio) {
                    fechaInicio = fecha;
                }
                if (!fechaFin || fecha > fechaFin) {
                    fechaFin = fecha;
                }
            }
        });
    }

    return { fechaInicio, fechaFin };
}

function convertirFechaHeader(fechaHeader) {
    if (fechaHeader === 'Hoy') return new Date().toISOString().split('T')[0];
    if (fechaHeader === 'Ayer') {
        const ayer = new Date();
        ayer.setDate(ayer.getDate() - 1);
        return ayer.toISOString().split('T')[0];
    }

    try {
        // Parsear formato "Lunes 25 de Junio 2023"
        const meses = {
            'Enero': '01', 'Febrero': '02', 'Marzo': '03', 'Abril': '04',
            'Mayo': '05', 'Junio': '06', 'Julio': '07', 'Agosto': '08',
            'Septiembre': '09', 'Octubre': '10', 'Noviembre': '11', 'Diciembre': '12'
        };

        const partes = fechaHeader.split(' ');
        if (partes.length >= 5) {
            const dia = partes[1].padStart(2, '0');
            const mes = meses[partes[3]] || '01';
            const año = partes[4];
            return `${año}-${mes}-${dia}`;
        }
    } catch (e) {
        console.warn('Error al parsear fecha:', e);
    }

    return fechaHeader;
}

function formatearFechaPDF(fechaStr) {
    if (!fechaStr) return '';

    try {
        const fecha = new Date(fechaStr);
        if (isNaN(fecha.getTime())) return fechaStr;

        return fecha.toLocaleDateString('es-ES', {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric'
        });
    } catch (e) {
        return fechaStr;
    }
}

// Filtrado - Paginacion Cuentas Clientes Transacciones.
$(document).ready(function () {
    // Manejar clic en botones de anulación
    $(document).on('click', '.anular-transaccion', function (e) {
        e.preventDefault();
        e.stopPropagation();

        const idTransaccion = $(this).data('id');
        const tipoTransaccion = $(this).data('tipo');

        $('#id_transaccion_anular').val(idTransaccion);
        $('#tipo_transaccion_anular').val(tipoTransaccion);
        $('#motivo_anulacion').val('');

        $('#confirmarAnulacionModal').modal('show');
    });

    // Confirmar anulación
    $('#confirmarAnulacionBtn').click(function () {
        if ($('#motivo_anulacion').val().trim() === '') {
            alert('Por favor ingrese el motivo de la anulación');
            return;
        }

        $('#formAnulacion').submit();
    });

    // Validar número de cuenta solo dígitos
    $('#numero-cuenta').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    // Manejar cambio de pestañas
    $('.nav-tabs a').on('click', function (e) {
        if ($(this).hasClass('active')) {
            e.preventDefault();
        }
    });
});