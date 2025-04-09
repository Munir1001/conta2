// Variables globales para la paginación
let paginaActual = 1;
let resultadosPorPagina = 10;

function filtrarCuentas() {
    const input = document.getElementById("filtroCedula");
    const filter = input.value.toUpperCase();
    const cardContainer = document.getElementById("contenedorCuentas");
    const cards = cardContainer.getElementsByClassName("cuenta-item");

    // Obtener el número de resultados por página
    resultadosPorPagina = parseInt(document.getElementById("resultadosPorPagina").value) || 10;

    let visibleCount = 0;
    let totalVisible = 0;

    // Primero contar cuántas hay visibles después del filtro
    for (let i = 0; i < cards.length; i++) {
        const cedula = cards[i].getAttribute("data-cedula");
        const nombre = cards[i].getAttribute("data-nombre");

        if (cedula.toUpperCase().indexOf(filter) > -1 || nombre.toUpperCase().indexOf(filter) > -1) {
            totalVisible++;
        }
    }

    // Luego aplicar el filtro y la paginación
    for (let i = 0; i < cards.length; i++) {
        const cedula = cards[i].getAttribute("data-cedula");
        const nombre = cards[i].getAttribute("data-nombre");

        const coincideFiltro = cedula.toUpperCase().indexOf(filter) > -1 || nombre.toUpperCase().indexOf(filter) > -1;
        const enPaginaActual = (visibleCount >= (paginaActual - 1) * resultadosPorPagina) &&
            (visibleCount < paginaActual * resultadosPorPagina);

        if (coincideFiltro) {
            if (resultadosPorPagina === 0 || enPaginaActual) {
                cards[i].style.display = "";
                visibleCount++;
            } else {
                cards[i].style.display = "none";
            }
        } else {
            cards[i].style.display = "none";
        }
    }

    // Actualizar la información de paginación
    const desde = resultadosPorPagina === 0 ? 1 : (paginaActual - 1) * resultadosPorPagina + 1;
    const hasta = resultadosPorPagina === 0 ? totalVisible : Math.min(paginaActual * resultadosPorPagina, totalVisible);

    document.getElementById("mostrandoDesde").textContent = desde;
    document.getElementById("mostrandoHasta").textContent = hasta;
    document.getElementById("totalRegistros").textContent = totalVisible;
}

// Inicializar
document.addEventListener("DOMContentLoaded", function() {
    filtrarCuentas();
});