<div class="modal fade text-left" id="ModalCreate" tabindex="-1" role="dialog" aria-hidden="true" style="height: 100%">
    <div class="modal-dialog modal-lg" role="document" style="padding-top: 100px">
        <form action="{{ route('admin.juegos.store') }}" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="card">
                    <div class="card-header">
                        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                            <div class="float-left">
                                <h4 class="card-title">{{ __('Crear Nuevo Juego') }}</h4>
                            </div>
                            <div class="float-right">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body bg-white">
                        @csrf

                        <div class="card-body bg-white">
                            <label for="titulo">Título:</label>
                            <input type="text" name="titulo" id="titulo" class="form-control" required>
                        </div>

                        <div class="card-body bg-white">
                            <label for="precio">Precio:</label>
                            <input type="number" name="precio" id="precio" step="0.01" class="form-control" required>
                        </div>

                        <div class="card-body bg-white">
                            <label for="descripcion">Descripción:</label>
                            <textarea name="descripcion" id="descripcion" rows="5" class="form-control" required></textarea>
                        </div>

                        <div class="card-body bg-white">
                            <label for="requisitos_minimos">Requisitos Mínimos:</label>
                            <textarea name="requisitos_minimos" id="requisitos_minimos" rows="5" class="form-control" ></textarea>
                        </div>

                        <div class="card-body bg-white">
                            <label for="requisitos_recomendados">Requisitos Recomendados:</label>
                            <textarea name="requisitos_recomendados" id="requisitos_recomendados" rows="5" class="form-control" ></textarea>
                        </div>

                        <div class="card-body bg-white">
                            <label for="id_categoria">Categoría:</label>
                            <select name="id_categoria" id="id_categoria" class="form-control" required>
                                <option value="">Seleccionar Categoría</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre_categoria }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="card-body bg-white">
                            <label for="stock">Stock en Inventario</label>
                            <input type="number" name="stock" id="stock" class="form-control" class="form-control" required>
                        </div>

                        <div class="card-body bg-white">
                            <label for="imagen">Imagen:</label>
                            <input type="file" name="imagen" id="imagen" class="form-control" >
                        </div>
                        <div class="col-md-12 mt20 mt-2">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cerrar') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('Crear Juego') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>