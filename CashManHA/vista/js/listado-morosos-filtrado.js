// Configuración global para el estado de paginación
const paginacionState = {
    pagina: 1,
    resultadosPorPagina: 10
};

document.addEventListener('DOMContentLoaded', function() {
    // Elementos principales
    const searchInput = document.getElementById('searchInput');
    const itemsPerPage = document.getElementById('itemsPerPage');
    const clientesContainer = document.getElementById('morosos-container');
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
        const clientes = clientesContainer.getElementsByClassName('cliente-group');

        // Contar elementos visibles
        let totalVisibles = 0;
        for (let cliente of clientes) {
            const idcuota = cliente.getAttribute('data-idcuota') || '';
            const clienteName = cliente.getAttribute('data-cliente') || '';
            const cedula = cliente.getAttribute('data-cedula') || '';
            const producto = cliente.getAttribute('data-producto') || '';

            if (idcuota.includes(filtro) ||
                clienteName.includes(filtro) ||
                cedula.includes(filtro) ||
                producto.includes(filtro)) {
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
        for (let i = 0; i < clientes.length; i++) {
            const cliente = clientes[i];
            const idcuota = cliente.getAttribute('data-idcuota') || '';
            const clienteName = cliente.getAttribute('data-cliente') || '';
            const cedula = cliente.getAttribute('data-cedula') || '';
            const producto = cliente.getAttribute('data-producto') || '';

            if (idcuota.includes(filtro) ||
                clienteName.includes(filtro) ||
                cedula.includes(filtro) ||
                producto.includes(filtro)) {
                if (contador >= inicio && contador < fin) {
                    cliente.style.display = '';
                } else {
                    cliente.style.display = 'none';
                }
                contador++;
            } else {
                cliente.style.display = 'none';
            }
        }

        // Actualizar información de paginación
        const desde = totalVisibles === 0 ? 0 : inicio + 1;
        const hasta = fin;
        resultsInfo.textContent = `Mostrando ${desde} a ${hasta} de ${totalVisibles} clientes morosos`;

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
<a class="page-link" href="#" onclick="cambiarPagina(${paginacionState.pagina - 1}); return false;">
<i class="fas fa-chevron-left"></i>
</a>
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
<a class="page-link" href="#" onclick="cambiarPagina(${paginacionState.pagina + 1}); return false;">
<i class="fas fa-chevron-right"></i>
</a>
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
    const clientesContainer = document.getElementById('morosos-container');
    if (clientesContainer) {
        window.scrollTo({
            top: clientesContainer.offsetTop - 20,
            behavior: 'smooth'
        });
    }
}