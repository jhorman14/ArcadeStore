<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="metodo_de_pago" class="form-label">{{ __('Metodo De Pago') }}</label>
            <input type="text" name="metodo_de_pago" class="form-control @error('metodo_de_pago') is-invalid @enderror" value="{{ old('metodo_de_pago', $pago?->metodo_de_pago) }}" id="metodo_de_pago" placeholder="Metodo De Pago">
            {!! $errors->first('metodo_de_pago', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="total" class="form-label">{{ __('Total') }}</label>
            <input type="text" name="total" class="form-control @error('total') is-invalid @enderror" value="{{ old('total', $pago?->total) }}" id="total" placeholder="Total">
            {!! $errors->first('total', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="id_pedido" class="form-label">{{ __('Id Pedido') }}</label>
            <input type="text" name="id_pedido" class="form-control @error('id_pedido') is-invalid @enderror" value="{{ old('id_pedido', $pago?->id_pedido) }}" id="id_pedido" placeholder="Id Pedido">
            {!! $errors->first('id_pedido', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>