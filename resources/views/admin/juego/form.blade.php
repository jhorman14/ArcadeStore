<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="titulo" class="form-label">{{ __('Titulo') }}</label>
            <input type="text" name="titulo" class="form-control @error('titulo') is-invalid @enderror" value="{{ old('titulo', $juego?->titulo) }}" id="titulo" placeholder="Titulo">
            {!! $errors->first('titulo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="precio" class="form-label">{{ __('Precio') }}</label>
            <input type="text" name="precio" class="form-control @error('precio') is-invalid @enderror" value="{{ old('precio', $juego?->precio) }}" id="precio" placeholder="Precio">
            {!! $errors->first('precio', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="descripcion" class="form-label">{{ __('Descripcion') }}</label>
            <input type="text" name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" value="{{ old('descripcion', $juego?->descripcion) }}" id="descripcion" placeholder="Descripcion">
            {!! $errors->first('descripcion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="requisitos_minimos" class="form-label">{{ __('Requisitos Minimos') }}</label>
            <input type="text" name="requisitos_minimos" class="form-control @error('requisitos_minimos') is-invalid @enderror" value="{{ old('requisitos_minimos', $juego?->requisitos_minimos) }}" id="requisitos_minimos" placeholder="Requisitos Minimos">
            {!! $errors->first('requisitos_minimos', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="requisitos_recomendados" class="form-label">{{ __('Requisitos Recomendados') }}</label>
            <input type="text" name="requisitos_recomendados" class="form-control @error('requisitos_recomendados') is-invalid @enderror" value="{{ old('requisitos_recomendados', $juego?->requisitos_recomendados) }}" id="requisitos_recomendados" placeholder="Requisitos Recomendados">
            {!! $errors->first('requisitos_recomendados', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="id_categoria" class="form-label">{{ __('Id Categoria') }}</label>
            <input type="text" name="id_categoria" class="form-control @error('id_categoria') is-invalid @enderror" value="{{ old('id_categoria', $juego?->id_categoria) }}" id="id_categoria" placeholder="Id Categoria">
            {!! $errors->first('id_categoria', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>