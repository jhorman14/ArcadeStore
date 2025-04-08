function updateDashboardStats() {
    fetch('/api/admin/stats')
        .then(response => response.json())
        .then(data => {
            document.getElementById('total-users').textContent = "Total de Usuarios Registrados: " + data.total_users;
            document.getElementById('total-games-sold').textContent = "Total de Juegos Vendidos: " + data.total_games_sold;
            document.getElementById('total-intercambios').textContent = "Total de Intercambios Realizados: " + data.total_intercambios;
            // Update progress bar widths
            updateProgressBar('total-users', data.total_users);
            updateProgressBar('total-games-sold', data.total_games_sold);
            updateProgressBar('total-intercambios', data.total_intercambios);
        })
        .catch(error => console.error('Error:', error));
}

function updateProgressBar(elementId, value) {
    const progressBar = document.querySelector(`#${elementId} + .progress-bar .progress`);
    if (progressBar) {
        progressBar.style.width = `${value}%`;
    }
}

// Update the stats when the page loads
updateDashboardStats();

// Optionally, you can update the stats periodically (e.g., every 5 minutes)
// setInterval(updateDashboardStats, 300000); // 300000 milliseconds = 5 minutes
