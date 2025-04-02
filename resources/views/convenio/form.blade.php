<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="descripcion" class="form-label">{{ __('Descripcion') }}</label>
            <input type="text" name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" value="{{ old('descripcion', $convenio?->descripcion) }}" id="descripcion" placeholder="Descripcion">
            {!! $errors->first('descripcion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="fecha_inicio" class="form-label">{{ __('Fecha Inicio') }}</label>
            <input type="text" name="fecha_inicio" class="form-control @error('fecha_inicio') is-invalid @enderror" value="{{ old('fecha_inicio', $convenio?->fecha_inicio) }}" id="fecha_inicio" placeholder="Fecha Inicio">
            {!! $errors->first('fecha_inicio', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="fecha_fin" class="form-label">{{ __('Fecha Fin') }}</label>
            <input type="text" name="fecha_fin" class="form-control @error('fecha_fin') is-invalid @enderror" value="{{ old('fecha_fin', $convenio?->fecha_fin) }}" id="fecha_fin" placeholder="Fecha Fin">
            {!! $errors->first('fecha_fin', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="id_usuario" class="form-label">{{ __('Id Usuario') }}</label>
            <input type="text" name="id_usuario" class="form-control @error('id_usuario') is-invalid @enderror" value="{{ old('id_usuario', $convenio?->id_usuario) }}" id="id_usuario" placeholder="Id Usuario">
            {!! $errors->first('id_usuario', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="id_juego" class="form-label">{{ __('Id Juego') }}</label>
            <input type="text" name="id_juego" class="form-control @error('id_juego') is-invalid @enderror" value="{{ old('id_juego', $convenio?->id_juego) }}" id="id_juego" placeholder="Id Juego">
            {!! $errors->first('id_juego', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>