document.addEventListener('DOMContentLoaded', () => {
    function updateStats() {
        fetch('/api/admin/stats') // Asume que esta es la ruta de la API
            .then(response => response.json())
            .then(data => {
                document.getElementById('total-users').textContent = "Total de Usuarios Registrados: " + data.total_users;
                document.getElementById('total-games-sold').textContent = "Total de Juegos Vendidos: " + data.total_games_sold;
                // Actualiza el ancho de las barras de progreso
                document.querySelector('#total-users + .progress-bar .progress').style.width = (data.total_users > 0 ? (data.total_users > 100 ? 100 : data.total_users) : 0) + '%';
                document.querySelector('#total-games-sold + .progress-bar .progress').style.width = (data.total_games_sold > 0 ? (data.total_games_sold > 100 ? 100 : data.total_games_sold) : 0) + '%';
            })
            .catch(error => {
                console.error('Error fetching stats:', error);
            });
    }

    // Actualiza las estadísticas cada 5 segundos (puedes ajustar el intervalo)
    setInterval(updateStats, 5000);

    // Llama a updateStats una vez al cargar la página
    updateStats();
});
