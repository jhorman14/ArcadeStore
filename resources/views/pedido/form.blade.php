<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="fecha_pedido" class="form-label">{{ __('Fecha Pedido') }}</label>
            <input type="text" name="fecha_pedido" class="form-control @error('fecha_pedido') is-invalid @enderror" value="{{ old('fecha_pedido', $pedido?->fecha_pedido) }}" id="fecha_pedido" placeholder="Fecha Pedido">
            {!! $errors->first('fecha_pedido', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="estado_pedido" class="form-label">{{ __('Estado Pedido') }}</label>
            <input type="text" name="estado_pedido" class="form-control @error('estado_pedido') is-invalid @enderror" value="{{ old('estado_pedido', $pedido?->estado_pedido) }}" id="estado_pedido" placeholder="Estado Pedido">
            {!! $errors->first('estado_pedido', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="id_usuario" class="form-label">{{ __('Id Usuario') }}</label>
            <input type="text" name="id_usuario" class="form-control @error('id_usuario') is-invalid @enderror" value="{{ old('id_usuario', $pedido?->id_usuario) }}" id="id_usuario" placeholder="Id Usuario">
            {!! $errors->first('id_usuario', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="id_juego" class="form-label">{{ __('Id Juego') }}</label>
            <input type="text" name="id_juego" class="form-control @error('id_juego') is-invalid @enderror" value="{{ old('id_juego', $pedido?->id_juego) }}" id="id_juego" placeholder="Id Juego">
            {!! $errors->first('id_juego', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>