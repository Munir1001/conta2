// Función para marcar como favorito
document.querySelectorAll('.email-list-item-star').forEach(star => {
    star.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        this.innerHTML = this.innerHTML.includes('far') ?
            '<i class="fas fa-star text-warning"></i>' :
            '<i class="far fa-star"></i>';
    });
});

// Función para actualizar el tiempo relativo
function updateTimeAgo() {
    document.querySelectorAll('.email-list-item-time time').forEach(time => {
        const date = new Date(time.getAttribute('datetime'));
        const now = new Date();
        const diff = Math.floor((now - date) / 1000); // Diferencia en segundos

        if (diff < 60) {
            time.textContent = 'Hace unos segundos';
        } else if (diff < 3600) {
            time.textContent = 'Hace ' + Math.floor(diff / 60) + ' minutos';
        } else if (diff < 86400) {
            time.textContent = 'Hace ' + Math.floor(diff / 3600) + ' horas';
        } else {
            time.textContent = 'Hace ' + Math.floor(diff / 86400) + ' días';
        }
    });
}

document.querySelectorAll('.messaging-list-item-star').forEach(star => {
    star.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        this.innerHTML = this.innerHTML.includes('far') ? 
            '<i class="fas fa-star text-warning"></i>' : 
            '<i class="far fa-star"></i>';
    });
});

// Función para actualizar el tiempo relativo
function updateTimeAgo() {
    document.querySelectorAll('.messaging-list-item-time span').forEach(time => {
        const dateText = time.textContent;
        // Aquí puedes agregar lógica para mostrar tiempo relativo si lo prefieres
        // time.textContent = formatRelativeTime(dateText);
    });
}

// Actualizar tiempos al cargar y cada minuto
document.addEventListener('DOMContentLoaded', function() {
    updateTimeAgo();
    setInterval(updateTimeAgo, 60000);
});