$(document).ready(function () {
    // 1. Almacenar todas las transacciones al cargar la página
    const allTransactions = $('.transaction-item').clone();
    let currentFilteredTransactions = [];
    let currentPage = 1; // Variable para mantener el estado de la página actual

    // 2. Manejar cambios en los filtros
    $('#fecha-inicio, #fecha-fin, #items-per-page, #busqueda').on('change keyup', function () {
        currentPage = 1; // Resetear a página 1 al aplicar filtros
        aplicarFiltros();
    });

    // 3. Función principal de filtrado
    function aplicarFiltros() {
        const fechaInicio = $('#fecha-inicio').val();
        const fechaFin = $('#fecha-fin').val();
        const busqueda = $('#busqueda').val().toLowerCase();
        const porPagina = parseInt($('#items-per-page').val());

        // Filtrar transacciones
        currentFilteredTransactions = allTransactions.filter(function () {
            const $this = $(this);
            const fechaTrans = $this.data('fecha').split(' ')[0];
            const textoTrans = $this.text().toLowerCase();

            const cumpleFecha = (!fechaInicio || fechaTrans >= fechaInicio) &&
                (!fechaFin || fechaTrans <= fechaFin);
            const cumpleBusqueda = !busqueda || textoTrans.includes(busqueda);

            return cumpleFecha && cumpleBusqueda;
        });

        // Actualizar la visualización
        actualizarVistaPaginacion(currentPage, porPagina);
    }

    // 4. Función para actualizar toda la vista de paginación
    function actualizarVistaPaginacion(pagina, porPagina) {
        const total = currentFilteredTransactions.length;
        const totalPaginas = Math.ceil(total / porPagina);

        // Mostrar mensaje si no hay resultados
        if (total === 0) {
            $('#pagos-container').html('<div class="text-center p-4 text-muted">No se encontraron pagos con los filtros seleccionados</div>');
            actualizarContadores(0, porPagina, pagina); // Pasar la página actual
            actualizarControlesPaginacion(totalPaginas, pagina);
            return;
        }

        // Mostrar la página solicitada
        mostrarPagina(pagina, porPagina);

        // Actualizar contadores (pasar la página actual)
        actualizarContadores(total, porPagina, pagina);

        // Actualizar controles de paginación
        actualizarControlesPaginacion(totalPaginas, pagina);
    }

    // 5. Mostrar página específica
    function mostrarPagina(pagina, porPagina) {
        const inicio = (pagina - 1) * porPagina;
        const fin = inicio + porPagina;
        currentPage = pagina; // Actualizar la página actual

        // Limpiar contenedor
        $('#pagos-container').empty();

        // Obtener transacciones para esta página
        const transaccionesPagina = currentFilteredTransactions.slice(inicio, fin);

        // Agrupar por fecha
        const groupedByDate = {};
        transaccionesPagina.each(function () {
            const $this = $(this);
            const fecha = $this.data('fecha').split(' ')[0];

            if (!groupedByDate[fecha]) {
                groupedByDate[fecha] = [];
            }
            groupedByDate[fecha].push($this);
        });

        // Generar HTML
        let html = '';
        Object.keys(groupedByDate).sort().reverse().forEach(fecha => {
            html += `<div class="transaction-group mb-0">
                    <div class="transaction-date-header bg-light p-2 px-3 border-bottom">
                        <h6 class="mb-0 font-weight-bold small">${formatDisplayDate(fecha)}</h6>
                    </div>`;

            groupedByDate[fecha].forEach($trans => {
                html += $trans[0].outerHTML;
            });

            html += '</div>';
        });

        $('#pagos-container').html(html);
    }

    // 6. Actualizar contadores
    // 6. Actualizar contadores - versión mejorada para manejar IDs duplicados
    function actualizarContadores(total, porPagina, paginaActual) {
        if (total === 0) {
            // Actualizar todos los elementos con la clase total-records
            document.querySelectorAll('.total-records').forEach(el => el.textContent = total);

            // Actualizar todos los elementos con id showing-from-presidencia
            document.querySelectorAll('[id="showing-from-presidencia"]').forEach(el => el.textContent = '0');

            // Actualizar todos los elementos con id showing-to-presidencia
            document.querySelectorAll('[id="showing-to-presidencia"]').forEach(el => el.textContent = '0');

            return;
        }

        const inicio = (paginaActual - 1) * porPagina + 1;
        const fin = Math.min(paginaActual * porPagina, total);

        // Actualizar todos los elementos con la clase total-records
        document.querySelectorAll('.total-records').forEach(el => el.textContent = total);

        // Actualizar todos los elementos con id showing-from-presidencia
        document.querySelectorAll('[id="showing-from-presidencia"]').forEach(el => el.textContent = inicio);

        // Actualizar todos los elementos con id showing-to-presidencia
        document.querySelectorAll('[id="showing-to-presidencia"]').forEach(el => el.textContent = fin);
    }

    // 7. Actualizar controles de paginación
    function actualizarControlesPaginacion(totalPaginas, paginaActual) {
        const paginationControls = $('#pagination-controls');
        paginationControls.empty();

        // Botón Anterior
        paginationControls.append(
            `<li class="page-item ${paginaActual <= 1 ? 'disabled' : ''}">
                <a class="page-link" href="#" data-action="prev">
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
                <a class="page-link" href="#" data-action="next">
                    <i class="fas fa-angle-right"></i>
                </a>
            </li>`
        );
    }

    // 8. Función para formatear fechas (igual que en tu código original)
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

    // 9. Manejo de eventos de paginación
    $(document).on('click', '#pagination-controls a', function (e) {
        e.preventDefault();
        const $this = $(this);
        const porPagina = parseInt($('#items-per-page').val());
        let nuevaPagina = currentPage;

        if ($this.data('action') === 'prev') {
            nuevaPagina = currentPage - 1;
        } else if ($this.data('action') === 'next') {
            nuevaPagina = currentPage + 1;
        } else if ($this.data('page')) {
            nuevaPagina = parseInt($this.data('page'));
        }

        // Validar que la nueva página sea válida
        if (nuevaPagina > 0 && nuevaPagina <= Math.ceil(currentFilteredTransactions.length / porPagina)) {
            actualizarVistaPaginacion(nuevaPagina, porPagina);
        }
    });

    // 10. Inicializar al cargar la página
    currentFilteredTransactions = allTransactions;
    const porPaginaInicial = parseInt($('#items-per-page').val());
    actualizarVistaPaginacion(currentPage, porPaginaInicial);
});