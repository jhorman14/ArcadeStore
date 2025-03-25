<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="estado_intercambio" class="form-label">{{ __('Estado Intercambio') }}</label>
            <input type="text" name="estado_intercambio" class="form-control @error('estado_intercambio') is-invalid @enderror" value="{{ old('estado_intercambio', $intercambio?->estado_intercambio) }}" id="estado_intercambio" placeholder="Estado Intercambio">
            {!! $errors->first('estado_intercambio', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="fecha_intercambio" class="form-label">{{ __('Fecha Intercambio') }}</label>
            <input type="text" name="fecha_intercambio" class="form-control @error('fecha_intercambio') is-invalid @enderror" value="{{ old('fecha_intercambio', $intercambio?->fecha_intercambio) }}" id="fecha_intercambio" placeholder="Fecha Intercambio">
            {!! $errors->first('fecha_intercambio', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="id_producto_solicitado" class="form-label">{{ __('Id Producto Solicitado') }}</label>
            <input type="text" name="id_producto_solicitado" class="form-control @error('id_producto_solicitado') is-invalid @enderror" value="{{ old('id_producto_solicitado', $intercambio?->id_producto_solicitado) }}" id="id_producto_solicitado" placeholder="Id Producto Solicitado">
            {!! $errors->first('id_producto_solicitado', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="id_producto_ofrecido" class="form-label">{{ __('Id Producto Ofrecido') }}</label>
            <input type="text" name="id_producto_ofrecido" class="form-control @error('id_producto_ofrecido') is-invalid @enderror" value="{{ old('id_producto_ofrecido', $intercambio?->id_producto_ofrecido) }}" id="id_producto_ofrecido" placeholder="Id Producto Ofrecido">
            {!! $errors->first('id_producto_ofrecido', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>