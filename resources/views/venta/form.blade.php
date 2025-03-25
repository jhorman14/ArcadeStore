<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="fecha_venta" class="form-label">{{ __('Fecha Venta') }}</label>
            <input type="text" name="fecha_venta" class="form-control @error('fecha_venta') is-invalid @enderror" value="{{ old('fecha_venta', $venta?->fecha_venta) }}" id="fecha_venta" placeholder="Fecha Venta">
            {!! $errors->first('fecha_venta', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="id_usuario" class="form-label">{{ __('Id Usuario') }}</label>
            <input type="text" name="id_usuario" class="form-control @error('id_usuario') is-invalid @enderror" value="{{ old('id_usuario', $venta?->id_usuario) }}" id="id_usuario" placeholder="Id Usuario">
            {!! $errors->first('id_usuario', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="id_juego" class="form-label">{{ __('Id Juego') }}</label>
            <input type="text" name="id_juego" class="form-control @error('id_juego') is-invalid @enderror" value="{{ old('id_juego', $venta?->id_juego) }}" id="id_juego" placeholder="Id Juego">
            {!! $errors->first('id_juego', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>