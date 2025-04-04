function buscar() {
    const searchTerm = document.getElementById('search-term').value;
    window.location.href = `/juegosDisp?q=${searchTerm}`;
}

function filtrarPorCategoria() {
    const categoriaId = document.getElementById('filter-categoria').value;
    if (categoriaId === "") {
        // Redirigir a la página base sin el parámetro categoria
        window.location.href = `/juegosDisp`;
    } else {
        // Redirigir con el parámetro de categoría
        window.location.href = `/juegosDisp?categoria=${categoriaId}`;
    }
}