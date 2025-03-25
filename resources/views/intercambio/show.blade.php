@extends('layouts.app')

@section('template_title')
    {{ $intercambio->name ?? __('Show') . " " . __('Intercambio') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Intercambio</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('intercambios.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Estado Intercambio:</strong>
                                    {{ $intercambio->estado_intercambio }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Fecha Intercambio:</strong>
                                    {{ $intercambio->fecha_intercambio }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Id Producto Solicitado:</strong>
                                    {{ $intercambio->id_producto_solicitado }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Id Producto Ofrecido:</strong>
                                    {{ $intercambio->id_producto_ofrecido }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
