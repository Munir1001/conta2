// Función para buscar reportes
function searchReports() {
    const input = document.getElementById('searchInput');
    const filter = input.value.toUpperCase();
    const cards = document.getElementsByClassName('report-card');

    for (let i = 0; i < cards.length; i++) {
        const card = cards[i];
        const text = card.textContent || card.innerText;
        if (text.toUpperCase().indexOf(filter) > -1) {
            card.style.display = "";
        } else {
            card.style.display = "none";
        }
    }

    // Actualizar paginación después de buscar
    setupPagination();
}

// Configuración de paginación
function setupPagination() {
    const cards = document.querySelectorAll('.report-card:not([style*="display: none"])');
    const pagination = document.getElementById('pagination');
    const itemsPerPage = 6; // Ajustar según necesidad
    const pageCount = Math.ceil(cards.length / itemsPerPage);

    pagination.innerHTML = '';

    if (pageCount <= 1) return;

    // Botón Anterior
    pagination.innerHTML += `
<li class="page-item">
<a class="page-link" href="#" aria-label="Previous" onclick="changePage(currentPage - 1)">
<span aria-hidden="true">&laquo;</span>
</a>
</li>
`;

    // Números de página
    for (let i = 1; i <= pageCount; i++) {
        pagination.innerHTML += `
<li class="page-item">
<a class="page-link" href="#" onclick="changePage(${i})">${i}</a>
</li>
`;
    }

    // Botón Siguiente
    pagination.innerHTML += `
<li class="page-item">
<a class="page-link" href="#" aria-label="Next" onclick="changePage(currentPage + 1)">
<span aria-hidden="true">&raquo;</span>
</a>
</li>
`;

    // Mostrar primera página por defecto
    changePage(1);
}

let currentPage = 1;

function changePage(page) {
    const cards = document.querySelectorAll('.report-card:not([style*="display: none"])');
    const itemsPerPage = 6;
    const pageCount = Math.ceil(cards.length / itemsPerPage);

    if (page < 1) page = 1;
    if (page > pageCount) page = pageCount;

    currentPage = page;

    // Ocultar todas las cards
    cards.forEach(card => card.style.display = "none");

    // Mostrar solo las cards de la página actual
    const startIndex = (page - 1) * itemsPerPage;
    const endIndex = Math.min(startIndex + itemsPerPage, cards.length);

    for (let i = startIndex; i < endIndex; i++) {
        cards[i].style.display = "";
    }

    // Actualizar estado activo de la paginación
    const pageItems = document.querySelectorAll('#pagination .page-item');
    pageItems.forEach((item, index) => {
        if (index === page) {
            item.classList.add('active');
        } else {
            item.classList.remove('active');
        }
    });
}

// Inicializar paginación al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    setupPagination();
});