// Configuración global para el estado de paginación
const paginacionState = {
    pagina: 1,
    resultadosPorPagina: 10
};

document.addEventListener('DOMContentLoaded', function() {
    // Elementos principales
    const searchInput = document.getElementById('searchInput');
    const itemsPerPage = document.getElementById('itemsPerPage');
    const cardsContainer = document.getElementById('cardsContainer');
    const pagination = document.getElementById('pagination');
    const resultsInfo = document.getElementById('resultsInfo');

    // Asignar eventos
    searchInput.addEventListener('input', function() {
        paginacionState.pagina = 1;
        filtrarYPaginar();
    });

    itemsPerPage.addEventListener('change', function() {
        paginacionState.pagina = 1;
        paginacionState.resultadosPorPagina = this.value === '9999' ? 9999 : parseInt(this.value);
        filtrarYPaginar();
    });

    // Inicializar
    filtrarYPaginar();

    // Función principal de filtrado y paginación
    function filtrarYPaginar() {
        const filtro = searchInput.value.toLowerCase();
        const resultadosPorPagina = paginacionState.resultadosPorPagina;
        const cards = cardsContainer.getElementsByClassName('card-item');

        // Contar elementos visibles
        let totalVisibles = 0;
        for (let card of cards) {
            const nombre = card.getAttribute('data-nombre') || '';
            const apellido = card.getAttribute('data-apellido') || '';
            const cedula = card.getAttribute('data-cedula') || '';
            const ruc = card.getAttribute('data-ruc') || '';

            if (nombre.includes(filtro) ||
                apellido.includes(filtro) ||
                cedula.includes(filtro) ||
                ruc.includes(filtro)) {
                totalVisibles++;
            }
        }

        // Calcular total de páginas
        const totalPaginas = resultadosPorPagina === 9999 ? 1 : Math.max(1, Math.ceil(totalVisibles / resultadosPorPagina));

        // Asegurar que la página actual sea válida
        paginacionState.pagina = Math.max(1, Math.min(paginacionState.pagina, totalPaginas));

        // Calcular rangos
        const inicio = (paginacionState.pagina - 1) * resultadosPorPagina;
        const fin = resultadosPorPagina === 9999 ? totalVisibles : Math.min(inicio + resultadosPorPagina, totalVisibles);

        // Mostrar/ocultar elementos según paginación
        let contador = 0;
        for (let i = 0; i < cards.length; i++) {
            const card = cards[i];
            const nombre = card.getAttribute('data-nombre') || '';
            const apellido = card.getAttribute('data-apellido') || '';
            const cedula = card.getAttribute('data-cedula') || '';
            const ruc = card.getAttribute('data-ruc') || '';

            if (nombre.includes(filtro) ||
                apellido.includes(filtro) ||
                cedula.includes(filtro) ||
                ruc.includes(filtro)) {
                if (contador >= inicio && contador < fin) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
                contador++;
            } else {
                card.style.display = 'none';
            }
        }

        // Actualizar información de paginación
        const desde = totalVisibles === 0 ? 0 : inicio + 1;
        const hasta = fin;
        resultsInfo.textContent = `Mostrando ${desde} a ${hasta} de ${totalVisibles} clientes`;

        // Generar controles de paginación
        actualizarPaginacion(totalPaginas);
    }

    // Actualizar la paginación en el DOM
    function actualizarPaginacion(totalPaginas) {
        if (totalPaginas <= 1) {
            pagination.innerHTML = '';
            return;
        }

        let paginacionHTML = '';

        // Botón Anterior
        paginacionHTML += `
<li class="page-item ${paginacionState.pagina === 1 ? 'disabled' : ''}">
<a class="page-link" href="#" onclick="cambiarPagina(${paginacionState.pagina - 1}); return false;">&laquo;</a>
</li>`;

        // Números de página con manejo de muchas páginas
        const maxVisiblePages = 5;
        let startPage = Math.max(1, paginacionState.pagina - Math.floor(maxVisiblePages / 2));
        let endPage = Math.min(totalPaginas, startPage + maxVisiblePages - 1);

        if (endPage - startPage + 1 < maxVisiblePages) {
            startPage = Math.max(1, endPage - maxVisiblePages + 1);
        }

        if (startPage > 1) {
            paginacionHTML += `
<li class="page-item">
<a class="page-link" href="#" onclick="cambiarPagina(1); return false;">1</a>
</li>`;

            if (startPage > 2) {
                paginacionHTML += `
<li class="page-item disabled">
<a class="page-link" href="#">...</a>
</li>`;
            }
        }

        for (let i = startPage; i <= endPage; i++) {
            paginacionHTML += `
<li class="page-item ${i === paginacionState.pagina ? 'active' : ''}">
<a class="page-link" href="#" onclick="cambiarPagina(${i}); return false;">${i}</a>
</li>`;
        }

        if (endPage < totalPaginas) {
            if (endPage < totalPaginas - 1) {
                paginacionHTML += `
<li class="page-item disabled">
<a class="page-link" href="#">...</a>
</li>`;
            }

            paginacionHTML += `
<li class="page-item">
<a class="page-link" href="#" onclick="cambiarPagina(${totalPaginas}); return false;">${totalPaginas}</a>
</li>`;
        }

        // Botón Siguiente
        paginacionHTML += `
<li class="page-item ${paginacionState.pagina === totalPaginas ? 'disabled' : ''}">
<a class="page-link" href="#" onclick="cambiarPagina(${paginacionState.pagina + 1}); return false;">&raquo;</a>
</li>`;

        pagination.innerHTML = paginacionHTML;
    }

    // Exponer la función filtrarYPaginar al contexto global
    window.filtrarYPaginar = filtrarYPaginar;
});

// Función global para cambiar de página
function cambiarPagina(nuevaPagina) {
    paginacionState.pagina = nuevaPagina;
    window.filtrarYPaginar();

    // Scroll suave al contenedor de resultados
    const cardsContainer = document.getElementById('cardsContainer');
    if (cardsContainer) {
        window.scrollTo({
            top: cardsContainer.offsetTop - 20,
            behavior: 'smooth'
        });
    }
}
// PAGINA DE INICIO ADMINISTRADORES - PRESIDENCIA  - GERENCIA

document.addEventListener('DOMContentLoaded', function() {
    const btnFiltrar = document.getElementById('btnFiltrar');
    const fechaDesde = document.getElementById('fechaDesde');
    const fechaHasta = document.getElementById('fechaHasta');

    // Configurar fecha mínima y máxima (opcional)
    const fechaActual = new Date().toISOString().split('T')[0];
    fechaDesde.max = fechaActual;
    fechaHasta.max = fechaActual;

    btnFiltrar.addEventListener('click', filtrarTransacciones);

    // Filtrar al cargar la página
    filtrarTransacciones();
});

function filtrarTransacciones() {
    const fechaDesde = document.getElementById('fechaDesde').value;
    const fechaHasta = document.getElementById('fechaHasta').value;
    const transacciones = document.getElementsByClassName('transaccion-item');

    let mostradas = 0;

    for (let transaccion of transacciones) {
        const fechaTrans = transaccion.getAttribute('data-fecha');
        let mostrar = true;

        // Aplicar filtros de fecha
        if (fechaDesde && fechaTrans < fechaDesde) {
            mostrar = false;
        }
        if (fechaHasta && fechaTrans > fechaHasta) {
            mostrar = false;
        }

        if (mostrar) {
            transaccion.style.display = '';
            mostradas++;
        } else {
            transaccion.style.display = 'none';
        }
    }

    // Mostrar mensaje si no hay resultados
    const contenedor = document.getElementById('contenedorTransacciones');
    const mensajeNoResultados = contenedor.querySelector('.no-resultados');

    if (mostradas === 0) {
        if (!mensajeNoResultados) {
            const div = document.createElement('div');
            div.className = 'col-12 no-resultados';
            div.innerHTML = `
    <div class="card">
        <div class="card-body text-center ai-icon text-warning">
            <img style="width: 80px" class="img-fluid" src="https://raw.githubusercontent.com/Munir1001/images/refs/heads/main/search.png">
            <h4 class="my-2">No se encontraron transacciones con los filtros aplicados</h4>
        </div>
    </div>
`;
            contenedor.appendChild(div);
        }
    } else if (mensajeNoResultados) {
        mensajeNoResultados.remove();
    }
}