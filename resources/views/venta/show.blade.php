@extends('layouts.app')

@section('template_title')
    {{ $venta->name ?? __('Show') . " " . __('Venta') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Venta</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('ventas.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Fecha Venta:</strong>
                                    {{ $venta->fecha_venta }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Usuario:</strong>
                                    {{ $venta->user->name }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Juego:</strong>
                                    {{ $venta->juego->titulo }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Pedido:</strong>
                                    {{ $venta->pedido ? $venta->pedido->id : 'N/A' }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
