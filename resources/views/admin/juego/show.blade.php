@extends('layouts.app')

@section('template_title')
    {{ $juego->name ?? __('Show') . " " . __('Juego') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Juego</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('juegos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Titulo:</strong>
                                    {{ $juego->titulo }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Precio:</strong>
                                    {{ $juego->precio }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Descripcion:</strong>
                                    {{ $juego->descripcion }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Requisitos Minimos:</strong>
                                    {{ $juego->requisitos_minimos }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Requisitos Recomendados:</strong>
                                    {{ $juego->requisitos_recomendados }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Id Categoria:</strong>
                                    {{ $juego->id_categoria }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
